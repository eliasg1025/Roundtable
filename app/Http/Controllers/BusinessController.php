<?php

namespace App\Http\Controllers;

use App\Category;
use App\User;
use Carbon\Carbon;
use App\Traits\UserData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class BusinessController extends Controller
{
	use UserData;

	public function index()
	{
		$data = [
			'loged' => !empty(Auth::user()) ? 1 : 0,
			'categories' => Category::all(),
		];
		return view('search', compact('data'));
	}

	public function searchBusiness() {
		$query = Input::get('query');
		$users = User::where('commercial_name', 'like', '%'.$query.'%')->get();

		return response()->json($users);
	}

	public function getBusiness() {
		$ratingInfo = DB::table('ratings')
                            ->select('user_id', DB::raw('COUNT(*) as amount_rating, SUM(value) as total_rating, AVG(value) as avg_rating'))
                            ->groupBy('user_id');

        $typeInfo = DB::table('types')
        				->select(DB::raw('id as xid'), 'name');

		$users = User::select('id', 'commercial_name', 'uuid', 'profile_img', 'cover_img', 'description', 'verified', 'amount_rating', 'total_rating', 'avg_rating', 'type_id', 'type_info.name')
						->joinSub($ratingInfo, 'rating_info', function($join) {
							$join->on('users.id', '=', 'rating_info.user_id');
						})
						->joinSub($typeInfo, 'type_info', function($join) {
							$join->on('users.type_id', '=', 'type_info.xid');
						})
						->orderBy('total_rating', 'DESC', 'avg_rating', 'DESC')
						->paginate(4); // Cantidad de empresas por pagina

		return response()->json($users);
	}

	public function getBusinessByCategory($slug)
	{
		$ratingInfo = DB::table('ratings')
                            ->select('user_id', DB::raw('COUNT(*) as amount_rating, SUM(value) as total_rating, AVG(value) as avg_rating'))
                            ->groupBy('user_id');

        $catUser = DB::table('category_user')
        						->select('user_id', 'category_id', 'slug')
        						->join('categories', 'categories.id', '=', 'category_user.category_id')
        						->where('slug', $slug);

		$typeInfo = DB::table('types')
        				->select(DB::raw('id as xid'), 'name');

		$users = User::select('id', 'commercial_name', 'uuid', 'profile_img', 'cover_img', 'description', 'verified', 'amount_rating', 'total_rating', 'avg_rating', 'cat_user.slug', 'type_id', 'type_info.name')
						->joinSub($ratingInfo, 'rating_info', function($join) {
							$join->on('users.id', '=', 'rating_info.user_id');
						})
						->joinSub($catUser, 'cat_user', function($join) {
							$join->on('users.id', '=', 'cat_user.user_id');
						})
						->joinSub($typeInfo, 'type_info', function($join) {
							$join->on('users.type_id', '=', 'type_info.xid');
						})
						->orderBy('total_rating', 'DESC', 'avg_rating', 'DESC')
						->paginate(4); // Cantidad de empresas por pagina

		return response()->json($users);
	}


	// View business Profile -> return view
	//Mostrar la página de usuario tal
	public function show($slug)
	{
		$uuid = substr($slug, -5);
		$user = User::whereUuid($uuid)
					->firstOrFail();

		if ($slug !== $user->slug) {
			return redirect()->to($user->url);
		}

		$user->select('id', 'commercial_name', 'uuid', 'slug', 'verified', 'cover_img', 'profile_img', 'type_id', 'description');
				
		$ip="";
		$fecha=carbon::now();//2019-02-02 03:03:03
		$fechaA=$fecha->format('Y-m-d'); //20-02-2020
		$time=$fecha->toTimeString(); //03:03:03
		$user_visitador=Auth::user();
		$visitado=$user->id;
		$ip= $_SERVER['REMOTE_ADDR'];
		$port=$_SERVER['REMOTE_PORT'];
				 
		if($uuid != $user_visitador->uuid){
			
			$visitas=DB::table('visitas')->select('ip','port','fecha')->
			where([['ip',$ip],['id_visitante',$user_visitador->id],['user_id',$visitado]])->orderBy('id','desc')->limit(1)->get();
			
			if(count($visitas)>=1){
			$fecha_bd=substr($visitas[0]->fecha,0,10);
	
				if($fechaA===$fecha_bd && $ip===$visitas[0]->ip){
					$hora=substr($time,0,2);
					$hora_bd=substr($visitas[0]->fecha,11,2);
					
					$dHora=(24-$hora_bd)-(24-$hora);
					if($dHora>=2){
						DB::table('visitas')->insert([
							'ip'=>$ip,
							'port'=>$port, 
							'fecha'=>$fechaA." ".$time,
							'id_visitante'=>$user_visitador->id,
							'user_id'=>$visitado
							]);
					}else{
						$minutos=substr($time,3,2);
						$min_bd=substr($visitas[0]->fecha,14,2);

						if($dHora==0){
							$dMin=(60-$min_bd)-(60-$minutos);
							
							if($dMin>=30){
								DB::table('visitas')->insert([
									'ip'=>$ip,
									'port'=>$port, 
									'fecha'=>$fechaA." ".$time,
									'id_visitante'=>$user_visitador->id,
									'user_id'=>$visitado
									]);
							}
						}else{
								$dMin=(60-$min_bd)+$minutos;

								if($dMin>=30){
									DB::table('visitas')->insert([
										'ip'=>$ip,
										'port'=>$port, 
										'fecha'=>$fechaA." ".$time,
										'id_visitante'=>$user_visitador->id,
										'user_id'=>$visitado
										]);
								}						
							
						}                    
					}
				}else{
					DB::table('visitas')->insert([
						'ip'=>$ip,
						'port'=>$port, 
						'fecha'=>$fechaA." ".$time,
						'id_visitante'=>$user_visitador->id,
						'user_id'=>$visitado
					]);
				}
		    }else{
				DB::table('visitas')->insert([
					'ip'=>$ip,
					'port'=>$port, 
					'fecha'=>$fechaA." ".$time,
					'id_visitante'=>$user_visitador->id,
					'user_id'=>$visitado
					]);
			}
		}
						
		//DB::table('visitas')->insert(['ip'=>$ip, 'fecha'=>$fecha,'hora'=>$hora,]);
		// Media data
		$media_data = $this->getMediaData($user);
		
		$visit_user = [
			'loged' => false,
			'data' => empty(Auth::user()) ? false : Auth::user(),
		];
	
		// Account data
		$account_data = [
			'rating_data' => $this->getRating($user),
			'categories_data' => $this->getCategories($user),
			'user_certifications' => $this->getCertifications($user),
			'offers_data' => $this->getOffers($user)
		];
	
		return view('business', compact('visit_user', 'user', 'media_data', 'account_data'));
	}
}

/*
SELECT users.id, users.commercial_name, users.uuid, users.profile_img, users.cover_img, users.views, users.verified, users.type_id, total.total_rating, total.avg_rating, user_cat.category_id
FROM users
INNER JOIN
(
    SELECT SUM(ratings.value) AS total_rating, AVG(ratings.value) AS avg_rating, user_id
    FROM `ratings`
    GROUP BY user_id
) AS total ON users.id = total.user_id
INNER JOIN
(
	SELECT user_id, category_id FROM category_user
    INNER JOIN categories ON categories.id = category_user.category_id
    WHERE category_id = 1
) AS user_cat ON users.id = user_cat.user_id
WHERE users.type_id = 1 OR users.type_id = 2
ORDER BY total.total_rating DESC, total.avg_rating DESC
LIMIT 10
*/

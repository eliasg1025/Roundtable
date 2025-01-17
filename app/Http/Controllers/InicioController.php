<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InicioController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		/* $this->middleware('auth'); */
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function index()
	{
		$loged = !empty(Auth::user()) ? true : false;
		
		$data = [
			'featuredSellers' => $this->getFeaturedUsers('seller'),
			'featuredBuyers' => $this->getFeaturedUsers('buyer'),
			'mostViewedCompanies' => $this->getMostViewedCompanies(),
			'categories' => $this->getCategories(),
			'loged' => $loged,
		];
		
		return view('inicio', compact('data'));
	}

	private function getFeaturedUsers(String $type_user)
	{
		switch ($type_user) {
			case 'buyer':
				$types = [3];
				break;
			
			case 'seller':
				$types = [1, 2];
				break;
		}

		$ratingInfo = DB::table('ratings')
							->select('user_id', DB::raw('COUNT(*) as amount_rating, SUM(value) as total_rating, AVG(value) as avg_rating'))
							->groupBy('user_id');

		$planInfo = DB::table('plan_user')
							->select('user_id')
							->join('plans', 'plans.id', '=', 'plan_user.plan_id')
							->where('plans.is_best', '=', '1');

		$typeInfo = DB::table('types')
        				->select(DB::raw('id as xid'), 'name');
		
		$users = App\User::select('id', 'commercial_name', 'uuid', 'profile_img', 'cover_img', 'verified', 'type_id', 'amount_rating', 'total_rating', 'avg_rating', 'type_info.name')
							->joinSub($ratingInfo, 'rating_info', function($join) {
								$join->on('users.id', '=', 'rating_info.user_id');
							})
							->joinSub($planInfo, 'plan_info', function($join) {
								$join->on('plan_info.user_id', '=', 'users.id');
							})
							->joinSub($typeInfo, 'type_info', function($join) {
								$join->on('users.type_id', '=', 'type_info.xid');
							})
							->whereIn('type_id', $types)
							->orderBy('total_rating', 'DESC', 'avg_rating', 'DESC')
							->limit(10)
							->get();
		
		return $users;
	}

	private function getMostViewedCompanies()
	{
		$ratingInfo = DB::table('ratings')
							->select('user_id', DB::raw('COUNT(*) as amount_rating, SUM(value) as total_rating, AVG(value) as avg_rating'))
							->groupBy('user_id');

		$typeInfo = DB::table('types')
						->select(DB::raw('id as xid'), 'name');
						
		$viewsInfo = DB::table('visitas')
							->select(DB::raw('COUNT(*) as total_views'), 'user_id')
							->groupBy('user_id');
		
		$users = App\User::select('id', 'commercial_name', 'uuid', 'profile_img', 'cover_img', 'verified', 'type_id', 'amount_rating', 'total_rating', 'avg_rating', 'type_info.name')
							->joinSub($ratingInfo, 'rating_info', function($join) {
								$join->on('users.id', '=', 'rating_info.user_id');
							})
							->joinSub($typeInfo, 'type_info', function($join) {
								$join->on('users.type_id', '=', 'type_info.xid');
							})
							->joinSub($viewsInfo, 'views_info', function($join) {
								$join->on('users.id', '=', 'views_info.user_id');
							})
							->orderBy('total_views', 'DESC')
							->limit(10)
							->get();

		return $users;
	}

	private function getCategories()
	{
		$categories = App\Category::all();
		return $categories;
	}
	
	
	/* 
	SELECT users.id, users.commercial_name, users.uuid, users.profile_img, users.cover_img, users.views, users.verified, users.type_id, total.total_rating, total.avg_rating
	FROM users
	INNER JOIN
		(
			SELECT SUM(ratings.value) AS total_rating, AVG(ratings.value) AS avg_rating, user_id
			FROM `ratings`
			GROUP BY user_id
		) AS total
	ON users.id = total.user_id
	WHERE users.type_id = 1
	ORDER BY total.total_rating DESC, total.avg_rating DESC
	LIMIT 10 */
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
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
        $data = [
            'featuredSellers' => $this->getSellers(),
            'featuredBuyers' => $this->getBuyers(),
            'mostViewedCompanies' => $this->getMostViewedCompanies(),
            'categories' => $this->getCategories(),
        ];
        return view('inicio', compact('data'));
    }

    private function getBuyers()
    {
        $ratingInfo = DB::table('ratings')
                            ->select('user_id', DB::raw('COUNT(*) as amount_rating, SUM(value) as total_rating, AVG(value) as avg_rating'))
                            ->groupBy('user_id');
        
        $users = App\User::select('id', 'commercial_name', 'uuid', 'profile_img', 'cover_img', 'views', 'verified', 'type_id', 'amount_rating', 'total_rating', 'avg_rating')
                            ->joinSub($ratingInfo, 'rating_info', function($join) {
                                $join->on('users.id', '=', 'rating_info.user_id');
                            })
                            ->where('type_id', 3)
                            ->orderBy('total_rating', 'DESC', 'avg_rating', 'DESC')
                            ->limit(10)
                            ->get();
        
        return $users;
    }

    private function getSellers()
    {
		$ratingInfo = DB::table('ratings')
                            ->select('user_id', DB::raw('COUNT(*) as amount_rating, SUM(value) as total_rating, AVG(value) as avg_rating'))
                            ->groupBy('user_id');
        
        $users = App\User::select('id', 'commercial_name', 'uuid', 'profile_img', 'cover_img', 'views', 'verified', 'type_id', 'amount_rating', 'total_rating', 'avg_rating')
                            ->joinSub($ratingInfo, 'rating_info', function($join) {
                                $join->on('users.id', '=', 'rating_info.user_id');
                            })
                            ->where('type_id', 1)
                            ->orWhere('type_id', 2)
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
        
        $users = App\User::select('id', 'commercial_name', 'uuid', 'profile_img', 'cover_img', 'views', 'verified', 'type_id', 'amount_rating', 'total_rating', 'avg_rating')
                            ->joinSub($ratingInfo, 'rating_info', function($join) {
                                $join->on('users.id', '=', 'rating_info.user_id');
                            })
                            ->orderBy('views', 'DESC')
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

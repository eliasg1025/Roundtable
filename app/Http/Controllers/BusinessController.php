<?php

namespace App\Http\Controllers;

use App\Category;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class BusinessController extends Controller
{
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

		$users = User::select('id', 'commercial_name', 'uuid', 'profile_img', 'cover_img', 'description', 'verified', 'amount_rating', 'total_rating', 'avg_rating')
						->joinSub($ratingInfo, 'rating_info', function($join) {
							$join->on('users.id', '=', 'rating_info.user_id');
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

		$users = User::select('id', 'commercial_name', 'uuid', 'profile_img', 'cover_img', 'description', 'verified', 'amount_rating', 'total_rating', 'avg_rating', 'cat_user.slug')
						->joinSub($ratingInfo, 'rating_info', function($join) {
							$join->on('users.id', '=', 'rating_info.user_id');
						})
						->joinSub($catUser, 'cat_user', function($join) {
							$join->on('users.id', '=', 'cat_user.user_id');
						})
						->orderBy('total_rating', 'DESC', 'avg_rating', 'DESC')
						->paginate(4); // Cantidad de empresas por pagina

		return response()->json($users);
	}


	// View business Profile -> return view
	public function show($slug)
	{
		$uuid = substr($slug, -5);
		$user = User::whereUuid($uuid)->firstOrFail();

		if ($slug !== $user->slug) {
			return redirect()->to($user->url);
		}

		// Media data
		$media_data = $this->getMediaData($user);

		// Account data
		$account_data = [
			'rating_data' => $this->getRating($user),
			'categories_data' => $this->getCategories($user),
			'user_certifications' => $this->getCertifications($user),
			'offers_data' => $this->getOffers($user)
		];

		return view('business', compact('user', 'media_data', 'account_data'));
	}

	// Get data functions

	private function getMediaData(User $user)
	{
		$images = $user->images()->get();
		$videos = $user->videos()->get();

		return [
			'images' => $images,
			'videos' => $videos
		];
	}

	private function getRating(User $user)
	{
		$data = [
			'value' => $user->ratings()->avg('value'),
			'amount' => $user->ratings()->count(),
			'show' => $user->ratings()->count() > 5 ? true : false,
		];

		return $data;
	}

	private function getCategories(User $user)
	{
		$categories = $user->categories()->get();
		return $categories;
	}

	private function getOffers(User $user)
	{
		$offers = $user->offers()->get();
		$data = [];

		foreach($offers as $offer) {
			$certifications = $offer->offer_certifications()->get();

			array_push($data, [
				'offer' => $offer,
				'offer_category' => $offer->category()->get(),
				'certifications' => $certifications,
			]);

			unset($certifications);
		}

		return $data;
	}

	private function getCertifications(User $user) {
		$user_certifications = $user->user_certifications()->get();
		return $user_certifications;
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function index()
    {
    	$user = Auth::user();
    	$plans = DB::table('plan_user')
    					->join('plans', 'plan_user.plan_id', '=', 'plans.id')
						->where('user_id', $user->id)
						->orderBy('plan_id', 'DESC') ////////////////////////////
						->get();

		$messages = DB::table('messages')
						->where('user_id', $user->id)
						->orderBy('created_at', 'DESC')
						->get();

		$account_data = [
			'rating_data' => $this->getRating($user),
			'categories_data' => $this->getCategories($user),
			'user_certifications' => $this->getCertifications($user),
			'offers_data' => $this->getOffers($user)
		];

		$data = [
			'user' => $user,
			'user_plans' => $plans,
			'messages' => $messages,
			'account_data' => $account_data,
		];

        return view('profile', compact('data'));
    }

    // Get data functions

    private function getRating($user)
	{
		$data = [
			'value' => $user->ratings()->avg('value'),
			'amount' => $user->ratings()->count(),
			'show' => $user->ratings()->count() > 5 ? true : false,
		];

		return $data;
	}

	private function getCategories($user)
	{
		$categories = $user->categories()->get();
		return $categories;
	}

	private function getOffers($user)
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

	private function getCertifications($user) {
		$user_certifications = $user->user_certifications()->get();
		return $user_certifications;
	}
}

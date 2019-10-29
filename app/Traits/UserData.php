<?php

namespace App\Traits;

use App\User;
use Illuminate\Support\Facades\DB;
/**
 * Funciones comunes para los controladores
 */
trait UserData
{
	public function hasBestPlan(User $user)
	{
		$plan_user = DB::table('plan_user')->select('user_id', 'plan_id')
						->join('plans', 'plans.id', '=', 'plan_user.plan_id')
						->where('plans.is_best', '=', '1')
						->get();

		for ($i = 0; $i <= count($plan_user); $i++) {
			if ($plan_user[$i]->user_id == $user->id) {
				return true;
			} else {
				return false;
			}
		}
	}

	public function userPlan(User $user)
	{
		$plans = DB::table('plan_user')->select('plans.slug')
					->join('plans', 'plan_user.plan_id', '=', 'plans.id')
					->where('user_id', $user->id)
					->orderBy('plan_id', 'DESC') ////////////////////////////
					->first();

		return $plans->slug;
	}

	public function getOffers(User $user)
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

	public function getCertifications(User $user)
	{
		$user_certifications = $user->user_certifications()->get();
		return $user_certifications;
	}

	public function getCategories(User $user)
	{
		$categories = $user->categories()->get();
		return $categories;
	}

	public function getRating(User $user)
	{
		$data = [
			'value' => $user->ratings()->avg('value'),
			'amount' => $user->ratings()->count(),
			'show' => $user->ratings()->count() > 5 ? true : false,
		];

		return $data;
	}

	public function getMediaData(User $user)
	{
		$images = $user->images()->get();
		$videos = $user->videos()->get();

		return [
			'images' => $images,
			'videos' => $videos
		];
	}
}

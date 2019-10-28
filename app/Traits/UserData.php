<?php

namespace App\Traits;
use App\User;
/**
 * Funciones comunes para los controladores
 */
trait UserData
{
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use League\Flysystem\File;

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
			'media_data' => $this->getMediaData($user),
		];

        return view('profile', compact('data'));
	}
	
	 public function update(Request $request)
    {
		$updatedUser = Auth::user();
		$updatedUser->name = $request->name;
		$updatedUser->commercial_name = $request->commercial_name;
		$updatedUser->description = $request->description;
		$updatedUser->phone = $request->phone;
		$updatedUser->save();

		if (sizeof($request->user_categories) < 6)
		{
			$categories_id = array();
			foreach ($request->user_categories as $user_category)
			{
				array_push($categories_id, $user_category['id']);
			}
			
			$updatedUser->categories()->detach();
			$updatedUser->categories()->attach($categories_id);

			$data = array(
				'status' => 'success',
				'code' => 200,
				'message' => 'Los datos se han actualizado correctamente',
			);
		}
		else
		{
			$data = array(
				'status' => 'error',
				'code' => 400,
				'message' => 'Esta ingresando más de 5 categorias',
			);
		}
		
		return response()->json($data, $data['code']);
	}
	
	public function uploadProfileImage(Request $request)
	{
		$image = $request->file('image');

		/* if ($image) {
			$image_name = time().$image->getClientOriginalName();
			\Storage::disk('users')->put($image_name, File::get($image));

			$data = array(
				'image' => $image_name,
				'code' => 200,
				'status' => 'success',

			);
		} else {
			$data = array(
				'code' => 400,
				'status' => 'error',
				'message' => 'Error al subir imagen',
			);
		}

		return response()->json($data, $data['code']); */

		return $image;
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

	private function getCertifications($user)
	{
		$user_certifications = $user->user_certifications()->get();
		return $user_certifications;
	}

	private function getMediaData($user)
	{
		$images = $user->images()->get();
		$videos = $user->videos()->get();

		return [
			'images' => $images,
			'videos' => $videos
		];
	}
}

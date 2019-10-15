<?php

namespace App\Http\Controllers;

use App\Image;
use App\Message;
use App\Offer;
use App\OfferCertfication;
use App\Operation;
use App\User;
use App\UserCertfication;
use App\Video;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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

	// Panel info section

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

	public function uploadUserImage(Request $request, $type)
	{
		$user = Auth::user();
		$image = $request->file('image');
		\FB::log(filesize($image));

		if ($image) {
			if (filesize($image) <= 2097152) {
				if ($type == 1) {
					$image_name = time().'-'.$user->slug.'.'.$image->getClientOriginalExtension();
					$request->image->move(storage_path('app/public/profile-img/'), $image_name);

					$image_path = '/'.'storage/profile-img/'.$image_name;
					$user->profile_img = $image_path;
				} else if ($type == 2) {
					$image_name = time().'-'.$user->slug.'.'.$image->getClientOriginalExtension();
					$request->image->move(storage_path('app/public/cover-img/'), $image_name);

					$image_path = '/'.'storage/cover-img/'.$image_name;
					$user->cover_img = $image_path;
				}
				$user->save();

				$data = array(
					'code' => 200,
					'status' => 'success',
					'message' => 'Imagen actualizada correctamente',
				);
			} else {
				$data = array(
					'code' => 401,
					'status' => 'error',
					'message' => 'La imagen debe pesa menos de 2 MB'
				);
			}
		} else {
			$data = array(
				'code' => 400,
				'status' => 'error',
				'message' => 'Error al subir imagen',
			);
		}

		return response()->json($data, $data['code']);
	}

	public function addAccountImage(Request $request) {

		$user = Auth::user();
		$image = $request->file('image');

		if ($image) {

			//$list_images = $user->images()->get();

			// Definir el nuevo nomber de la imagen
			$image_name = time().'-'.$user->slug.'.'.$image->getClientOriginalExtension();
			$request->image->move(storage_path('app/public/account-img/'), $image_name);

			$image_path = '/'.'storage/account-img/'.$image_name;

			$account_img = new Image();
			$account_img->name_file = $image_name;
			$account_img->url = $image_path;
			$account_img->user_id = $user->id;

			$account_img->save();

			$data = array(
				'code' => 200,
				'status' => 'success',
				'message' => 'Imagen agregada correctamente',
				'data' => $account_img,
			);
		} else {
			$data = array(
				'code' => 400,
				'status' => 'error',
				'message' => 'Error al subir imagen',
			);
		}

		return response()->json($data, $data['code']);
	}

	public function deleteAccountImage(Request $request, $id)
	{
		$image = Image::findOrFail($id);

		if ($image) {

			Storage::disk('public')->delete('account-img/'.$image->name_file);

			DB::table('images')->where('id', $id)->delete();

			$data = array(
				'code' => 200,
				'status' => 'success',
				'message' => 'Imagen borrada correctamente',
			);
		} else {
			$data = array(
				'code' => 400,
				'status' => 'error',
				'message' => 'Error al borrar imagen',
 			);
		}

		return response()->json($data, $data['code']);
	}

	public function addAccountVideo(Request $request)
	{
		$user = Auth::user();
		$video = $request->file('video');

		if ($video) {

			//$list_images = $user->images()->get();

			// Definir el nuevo nomber de la imagen
			$video_name = time().'-'.$user->slug.'.'.$video->getClientOriginalExtension();
			$request->video->move(storage_path('app/public/account-video/'), $video_name);

			$video_path = '/'.'storage/account-video/'.$video_name;

			$account_video = new Video();
			$account_video->name_file = $video_name;
			$account_video->url = $video_path;
			$account_video->user_id = $user->id;

			$account_video->save();

			$data = array(
				'code' => 200,
				'status' => 'success',
				'message' => 'Video agregado correctamente',
			);
		} else {
			$data = array(
				'code' => 400,
				'status' => 'error',
				'message' => 'Error al subir imagen',
			);
		}

		return response()->json($data, $data['code']);
	}

	public function deleteAccountVideo(Request $request, $id)
	{
		$video = Video::findOrFail($id);

		if ($video) {

			Storage::disk('public')->delete('account-video/'.$video->name_file);

			DB::table('videos')->where('id', $id)->delete();

			$data = array(
				'code' => 200,
				'status' => 'success',
				'message' => 'Video borrado correctamente',
			);
		} else {
			$data = array(
				'code' => 400,
				'status' => 'error',
				'message' => 'Error al borrar video',
 			);
		}

		return response()->json($data, $data['code']);
	}

	// Offer Section

	public function addProduct(Request $request)
	{
		$user = Auth::user();
		$operation = Operation::find(2);

		if ($operation->coins_cost <= $user->coins) {
			$image = $request->file('image');

			if ($image) {
				$image_name = time() . '-' . $user->slug . '.' . $image->getClientOriginalExtension();
				$request->image->move(storage_path('app/public/offer-img/'), $image_name);
				$image_path = '/'.'storage/offer-img/'.$image_name;

				$offer = new Offer();
				$offer->title = $request->title;
				$offer->category_id = $request->category_id;
				$offer->name_file = $image_name;
				$offer->image_url = $image_path;
				$offer->user_id = $user->id;
				$offer->save();

				$user->coins = $user->coins - $operation->coins_cost;
				$user->save();

				$message = new Message();
				$message->title = 'Producto agregado';
				$message->message = 'El producto fue agregado satisfactoriamente. Se han consumido ' . $operation->coins_cost . ' de tus coins.';
				$message->date = Carbon::now();
				$message->user_id = $user->id;
				$message->save();

				$data = array(
					'code' => 200,
					'status' => 'success',
					'message' => 'Producto ingresado correctamente'
				);
			} else {
				$data = array(
					'code' => 401,
					'status' => 'error',
					'message' => 'Ingrese una imagen para esta oferta'
				);
			}
		} else {
			$data = array(
				'code' => 403,
				'status' => 'error',
				'message' => 'No cuenta con los coins necesarios'
			);
		}

		return response()->json($data, $data['code']);
	}

	public function deleteProduct(Request $request, $id)
	{
		$user = Auth::user();
		$offer = Offer::find($id);

		if ($offer->user_id == $user->id) {
			Storage::disk('public')->delete('offer-img/'.$offer->name_file);
			DB::table('offers')->where('id', $id)->delete();

			$data = array(
				'code' => 200,
				'status' => 'success',
				'message' => 'Producto borrado correctamente',
			);
		} else {
			$data = array(
				'code' => 401,
				'status' => 'error',
				'message' => 'Error al borrar producto',
			);
		}

		return response()->json($data, $data['code']);
	}

	public function editProduct(Request $request, $id) {
		$user = Auth::user();
		$offer = Offer::find($id);

		if ($offer->user_id == $user->id) {

			$offer->title = $request->title;
			$offer->category_id = $request->category_id;

			$image = $request->file('image');

			if ($image) {
				Storage::disk('public')->delete('offer-img/'.$offer->name_file);
				$image_name = time() . '-' . $user->slug . '.' . $image->getClientOriginalExtension();
				$request->image->move(storage_path('app/public/offer-img/'), $image_name);
				$image_path = '/'.'storage/offer-img/'.$image_name;

				$offer->image_url = $image_path;
				$offer->save();

				$data = array(
					'code' => 200,
					'status' => 'success',
					'message' => 'Producto editado correctamente (con imagen)'
				);
			} else {
				$offer->save();
				$data = array(
					'code' => 200,
					'status' => 'success',
					'message' => 'Producto editado correctamente (sin imagen)'
				);
			}

		} else {
			$data = array(
				'code' => 401,
				'status' => 'error',
				'message' => 'Error al editar producto'
			);
		}
		return response()->json($data, $data['code']);
	}

	public function addProductCert(Request $request)
	{
		$user = Auth::user();
		$file = $request->file('file');
		$operation = Operation::find(3);

		if ($user->coins >= $operation->coins_cost) {
			if ($file) {
	
				$file_name = time() . '-' . $user->slug . '.' . $file->getClientOriginalExtension();
				$request->file->move(storage_path('app/public/offer-cert/'), $file_name);
				$file_path = '/'.'storage/offer-cert/'.$file_name;
	
				$offer_cert = new OfferCertfication();
				$offer_cert->title = $request->title;
				$offer_cert->offer_id = $request->offer_id;
				$offer_cert->name_file = $file_name;
				$offer_cert->url = $file_path;
				$offer_cert->save();

				$user->coins = $user->coins - $operation->coins_cost;

				$message = new Message();
				$message->title = 'Certificado de producto agregado';
				$message->message = 'El certificado fue agregado satisfactoriamente. Se han consumido ' . $operation->coins_cost . ' de tus coins.';
				$message->date = Carbon::now();
				$message->user_id = $user->id;
				$message->save();
	
				$data = array(
					'code' => 200,
					'status' => 'success',
					'message' => 'Certificado agregado correctamente',
				);
			} else {
				$data = array(
					'code' => 401,
					'status' => 'error',
					'message' => 'No se ha seleccionado un archivo'
				);
			}
		} else {
			$data = array(
				'code' => 403,
				'status' => 'error',
				'message' => 'No cuenta con los coins suficiente'
			);
		}


		return response()->json($data, $data['code']);
	}

	public function editProductCert(Request $request, $id)
	{
		$user = Auth::user();
		$offer_cert = OfferCertfication::find($id);
		$offer = Offer::find($offer_cert->offer_id);
		$file = $request->file('file');

		if ($offer->user_id == $user->id) {

			$offer_cert->title = $request->title;

			if ($file) {
				Storage::disk('public')->delete('offer-cert/'.$offer_cert->name_file);
				$file_name = time() . '-' . $user->slug . '.' . $file->getClientOriginalExtension();
				$request->file->move(storage_path('app/public/offer-cert/'), $file_name);
				$file_path = '/'.'storage/offer-cert/'.$file_name;

				$offer_cert->name_file = $file_name;
				$offer_cert->url = $file_path;
				$offer_cert->save();

				$data = array(
					'code' => 200,
					'status' => 'success',
					'message' => 'Certificado editado correctamente (con pdf)',
				);
			} else {
				$offer_cert->save();

				$data = array(
					'code' => 200,
					'status' => 'success',
					'message' => 'Certificado editado correctamente (sin pdf)',
				);
			}

		} else {
			$data = array(
				'code' => 401,
				'status' => 'error',
				'message' => 'Error al editar certificado',
			);
		}

		return response()->json($data, $data['code']);
	}

	public function deleteProductCert($id)
	{
		$user = Auth::user();
		$offer_cert = OfferCertfication::find($id);
		$offer = Offer::find($offer_cert->offer_id);

		if ($offer->user_id == $user->id) {

			Storage::disk('public')->delete('offer-cert/'.$offer_cert->name_file);
			DB::table('offer_certfications')->where('id', $id)->delete();

			$data = array(
				'code' => 200,
				'status' => 'success',
				'message' => 'Certificado borrado correctamente'
			);
		} else {
			$data = array(
				'code' => 403,
				'status' => 'error',
				'message' => 'No esta autorizado para realizar esta acción'
			);
		}

		return response()->json($data, $data['code']);
	}

	// Cert section

	public function addCert(Request $request)
	{
		$user = Auth::user();
		$file = $request->file('file');
		$operation = Operation::find(3);

		if ($operation->coins_cost <= $user->coins) {
			if ($file) {
				$file_name = time() . '-' . $user->slug . '.' . $file->getClientOriginalExtension();
				$request->file->move(storage_path('app/public/user-cert/'), $file_name);
				$file_path = '/'.'storage/user-cert/'.$file_name;

				$user_cert = new UserCertfication();
				$user_cert->title = $request->title;
				$user_cert->url = $file_path;
				$user_cert->name_file = $file_name;
				$user_cert->user_id = $user->id;
				$user_cert->save();

				$message = new Message();
				$message->title = 'Certificado agregado';
				$message->message = 'El certificado fue agregado satisfactoriamente. Se han consumido ' . $operation->coins_cost . ' de tus coins.';
				$message->date = Carbon::now();
				$message->user_id = $user->id;
				$message->save();

				$user->coins = $user->coins - $operation->coins_cost;
				$user->save();

				$data = array(
					'code' => 200,
					'status' => 'success',
					'message' => 'Se ha agregado el certificado',
				);
			} else {
				$data = array(
					'code' => 400,
					'status' => 'error',
					'message' => 'Error al agregar certificado. No has seleccionado un archivo'
				);
			}
		} else {
			$data = array(
				'code' => 401,
				'status' => 'error',
				'message' => 'No cuentas con coins suficientes'
			);
		}
		return response()->json($data, $data['code']);
	}

	public function editCert(Request $request, $id)
	{
		$user = Auth::user();
		$user_cert = UserCertfication::find($id);

		if ($user->id == $user_cert->user_id) {

			$user_cert->title = $request->title;
			$file = $request->file('file');
			if ($file) {

				Storage::disk('public')->delete('user-cert/'.$user_cert->name_file);
				$file_name = time() . '-' . $user->slug . '.' . $file->getClientOriginalExtension();
				$request->file->move(storage_path('app/public/user-cert/'), $file_name);
				$file_path = '/'.'storage/user-cert/'.$file_name;

				$user_cert->name_file = $file_name;
				$user_cert->url = $file_path;
				$user_cert->save();

				$data = array(
					'code' => 200,
					'status' => 'success',
					'message' => 'Certificado actualizado correctamente (con pdf)'
				);
			} else {
				$user_cert->save();

				$data = array(
					'code' => 200,
					'status' => 'success',
					'message' => 'Certificado actualizado correctamente (sin pdf)'
				);
			}
		} else {
			$data = array(
				'code' => 403,
				'status' => 'error',
				'message' => 'Error al editar imagen'
			);
		}

		return response()->json($data, $data['code']);
	}

	public function deleteCert($id)
	{
		$user = Auth::user();
		$user_cert = UserCertfication::find($id);

		if ($user->id == $user_cert->user_id) {

			Storage::disk('public')->delete('user-cert/'.$user_cert->name_file);
			DB::table('user_certfications')->where('id', $id)->delete();

			$data = array(
				'code' => 200,
				'status' => 'success',
				'message' => 'Se ha borrado el certificado',
			);
		} else {
			$data = array(
				'code' => 400,
				'status' => 'error',
				'message' => 'Error al borrar el certificado'
			);
		}
		return response()->json($data, $data['code']);
	}

	// Meet section

	public function updateContactInfo(Request $request) {
		$user = Auth::user();

		if ($user->id == $request->user_id) {
			$user->hangouts_url = $request->hangouts_url;
			$user->skype_url = $request->skype_url;
			$user->save();

			$data = array(
				'code' => 200,
				'status' => 'success',
				'message' => 'Datos actualizado correctamente'
			);
		} else{
			$data = array(
				'code' => 403,
				'status' => 'success',
				'message' => 'Error al actualizar datos'
			);
		}

		return response()->json($data, $data['code']);
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

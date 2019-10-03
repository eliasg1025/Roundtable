<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		/* $updatedUser = User::find($id);
		$updatedUser->name = $request->name;
		$updatedUser->commercial_name = $request->commercial_name;
		$updatedUser->description = $request->description;
		$updatedUser->email = $request->email;
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
				'message' => 'Los datos se han actualizado correctamente'
			);
		}
		else
		{
			$data = array(
				'status' => 'error',
				'code' => 400,
				'message' => 'Esta ingresando más de 5 categorias'
			);
		}
		return response()->json($data, $data['code']); */
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

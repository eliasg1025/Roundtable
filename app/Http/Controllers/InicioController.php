<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

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
            'moreViewedCompanies' => $this,
            'categories' => $this->getCategories(),
        ];
        return view('inicio', compact('data'));
    }

    public function getBuyers()
    {
        $users = App\User::where('type_id', 2)->get();
        return $users;
    }

    public function getSellers()
    {
        $users = App\User::where('type_id', 1)->get();
        return $users;
    }

    public function getMoreViewedCompanies()
    {
        $users = App\User::where('view', '')->get();
    }

    public function getCategories()
    {
        $categories = App\Category::all();
        return $categories;
    }
}

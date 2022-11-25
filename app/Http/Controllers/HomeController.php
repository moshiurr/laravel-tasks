<?php

namespace App\Http\Controllers;

use App\Models\TrademarkCategories;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $cats = TrademarkCategories::all();

        return view('home')->with('cats',$cats);
    }
}

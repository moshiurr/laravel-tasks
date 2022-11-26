<?php

namespace App\Http\Controllers;

use App\Models\Trademark;
use App\Models\TrademarkCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $trades = Trademark::orderBy('id','DESC')->paginate(10);

        return view('home')->with('trademarks',$trades);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function viewYourTrademark()
    {

        $trades = Trademark::where('owner_id', Auth::id())->paginate(10);

        return view('viewYourTrademark')->with('trademarks',$trades);
    }

    public function delete($id, Request $request)
    {
        error_log('INFO: delete /trademark/'.$id);
        Trademark::findOrFail($id)->delete();

        $request->session()->flash('status', 'Trademark deleted successfully!');
        return redirect('/viewYourTrademark');
    }

    public function search(Request $request)
    {
        $trades = Trademark::where('owner_id', Auth::id())->where('trademark_name','Like', '%'.$request['search'].'%')->paginate(10);

        return view('viewYourTrademark')->with('trademarks',$trades);
    }

    public function searchAll(Request $request)
    {
        $trades = Trademark::where('trademark_name','Like', '%'.$request['search'].'%')->paginate(10);

        return view('home')->with('trademarks',$trades);
    }
}

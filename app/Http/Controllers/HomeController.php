<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterTradeRequest;
use App\Models\FavoriteTrademark;
use App\Models\Trademark;
use App\Models\TrademarkCategories;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

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
        $favTrades = FavoriteTrademark::select('trademark_id')->where('owner_id',Auth::id())->get()->pluck('trademark_id')->toArray();

        return view('home')->with('trademarks',$trades)->with('favTrades',$favTrades);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function viewTrademark()
    {
        $trade = Trademark::where('owner_id', Auth::id())->first();

        return view('viewTrademark')->with('trademark',$trade);
    }

    public function viewOtherTrademark($id, Request $request)
    {
        $trade = Trademark::findOrFail($id);
        $favTrades = FavoriteTrademark::select('trademark_id')->where('owner_id',Auth::id())->get()->pluck('trademark_id')->toArray();

        return view('viewTrademark')->with('trademark',$trade)->with('favTrades',$favTrades);
    }



    public function viewFavTrademark()
    {
        $trades = FavoriteTrademark::where('owner_id', Auth::id())->paginate(10);

        return view('viewFavTrademark')->with('favTrademarks',$trades);
    }

    public function getRegisterTrade()
    {
        $categories = TrademarkCategories::all();

        return view('registerTrade')->with('categories',$categories);
    }

    public function registerTrade(RegisterTradeRequest $request)
    {
        $isExist = Trademark::where('owner_id', Auth::id())->first();

        if($isExist){
            $request->session()->flash('failed', 'You have already registered your trademark.');
            return redirect('/register-trade');
        }

        $isCreatedByOther = Trademark::where('trademark_name',$request['trademark_name'])
                            ->where('category_id',$request['category_id'])
                            ->where('expiration','>',Carbon::now())
                            ->first();

        if($isCreatedByOther){
            $request->session()->flash('failed', 'A trademark is already registered for this name and category, and is not expired.');
            return redirect('/register-trade');
        }

        Trademark::create($request->validated());
        $request->session()->flash('status', 'Trademark registered successfully!');
        return redirect('/home');


    }

    public function delete($id, Request $request)
    {
        error_log('INFO: delete /trademark/'.$id);
        Trademark::findOrFail($id)->delete();

        $request->session()->flash('status', 'Trademark deleted successfully!');
        return redirect('/viewTrademark');
    }

    public function addFavorite($id, Request $request)
    {
        FavoriteTrademark::create([
            'owner_id' => Auth::id(),
            'trademark_id' => $id
        ]);

        $request->session()->flash('status', 'Trademark added to your favourite list successfully!');

        if(isset($request['type']) && $request['type'] == 'view') return redirect('/view-trademark/'.$id);
        return redirect('/home');

    }

    public function deleteFavorite($id, Request $request)
    {
        FavoriteTrademark::where('trademark_id', $id)->first()->delete();

        $request->session()->flash('removed', 'Trademark removed from your favourite list successfully!');

        if(isset($request['type']) && $request['type'] == 'fav') return redirect('/viewFavTrademark');
        else if(isset($request['type']) && $request['type'] == 'view') return redirect('/view-trademark/'.$id);
        return redirect('/home');
    }

    public function search(Request $request)
    {
        $trades = Trademark::where('owner_id', Auth::id())->where('trademark_name','Like', '%'.$request['search'].'%')->paginate(10);

        $favTrades = FavoriteTrademark::select('trademark_id')->where('owner_id',Auth::id())->get()->pluck('trademark_id')->toArray();

        return view('viewTrademark')->with('trademarks',$trades)->with('favTrades',$favTrades);
    }

    public function searchAll(Request $request)
    {
        $trades = Trademark::where('trademark_name','Like', '%'.$request['search'].'%')->paginate(10);
        $favTrades = FavoriteTrademark::select('trademark_id')->where('owner_id',Auth::id())->get()->pluck('trademark_id')->toArray();

        return view('home')->with('trademarks',$trades)->with('favTrades',$favTrades);
    }

}

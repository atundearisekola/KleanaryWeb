<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Laundry;
use App\PerfumeList;
use App\StarchList;
use App\KleanaryList;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $klists = new KleanaryList();
        $klists= $klists->List();
        $pls = Laundry::where([['user_id',Auth::user()->id],['lstatus','!=','Delivered']])->orderBy('created_at', 'DESC')->simplePaginate(10);
        $lhs = Laundry::where([['user_id',Auth::user()->id],['lstatus','=','Delivered']])->orderBy('created_at', 'DESC')->simplePaginate(10);
        return view('home',['pls'=>$pls, 'lhs'=>$lhs, 'klists'=>$klists]);
    }

    public function accountsetup()
    {
        $klists = new KleanaryList();
        $klists= $klists->List();
        return view('auth.accountsetup',['klists'=>$klists]);
    }
     public function accountupdate(Request $request)
    {
        $user = Auth::user();
        $user->name= $request['name'];
        $user->phone= $request['phone'];
        $user->phone= $request['phone'];
        $user->gender= $request['gender'];
        $user->addr= $request['addr'];
        $user->localgov= $request['localgov'];
        $user->state= $request['state'];
        $user->country= $request['country'];
        
        if ( $user->update()) {
            return redirect()->route('home')->with(['msg'=>'successfully done']);
        };

    }

    public function getfavorite()
    {
        $klists = new KleanaryList();
        $klists= $klists->List();
        return view('auth.favorite',['klists'=>$klists]);
    }

      public function addfavorite(Request $request)
    {
        $user = Auth::user();
        
        $user->favstarch= $request['favstarch'];
        $user->favperf= $request['favperf'];
        if ( $user->update()) {
            return redirect()->route('home')->with(['msg'=>'successfully done']);
        };
    }


     public function RequestV()
    {
        $klists = new KleanaryList();
        $klists= $klists->List();
        return view('request',['klists'=>$klists]);
    }

    
}

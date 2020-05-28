<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Useradmin;
use App\Laundry;
use App\Branch;

class AdminController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
        
    }

    public function showRegistrationForm()
    {
        return view('auth.admin.register');
    }


    public function register(Request $request)
    {
    	$this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:useradmins',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $useradmin = new Useradmin();
        $useradmin->name = $request['name'];
        $useradmin->email = $request['email'];
        $useradmin->password = bcrypt($request['password']);
        $useradmin->phone = $request['phone'];
        $useradmin->addr = $request['addr'];
        $useradmin->country = $request['country'];
        $useradmin->state = $request['state'];
        $useradmin->localgov = $request['localgov'];
        $useradmin->save();
        Auth::login($useradmin);
    }

    public function ShowRequestedLaundry()
    {
         $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('admin')->user();
        $requestedlaundry = Laundry::where('lstatus','waiting')->orderBy('created_at', 'DESC')->simplePaginate(10);
        
        return view('Admin.adminview',['rls'=>$requestedlaundry]);
    }
      public function viewlaundry($id)
    {
        $singlelaundry = Laundry::where('id',$id)->first();
        $branch = Branch::all();
        
        return view('Admin.singlerequest',['singlel'=>$singlelaundry, 'pickers'=>$branch]);
    }


    public function confirmrequest(Request $request)
    {
        $this->validate($request, [
            'country' => 'required|string',
            'state' => 'required|string',
             'localgov' => 'required|string',
            'addr' => 'required|string',
             'id' => 'required|integer',
            'shortnote' => 'required|string',
            'picker' => 'required|string',
           
        ]);
        $laundry =  Laundry::find($request['id']);
        $laundry->country = $request['country'];
        $laundry->state = $request['state'];
        $laundry->localgov = $request['localgov'];
        $laundry->addr = $request['addr'];
        $laundry->shortnote = $request['shortnote'];
        $laundry->picker = $request['picker'];
        $laundry->lstatus = $request['lstatus'];
       
       
        if ( $laundry->update()) {
            return redirect()->route('requestedlaundry')->with(['msg'=>'successfully done']);
        };
        
    }
    public function accountsetup()
    {
        return view('admin.accountsetup');
    }
 public function accountupdate(Request $request)
    {
        $user = Auth::guard('branchadmin')->user();
        $user->name= $request['name'];
        $user->phone= $request['phone'];
        $user->addr= $request['addr'];
        $user->localgov= $request['localgov'];
        $user->state= $request['state'];
        $user->country= $request['country'];
        
        if ( $user->update()) {
            return redirect()->route('home')->with(['msg'=>'successfully done']);
        };

    }


   


 /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }


}

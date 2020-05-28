<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Admin;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class BranchController extends Controller
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

     public function showBranchForm()
    {
        return view('Admin.branch');
    }


    public function addbranch(Request $request)
    {
    	$this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            
        ]);
        $branch = new Branch();
        $branch->branchname = $request['name'];
        $branch->email = $request['email'];
        

        $branch->phone = $request['phone'];
        $branch->addr = $request['addr'];
        $branch->country = $request['country'];
        $branch->state = $request['state'];
        $branch->localgov = $request['localgov'];
        $branch->user_id = Auth::guard('admin')->user();
         
          if ($branch->save()) {
              return redirect()->route('branchform')->with(['msg'=>'successfully done']);
          }
       
    }
    public function accountsetup()
    {
        return view('branchadmin.accountsetup');
    }
 public function accountupdate(Request $request)
    {
        $user = Branchadmin::guard('branchadmin')->user();
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

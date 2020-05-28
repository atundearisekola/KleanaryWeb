<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Branchadmin;
use App\Laundry;
use App\Picker;

use Illuminate\Http\Request;

class PickerController extends Controller
{
	 /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('branchadmin');
        
    }

      public function ShowTobepickLaundry()
    {
        $tobepicklaundry = Laundry::where([['picker',Auth::guard('branchadmin')->user()->branch ],['lstatus','confirmed']])->orderBy('created_at', 'DESC')->simplePaginate(50);
        
        return view('Admin.pickups',['pickls'=>$tobepicklaundry]);
    }

     public function viewpickuplaundry($id)
    {
        $pickuplaundry = Laundry::where('id',$id)->first();
        
        
        return view('Admin.singlepickup',['singlep'=>$pickuplaundry]);
    }


        public function picklaundry($id)
    {
        $picker = new Picker();
        $picklaundry = Laundry::where('id','=',$id)->first();
        if ($picklaundry->picker == Auth::guard('branchadmin')->user()->branch) {
            $picker->laundry = $id;
            $picker->txref = $picklaundry->txref;
            $picker->totalnum =$picklaundry->totalnum; 
            $picker->totalprice =$picklaundry->totalprice; 
            $picker->worker= Auth::guard('branchadmin')->user()->id;
            $picker->branch = Auth::guard('branchadmin')->user()->branch;
            $picker->lstatus = 'picked';
            if ($picker->save()) {
                $picklaundry->lstatus = 'picked';
            $picklaundry->update();
            return redirect()->route('pickedlaundry');
            }
            


        }
        
        
        return redirect()->back();
    }

         public function deliverlaundry($id)
    {
        $picker = Picker::where('id',$id)->first();
        $picklaundry = Laundry::where('id',$id)->first();
        if ($picklaundry->picker = Auth::guard('branchadmin')->user()->branch) {
            
            $picker->lstatus = 'delivered';
            $picker->update();
            $picklaundry->lstatus = 'delivered';
            $picklaundry->update();
            
        }
        
        
        return redirect()->back();
    }

      public function ShowpickedLaundry()
    {
        $pickedlaundry = Picker::where([['branch',Auth::guard('branchadmin')->user()->branch ], ['lstatus','picked']])->orderBy('created_at', 'DESC')->simplePaginate(10);
       
        return view('Admin.picked_up',['pickls'=>$pickedlaundry]);
    }

      public function ShowDeliveryLaundry()
    {
        $pickedlaundry = Picker::where([['branch',Auth::guard('branchadmin')->user()->branch ], ['lstatus','delivered']])->orderBy('created_at', 'DESC')->simplePaginate(10);
        
        return view('Admin.delivered',['pickls'=>$pickedlaundry]);
    }


    public function ShowSearchLaundry(Request $request)
    {
        $this->validate($request, [
            'search' => 'required|string',
        ]);
        $laundry = Laundry::where('txref',$request['search'])->get();
      return view('Admin.singlepickup',['singlep'=>$laundry->id]);
        
        
    }

     /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('branchadmin');
    }

    
}

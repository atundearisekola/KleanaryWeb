<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use App\User;

class UserController extends Controller
{
    public function show(Request $request, $userId)
    {
        $user = User::find($userId);

        if($user) {
            return response()->json($user);
        }

        return response()->json(['message' => 'User not found!'], 404);
    }

     public function accountupdate(Request $request)
    {

        if ($user = Auth::user()) {
        $user->fname= $request['fname'];   
        $user->lname= $request['lname'];
        $user->phone= $request['phone'];
        $user->phone= $request['phone'];
        $user->gender= $request['gender'];
        $user->addr= $request['addr'];
        $user->localgov= $request['localgov'];
        $user->state= $request['state'];
        $user->country= $request['country'];
        
        if ( $user->update()) {
            return response()->json(['msg'=>'successfully done','user'=>$user,]);
        }else{
            return response()->json(['msg'=>'fuckup'], 404);
        }
        }else{
             return response()->json(['msg'=>'fuckup'], 404);
        }
       

    }

     public function addfavorite(Request $request)
    {
        $user = Auth::user();
        $starch= $request->input('favstarch');
        $starchname = $starch['starchname'];
        $starchprice = $starch['starchprice'];
        $s = ['starchname'=>$starchname, 'starchprice'=>$starchprice];
        $user->favstarch= $s;
        $user->favperf= $request->input('favperf');
        if ( $user->update()) {
            
             return response()->json(['msg'=>'successfully done','user'=>$user],200);
        };
    }


    public function logout()
    {
      $user = Auth::user()->token();
      $user->revoke();
      return  response()->json("loggedout");
    }

    public function auth()
    {
         $token = Auth::user()->token();
        return response()->json(['user'=>auth()->user(),'token'=>$token],200);
    }

     public function getLists()
    {
        $perflist = new PerfumeList();
        $perflist= $perflist->List();
         $starlist = new StarchList();
         $starlist = $starlist->List();
          $klists = new KleanaryList();
        $klists= $klists->List();
        return response()->json(['klists'=>$klists, 'starchlists'=>$starlist, 'perfumelists'=>$perflist]);
    }



}

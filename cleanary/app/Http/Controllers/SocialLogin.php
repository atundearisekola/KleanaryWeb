<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;

class SocialLogin extends Controller
{


	 protected $redirectTo = '/home';

	     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProvider($driver)
    {
        return Socialite::driver($driver)->redirect();
    }


    public function handleProviderCallback($driver)
    {
        $usersocial= Socialite::driver($driver)->user();
         $authUser = $this->findOrCreateUser($user, $provider);
        Auth::login($authUser, true);
        return redirect($this->redirectTo);

       
        
    }


     /**
     * If a user has registered before using social auth, return the user
     * else, create a new user object.
     * @param  $user Socialite user object
     * @param $provider Social auth provider
     * @return  User
     */
    public function findOrCreateUser($user, $driver)
    {
        $authUser = User::where('provider_id', $user->id)->first();
        if ($authUser) {

        	$path = '/users/'. $authUser->id.'/limage';
            if (! Storage::exists($path)) {
            Storage::makeDirectory($path, $mode = 0777, true, true);
            return $authUser;
        }
        $newuser = User::create([
            'name'     => $user->name,
            'email'    => $user->email,
            'password' => bcrypt(1234567890),
            'provider' => $driver,
            'provider_id' => $user->id
        ]);

            $path = '/users/'. $newuser->id.'/limage';
            if (! Storage::exists($path)) {
            Storage::makeDirectory($path, $mode = 0777, true, true);

        }

        return $newuser;
    }
    }


  protected function guard()
    {
        return Auth::guard('user');
    }


}

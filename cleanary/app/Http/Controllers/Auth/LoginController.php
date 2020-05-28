<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
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

    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }


    public function handleProviderCallback()
    {
        $usersocial= Socialite::driver('facebook')->user();

        $fuser = User::where('email',$usersocial->email)->first();
        if ($fuser <=0) {
            $user = new User();
            $user->name = $usersocial->name;
             $user->email = $usersocial->email;
             $user->password = bcrypt(1234567890);
             $user->save();
             Auth::login($user);
             return 'done';
        }else{
            Auth::login($fuser);
             return 'done';
        }
        
    }


    

     protected function guard()
    {
        return Auth::guard('user');
    }

   
}

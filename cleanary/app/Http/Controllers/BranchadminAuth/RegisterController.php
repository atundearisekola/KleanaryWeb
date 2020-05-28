<?php

namespace App\Http\Controllers\BranchadminAuth;

use App\Branchadmin;
use App\Branch;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/branchadmin/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:branchadmins',
            'password' => 'required|min:6|confirmed',
            'branch' => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return Branchadmin
     */
    protected function create(array $data)
    {
        $branchadmin= Branchadmin::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'branch' => $data['branch'],
            'password' => bcrypt($data['password']),
        ]);
        if ($branchadmin) {
            $path = '/branchadmins/'. $branchadmin->id.'/limage';
            if (! Storage::exists($path)) {
            Storage::makeDirectory($path, $mode = 0777, true, true);
        }
            return $branchadmin;
        }
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        $branchs = Branch::all();
        return view('branchadmin.auth.register',['branchs'=>$branchs]);
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

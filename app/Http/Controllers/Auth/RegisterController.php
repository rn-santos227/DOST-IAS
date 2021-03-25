<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
     * Where to redirect users after registration.
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
        $this->middleware('guest');
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
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'nickname' => 'required|string|max:255',
            'agency' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'aemail' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'title' => $data['title'],
            'name' => $data['name'],
            'username' => $data['username'],
            'nickname' => $data['nickname'],
            'email' => $data['email'],
            'agency' => $data['agency'],
            'position' => $data['position'],
            'agency_email' => $data['aemail'],
            'contact' => $data['contact'],
            'role' => ' ',
            'password' => bcrypt($data['password']),
        ]);
    }
}

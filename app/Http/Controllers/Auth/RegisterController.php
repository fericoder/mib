<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
        foreach($data as $key => $value)
        {
            $data['mobile'] = $this->fa2en($data['mobile']);
            $data['pezeshkiNo'] = $this->fa2en($data['pezeshkiNo']);
            $data['moarref'] = $this->fa2en($data['moarref']);
        }


        return Validator::make($data, [
            'mobile' => ['required', 'min:11', 'max:11', 'unique:users'],
            'fName' => ['required', 'string', 'max:255'],
            'lName' => ['required', 'string', 'max:255'],
            'pezeshkiNo' => ['required', 'numeric'],
            'moarref' => ['nullable'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
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
            'mobile' => $this->fa2en($data['mobile']),
            'fName' => $data['fName'],
            'lName' => $data['lName'],
            'pezeshkiNo' => $this->fa2en($data['pezeshkiNo']),
            'email' => $data['email'],
            'moarref' => $this->fa2en($data['moarref']),
            'shop_id' => 1,
            'password' => Hash::make($data['password']),
        ]);
    }
}

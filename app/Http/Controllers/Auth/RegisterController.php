<?php

namespace App\Http\Controllers\Auth;

use App\GameAccount;
use App\Hashing\Sha1Hasher;
use App\Http\Controllers\Controller;
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
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
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        if (GameAccount::query()->where('username', $data['name'])->doesntExist()) {
            GameAccount::query()->create([
                'reg_mail' => $data['email'],
                'email' => $data['email'],
                'username' => $data['name'],
                'sha_pass_hash' => (new Sha1Hasher)->make($data['password'], ['username' => $data['name']]) 
            ]);
        } else {
            GameAccount::query()
                ->where('email', $data['email'])
                ->update([
                    'username' => $data['name'],
                    'sha_pass_hash' => (new Sha1Hasher)->make($data['password'], ['username' => $data['name']]) 
                ]);
        }

        return $user;
    }
}

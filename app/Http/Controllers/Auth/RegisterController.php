<?php

namespace App\Http\Controllers\Auth;

use App\GameAccount;
use App\Hashing\Sha1Hasher;
use App\Http\Controllers\Controller;
use App\RbacPermission;
use App\Realmlist;
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
            'username' => ['required', 'string', 'max:255', 'alpha_num'],
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
        $user = User::query()->create([
            'name' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        if (GameAccount::query()->where('username', $data['username'])->doesntExist()) {
            $account = GameAccount::query()->create([
                'reg_mail' => $data['email'],
                'email' => $data['email'],
                'username' => $data['username'],
                'sha_pass_hash' => (new Sha1Hasher)->make($data['password'], ['username' => $data['username']]) 
            ]);

            Realmlist::query()->each(function ($realm) use ($account) {
                $account->permissions()->create([
                    'realmId' => $realm->id,
                    'permissionId' => 195 // Sec Level: Player
                ]);
            });
        } else {
            GameAccount::query()
                ->where('username', $data['username'])
                ->update([
                    'email' => $data['email'],
                    'reg_mail' => $data['email'],
                    'sha_pass_hash' => (new Sha1Hasher)->make($data['password'], ['username' => $data['username']]) 
                ]);
        }

        return $user;
    }
}

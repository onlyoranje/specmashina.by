<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\BbAdminComments;
use App\Models\Credits_log;

use App\Models\User_credit;
use App\Providers\RouteServiceProvider;
use App\Models\User;
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
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        if (!isset($data['realname'])) $data['realname']=$data['name'];
        $user=User::create([
            'name' => $data['name'],
            'realname' => $data['realname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        systemEmailSend("Зарегистрирован новый пользователь {$user->name}");
        User_credit::create(['user_id'=>$user->id,'credits'=>10]);
        Credits_log::create(['user_id'=>$user->id,'credits'=>10,'description'=>'Зачисление кредитов при регистрации']);
        BbAdminComments::create(['type'=>'new_message','user_id'=>$user->id,'title'=>'Пополнение счета','data'=>'Вам зачислено 10 кредитов за регистрацию']);

        return $user;
    }
}

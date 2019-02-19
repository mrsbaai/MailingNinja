<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\landingController;
use App\Http\Controllers\subscribeController;
use App\user;
use App\role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\fireEmail;

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
    protected $redirectTo = '/welcome';

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
            //'skype' => 'required|string|max:100',
            'country' => 'required|string|max:2',
            //'message' => 'required|string|max:255|min:20',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \app\User
     */


    protected function create(array $data)
    {


        if (isset ($data['code'])){

            $user = new user();
            $user->is_active = true;
            $user->country = $data['country'];
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->password = bcrypt($data['password']);
            $user->save();
            $user->roles()->attach(Role::where('name', 'costumer')->first());

            $subscribe = new subscribeController();
            $subscribe->subscribe($data['code'], $data['email']);
            landingController::addProductToCostumer($data['code'], $user['id']);


            $emailData = array('name'=>$data['name'], 'email'=>$data['email']);
            $subject = "Welcome to " . config('app.name');
            $fire = new fireEmail();
            $fire->fire(true, $data['email'], $emailData,'emails.userRegistred', $subject);

            return $user;

        }else{
            $publisher_manager = user::where('id', $data['manager'])->first();
            $user = new user();
            $user->is_active = false;
            $user->country = $data['country'];
            $user->manager_id = $publisher_manager['id'];
            $user->skype = $data['skype'];
            $user->name = $data['name'];
            $user->message = $data['message'];
            $user->email = $data['email'];
            $user->password = bcrypt($data['password']);
            $user->save();
            $user->roles()->attach(Role::where('name', 'publisher')->first());

            $emailData = array('name'=>$data['name']);
            $subject = "Welcome to " . config('app.home_name');
            $fire = new fireEmail();
            $fire->fire(false, $data['email'], $emailData,'emails.publisherRegistred', $subject);

            $emailData = array('name'=>$data['name'],
                'country'=>$data['country'],
                'skype'=>$data['skype'],
                'email'=>$data['email'],
                'message'=>$data['message'],
                'id'=>$user['id']);

            $fire->fire(false, $publisher_manager['email'], $emailData,'emails.registredToManager', "[New Publisher]");
            return $user;
        }



    }
}

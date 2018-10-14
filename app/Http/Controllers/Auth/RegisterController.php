<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\VerifyUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmail; 
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
         $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
        // create verification coding 
        $verifyuser = new VerifyUser();
        $verifyuser->user_id= $user->id;
        $verifyuser->token = str_random(50);
        $verifyuser->save(); 
        // send by email 
        Mail::to($user->email)->send(new VerifyEmail($user));
           return $user;


    }
    protected function registered(Request $request , $user)
    {
        $this->guard()->logout();
return redirect()->route('login')->with('success','Account created need to be verified , please check your email ');
    }
    public function verifyEmail($token){
$verify_user = VerifyUser::where('token' , $token)->firstOrFail();
if ($verify_user->user->verified){
    return redirect('login')->with('error' , 'OPS , this user is allready verified');
}else {
    $verify_user->user->verified = true ; 
    $verify_user->user->save();
    return redirect('login')->with('success' , 'User has been verified');

}
    }

}

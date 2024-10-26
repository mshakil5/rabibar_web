<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Models\Sendmail;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use DB;

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
            'password' => ['required', 'string', 'min:6'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'mobile' => ['required', 'string', 'max:14','unique:users'],
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
        // dd($data['email']);
        // exit;
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'mobile' => $data['mobile'],
            'referral_id' => $data['reference'],

        
            // mail
            $array['name'] = $data['name'],
            $array['subject'] = Sendmail::where('mailto','=', 'register')->first()->subject,
            $array['from'] = 'info@rabibar.com',

            $email = $data['email'],

            Mail::send('email.register', compact('array'), function($message)use($array,$email) {
            $message->from($array['from'], 'Rabibar.com');
            $message->to($email)->subject($array['subject']);
            }),
        

        ]);
    }


    public function userRegistration(Request $request)
    {

        if(empty($request->name)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Name \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        if(empty($request->email) && empty($request->mobile)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Email or Mobile\" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        if(empty($request->password)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Password \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        if($request->policy == false){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please accept our terms, privacy and policy..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        if(isset($request->email) && isset($request->mobile)){

        $checkUsr = User::where('email', $request->email)->orWhere('mobile', $request->mobile)->first();

        }elseif(isset($request->email) && !isset($request->mobile)){

        $checkUsr = User::where('email', $request->email)->first();    

        }elseif(!isset($request->email) && isset($request->mobile)){

        $checkUsr = User::where('mobile', $request->mobile)->first();

        }

        if($checkUsr){
        $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Your mobile or email already exist.</b></div>";
        return response()->json(['status'=> 303,'message'=>$message]);
        exit();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'mobile' => $request->mobile,
            'referral_id' => $request->reference        
          
        ]);

        
        // mail
        // if(isset($request->email)){

        // $array['name'] = $request->name;
        // $array['subject'] = Sendmail::where('mailto','=', 'register')->first()->subject;
        // $array['from'] = 'info@rabibar.com';

        // $email = $request->email;

        // Mail::send('email.register', compact('array'), function($message)use($array,$email) {
        // $message->from($array['from'], 'Rabibar.com');
        // $message->to($email)->subject($array['subject']);
        // });

            
        // }

        $post = array('password' => $request->password, 'email' => $request->email);
        Auth::loginUsingId($user->id);
       
        $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>User Created Successfully.</b></div>";

        return response()->json(['status'=> 300,'message'=>$message]);

    }
    
}

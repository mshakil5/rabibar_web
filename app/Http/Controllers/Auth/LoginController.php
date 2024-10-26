<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Socialite;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\MobileVerify;
use DB;
use Exception;
use Illuminate\Support\Facades\Auth;

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
    // protected $redirectTo = RouteServiceProvider::HOME;
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

    public function login(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);

        //active-deactive

        
            

        $user=DB::table('users')
                ->where('email', $request->email)->orWhere('mobile', $request->email)->orWhere('username', $request->email)->first();

    if($user != null){
        
         // code start here
        $varify=DB::table('users')
        ->where('email', $request->email)->orWhere('mobile', $request->email)
        ->first()->status;
        if ($varify == 1) {


            $status=DB::table('users')
            ->where('email', $request->email)->orWhere('mobile', $request->email)
            ->first()->is_active;

        if ($status == 1) {


            if(is_numeric($request->get('email'))){
                // start phone
            if(auth()->attempt(array('mobile' => $input['email'],'password' => $input['password'])))
            {
                if (auth()->user()->is_type == 'admin') {
                    return redirect()->route('admin.dashboard');
                }if (auth()->user()->is_type == 'staff') {
                    return redirect()->route('admin.dashboard');
                }
                if (auth()->user()->is_type == 0) {
                    if ($request->redirect=='home') {
                        return redirect()->route('mainhome');
                    } else {
                        return view('frontend.user.profile');
                    }
                }
            }else{
                return Redirect::back()->withErrors(
                    [
                        'password' => 'Password does not match!'
                    ]
                );
            }
            // end
            }
            elseif (filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)) {
                // start email login
            if(auth()->attempt(array('email' => $input['email'],'password' => $input['password'])))
            {
                if (auth()->user()->is_type == 'admin') {
                    return redirect()->route('admin.dashboard');
                }if (auth()->user()->is_type == 'staff') {
                    return redirect()->route('admin.dashboard');
                }
                if (auth()->user()->is_type == 0) {
                    if ($request->redirect=='home') {
                        return redirect()->route('mainhome');
                    } else {
                        return view('frontend.user.profile');
                    }
                }
            }else{
                return Redirect::back()->withErrors(
                    [
                        'password' => 'Password does not match!'
                    ]
                );
            }
            // end
            }
            // start username login
            if(auth()->attempt(array('username' => $input['email'],'password' => $input['password'])))
            {
                if (auth()->user()->is_type == 'admin') {
                    return redirect()->route('admin.dashboard');
                }if (auth()->user()->is_type == 'staff') {
                    return redirect()->route('admin.dashboard');
                }
                if (auth()->user()->is_type == 0) {
                    if ($request->redirect=='home') {
                        return redirect()->route('mainhome');
                    } else {
                        return view('frontend.user.profile');
                    }
                }
            }else{
                return Redirect::back()->withErrors(
                    [
                        'password' => 'Password does not match!'
                    ]
                );
            }
            // end

        } else {

            return Redirect::back()->withErrors(
                [
                    'email' => 'Your account is deactive.'
                ]
            );

        }
        
                 // new code start here
        }if($varify == 0){
            
            
            
            $varifyuser = User::where('email', $request->email)->orWhere('mobile', $request->email)->first();

        // dd($varifyuser );

        $user_id = $varifyuser->id;
        // $codeverify = rand(1234, 4568);
        $length = 4;
        $codeverify = substr(str_shuffle('123456789ABCDEFGHIJKLMNPQRSTUVWXYZ'),1,$length);
        
        $message = 'Use: "'.$codeverify.'" for Rabibar.com';
        $phone = $request->email;

        $mobile_verify = new MobileVerify();
        $mobile_verify->user_id = $user_id;
        $mobile_verify->code = $codeverify;
        $mobile_verify->phone = $phone;
        if($mobile_verify->save()){
            // sms send
        $url = 'https://www.24bulksmsbd.com/api/smsSendApi';
        $data = array(
            'customer_id' => 97,
            'api_key' => 171401928639053401726004037,
            'message' =>$message,
            'mobile_no' => $phone
        );
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        $output = curl_exec($curl);
        curl_close($curl);
        // send send end
        }
        return redirect()->route('varify_user',$user->mobile);
        }



    } else {
        return Redirect::back()->withErrors(
            [
                'email' => 'This credential does not match!'
            ]
        );
    }

        //active-deactive end

    }


    // facebook login start

    
    public function redirect()
    {

          return Socialite::driver('facebook')->redirect();

    }
    public function callback()
    {
        try {
            $fbuser = Socialite::driver('facebook')->user();
            $user=DB::table('users')
                ->select('id')
                ->where('email',$input['email'] = $fbuser->getEmail())
                ->first();
                $input['name'] = $fbuser->getName();
                $input['email'] = $fbuser->getEmail();
//              $input['provider'] = $provider;
                $input['facebook'] = $fbuser->getId();

            if($user==Null)
            {

                $user = User::create([
                    'name' => $input['name'],
                    'username' => $input['name'],
                    'email' => $input['email'],
                    'password' => Hash::make($input['facebook']),

                    'credit_balance' => 1,
                    'singUp_credit' => 1,

                ]);

                Auth::loginUsingId($user->id);

                  return redirect($this->redirectTo);

                }
            else {

                Auth::loginUsingId($user->id);
               
                    return redirect($this->redirectTo);

                }
           
//           $authUser = $this->findOrCreate($input);
//            Auth::loginUsingId($authUser->id);

        }
        catch (Exception $e) {

            return redirect('/');

        }
    }

    //facebook login end
    
    
    public function redirecthome()
    {
        $redirect = "home";
        return view('auth.login',compact('redirect'));

    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\User;
use App\Models\MobileVerify;
use Mail;
use Hash;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    // use SendsPasswordResetEmails;

      /**
       * Write code on Method
       *
       * @return response()
       */
      public function showForgetPasswordForm()
      {
         return view('auth.forgetPassword');
      }

      /**
       * Write code on Method
       *
       * @return response()
       */
      public function submitForgetPasswordForm(Request $request)
      {
        $user=DB::table('users')
            ->where('email', $request->email)->orWhere('mobile', $request->email)
            ->first();
        if($user != null){
          if(is_numeric($request->get('email'))){
            // start phone


            $user_id = $user->id;
            $codeverify = rand(1234, 4568);
            $message = 'Your Rabibar.com varification code is: '.$codeverify;
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



        return redirect()->route('varify_otp',encrypt($phone));
        // end
          }
          elseif (filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)) {
            $request->validate([
              'email' => 'required|email|exists:users',
          ]);
          $token = Str::random(64);
          DB::table('password_resets')->insert([
              'email' => $request->email,
              'token' => $token,
              'created_at' => Carbon::now()
            ]);

          Mail::send('email.forgetPassword', ['token' => $token], function($message) use($request){
            $message->from('info@rabibar.com', 'Rabibar');
            $message->to($request->email);
            $message->subject('Reset Password');
          });

          return back()->with('message', 'We have e-mailed your password reset link!');
          }

        }else {
          return back()->with('message', 'Opps! Credential Did not match');
      }
      }
      // mobile otp varify

      public function varify_otp($phone)
      {
        $phone =decrypt($phone);
        return view('auth.otp_verify', compact('phone'));
      }

      public function varify_code(Request $request)
      {
        $phone =$request->phone;
        $verify = MobileVerify::where('phone', $request->phone)->orderBy('id','DESC')->limit(1)->first()->code;
        if($verify==$request->otp){
          return redirect()->route('otp.varified',encrypt($phone));
        }else{
          return back()->with('message', 'Opps! OTP code Did not match');
        }
      }

      public function shwotpfrom($phone)
      {
        $phone =decrypt($phone);
        return view('auth.verify_otp', compact('phone'));
      }

      public function varified(Request $request)
      {
        $request->validate([
          'password' => 'required|string|min:6|confirmed',
          'password_confirmation' => 'required'
      ]);

      $updatePassword = DB::table('mobile_verifies')
                          ->where([
                            'phone' => $request->phone,
                          ])
                          ->first();

      if(!$updatePassword){
          return back()->withInput()->with('error', 'Invalid token!');
      }

      $user = User::where('mobile', $request->phone)
                  ->update(['password' => Hash::make($request->password), 'is_active'=>1]);

      DB::table('mobile_verifies')->where(['phone'=> $request->phone])->delete();

      return redirect()->route('login')->with('message', 'Your password has been changed!');
      }

      /**
       * Write code on Method
       *
       * @return response()
       */
      public function showResetPasswordForm($token) {
         return view('auth.forgetPasswordLink', ['token' => $token]);
      }

      /**
       * Write code on Method
       *
       * @return response()
       */
      public function submitResetPasswordForm(Request $request)
      {
          $request->validate([
              'email' => 'required|email|exists:users',
              'password' => 'required|string|min:6|confirmed',
              'password_confirmation' => 'required'
          ]);

          $updatePassword = DB::table('password_resets')
                              ->where([
                                'email' => $request->email,
                                'token' => $request->token
                              ])
                              ->first();

          if(!$updatePassword){
              return back()->withInput()->with('error', 'Invalid token!');
          }

          $user = User::where('email', $request->email)
                      ->update(['password' => Hash::make($request->password)]);

          DB::table('password_resets')->where(['email'=> $request->email])->delete();

          return redirect()->route('login')->with('message', 'Your password has been changed!');

      }
}

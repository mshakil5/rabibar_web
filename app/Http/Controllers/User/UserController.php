<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Sendmail;
use App\Models\Role;
use DB;
use Illuminate\support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function profile()
    {
        $profile_data= Auth::user();
        return view('frontend.user.profile')->with('profile_data', $profile_data);
    }

    public function profileEdit()
    {
        $profile_data= Auth::user();
        return view('frontend.user.profileedit')->with('profile_data', $profile_data);
    }

    public function passwordEdit()
    {
        $profile_data= Auth::user();
        return view('frontend.user.pwdedit')->with('profile_data', $profile_data);
    }

    public function userProfileUpdate(Request $request)
    {



        if(empty($request->name)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Name \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }


        if(!empty($request->email)){
            $chkemail=User::where('email', $request->email)->whereNotIn('id', [Auth::id()])->count();


            if($chkemail == 1){
                $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>This email has already exists.</b></div>";
                return response()->json(['status'=> 303,'message'=>$message]);
                exit();
            }

        }    

        $chkmbl=User::where('mobile', $request->mobile)->whereNotIn('id', [Auth::id()])->count();

        if( $chkmbl == 1){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>This mobile number has already exists.</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

       

        $userdata= Auth::user();
        $userdata->name= $request->name;
        $userdata->email= $request->email;
        $userdata->city= $request->city;
        $userdata->postal_code= $request->postal_code;
        $userdata->address= $request->address;

        if ($userdata->save()) {
            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Profile Updated Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
        }
        else{
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        }

    }

    public function changeUserPassword(Request $request)
        {

            if(empty($request->opassword)){
                $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Old Password\" field..!</b></div>";
                return response()->json(['status'=> 303,'message'=>$message]);
                exit();
            }

            if(empty($request->password)){
                $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"New Password\" field..!</b></div>";
                return response()->json(['status'=> 303,'message'=>$message]);
                exit();
            }

            if(empty($request->password === $request->confirmpassword)){
                $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>New password doesn't match.</b></div>";
                return response()->json(['status'=> 303,'message'=>$message]);
                exit();
            }

        $hashedPassword = Auth::user()->password;

       if (\Hash::check($request->opassword , $hashedPassword )) {

         if (!\Hash::check($request->password , $hashedPassword)) {
                $where = [
                    'id'=>auth()->user()->id
                ];
                $passwordchange = User::where($where)->get()->first();
                $passwordchange->password =Hash::make($request->password);

                if ($passwordchange->save()) {
                    $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Password Change Successfully.</b></div>";
                    return response()->json(['status'=> 300,'message'=>$message]);
                }else{
                    return response()->json(['status'=> 303,'message'=>'Server Error!!']);
                }

        }else{
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>New password can not be the old password.</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
                }

           }else{
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Old password doesn't match.</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
             }

        }



        // public function userImageUpload(Request $request, $id)
        // {
        //     $where = [
        //         'id'=>auth()->user()->id
        //     ];
        //     $user = User::where($where)->get()->first();

        //     $request->validate([
        //         'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        //     ]);
        //     $rand = mt_rand(100000, 999999);
        //     $imageName = time(). $rand .'.'.$request->image->extension();
        //     $request->image->move(public_path('images'), $imageName);
        //     $user->photo= $imageName;


        //     if ($user->save()) {
        //         $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>User Image Upload Successfully.</b></div>";
        //         return response()->json(['status'=> 300,'message'=>$message]);
        //     }
        //     else{
        //         return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        //     }
        // }


        public function qreferral()
    {
        $referCount = User::whereReferralId(auth()->user()->id)->count();
        $refuser = User::where('referral_id', '=', Auth::user()->id)->where('status', '=', '1')->orderBy('id','DESC')->get();
        return view('frontend.user.refferal', compact('referCount', 'refuser'));
    }

    public function qreferralFriend()
    {
        return view('frontend.user.refferalfrd');
    }

    public function qreferralMailSend(Request $request)
    {

        // dd($request->ref_link);
        

        $array['subject'] = Sendmail::where('mailto','=', 'referral')->first()->subject;
        $array['from'] = 'info@rabibar.com';

        $email = $request->email;
        $array['name'] = Auth::user()->name;
        $array['email'] = $request->email;
        $array['ref_link'] = $request->ref_link;

        Mail::send('email.refarral', compact('array'), function($message)use($array,$email) {
         $message->from($array['from'], 'Rabibar.com');
         $message->to($email)->subject($array['subject']);
        });
        

        // $id=auth()->user()->id;
        // $amount=(float)auth()->user()->credit_balance + 100;
        // $credit=User::find($id);
        // $credit->credit_balance=$amount;
        // $credit->save();

        return redirect()->back()->withErrors(['Invitation sent successfully']);
    }


    
    public function userShow(Request $request)
    {
        //  search code start
        if(!empty($request->input('searchdata'))){
            $searchdata = $request->input('searchdata');
            $users = User::where('is_type', '=', 'user')->where('name', '=', $searchdata)->orwhere('email', '=', $searchdata)->orwhere('mobile', '=', $searchdata)->orwhere('address', '=', $searchdata)->paginate(10);

        }else{
            $users = User::where('is_type', '=', 'user')->paginate(10);
        }
        // search code end
        return view('user.alluser', compact('users'));
    }

    public function userCreate(Request $request)
    {

        
        if(empty($request->name)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Username \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        // if((empty($request->email)) && (empty($request->mobile))){
        //     $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Email or Mobile\" field..!</b></div>";
        //     return response()->json(['status'=> 303,'message'=>$message]);
        //     exit();
        // }
        if(empty($request->mobile)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Phone \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        if(empty($request->password)){            
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Password\" field..!</b></div>"; 
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        if(empty($request->password === $request->cpassword)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Password doesn't match.</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }


        try{
            $account = new User();
            $account->name = $request->name;
            $account->email = $request->email;
            $account->is_type = "user";
            $account->mobile = $request->mobile;
            $account->password = Hash::make($request->input('password'));

            $account->save();

            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>User Account Created Successfully.</b></div>";

            return response()->json(['status'=> 300,'message'=>$message]);
        }catch (\Exception $e){
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);

        }
    }

    public function userEdit($id)
    {
        $where = [
            'id'=>$id
        ];
        $info = User::where($where)->get()->first();
        return response()->json($info);
    }


    public function userupdate(Request $request, $id)
    {

        
        if(empty($request->name)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Username \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        // if((empty($request->email)) || (empty($request->mobile))){
        //     $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Email or Mobile\" field..!</b></div>";
        //     return response()->json(['status'=> 303,'message'=>$message]);
        //     exit();
        // }
        if(empty($request->mobile)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Mobile \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        
        if(isset($request->password) && ($request->password != $request->cpassword)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Password doesn't match.</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }


        $where = [
            'id'=>$request->userid
        ];
        
        //$userData = User::find($id);
        $userData = User::where($where)->get()->first();

        if(isset($request->password)){
        $userData->name = request('name');
        $userData->email = request('email');
        $userData->is_type =   "user";
        $userData->mobile = request('mobile');
        $userData->password = Hash::make($request->input('password'));

        }else{

        $userData->name = request('name');
        $userData->email = request('email');
        $userData->is_type =   "user";
        $userData->mobile = request('mobile');
        
        }

        if ($userData->save()) {
            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>User Account Updated Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
        }
        else{
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        } 
    }

    public function userDelete($id)
    {

        if(User::destroy($id)){
            return response()->json(['success'=>true,'message'=>'User has been deleted successfully']);
        }else{
            return response()->json(['success'=>false,'message'=>'Delete Failed']);
        }
    }

    // refferal user
    public function refferalUserShow(Request $request)
    {
        //  search code start
        if(!empty($request->input('fromDate')) && !empty($request->input('toDate'))){
            $fromDate = $request->input('fromDate');
            $toDate   = $request->input('toDate');

            $checkUser=DB::table('users')->where([
                ['created_at', '>=', $fromDate],
                ['created_at', '<=', $toDate],
            ])->whereNotNull('referral_id')
              ->pluck('referral_id')->all();

            $users = User::whereIn('id',  $checkUser)->where('is_type', '=', 'user')->where('status', '=', '1')->select('*')->get();
            return view('user.refferaluser', compact('users','fromDate','toDate'));

        }else{
            $checkUser=DB::table('users')->whereNotNull('referral_id')->pluck('referral_id')->all();
            $users = User::whereIn('id',  $checkUser)->where('is_type', '=', 'user')->where('status', '=', '1')->select('*')->get();
            return view('user.refferaluser', compact('users'));
        }
        // search code end
    }


    public function refferalUserDetails(Request $request, $id)
    {

         //  search code start
         if(!empty($request->input('fromDate')) && !empty($request->input('toDate'))){
            $fromDate = $request->input('fromDate');
            $toDate   = $request->input('toDate');
              $users = User::where('is_type', '=', 'user')->where([
                ['created_at', '>=', $fromDate],
                ['created_at', '<=', $toDate],
            ])->where('status', '=', '1')->where('referral_id','=',$id)->get();

        }else{
            $users = User::where('is_type', '=', 'user')->where('status', '=', '1')->where('referral_id','=',$id)->get();

        }
        // search code end
        $name = User::where('is_type', '=', 'user')->where('id','=',$id)->where('status', '=', '1')->first()->name;
        $mobile = User::where('is_type', '=', 'user')->where('id','=',$id)->where('status', '=', '1')->first()->mobile;

        return view('user.referraluserdetail', compact('users','name','mobile','id'));

    }
    
    
        // change status

        public function changeStatus(Request $request)
        {
            $user = User::find($request->id);
            $user->is_active = $request->status;
            $user->save();
    
            if($request->status==1){
                $user = User::find($request->id);
                $user->is_active = $request->status;
                $user->save();
                $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Active Successfully.</b></div>";
                return response()->json(['status'=> 300,'message'=>$message]);
            }else{
                $user = User::find($request->id);
                $user->is_active = $request->status;
                $user->save();
                $message ="<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Inactive Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
            }
        }

    
    // phone check
    function phonecheck(Request $request)
    {
        
     if($request->get('phone'))
     {
      $phone = $request->get('phone');
      $data = DB::table("users")
       ->where('mobile','=', $phone)
       ->count();
      if($data > 0)
      {
       echo 'not_unique';
      }
      else
      {
       echo 'unique';
      }
     }
    }

     // email check
     function emailcheck(Request $request)
     {
      if($request->get('email'))
      {
       $email = $request->get('email');
       $data = DB::table("users")
        ->where('email','=', $email)
        ->count();
       if($data > 0)
       {
        echo 'not_unique';
       }
       else
       {
        echo 'unique';
       }
      }
     }






}

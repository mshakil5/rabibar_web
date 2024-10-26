<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Sendmail;
use App\Models\QuiznotTaken;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\DB;
use App\Models\QuizTaken;
use Illuminate\Support\Carbon;

class EmailSendController extends Controller
{
    public function pSinglemail(Request $request)
    {

        try{
            $quiz = QuizTaken::find(QuizTaken::where('quiz_id', '=', $request->qid)->where('user_id', '=', $request->uid)->first()->id);
            $quiz->quiz_id= $request->qid;
            $quiz->user_id= $request->uid;
            $quiz->mail_count= $quiz->mail_count+1;
            $quiz->mail_send_date= date('Y-m-d');
            $quiz->status= 1;
            $quiz->save();

            $array['name'] = User::where('id','=', $request->uid)->first()->name;
            $array['subject'] = Sendmail::where('mailto','=', 'participate')->first()->subject;
            $array['from'] = 'info@aponhealth.com';
            $email = User::where('id',$request->uid)->first()->email;

            Mail::send('email.participate', compact('array'), function($message)use($array,$email) {
             $message->from($array['from'], 'Rabibar.com');
             $message->to($email)->subject($array['subject']);
            });

            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Email Send Successfully</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);

        }catch (\Exception $e){
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);

        }
    }

    public function pBulkmail(Request $request)
    {
        $id = $request->qid;
        $participates = QuizTaken::where('quiz_id', '=', $id)->get();
        // dd($participates);
        $array['subject'] = Sendmail::where('mailto','=', 'participate')->first()->subject;
        $array['from'] = 'info@aponhealth.com';

        foreach ($participates as $participate) {
            $qtakenid =  $participate->id;
            $userid = $participate->user_id;
            $array['name'] = User::where('id','=', $participate->user_id)->whereNotNull('email')->first()->name;
            $user_mail = User::where('id', $userid)->first()->whereNotNull('email')->email;
            Mail::send('email.participate', compact('array'), function($message)use($array,$user_mail) {
                $message->from($array['from'], 'Rabibar.com');
                $message->to($user_mail)
                ->subject($array['subject']);
               });

                $quiz = QuizTaken::find($qtakenid);
                $quiz->mail_count= $quiz->mail_count+1;
                $quiz->mail_send_date= date('Y-m-d');
                $quiz->status= 1;
                $quiz->save();
        }

        
        $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>All Email Send Successfully</b></div>";
        return response()->json(['status'=> 300,'message'=>$message]);
    }
    public function npSinglemail(Request $request)
    {
        try{
            $array['name'] = User::where('id','=', $request->uid)->whereNotNull('email')->first()->name;
            $array['subject'] = Sendmail::where('mailto','=', 'notparticipate')->first()->subject;
            $array['from'] = 'info@aponhealth.com';

            $email = User::where('id',$request->uid)->whereNotNull('email')->first()->email;

            Mail::send('email.notparticipate', compact('array'), function($message)use($array,$email) {
                $message->from($array['from'], 'Rabibar.com');
                $message->to($email)->subject($array['subject']);
               });
   
            $findid = QuiznotTaken::find(QuiznotTaken::where('quiz_id', '=', $request->qid)->where('user_id', '=', $request->uid)->count());

            if (!empty($findid)) {
                $quiz = QuiznotTaken::find(QuiznotTaken::where('quiz_id', '=', $request->qid)->where('user_id', '=', $request->uid)->first()->id);
                $quiz->quiz_id= $request->qid;
                $quiz->user_id= $request->uid;
                $quiz->mail_count= $quiz->mail_count+1;
                $quiz->mail_send_date= date('Y-m-d');
                $quiz->status= 1;
                $quiz->save();
            } else {
                $quiz = new QuiznotTaken;
                $quiz->quiz_id= $request->qid;
                $quiz->user_id= $request->uid;
                $quiz->mail_count= 1;
                $quiz->mail_send_date= date('Y-m-d');
                $quiz->status= 1;
                $quiz->save();
            }


            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Email Send Successfully</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);

        }catch (\Exception $e){
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);

        }
    }



    public function npBulkmail(Request $request)
    {
        $id = $request->qid;

        

        // $participates = QuizTaken::where('quiz_id', '=', $id)->get();

        $qid=(int)$id;
        $checkUser=DB::table('quiz_takens')
             ->where('quiz_id',$request->qid)->pluck('user_id')->all();
        $notparticipates = User::whereNotIn('id',  $checkUser)->whereNotNull('email')->get();
        // dd($notparticipates);

        $array['subject'] = Sendmail::where('mailto','=', 'notparticipate')->first()->subject;
        $array['from'] = 'info@aponhealth.com';

        foreach ($notparticipates as $notparticipate) {
            $user_mail = $notparticipate->email;
            
            $array['name'] = $notparticipate->name;
            Mail::send('email.notparticipate', compact('array'), function($message)use($array,$user_mail) {
                $message->from($array['from'], 'Rabibar.com');
                $message->to($user_mail)
                ->subject($array['subject']);
               });

            $qntakenid = QuiznotTaken::where('user_id', '=', $notparticipate->id)->first();

            if ($qntakenid) {
                $quiz = QuiznotTaken::find(QuiznotTaken::where('user_id', '=', $notparticipate->id)->first()->id);
                $quiz->quiz_id= $request->qid;
                $quiz->user_id= $notparticipate->id;
                $quiz->mail_count= $quiz->mail_count+1;
                $quiz->mail_send_date= date('Y-m-d');
                $quiz->status= 1;
                $quiz->save();
            } else {
                $quiz = new QuiznotTaken;
                $quiz->quiz_id= $request->qid;
                $quiz->user_id= $notparticipate->id;
                $quiz->mail_count= 1;
                $quiz->mail_send_date= date('Y-m-d');
                $quiz->status= 1;
                $quiz->save();
            }

        }

        $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>All Email Send Successfully</b></div>";
        return response()->json(['status'=> 300,'message'=>$message]);


    }


    public function userBulkmail(Request $request)
    {
        $id = $request->qid;
        $allusers = User::where('is_active', '=', '1')->whereNotNull('email')->get();

        $array['subject'] = Sendmail::where('mailto','=', 'alluser')->first()->subject;
        $array['from'] = 'info@aponhealth.com';

        foreach ($allusers as $user) {

            $array['name'] = $user->name;
            $user_mail = $user->email;
            Mail::send('email.alluser', compact('array'), function($message)use($array,$user_mail) {
                $message->from($array['from'], 'Rabibar.com');
                $message->to($user_mail)
                ->subject($array['subject']);
               });

        }

        
        $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>All Email Send Successfully</b></div>";
        return response()->json(['status'=> 300,'message'=>$message]);
    }






}

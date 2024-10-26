<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\User;
use App\Models\Sendmail;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use App\Models\Answer;
use App\Models\Score;
use App\Models\QuizTaken;
use App\Models\Winner;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\MobileVerify;

class IndexController extends Controller
{
    public function index()
    {


        $quiz=DB::table('quizzes')
           ->select('*')
           ->where('status',1)
           ->where('expiry_date','>=',date('Y-m-d H:i'))
           ->where('quiz_type','Commercial')
           ->first();

           $header=DB::table('headers')
                ->select('image')
                ->where('status',1)
                ->first();

       if($quiz!=null)
       {

           $question = DB::table('questions')
               ->select('*')
               ->where('quiz_id', $quiz->id)
               ->get();

            $sponsor = DB::table('sponsors as s')
                    ->join('sponsor_assigns as sp','s.id','=','sp.sponsor_id')
                    ->select('s.name','sp.description')
                    ->where('sp.quiz_id',$quiz->id)
                    ->where('s.status',1)
                    ->get();
                   if($sponsor==null)
                   {
                       $sponsor=0;
                   }

            $commercialQuiz=DB::table('quizzes')
            ->select('*')
            ->where('quiz_type', 'Commercial')
            ->where('id','!=',$quiz->id)
            ->where('status',1)
            ->get();

            $freeQuiz=DB::table('quizzes')
            ->select('*')
            ->where('quiz_type', 'Free')
            ->get();

            $countAttend=DB::table('quiz_takens')
            ->select('id')
            ->where('quiz_id', $quiz->id)
            ->count();
            $quizEnd= DB::table('quizzes')
                    ->select('id','quiz')
                    ->where('status',1)
                    ->where('quiz_type','=','Commercial')
                    ->where('expiry_date','<',date('Y-m-d H:i'))
                     ->get();
            if($quizEnd!=null)
                {
                    for($i=0;$i<sizeof($quizEnd);$i++)
                    {
                        $total=DB::table('questions')
                        ->select('id')
                        ->where('quiz_id',$quizEnd[$i]->id)
                        ->count();
                       $abc= DB::table('scores')
                            ->select('user_id')
                            ->where('quiz_id',$quizEnd[$i]->id)
                            ->where('score','=',$total)
                            ->inRandomOrder()
                            ->limit(10)
                            ->get();
                        for($k=0;$k<sizeof($abc);$k++)
                        {
                           $winner= new Winner();
                           $winner->quiz_id=$quizEnd[$i]->id;
                           $winner->user_id=$abc[$k]->user_id;
                           $winner->point=$total;
                           $winner->gift=0;
                           $winner->save();

                        }
                       $updatestatus = quiz::findOrFail($quizEnd[$i]->id);
                        $updatestatus ->update([
                            'status'=> 0,
                            'is_active'=> 0,

                       ]);

                    }
                }

            $winners= DB::table('winners')
                ->select('winners.*','users.id as uid','users.name','users.email','users.username')
                ->join('users','users.id','=','winners.user_id')
                ->get();

            return view('frontend.index',
                 ['quiz' => $quiz, 'question' => $question,
                 'commercialQuiz'=>$commercialQuiz,'freeQuiz'=>$freeQuiz,
                 'countAttend'=>$countAttend,
                 'header'=>$header,
                 'sponsor'=>$sponsor,
                 'winners'=>$winners,
                 ]);

       }
       else {
                $quizEnd= DB::table('quizzes')
                ->select('id','quiz')
                ->where('status',1)
                ->where('quiz_type','=','Commercial')
                ->where('expiry_date','<',date('Y-m-d H:i'))
                ->where('status',1)
                ->get();


        if($quizEnd!=null)
        {
            for($i=0;$i<sizeof($quizEnd);$i++)
                { $total=DB::table('questions')
                    ->select('id')
                    ->where('quiz_id',$quizEnd[$i]->id)
                        ->count();

                $abc= DB::table('scores')
                        ->select('user_id')
                        ->where('quiz_id',$quizEnd[$i]->id)
                        ->where('score','=',$total)
                        ->inRandomOrder()
                        ->limit(10)
                        ->get();

                    for($k=0;$k<sizeof($abc);$k++)
                    {
                    $winner= new Winner();
                    $winner->quiz_id=$quizEnd[$i]->id;
                    $winner->user_id=$abc[$k]->user_id;
                    $winner->point=$total;
                    $winner->gift=0;
                    $winner->save();
                    $user=User::findOrFail($abc[$k]->user_id);
                    }
                $updatestatus = quiz::findOrFail($quizEnd[$i]->id);
                    $updatestatus ->update([
                        'status'=> 0,
                        'is_active'=> 0,

                ]);

                }
        }

           $header=DB::table('headers')
                ->select('image')
                ->where('status',1)
                ->first();
           $message="No quiz available";
           $winners= DB::table('winners')
                ->select('winners.*','users.id as uid','users.name','users.email','users.username')
                ->join('users','users.id','=','winners.user_id')
                ->get();
           return view('frontend.index', ['msg' => $message,'header'=>$header,'winners'=>$winners]);


       }

    }


    public function contact()
    {
        return view('frontend.contact');
    }

    public function contactCreate(Request $request)
    {

        try{
            $bcmnt = new Contact();
            $bcmnt->name = $request->name;
            $bcmnt->email = $request->email;
            $bcmnt->subject = $request->subject;
            $bcmnt->message = $request->message;
            $bcmnt->save();

            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Message Send Successfully!!</b></div>";

            return response()->json(['status'=> 300,'message'=>$message]);
        }catch (\Exception $e){
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);

        }
    }

    public function aboutus()
    {
        return view('frontend.about');
    }

    public function terms()
    {
        return view('frontend.terms');
    }

    public function privacy()
    {
        return view('frontend.privacy');
    }

    public function spinner()
    {
        $quiz = DB::table('quizzes')
            ->where('expiry_date','>=',date("Y/m/d"))
            ->select('quizzes.*')
            ->orderBy('created_at', 'ASC')
            ->first();

        if ($quiz) {
            $score=DB::table('questions')
                ->select('id')
                ->where('quiz_id',$quiz->id)
                ->count();
        $crtusers=DB::table('scores')
                ->join('users','users.id','=','scores.user_id')
                ->select('users.id as id','users.name as name','users.email as email','users.mobile as mobile','users.username as username')
                ->where([
                    ['scores.score','=',$score],
                    ['scores.quiz_id','=',$quiz->id]
                    ])
                ->get();
                // dd($crtusers);
        $crtallusers=DB::table('scores')
                ->join('users','users.id','=','scores.user_id')
                ->select('users.id as id','users.name as name','users.email as email','users.mobile as mobile','users.username as username')
                ->where([
                    ['scores.score','=',$score],
                    ['scores.quiz_id','=',$quiz->id]
                    ])
                ->paginate(10);
            // dd($crtusers);

        return view('frontend.spinner', compact('crtusers','crtallusers'));

        } else{

            return view('frontend.spinnerr');
        }
    }



    // quiz insert

    public function registeredQuiz(Request $request)
    {

        if(auth()->user())
        {

        $userid=auth()->user()->id;
        $quizid = $request->quiz;

        $questionid = $request->questions;
        
        
        
        
        if($questionid !=0)
        {
        $check = DB::table('answers')
            ->join('questions', 'answers.question_id', '=', 'questions.id')
            ->join('quizzes', 'quizzes.id', '=', 'questions.quiz_id')
            ->where('answers.user_id', '=', $userid)
            ->where('quizzes.id', '=', $quizid)
            ->select('answer.id')
            ->count();


        if ($check < 1) {

            for ($i = 1; $i <= sizeof($questionid); $i++) {
                $answer = new Answer();
                $options = "option" . $request->questions[$i];

                $a = $request->$options;
                $answer->answer = $a;
                $answer->user_id = $userid;
                $answer->question_id = $request->questions[$i];
                $answer->save();


            }

        $questionAnswer= DB::table('questions')
            ->select('id','answer')
            ->where('quiz_id',$quizid)
            ->get();

        $userAnswer = DB::table('answers')
        ->join('questions', 'answers.question_id', '=', 'questions.id')
        ->join('quizzes', 'quizzes.id', '=', 'questions.quiz_id')
        ->where('answers.user_id', '=', $userid)
        ->where('quizzes.id', '=', $quizid)
        ->select('answers.id','answers.answer')
        ->get();
            $cnt=0;

            for ($i = 0; $i < sizeof($userAnswer); $i++)
             {

                    if($questionAnswer[$i]->answer==$userAnswer[$i]->answer)
                    {
                        $cnt++;
                    }

             }

             $score=new Score();
             $score->user_id=$userid;
             $score->quiz_id=$quizid;
             $score->score=$cnt;
             $score->save();

            $quzTaken=new QuizTaken();
            $quzTaken->quiz_id=$quizid;
            $quzTaken->user_id=$userid;
            $quzTaken->save();

             // mail send
             
            if (Auth::user()->email) {
                $array['name'] = Auth::user()->name;
                $array['subject'] = Sendmail::where('mailto','=', 'attend')->first()->subject;
                $array['from'] = 'info@aponhealth.com';

                $email = Auth::user()->email;

                Mail::send('email.attend', compact('array'), function($message)use($array,$email) {
                $message->from($array['from'], 'Rabibar.com');
                $message->to($email)->subject($array['subject']);
                });
             }

            //  mail send end






            return redirect('/')->withErrors(['If you win you will be notified as soon as the result will be published']);
        } else {
            return redirect('/')->withErrors(['You have already taken the quiz', 'You have already taken the quiz']);
        }
        }
        else
            {
                return redirect()->back()->withErrors(['You did not select any answer']);
            }
    }

    else
            {
                return redirect()->back()->withErrors(['You are not logged in. Please login or register']);
            }



    }

      public function varify_user($id)
    {
        return view('auth.mobile_verify', compact('id'));
    }
    public function varifiedconfirm(Request $request)
    {
        
        $id = MobileVerify::where('phone',$request->phone)->orderBy('id', 'DESC')->limit(1)->first();
        if($id){
            $varify_code = MobileVerify::find($id->id);
            if($varify_code->code == $request->verification_code){
                $user = User::find($id->user_id);
                $user->status= 1;
                $user->save();
                $details=MobileVerify::where('phone',$request->phone)->delete();
                auth()->login($user, true);
                return redirect()->route('user.dashboard');
            }else{

                return redirect()->back()->withErrors(['OTP doesn\'t match!!']);
            }
        }else{

            return redirect()->back()->withErrors(['Invalid number!!!']);
        }

    }




}

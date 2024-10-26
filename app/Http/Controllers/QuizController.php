<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Answer;
use App\Models\Score;
use App\Models\quizTaken;
use App\Models\Quiz;
use App\Models\QuizType;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quiz = Quiz::all();
        $quiztype = QuizType::all();
        return view('quiz.index', compact('quiz','quiztype'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new Quiz;
        $user->quiz = $request->quiz;
        $user->expiry_date = $request->datetimepicker;
        $user->quiz_type = $request->quiz_type;
        $user->status = "1";
        if($user->save()){
            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Data Created Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
        }

        return response()->json(['status'=> 303,'message'=>'Server Error!!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function show(Quiz $quiz)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $where = [
            'id'=>$id
        ];
        $info = Quiz::where($where)->get()->first();
        return response()->json($info);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Quiz::find($id);
        $post->quiz = $request->quiz;
        $post->expiry_date = $request->datetimepicker;
        $post->quiz_type = $request->quiz_type;
        if ($post->save()) {
            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Data Updated Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
        }
        else{
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quiz $quiz)
    {
        if(Quiz::destroy($quiz->id)){
            return response()->json(['success'=>true,'message'=>'Data has been deleted successfully']);
        }else{
            return response()->json(['success'=>false,'message'=>'Delete Failed']);
        }
    }

    public function quiztype()
    {
        $quiztype = QuizType::all();
        return view('quiz.quiztype', compact('quiztype'));
    }

    public function quiztypestore(Request $request)
    {
        try{
            $account = new QuizType();
            $account->quiztype = $request->quiztype;
            $account->created_by = Auth::user()->id;
            $account->save();

            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Data Created Successfully.</b></div>";

            return response()->json(['status'=> 300,'message'=>$message]);
        }catch (\Exception $e){
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);

        }
    }

    public function quiztypeedit($id)
    {
        $where = [
            'id'=>$id
        ];
        $info = QuizType::where($where)->get()->first();
        return response()->json($info);
    }

    public function quiztypeupdate(Request $request, $id)
    {
        $post = QuizType::find($id);
        $post->quiztype = $request->quiztype;
        if ($post->save()) {
            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Data Updated Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
        }
        else{
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        }
    }
    public function quiztypedestroy($id)
    {
        if(QuizType::destroy($id)){
            return response()->json(['success'=>true,'message'=>'Data has been deleted successfully']);
        }else{
            return response()->json(['success'=>false,'message'=>'Delete Failed']);
        }
    }

    public function question()
    {
        $quiz = Quiz::all();
        // dd($quiz);
        return view('quiz.question', compact('quiz'));
    }

    public function qParticipate()
    {
        $quiz = Quiz::all();
        return view('quiz.participate', compact('quiz'));
    }

    public function qParticipateDtl($id)
    {
        $qid=(int)$id;
        $users=DB::table('users as u')
            ->join('quiz_takens as q','q.user_id','=','u.id')
            ->select('u.*')
             ->where('q.quiz_id',$qid)
             ->get();

        return view('quiz.participatedtl', compact('users','qid'));
    }

    public function qParticipateSoDtl($id)
    {
        $quizes=DB::table('quizzes')
        ->select('*')
        ->where('id',$id)
        ->get();

        $ques=DB::table('questions')
                ->select('id')
                ->where('quiz_id',$id)
                ->count();
               
        $totalCorrect=DB::table('scores')
        ->select('id')
        ->where('quiz_id',$id)
        ->where('score',$ques)
        ->count();
        
       $totalusers=DB::table('quiz_takens')
                ->select('id')
                ->where('quiz_id',$id)
                ->count();
                
        $numberofwinner=DB::table('winners')
                ->select('id')
                ->where('quiz_id',$id)
                ->count();
        

        $winners=DB::table('winners')
        ->join('users','users.id','=','winners.user_id')
        ->select('users.name as name','users.email as email','users.mobile as mobile','users.username as username')
        ->where('winners.quiz_id',$id)
        ->get();

        
        return view('quiz.participatesodtl', ['quizes' => $quizes,
        'totalusers'=>$totalusers,'winners'=>$winners,'now'=>$numberofwinner,'totalCorrect'=>$totalCorrect]);

        // return view('quiz.participatesodtl', compact('users'));
    }

    public function qNotParticipate()
    {
        $quiz = Quiz::all();
        return view('quiz.notparticipate', compact('quiz'));
    }

    public function qNotParticipateDtl($id)
    {
        $qid=(int)$id;
        $checkUser=DB::table('quiz_takens')
             ->where('quiz_id',$qid)->pluck('user_id')->all();
        $users = User::whereNotIn('id',  $checkUser)->select('*')->get();

        return view('quiz.notparticipatedtl', compact('users','qid'));
    }

 

    // question
    public function addQuestion(Request $request)
    {
        try{
            $question = new Question();
            $question->question = $request->question;
            $question->answer = $request->answer;
            $question->option1 = $request->option1;
            $question->option2 = $request->option2;
            $question->option3 = $request->option3;
            $question->option4 = $request->option4;
            $question->quiz_id = $request->quizid;
            $question->created_by = Auth::user()->id;
            $question->save();

            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Data Created Successfully.</b></div>";

            return response()->json(['status'=> 300,'message'=>$message]);
        }catch (\Exception $e){
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);

        }
    }

    public function deleteQst(Request $request)
    {

            if(Question::destroy($request->qid)){

                $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Question Deleted Successfully.</b></div>";

                return response()->json(['status'=> 300, 'message'=>$message]);
            }else{
                return response()->json(['status'=> 303,'message'=>'Delete Failed']);
            }
    }


    public function editQst($id)
    {
        $where = [
            'id'=>$id
        ];
        $info = Question::where($where)->get()->first();
        return response()->json($info);
    }

    public function updateQuestion(Request $request)
    {
        $ques = Question::find($request->qstid);
        $ques->answer = $request->answer;
        $ques->option1 = $request->option1;
        $ques->option2 = $request->option2;
        $ques->option3 = $request->option3;
        $ques->option4 = $request->option4;
        $ques->question = $request->question;
          
        if ($ques->save()) {
            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Question Updated Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
        }
        else{
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        }
    }


    // edit quiz from user.

    public function quizedit()
    {

        $userid=auth()->user()->id;
          
      $quiz = DB::table('quizzes')
      ->join('quiz_takens', 'quizzes.id', '=', 'quiz_takens.quiz_id')
      ->where('quiz_takens.user_id', '=', $userid)
      ->where('expiry_date','>=',date("Y/m/d"))
      ->select('quizzes.*')
      ->get();
        
      $quizo = DB::table('quizzes')
            ->join('quiz_takens', 'quizzes.id', '=', 'quiz_takens.quiz_id')
            ->where('quiz_takens.user_id', '=', $userid)
            ->where('expiry_date','>=',date("Y/m/d"))
            ->select('quizzes.id')
            ->count();
        // dd($quiz);
           
        if ($quizo != null) {

            return view('frontend.user.editquiz', ['quiz' => $quiz]);

        } else {

            $message = "You Have not Taken the quiz.";
            return view('frontend.user.editquiz', ['msg' => $message]);

        }


    }

    public function editquiz($id)
    {
        if(!auth()->user())
        {
            return redirect('/');
        }
        $qid = (int)$id;

        $uid = auth()->user()->id;
        $fcheck = DB::table('answers')
            ->join('questions', 'answers.question_id', '=', 'questions.id')
            ->join('quizzes', 'quizzes.id', '=', 'questions.quiz_id')
            ->where('answers.user_id', '=', $uid)
            ->where('questions.quiz_id', '=', $qid)
            ->select('answers.answer','answers.id')
            ->get();
           
        if ($fcheck== null) {
            $msg = "Nothing to Edit";
            return view('frontend.user.editquiz', ['msg' => $msg]);
        } else {
            $quiz = DB::table('quizzes')
                ->select('*')
                ->where('id', '=', $qid)
                ->get();


            $question = DB::table('questions')
                ->select('*')
                ->where('quiz_id', $qid)
                ->get();
               
            return view('frontend.user.editquizes', ['quiz' => $quiz, 'question' => $question, 'fcheck' => $fcheck]);

        }

    }


    public function quizupdate(Request $request,$id)
        {
            


            $qid=(int)$id;
            $userid = auth()->user()->id;

            $scoreid=DB::table('scores')
                    ->select('id')
                    ->where('quiz_id',$qid)
                    ->where( 'user_id',$userid)
                    ->first();

            $totaledit = Score::where('id', '=', $scoreid->id)->get()->first()->countedit;

            if ($totaledit <= 3) {

                $questionid = $request->questions;
                $answers=$request->aid;
                
                for ($i = 1; $i <= sizeof($questionid); $i++) {
                    $answer = Answer::findOrFail($answers[$i]);
                    $answer ->update([
                    $options = "option" . $request->questions[$i],
                    $a = $request->$options,
                    'answer'=> $a,
                        'user_id'=> $userid,
                        'question_id'=>$questionid[$i],

                ]);
                }

                $questionAnswer= DB::table('questions')
                ->select('id','answer')
                ->where('quiz_id', $qid)
                ->get();

            $userAnswer = DB::table('answers')
                ->leftJoin('questions','questions.id','=','answers.question_id')
                ->where('questions.quiz_id', $qid )
                ->where('answers.user_id', $userid )
                ->select ('answers.user_id','answers.answer')
                ->orderBy('answers.id')
                ->get();
                $cnt=0;
                for ($i = 0; $i < sizeof($userAnswer); $i++)
                {

                        if($questionAnswer[$i]->answer==$userAnswer[$i]->answer)
                        {
                            $cnt++;
                        }

                }
                $scoreid=DB::table('scores')
                ->select('id')
                ->where('quiz_id',$qid)
                ->where( 'user_id',$userid)
                ->first();

                $score = Score::findOrFail($scoreid->id);
                $score->score = $cnt;
                $score->countedit = $score->countedit + 1;
                $score->save();
                return redirect()->back()->withErrors(['Answer updated successfully']);


            } else{

                return redirect()->back()->withErrors(['Your edit limit is over.']);
            }
            
        }



    // quiz result show user dashboard

    public function quizResult()
    {

        $userid=auth()->user()->id;
          
      $quiz = DB::table('quizzes')
            ->join('scores', 'quizzes.id', '=', 'scores.quiz_id')
            ->where('scores.user_id', '=', $userid)
            ->where('expiry_date','>=',date("Y/m/d"))
            ->select('quizzes.*','scores.score')
            ->get();

            // dd($quiz);
                

        return view('frontend.user.result', ['quiz' => $quiz]);

    }


    public function quizWinner()
    {
        $quiz = Quiz::all();

        return view('frontend.user.winquiz', compact('quiz'));
    }

    public function quizWinnerDetails($id)
    {
        // $quiz = Quiz::all();

        $quiz = DB::table('users')
            ->join('winners', 'users.id', '=', 'winners.user_id')
            ->select('users.id as uid','users.name','users.email','users.username','winners.user_id','winners.quiz_id')
            ->where('winners.quiz_id', '=', $id)
            ->get();

        return view('frontend.user.windtl', compact('quiz'));
    }

    // change status

    public function changeStatus(Request $request)
    {
        $user = Quiz::find($request->id);
        $user->status = $request->status;
        $user->save();

        if($request->status==1){
            $user = Quiz::find($request->id);
            $user->status = $request->status;
            $user->save();
            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Active Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
        }else{
            $user = Quiz::find($request->id);
            $user->status = $request->status;
            $user->save();
            $message ="<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Inactive Successfully.</b></div>";
        return response()->json(['status'=> 300,'message'=>$message]);
        }
    }


}

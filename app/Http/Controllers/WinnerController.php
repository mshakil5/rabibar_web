<?php

namespace App\Http\Controllers;

use App\Models\Winner;
use App\Models\Quiz;
use Hash;
use Auth;
use DB;
use Illuminate\Http\Request;

class WinnerController extends Controller
{
    public function index()
    {
        $winners= DB::table('winners')
                ->select('winners.id as wid','winners.quiz_id','winners.point','winners.position','winners.created_at','winners.gift','users.*','quizzes.id as qid','quizzes.quiz')
                ->join('users','users.id','=','winners.user_id')
                ->join('quizzes','quizzes.id','=','winners.quiz_id')
                ->orderby('winners.id','DESC')
                ->get();


        $users =  DB::table('users')->get();
        $quizzes = Quiz::all();
        // dd($users );
        return view('winner.index', compact('winners','users','quizzes'));
    }

    public function store(Request $request)
    {
        try{
            $account = new Winner();
            $account->gift = $request->gift;
            $account->position = $request->position;
            $account->point = $request->point;
            $account->quiz_id = $request->quiz_id;
            $account->user_id = $request->user_id;
            $account->save();

            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Data Created Successfully.</b></div>";

            return response()->json(['status'=> 300,'message'=>$message]);
        }catch (\Exception $e){
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);

        }
    }

    public function edit($id)
    {
        $where = [
            'id'=>$id
        ];
        $info = Winner::where($where)->get()->first();
        return response()->json($info);
    }

    public function update(Request $request)
    {
        $post = Winner::find($request->codeid);
        $post->user_id = $request->user_id;
        $post->quiz_id = $request->quiz_id;
        $post->point = $request->point;
        $post->position = $request->position;
        $post->gift = $request->gift;
        if ($post->save()) {
            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Data Updated Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
        }
        else{
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        }
    }

    public function destroy($id)
    {
        if(Winner::destroy($id)){
            return response()->json(['success'=>true,'message'=>'Data has been deleted successfully']);
        }else{
            return response()->json(['success'=>false,'message'=>'Delete Failed']);
        }
    }

    public function SelectWinner($id)
    {
        

        $user =  DB::table('users')->where('id','=', $id)->first();
        $quizzes = Quiz::all();
        // dd($users );
        return view('winner.winnerselect', compact('user','quizzes'));
    }
}

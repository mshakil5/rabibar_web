<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Reply;
use App\Models\Contact;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function comment()
    {
        $comments= DB::table('comments')
                ->select('comments.*','users.id as uid','users.name','users.username','users.email',)
                ->join('users','users.id','=','comments.user_id')
                ->get();

        return view('notification.comment',compact('comments'));
    }

    public function changeStatus(Request $request)
    {
        $user = Comment::find($request->id);
        $user->status = $request->status;
        $user->save();

        if($request->status==1){
            $user = Comment::find($request->id);
            $user->status = $request->status;
            $user->save();
            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Active Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
        }else{
            $user = Comment::find($request->id);
            $user->status = $request->status;
            $user->save();
            $message ="<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Inactive Successfully.</b></div>";
        return response()->json(['status'=> 300,'message'=>$message]);
        }
    }

    public function reply()
    {
        $reply= DB::table('replies')
                ->select('replies.*','users.id as uid','users.name','users.username','users.email',)
                ->join('users','users.id','=','replies.user_id')
                ->get();
                // dd($reply);

        return view('notification.reply',compact('reply'));
    }

    public function destroy($id)
    {
        if(Comment::destroy($id)){
            return response()->json(['success'=>true,'message'=>'Comment has been deleted successfully']);
        }else{
            return response()->json(['success'=>false,'message'=>'Delete Failed']);
        }
    }





    public function replychangeStatus(Request $request)
    {
        $user = Reply::find($request->id);
        $user->status = $request->status;
        $user->save();

        if($request->status==1){
            $user = Reply::find($request->id);
            $user->status = $request->status;
            $user->save();
            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Active Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
        }else{
            $user = Reply::find($request->id);
            $user->status = $request->status;
            $user->save();
            $message ="<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Inactive Successfully.</b></div>";
        return response()->json(['status'=> 300,'message'=>$message]);
        }
    }

    public function replydestroy($id)
    {
        if(Reply::destroy($id)){
            return response()->json(['success'=>true,'message'=>'Reply has been deleted successfully']);
        }else{
            return response()->json(['success'=>false,'message'=>'Delete Failed']);
        }
    }

    public function contactShow()
    {
        $contacts = Contact::orderBy('created_at', 'DESC')->get();
        return view('contact.index')->with('contacts',$contacts);
    }



}

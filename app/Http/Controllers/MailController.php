<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sendmail;
use Illuminate\support\Facades\Auth;

class MailController extends Controller
{
    // test function 

    public function mailindex()
    {
        // $quiz = Quiz::all();
        $mail = Sendmail::all();
        return view('mail.mailindex', compact('mail'));
    }

    public function mailedit($id)
    {
        $where = [
            'id'=>$id
        ];
        $info = Sendmail::where($where)->get()->first();
        return response()->json($info);
    }

    public function mailupdate(Request $request, $id)
    {
        $master = Sendmail::find($id);
        
        $master->subject= $request->subject;
        $master->body= $request->details;

        if ($master->save()) {
            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b> Updated Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
        }else{
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        }
    }




}

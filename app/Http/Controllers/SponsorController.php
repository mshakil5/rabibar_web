<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use App\Models\SponsorAssign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SponsorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd("controller called");
        $sponsor = Sponsor::all();
        return view('sponsor.index',compact('sponsor'));
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
        try{
            $spon = new Sponsor();
            $spon->name = $request->name;
            $spon->email = $request->email;
            $spon->mobile = $request->phone;
            $spon->address = $request->address;
            $spon->created_by = Auth::user()->id;
            $spon->save();

            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Data Created Successfully.</b></div>";

            return response()->json(['status'=> 300,'message'=>$message]);
        }catch (\Exception $e){
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function show(Sponsor $sponsor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $where = [
            'id'=>$id
        ];
        $info = Sponsor::where($where)->get()->first();
        return response()->json($info);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Sponsor::find($id);
        $post->name = $request->name;
        $post->email = $request->email;
        $post->mobile = $request->phone;
        $post->address = $request->address;
        $post->updated_by = Auth::user()->id;
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
     * @param  \App\Models\Sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sponsor $sponsor)
    {
        if(Sponsor::destroy($sponsor->id)){
            return response()->json(['success'=>true,'message'=>'Data has been deleted successfully']);
        }else{
            return response()->json(['success'=>false,'message'=>'Delete Failed']);
        }
    }

    public function changeStatus(Request $request)
    {
        $user = Sponsor::find($request->id);
        $user->status = $request->status;
        $user->save();

        if($request->status==1){
            $user = Sponsor::find($request->id);
            $user->status = $request->status;
            $user->save();
            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Active Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
        }else{
            $user = Sponsor::find($request->id);
            $user->status = $request->status;
            $user->save();
            $message ="<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Inactive Successfully.</b></div>";
        return response()->json(['status'=> 300,'message'=>$message]);
        }
    }

    public function sponsorassign()
    {
        // dd("controller called");
        $date = today()->format('Y-m-d');
        // $quizes=DB::select(DB::raw("select * from quizzes where status=1 && expiry_date > $date && id not in ( select quiz_id from sponsor_assigns where quizzes.id=sponsor_assigns.quiz_id )"));

        $quizes=DB::select(DB::raw("select * from quizzes where status=1 && expiry_date > $date "));
        $sponsor = Sponsor::all();
        $date = today()->format('Y-m-d');
        $sponsors=DB::table('sponsor_assigns as sa')
                    ->join('quizzes as q','q.id','=','sa.quiz_id')
                    ->join('sponsors as s','s.id','=','sa.sponsor_id')
                    ->select('q.quiz','s.name','sa.description','sa.id')
                    ->where('q.status','=',1)
                    ->where('q.expiry_date','>=',$date)
                    ->get();
        return view('sponsor.assign',compact('sponsor','quizes','sponsors'));
    }

    public function sponsorassignStore(Request $request)
    {
        try{
            $spon = new SponsorAssign();
            $spon->sponsor_id = $request->sponsor_id;
            $spon->quiz_id = $request->quiz_id;
            $spon->description = $request->desc;
            $spon->created_by = Auth::user()->id;
            $spon->save();

            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Data Created Successfully.</b></div>";

            return response()->json(['status'=> 300,'message'=>$message]);
        }catch (\Exception $e){
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);

        }
    }

    public function sponsorassignEdit($id)
    {
        $where = [
            'id'=>$id
        ];
        $info = SponsorAssign::where($where)->get()->first();
        return response()->json($info);
    }

    public function sponsorassignUpdate(Request $request, $id)
    {
        $post = SponsorAssign::find($id);
        $post->sponsor_id = $request->sponsor_id;
        $post->quiz_id = $request->quiz_id;
        $post->description = $request->desc;
        $post->updated_by = Auth::user()->id;
        if ($post->save()) {
            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Data Updated Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
        }
        else{
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        }
    }

    public function sponsorassignDelete($id)
    {
        if(SponsorAssign::destroy($id)){
            return response()->json(['success'=>true,'message'=>'Data has been deleted successfully']);
        }else{
            return response()->json(['success'=>false,'message'=>'Delete Failed']);
        }
    }

    //report

    public function sponsorReport()
    {

        $report=DB::table('sponsor_assigns as sa')
                    ->join('sponsors as s','s.id','=','sa.sponsor_id')
                    ->select('s.id as sid','s.name','s.email','s.mobile','sa.description','sa.id as said')
                    ->get();

        // dd($report);



        // $report=Sponsor::all();
        return view('sponsor.report',compact('report'));
    }

    public function sponsorReportDetails($id)
    {
        $countSpo=DB::table('sponsor_assigns')
                    ->select('id')
                    ->where('sponsor_id',$id)
                    ->count();
         $spoName=   DB::table('sponsor_assigns as sp')
                    ->join('sponsors as q','q.id','=','sp.sponsor_id')
                    ->select('q.name')
                     ->where('sp.sponsor_id','=',$id)
                    ->get();  
        
        $spoDetails=DB::table('sponsor_assigns as sp')
                    ->join('quizzes as q','q.id','=','sp.quiz_id')
                    ->select('q.quiz','sp.description','sp.created_at')
                    ->where('sp.sponsor_id','=',$id)
                    ->get();

        return view('sponsor.reportdetail',compact('countSpo','spoName','spoDetails'));
    }


}

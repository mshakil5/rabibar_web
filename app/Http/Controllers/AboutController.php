<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Aboutcode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $softcode= Aboutcode::all('name');
        $masters = About::where('softcode', '=', 'about')->get();
        return view('about.index',compact('masters','softcode'));
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
            $about = new About();
            $about->softcode= $request->softcode;
            $about->hardcode= $request->hardcode;

            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $rand = mt_rand(100000, 999999);
            $imageName = time(). $rand .'.'.$request->image->extension();
            $request->image->move(public_path('about'), $imageName);
            $about->image= $imageName;

            $about->details= $request->details;
            $about->sort_details= $request->sort_details;
            $about->created_by= Auth::user()->id;
            $about->save();

            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>About Created Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);

        }catch (\Exception $e){
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function show(About $about)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $where = [
            'id'=>$id
        ];
        $info = About::where($where)->get()->first();
        return response()->json($info);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $master = About::find($id);
        $master->hardcode= $request->hardcode;
        $master->details= $request->details;

        if ($master->save()) {
            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>About Updated Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
        }else{
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function destroy(About $about)
    {
        if(About::destroy($about->id)){
            return response()->json(['success'=>true,'message'=>'Listing Deleted']);
        }
        else{
            return response()->json(['success'=>false,'message'=>'Update Failed']);
        }
    }


    public function aboutTitle()
    {
        $codes = Aboutcode::all();
        return view('about.title')->with('codes',$codes);
    }

    public function aboutTitleStore(Request $request)
    {
        try{
            $account = new Aboutcode();
            $account->name = $request->name;
            $account->created_by;
            $account->save();

            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Data Created Successfully.</b></div>";

            return response()->json(['status'=> 300,'message'=>$message]);
        }catch (\Exception $e){
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);

        }
    }

    public function aboutTitleEdit($id)
    {
        $where = [
            'id'=>$id
        ];
        $info = Aboutcode::where($where)->get()->first();
        return response()->json($info);
    }

    public function aboutTitleUpdate(Request $request, $id)
    {
        $post = Aboutcode::find($id);
        $post->name = $request->name;
        if ($post->save()) {
            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Data Updated Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
        }
        else{
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        }
    }

    public function aboutTitleDelete( $id)
    {
        if(Aboutcode::destroy($id)){
            return response()->json(['success'=>true,'message'=>'Data has been deleted successfully']);
        }else{
            return response()->json(['success'=>false,'message'=>'Delete Failed']);
        }
    }

    public function terms()
    {
        $softcode= Aboutcode::all('name');
        $masters = About::where('softcode', '=', 'terms')->get();
        return view('about.terms',compact('masters','softcode'));
    }

    public function termsEdit($id)
    {
        $where = [
            'id'=>$id
        ];
        $info = About::where($where)->get()->first();
        return response()->json($info);
    }

    public function termsUpdate(Request $request, $id)
    {
        $master = About::find($id);
        $master->hardcode= $request->hardcode;
        $master->details= $request->details;

        if ($master->save()) {
            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Terms and condition updated Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
        }else{
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        }
    }

    public function privacy()
    {
        $softcode= Aboutcode::all('name');
        $masters = About::where('softcode', '=', 'privacy')->get();
        return view('about.privacy',compact('masters','softcode'));
    }

    public function privacyEdit($id)
    {
        $where = [
            'id'=>$id
        ];
        $info = About::where($where)->get()->first();
        return response()->json($info);
    }

    public function privacyUpdate(Request $request, $id)
    {
        $master = About::find($id);
        $master->hardcode= $request->hardcode;
        $master->details= $request->details;

        if ($master->save()) {
            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Privacy updated Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
        }else{
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        }
    }







}

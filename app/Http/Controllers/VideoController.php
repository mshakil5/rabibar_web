<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Input as input;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = Video::all();
        $position = Video::where('position','=','top')->get();
        return view('video.index', compact('videos'));
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
    public function store2(Request $request)
    {
        // return response()->json(['status'=> 303,'message'=>$request->video]);


        try{
            $data = new Video();
            $data->title= $request->title;


            $request->validate([
                'video' => 'required|MPEG-4|mimes:mp4|max:60000',
            ]);
            $rand = mt_rand(100000, 999999);
            $videoName = time(). $rand .'.'.$request->video->extension();
            $request->video->move(public_path('video'), $videoName);
            $data->name= $videoName;

            $data->position= $request->position;
            $data->status= '1';
            $data->created_by= Auth::user()->id;
            $data->save();

            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Data Created Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);


        }catch (\Exception $e){
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);

        }

    }

    public function store(Request $request)
    {
        // dd($request->title, $request->video, $request->position,);
            // $data = new Video();
            // $data->title= $request->title;
            // if($request->hasFile('video')){
            //     $video_tmp = $request->video;
            //     $video_name = $video_tmp->getClientOriginalName();
            //     $video_path = 'video/';
            //     $video_tmp->move($video_path,$video_name);
            //     $data->name = $video_name;
            // }
            // $data->position= $request->position;
            // $data->status= '1';
            // $data->created_by= Auth::user()->id;
            // $data->save();
            // if ($data->save()) {
            //     return redirect()->route('video.index');
            // } else {
            //     return redirect()->route('terms');
            // }
            // new
            $data=$request->all();
              $rules=[
                'video'          =>'mimes:mpeg,ogg,mp4,webm,3gp,mov,flv,avi,wmv,ts|max:100040|required'];
             $validator = Validator($data,$rules);

             if ($validator->fails()){
                 return redirect()
                             ->back()
                             ->withErrors($validator)
                             ->withInput();
             }else{
                $video=$data['video'];
                $input = time().'.'.$video->getClientOriginalExtension();
                $destinationPath = 'videos';
                $video->move($destinationPath, $input);

                $videoup = new Video();
                $videoup->title= $request->title;
                $videoup->name = $input;
                $videoup->position= $request->position;
                $videoup->status= '1';
                $videoup->created_by= Auth::user()->id;
                $videoup->save();
                return redirect()->back()->with('upload_success','upload_success');
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if( Video::destroy($id)){
            return response()->json(['success'=>true,'message'=>'Data has been deleted successfully']);
        }else{
            return response()->json(['success'=>false,'message'=>'Delete Failed']);
        }
    }
}

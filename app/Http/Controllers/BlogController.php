<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\VideoCat;
use App\Models\VideoBlog;
use App\Models\Reply;
use DB;
use App\Models\Comment;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs= DB::table('blogs')
                ->select('blogs.*','blog_categories.id as bid','blog_categories.name',)
                ->join('blog_categories','blog_categories.id','=','blogs.category_id')
                ->paginate(10);
        // dd($blogs);

        $cats = BlogCategory::all();
        return view('blog.index', compact('cats','blogs'));
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
            $data = new Blog();
            $data->category_id= $request->category;
            $data->title= $request->title;

            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $rand = mt_rand(100000, 999999);
            $imageName = time(). $rand .'.'.$request->image->extension();
            $request->image->move(public_path('blogimage'), $imageName);
            $data->photo= $imageName;

            $data->details= $request->details;
            $data->source= $request->source;
            $data->created_by= Auth::user()->id;
            $data->save();

            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Data Created Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);

        }catch (\Exception $e){
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $where = [
            'id'=>$id
        ];
        $info = Blog::where($where)->get()->first();
        return response()->json($info);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $master = Blog::find($id);
        if($request->image != 'null'){
            $image_path = public_path('blogimage').'/'.$master->image;
            unlink($image_path);
            $master->category_id= $request->category;
            $master->title= $request->title;

            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $rand = mt_rand(100000, 999999);
            $imageName = time(). $rand .'.'.$request->image->extension();
            $request->image->move(public_path('blogimage'), $imageName);
            $master->photo= $imageName;

            $master->details= $request->details;
            $master->source= $request->source;
        }else{

            $master->category_id= $request->category;
            $master->title= $request->title;
            $master->details= $request->details;
            $master->source= $request->source;
        }

        if ($master->save()) {
            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Data Updated Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
        }else{
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        if(Blog::destroy($blog->id)){
            return response()->json(['success'=>true,'message'=>'Data has been deleted successfully']);
        }else{
            return response()->json(['success'=>false,'message'=>'Delete Failed']);
        }
    }

    public function blogCategory()
    {
        $cats = BlogCategory::all();
        return view('blog.category', compact('cats'));
    }

    public function blogCategoryStore(Request $request)
    {
        $data = new BlogCategory;
        $data->name = $request->name;
        $data->slug = $request->slug;
        $data->created_by = Auth::user()->id;
        if($data->save()){
            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Data Created Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
        }

        return response()->json(['status'=> 303,'message'=>'Server Error!!']);
    }

    public function blogCategoryEdit($id)
    {
        $where = [
            'id'=>$id
        ];
        $info = BlogCategory::where($where)->get()->first();
        return response()->json($info);
    }

    public function blogCategoryUpdate(Request $request, $id)
    {
        $post = BlogCategory::find($id);
        $post->name = $request->name;
        $post->slug = $request->slug;
        $post->updated_by = Auth::user()->id;
        if ($post->save()) {
            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Data Updated Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
        }
        else{
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        }
    }

    public function blogCategoryDelete(BlogCategory $id)
    {
        if(BlogCategory::destroy($id->id)){
            return response()->json(['success'=>true,'message'=>'Data has been deleted successfully']);
        }else{
            return response()->json(['success'=>false,'message'=>'Delete Failed']);
        }
    }

    // video blog category start

    public function videoBlogCategory()
    {
        $cats = VideoCat::all();
        return view('videoblog.category', compact('cats'));
    }

    public function videoBlogCategoryStore(Request $request)
    {
        $data = new VideoCat;
        $data->name = $request->name;
        $data->slug = $request->slug;
        $data->created_by = Auth::user()->id;
        if($data->save()){
            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Data Created Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
        }

        return response()->json(['status'=> 303,'message'=>'Server Error!!']);
    }

    public function videoBlogCategoryEdit($id)
    {
        $where = [
            'id'=>$id
        ];
        $info = VideoCat::where($where)->get()->first();
        return response()->json($info);
    }

    public function videoBlogCategoryUpdate(Request $request, $id)
    {
        $post = VideoCat::find($request->codeid);
        $post->name = $request->name;
        $post->slug = $request->slug;
        $post->updated_by = Auth::user()->id;
        if ($post->save()) {
            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Data Updated Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
        }
        else{
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        }
    }

    public function videoBlogCategoryDelete(VideoCat $id)
    {
        if(VideoCat::destroy($id->id)){
            return response()->json(['success'=>true,'message'=>'Data has been deleted successfully']);
        }else{
            return response()->json(['success'=>false,'message'=>'Delete Failed']);
        }
    }

    //video blog start

    public function videoBlog()
    {
        $blogs= DB::table('video_blogs')
                ->select('video_blogs.*','video_cats.id as bid','video_cats.name',)
                ->join('video_cats','video_cats.id','=','video_blogs.category_id')
                ->orderBy('created_at', 'DESC')
                ->paginate(10);
        // dd($blogs);

        $cats = VideoCat::all();
        
        return view('videoblog.index', compact('cats','blogs'));
    }


    public function videoBlogStore(Request $request)
    { 

        // dd('controller called');
        
        try{
            $data = new VideoBlog();
            $data->category_id= $request->category;
            $data->title= $request->title;
            $data->position= $request->position;
            $data->link= $request->link;
            $data->short_description= $request->short_description;
            $data->long_description= $request->long_description;
            $data->created_by= Auth::user()->id;
            $data->save();

            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Data Created Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);

        }catch (\Exception $e){
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);

        }

    }

    public function videoBlogEdit($id)
    {
        $where = [
            'id'=>$id
        ];
        $info = VideoBlog::where($where)->get()->first();
        return response()->json($info);
    }

    public function videoBlogUpdate(Request $request, $id)
    {
        $post = VideoBlog::find($request->codeid);
        $post->category_id = $request->category;
        $post->title = $request->title;
        $post->position = $request->position;
        $post->link = $request->link;
        $post->short_description = $request->short_description;
        $post->long_description = $request->long_description;
        $post->updated_by = Auth::user()->id;
        if ($post->save()) {
            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Data Updated Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
        }
        else{
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        }
    }

    public function videoBlogDelete(VideoBlog $id)
    {
        if(VideoBlog::destroy($id->id)){
            return response()->json(['success'=>true,'message'=>'Data has been deleted successfully']);
        }else{
            return response()->json(['success'=>false,'message'=>'Delete Failed']);
        }
    }



    // frontend show 

    public function blogShow()
    {
        $blogs= DB::table('blogs')
                ->select('blogs.*','blog_categories.id as bid','blog_categories.name',)
                ->join('blog_categories','blog_categories.id','=','blogs.category_id')
                ->paginate(9);
        // dd($blogs);

        $cats = BlogCategory::all();
        return view('frontend.blog', compact('cats','blogs'));
    }

    public function blogdetails($id)
    {
        $blogdtls= DB::table('blogs')
                ->select('blogs.*','blog_categories.id as bid','blog_categories.name',)
                ->join('blog_categories','blog_categories.id','=','blogs.category_id')
                ->where('blogs.id', '=', decrypt($id))
                ->first();
        // dd($blogdtls);

        $cats = BlogCategory::all();
        $blogs = Blog::all();
        // $comments = Comment::where('blog_id', '=', decrypt($id))->get();


        $comments= DB::table('users')
        ->leftJoin('comments', 'users.id', '=', 'comments.user_id')
        ->select('comments.id as cid','comments.user_id','comments.blog_id','comments.comment','comments.status', 'users.*')
        ->where([
            ['comments.blog_id', '=', decrypt($id)],
            ['comments.status', '=', '1'],
        ])->paginate(5);


        return view('frontend.blogdtl', compact('cats','blogdtls','blogs','comments'));
    }

    public function blogPost(Request $request)
    {
        
        try{
            $bcmnt = new Comment();
            $bcmnt->comment = $request->comment;
            $bcmnt->blog_id = $request->bcmntid;
            $bcmnt->user_id = Auth::user()->id;
            $bcmnt->status = "1";
            $bcmnt->created_by = Auth::user()->id;
            $bcmnt->save();

            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Your comment done.</b></div>";

            return response()->json(['status'=> 300,'message'=>$message]);
        }catch (\Exception $e){
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);

        }
    }

    public function blogReplyPost(Request $request)
    {
        
        try{
            $bcmnt = new Reply();
            $bcmnt->reply = $request->reply;
            $bcmnt->comment_id = $request->cmntid;
            $bcmnt->blog_id = $request->bcmntid;
            $bcmnt->user_id = Auth::user()->id;
            $bcmnt->status = "1";
            $bcmnt->created_by = Auth::user()->id;
            $bcmnt->save();

            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Your Reply done.</b></div>";

            return response()->json(['status'=> 300,'message'=>$message]);
        }catch (\Exception $e){
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);

        }
    }

    // video blog show

    // public function videoblogShow()
    // {
        

    //     $blogs= DB::table('video_blogs')
    //             ->select('video_blogs.*','video_cats.id as bid','video_cats.name',)
    //             ->join('video_cats','video_cats.id','=','video_blogs.category_id')
    //             ->get();
    //     // dd($blogs);

    //     $cats = VideoCat::all();

    //     $animels = DB::table('video_blogs')
    //             ->select('video_blogs.*','video_cats.id as bid','video_cats.name',)
    //             ->join('video_cats','video_cats.id','=','video_blogs.category_id')
    //             ->where('video_cats.name', '=', 'Trending videos')
    //             ->orderBy('created_at', 'DESC')
    //             ->get();
    //     return view('frontend.videoblog', compact('cats','blogs','animels'));
    // }

    public function videoblogShow()
    {
        $blogs = VideoBlog::with(['category:id,name'])
            ->select('id', 'title', 'link', 'category_id', 'created_at')
            ->get();

        $cats = VideoCat::select('id', 'name')->get();

        $animels = VideoBlog::with(['category:id,name'])
            ->whereHas('category', function ($query) {
                $query->where('name', 'Trending videos');
            })
            ->orderBy('created_at', 'DESC')
            ->select('id', 'title', 'link', 'category_id', 'created_at')
            ->get();

        return view('frontend.videoblog', compact('cats', 'blogs', 'animels'));
    }
}

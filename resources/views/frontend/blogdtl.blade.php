@extends('frontend.layouts.index') 
@section('content')



<section class="blog-details" >
    <div class="container">


        <div class="row">
            <div class="col-lg-8 ">
                <div class="blog-content">
                    <div class="feature-image">
                        <img src="{{url('blogimage/'.$blogdtls->photo)}}" alt="">
                        {{-- <img src="https://royalscripts.com/product/geniuscart/fashion/assets/images/blogs/15542700322-min.jpg" alt=""> --}}
                    </div>
                    <div class="content border p-4">
                        <h3 class="title">
                            {{ $blogdtls->title }}
                        </h3>
                        <ul class="post-meta">
                            <li>
                                <a href=" ">
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                    {{ date('d M, Y',strtotime($blogdtls->created_at)) }}
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                    66 View(s)
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <i class="fa fa-comments" aria-hidden="true"></i>
                                    Source : {{ $blogdtls->source }}
                                </a>
                            </li>
                        </ul>

                        <div align="justify"> {!! $blogdtls->details !!}<br><br>
                        </div>
                        
                        
                       
                        

                        <div class="tag-social-link">
                            <div class="tag">
                                <h6 class="title">Tag : </h6>
                                {{ $blogdtls->tag }}
                                {{-- <a href="">
                                    Business,
                                </a>
                                <a href="">
                                    Research,
                                </a>
                                <a href="">
                                    Mechanical,
                                </a>
                                <a href="">
                                    Process,
                                </a>
                                <a href="">
                                    Innovation,
                                </a>
                                <a href="">
                                    Engineering
                                </a> --}}
                            </div>

                            <div class="social-sharing a2a_kit a2a_kit_size_32" style="line-height: 32px;">
                                <ul class="social-links">
                                    <li>
                                        <a class="facebook a2a_button_facebook" href="/#facebook" target="_blank"
                                            rel="nofollow noopener">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="twitter a2a_button_twitter" href="/#twitter" target="_blank"
                                            rel="nofollow noopener">
                                            <i class="fab fa-twitter"></i>
                                        </a>

                                    </li>
                                    <li>
                                        <a class="linkedin a2a_button_linkedin" href="/#linkedin" target="_blank"
                                            rel="nofollow noopener">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>

                                    </li>
                                    <li>

                                        <a class="a2a_dd plus"
                                            href="https://www.addtoany.com/share#url=https%3A%2F%2Froyalscripts.com%2Fproduct%2Fgeniuscart%2Ffashion%2Fblog%2F17&amp;title=Genius%20Cart">
                                            <i class="fas fa-plus"></i>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                            <!-- <script async="" src="https://static.addtoany.com/menu/svg/icons.29.svg.js"></script> -->
                            <script async="" src="https://static.addtoany.com/menu/page.js"></script>
                        </div>
                    </div>
                </div><br>


                    {{-- comment form --}}
                @if (!empty(Auth::user()->id))
                <div class="content">
                    <h3 class="title"> Make a comment </h3>
                    <div class="ermsg"></div>
                    
                    
                    <div class="form-group">
                        <textarea name="comment" id="comment" cols="30" rows="5" class="form-control" required></textarea>
                    </div>
                    <input type="hidden" class="form-control" id="bcmntid" name="bcmntid" value="{{ $blogdtls->id }}">

                    <div class="text-right mt-4">
                        <button type="submit" id="cmtBtn" class="btn-theme">Submit</button>
                    </div>

                </div><br>
                @else
                @endif
                {{-- comment form end --}}

              {{-- comment show --}}
                <h3 class="title"> All Comments </h3><br>
                @foreach ($comments as $comment)
                    <div class="content border p-4">
                        <p><strong>Comment:</strong> {{ $comment->comment}}</p>
                        <p>Name:  {{ $comment->name}}</p>

                        {{-- reply start --}}
                        @foreach (App\Models\Reply::where('comment_id', '=', $comment->cid)->where('status', '=', '1')->orderBy('created_at', 'ASC')->get() as $reply)
                            <div class="content border p-4" style="margin-left: 110px;">
                                <p><strong>Reply:</strong> {{ $reply->reply}}</p>
                                {{-- <p>Name:  {{ $comment->name}}</p> --}}
                            </div><br>
                        @endforeach
                        {{-- reply end --}}

                        @if (!empty(Auth::user()->id))
                            {{-- <div class="repermsg"></div> --}}
                            <div class="form-group" style="margin-left: 110px;">
                                <textarea name="reply" id="reply{{ $comment->cid }}" cols="30" rows="2" class="form-control" required></textarea>
                            </div>
                            <input type="hidden" id="commentid" name="commentid" value="{{ $comment->cid }}">

                            <div class="text-right mt-4" style="margin-left: 110px;">
                                <button type="submit" cmntid="{{$comment->cid}}" class="btn-theme replybtn">Reply</button>
                            </div>
                        @else
                        @endif
                    </div><br>
                @endforeach
              {{-- comment show end --}}





            </div>

            <div class="col-lg-4">
                <div class="blog-aside">
                    <div class="serch-form">
                        <form action="https://royalscripts.com/product/geniuscart/fashion/blog-search">
                            <input type="text" name="search" placeholder="Search" required="">
                            <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </form>
                    </div>
                    <div class="categori">
                        <h4 class="title">Categories</h4>
                        <span class="separator"></span>
                        <ul class="categori-list">


                            @foreach ($cats as $data)
                                
                                <li>
                                    <a
                                        href="https://royalscripts.com/product/geniuscart/fashion/blog/category/oil-and-gas">
                                        <span>{{ $data->name }}</span>
                                        <span>(7)</span>
                                    </a>
                                </li>

                            @endforeach
                            
                            
                            
                            

                        </ul>
                    </div>
                    <div class="recent-post-widget">
                        <h4 class="title">Recent Post</h4>
                        <span class="separator"></span>
                        <ul class="post-list">

                            @foreach ($blogs as $blog)
                                <li>
                                    <div class="post">
                                        <div class="post-img">
                                            <img style="width: 73px; height: 59px;" src="{{url('blogimage/'.$blog->photo)}}" alt="">
                                        </div>
                                        <div class="post-details">
                                            <a href="{{route('blog.details', encrypt($blog->id))}}">
                                                <h4 class="post-title">
                                                    {{ $blog->title }}
                                                </h4>
                                            </a>
                                            <p class="date">
                                                {{ date('d M, Y',strtotime($blogdtls->created_at)) }}
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            @endforeach

                        </ul>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('script')



<script>
    $(document).ready(function () {

        //header for csrf-token is must in laravel
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
        //

        var url = "{{URL::to('/user/blog-comment')}}";
        // console.log(url);

        $("#cmtBtn").click(function(){
            //   alert('btn work');
             var form_data = new FormData();
                  
            form_data.append("bcmntid", $("#bcmntid").val());
            form_data.append("comment", $("#comment").val());
            

            // var bcmntid= $("#bcmntid").val();
            // var comment= $("#comment").val();
            // console.log(bcmntid, comment  );

            $.ajax({
                url:url,
                type: "POST",
                contentType: false,
                processData: false,
                data:form_data,
                success: function(d){
                    console.log(d);
                    if (d.status == 303) {
                        $(".ermsg").html(d.message);
                    }else if(d.status == 300){
                        success("Commented Successfully!!");
                        window.setTimeout(function(){location.reload()},2000)
                    }
                },
                error:function(d){
                    console.log(d);
                    $(".ermsg").html(d.message);
                }
            });
        });

        


        // new reply code start
        $("body").delegate(".replybtn","click",function(event){
		event.preventDefault();
        
            //   alert('reply btn work');

        var repurl = "{{URL::to('/user/blog-reply')}}";
        cmntid = $(this).attr('cmntid');
        // console.log(cmntid);
        var bcmntid= $("#bcmntid").val();
        var reply= $("#reply" + cmntid + "").val();

            // console.log(cmntid,bcmntid,reply);

            $.ajax({
                    url:repurl,
                    method: "POST",
                    data:{
                        cmntid:cmntid,bcmntid:bcmntid,reply:reply,
                    },
                    success: function(d){
                        if (d.status == 303) {
                            $(".repermsg").html(d.message);
                        }else if(d.status == 300){
                             $(".repermsg").html(d.message);
                            window.setTimeout(function(){location.reload()},2000)
                        }
                    },
                    error:function(d){
                        console.log(d);
                    }
                });

            });
        // new reply code end
     

    });
</script>


@endsection

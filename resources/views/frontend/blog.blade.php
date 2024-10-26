@extends('frontend.layouts.index') 
@section('content')



<section class="blog">
    <div class="container">
        <div class="row px-4">

            @foreach ($blogs as $item)
                


            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                <a href="{{route('blog.details', encrypt($item->id))}}">
                    <div class="blog-box">
                        <div class="blog-images">
                            <div class="photo">
                                <img src="{{url('blogimage/'.$item->photo)}}" class="" alt="">
                                {{-- <img src="https://royalscripts.com/product/geniuscart/fashion/assets/images/blogs/15542700464-min.jpg" class="" alt=""> --}}
                            </div>
                            <div class="box-date">
                                <p>{{ date('d', strtotime($item->created_at)) }}</p>
                                <p>{{ date('M', strtotime($item->created_at)) }}</p>
                            </div>
                        </div>
                        <div class="details">
                            <a href="{{route('blog.details', encrypt($item->id))}}">
                                <h4 class="blog-title">
                                    {{ $item->title }}
                                </h4>
                            </a>
                            <p class="blog-text">
                                {{ substr(strip_tags($item->details), 0, 120) }}
                            </p>
                            <a class="btn-theme" href="{{route('blog.details', encrypt($item->id))}}">Read More</a>
                        </div>
                    </div>
                </a>
            </div>

            
            @endforeach


        </div>



        <div class="row ">
            <div class="col-md-12 d-flex justify-content-center align-items-center">
                {{ $blogs->links() }}
            </div>
        </div>

        
    </div>
</section>








@endsection

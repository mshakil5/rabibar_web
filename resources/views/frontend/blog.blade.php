@extends('frontend.layouts.index') 
@section('content')



<section class="blog">
    <div class="container">
        <div class="row px-4">

            @foreach ($blogs as $item)
                


            <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                <a href="{{route('blog.details', encrypt($item->id))}}">
                    <div class="blog-box" style="height: 400px; display: flex; flex-direction: column; justify-content: space-between;">
                        <div class="blog-images" style="min-height: 220px; position: relative;">
                            <div class="photo">
                                @if ($item->photo)
                                    <img src="{{url('blogimage/'.$item->photo)}}" style="max-height: 100%; width: 100%; object-fit: cover;" alt="">
                                @else
                                    <img src="{{url('company/'.\App\Models\CompanyDetail::first()->company_logo)}}" style="max-height: 100%; width: 100%; object-fit: cover;" alt="">
                                @endif
                            </div>
                            <div class="box-date" style="position: absolute; bottom: 10px; right: 10px;">
                                <p>{{ date('d', strtotime($item->created_at)) }}</p>
                                <p>{{ date('M', strtotime($item->created_at)) }}</p>
                            </div>
                        </div>
                        <div class="details" style="max-height: 120px; overflow: hidden; flex-grow: 1;">
                            <a href="{{route('blog.details', encrypt($item->id))}}">
                                <h4 class="blog-title">
                                    {{ $item->title }}
                                </h4>
                            </a>
                            <p class="blog-text">
                                {!! Str::limit($item->details , 80) !!}
                            </p>
                        </div>
                        <div style="margin-top: auto;">
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

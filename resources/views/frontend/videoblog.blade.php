@extends('frontend.layouts.index') 
@section('content')



<section class="video-blog">
    <div class="cover-video">
        <div class="left">
            @foreach (App\Models\VideoBlog::where('position', '=', 'left')->orderBy('created_at', 'desc')->limit(1)->get() as $data)
                <iframe width="100%" height="400px" src="{{ $data->link}}" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>
                {{-- {{ $data->link}} --}}
            @endforeach
        </div>
        <div class="right">
            <div class="top">

                @foreach (App\Models\VideoBlog::where('position', '=', 'top')->orderBy('created_at', 'desc')->limit(2)->get() as $data)
                    <div class="item">
                        <iframe width="100%" height="195px" src="{{ $data->link}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                @endforeach
                {{-- <div class="item">
                    <iframe width="100%" height="195px" src="https://www.youtube.com/embed/uYKDS1yDODY" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div> --}}

            </div>
            <div class="bottom">

                @foreach (App\Models\VideoBlog::where('position', '=', 'bottom')->orderBy('created_at', 'desc')->limit(2)->get() as $data)
                    <div class="item">
                        <iframe width="100%" height="195px" src="{{ $data->link}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                @endforeach



                {{-- <div class="item">
                    <iframe width="100%" height="195px" src="https://www.youtube.com/embed/uYKDS1yDODY" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div> --}}
            </div>
        </div>
    </div>
</section>

<section class="trending">
    <h4 class='title-trend'> <span class="iconify" data-icon="emojione:video-camera" data-inline="false"></span>
        Trending Videos </h4>

    <div class="control">
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
    <div class="swiper-container">
        <div class="swiper-wrapper">
            @foreach ($animels as $item)

                <div class="swiper-slide">
                    <iframe width="100%" height="195px" src="{{ $item->link}}" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                
            @endforeach
        </div>
    </div>
</section>


@foreach ($cats as $data)
    <section class="trending pt-0">
        <h4 class='title-trend'> <span class="iconify" data-icon="dashicons:video-alt3" data-inline="false"></span>
            {{ $data->name}} </h4>
        <div class="row">
            @foreach (App\Models\VideoBlog::where('category_id', '=', $data->id)->orderBy('created_at', 'desc')->limit(8)->get() as $video)
                <div class="col-lg-3 mb-2">
                    <iframe width="100%" height="195px" src="{{$video->link}}"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
                </div>
            @endforeach

        </div>
    </section> 
@endforeach





@endsection


@section('script')




<script>
    var swiper = new Swiper('.swiper-container', {
        slidesPerView: 4,
        loopedSlides: 4,
        centeredSlides: false,
        spaceBetween: 10,
        grabCursor: true,
        loop: true,
        pagination: '.swiper-pagination',
        paginationClickable: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        //   pagination: {
        //         el: '.swiper-pagination',
        //         clickable: true,
        //       },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },

        breakpoints: {
            1400: {
                slidesPerView: 4,
                loopedSlides: 5,
                spaceBetween: 30
            },
            1200: {
                slidesPerView: 4,
                loopedSlides: 4,
                spaceBetween: 10
            },

            1024: {
                slidesPerView: 3,
                loopedSlides: 3,
                spaceBetween: 10
            },

            768: {
                slidesPerView: 2,
                loopedSlides: 2,
                spaceBetween: 10
            },

            675: {
                slidesPerView: 1,
                loopedSlides: 1,
                spaceBetween: 20
            },
            425: {
                slidesPerView: 1,
                loopedSlides: 1,
                spaceBetween: 20
            },

            375: {
                slidesPerView: 1,
                loopedSlides: 1,
                spaceBetween: 20
            },

            320: {
                slidesPerView: 1,
                loopedSlides: 1,
                spaceBetween: 10
            },

        }
    }

    );

</script>
@endsection

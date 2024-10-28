@extends('frontend.layouts.index') 
@section('content')

<section class="video-blog">
    <div class="cover-video">
        <div class="left">
            @foreach (App\Models\VideoBlog::where('position', '=', 'left')->orderBy('created_at', 'desc')->limit(1)->get() as $data)
                <div class="item">
                    <iframe width="100%" height="400px" data-src="{{ $data->link }}" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen data-toggle="modal" data-target="#videoModal" data-video="{{ $data->link }}" class="video-link lazyload-iframe"></iframe>
                    <h4 class="blog-title" style="cursor: pointer;">{{ $data->title }}</h4>
                </div>
            @endforeach
        </div>
        <div class="right">
            <div class="top">
                @foreach (App\Models\VideoBlog::where('position', '=', 'top')->orderBy('created_at', 'desc')->limit(2)->get() as $data)
                    <div class="item">
                        <iframe width="100%" height="195px" data-src="{{ $data->link }}" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen data-toggle="modal" data-target="#videoModal" data-video="{{ $data->link }}" class="video-link lazyload-iframe"></iframe>
                        <h4 class="blog-title">{{ $data->title }}</h4>
                    </div>
                @endforeach
            </div>

            <div class="bottom">
                @foreach (App\Models\VideoBlog::where('position', '=', 'bottom')->orderBy('created_at', 'desc')->limit(2)->get() as $data)
                    <div class="item">
                        <iframe width="100%" height="195px" data-src="{{ $data->link }}" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen data-toggle="modal" data-target="#videoModal" data-video="{{ $data->link }}" class="video-link lazyload-iframe"></iframe>
                        <h4 class="blog-title" style="cursor: pointer;">{{ $data->title }}</h4>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- 
<section class="blog">
    <h4 class='title-trend'> 
        <span class="iconify" data-icon="emojione:video-camera" data-inline="false"></span> 
        Trending Videos 
    </h4>

    <div class="control">
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
    <div class="swiper-container">
        <div class="swiper-wrapper">
            @foreach ($animels as $item)
                <div class="swiper-slide">
                    <div class="blog-box">
                        <div class="blog-images">
                            <div class="photo">
                                <iframe width="100%" height="195px" data-src="{{ $item->link }}" frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen data-toggle="modal" data-target="#videoModal" 
                                        data-video="{{ $item->link }}" class="video-link lazyload-iframe"></iframe>
                            </div>
                        </div>
                        <div class="details">
                            <a href="#" class="open-video-modal" data-video="{{ $item->link }}">
                                <h4 class="blog-title">{{ $item->title }}</h4>
                            </a>
                            <p class="blog-text">{{ substr(strip_tags($item->short_description), 0, 120) }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

--}}

<section class="blog">
    @foreach ($cats as $data)
        <section class="trending pt-0">
            <h4 class="title-trend">
                <span class="iconify" data-icon="dashicons:video-alt3" data-inline="false"></span>
                {{ $data->name }}
            </h4>

            <div class="swiper-container">
                <div class="swiper-wrapper">
                    @foreach (App\Models\VideoBlog::where('category_id', '=', $data->id)->orderBy('created_at', 'desc')->limit(8)->get() as $video)
                        <div class="swiper-slide">
                            <div class="blog-box">
                                <div class="blog-images">
                                    <div class="photo">
                                        <iframe width="100%" height="195px" data-src="{{ $video->link }}" frameborder="0" 
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                                allowfullscreen class="video-link lazyload-iframe" data-toggle="modal" data-target="#videoModal" 
                                                data-video="{{ $video->link }}"></iframe>
                                    </div>
                                </div>
                                <div class="details">
                                    <a href="#" class="open-video-modal" data-video="{{ $video->link }}">
                                        <h4 class="blog-title">{{ $video->title }}</h4>
                                    </a>
                                    <p class="blog-text">{{ substr(strip_tags($video->short_description), 0, 120) }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </section>
    @endforeach
</section>


<!-- Video Modal -->
<div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="videoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
                
            <div class="modal-body p-2 pb-0">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-2" style="background-color: #fff; border-radius: 50%; padding: 0.5rem;" aria-label="Close" data-bs-dismiss="modal"></button>
                <iframe id="modalVideo" width="100%" height="400px" data-src="" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>


@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('.open-video-modal').click(function(e) {
            e.preventDefault();
            var videoLink = $(this).data('video');
            $('#modalVideo').attr('src', videoLink);
            $('#videoModal').modal('show');
        });

        $('#videoModal').on('hidden.bs.modal', function() {
            $('#modalVideo').attr('src', '');
        });

        var lazyloadIframes = document.querySelectorAll('iframe.lazyload-iframe');
        
        if ("IntersectionObserver" in window) {
            var iframeObserver = new IntersectionObserver(function (entries, observer) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        var iframe = entry.target;
                        iframe.src = iframe.getAttribute('data-src');
                        iframeObserver.unobserve(iframe);
                    }
                });
            });

            lazyloadIframes.forEach(function (iframe) {
                iframeObserver.observe(iframe);
            });
        } else {
            lazyloadIframes.forEach(function (iframe) {
                iframe.src = iframe.getAttribute('data-src');
            });
        }
    });

    var swiper = new Swiper('.swiper-container', {
        slidesPerView: 4,
        loopedSlides: 4,
        centeredSlides: false,
        spaceBetween: 10,
        grabCursor: true,
        loop: false,
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

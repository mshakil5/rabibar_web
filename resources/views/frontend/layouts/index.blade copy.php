<html lang="en">

<head>
    <meta charset="UTF-8">
    @yield('title-meta')
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link name="favicon" type="image/x-icon" href="{{ asset(\App\Models\CompanyDetail::first()->fav_icon) }}" rel="shortcut icon" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link href="{{ asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css')}}">
    <link href="https://unpkg.com/swiper/swiper-bundle.min.css" rel="stylesheet" />
    @yield('css')
    {{-- new css --}}
    <link rel="stylesheet" href="{{asset('css/smoothproducts.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
        integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.1/jquery.mobile-1.2.1.min.css" />
</head>

<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light shadow-sm">
        <div class="container ">
          <a class="navbar-brand" href="{{url('/')}}">
              <img src="{{url('company/'.\App\Models\CompanyDetail::first()->company_logo)}}" alt="" class="brand">
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{url('/')}}">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('frontend.about')}}">About Us</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{url('/contact')}}">Contact Us</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('blog')}}">Blog</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('frontend.videoblog')}}">Video Blog</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('frontend.spinner')}}">Spinner</a>
              </li>
              <!-- <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Dropdown
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>

                </ul>
              </li> -->

            </ul>
            <ul class="navbar-nav ml-auto mb-2 mb-lg-0 desktop">
                @guest
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}"><span class="iconify" data-icon="ci:user" data-inline="false"></span> Sign Up</a>
                        </li>
                    @endif
                    @if (Route::has('login'))
                        <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="iconify" data-icon="bx:bx-key" data-inline="false"></span> Login
                                </a>
                                <ul class="dropdown-menu border-0 shadow-lg" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="{{ route('login') }}"> Login</a></li>
                                    <li><a class="dropdown-item" href="#"> Login with facebook</a></li>
                                </ul>
                        </li>
                    @endif
                @else

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu border-0 shadow-lg" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('user.profile') }}">
                                 {{ __('Profile') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();">
                                 {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>

                    @endguest

              </ul>

          </div>
        </div>
      </nav>

      <div class="authentication">
        <a href="register.html">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--bx" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24" data-icon="bx:bxs-user-rectangle" data-inline="false"><path d="M6 22h13a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h1zm6-17.001c1.647 0 3 1.351 3 3C15 9.647 13.647 11 12 11S9 9.647 9 7.999c0-1.649 1.353-3 3-3zM6 17.25c0-2.219 2.705-4.5 6-4.5s6 2.281 6 4.5V18H6v-.75z" fill="currentColor"></path></svg>
            Sign Up</a>
        <a href="login.html"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--bx" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24" data-icon="bx:bxs-lock" data-inline="false"><path d="M12 2C9.243 2 7 4.243 7 7v3H6a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8a2 2 0 0 0-2-2h-1V7c0-2.757-2.243-5-5-5zM9 7c0-1.654 1.346-3 3-3s3 1.346 3 3v3H9V7zm4 10.723V20h-2v-2.277a1.993 1.993 0 0 1 .567-3.677A2.001 2.001 0 0 1 14 16a1.99 1.99 0 0 1-1 1.723z" fill="currentColor"></path></svg> Login</a>
        <a href="#"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--entypo-social" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 20 20" data-icon="entypo-social:facebook" data-inline="false"><path d="M17 1H3c-1.1 0-2 .9-2 2v14c0 1.101.9 2 2 2h7v-7H8V9.525h2v-2.05c0-2.164 1.212-3.684 3.766-3.684l1.803.002v2.605h-1.197c-.994 0-1.372.746-1.372 1.438v1.69h2.568L15 12h-2v7h4c1.1 0 2-.899 2-2V3c0-1.1-.9-2-2-2z" fill="currentColor"></path></svg> Facebook Login</a>
    </div>
    </header>

      @yield('content')


{{-- footer part start --}}
<footer class="footer-section mt-3">
    <div class="container">
        <div class="footer-cta pt-5 pb-5">
            <div class="row">
                <div class="col-xl-3 col-md-3 mb-30">
                    <div class="single-cta">
                        <i class="fas fa-map-marker-alt"></i>
                        <div class="cta-text">
                            <h4 style="margin-top: 8px;">Find us</h4>
                        </div>
                        <div class="cta-text" style="margin-left: 18px;">
                            <span>{{\App\Models\CompanyDetail::first()->address}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-3 mb-30">
                    <div class="single-cta">
                        <i class="fas fa-phone"></i>
                        <div class="cta-text">
                            <h4>Call us</h4>
                            <span>{{\App\Models\CompanyDetail::first()->phone1}}</span><br>
                            <span>{{\App\Models\CompanyDetail::first()->phone2}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-3 mb-30">
                    <div class="single-cta">
                        <i class="far fa-eye"></i>
                        <div class="cta-text">
                            <h4>Follow Us</h4>
                            <div class="footer-social-icon">
                                <a href="{{\App\Models\CompanyDetail::first()->facebook}}" target="_blank" title='Facebook'><i class="text-white fab fa-facebook-f facebook-bg" style="margin-right: 15px"></i></a> <a href="{{\App\Models\CompanyDetail::first()->instagram}}"title='Youtube'><i class="text-white fab fa-youtube google-bg" style="margin-right: 15px"></i></a> <a href="{{\App\Models\CompanyDetail::first()->facebook}}"title='Twitter'><i class="text-white fab fa-twitter twitter-bg"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-3 mb-30">
                    <div class="single-cta">
                        <i class="far fa-envelope-open"></i>
                        <div class="cta-text">
                            <h4 style="margin-top: 8px;">Mail us</h4>
                        </div>
                        <div class="cta-text" style="margin-left: 30px;">
                            <span>{{\App\Models\CompanyDetail::first()->email1}}</span>
                            <span>{{\App\Models\CompanyDetail::first()->email2}}</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="footer-content pt-5 pb-5">
            <div class="row">
                <div class="col-xl-4 col-lg-4 mb-50">
                    <div class="footer-widget">
                        <div class="footer-logo">
                            <a href="{{url('/')}}"><img src="{{url('company/'.\App\Models\CompanyDetail::first()->company_logo)}}" class="img-fluid" alt="logo"></a>
                        </div>
                        <div class="footer-text">
                            <p>Choose a category in which to play the  Quiz from General Knowledge, Dictionary, Entertainment, History, Food + Drink, Geography and Science + Nature. Answer  multiple-choice quiz questions. System will pick the winners from those that answered correctly..</p>
                        </div>

                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6">
                    <div class="footer-widget">
                        <div class="footer-widget-heading">
                            <h3>Useful Links</h3>
                        </div>
                        <ul>
                            <li><a href="{{route('frontend.about')}}">About</a></li>
                            <li><a href="{{route('frontend.terms')}}">Terms & conditions</a></li>
                            <li><a href="{{route('frontend.privacy')}}">Privacy policy</a></li>
                            <li><a href="{{route('frontend.contact')}}">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-5 col-md-6 mb-50">
                    <div class="footer-widget">
                        <div class="footer-widget-heading">
                            <h3>How to do </h3>
                        </div>
                        <div class="footer-text mb-25">
                            @foreach (App\Models\VideoBlog::where('position', '=', 'footer')->orderBy('created_at', 'DESC')->limit(1)->get() as $footer)
                                <iframe width="100%" height="200px" src="{{ $footer->link }}" title="YouTube video player" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-area py-2">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 text-center text-lg-left">
                    <div class="copyright-text text-center">
                        <p>Copyright &copy; 2021, All Right Reserved </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</footer>
{{-- footer part end --}}


    <script src="https://d3js.org/d3.v3.min.js" charset="utf-8"></script>
    <script src="{{ asset('assets/js/jquery-3.5.1.min.js')}}"></script>
    <script src="{{ asset('assets/js/popper.min.js')}}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="https://code.iconify.design/2/2.0.1/iconify.min.js"></script>
    <script src="https://rawgit.com/guillaumepotier/Parsley.js/2.3.7/dist/parsley.js"></script>
    <script src='{{ asset('assets/js/app.js')}}'> </script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    @yield('script')

    {{-- new script --}}
    <script src="{{asset('js/smoothproducts.min.js')}}"></script>
    <script src="{{asset('js/zoom-image.js')}}"></script>
    {{-- <script src="{{asset('js/main.js')}}"></script> --}}
    <script src="{{asset('js/wow.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/custom.js')}}"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"
        integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous">
    </script>
    {{-- new script end --}}



    <script>
        $(function () {
  var $sections = $('.form-section');

  function navigateTo(index) {
    // Mark the current section with the class 'current'
    $sections
      .removeClass('current')
      .eq(index)
        .addClass('current');
    // Show only the navigation buttons that make sense for the current section:
    $('.form-navigation .previous').toggle(index > 0);
    var atTheEnd = index >= $sections.length - 1;
    $('.form-navigation .next').toggle(!atTheEnd);
    $('.form-navigation [type=submit]').toggle(atTheEnd);
  }

  function curIndex() {
    // Return the current index by looking at which section has the class 'current'
    return $sections.index($sections.filter('.current'));
  }

  // Previous button is easy, just go back
  $('.form-navigation .previous').click(function() {
    navigateTo(curIndex() - 1);
  });

  // Next button goes forward iff current block validates
  $('.form-navigation .next').click(function() {
    if ($('.step-form').parsley().validate({group: 'block-' + curIndex()}))
      navigateTo(curIndex() + 1);
  });

  // Prepare sections by setting the `data-parsley-group` attribute to 'block-0', 'block-1', etc.
  $sections.each(function(index, section) {
    $(section).find(':input').attr('data-parsley-group', 'block-' + index);
  });
  navigateTo(0); // Start at the beginning
});
</script>
<script>
    // page schroll top
    function pagetop() {
        window.scrollTo({
            top: 130,
            behavior: 'smooth',
        });
    }

    function success(msg){
            $.notify({
                    // title: "Update Complete : ",
                    message: msg,
                    // icon: 'fa fa-check'
                },{
                    type: "info"
                });
         }
</script>

<script type="text/javascript" src="{{ asset('assets/js/bootstrap-notify.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/bootstrap-notify.min.js') }}"></script>
</body>

</html>

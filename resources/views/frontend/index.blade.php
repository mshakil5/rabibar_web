@extends('frontend.layouts.index')

@section('content')

<section>
    <div class="w-100 text-center">
        @foreach (App\Models\Advertisement::where('position', '=', 'Banner')->orderBy('created_at', 'DESC')->limit(1)->get() as $banner)
            <img class='img-fluid' src="{{asset('advimage/'.$banner->image)}}" alt="">
        @endforeach
    </div>
</section>

<section class="container-fluid order-control">
    <div class="row bg-white firstRow">
        <div class="col-md-6 pt-3">
            @php
                $video =App\Models\Video::where('position', '=', 'top')->where('status', '=', 1)->first()->name;
            @endphp
            <iframe width="100%" height="310" src="{{ asset('videos/'.$video) }}"
            title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
            </iframe>
        </div>


        <div class="col-md-4">
            <h4 class="mb-0 text-grad">Our winners</h4>
            <hr>
            <ul class="list-group">

                <marquee direction="up" height="250px" width="100%" scrollamount="2">
                    @foreach ($winners as $winner)
                    <li class="list-group-item" >{{ $winner->name}}</li>
                    @endforeach
                </marquee>


            </ul>
        </div>
        <div class="col-md-2 px-3 text-center">

            @foreach (App\Models\Advertisement::where('position', '=', 'Left-top')->orderBy('serial', 'DESC')->limit(2)->get() as $advr)
            <a href="{{$advr->link}}" target="_blank">
            <img class="img-fluid mb-2 img-thumbnail" src="{{asset('advimage/'.$advr->image)}}" alt="">
            </a>
            @endforeach


        </div>
    </div>
    <div class="row bg-white customControl">
        <div class="col-md-2 px-3 text-center mt-3">

            @foreach (App\Models\Advertisement::where('position', '=', 'Left')->orderBy('serial', 'DESC')->limit(4)->get() as $advr)
            <a href="{{$advr->link}}" target="_blank">
                <img class="img-fluid mb-2 img-thumbnail" src="{{asset('advimage/'.$advr->image)}}" alt="">
            </a>
            @endforeach



        </div>
        <div class="col-md-8 p-0 border-left border-right  ">

            <div class="row px-3">
                <div class="  shadow-sm p-4 col-md-3 d-flex justify-content-center align-items-center">
                    <div>
                        Quiz Name &amp; End Time <br>
                        <span class="badge badge-warning sectionBar">@if(isset($quiz )){{$quiz->quiz}}</span> - <span class="badge badge-warning sectionBar">{{date('d-M-Y',strtotime($quiz->expiry_date))}}
                            @endif</span>
                    </div>
                </div>
                <div class="  shadow-sm p-4 col-md-6 d-flex  text-center border-left border-right text-capitalize align-items-center justify-content-center">
                    @if(isset($quiz ))
                        @if(count($sponsor)>0)
                            <h6> quiz sponsored by : {{$sponsor[0]->name}} <br>
                                {!! $sponsor[0]->description !!}</h6>
                                @else
                                <h6> quiz sponsored by :
                                <br>
                            </h6>
                        @endif
                    @endif
                </div>
                <div class="  shadow-sm p-4 col-md-3 d-flex align-items-center justify-content-center">
                    <div>
                        No of Participant : <span class="badge badge-success sectionBar">@if(isset($quiz )){{$countAttend}}@endif</span>
                    </div>
                </div>
            </div>

            @if($errors->any())
                <div  class="related-quiz"><strong>Notice!</strong><h4 style="color:white;font-family: Aparajita">{{$errors->first()}}</h4></div>
            @endif
            <div class="row py-3 bg-white mt-1 mx-auto">




                {{-- question and option part --}}
            @if(isset($quiz ))   <?php $i=1;$k=1; ?>
            <form action="{{url('/quiz-answer')}}" method="post" >
                @csrf
                <input type="hidden" id="qid" name="quiz" value="{{ $quiz->id }}">
                <div class="row p-2 nasa-mutation">
                @foreach($question as $quest)
                <div class="col-sm-12 col-md-6 col-lg-3 px-1">
                    <div class="card custom-card pb-3">
                        <small class="text-center mb-2">Question-{{$k}}</small>
                        <h5 class='text-center text-capitalize qs-title'>{{$quest->question}}</h5>
                        <div class="card-body p-0  mt-4">
                            <div class='qsoptions'>

                                <input type="hidden" id="hid" name="questions[{{ $k }}]" value="{{ $quest->id }} ">

                                <input  class="form-check-input" type="radio" name="option{{ $quest->id }}" id="{{$i+1}}" value="{{$quest->option1}}" required>
                                <label for='{{$i+1}}' class="form-check-label lgn"> {{$quest->option1}}</label>
                            </div>

                            <div class='qsoptions'>
                                <input class="form-check-input" type="radio" id="{{$i+2}}" name="option{{ $quest->id }}" value="{{$quest->option2}}" required>
                                <label for='{{$i+2}}' class="form-check-label lgn"> {{$quest->option2}} </label>
                            </div>
                            @if($quest->option3 != null)
                            <div class='qsoptions'>
                                <input  class="form-check-input" type="radio" id="{{$i+3}}" name="option{{ $quest->id }}" value="{{$quest->option3}}" required>
                                <label for='{{$i+3}}' class="form-check-label lgn"> {{$quest->option3}} </label>
                            </div>
                            @endif

                            @if($quest->option4 != null)
                            <div class='qsoptions'>
                                <input  class="form-check-input" type="radio"id="{{$i+4}}"name="option{{ $quest->id }}" value="{{$quest->option4}}" required>
                                <label for='{{$i+4}}' class="form-check-label lgn"> {{$quest->option4}}</label>
                            </div>
                            @endif
                        </div>
                    </div>

                </div>
                <?php $i=$i+10;$k++;?>
                    @endforeach
                </div>
                    <button  class="related-quiz">Submit</button>
            </form>
            @else <br><div class="related-quiz">No Quiz Available </div>@endif
            {{-- question and option part --}}


            </div>
<div><p>A knowledge based branding platform, where business - media - and user&#39;s are helping each others<br />
Choose a category in which to play the Quiz from General Knowledge, Dictionary, Entertainment, History, Food + Drink, Geography and Science + Nature. Answer multiple-choice quiz questions. System will pick the winners from those that answered correctly.</p>

<p><strong>কিভাবে অংশ নিবেন?</strong></p>

<p>খুবই সহজ, সব কয়টি প্রশ্নের সঠিক উত্তর দিয়ে সাবমিট বাটনে ক্লিক করুন। আপনার নাম স্পিন wheel এ দেখতে পাবেন।&nbsp;<br />
রেজিস্টার করার জন্য কোনো টাকা পে করতে হবে না. এই কুইজ সবার জন্য উম্মুক্ত, যে কেউ অংশ নিতে পারবেন।&nbsp;</p>

<p>কুইজ সাবমিট করার পর কোনো উত্তর কারেক্ট করতে চাইলে, আপনি আপনার একাউন্টে গিয়ে ৩ বার এডিট করতে পারবেন।&nbsp;</p>

<p>বিস্তারিত youtube ভিডিও দেখতে পারেন</p>

<p><a href="https://www.youtube.com/watch?v=NMzJScUP5uo&amp;t=659s">https://www.youtube.com/watch?v=NMzJScUP5uo&amp;t=659s</a></p>
</div>

            {{-- <h5 class="mt-3 alert sectionBar">More sponsored quiz? </h5>
            <div class="row bg-white border-bottom d-flex flex-wrap p-3 text-center ">
                <div class="col-sm-12 col-md-6 col-lg-3 px-1">
                    <div class="card custom-card pb-3">
                        <small class="text-center mb-2">Question-1</small>
                        <h5 class="text-center text-capitalize qs-title">how many people in bangladesh?</h5>
                        <div class="card-body p-0  mt-4">
                            <div class="qsoptions">
                                <input id="opt1" class="form-check-input" type="radio" name="exampleRadios"
                                    value="option1">
                                <label for="opt1" class="form-check-label"> option one </label>
                            </div>

                            <div class="qsoptions">
                                <input id="opt2" class="form-check-input" type="radio" name="exampleRadios"
                                    value="option2">
                                <label for="opt2" class="form-check-label"> option one </label>
                            </div>

                            <div class="qsoptions">
                                <input id="opt3" class="form-check-input" type="radio" name="exampleRadios"
                                    value="option3">
                                <label for="opt3" class="form-check-label"> option one </label>
                            </div>

                            <div class="qsoptions">
                                <input id="opt4" class="form-check-input" type="radio" name="exampleRadios"
                                    value="option4">
                                <label for="opt4" class="form-check-label"> option one </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

            {{-- <h5 class="mt-3 alert sectionBar">More Free quiz? </h5>
            <div class="row bg-white  d-flex flex-wrap p-3 text-center ">
                <div class="col-sm-12 col-md-6 col-lg-3 px-1">
                    <div class="card custom-card pb-3">
                        <small class="text-center mb-2">Question-1</small>
                        <h5 class="text-center text-capitalize qs-title">how many people in bangladesh?</h5>
                        <div class="card-body p-0  mt-4">
                            <div class="qsoptions">
                                <input id="opt1" class="form-check-input" type="radio" name="exampleRadios"
                                    value="option1">
                                <label for="opt1" class="form-check-label"> option one </label>
                            </div>

                            <div class="qsoptions">
                                <input id="opt2" class="form-check-input" type="radio" name="exampleRadios"
                                    value="option2">
                                <label for="opt2" class="form-check-label"> option one </label>
                            </div>

                            <div class="qsoptions">
                                <input id="opt3" class="form-check-input" type="radio" name="exampleRadios"
                                    value="option3">
                                <label for="opt3" class="form-check-label"> option one </label>
                            </div>

                            <div class="qsoptions">
                                <input id="opt4" class="form-check-input" type="radio" name="exampleRadios"
                                    value="option4">
                                <label for="opt4" class="form-check-label"> option one </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

            {{-- <div class="step p-4 shadow-lg rounded mb-5">
                <h3>Step form </h3>
                <form class="step-form">
                    <div class="form-section">
                        <label for="firstname">First Name:</label>
                        <input type="text" class="form-control" name="firstname" required="">

                        <label for="lastname">Last Name:</label>
                        <input type="text" class="form-control" name="lastname" required="">
                    </div>

                    <div class="form-section">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" name="email" required="">
                    </div>

                    <div class="form-section">
                        <label for="color">Favorite color:</label>
                        <input type="text" class="form-control" name="color" required="">
                    </div>

                    <div class="form-section">
                        <label for="color">Gender:</label>
                        Male <input type="radio" class="" name="gender">
                        female <input type="radio" class="" name="gender">
                    </div>

                    <div class="form-navigation">
                        <button type="button" class="previous btn btn-info pull-left"> Previous</button>
                        <button type="button" class="next btn btn-info pull-right">Next</button>
                        <input type="submit" class="btn btn-default pull-right">
                        <span class="clearfix"></span>
                    </div>

                </form>
            </div> --}}
        </div>

        <div class="col-md-2 px-3 text-center">
            @foreach (App\Models\Advertisement::where('position', '=', 'Right')->orderBy('serial', 'DESC')->limit(4)->get() as $advr)
            <a href="{{$advr->link}}" target="_blank">
            <img class="img-fluid mb-2 img-thumbnail" src="{{asset('advimage/'.$advr->image)}}" alt="">
</a>
            @endforeach

            {{-- <img class="img-fluid mb-2 img-thumbnail"
                src="https://static.vecteezy.com/system/resources/previews/000/580/906/non_2x/vector-creative-advertisement-banner-design.jpg"
                alt="">
            <img class="img-fluid mb-2 img-thumbnail"
                src="https://socialreport.zendesk.com/hc/article_attachments/115017509006/tumblr_mucr5ouPLQ1s8jl6ro1_400.gif"
                alt="">
            <img class="img-fluid mb-2 img-thumbnail"
                src="https://static.vecteezy.com/system/resources/previews/000/580/906/non_2x/vector-creative-advertisement-banner-design.jpg"
                alt="">
            <img class="img-fluid mb-2 img-thumbnail"
                src="https://static.vecteezy.com/system/resources/previews/000/580/906/non_2x/vector-creative-advertisement-banner-design.jpg"
                alt=""> --}}
        </div>
    </div>
</section>












@endsection

@section('script')
<script>
    $(document).ready(function(){
        var loggedIn={!! json_encode(Auth::check()) !!};
     $(".qsoptions").on('click','label.lgn',function(){
        if (loggedIn) {

        } else {
            alert("Please Log-in first.");
            window.location.href = "{{ route('loginredirect')}}";
        }
    });

    })
</script>

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
        $('.form-navigation .previous').click(function () {
            navigateTo(curIndex() - 1);
        });

        // Next button goes forward iff current block validates
        $('.form-navigation .next').click(function () {
            if ($('.step-form').parsley().validate({ group: 'block-' + curIndex() }))
                navigateTo(curIndex() + 1);
        });

        // Prepare sections by setting the `data-parsley-group` attribute to 'block-0', 'block-1', etc.
        $sections.each(function (index, section) {
            $(section).find(':input').attr('data-parsley-group', 'block-' + index);
        });
        navigateTo(0); // Start at the beginning
    });
</script>
@endsection

@extends('frontend.layouts.index') 
@section('css')
    <style>
        .my-custom-scrollbar {
            position: relative;
            height: 200px;
            overflow: auto;
        }
        .table-wrapper-scroll-y {
            display: block;
        }
    </style>
@endsection
@section('content')


<div class="container-fluid"> 
    <div class="row bg-white customControl">
        <div class="col-md-2 px-3 text-center">
            @foreach (App\Models\Advertisement::where('position', '=', 'Left')->orderBy('serial', 'ASC')->get() as $advr)

                <img class="img-fluid mb-2 img-thumbnail" src="{{asset('advimage/'.$advr->image)}}" alt=""> 
            
            @endforeach
            {{-- <img class="img-fluid mb-2 img-thumbnail" src="https://i.pinimg.com/564x/f6/34/08/f63408dc5bb6ea1eb67832738923856d.jpg" alt="">             
                <img class="img-fluid mb-2 img-thumbnail" src="https://i.pinimg.com/originals/96/e8/de/96e8de8efdeb9f8567c99a7d9803a2f5.gif" alt=""> 
                <img class="img-fluid mb-2 img-thumbnail" src="https://i.pinimg.com/564x/f1/e0/d7/f1e0d70c62bce11ccc8a8404fd13a085.jpg" alt=""> --}}
        </div>
        <div class="col-md-8 p-0 border-left border-right  ">  
               <div class="w-100 text-center">
                @foreach (App\Models\Advertisement::where('position', '=', 'Banner')->orderBy('created_at', 'DESC')->limit(1)->get() as $banner)
                    <img class='img-fluid' src="{{asset('advimage/'.$banner->image)}}" alt="">
                @endforeach
               </div> 
           <div class="row my-2"> 
                <div class="col-lg-6">
                    @foreach (App\Models\VideoBlog::where('position', '=', 'home')->orderBy('created_at', 'desc')->limit(1)->get() as $data)
                        <iframe width="100%" height="310" src="{{ $data->link }}" 
                        title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                        </iframe>
                    @endforeach
                </div>
                <div class="col-lg-6">
                    <h4 class="mb-0 text-grad">Our winners</h4> <hr>

                    <ul class="list-group">
                        <marquee direction="up" height="250px" width="100%" bgcolor="#d63384" scrollamount="2">
                            @foreach ($winners as $winner)
                            <li class="list-group-item" style="background-color: #d63384; color:white">{{ $winner->name}}</li>
                            @endforeach
                        </marquee>
                    </ul>



                </div> 
           </div>
            <div class="row px-3">
                <div class="  shadow-sm p-4 col-md-3 d-flex justify-content-center align-items-center">
                    <div>
                        Start &amp; End Time <br>
                        <span class="badge badge-warning sectionBar">12:01 am </span> - <span class="badge badge-warning sectionBar">12:06
                            am</span>
                    </div>
                </div>
                <div class="  shadow-sm p-4 col-md-6 d-flex  text-center border-left border-right text-capitalize align-items-center justify-content-center">
                    <h6> quiz sponsored by : billboard.com.bd <br>
                        more info text goes here for next ...</h6>
                </div>
                <div class="  shadow-sm p-4 col-md-3 d-flex align-items-center justify-content-center">
                    <div>
                        No of Participant : <span class="badge badge-success sectionBar">25</span>
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
           
            {{-- <h5 class="mt-3 alert sectionBar">More sponsored quiz? </h5>
            <div class="row bg-white border-bottom d-flex flex-wrap p-3 text-center ">
                <div class="col-sm-12 col-md-6 col-lg-3 px-1">
                    <div class="card custom-card pb-3">
                        <small class="text-center mb-2">Question-1</small>
                        <h5 class="text-center text-capitalize qs-title">how many people in bangladesh?</h5>
                        <div class="card-body p-0  mt-4">
                            <div class="qsoptions">
                                <input id="opt1" class="form-check-input" type="radio" name="exampleRadios" value="option1">
                                <label for="opt1" class="form-check-label"> option one </label>
                            </div>

                            <div class="qsoptions">
                                <input id="opt2" class="form-check-input" type="radio" name="exampleRadios" value="option2">
                                <label for="opt2" class="form-check-label"> option one </label>
                            </div>

                            <div class="qsoptions">
                                <input id="opt3" class="form-check-input" type="radio" name="exampleRadios" value="option3">
                                <label for="opt3" class="form-check-label"> option one </label>
                            </div>

                            <div class="qsoptions">
                                <input id="opt4" class="form-check-input" type="radio" name="exampleRadios" value="option4">
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
                                <input id="opt1" class="form-check-input" type="radio" name="exampleRadios" value="option1">
                                <label for="opt1" class="form-check-label"> option one </label>
                            </div>

                            <div class="qsoptions">
                                <input id="opt2" class="form-check-input" type="radio" name="exampleRadios" value="option2">
                                <label for="opt2" class="form-check-label"> option one </label>
                            </div>

                            <div class="qsoptions">
                                <input id="opt3" class="form-check-input" type="radio" name="exampleRadios" value="option3">
                                <label for="opt3" class="form-check-label"> option one </label>
                            </div>

                            <div class="qsoptions">
                                <input id="opt4" class="form-check-input" type="radio" name="exampleRadios" value="option4">
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
                      Male <input type="radio" class="" name="gender" >
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

            @foreach (App\Models\Advertisement::where('position', '=', 'Right')->orderBy('serial', 'ASC')->get() as $advr)

            <img class="img-fluid mb-2 img-thumbnail" src="{{asset('advimage/'.$advr->image)}}" alt=""> 

            @endforeach
                       
            {{-- <img class="img-fluid mb-2 img-thumbnail" src="https://static.vecteezy.com/system/resources/previews/000/580/906/non_2x/vector-creative-advertisement-banner-design.jpg" alt=""> 
            <img class="img-fluid mb-2 img-thumbnail" src="https://socialreport.zendesk.com/hc/article_attachments/115017509006/tumblr_mucr5ouPLQ1s8jl6ro1_400.gif" alt="">             
                <img class="img-fluid mb-2 img-thumbnail" src="https://static.vecteezy.com/system/resources/previews/000/580/906/non_2x/vector-creative-advertisement-banner-design.jpg" alt=""> 
                <img class="img-fluid mb-2 img-thumbnail" src="https://static.vecteezy.com/system/resources/previews/000/580/906/non_2x/vector-creative-advertisement-banner-design.jpg" alt=""> --}}
        </div>
</div>
</div>

@endsection

@extends('frontend.layouts.index') 
@section('title-meta')
    <title>Welcome to Rabibar - Quiz </title>
@endsection

@section('content')

@component('frontend.inc.quizbtn') @endcomponent
    <section class="myFirebidder">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Quiz Edit</h2>
                    <hr>
                </div>
                <div class="col-lg-3">
                    @component('frontend.inc.leftbar') @endcomponent
                </div>
                <div class="col-lg-9 p-0">

                  {{-- show quiz --}}
                  

                  
                @if(!empty($msg))

                <div class="related-quiz "><h4>{{$msg}}</h4></div>
            @else

            @if($errors->any())
                <div  class="related-quiz"><h4 style="color:white;font-family: Aparajita">{{$errors->first()}}</h4></div>
            @endif
             
                
                <div class="userDetailsArea">
                    <h4 class="related-quiz text-center" >Edit Quiz  &nbsp; &nbsp;{{$quiz[0]->quiz}}</h4>    
               
                 <?php $i=1;$ch="checked"; $k=1; ?>
                 <form action="{{url('/user/quiz-update/'.$quiz[0]->id)}}" method="post" enctype="multipart/form-data">
                @csrf
             
                <div class="row p-3">
                @foreach($question as $quest)
                <div class="col-sm-12 col-md-6 col-lg-3 px-1">
                    <div class="card custom-card pb-3">
                        <small class="text-center mb-2">Question-{{$i}}</small>
                        <h5 class='text-center text-capitalize qs-title'>{{$quest->question}}</h5>
                        <div class="card-body p-0  mt-4">
                            <div class='qsoptions'>

                                
                                <input type="hidden" id="hid" name="aid[{{ $i }}]" value="{{ $fcheck[$i-1]->id }}">
                                <input type="hidden" id="hid" name="questions[{{ $i }}]" value="{{ $quest->id }}">
                                <input  class="form-check-input" type="radio" name="option{{ $quest->id }}" id="{{$k+1}}" value="{{$quest->option1}}" @if($fcheck[$i-1]->answer == $quest->option1) {{$ch}} @endif >
                               
                                <label for='{{$k+1}}' class="form-check-label"> {{$quest->option1}}</label>
                            </div>
                            
                            <div class='qsoptions'>
                                <input class="form-check-input" 
                                type="radio"
                                id="{{$k+2}}"
                                       name="option{{ $quest->id }}"
                                value="{{$quest->option2}}"  @if($fcheck[$i-1]->answer == $quest->option2)
                                                    {{$ch}} @endif
                                                    >
                                <label for='{{$k+2}}' class="form-check-label"> {{$quest->option2}} </label>
                            </div>
                            @if($quest->option3 != null)
                            <div class='qsoptions'>
                                <input  class="form-check-input" 
                                type="radio"
                                id="{{$k+3}}"
                                        name="option{{ $quest->id }}"
                                value="{{$quest->option3}}"  @if($fcheck[$i-1]->answer == $quest->option3)
                                                    {{$ch}} @endif
                                                    >
                                <label for='{{$k+3}}' class="form-check-label"> {{$quest->option3}} </label>
                            </div>
                            @endif

                            @if($quest->option4 != null)
                            <div class='qsoptions'>
                                        <input  class="form-check-input" 
                                        type="radio"
                                        id="{{$k+4}}"
                                                name="option{{ $quest->id }}"
                                        value="{{$quest->option4}}"  @if($fcheck[$i-1]->answer == $quest->option4)
                                                    {{$ch}} @endif
                                                    >
                                        <label for='{{$k+4}}' class="form-check-label"> {{$quest->option4}}</label>
                            </div>
                            @endif
                        </div>
                    </div>
                   
                </div>
                <?php $i++;$k=$k+10;?>
                @endforeach
            </div>
                <button  class="related-quiz">Update</button>
          </form>
           
        </div>
            @endif
           


                  {{-- show quiz --}}



                </div>
            </div>
        </div>
        </div>
    </section>
    

@endsection

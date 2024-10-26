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
                    <h2>My Informartion</h2>
                    <hr>
                </div>
                <div class="col-lg-3">
                    @component('frontend.inc.leftbar') @endcomponent
                </div>
                <div class="col-lg-9 p-0">

                    <div class="userDetailsArea">
                        <h4 class="text-capitalize pb-3">Refer your Friend - Thanks in advance</h4>
                         @if($errors->any())
                        <div  class="related-quiz"><h4 style="color:white;font-family: Aparajita">{{$errors->first()}}</h4></div>
                         @endif
                        <form method="post" action="{{url('/user/referal-mail-send')}}">
                            @csrf
                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Email<span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                  <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                                  <input type="hidden" id="ref_link" name="ref_link" class="form-control" value="{{url('register?ref='.Auth::user()->id)}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <button class="related-quiz">Send</button>
                                </div>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
        </div>
    </section>
    


@endsection


@extends('frontend.layouts.index') 
@section('content')


<div class="container-fluid"> 

    <div class="row bg-white customControl">
        <div class="col-md-2 px-3 text-center mt-3">
            @foreach (App\Models\Advertisement::where('position', '=', 'Left')->orderBy('serial', 'DESC')->limit(4)->get() as $advr)

            <img class="img-fluid mb-2 img-thumbnail" src="{{asset('advimage/'.$advr->image)}}" alt=""> 
        
        @endforeach
        </div>
        <div class="col-md-8 p-0 border-left border-right  ">  
                <h2 class="text-center">
                    @php
                        echo \App\Models\About::where('softcode','=', 'privacy')->first()->hardcode;
                    @endphp
                </h2><hr>
      
                <div class="container mt-4">
                    <p>
                        @php
                            echo \App\Models\About::where('softcode','=', 'privacy')->first()->details;
                        @endphp
                    </p>
                </div>
        </div>

        <div class="col-md-2 px-3 text-center">
                        
            @foreach (App\Models\Advertisement::where('position', '=', 'Right')->orderBy('serial', 'DESC')->limit(4)->get() as $advr)

            <img class="img-fluid mb-2 img-thumbnail" src="{{asset('advimage/'.$advr->image)}}" alt=""> 

            @endforeach
        </div>
    </div>
</div>
@endsection


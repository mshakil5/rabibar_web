@extends('frontend.layouts.index') 
@section('content')

<section class="login-panel">
    <div class="box">
        <h3 class="mb-4">  Register Now!</h3> 
        <div class="ermsg"></div>
        {{-- <form method="POST" action="{{ route('register') }}">  --}}
            @csrf
        <div>
            <div class="form-group">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Name">

                
            </div>

            <div class="form-group">
                <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">

                
            </div>
            <div class="form-group">
                <input id="mobile" type="number" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile') }}" autocomplete="mobile" autofocus placeholder="Mobile Number">

               
            </div>

            <div class="form-group">
                <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                
            </div>
            
            
            {{-- reference code start --}}

            <div class="form-group">
                <input type="text" class="form-control" 
                    @php 
                    if(isset($_GET["ref"])) {
                    $id = $_GET["ref"];
                    }
                    if(isset($id)) {
                        echo 'value="'.$id.'"';

                        echo "readonly";

                    }else {
                        
                    echo 'value=""'; 
                    echo 'placeholder="Reference id"';
                    
                    }
                    @endphp        

            name="reference" id="reference">
                
                
            </div>

            {{-- reference code end --}}


        </div>
        <p class="d-flex align-items-center">
            <input type="checkbox" id="policy" class="mr-2" required>
            <small class='px-2'>
                <label for="policy">
                    I agree to the <a href="{{route('frontend.terms')}}">Terms</a> and <a href="{{route('frontend.privacy')}}">Privacy Policy </a>
                </label>
            </small>
        </p>

        <div class='d-flex justify-content-between' style="column-gap: 10px;">
            <button  type="submit" class="btn btn-custom related-quiz text-white regBtn" id="regBtn">Sign up</button>
            <a href='{{ route('login') }}' class="btn btn-custom related-quiz text-white">Sign in</a>
        </div>
        
    {{-- </form> --}}
    </div>
</section>


@endsection
@section('script')



    <script>
        $(document).ready(function () {

            //header for csrf-token is must in laravel
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
            //

            var url = "{{URL::to('/user/register')}}";
            // console.log(url);


            $("#regBtn").click(function(){
                // alert('Btn work');

                    $.ajax({
                        url: url,
                        method: "POST",
                        data: {
                            name: $("#name").val(),
                            email: $("#email").val(),
                            password: $("#password").val(),
                            mobile: $("#mobile").val(),
                            policy:  $("#policy").prop('checked') == true ? 1 : 0,
                            reference: $("#reference").val()
                        },

                        success: function (d) {


                            if (d.status == 303) {
                                $(".ermsg").html(d.message);
                            }else if(d.status == 300){
                                $(".ermsg").html(d.message);
                                window.location = '{{ route("user.dashboard") }}';
                            }
                        },
                        error: function (d) {
                            console.log(d);
                        }
                    });

                //create  end
            });


        });
    </script>

@endsection
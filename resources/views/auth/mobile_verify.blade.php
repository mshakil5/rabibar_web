{{-- @extends('layouts.app') --}}
@extends('frontend.layouts.index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Phone number') }}</div>
                @if($errors->any())
                <div  class="related-quiz"><strong>Notice!</strong><h4 style="color:white;font-family: Aparajita">{{$errors->first()}}</h4></div>
                @endif
                <div class="card-body">
                    <form action="{{route('user.varified')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <span>Youn mobile no: {{$id}}, Please check your inbox</span>
                            <br><br>
                            <input type="text" class="form-control" name="verification_code" placeholder="Enter otp code">
                            <small id="emailHelp" class="form-text text-muted">Don't share your OTP code anyone</small>
                            <input type="hidden" name="phone" value="{{$id}}">
                        </div>

                      <input type="submit" value="Varify" class="btn btn-primary">
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

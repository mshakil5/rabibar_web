@extends('frontend.layouts.index')
@section('content')

<section class="login-panel">
    <div class="box" style="background-color: #ffffff94;">
        <h3 class="mb-4">Login Here!</h3>
        <div>
                            


            <form method="POST" action="{{ route('login') }}">
                @csrf

                        

                <div class="form-group">

                    @error('email')
                            <span class="invalid-feedback" role="alert">
                                <div class="related-quiz "><h4>{{$message}}</h4></div>
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    <input type="hidden" name="redirect" value="@if (isset($redirect)) {{$redirect}} @else @endif">

                    <div class="form-group">
                        <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email/Phone">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        {{-- @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif --}}
                    </div>
                </div>

                <div class="form-group">


                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"  placeholder="password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>

                <div class='d-flex justify-content-center mt-2'>
                    <button  type="submit" class="btn btn-custom related-quiz text-white">Login </button>
                </div>
                <div class='d-flex justify-content-center mt-2'>
                    @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('forget.password.get') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                    @endif
                </div>


            </form>


            {{-- <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <input id="email" type="text" class="form-control" placeholder="Username or email" aria-describedby="emailHelp" name="login" value="{{ old('username') ?: old('email') }}" required autofocus>

                    @if ($errors->has('login'))
                        <span class="text-danger">
                    <strong>{{$errors->first('login') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">


                    <input id="exampleInputPassword1" type="password" class="form-control" name="password" required autocomplete="current-password" placeholder="Password">
                    @if ($errors->has('password'))
                        <span class="text-danger">
                        <strong>{{$errors->first('password') }}</strong>
                        </span>
                    @endif

                </div>

            </form> --}}

        </div>
        {{-- <div class='d-flex justify-content-center mt-2'>
            <button class="btn btn-custom w-100">Login </button>
        </div> --}}
    </div>
</section>


@endsection

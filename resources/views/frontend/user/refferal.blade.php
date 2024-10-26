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
                    <!--new code start-->
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
                    <!--new code end -->

                    <div class="userDetailsArea">
                        <h4 class="text-capitalize pb-3">My Referral Link</h4>

                        <div class="row align-items-center">
                            <div class="col-md-12 d-flex align-items-center">
                                    <div class="col-md-2">
                                        <label>{{__('Referral url')}}</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" id="ref_link" class="form-control" value="{{url('register?ref='.Auth::user()->id)}}">
                                    </div>
                                    <div class="col-md-2">
                                        <button onclick="copyToClipboard()" class="btn btn-styled btn-base-1">{{__('Copy')}}</button>
                                    </div>
                            </div>
                        </div>


                    </div>


                    <div class="userDetailsArea">
                        <h4 class="text-capitalize pb-3">My Referral Users</h4>

                        

                        <table class="table-striped table" id="sampleTable">
                            <tr>
                                <td>Sl</td>
                                <td>Date</td>
                                <td>Name</td>
                                <td>Mobile</td>
                            </tr>
                            @php
                            $n=1;
                            @endphp

                            @foreach ($refuser as $item)
                                <tr>
                                    <td>{{ $n++ }}</td>
                                    <td>{{$item->created_at}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->mobile}}</td>
                                </tr>
                            @endforeach
                            

                            {{-- <tr>
                                <td>test</td>
                                <td>test email</td>
                            </tr> --}}
                        </table>
                    </div>

                </div>
            </div>
        </div>
        </div>
    </section>
    {{--@component('site.login.user.components.user-sub-footer') @endcomponent--}}
    {{-- @include('site.home-partials.footer') --}}

@endsection
@section('script')
<script>
    function copyToClipboard() {
        document.getElementById("ref_link").select();
        document.execCommand('copy');
    }
</script>

 <!-- Data table plugin-->
 <script type="text/javascript" src="{{asset('js/plugins/jquery.dataTables.min.js')}}"></script>
 <script type="text/javascript" src="{{asset('js/plugins/dataTables.bootstrap.min.js')}}"></script>
 <script type="text/javascript">$('#sampleTable').DataTable();</script>

@endsection

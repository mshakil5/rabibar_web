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
                      <a href="{{route('profile.edit')}}" style="text-decoration:none"
                         class="float-right text-right related-quiz text-white" >Edit Info</a>
                      <h4 class="text-capitalize pb-3">
                          <span>My Information</span>
                      </h4>
                      <table class="table-striped table">
                          <tr>
                              <td> Name</td>
                              <td>: {{ auth()->user()->name }} </td>
                          </tr>
                          <tr>
                              <td> Email</td>
                              <td>: {{ auth()->user()->email }} </td>
                          </tr>
                          <tr>
                              <td> Mobile</td>
                              <td> : {{ auth()->user()->mobile }} </td>
                          </tr>
                          <tr>
                              <td> Address</td>
                              <td> : {{ auth()->user()->address }} </td>
                          </tr>
                          <tr>
                              <td> post code</td>
                              <td> : {{ auth()->user()->postal_code }}</td>
                          </tr>
                          <tr>
                              <td> city</td>
                              <td> : {{ auth()->user()->city }} </td>
                          </tr>
                          {{--<tr>--}}
                              {{--<td> District</td>--}}
                              {{--<td> : {{ auth()->user()->contact ? auth()->user()->contact->district : '' }}</td>--}}
                          {{--</tr>--}}

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

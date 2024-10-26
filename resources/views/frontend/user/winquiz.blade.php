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

                  <div class="alert alert-warning "><h4>{{$msg}}</h4></div>
                    @else
                    <table class="table table-striped">
                        <thead>
                        <th> Quiz Name</th>
                        <th> Quiz Type</th>
                        <th> Action</th>
                        </thead>

                        <tbody>
                            @foreach ($quiz as $item)
                                <tr>
                                    <td>{{$item->quiz}}</td>
                                    <td>{{$item->quiz_type}}</td>
                                    <td>
                                        <form action="{{route('user.winnershow', $item->id)}}" method="get">
        
                                            <button class="btn btn-success">
                                                Show
                                            </button>
        
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        
                        </tbody>
                    </table>
                    @endif



                  {{-- show quiz --}}



                </div>
            </div>
        </div>
        </div>
    </section>
    

@endsection

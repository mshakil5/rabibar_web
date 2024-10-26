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
                    <div class="related-quiz "><h4>You can edit any quiz only (4) four times.</h4></div>
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
                            <?php for($i=0;$i<sizeof($quiz);$i++) { ?>
                                <tbody>
                            @if(Carbon\Carbon::now() > $quiz[$i]->expiry_date)

                                    <tr>
                                        <td>  <h4> {{ date('d-M-yy H:m', strtotime($quiz[$i]->expiry_date)) }} quiz has expired.</h4></td>

                                <td> NO EDIT</td>
                                    </tr>
                                </tbody>
                            @else


                            <tr>
                                <td>
                                <!-- <h4>{{ date('d-M-yy H:m', strtotime($quiz[$i]->expiry_date)) }} quiz</h4> -->
                                <h4>{{ $quiz[$i]->quiz }}</h4>
                                </td>
                                <td>
                                
                                <h4>{{ $quiz[$i]->quiz_type }} </h4>
                                </td>

                            <td>
                                <form action="{{url('/user/quiz/edit/'.$quiz[$i]->id)}}" method="get">

                                    <button class="btn btn-success">
                                        Edit
                                    </button>

                                </form>
                            </td>
                            </tr>
                            </tbody>

                        @endif
                        <?php };?>
                    </table>
                    @endif



                  {{-- show quiz --}}



                </div>
            </div>
        </div>
        </div>
    </section>
    

@endsection

@extends('layouts.admin')



@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
                <p>A free and open source Bootstrap 4 admin template</p>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            </ul>
        </div>

        <a href="{{ url()->previous() }}"><button class="btn btn-info">back</button></a>
        <br>
        <hr>
        <div class="container">
            <div class="main-body">
            
                  <div class="row gutters-sm">
                    
                    <div class="col-md-8">
                      <div class="card mb-3">
                        <div class="card-body">

                          <div class="row">
                            <div class="col-sm-3">
                              <h6 class="mb-0">Sponsor Name</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                             {{$spoName[0]->name}}
                            </div>
                          </div>
                          <hr>
                          
                          <hr>
                          <div class="row">
                            <div class="col-sm-3">
                              <h6 class="mb-0">Total Quiz Sponsors</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                              {{$countSpo}}
                            </div>
                          </div>
                          <hr>
                          
                         
                        </div>
                      </div>
                     
                    </div>


                  </div>
                </div>
            </div>

        <hr>

        <div id="contentContainer">


            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3> Sponsor Assign Details</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="container">


                                    <table class="table table-bordered table-hover" id="example">
                                        <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Quiz Name</th>
                                            <th>Description </th>
                                            <th>Sponsor Date</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                       $n = 1;
                                        ?>
                                        @forelse ($spoDetails as $data)
                                            <tr>
                                                <td>{{$n++}}</td>
                                                <td>{{$data->quiz}}</td>
                                                <td>{!! $data->description !!}</td>
                                                <td>{{$data->created_at}}</td>
                                            </tr>
                                        @empty
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </main>

@endsection
@section('script')


    <script type="text/javascript">
        $(document).ready(function() {
            $("#allsponsor").addClass('active');
            $("#allsponsor").addClass('is-expanded');
            $("#report").addClass('active');
        });
    </script>

@endsection

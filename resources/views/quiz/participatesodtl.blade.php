@extends('layouts.admin')

@section('content')
<main class="app-content">
    <div class="app-title">
      <div>
        <h1><i class="fa fa-th-list"></i> Quiz Details</h1>
      </div>
      <ul class="app-breadcrumb breadcrumb side">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Tables</li>
        <li class="breadcrumb-item active"><a href="#">Data Table</a></li>
      </ul>
    </div>

    {{-- <button type="button" class="btn btn-info">Add New</button><br><br> --}}
    <a href="{{ url()->previous() }}"  class="btn btn-info">Back</a><br><br>

    <div class="container">
        <div class="main-body">
              <!-- Breadcrumb -->
              <div class="row gutters-sm">
                <div class="col-md-12">
                  <div class="card mb-3">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Quiz Name</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                         {{$quizes[0]->quiz}}
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Expiry Date</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                        {{date('d-m-Y  H:m:s',strtotime($quizes[0]->expiry_date))}}
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Total User Perticipate</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                          {{$totalusers}}
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Total User of Correct Answers</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                          {{$totalCorrect}}
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Number of winners</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                          {{$now}}
                        </div>
                      </div>
                    </div>
                  </div>
                 
                </div>
              </div>
            </div>
        </div>


        {{-- new code  --}}

        <div class="row">
          <div class="col-md-12">
            <div class="tile">
              <div class="tile-body">
                  <div class="ermsg"></div>
                <div class="table-responsive">
                  <table class="table table-hover table-bordered" id="example">
                    <thead>
                      <tr>
                        <th>Quiz Name</th>
                        <th>Expiry Date</th>
                        <th>Total User Perticipate</th>
                        <th>Total User of Correct Answers </th>
                        <th>Number of winners</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$quizes[0]->quiz}}</td>
                            <td>{{date('d-m-Y  H:m:s',strtotime($quizes[0]->expiry_date))}}</td>
                            <td>{{$totalusers}}</td>
                            <td>{{$totalCorrect}}</td>
                            <td>{{$now}}</td>
                        </tr>
    
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

        {{-- new code  --}}






    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <div class="tile-body">
              <div class="ermsg"></div>
            <div class="table-responsive">
              <table class="table table-hover table-bordered" id="example1">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>UserName</th>
                    <th>Email </th>
                    <th>Phone</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($winners as $key=>$winner)
                    <tr>
                        <td>{{$key}}</td>
                        <td>{{$winner->name}}</td>
                        <td>{{$winner->username}}</td>
                        <td>{{$winner->email}}</td>
                        <td>{{$winner->mobile}}</td>
                    </tr>
                    @endforeach

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection
@section('script')
 <!-- Data table plugin-->


<script type="text/javascript">
        $(document).ready(function() {
            $("#quizmaildesc").addClass('active');
            $("#quizmaildesc").addClass('is-expanded');
            $("#participate").addClass('active');
        });
</script>
@endsection

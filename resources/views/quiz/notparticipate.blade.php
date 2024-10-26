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

    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <div class="tile-body">
              <div class="ermsg"></div>
            <div class="table-responsive">
              <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th>Sl</th>
                    <th>Quiz Name</th>
                    <th>Expire Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                    $n = 1;
                    ?>
                    @forelse ($quiz as $data)
                        <tr>
                            <td>{{$n++}}</td>
                            <td>{{$data->quiz}}</td>
                            <td>{{$data->expiry_date}}</td>
                            <td>
                                <a href="{{route('quiz.notparticipate.details',$data->id)}}"  class="btn btn-info"> Details</a>
                            </td>
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
  </main>
@endsection
@section('script')
 <!-- Data table plugin-->
 <script type="text/javascript" src="{{asset('js/plugins/jquery.dataTables.min.js')}}"></script>
 <script type="text/javascript" src="{{asset('js/plugins/dataTables.bootstrap.min.js')}}"></script>
 <script type="text/javascript">$('#sampleTable').DataTable();</script>





  <script type="text/javascript">
    $(document).ready(function() {
            $("#quizmaildesc").addClass('active');
            $("#quizmaildesc").addClass('is-expanded');
            $("#notparticipate").addClass('active');
        });
</script>
@endsection

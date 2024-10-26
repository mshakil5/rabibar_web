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



    <div class="row">
      
        <div class="col-md-6 col-lg-3">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
            <div class="info">
              <a href="{{url('admin/users')}}" target="_blank" style="text-decoration: none">
                <h4>Total User</h4>
              </a>
              <p><b>{{ App\Models\User::where('is_type', '=', 'user')->count()}}</b></p>
            </div>
          </div>
        </div>
      <div class="col-md-6 col-lg-3">
        <div class="widget-small info coloured-icon"><i class="icon fa fa-thumbs-o-up fa-3x"></i>
          <div class="info">
            <a href="{{url('admin/quiz')}}" target="_blank" style="text-decoration: none">
              <h4>Total Quiz</h4>
            </a>
            <p><b>{{ App\Models\Quiz::count()}}</b></p>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="widget-small warning coloured-icon"><i class="icon fa fa-files-o fa-3x"></i>
          <div class="info">
            <a href="{{url('admin/winner')}}" target="_blank" style="text-decoration: none">
              <h4>Total Winner</h4>
            </a>
            <p><b>{{ App\Models\Winner::count()}}</b></p>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="widget-small danger coloured-icon"><i class="icon fa fa-star fa-3x"></i>
          <div class="info">
            <a href="{{url('admin/sponsor')}}" target="_blank" style="text-decoration: none">
              <h4>Total Sponsor</h4>
            </a>
            
            <p><b>{{ App\Models\Sponsor::count()}}</b></p>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 col-lg-3">
        <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
          <div class="info">
            <h4>Users</h4>
            <p><b>{{ App\Models\User::where('is_type', '=', 'user')->count()}}</b></p>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="widget-small info coloured-icon"><i class="icon fa fa-thumbs-o-up fa-3x"></i>
          <div class="info">
            <a href="{{url('admin/quiz')}}" target="_blank" style="text-decoration: none">
              <h4>Total Quiz</h4>
            </a>
            
            <p><b>{{ App\Models\Quiz::count()}}</b></p>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="widget-small warning coloured-icon"><i class="icon fa fa-files-o fa-3x"></i>
          <div class="info">
            <a href="{{url('admin/blog')}}" target="_blank" style="text-decoration: none">
              <h4>Total Blog</h4>
            </a>
            
            <p><b>{{ App\Models\Blog::count()}}</b></p>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="widget-small danger coloured-icon"><i class="icon fa fa-star fa-3x"></i>
          <div class="info">
            <a href="{{route('videoblog')}}" target="_blank" style="text-decoration: none">
              
            <h4>Total Video Blog</h4>
            </a>
            <p><b>{{ App\Models\VideoBlog::count()}}</b></p>
          </div>
        </div>
      </div>
    </div>





    <div class="row">
      <div class="col-md-6">
        <div class="tile">
          <h3 class="tile-title">Monthly Sales</h3>
          <div class="embed-responsive embed-responsive-16by9">
            <canvas class="embed-responsive-item" id="lineChartDemo"></canvas>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="tile">
          <h3 class="tile-title">Support Requests</h3>
          <div class="embed-responsive embed-responsive-16by9">
            <canvas class="embed-responsive-item" id="pieChartDemo"></canvas>
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection

@section('script')
<script type="text/javascript">
  $(document).ready(function() {
      $("#dashboard").addClass('active');
  });
</script> 
@endsection



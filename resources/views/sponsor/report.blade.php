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
                                            <th>SL </th>
                                            <th>Sponsor Nmae</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                       $n = 1;
                                        ?>
                                        @forelse ($report as $data)
                                            <tr>
                                                <td>{{$n++}}</td>
                                                <td>{{$data->name}}</td>
                                                <td>{{$data->email}}</td>
                                                <td>{{$data->mobile}}</td>
                                                <td>
                                                <a  href="{{url('/admin/sponsor-details/'.$data->sid)}}"><i class="fa fa-eye" style="color: #03c544;font-size:16px;"></i></a>
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

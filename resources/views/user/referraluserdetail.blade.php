@extends('layouts.admin')



@section('content')
    <main class="app-content">
        <div class="app-title">
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            </ul>
        </div>

        <div id="contentContainer">


            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>{{ $name}}- {{$mobile}} Referral User Details</h3>
                            <form  action="{{route('referraluser.show',$id)}}" method ="POST">
                                @csrf
                                <br>
                                <div class="container">
                                    <div class="row">
                                        <div class="container-fluid">
                                            <div class="form-group row">
                                                <label for="date" class="col-form-label col-md-2">From Date</label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" id="fromDate" name="fromDate" required/>
                                                </div>
                                                <label for="date" class="col-form-label col-md-2">To Date</label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" id="toDate" name="toDate" required/>
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="submit" class="btn" name="search" title="Search"><img src="https://img.icons8.com/android/24/000000/search.png"/></button>
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>
                                <br>
                            </form>

                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="container">


                                    <table class="table table-bordered table-hover" id="example">
                                        <thead>
                                        <tr>
                                            <th>Sl</th>
                                            <th>Name</th>
                                            <th>Mobile</th>
                                            <th>Date</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $n = 1;
                                            ?>
                                            @forelse ($users as $user)
                                                <tr>
                                                    <td>{{$n++}}</td>
                                                    <td>{{$user->name}}</td>
                                                    <td>{{$user->mobile}}</td>
                                                    <td>{{$user->created_at}}</td>
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

{{-- update alart code  --}}
<script>
$('#demoNotify').click(function(){
    $.notify({
        title: "Update Complete : ",
        message: "Something cool is just updated!",
        icon: 'fa fa-check'
    },{
        type: "info"
    });
});
</script>
{{-- update alart code  --}}

<script>
    jQuery('#fromDate').datetimepicker({
        format:'Y-m-d H:i:s',
        inline:false,
        lang:'ru'
    });

</script>
<script>
    jQuery('#toDate').datetimepicker({
        format:'Y-m-d H:i:s',
        inline:false,
        lang:'ru'
    });

</script>



    <script type="text/javascript">
        $(document).ready(function() {
            $("#alluser").addClass('active');
            $("#alluser").addClass('is-expanded');
            $("#refferalusers").addClass('active');
        });
    </script>

@endsection

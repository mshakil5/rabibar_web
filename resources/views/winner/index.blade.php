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
        <div id="addThisFormContainer">

            <div class="row">
                <div class="col-md-3">
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3>Winner</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="ermsg">
                                </div>
                                <div class="container">

                                    {!! Form::open(['url' => 'admin/winner/create','id'=>'createThisForm']) !!}
                                    {!! Form::hidden('codeid','', ['id' => 'codeid']) !!}

                                    <div class="tile-body">
                                        <label for="user_id">User</label>
                                        <select class="form-control" id="user_id" name="user_id">
                                            <option label="Select Winner">
                                                @foreach ($users as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </option>
                                          </select>
                                    </div>

                                    <div>
                                        <label for="quiz_id">Quiz</label>
                                        <select class="form-control" id="quiz_id" name="quiz_id">
                                            <option label="Select Cities">
                                                @foreach ($quizzes as $data)
                                                    <option value="{{ $data->id }}">{{ $data->quiz }}</option>
                                                @endforeach
                                            </option>
                                          </select>
                                    </div>

                                    <div>
                                        <label for="point">Point</label>
                                        <input type="text" id="point" name="point" class="form-control">
                                    </div>

                                    <div>
                                        <label for="position">Position</label>
                                        <input type="text" id="position" name="position" class="form-control">
                                    </div>

                                    <div>
                                        <label for="gift">Gift</label>
                                        <input type="text" id="gift" name="gift" class="form-control">
                                    </div>

                                    <hr>
                                    <input type="button" id="addBtn" value="Create" class="btn btn-primary">
                                    <input type="button" id="FormCloseBtn" value="Close" class="btn btn-warning">
                                    {!! Form::close() !!}

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                </div>
            </div>

        </div>

        <!--<button id="newBtn" type="button" class="btn btn-info">Add New</button>-->
        <hr>

        <div id="contentContainer">


            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3> Winner Details</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="container">


                                    <table class="table table-bordered table-hover" id="sampleTable">
                                        <thead>
                                        <tr>
                                            <th>Sl</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Quiz no</th>
                                            <th>Point</th>
                                            <th>Gift</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $n = 1;
                                        ?>
                                        @forelse ($winners as $data)
                                            <tr>
                                                <td>{{$n++}}</td>
                                                <td>{{$data->name}}</td>
                                                <td>{{$data->email }}</td>
                                                <td>{{$data->mobile}}</td>
                                                <td>{{$data->quiz}}</td>
                                                <td>{{$data->point}}</td>
                                                <td>{{$data->gift}}</td>
                                                <td>
                                                <a id="EditBtn" rid="{{$data->wid}}"><i class="fa fa-edit" style="color: #2196f3;font-size:16px;"></i></a>
                                                    <a id="deleteBtn" rid="{{$data->wid}}"><i class="fa fa-trash-o" style="color: red;font-size:16px;"></i></a>
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

{{-- sweetalart code --}}
<script>
    $('#demoSwal').click(function(){
    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this imaginary file!",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel plx!",
        closeOnConfirm: false,
        closeOnCancel: false
    }, function(isConfirm) {
        if (isConfirm) {
            swal("Deleted!", "Your imaginary file has been deleted.", "success");
        } else {
            swal("Cancelled", "Your imaginary file is safe :)", "error");
        }
    });
});
</script>
{{-- sweetalart code --}}

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
        $(document).ready(function () {

            $("#addThisFormContainer").hide();
            $("#newBtn").click(function(){
                clearform();
                $("#newBtn").hide(100);
                $("#addThisFormContainer").show(300);

            });
            $("#FormCloseBtn").click(function(){
                $("#addThisFormContainer").hide(200);
                $("#newBtn").show(100);
                clearform();
            });


            //header for csrf-token is must in laravel
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
            //

            var url = "{{URL::to('/admin/winner')}}";
            // console.log(url);
            $("#addBtn").click(function(){
                //alert('form work');
                if($(this).val() == 'Create') {
                    $.ajax({
                        url: url,
                        method: "POST",
                        data: {
                            gift: $("#gift").val(),
                            position: $("#position").val(),
                            point: $("#point").val(),
                            quiz_id: $("#quiz_id").val(),
                            user_id: $("#user_id").val()
                        },

                        success: function (d) {


                            if (d.status == 303) {
                                $(".ermsg").html(d.message);
                            }else if(d.status == 300){
                                success("Create Successfully!!");
                                window.setTimeout(function(){location.reload()},2000)
                            }
                        },
                        error: function (d) {
                            console.log(d);
                        }
                    });
                }

                //create  end
                //Update
                if($(this).val() == 'Update'){
                    var codeid= $("#codeid").val();
                    var gift= $("#gift").val();
                    var position= $("#position").val();
                    var point= $("#point").val();
                    var quiz_id= $("#quiz_id").val();
                    var user_id= $("#user_id").val();
                    $.ajax({
                        url:url+'/'+$("#codeid").val(),
                        method: "POST",
                        data:{ codeid:codeid,user_id:user_id,quiz_id:quiz_id,point:point,position:position,gift:gift, },
                        success: function(d){
                            if (d.status == 303) {
                                $(".ermsg").html(d.message);
                                pagetop();
                            }else if(d.status == 300){
                                pagetop();
                                success("Data Updated Successfully!!");
                                window.setTimeout(function(){location.reload()},2000)
                            }
                        },
                        error:function(d){
                            console.log(d);
                        }
                    });
                }
                //Update
            });
            //Edit
            $("#contentContainer").on('click','#EditBtn', function(){

                codeid = $(this).attr('rid');
                info_url = url + '/'+codeid+'/edit';
                $.get(info_url,{},function(d){
                    populateForm(d);
                    pagetop();
                });
            });
            //Edit  end

            //Delete
            $("#contentContainer").on('click','#deleteBtn', function(){
                if(!confirm('Sure?')) return;
                codeid = $(this).attr('rid');
                info_url = url + '/'+codeid;
                $.ajax({
                    url:info_url,
                    method: "GET",
                    type: "DELETE",
                    data:{
                    },
                    success: function(d){
                        if(d.success) {
                            alert(d.message);
                            location.reload();
                        }
                    },
                    error:function(d){
                        console.log(d);
                    }
                });
            });
            //Delete
            function populateForm(data){
                $("#user_id").val(data.user_id);
                $("#quiz_id").val(data.quiz_id);
                $("#point").val(data.point);
                $("#position").val(data.position);
                $("#gift").val(data.gift);
                $("#codeid").val(data.id);
                $("#addBtn").val('Update');
                $("#addThisFormContainer").show(300);
                $("#newBtn").hide(100);
            }
            function clearform(){
                $('#createThisForm')[0].reset();
                $("#addBtn").val('Create');
            }


        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#winner").addClass('active');
        });
    </script>
    
 <!-- Data table plugin-->
 <script type="text/javascript" src="{{asset('js/plugins/jquery.dataTables.min.js')}}"></script>
 <script type="text/javascript" src="{{asset('js/plugins/dataTables.bootstrap.min.js')}}"></script>
 <script type="text/javascript">$('#sampleTable').DataTable();</script>

@endsection

@extends('layouts.admin')



@section('content')
    <main class="app-content">
        <div class="app-title">
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
                            <h3>New  Quiz</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="ermsg">
                                </div>
                                <div class="container">

                                    {!! Form::open(['url' => 'admin/quiz/create','id'=>'createThisForm']) !!}
                                    {!! Form::hidden('quizid','', ['id' => 'quizid']) !!}

                                    <div>
                                        <label for="quizname">New quiz name</label>
                                        <input type="text" id="quizname" name="quizname" class="form-control">
                                    </div>
                                    <div>
                                        <label for="datetimepicker">Expiry Date</label>
                                        <input type="text" id="datetimepicker" name="datetimepicker" class="form-control">
                                    </div>
                                    <div>
                                        <label for="quiz_type">Select quiz type</label>
                                        <select name="quiz_type" id="quiz_type" class="form-control">
                                            <option value="">Select Quiz Type</option>

                                            @foreach ($quiztype as $item)
                                            <option value="{{$item->quiztype}}">{{$item->quiztype}}</option>
                                            @endforeach
                                            {{-- <option value="">Select Quiz Type</option>
                                            <option value="Commercial">Commercial</option>
                                            <option value="Free">Free</option> --}}
                                        </select>
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

        <button id="newBtn" type="button" class="btn btn-info">Add New</button>
        <hr>

        <div id="contentContainer">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3> Quiz Details</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="container">
                                    <table class="table table-bordered table-hover" id="sampleTable">
                                        <thead>
                                        <tr>
                                            <th>Quiz Name</th>
                                            <th>Quiz Type</th>
                                            <th>Expiry Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($quiz as $item)
                                            <tr>
                                                <td>{{$item->quiz}}</td>
                                                <td>{{$item->quiz_type}}</td>
                                                <td>{{$item->expiry_date}}</td>
                                                <td>
                                                    <div class="toggle-flip">
                                                    <label>
                                                        <input type="checkbox" class="toggle-class" data-id="{{$item->id}}" {{ $item->status ? 'checked' : '' }}><span class="flip-indecator" data-toggle-on="Active" data-toggle-off="Inactive"></span>
                                                    </label>
                                                    </div>
                                                </td>
                                                <td>
                                                <a id="EditBtn" rid="{{$item->id}}"><i class="fa fa-edit" style="color: #2196f3;font-size:16px;"></i></a>
                                                    <a id="deleteBtn" rid="{{$item->id}}"><i class="fa fa-trash-o" style="color: red;font-size:16px;"></i></a>
                                                </td>
                                            </tr>
                                            @endforeach
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
<script>
    jQuery('#datetimepicker').datetimepicker({
        format:'Y-m-d H:i:s',
        inline:false,
        lang:'ru'
    });

</script>

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

            var url = "{{URL::to('/admin/quiz')}}";
            $("#addBtn").click(function(){

                if($(this).val() == 'Create') {
                    $.ajax({
                        url: url,
                        method: "POST",
                        data: {
                            quiz: $("#quizname").val(),
                            datetimepicker: $("#datetimepicker").val(),
                            quiz_type: $("#quiz_type").val(),
                        },
                        success: function (d) {
                            if (d.status == 303) {
                                $(".ermsg").html(d.message);
                            }else if(d.status == 300){
                                $(".ermsg").html(d.message);
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
                    var quizid= $("#quizid").val();
                    var quiz= $("#quizname").val();
                    var datetimepicker= $("#datetimepicker").val();
                    var quiz_type= $("#quiz_type").val();
                    $.ajax({
                        url:url+'/'+$("#quizid").val(),
                        method: "PUT",
                        type: "PUT",
                        data:{ quizid:quizid,quiz:quiz,datetimepicker:datetimepicker,quiz_type:quiz_type },
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
                      console.log(d);
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
                    method: "DELETE",
                    type: "DELETE",
                    data:{
                    },
                    success: function(d){
                        console.log(d);
                        if(d.success) {
                            success("Deleted Successfully!!");
                            //alert(d.message);
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
                $("#quizname").val(data.quiz);
                $("#datetimepicker").val(data.expiry_date);
                $("#quiz_type").val(data.quiz_type);
                // $("div#quiz_type select").val(data.quiz_type);
                $("#quizid").val(data.id);
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
    {{-- status active inactive  --}}
    <script>
        $(function() {
          $('.toggle-class').change(function() {
            var url = "{{URL::to('/admin/quiz-status')}}";
              var status = $(this).prop('checked') == true ? 1 : 0;
              var id = $(this).data('id');
               console.log(status);
              $.ajax({
                  type: "GET",
                  dataType: "json",
                  url: url,
                  data: {'status': status, 'id': id},
                  success: function(d){
                    // console.log(data.success)
                    if (d.status == 303) {
                        $(".ermsg").html(d.message);
                    }else if(d.status == 300){
                        $(".ermsg").html(d.message);
                        // window.setTimeout(function(){location.reload()},2000)
                    }
                },
                error: function (d) {
                    console.log(d);
                }
              });
          })
        })
      </script>
    {{-- status active inactive  --}}

    <script type="text/javascript">
        $(document).ready(function() {
            $("#allquiz").addClass('active');
            $("#allquiz").addClass('is-expanded');
            $("#quiz").addClass('active');
        });
    </script>
    
 <!-- Data table plugin-->
 <script type="text/javascript" src="{{asset('js/plugins/jquery.dataTables.min.js')}}"></script>
 <script type="text/javascript" src="{{asset('js/plugins/dataTables.bootstrap.min.js')}}"></script>
 <script type="text/javascript">$('#sampleTable').DataTable();</script>

@endsection

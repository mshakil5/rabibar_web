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
                            <h3> Comments</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="container">

                                    <table class="table table-bordered table-hover" id="sampleTable">
                                        <thead>
                                        <tr>
                                            <th>Sl</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Comment</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($comments as $data)
                                            <tr>
                                                <td>{{$data->id}}</td>
                                                <td>{{$data->username}}</td>
                                                <td>{{$data->email}}</td>
                                                <td>{{$data->comment}}</td>
                                                <td>
                                                    <div class="toggle-flip">
                                                    <label>
                                                        <input type="checkbox" class="toggle-class" data-id="{{$data->id}}" {{ $data->status ? 'checked' : '' }}><span class="flip-indecator" data-toggle-on="Active" data-toggle-off="Inactive"></span>
                                                    </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a id="deleteBtn" rid="{{$data->id}}"><i class="fa fa-trash-o" style="color: red;font-size:16px;"></i></a>
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
            //Delete
            var url = "{{URL::to('/admin/comment')}}";
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
        });
    </script>

<script>
    $(function() {
      $('.toggle-class').change(function() {
        var url = "{{URL::to('/admin/comment-status')}}";
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


    <script type="text/javascript">
        $(document).ready(function() {
            $("#notification").addClass('active');
            $("#notification").addClass('is-expanded');
            $("#comment").addClass('active');
        });
    </script>
    
 <!-- Data table plugin-->
 <script type="text/javascript" src="{{asset('js/plugins/jquery.dataTables.min.js')}}"></script>
 <script type="text/javascript" src="{{asset('js/plugins/dataTables.bootstrap.min.js')}}"></script>
 <script type="text/javascript">$('#sampleTable').DataTable();</script>

@endsection

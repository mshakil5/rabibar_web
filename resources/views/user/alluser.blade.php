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
                            <h3>New  User</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="ermsg">
                                </div>
                                <div class="container">

                                    {!! Form::open(['url' => 'admin/user/create','id'=>'createThisForm']) !!}
                                    {!! Form::hidden('userid','', ['id' => 'userid']) !!}

                                    <div>
                                        <label for="name">Name</label>
                                        <input type="text" id="name" name="name" class="form-control">
                                    </div>
                                    <div>
                                        <label for="email">Email</label>
                                        <input type="email" id="email" name="email" class="form-control">
                                        <span id="error_email"></span>
                                    </div>
                                    <div>
                                        <label for="mobile">Mobile</label>
                                        <input type="text" id="mobile" name="mobile" class="form-control">
                                        <span id="error_phone"></span>
                                    </div>
                                    <div>
                                        <label for="password">Password</label>
                                        <input type="password" id="password" name="password" class="form-control">
                                    </div>
                                    <div>
                                        <label for="cpassword">Confirm Password</label>
                                        <input type="password" id="cpassword" name="cpassword" class="form-control">
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
                            <h3> User Details</h3>
                            
                            
                            <form  action="{{route('admin.user.search')}}" method ="POST">
                                @csrf
                                <br>
                                <div class="container">
                                    <div class="row">
                                        <div class="container-fluid">
                                            <div class="form-group row">
                                                <label for="date" class="col-form-label col-md-2">Search</label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" id="searchdata" name="searchdata" required/>
                                                </div>

                                                <div class="col-md-2">
                                                    <button type="submit" class="btn" name="search" title="Search"><img src="https://img.icons8.com/android/24/000000/search.png"/> </button>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="float-right">
                                                        <a id="allmail" class="btn btn-sm btn-success">Send Email All User</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                            </form>
                            
                            
                            
                            
                            <!--<div class="float-right">-->
                            <!--    <a id="allmail" class="btn btn-sm btn-success">Send Email All User</a>-->
                            <!--</div>-->
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="container">


                                    <table class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th>Sl</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <th>Address</th>
                                            <th>Created Time</th>
                                            <th>Add Winner</th>
                                            <th>Status</th>
                                            <th>Action</th>
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
                                                    <td>{{$user->email}}</td>
                                                    <td>{{$user->mobile}}</td>
                                                    <td>{{$user->address}}</td>
                                                    <td>{{$user->created_at}}</td>
                                                    <td> <a href="{{route('winner.select',$user->id)}}" type="button" class="btn btn-info">Add</a> </td>
                                                    <td>
                                                        <div class="toggle-flip">
                                                        <label>
                                                            <input type="checkbox" class="toggle-class" data-id="{{$user->id}}" {{ $user->is_active ? 'checked' : '' }}><span class="flip-indecator" data-toggle-on="Active" data-toggle-off="Inactive"></span>
                                                        </label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                    <a id="EditBtn" rid="{{$user->id}}"><i class="fa fa-edit" style="color: #2196f3;font-size:16px;"></i></a>
                                                        <a id="deleteBtn" rid="{{$user->id}}"><i class="fa fa-trash-o" style="color: red;font-size:16px;"></i></a>
                                                    </td>
                                                </tr>
                                            @empty
                                            @endforelse
                                        </tbody>
                                    </table>
                                    <div class="col text-center">
                                        <span class="btn btn-default">{!! $users->links() !!}</span>
                                      </div>
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

            var url = "{{URL::to('/admin/newuser')}}";
            $("#addBtn").click(function(){

                if($(this).val() == 'Create') {
                    $.ajax({
                        url: url,
                        method: "POST",
                        data: {
                            name: $("#name").val(),
                            email: $("#email").val(),
                            password: $("#password").val(),
                            mobile: $("#mobile").val(),
                            cpassword: $("#cpassword").val(),
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
                    var userid= $("#userid").val();
                    var name= $("#name").val();
                    var email= $("#email").val();
                    var mobile= $("#mobile").val();
                    var password= $("#password").val();
                    var cpassword= $("#cpassword").val();
                    $.ajax({
                        url:url+'/'+$("#userid").val(),
                        method: "POST",
                        data:{ userid:userid,name:name,email:email,password:password,cpassword:cpassword,mobile:mobile },
                        success: function(d){
                            if (d.status == 303) {
                                $(".ermsg").html(d.message);
                                pagetop();
                            }else if(d.status == 300){
                                pagetop();
                                success("User Updated Successfully!!");
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


            function populateForm(data){
                $("#name").val(data.name);
                $("#email").val(data.email);
                $("#mobile").val(data.mobile);
                $("#userid").val(data.id);
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

    <script>
           // all mail send 
           $("body").delegate("#allmail","click",function(event){
		         event.preventDefault();
                qid = $(this).attr('qid');
                var url2 = "{{URL::to('/admin/email-alluser')}}";
                $.ajax({
                    url:url2,
                    method: "POST",
                    data:{
                      qid:qid,
                    },
                  success: function (d) {
                      if (d.status == 303) {
                          $(".ermsg").html(d.message);
                      }else if(d.status == 300){
                        success("All Mail send Successfully!!");
                        // $("#sentmail" + uid + "" ).val("Send again"); 

                      }
                  },
                  error: function (d) {
                      console.log(d);
                  }
                });
              });
    </script>


    {{-- status active inactive  --}}
    <script>
        $(function() {
          $('.toggle-class').change(function() {
            var url = "{{URL::to('/admin/user-status')}}";
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

    {{-- user email and mobile number check start --}}
    
<script>
    $(document).ready(function() {
        $('#email').keyup(function(){
            // alert('test');
          var email = $('#email').val();
          var error_email = '';
          var email = $('#email').val();
          var _token = $('input[name="_token"]').val();
           $.ajax({
            url:"{{ route('email.check') }}",
            method:"POST",
            data:{email:email, _token:_token},

            success:function(result)
            {
             if(result == 'unique')
             {
              $('#error_email').html('<label class="text-success">Email Available</label>');
              $('#email').removeClass('has-error');
              $('#register').attr('disabled', false);
             }
             else
             {
              $('#error_email').html('<label class="text-danger">Already have a Account</label>');
              $('#email').addClass('has-error');
              $('#register').attr('disabled', 'disabled');
             }
            }
           });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#mobile').keyup(function(){
          var error_phone = '';
          var phone = $('#mobile').val();
          var _token = $('input[name="_token"]').val();
      var filter = /^([0-9\s\-\+\(\)]*)$/;
      if(!filter.test(phone))
      {
        $('#error_phone').html('<label class="text-danger">Invalid Phone Number</label>');
        $('#mobile').addClass('has-error');
        $('#register').attr('disabled', 'disabled');
      } else if (phone.length > 11){
        $('#error_phone').html('<label class="text-danger">Invalid Phone Number</label>');
        $('#mobile').addClass('has-error');
        $('#register').attr('disabled', 'disabled');
      } else {
           $.ajax({
            url:"{{ route('phone_available.check') }}",
            method:"POST",
            data:{phone:phone, _token:_token},
            success:function(result)
            {
             if(result == 'unique')
             {
              $('#error_phone').html('<label class="text-success">Phone Available</label>');
              $('#mobile').removeClass('has-error');
              $('#register').attr('disabled', false);
             }
             else
             {
              $('#error_phone').html('<label class="text-danger">Already have a Account</label>');
              $('#mobile').addClass('has-error');
              $('#register').attr('disabled', 'disabled');
             }
            }
           })
      }
         });
    
        });
        </script>
    {{-- user email and mobile number check end --}}

    <script type="text/javascript">
        $(document).ready(function() {
            $("#alluser").addClass('active');
            $("#alluser").addClass('is-expanded');
            $("#users").addClass('active');
        });
    </script>

@endsection

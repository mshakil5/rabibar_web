@extends('layouts.admin')



@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            </ul>
        </div>
        <div id="addThisFormContainer">

            <div class="row">
                <div class="col-md-2">
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3>New Blog</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="ermsg">
                                </div>
                                <div class="container">

                                    {!! Form::open(['url' => 'admin/master/create','id'=>'createThisForm']) !!}
                                    {!! Form::hidden('codeid','', ['id' => 'codeid']) !!}
                                    @csrf
                                    <div>
                                        <label for="category" class="awesome">Category</label>
                                        <select name="category" class="form-control" id="category" required>
                                            <option value=""  >Select Account Type</option>
                                            @foreach ($cats as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div>
                                        <label for="title">Title</label>
                                        <input type="text" id="title" name="title" class="form-control">
                                    </div>
                                    <div>
                                        <label for="details">Description</label>
                                        <textarea class="form-control" id="details" name="details" rows="4" placeholder="Enter your details"></textarea>
                                    </div>
                                    <div>
                                        <label for="image">Image</label>
                                        <input class="form-control" id="image" name="image" type="file">
                                    </div>
                                    <div>
                                        <label for="source">Source</label>
                                        <input class="form-control" type="text" name="source" id="source" placeholder="Enter source">
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
                <div class="col-md-2">
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
                            <h3> Blog Details</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="container">


                                    <table class="table table-bordered table-hover" id="example">
                                        <thead>
                                        <tr>
                                          <th>ID</th>
                                          <th>Category</th>
                                          <th>title</th>
                                          <th>Details</th>
                                          <th>Image</th>
                                          <th>Status</th>
                                          <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                              @foreach ($blogs as $data)
                                            <tr>
                                              <td>{{$data->id}}</td>
                                              <td>{{$data->name}}</td>
                                              <td>{{$data->title}}</td>
                                              <td>{!!$data->details!!}</td>
                                              <td>
                                                @if ($data->photo)
                                                    <img src="{{asset('blogimage/'.$data->photo)}}" height="50px" width="50px" alt="">
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="#" class="statusToggle" rid="{{$data->id}}" data-status="{{$data->status}}">
                                                        <i class="fa {{ $data->status == 1 ? 'fa-toggle-on' : 'fa-toggle-off' }}" style="font-size: 24px; color: {{ $data->status == 1 ? 'green' : 'red' }};"></i>
                                                    </a>
                                                </td>
                                              <td>
                                              @if ($data->request)
                                              <a id="viewRequestBtn" rid="{{$data->id}}"
                                                data-name="{{ $data->request->name }}"
                                                data-email="{{ $data->request->email }}"
                                                data-phone="{{ $data->request->phone }}"
                                                data-address="{{ $data->request->address }}"
                                                data-message="{{ $data->request->message }}">
                                                <i class="fa fa-eye" style="color: green; font-size:16px;"></i>
                                            </a>
                                            @endif
                                                <a id="EditBtn" rid="{{$data->id}}"><i class="fa fa-edit" style="color: #2196f3;font-size:16px;"></i></a>
                                                <a id="deleteBtn" rid="{{$data->id}}"><i class="fa fa-trash-o" style="color: red;font-size:16px;"></i></a>
                                              </td>
                                            </tr>
                                            @endforeach
                                          </tbody>
                                    </table>

                                    {{ $blogs->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </main>

<!-- Modal Structure -->
<div id="blogRequestModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="blogRequestModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="blogRequestModalLabel">Blog Request Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-12">
                        <p><strong>Name:</strong> <span id="requestName"></span></p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6 col-sm-12">
                        <p><strong>Email:</strong> <span id="requestEmail"></span></p>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <p><strong>Phone:</strong> <span id="requestPhone"></span></p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12">
                        <p><strong>Address:</strong> <span id="requestAddress"></span></p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12">
                        <p><strong>Message:</strong> <span id="requestMessage"></span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
    <script>
        $(document).ready(function () {

            $("#addThisFormContainer").hide();
            $("#newBtn").click(function(){
                $("#details").addClass("ckeditor");
                for ( instance in CKEDITOR.instances ) {
                    CKEDITOR.instances[instance].updateElement();
                    } 
                 CKEDITOR.replace( 'details' );
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

            var url = "{{URL::to('/admin/blog')}}";
            // console.log(url);
            $("#addBtn").click(function(){
            //   alert("#addBtn");
                if($(this).val() == 'Create') {
                    for ( instance in CKEDITOR.instances ) {
                    CKEDITOR.instances[instance].updateElement();
                    }  
                    var file_data = $('#image').prop('files')[0];
                        if(typeof file_data === 'undefined'){
                            file_data = 'null';
                        }
                    var form_data = new FormData();
                    form_data.append("category", $("#category").val());
                    form_data.append("title", $("#title").val());
                    form_data.append("details", $("#details").val());
                    form_data.append('image', file_data);
                    form_data.append("source", $("#source").val());

                    $.ajax({
                      url: url,
                      method: "POST",
                      contentType: false,
                      processData: false,
                      data:form_data,
                      success: function (d) {
                        console.log(d);
                          if (d.status == 303) {
                              $(".ermsg").html(d.message);
                          }else if(d.status == 300){
                            success("Data Insert Successfully!!");
                                window.setTimeout(function(){location.reload()},2000)
                          }
                      },
                      error: function (xhr , status, error) {
                          console.log(xhr.responseText);
                      }
                  });
                }
                //create  end
                //Update
                if($(this).val() == 'Update'){
                // alert('update btn work');
                for ( instance in CKEDITOR.instances ) {
                CKEDITOR.instances[instance].updateElement();
                }  
                  var file_data = $('#image').prop('files')[0];
                  if(typeof file_data === 'undefined'){
                    file_data = 'null';
                  }
                  var form_data = new FormData();
                  form_data.append("category", $("#category").val());
                  form_data.append("title", $("#title").val());
                  form_data.append("details", $("#details").val());
                  form_data.append('image', file_data);
                  form_data.append("source", $("#source").val());
                  form_data.append('_method', 'put');

                    console.log(image);
                    // alert(name);
                    $.ajax({
                        url:url+'/'+$("#codeid").val(),
                        type: "POST",
                        dataType: 'json',
                        contentType: false,
                        processData: false,
                        data:form_data,
                        success: function(d){
                            console.log(d);
                            if (d.status == 303) {
                                $(".ermsg").html(d.message);
                                pagetop();
                            }else if(d.status == 300){
                                success("Data Update Successfully!!");
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
                //alert("btn work");
                codeid = $(this).attr('rid');
                //console.log($codeid);
                info_url = url + '/'+codeid+'/edit';
                //console.log($info_url);
                $.get(info_url,{},function(d){
                    populateForm(d);
                    pagetop();
                });
            });
            //Edit  end

            //Delete
            $("#contentContainer").on('click','#deleteBtn', function(){
                if(!confirm('Sure?')) return;
                 masterid = $(this).attr('rid');
                 info_url = url + '/'+masterid;
                // console.log(info_url);
                //alert(info_url);
                $.ajax({
                    url:info_url,
                    method: "DELETE",
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
                for ( instance in CKEDITOR.instances ) {
                    CKEDITOR.instances[instance].updateElement();
                    } 
                $("#category").val(data.category_id);
                $("#title").val(data.title);
                $("#details").val(data.details);
                 CKEDITOR.replace( 'details' );
                $("#source").val(data.source);
                $("#codeid").val(data.id);
                // $("#image").val(data.image);
                $("#addBtn").val('Update');
                $("#addThisFormContainer").show(300);
                $("#newBtn").hide(100);
            }
            function clearform(){
                $('#createThisForm')[0].reset();
                $("#addBtn").val('Create');
                for (let instance in CKEDITOR.instances) {
                    CKEDITOR.instances[instance].setData('');
                }
            }

            $(document).on('click', '#viewRequestBtn', function() {
                var name = $(this).data('name');
                var email = $(this).data('email');
                var phone = $(this).data('phone');
                var address = $(this).data('address');
                var message = $(this).data('message');

                $('#requestName').text(name);
                $('#requestEmail').text(email);
                $('#requestPhone').text(phone);
                $('#requestAddress').text(address);
                $('#requestMessage').text(message);

                $('#blogRequestModal').modal('show');
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#blog").addClass('active');
            $("#blog").addClass('is-expanded');
            $("#blogpost").addClass('active');
        });
    </script>

<script>
    $(document).on('click', '.statusToggle', function(e) {
        e.preventDefault();

        var $this = $(this);
        var id = $this.attr('rid');
        var currentStatus = $this.data('status');
        var newStatus = currentStatus === 1 ? 0 : 1;

        $.ajax({
            url: '/admin/blog/update-status',
            method: 'POST',
            data: {
                id: id,
                status: newStatus,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                $this.data('status', newStatus);
                if (newStatus === 1) {
                    $this.find('i').removeClass('fa-toggle-off').addClass('fa-toggle-on').css('color', 'green');
                } else {
                    $this.find('i').removeClass('fa-toggle-on').addClass('fa-toggle-off').css('color', 'red');
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    });
</script>
   
@endsection

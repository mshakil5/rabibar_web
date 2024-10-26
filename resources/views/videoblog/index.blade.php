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
                <div class="col-md-2">
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3>New Video Blog</h3>
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
                                            <option value=""  >Select Category</option>
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
                                        <label for="link">Link</label>
                                        <input type="text" id="link" name="link" class="form-control">
                                    </div>

                                    <div>
                                        <label for="position">Position</label>
                                        <select name="position" id="position" class="form-control">
                                            <option value="">Please Select</option>
                                            <option value="home">Home Page</option>
                                            <option value="footer">Footer</option>
                                            <option value="left">Left</option>
                                            <option value="top">Top</option>
                                            <option value="bottom">Bottom</option>
                                            <option value="others">Others</option>
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
                            <h3>Video Blog Details</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="container">


                                    <table class="table table-bordered table-hover" id="example">
                                        <thead>
                                        <tr>
                                          <th>ID</th>
                                          <th>Category</th>
                                          <th>Title</th>
                                          <th>Link</th>
                                          <th>Position</th>
                                          <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $n = 1;
                                            ?>
                                              @foreach ($blogs as $data)
                                            <tr>
                                              <td>{{$n++}}</td>
                                              <td>{{$data->name}}</td>
                                              <td>{{$data->title}}</td>
                                              <td>{{$data->link}}</td>
                                              <td>{{$data->position}}</td>
                                              <td>
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
   
@endsection
@section('script')
    <script src="//cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
    <script>
    // CKEDITOR.replace( 'details' );
    </script>
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

            var url = "{{URL::to('/admin/video-blog')}}";
            // console.log(url);
            $("#addBtn").click(function(){
            //   alert("#addBtn");
                if($(this).val() == 'Create') {
                    var form_data = new FormData();
                    form_data.append("category", $("#category").val());
                    form_data.append("title", $("#title").val());
                    form_data.append("link", $("#link").val());
                    form_data.append("position", $("#position").val());

                    $.ajax({
                      url: url,
                      method: "POST",
                      contentType: false,
                      processData: false,
                      data:form_data,
                      success: function (d) {
                          if (d.status == 303) {
                              $(".ermsg").html(d.message);
                          }else if(d.status == 300){
                            success("Data Insert Successfully!!");
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
                // alert('update btn work');
                
                  var form_data = new FormData();
                  form_data.append("category", $("#category").val());
                  form_data.append("title", $("#title").val());
                  form_data.append("link", $("#link").val());
                  form_data.append("position", $("#position").val());
                  form_data.append("codeid", $("#codeid").val());

                    // console.log(image);
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
                $("#category").val(data.category_id);
                $("#title").val(data.title);
                $("#link").val(data.link);
                $("#position").val(data.position);
                $("#codeid").val(data.id);
                // $("#image").val(data.image);
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
            $("#vdoblog").addClass('active');
            $("#vdoblog").addClass('is-expanded');
            $("#vdoblogpost").addClass('active');
        });
    </script>
   
@endsection

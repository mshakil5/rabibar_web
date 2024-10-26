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
                            <h3>New Image</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="ermsg">
                                </div>
                                <div class="container">

                                    {!! Form::open(['url' => 'admin/adv/create','id'=>'createThisForm']) !!}
                                    {!! Form::hidden('codeid','', ['id' => 'codeid']) !!}
                                    @csrf
                                    

                                    <div>
                                        <label for="title">Title</label>
                                        <input type="text" id="title" name="title" class="form-control">
                                    </div>
                                    <div>
                                        <label for="image">Image</label>
                                        <input class="form-control" id="image" name="image" type="file">
                                    </div>
                                    <div>
                                        <label for="serial">Serial</label>
                                        <input type="number" id="serial" name="serial" class="form-control">
                                    </div>
                                    <div>
                                        <label for="link">Link</label>
                                        <input type="text" id="link" name="link" class="form-control">
                                    </div>
                                    <div>
                                        <label for="position">Position</label>
                                        <select name="position" id="position" class="form-control">
                                            <option value="">Please Select</option>
                                            <option value="Left">Left</option>
                                            <option value="Left-top">Left-top</option>
                                            <option value="Right">Right</option>
                                            <option value="Banner">Banner</option>
                                            <option value="Email">Email</option>
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
                            <h3> Image Details</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="container">


                                    <table class="table table-bordered table-hover" id="sampleTable">
                                        <thead>
                                        <tr>
                                          <th>ID</th>
                                          <th>Title</th>
                                          <th>Image</th>
                                          <th>Serial</th>
                                          <th>Link</th>
                                          <th>Image Link</th>
                                          <th>Position</th>
                                          <th>Action</th>
                                        </tr>
                                        </thead>
                                        
                                        <tbody>
                                            <?php
                                            $n = 1; 
                                            ?>
                                              @foreach ($advr as $data)
                                            <tr>
                                              <td>{{$n++}}</td>
                                              <td>{{$data->title}}</td>
                                              <td><img src="{{asset('advimage/'.$data->image)}}" height="50px" width="50px" alt=""></td>
                                              <td><input type="text" class="form-control" id="serialshow{{$data->id}}" value="{{$data->serial}}" readonly>

                                                <a id="srlBtn{{$data->id}}" rid="{{$data->id}}"><i class="fa fa-edit srlEditBtn" style="color: #2196f3;font-size:16px;"></i></a>

                                                <a id="srlSaveBtn{{$data->id}}" rid="{{$data->id}}"><i class="fa fa-check-square-o" style="color: #10910b;font-size:16px;"></i></a>

                                            </td>
                                              <td>{{$data->link}}</td>
                                              <td><input type="text" id="copy{{$data->id}}" value="{{asset('advimage/'.$data->image)}}" class="form-control"></td>
                                              <td>{{$data->position}}</td>
                                              <td>
                                                <a onclick="copyToClipboard('copy{{ $data->id }}')"><i class="fa fa-copy" style="color: #1e09db;font-size:16px;"></i></a>
                                                <a id="EditBtn" rid="{{$data->id}}"><i class="fa fa-edit" style="color: #2196f3;font-size:16px;"></i></a>
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

            

            // $("body").delegate(".srlEditBtn","click",function(event){
            //         event.preventDefault();
            //         alert("btn work");
            //         rid = $(this).attr("rid");
            //         alert(rid);
            //         $("#srlBtn" + rid + "" ).attr("readonly", false); 
                    
            //         $("#srlEditBtn" + rid + "").hide(); 
            // });

            //header for csrf-token is must in laravel
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
            //

            var url = "{{URL::to('/admin/advertisement')}}";
            // console.log(url);
            $("#addBtn").click(function(){
            //   alert("#addBtn");
                if($(this).val() == 'Create') {
                      
                    var file_data = $('#image').prop('files')[0];
                    var form_data = new FormData();
                    form_data.append("title", $("#title").val());
                    form_data.append('image', file_data);
                    form_data.append("serial", $("#serial").val());
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
                 
                  var file_data = $('#image').prop('files')[0];
                  if(typeof file_data === 'undefined'){
                    file_data = 'null';
                  }
                  var form_data = new FormData();
                  form_data.append("title", $("#title").val());
                  form_data.append('image', file_data);
                  form_data.append("serial", $("#serial").val());
                  form_data.append("link", $("#link").val());
                  form_data.append("position", $("#position").val());
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
                console.log(info_url);
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
                $("#title").val(data.title);
                $("#serial").val(data.serial);
                $("#link").val(data.link);
                $("#position").val(data.position);
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
    <script>
        function copyToClipboard(id) {
            document.getElementById(id).select();
            document.execCommand('copy');
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#advertisement").addClass('active');
        });
    </script>
    
 <!-- Data table plugin-->
 <script type="text/javascript" src="{{asset('js/plugins/jquery.dataTables.min.js')}}"></script>
 <script type="text/javascript" src="{{asset('js/plugins/dataTables.bootstrap.min.js')}}"></script>
 <script type="text/javascript">$('#sampleTable').DataTable();</script>
   
@endsection

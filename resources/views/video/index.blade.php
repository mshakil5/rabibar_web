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
                            <h3>New Video</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="ermsg">
                                </div>
                                <div class="container">

                                    <form action="{{route('video.store')}}" method="post" enctype="multipart/form-data">
                                    <input type="hidden" id="codeid" name="codeid" class="form-control">
                                    @csrf
                                   

                                    <div>
                                        <label for="title">Title</label>
                                        <input type="text" id="title" name="title" class="form-control" required>
                                    </div>
                                    
                                    <div>
                                        <label for="video">Video</label>
                                        <input class="form-control" id="video" name="video" type="file" required>
                                    </div>
                                    <div>
                                        @php
                                        
                                        if (isset(App\Models\Video::where('position', '=', 'top')->where('status', '=', 1)->first()->position)) {
                                            $top = App\Models\Video::where('position', '=', 'top')->where('status', '=', 1)->first()->position == 'top';                                      
                                        
                                        } else {
                                            $top = null;
                                        }

                                                                                
                                        if (isset(App\Models\Video::where('position', '=', 'footer')->where('status', '=', 1)->first()->position)) {
                                            $footer = App\Models\Video::where('position', '=', 'footer')->where('status', '=', 1)->first()->position == 'footer';                                      
                                        
                                        } else {
                                            $footer = null;
                                        }


                                        @endphp

                                        <label for="position">Position</label>
                                        <select class="form-control"name="position" id="position" required>
                                            @if (($top == "top") && ($footer == null))
                                            <option value="footer">footer</option>

                                            @elseif(($top == null) && ($footer == "footer"))
                                            <option value="top">top</option>

                                            @elseif(($top == null) && ($footer == null))
                                            <option value="top">top</option>
                                            <option value="footer">footer</option>
                                           

                                            @else
                                            <option value="">Select</option>
                                          
                                            @endif
                                            
                                        </select>
                                    </div>


                                    <hr>
                                    {{-- <input type="button" id="addBtn" value="Create" class="btn btn-primary">
                                    <input type="button" id="FormCloseBtn" value="Close" class="btn btn-warning"> --}}
                                    <button type="submit" class="btn btn-primary">Create</button>
                                    <input type="button" id="FormCloseBtn" value="Close" class="btn btn-warning">
                                </form>

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
                            <h3> Video Details</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="container">


                                    <table class="table table-bordered table-hover" id="example">
                                        <thead>
                                        <tr>
                                          <th>ID</th>
                                          <th>Title</th>
                                          <th>Video</th>
                                          <th>Position</th>
                                          <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                              @foreach ($videos as $data)
                                            <tr>
                                              <td>{{$data->id}}</td>
                                              <td>{{$data->title}}</td>
                                              <td><iframe width="80%" height="auto" src="{{ asset('videos/'.$data->name) }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                                                </iframe></td>
                                                <td>{{$data->position}}</td>
                                              <td>
                                                {{-- <a id="EditBtn" rid="{{$data->id}}"><i class="fa fa-edit" style="color: #2196f3;font-size:16px;"></i></a> --}}
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


            //header for csrf-token is must in laravel
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
            //

            var url = "{{URL::to('/admin/video')}}";
            // console.log(url);
            $("#addBtn").click(function(){
            //   alert("#addBtn");
                if($(this).val() == 'Create') {

                    // var form_data = new FormData($('#video')[0]);  
                    // var file_data = $('#video').prop('files')[0];

                    var file_data = $('#video')[0];
                    var form_data = new FormData();
                    form_data.append("title", $("#title").val());
                    form_data.append('video', file_data);
                    form_data.append("position", $("#position").val());


                    $.ajax({
                      url: url,
                      method: "POST",
                      contentType: false,
                      processData: false,
                      cache: false,
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
                
                  var file_data = $('#video').prop('files')[0];
                  if(typeof file_data === 'undefined'){
                    file_data = 'null';
                  }
                  var form_data = new FormData();
                  form_data.append("title", $("#title").val());
                  form_data.append('video', file_data);
                  form_data.append("position", $("#position").val());
                  form_data.append('_method', 'put');

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

                $("#title").val(data.title);
                $("#position").val(data.position);
                $("#codeid").val(data.id);
                $("#addBtn").val('Update');
                $("#addThisFormContainer").show(300);
                $("#newBtn").hide(100);
            }
            function clearform(){
                // $('#createThisForm')[0].reset();
                $("#addBtn").val('Create');
            }
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#video").addClass('active');
        });
    </script>
   
@endsection

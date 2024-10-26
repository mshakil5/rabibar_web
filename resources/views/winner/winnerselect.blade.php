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

                                    

                                    <div>
                                        <label for="quiz_id">Quiz</label>
                                        <select class="form-control" id="quiz_id" name="quiz_id">
                                            <option label="Select Quiz">
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

                                    <input type="hidden" id="user_id" name="user_id" value="{{$user->id}}" class="form-control">

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




    </main>

@endsection


@section('script')

    <script>
        $(document).ready(function () {

            //header for csrf-token is must in laravel
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
            //

            var url = "{{URL::to('/admin/winner')}}";
            // var redirecturl = "{{URL::to('/admin/users')}}";
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
                                window.location.href = url;
                            }
                        },
                        error: function (d) {
                            console.log(d);
                        }
                    });
                }

                //create  end
                
            });
            
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#winner").addClass('active');
        });
    </script>

@endsection

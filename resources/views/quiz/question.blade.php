@extends('layouts.admin')


@section('css')
{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
<style>
    .quiz:hover{
   background-color: #f0f5f4;
   color: black;
   
}

.qustion:hover{
   background-color: white;
   color: black;
   
}

a:hover {
  text-decoration: none;
}
</style>
@endsection

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


        <div id="contentContainer">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>Quiz & Question</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="container">
                                    
                                    {{-- accordian code --}}


    <!--Accordion wrapper-->
    <div class="accordion md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true">



        @foreach ($quiz as $data)
        <!-- Accordion card -->
        <div class="card quiz">
    
            <!-- Card header -->
            <div class="card-header" role="tab" id="heading{{$data->id}}">
                <a data-toggle="collapse" data-parent="#accordionEx" href="#collapse{{$data->id}}" aria-expanded="true" aria-controls="collapse{{$data->id}}">
                <h5 class="mb-0">
                    Quiz Name: {{$data->quiz}} <i class="fa fa-angle-down rotate-icon float-right"></i>
                </h5>
                </a>
            </div>
    
            <!-- Card body -->
            <div id="collapse{{$data->id}}" class="collapse" role="tabpanel" aria-labelledby="heading{{$data->id}}" data-parent="#accordionEx">
                <div class="card-body">
                
                    <button type="button" class="btn btn-info float-right newBtn">Add New</button><br><br>

                    {{-- form div start --}}
                    <div class="addThisFormContainer">
                        <div class="row">
                            <div class="col-md-3">
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h3>Add New Question</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="ermsg">
                                            </div>
                                            <div class="container">
                                                <form action="" class="qsnform" method="post">

                                                    <input type="hidden" id="qstid{{$data->id}}" name="quizid" class="form-control">            
                                                    <div>
                                                        <label for="question">Question</label>
                                                        <input type="text" id="question{{$data->id}}" name="question" class="form-control">
                                                    </div>
                                                    <div>
                                                        <label for="answer">Answer</label>
                                                        <input type="text" id="answer{{$data->id}}" name="answer" class="form-control">
                                                    </div>
                                                    <div>
                                                        <label for="option1">Option 1</label>
                                                        <input type="text" id="option1{{$data->id}}" name="option1" class="form-control">
                                                    </div>
                                                    <div>
                                                        <label for="option2">Option 2</label>
                                                        <input type="text" id="option2{{$data->id}}" name="option2" class="form-control">
                                                    </div>
                                                    <div>
                                                        <label for="option3">Option 3</label>
                                                        <input type="text" id="option3{{$data->id}}" name="option3" class="form-control">
                                                    </div>
                                                    <div>
                                                        <label for="option4">Option 4</label>
                                                        <input type="text" id="option4{{$data->id}}" name="option4" class="form-control">
                                                    </div>
                
                                                    <hr>
                                                    <input type="button" quizid="{{$data->id}}" id="addBtn{{$data->id}}" value="Create" class="btn btn-primary createBtn">
                                                    <input type="button" id="FormCloseBtn" value="Close" class="btn btn-warning FormCloseBtn">
                                                </form>
            
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                            </div>
                        </div>
                    </div>

                    {{-- form div end --}}

                    {{-- question show here --}}
                    @foreach (App\Models\Question::where('quiz_id', '=', $data->id)->orderBy('created_at', 'desc')->get() as $question)
                    <p class="dlmsg{{$question->id}} text-center">  </p>
                        <div class="card-header qustion">
                            <p>
                                {{ $question->question}}
                                <span class="float-right"> 
                                    <a class="editBtn" quizid="{{$data->id}}" qid="{{$question->id}}"><i class="fa fa-edit" style="color: #2196f3;font-size:16px;"></i></a>
                                    <a class="dltBtn" quizid="{{$data->id}}" qid="{{$question->id}}"><i class="fa fa-trash-o" style="color: red;font-size:16px;"></i></a>
                                </span>
                            </p>
                        </div>
                    @endforeach
                    {{-- qeustion show  --}}

                </div>
            </div>
    
        </div>
        <!-- Accordion card -->
        @endforeach
                    </div>
                    <!-- Accordion wrapper -->
                {{-- accordian code --}}
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

            $(".addThisFormContainer").hide();
            $(".newBtn").click(function(){
                $('.qsnform').trigger("reset");
                $(".createBtn").val('Create');
                $(".newBtn").hide(100);
                $(".addThisFormContainer").show(300);

            });
            $(".FormCloseBtn").click(function(){
                $(".addThisFormContainer").hide(200);
                $(".newBtn").show(100);
                clearform();
            });


            // add questions 

            
        //header for csrf-token is must in laravel
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
        //
        $("body").delegate(".createBtn","click",function(event){
		event.preventDefault();
        
        if($(this).val() == 'Create') {

        var url = "{{URL::to('/admin/addquestion')}}";
        quizid = $(this).attr('quizid');

        var question= $("#question" + quizid + "").val();
        var answer= $("#answer" + quizid + "").val();
        var option1= $("#option1" + quizid + "").val();
        var option2= $("#option2" + quizid + "").val();
        var option3= $("#option3" + quizid + "").val();
        var option4= $("#option4" + quizid + "").val();

            // console.log(quizid,question,answer,option1,option2,option3,option4);

            $.ajax({
                    url:url,
                    method: "POST",
                    data:{
                        quizid:quizid,question:question,answer:answer,option1:option1,option2:option2,option3:option3,option4:option4,
                    },
                    success: function(d){
                        if (d.status == 303) {
                            $(".ermsg").html(d.message);
                        }else if(d.status == 300){
                             $(".ermsg").html(d.message);
                            window.setTimeout(function(){location.reload()},2000)
                        }
                    },
                    error:function(d){
                        console.log(d);
                    }
                });

            }


            // update question 
            if($(this).val() == 'Update') {

                var url = "{{URL::to('/admin/updatequestion')}}";
                quizid = $(this).attr('quizid');

                var qstid= $("#qstid" + quizid + "").val();

                var question= $("#question" + quizid + "").val();
                var answer= $("#answer" + quizid + "").val();
                var option1= $("#option1" + quizid + "").val();
                var option2= $("#option2" + quizid + "").val();
                var option3= $("#option3" + quizid + "").val();
                var option4= $("#option4" + quizid + "").val();

                    // console.log(quizid,question,answer,option1,option2,option3,option4);

                    $.ajax({
                            url:url,
                            method: "POST",
                            data:{
                                qstid:qstid,quizid:quizid,question:question,answer:answer,option1:option1,option2:option2,option3:option3,option4:option4,
                            },
                            success: function(d){
                                if (d.status == 303) {
                                    $(".ermsg").html(d.message);
                                }else if(d.status == 300){
                                    $(".ermsg").html(d.message);
                                    window.setTimeout(function(){location.reload()},2000)
                                }
                            },
                            error:function(d){
                                console.log(d);
                            }
                        });

                    }






            });


        // delete question
        $("body").delegate(".dltBtn","click",function(event){
		event.preventDefault();
        if(!confirm('Sure?')) return;
        var dlturl = "{{URL::to('/admin/deleteqst')}}";
        qid = $(this).attr('qid');
        quizid = $(this).attr('quizid');

            // console.log(qid,quizid);

            $.ajax({
                    url:dlturl,
                    method: "POST",
                    data:{
                        qid:qid,quizid:quizid
                    },
                    success: function(d){
                        if (d.status == 303) {
                            $(".dlmsg"+ qid + "").html(d.message);
                        }else if(d.status == 300){
                             $(".dlmsg"+ qid + "").html(d.message);
                            window.setTimeout(function(){location.reload()},2000)
                        }
                    },
                    error:function(d){
                        console.log(d);
                    }
                });
            });



        //    question edit 
        $("body").delegate(".editBtn","click",function(event){
		event.preventDefault();
        qid = $(this).attr('qid');
        edturl = "{{URL::to('/admin/question')}}";
        info_url = edturl + '/'+qid+'/edit';
        $.get(info_url,{},function(d){
            populateForm(d);
        });
        });


        function populateForm(data){
            quiz_id = data.quiz_id;
                $("#qstid" + quiz_id + "").val(data.id);
                $("#question" + quiz_id + "").val(data.question);
                $("#answer" + quiz_id + "").val(data.answer);
                $("#option1" + quiz_id + "").val(data.option1);
                $("#option2" + quiz_id + "").val(data.option2);
                $("#option3" + quiz_id + "").val(data.option3);
                $("#option4" + quiz_id + "").val(data.option4);
                $("#addBtn" + quiz_id + "").val('Update');
                $(".addThisFormContainer").show(300);
            }









        });
    </script>

    <script type="text/javascript">
         $(document).ready(function() {
            $("#allquiz").addClass('active');
            $("#allquiz").addClass('is-expanded');
            $("#question").addClass('active');
        });
    </script>

@endsection

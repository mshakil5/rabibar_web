@extends('layouts.admin')



@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
              <h1><i class="fa fa-edit"></i>Participation mail detail</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
              <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
              <li class="breadcrumb-item">Forms</li>
              <li class="breadcrumb-item"><a href="#">Form Components</a></li>
            </ul>
          </div>
{{-- form start  --}}

<div id="addThisFormContainer">

    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3> Participation mail detail</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="ermsg">
                        </div>
                        <div class="container">

                        <form action="" method="post">
                            @csrf
                            <input type="hidden" id="codeid" name="codeid" value="@if (!empty($pmail->id)){{$pmail->id}}@endif" class="form-control">
                            <div>
                                <label for="subject">Subject</label>
                                <input type="text" id="subject" name="subject" value="@if (!empty($pmail->subject)){{$pmail->subject}}@endif" class="form-control">
                            </div>
                            <div>
                                <label for="body">Body</label>
                                <textarea class="form-control" id="body" name="body" rows="4" placeholder="Enter Details">@if (!empty($pmail->body)){!!$pmail->body!!}@endif</textarea>
                            </div>

                            <hr>

                            @if (!empty($pmail->id))
                            <input type="button" value="Update" class="btn btn-primary updateBtn">
                            @else
                            <input type="button" value="Create" class="btn btn-primary addBtn">
                            @endif


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


{{-- form end --}}

    </main>
    <script src="//cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
    <script>
    // CKEDITOR.replace( 'body' );
    </script>


@endsection
@section('script')
    <script>
        $(document).ready(function () {

            //header for csrf-token is must in laravel
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
            //

            var url = "{{URL::to('/admin/mail-participate')}}";
             //console.log(url);

             $(".addBtn").click(function(){
            //   alert("btn work");
                for ( instance in CKEDITOR.instances ) {
                        CKEDITOR.instances[instance].updateElement();
                    }  
                var form_data = new FormData();
                form_data.append("subject", $("#subject").val());
                form_data.append("body", $("#body").val());

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
                        success("Mail Create Successfully!!");
                        window.setTimeout(function(){location.reload()},2000)
                      }
                  },
                  error: function (d) {
                      console.log(d);
                  }
                });
              });

              // company details update;
            $(".updateBtn").click(function(){
                // alert('update btn work');
                for ( instance in CKEDITOR.instances ) {
                CKEDITOR.instances[instance].updateElement();
                } 
                var form_data = new FormData();
                form_data.append("subject", $("#subject").val());
                form_data.append("body", $("#body").val());
                form_data.append('_method', 'put');

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
                            success("Mail Update Successfully!!");
                            pagetop();
                            window.setTimeout(function(){location.reload()},2000)
                        }
                    },
                    error:function(d){
                        console.log(d);
                    }
                });
            });
                //Update end
        });
    </script>
    {{-- logo  --}}

    <script type="text/javascript">
        $(document).ready(function() {
             $("#company").addClass('active');
        });
    </script>
@endsection

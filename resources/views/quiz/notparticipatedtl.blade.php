@extends('layouts.admin')

@section('content')
<main class="app-content">
    <div class="app-title">
      <div>
        <h1><i class="fa fa-th-list"></i> Quiz Details</h1>
      </div>
      <ul class="app-breadcrumb breadcrumb side">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Tables</li>
        <li class="breadcrumb-item active"><a href="#">Data Table</a></li>
      </ul>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <div class="tile-body">
              <div class="ermsg"></div>
              <div class="float-right">
                <a qid="{{$qid}}" id="allmail" class="btn btn-sm btn-success">Send Email All Perticipent</a>
            </div>
            <br><br>
            <div class="table-responsive">
              <table class="table table-hover table-bordered" id="example">
                <thead>
                  <tr>
                    <th>username</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Count</th>
                    <th>Last Send Date</th>
                    <th>Send</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($users as $item)
                    <tr>
                      <td>{{$item->username}}</td>
                      <td>{{$item->mobile }}</td>
                      <td>{{$item->email}}</td>
                      @php
                        $emailsend = \App\Models\QuiznotTaken::where('quiz_id', '=', $qid)->where('user_id', '=', $item->id)->first();
                      @endphp

                      @if (!empty($emailsend))                            
                        <td>{{$emailsend->mail_count}}</td>
                        <td>{{$emailsend->mail_send_date}}</td>
                      @else                      
                      <td></td>
                      <td></td>                          
                      @endif

                      @if (!empty($emailsend))  
                      <td>                        
                        <a href="" id="sentmail{{$item->id}}" class="btn btn-success submitBtn" qid="{{$qid}}" uid="{{$item->id}}"> 
                          @if($emailsend->mail_count==NULL) 
                          Send Mail 
                          @else
                          Send again
                          @endif
                        </a>
                      </td>  
                      @else   
                      <td>                  
                        <a href="" id="sentmail{{$item->id}}" class="btn btn-success submitBtn" qid="{{$qid}}" uid="{{$item->id}}"> 
                        Send Mail 
                        </a> 
                      </td>                         
                      @endif
                      
                      
                    </tr>
                  @endforeach
                  
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection
@section('script')
 <!-- Data table plugin-->
 {{-- <script type="text/javascript" src="{{asset('js/plugins/jquery.dataTables.min.js')}}"></script>
 <script type="text/javascript" src="{{asset('js/plugins/dataTables.bootstrap.min.js')}}"></script>
 <script type="text/javascript">$('#sampleTable').DataTable();</script> --}}

 <script>
        $(document).ready(function () {
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

            var url = "{{URL::to('/admin/npemail-send')}}";

          // single mail send
            $("body").delegate(".submitBtn","click",function(event){
		        event.preventDefault();
                qid = $(this).attr('qid');
                uid = $(this).attr('uid');
                $.ajax({
                    url:url,
                    method: "POST",
                    data:{
                        qid:qid,uid:uid,
                    },
                  success: function (d) {
                    console.log(d.message);
                      if (d.status == 303) {
                          $(".ermsg").html(d.message);
                      }else if(d.status == 300){
                        success("Mail send Successfully!!");
                        $("#sentmail" + uid + "" ).val("Send again"); 
                      }
                  },
                  error: function (d) {
                      console.log(d);
                  }
                });
              });

              // all mail send 
            $("body").delegate("#allmail","click",function(event){
		         event.preventDefault();
                qid = $(this).attr('qid');
                var url2 = "{{URL::to('/admin/npemail-allsend')}}";
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





        });
  </script>



  <script type="text/javascript">
    $(document).ready(function() {
            $("#quizmaildesc").addClass('active');
            $("#quizmaildesc").addClass('is-expanded');
            $("#notparticipate").addClass('active');
        });
</script>
@endsection

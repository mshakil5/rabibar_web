@extends('frontend.layouts.index') 
@section('title-meta')
    <title>Welcome to Rabibar - Quiz </title>
@endsection

@section('content')

@component('frontend.inc.quizbtn') @endcomponent
    <section class="myFirebidder">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>My Informartion</h2>
                    <hr>
                </div>
                <div class="col-lg-3">
                    @component('frontend.inc.leftbar') @endcomponent
                </div>
                <div class="col-lg-9 p-0">

                  

                    <div class="userDetailsArea">
                        
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="ermsg">
                                    </div>
                                    <div class="container">
                                        <form method="post">
                                            @csrf

                                            <div>
                                                <label for="old_password">Current Password</label>
                                                <input type="password" id="old_password" name="old_password" class="form-control">
                                                <input type="hidden" name="profileid" id="profileid" value="{{Auth::user()->id}}">
                                            </div>
                                            <div>
                                                <label for="new_password">New Password</label>
                                                <input type="password" id="new_password" name="new_password" class="form-control">
                                            </div>
                                            <div>
                                                <label for="password_confirmation">Confirm Password</label>
                                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                                            </div>

        
                                            <hr>
                                            <input type="button" id="pwdBtn" value="Update" class="float-left text-left related-quiz text-white pwdBtn">
                                            

                                        </form>
    
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                    </div>




                </div>
            </div>
        </div>
        </div>
    </section>

@endsection

@section('script')

<script>
    $(document).ready(function(){
        //header for csrf-token is must in laravel
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
        //
        var url = "{{URL::to('/user/changepassword')}}";
        //console.log(url);
        $(".pwdBtn").click(function(){
            //  alert('btn work');
            var password= $("#new_password").val();
            var confirmpassword= $("#password_confirmation").val();
            var opassword= $("#old_password").val();
            var profileid= $("#profileid").val();
  
            // console.log(name +','+ email +','+ mobile+','+ address+','+ city+','+ postal_code+','+ profileid);
  
            $.ajax({
                    url:url,
                    method: "POST",
                    data:{
                        password:password,confirmpassword:confirmpassword,opassword:opassword
                    },
                    success: function(d){
                        if (d.status == 303) {
                            $(".ermsg").html(d.message);
                        }else if(d.status == 300){
                            $(".ermsg").html(d.message);
                                //   success("Data Updated Successfully!!");
                            window.setTimeout(function(){location.reload()},2000)
                        }
                    },
                    error:function(d){
                        console.log(d);
                    }
                });
        });
  

  
    });
  </script>
    
@endsection

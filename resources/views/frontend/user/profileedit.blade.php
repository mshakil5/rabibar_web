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

                                            <div class="form-group row">
                                                <label for="name" class="col-sm-2 col-form-label">Name<span class="text-danger">*</span></label>
                                                <div class="col-sm-10">
                                                    <input type="text" id="name" name="name" value="{{Auth::user()->name}}" class="form-control">
                                                    <input type="hidden" name="profileid" id="profileid" value="{{Auth::user()->id}}">
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label for="email" class="col-sm-2 col-form-label">Email<span class="text-danger">*</span></label>
                                                <div class="col-sm-10">
                                                    <input type="email" id="email" name="email" value="{{Auth::user()->email}}" class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="mobile" class="col-sm-2 col-form-label">Phone<span class="text-danger">*</span></label>
                                                <div class="col-sm-10">
                                                    <input type="number" id="mobile" name="mobile" readonly value="{{Auth::user()->mobile}}" class="form-control">
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label for="address" class="col-sm-2 col-form-label">Address<span class="text-danger">*</span></label>
                                                <div class="col-sm-10">
                                                    <input type="text" id="address" name="address" value="{{Auth::user()->address}}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="postal_code" class="col-sm-2 col-form-label">Post Code<span class="text-danger">*</span></label>
                                                <div class="col-sm-10">
                                                    <input type="number" id="postal_code" name="postal_code" value="{{Auth::user()->postal_code}}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="city" class="col-sm-2 col-form-label">City<span class="text-danger">*</span></label>
                                                <div class="col-sm-10">
                                                    <input type="text" id="city" name="city"  value="{{Auth::user()->city}}" class="form-control">
                                                </div>
                                            </div>
        
                                            <hr>
                                            <input type="button" id="updateBtn" value="Update" class="float-left text-left related-quiz text-white updateBtn">
                                            



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
        var url = "{{URL::to('/user/profile')}}";
        //console.log(url);
        $(".updateBtn").click(function(){
            //  alert('btn work');
            var name= $("#name").val();
            var email= $("#email").val();
            var city= $("#city").val();
            var postal_code= $("#postal_code").val();
            var address= $("#address").val();
            var profileid= $("#profileid").val();
  
            // console.log(name +','+ email +','+ mobile+','+ address+','+ city+','+ postal_code+','+ profileid);
  
            $.ajax({
                    url:url+'/'+$("#profileid").val(),
                    method: "POST",
                    data:{
                        profileid:profileid,name:name,email:email,city:city,postal_code:postal_code,address:address
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

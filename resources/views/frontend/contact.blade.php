@extends('frontend.layouts.index') 
@section('content')


<div class="container-fluid"> 

    <div class="row bg-white customControl">
        <div class="col-md-2 px-3 text-center mt-3">
            @foreach (App\Models\Advertisement::where('position', '=', 'Left')->orderBy('serial', 'DESC')->limit(4)->get() as $advr)

            <img class="img-fluid mb-2 img-thumbnail" src="{{asset('advimage/'.$advr->image)}}" alt=""> 
        
        @endforeach
        </div>
        <div class="col-md-8 p-0 border-left border-right  ">  
                
            

            {{-- new code  --}}




                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-6 text-center mb-5">
                            <h2 class="heading-section">Contact Us</h2>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-12 col-md-12">
                            <div class="wrapper">
                                <div class="row no-gutters">
                                    <div class="col-md-7 d-flex align-items-stretch">
                                        <div class="contact-wrap w-100 p-md-5 p-4">
                                            <h3 class="mb-4">Get in touch</h3>
                                            <div id="form-message-warning" class="mb-4"></div> 
                                      <div id="form-message-success" class="mb-4">
                                    {{-- Your message was sent, thank you! --}}
                                    <div id="ermsg" class="ermsg"></div>
                                      </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6"> 
                                                        <div class="form-group">
                                                            <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <textarea name="message" class="form-control" id="message" cols="30" rows="7" placeholder="Message"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <input type="submit" value="Send Message" id="contactBtn" class="btn btn-custom related-quiz text-white">
                                                            {{-- <div class="submitting"></div> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5 d-flex align-items-stretch ">
                                        <div class="info-wrap w-100 p-lg-5 p-4" style="background-color: #fc3879">
                                            <h3 class="mb-4 mt-md-4">Contact us</h3>
                                            <div class="dbox w-100 d-flex align-items-start">
                                                <div class="icon d-flex align-items-center justify-content-center">
                                                    <span class="fa fa-map-marker"></span>
                                                </div>
                                                <div class="text pl-3">
                                                    <p><span>Address:</span> 198 Kazipara,Dhaka, Bangladesh</p>
                                                </div>
                                            </div>
                                            <div class="dbox w-100 d-flex align-items-center">
                                                <div class="icon d-flex align-items-center justify-content-center">
                                                    <span class="fa fa-phone"></span>
                                                </div>
                                                <div class="text pl-3">
                                                    <p><span>Phone:</span> <a href="{{\App\Models\CompanyDetail::first()->phone1}}" style="text-decoration: none; color: black">{{\App\Models\CompanyDetail::first()->phone1}}</a><br><a href="{{\App\Models\CompanyDetail::first()->phone2}}" style="text-decoration: none; color: black">{{\App\Models\CompanyDetail::first()->phone2}}</a></p>
                                                </div>
                                            </div>
                                            <div class="dbox w-100 d-flex align-items-center">
                                                <div class="icon d-flex align-items-center justify-content-center">
                                                    <span class="fa fa-paper-plane"></span>
                                                </div>
                                                <div class="text pl-3">
                                                    <p><span>Email:</span> <a href="mailto:{{\App\Models\CompanyDetail::first()->email1}}" style="text-decoration: none; color: black">{{\App\Models\CompanyDetail::first()->email1}}</a></p>
                                                </div>
                                            </div>
                                            <div class="dbox w-100 d-flex align-items-center">
                                                <div class="icon d-flex align-items-center justify-content-center">
                                                    <span class="fa fa-globe"></span>
                                                </div>
                                                <div class="text pl-3">
                                                    <p><span>Website</span> <a href="www.rabibar.com" style="text-decoration: none; color: black">rabibar.com</a></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>





            {{-- new code  --}}


        </div>

        <div class="col-md-2 px-3 text-center">
                        
            @foreach (App\Models\Advertisement::where('position', '=', 'Right')->orderBy('serial', 'DESC')->limit(4)->get() as $advr)

            <img class="img-fluid mb-2 img-thumbnail" src="{{asset('advimage/'.$advr->image)}}" alt=""> 

            @endforeach
        </div>
    </div>
</div>


















{{-- <section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <h2 class="heading-section">Contact Us</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-12">
                <div class="wrapper">
                    <div class="row no-gutters">
                        <div class="col-md-7 d-flex align-items-stretch">
                            <div class="contact-wrap w-100 p-md-5 p-4">
                                <h3 class="mb-4">Get in touch</h3>
                                <div id="form-message-warning" class="mb-4"></div> 
                          <div id="form-message-success" class="mb-4">
                        <div id="ermsg" class="ermsg"></div>
                          </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                                            </div>
                                        </div>
                                        <div class="col-md-6"> 
                                            <div class="form-group">
                                                <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <textarea name="message" class="form-control" id="message" cols="30" rows="7" placeholder="Message"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="submit" value="Send Message" id="contactBtn" class="btn btn-custom related-quiz text-white">
                                              
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="col-md-5 d-flex align-items-stretch ">
                            <div class="info-wrap w-100 p-lg-5 p-4" style="background-color: #fc3879">
                                <h3 class="mb-4 mt-md-4">Contact us</h3>
                                <div class="dbox w-100 d-flex align-items-start">
                                    <div class="icon d-flex align-items-center justify-content-center">
                                        <span class="fa fa-map-marker"></span>
                                    </div>
                                    <div class="text pl-3">
                                        <p><span>Address:</span> 198 Kazipara,Dhaka, Bangladesh</p>
                                    </div>
                                </div>
                                <div class="dbox w-100 d-flex align-items-center">
                                    <div class="icon d-flex align-items-center justify-content-center">
                                        <span class="fa fa-phone"></span>
                                    </div>
                                    <div class="text pl-3">
                                        <p><span>Phone:</span> <a href="tel://1234567920" style="text-decoration: none; color: black">+ 01726004037</a></p>
                                    </div>
                                </div>
                                <div class="dbox w-100 d-flex align-items-center">
                                    <div class="icon d-flex align-items-center justify-content-center">
                                        <span class="fa fa-paper-plane"></span>
                                    </div>
                                    <div class="text pl-3">
                                        <p><span>Email:</span> <a href="mailto:info@rabibar.com" style="text-decoration: none; color: black">info@rabibar.com</a></p>
                                    </div>
                                </div>
                                <div class="dbox w-100 d-flex align-items-center">
                                    <div class="icon d-flex align-items-center justify-content-center">
                                        <span class="fa fa-globe"></span>
                                    </div>
                                    <div class="text pl-3">
                                        <p><span>Website</span> <a href="www.rabibar.com" style="text-decoration: none; color: black">rabibar.com</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}


@endsection

@section('script')

<script>
    $(document).ready(function () {

        //header for csrf-token is must in laravel
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
        //

        var url = "{{URL::to('/contact')}}";
        // console.log(url);

        $("#contactBtn").click(function(){
            //   alert('btn work');
             var form_data = new FormData();
                  
            form_data.append("name", $("#name").val());
            form_data.append("email", $("#email").val());
            form_data.append("subject", $("#subject").val());
            form_data.append("message", $("#message").val());
            

            // var bcmntid= $("#bcmntid").val();
            // var comment= $("#comment").val();
            // console.log(bcmntid, comment  );

            $.ajax({
                url:url,
                type: "POST",
                contentType: false,
                processData: false,
                data:form_data,
                success: function(d){
                    console.log(d);
                    if (d.status == 303) {
                        $(".ermsg").html(d.message);
                    }else if(d.status == 300){
                        $(".ermsg").html(d.message);
                        // success("Message Send Successfully!!");
                        window.setTimeout(function(){location.reload()},2000)
                    }
                },
                error:function(d){
                    console.log(d);
                    $(".ermsg").html(d.message);
                }
            });
        });

        


     

    });
</script>


@endsection


@extends('frontend.layouts.index')
@section('content')

<div class="container-fluid">
    <div class="row bg-white customControl">
        <div class="col-md-8 mx-auto p-0 border-left border-right">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6 text-center mt-3">
                        <h2 class="heading-section">Make Your Post</h2>
                    </div>
                </div>
                <hr>
                <div class="row justify-content-center">
                    <div class="col-lg-12 col-md-12">
                        <div class="wrapper">
                            <div class="row no-gutters">
                                <div class="col-md-12 d-flex align-items-stretch">
                                    <div class="contact-wrap w-100 p-md-5 p-4">
                                        <p id="text-danger" class="mb-4 text-danger"></p>
                                        <p id="text-success" class="mb-4 text-success"></p>
                                        <div class="row">

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="name">Name <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="name" id="name" placeholder="Name*" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email">Email <span class="text-danger">*</span></label>
                                                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="phone">Phone <span class="text-danger">*</span></label>
                                                    <input type="number" class="form-control" name="phone" id="phone" placeholder="Phone" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="address">Address <span class="text-danger">*</span></label>
                                                    <textarea name="address" class="form-control" id="address" rows="4" placeholder="Address" required></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="message">Message To Admin <span class="text-danger">*</span></label>
                                                    <textarea name="message" class="form-control" id="message" rows="4" placeholder="Message To Admin" required></textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="category">Category <span class="text-danger">*</span></label>
                                                    <select name="category" class="form-control" id="category" required>
                                                        <option value="">Select Category</option>
                                                        @foreach ($categories as $item)
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="title">Title <span class="text-danger">*</span></label>
                                                    <input type="text" id="title" name="title" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="image">Image <span class="text-danger">*</span></label>
                                                    <input class="form-control" id="image" name="image" type="file" accept="image/*" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="source">Source <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text" name="source" id="source" placeholder="Enter source" required>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="details">Description <span class="text-danger">*</span></label>
                                                    <textarea class="form-control" id="details" name="details" required></textarea>
                                                </div>
                                            </div>               
                                            <div class="col-md-12 text-center">
                                                <div class="form-group">
                                                    <input type="submit" value="Submit" id="submitBtn" class="btn btn-custom related-quiz text-white" style="width: auto;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

<script>
    $(document).ready(function() {
        $("#details").addClass("ckeditor");
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].updateElement();
        } 
        CKEDITOR.replace('details');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var url = "{{ URL::to('/make-a-blog') }}";

        $("#submitBtn").click(function(e) {
            e.preventDefault();

            $(".validation-message").remove();

            let isValid = true;

            $("input[required], textarea[required], select[required]").each(function() {
                if ($(this).val() === "") {
                    isValid = false;
                    $(this).after('<span class="validation-message text-danger">This field is required.</span>');
                }
            });

            if (isValid) {
                var form_data = new FormData();

                form_data.append("name", $("#name").val());
                form_data.append("email", $("#email").val());
                form_data.append("phone", $("#phone").val());
                form_data.append("address", $("#address").val());
                form_data.append("message", $("#message").val());
                form_data.append("category", $("#category").val());
                form_data.append("title", $("#title").val());
                form_data.append("image", $("#image")[0].files[0]);
                form_data.append("source", $("#source").val());
                form_data.append("details", CKEDITOR.instances.details.getData());

                $.ajax({
                    url: url,
                    type: "POST",
                    contentType: false,
                    processData: false,
                    data: form_data,
                    success: function(d) {
                        if (d.status == 200) {
                            $("#text-danger").hide();
                            $("#text-success").html(d.message);
                            window.scrollTo(0, 0);
                            window.setTimeout(function() {
                                location.reload();
                            }, 2000);
                        }
                    },
                    error: function(xhr , status, error) {
                        error = JSON.parse(xhr.responseText);
                        window.scrollTo(0, 0);
                        $("#text-danger").html(error.message);
                    }
                });
            }
        });
    });
</script>

@endsection
@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card m-b-20">
            <div class="card-body">

                <form class="register" method="POST" enctype="multipart/form-data" id="add_registation_form">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="first_name">First Name</label>
                            <!-- <input type="hidden" id="id" name="id"> -->
                            <input type="text" class="form-control" id="fname" name="fname" placeholder="Enter first name..." maxlength="20" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==15)" required>
                            <span class="error-msg-input text-danger"></span>
                            <!-- <span class="alert alert-danger"></span> -->
                        </div>
                        <div class="form-group col-md-6">
                            <label for="last_name">Last Name</label>
                            <input type="text" name="lname" class="form-control" id="lname" placeholder="Enter last name..." maxlength="20" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==15)" required>
                            <span class="error-msg-input text-danger"></span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label>Gender :-</label>
                        </div>
                        <div class="col-4">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="male" value="Male" required>
                                <label class="form-check-label" for="male">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="female" value="Female">
                                <label class="form-check-label" for="female">Female</label>
                            </div>
                        </div>
                        <!-- <div class="form-row"> -->
                        <div class="form-group col-md-6">
                            <label for="dob">BirthDate</label>
                            <input type="text" name="dob" id="datepicker" class="form-control" placeholder="Enter Employee dob.." required />
                            <span class="error-msg-input text-danger"></span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="text" name="email" class="form-control" id="email" placeholder="Enter email..." required>
                            <span id="error_email"></span>

                        </div>
                        <div class="form-group col-md-6">
                            <label for="mobile">Phone</label>
                            <input type="number" name="mobile" id="mobile" class="form-control" placeholder="Enter phone number..." maxlength="15" required>
                            <span id="error_mobile"></span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="enter confirm password..." autocomplete="new-password" maxlength="15" required>
                            <input type="checkbox" name='password' id="check" placeholder="enter password..." class='' />Show Password</td>
                            <span class="error-msg-input text-danger"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="confirm_password">Confrim Password</label>
                            <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="enter confirm password..." autocomplete="new-password" maxlength="15" required>
                            <input type="checkbox" name='confirm_password' id="checkk" placeholder="enter confirm password..." class='' />Show confirm password</td>
                            <span class="error-msg-input text-danger"></span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="country">Country</label>
                            <select class="form-control" id="country-dropdown" name="country" required>
                                <option value="">Select Country</option>
                                @foreach ($countries as $country)
                                <option value="{{$country->id}}">
                                    {{$country->country_name}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="state">State</label>
                            <select class="form-control" id="state-dropdown" name="state" required>
                                <option value="">Select country first</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="city">City</label>
                            <select class="form-control" id="city-dropdown" name="city" required>
                                <option value="">Select state first</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="image">Image</label>
                            <input type="file" id="image" name="image" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                Submit
                            </button>


                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


@push('page_scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">

<script>
    $(document).ready(function() {

        $('#email').blur(function() {
            var error_email = '';
            var email = $('#email').val();
            var _token = $('input[name = "_token"]').val();
            var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!filter.test(email)) {
                $('#error').addClass('has-error');
                $('#error_email').html('<label class = "text-danger">Invaild Email</label>');
                $('.register').attr('disabled', 'disabled');
            } else {
                $.ajax({
                    url: '{{ route("admin.user.check") }}',
                    method: "POST",
                    data: {
                        email: email,
                        _token: _token
                    },
                    success: function(result) {
                        if (result != 'Not_Unique') {
                            $('#error_email').html('<label class = "text-success">Email Available</label>');
                            $('#email').removeClass('has-error');
                            $('.register').attr('disabled', false);
                        } else if (result != 'Unique') {
                            $('#error_email').html('<label class = "text-danger">Email is already exits.</label>');
                            $('#email').addClass('has-error');
                            $('.register').attr('disabled', false);
                        }
                    }

                })
            }
        });
    });

    $(document).ready(function() {

        $('#mobile').blur(function() {
            var error_phone = '';
            var mobile = $('#mobile').val();
            var _token = $('input[name = "_token"]').val();
            var filter = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;
            if (!filter.test(mobile)) {
                $('#error').addClass('has-error');
                $('#error_mobile').html('<label class = "text-danger">Invaild Mobile Number</label>');
                $('.register').attr('disabled', 'disabled');
            } else {
                $.ajax({
                    url: '{{ route("admin.user.checkk") }}',
                    method: "POST",
                    data: {
                        mobile: mobile,
                        _token: _token
                    },
                    success: function(result) {
                        if (result != 'Not_Unique') {
                            $('#error_mobile').html('<label class = "text-success">Phone Mobile Available</label>');
                            $('#mobile').removeClass('has-error');
                            $('.register').attr('disabled', false);
                        } else if (result != 'Unique') {
                            $('#error_mobile').html('<label class = "text-danger">Mobile Number is already exits.</label>');
                            $('#mobile').addClass('has-error');
                            $('.register').attr('disabled', false);
                        }
                    }

                })
            }
        });
    });


    $(document).ready(function() {
        $('#country-dropdown').on('change', function() {
            var country_id = this.value;
            $("#state-dropdown").html('');
            $.ajax({
                url: "{{ route('admin.user.get-states-by-country')}}",
                type: "POST",
                data: {
                    country_id: country_id,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function(result) {
                    $.each(result.state, function(key, value) {
                        $("#state-dropdown").append('<option value="' + value.id + '">' + value.state_name + '</option>');
                    });
                    $('#city-dropdown').html('<option value="">Select State First</option>');
                }
            });
        });

        $('#state-dropdown').on('change', function() {
            var state_id = this.value;
            $("#city-dropdown").html('');
            $.ajax({
                url: "{{route('admin.user.get-cities-by-state')}}",
                type: "POST",
                data: {
                    state_id: state_id,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function(result) {
                    $.each(result.cities, function(key, value) {
                        $("#city-dropdown").append('<option value="' + value.id + '">' + value.city_name + '</option>');
                    });
                }
            });
        });
    });

    $("#datepicker ").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true,
        minDate: new Date(1999, 10 - 1, 25),
        yearRange: '1999:c',
    });


    $('#check').click(function() {
        if (document.getElementById('check').checked) {
            $('#password').get(0).type = 'text';
        } else {
            $('#password').get(0).type = 'password';
        }
    });

    $('#checkk').click(function() {
        if (document.getElementById('checkk').checked) {
            $('#confirm_password').get(0).type = 'text';
        } else {
            $('#confirm_password').get(0).type = 'password';
        }
    });

    $('#register_add_modal').on('show.bs.modal', function(e) {
        var button = $(e.relatedTarget)
        var category_id = button.data('id');
        $(this).find("input").val('');
        $('.error-msg-input').text('');
        $('.invalid-feedback').text('');

        $('#category_id').val(category_id);
    });

    function addCategory(form) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            url: '{{ route("admin.user.create") }}',
            type: 'post',
            processData: false,
            contentType: false,
            data: new FormData(form),
            success: function(result) {
                if (result) {
                    $html = '<div class="alert alert-block alert-' + result.status + '"><button type="button" class="close" data-dismiss="alert">×</button><strong>' + result.message + '</strong></div>';

                    $('.ajax-msg').append($html);
                    if (result.status == "success") {
                        alert("register added seccessfully")
                        window.location.href = "../user/list"

                    }
                }

            },
            complete: function() {
                window.setTimeout(function() {
                    $(".alert").fadeTo(500, 0).slideUp(500, function() {
                        $(this).remove();
                    });
                }, 3000);
            },
            error: function(data) {
                if (data.status === 422) {
                    var errors = $.parseJSON(data.responseText);
                    $.each(errors.errors, function(key, value) {
                        $('#add_registation_form').find('input[name=' + key + ']').parents('.form-group')
                            .find('.error-msg-input').html(value);
                    });
                }
            }
        });
    }

    $('#add_registation_form').validate({
        errorClass: 'invalid-feedback animated fadeInDown',
        errorElement: 'div',
        rules: {
            fname: {
                required: true,
            },
            lname: {
                required: true,
            },
            gender: {
                required: true,
            },
            dob: {
                required: true,
                date: true,
            },
            email: {
                required: true,
                email: true,
            },
            mobile: {
                required: true,
                minlength: 10,
                maxlength: 10,
            },
            password: {
                required: true,
                minlength: 6,
            },
            confirm_password: {
                required: true,
                minlength: 6,
            },
            name: {
                required: true,
            },
            image: {
                required: true,
            },
            country: {
                required: true,
            },
            state: {
                required: true,
            },
            city: {
                required: true,
            }
        },
        messages: {
            fname: {
                required: "The first name field is required.",
            },
            lname: {
                required: "The last name field is required.",
            },
            gender: {
                required: "The gender field is required.",
            },
            dob: {
                required: "The birth date field is required.",
            },
            email: {
                required: "The email field is required.",
                email: "The email field is invalid.",
            },
            mobile: {
                required: "The phone field is required.",
            },
            password: {
                required: "The password field is required.",
                minlength: "Please enter atleast 6 character.",
            },
            confirm_password: {
                required: "The confirm password field is required.",
                minlength: "Please enter atleast 6 character."
            },
            name: {
                required: "The hobbies field is required.",
            },
            image: {
                required: "The image field is required.",
            },
            country: {
                required: "The country field is required.",
            },
            state: {
                required: "The state field is required.",
            },
            city: {
                required: "The city field is required.",
            }
        },
        submitHandler: function(form) {
            addCategory(form);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
            $(element).parents("div.form-control").addClass(errorClass).removeClass(validClass);
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
            $(element).parents(".error").removeClass(errorClass).addClass(validClass);
        }
    });
</script>

@endpush
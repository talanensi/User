@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card m-b-30">

            <div class="card-body">

                <!-- ajax form response -->
                <div class="ajax-msg"></div>

            <form class=""  method="POST" enctype="multipart/form-data" id="view_registation_form">
                @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="first_name">First Name</label>
                                    <input type="text" class="form-control" id="fname" value="{{$view['fname']}}" name ="fname" placeholder="Enter first name..." required maxlength="20" readonly>
                                    <!-- <span class="alert alert-danger"></span> -->
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="last_name">Last Name</label>
                                    <input type="text"  name="lname" class="form-control" id="lname" value="{{$view['lname']}}" placeholder="Enter last name..." required maxlength="20" readonly>
                                </div>
                            </div>
                            <div class="form-row">
                            <div class="form-group col-md-2">
                                    <label>Gender :-</label>
                                </div>
                                <div class="col-4">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="male" value="male" readonly {{$view->gender=='male' ?'checked':''}} >
                                        <label class="form-check-label" for="male">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="female" value="female" readonly {{$view->gender=='female' ?'checked':''}} checked>
                                        <label class="form-check-label" for="female">Female</label>
                                    </div>
                                </div>
                                <!-- <div class="form-row"> -->
                                <div class="form-group col-md-6">
                                    <label for="dob">BirthDate</label>
                                    <input type="text" name="dob" id="datepicker" class="form-control" value="{{$view['dob']}}" placeholder="Enter dob.." readonly >
                                    <span class="error-msg-input text-danger"></span>
                                </div>
                            </div>
                            <div class="form-row">
                            <div class="form-group col-md-6">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" id="email" value="{{$view['email']}}" placeholder="Enter email..." autocomplete="off" required readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="mobile">Phone</label>
                                    <input type="number" name="mobile" class="form-control" id="mobile" value="{{$view['mobile']}}" placeholder="Enter phone number..."  required maxlength="15" readonly>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="country">Country</label>
                                    <input type="text" name="country" class="form-control" id="country" value="{{$view->Country_data['country_name']}}" readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="state">State</label>
                                    <input type="text" name="state" class="form-control" id="state" value="{{$view->State_data['state_name']}}" readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="city">City</label>
                                    <input type="text" name="city" class="form-control" id="city" value="{{$view->City_data['city_name']}}"  readonly>
                                </div>
                            </div> 
                                <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="image">Image</label><br>
                                    <img src="{{ $view->image }}" width="300px">
                                </div>
                            </div>
                        
                        <div class="form-group">
                        <div>
                        <a href="{{route('admin.user.list')}}" type="back" class="btn btn-dark waves-effect waves-light" >
                                Back
                        </a>
                        </div> 
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
<link rel="stylesheet" href="/resources/demos/style.css">

<script>

    $( "#datepicker " ).datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true,
        minDate: new Date(2021, 10 + 1, 25),
        yearRange: '1999:c',
    });

    $('#check').click(function(){
    if(document.getElementById('check').checked) {
    $('#password').get(0).type = 'text';
    } else {
        $('#password').get(0).type = 'password';
    }
});
</script>
@endpush 
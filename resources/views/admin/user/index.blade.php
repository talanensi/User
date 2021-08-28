@extends('layouts.master')
    
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card m-b-30">
            <div class="card-header">
            <div class="card-header-actions">
            
                <a href="{{route('admin.user.add')}}" class="btn btn-info float-right" title="Add ">Add </a>

                <a href="{{route('admin.logout')}}" class="btn btn-primary float-left" title="Logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout </a>
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                        @csrf
                </form>
            </div>
            </div>
            <div class="card-body">
                <!-- ajax form response -->

                <div class="ajax-msg"></div>
                <div class="table-responsive">
                {!! $dataTable->table(['class' =>  'table table-bordered dt-responsive nowrap']) !!}
            </div>
            </div>
        </div>

    </div>
</div>

@endsection

@push('page_scripts')

    {!! $dataTable->scripts() !!}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    <script>

    $(document).on('click', '.changeStatus', function() {
        var this_var = this;
        $(this).attr('disabled', true);
        var category_id = $(this).attr('category_id');
        var status = $(this).attr('status');
        var msg = "";

        if(status == 1) {
            msg = "Inactive";
        } else {
            msg = "Active";
        }

        swal({
            title: 'Are you sure want to '+msg+'?',
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, '+msg+' it!',
            reverseButtons: true
            }).then((result) => {
                if (result) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url : "{{ route('admin.user.change_status') }}",
                        type : 'PATCH',
                        data : {'status' : status, 'id' : category_id},
                        success : function (res) {

                            swal(
                                res.action, //get from controller (block/unblock/cancel)
                                res.msg, // get from controller
                                res.status // get from controller (success/error)
                            )

                            window.LaravelDataTables["user-table"].draw();
                        }
                    });
                } else {
                    swal("Cancelled", "Status not changed :)", "error");
                    $(this).attr('disabled', false);
                }
        }).catch((error) => {
            $('.changeStatus').attr('disabled', false);
        });

    });

    $(document).on('click', '#cat_delete', function() {
        var id = $(this).attr('category_id');

        swal({
            // title: 'Are you sure?',
            text: "Are you sure want to Delete!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            reverseButtons: true
            }).then((result) => {
                if (result) {
                    $.ajax({
                        type:'POST',
                        url: '{{ route("admin.user.delete") }}',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data : {'id' : id},
                        success:function(data) {
                            if (data) {
                                swal(
                                'Deleted!',
                                'user has been deleted.',
                                'success'
                                )
                                window.LaravelDataTables["user-table"].draw();
                           }
                        }
                    });
                } else {
                    swal("Cancelled", "Your record is safe :)", "error");
                }
            })
    });

    </script>
    @endpush

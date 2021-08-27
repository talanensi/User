@extends('layouts.master')
    
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card m-b-30">
            <div class="card-header">
            <div class="card-header-actions">
            
                <a href="{{route('admin.user.add')}}" class="btn btn-success float-right" title="Add ">Add </a>

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

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script> -->
@endpush
    <script>
// alert(12);

    </script>
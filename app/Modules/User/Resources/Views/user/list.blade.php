@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Quản lý tài khoản
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="#">
                    <i class="fa fa-dashboard"></i>
                    Home
                </a>
            </li>
            <li>
                <a href="#">Forms</a>
            </li>
            <li class="active">General Elements</li>
        </ol>
    </section>
    <section class="content">
        <a href="{{route('user.add')}}" class="btn btn-app">
            <i class="fa fa-edit"></i> THÊM MỚI
        </a>
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Danh sách</h3>
            </div>
            <div class="box-body">
                <table id="tableData" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>TÊN</th>
                        <th>CẤP BẬC</th>
                        <th>LOẠI HÌNH CÔNG VIỆC</th>
                        <th>Email / Phone</th>
                        <th>NGÀY TẠO</th>
                        <th>TRẠNG THÁI</th>
                        <th></th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </section>

@endsection
@push('stylesheet')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="./public/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="./public/bower_components/bootstrap-daterangepicker/daterangepicker.css">
@endpush

@push('scripts')
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <!-- daterangepicker -->
    <script src="./public/bower_components/moment/min/moment.min.js"></script>
    <script src="./public/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="./public/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <!-- CK Editor -->
    <script src="./public/bower_components/ckeditor/ckeditor.js"></script>

@endpush

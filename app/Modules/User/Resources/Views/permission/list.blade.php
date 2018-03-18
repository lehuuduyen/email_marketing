@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Quản lý nhiệm vụ
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
        <div class="row">
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Thêm Nhiệm vụ Mới</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form id="addForm" method="post">
                        <div class="box-body">
                            <div class="form-group">
                                <label>Nhiệm vụ chính</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                            <div class="form-group">
                                <label>Tên hiển thị</label>
                                <input type="text" class="form-control" name="display_name">
                            </div>
                            <div class="form-group">
                                <label>Mô tả</label>
                                <input type="text" class="form-control" name="description">
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="button" id="btn_addForm" class="btn btn-primary">Thêm</button>
                            <button type="button" onclick="formReset(this)" class="btn btn-default pull-right">Làm mới
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Danh sách</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered table-striped"  id="tableData">
                            <thead>
                            <tr>
                                <th width="" style="text-align: center;">Nhiệm vụ</th>
                                <th width="" style="text-align: center;">Tên</th>
                                <th width="" style="text-align: center;">Description</th>
                                <th width="" style="text-align: center;"></th>
                                {{--<th width="" style="text-align: center;">Delete</th>--}}
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@push('stylesheet')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="../public/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../public/bower_components/bootstrap-daterangepicker/daterangepicker.css">
@endpush

@push('scripts')
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <!-- daterangepicker -->
    <script src="../public/bower_components/moment/min/moment.min.js"></script>
    <script src="../public/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="../public/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <!-- CK Editor -->
    <script src="../public/bower_components/ckeditor/ckeditor.js"></script>
    <script>


      
            var $tableData = $('#tableData').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{url('/user/api/permission/anydata')}}',
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'display_name', name: 'display_name' },
                    { data: 'description', name: 'description' },
                    { data: 'action', name: 'action', orderable: false, searchable: false},
//                    { data: 'delete', name: 'delete', orderable: false, searchable: false}
                ]
            });
            {{--//add--}}
            $('#btn_addForm').click(function () {
                urlPermission ='{{route('permission.add')}}';
                var form =$("#addForm");

                $.ajax({
                    url: urlPermission ,
                    type: 'post',
                    data: form.serialize(),
//                beforeSend: function (xhr) {
//                    xhr.setRequestHeader("Authorization", 'Bearer ' + getJwtToken());
//                },
                    success: function (data, textStatus, jQxhr) {
                        console.log(data);
                        console.log(textStatus);
                        console.log(jQxhr);
//                    toastr["success"](textStatus);
//                    form[0].reset();
                    $tableData.ajax.reload();
                    },
                    error: function (jqXhr, textStatus, errorThrown) {
                        console.log(jqXhr);
                        if (jqXhr.status == 422) {
                            $.each(jqXhr.responseJSON.error.errors, function (key, value) {
                                toastr["error"](value);
                            });
                        }
                        if (jqXhr.status == 403) {
                            toastr["error"](jqXhr.responseJSON.error.message);
                        }
                    }
                });

            })

        function setDelete(id) {

            $.ajax({
                url: 'api/permission/delete/'+id ,
                type: 'delete',
//                beforeSend: function (xhr) {
//                    xhr.setRequestHeader("Authorization", 'Bearer ' + getJwtToken());
//                },
                success: function (data, textStatus, jQxhr) {
                    console.log(data);
                    console.log(textStatus);
                    console.log(jQxhr);
//                    toastr["success"](textStatus);
//                    form[0].reset();
                    $tableData.ajax.reload();
                },
                error: function (jqXhr, textStatus, errorThrown) {
                    console.log(jqXhr);
                    if (jqXhr.status == 422) {
                        $.each(jqXhr.responseJSON.error.errors, function (key, value) {
                            toastr["error"](value);
                        });
                    }
                    if (jqXhr.status == 403) {
                        toastr["error"](jqXhr.responseJSON.error.message);
                    }
                }
            });

        }
    </script>

    <script>
    </script>
@endpush

@extends('layouts.app')

@section('content')
    <section class="content-header">
    <h1>
        Nhân viên
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
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        Thêm mới
                    </h3>
                </div>
                <form id="addForm" method="post">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Thông tin cá nhân</label>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Họ tên</label>
                                    <input type="text" name="name" class="form-control" placeholder="Họ và tên">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Giới tính</label>
                                    <select id="gender" name="gender" class="form-control">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-md-offset-4">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="Email">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Số điện thoại</label>
                                    <input type="text" name="phone" class="form-control" placeholder="Số điện thoại">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Thông tin nhân viên</label>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Chức vụ</label>
                                    <select name="role" id="role" class="form-control"  >
                                        <option value=""></option>
                                        @foreach($roles as $key => $role)
                                            <option value="{{ $key }}">{{ $role }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group permiss">
                                    <label>Quyền</label>
                                    <select id="permission"  class="form-control" multiple disabled="" >
                                    </select>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary pull-right">Thêm mới</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modal Header</h4>
                </div>
                <div class="modal-body">
                    <p>Some text in the modal.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
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
        $('#role').select2({  placeholder : 'Please select user'});
        $('#permission').select2({
            placeholder : 'Please select user',
            tags: true
        });

        $('#role').change(function () {
        html='';
        id=$(this).val();
        $.ajax({
            url: 'api/permission/getall_byrole/'+id ,
            type: 'get',
            success: function (data, textStatus, jQxhr) {
                $.each(data,function (index,value) {
                    html+='<li class="select2-selection__choice" title="add">'+value+' </li>'
                })
            $(".permiss .select2-selection__rendered").html(html);

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



    </script>
@endpush
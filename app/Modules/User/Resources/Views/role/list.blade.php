@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Phân quyền chức vụ
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
                        <h3 class="box-title">Tạo Tài Khoản Mới</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form id="addForm" method="post">
                        <div class="box-body">
                            <div class="form-group">
                                <label>Chức vụ</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                            <div class="form-group">
                                <label>Tên hiển thị</label>
                                <input type="hidden"  id="id">
                                <input type="text" class="form-control" name="display_name">
                            </div>
                            <div class="form-group">
                                <label>Mô tả</label>
                                <input type="text" class="form-control" name="description">
                            </div>
                            <div class="form-group">
                                <label>Nhiệm vụ chính</label>
                                <select name="permission[]" id="specialists" class="form-control" multiple="multiple" >
                                    @foreach($permissions as $key => $permission)
                                        <option value="{{ $key }}">{{ $permission }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="button" class="btn btn-primary" id="btn_addForm" >Thêm</button>
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
                                <th width="" style="text-align: center;">Chức vụ</th>
                                <th width="" style="text-align: center;">Tên hiển thị</th>
                                <th width="" style="text-align: center;">Nhiệm vụ</th>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

    <script>
        $('#specialists').select2({
            placeholder : 'Please select user',
            tags: true
        });


        var $tableData = $('#tableData').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{url('/user/api/role/anydata')}}',
            columns: [
                { data: 'name', name: 'name' },
                { data: 'display_name', name: 'display_name' },
                { data: 'permissions', name: 'permissions' },
                { data: 'description', name: 'description' },
                { data: 'action', name: 'action', orderable: false, searchable: false},
//                    { data: 'delete', name: 'delete', orderable: false, searchable: false}
            ]
        });
        {{--//add--}}
        $('#btn_addForm').click(function () {
            urlPermission ="{{url('/user/api/role/')}}";
            method='post';
            id=$("#id").val();
            if(id!=""){
                method="put";
                param='/'+id;
            }
            var form =$("#addForm");


            $.ajax({
                url: urlPermission +param ,
                type: method ,
                data: form.serialize(),
//                beforeSend: function (xhr) {
//                    xhr.setRequestHeader("Authorization", 'Bearer ' + getJwtToken());
//                },
                success: function (data, textStatus, jQxhr) {
                    console.log(textStatus)

                    if (textStatus == 'success') {
                        toastr.success('Bạn thêm thành công');

                    }
                    form[0].reset();
                    $("#id").val('');
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
            var deleteCustomerURL = 'http://hidocter.dev-altamedia.com/room/delete/' + id;
            toastr.error("<button type='button' id='confirmationRevertYes' class='btn clear'>Yes</button><button type='button' id='confirmationRevertNo' class='btn' style='margin-left: 10px;'>No</button>", 'Bạn có muốn xóa chức vụ này?',
                {
                    closeButton: false,
                    allowHtml: true,
                    onShown: function (toast) {
                        $("#confirmationRevertYes").click(function () {
                            $.ajax({
                                url: 'api/role/delete/' + id,
                                type: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function (data,textStatus,jqXhr) {

                                    if (textStatus == 'success') {
                                        toastr.success('Bạn xóa thành công');

                                    }
                                    $tableData.ajax.reload();


                                },
                                error: function (jqXhr, status, errorThrown) {
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
                        });
                        $("#confirmationRevertNo").click(function () {
                            console.log('clicked No');
                            toastr.clear();
                        });
                    },
                    showDuration: "5000",
                });
        }
        
        function setUpdate(id) {
//            html='';
//            //permission
//            $.ajax({
//                url: 'api/permission/getall_byrole/'+id ,
//                type: 'get',
//
//                success: function (data, textStatus, jQxhr) {
//                    $.each(data,function (index,value) {
//                        html+='<li class="select2-selection__choice" title="add">'+value+' </li>'
//                    })
//                    $(".select2-selection__rendered").html(html);
//
//
//
//                },
//                error: function (jqXhr, textStatus, errorThrown) {
//                    console.log(jqXhr);
//                    if (jqXhr.status == 422) {
//                        $.each(jqXhr.responseJSON.error.errors, function (key, value) {
//                            toastr["error"](value);
//                        });
//                    }
//                    if (jqXhr.status == 403) {
//                        toastr["error"](jqXhr.responseJSON.error.message);
//                    }
//                }
//            });
            //===role
            $.ajax({
                url: 'api/role/get_byid/'+id ,
                type: 'get',

                success: function (data, textStatus, jQxhr) {
                    console.log(data[0]['name'])
                    $("input[name='name']").val(data[0]['name']);
                    $("input[name='display_name']").val(data[0]['display_name']);
                    $("input[name='description']").val(data[0]['description']);


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
        $("#id").val(id);
        }
    </script>

@endpush

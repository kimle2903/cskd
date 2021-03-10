@extends('master')
@section('content')

    <script type="text/javascript" src="js/bootstrap-multiselect.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap-multiselect.min.css" type="text/css"/>
<style>
    .multiselect-native-select .btn-group{
        width: 100%;
    }

    .multiselect-native-select .multiselect-container{
        width: 100%;
        height: 500px;
        overflow-y: scroll;
    }
    .multiselect-container .multiselect-group,  .multiselect-container .multiselect-all{
        padding-left: 20px;
        color: #007bff;
    } 
    .multiselect-container .multiselect-group:hover, .multiselect-container .multiselect-all:hover{
        color: #0056B3;
    }
   
    .multiselect-container .multiselect-option{
        padding-left: 40px !important;
    }
   
    .btn-group .custom-select{
        border-radius: 0px;
        border: none;
        border-bottom: 1px solid #ced4da;
        background-size: 0px;
    }

    .btn-group .custom-select:focus{
        box-shadow: none
    } 
    .multiselect-selected-text{
        float: left;
    }
</style>
    <div id="role">
        <div class="row">
            <div class="col-lg-11 pl-5">
                <h4 class="mb-5"><span class="role-title">QUẢN TRỊ - VAI TRÒ</span> 
                   <button type="button" class="btn btn-primary add-new">
                       <img src="/images/ic_tool_add.svg" alt="ic_tool_add.svg">
                       <span>THÊM MỚI</span> 
                   </button>
                </h4>
                <table class="table table-bordered table-responsive" id="nameTable">
                    <thead>
                        <tr>
                            <th style="width: 1%"><input type="checkbox" name="" id="checkDeleteAll"></th>
                            <th class="text-center">Tên vai trò </th>
                            <th class="text-center">Ngày tạo</th>
                            <th class="text-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>   
     {{-- add Modal  --}}
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Thêm mới vai trò</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <div class="row form-group">
                    <div class="col-4 department-label">Tên vai trò <span class="text-danger">*</span> </div>
                    <div class="col-8">
                        <input type="text" name="name " id="role-name" autocomplete='off' class="form-control textTxt" placeholder="Nhập tên" >
                        <div class="alert-name alert-error"></div>
                    </div>
                </div>
                <div class="row form-group mb-5">
                    <div class="col-4 department-label">Tên quyền <span class="text-danger">*</span> </div>
                    <div class="col-8">
                        <select name="permission" id="list-permission" class="form-control textTxt" multiple="multiple">
                            @foreach ($permissionParents as $permissionParent)
                               <optgroup label="{{$permissionParent->desc_name}}" class="permission-parent">
                                 <?php $permissions = Spatie\Permission\Models\Permission::where('parent_id', $permissionParent->id)->get(); ?>
                                 @foreach ($permissions as $permission)
                                    <option value="{{$permission->id}}" class="permission_id">{{$permission->desc_name}}
                                    </option>
                                 @endforeach
                                  
                                </optgroup> 
                            @endforeach
                        </select>
                        <div class="alert-permissions alert-error"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5 offset-md-1">
                        <button class="btn btn-modal-reset"><img src="images/ic_btn_white_reset.svg" alt="ic_btn_white_reset"> Nhập lại</button>

                    </div>
                    <div class="col-md-5 ">
                        <button class="btn btn-primary btn-modal-save" id="add-new"> <img src="images/ic_btn_white_save.svg" alt="ic_btn_white_save">Lưu</button>
                    </div>
                </div>
            </div>
            
            </div>
        </div>
    </div>


     {{-- modal thong bao --}}
    <div class="modal fade" id="notification" tabindex="-1" role="dialog" aria-labelledby="notificationLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="notificationLabel">Thông báo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="message mb-5 text-center"></div>
                <div class="btn-close-wrap text-center">
                    <button type="button" class="btn btn-secondary btn-close" id="close-notify">Đóng</button>
                  
                </div>
                
            </div>
            
            </div>
        </div>
    </div>

    {{-- modal sua --}}
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Chỉnh sửa loại hình vi phạm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row form-group">
                    <div class="col-4 department-label">Tên vai trò <span class="text-danger">*</span> </div>
                    <div class="col-8">
                        <input type="hidden" id="id" value="">
                        <input type="hidden" id="list-permission" value="">
                        <input type="text" name="name" id="role-name-edit" autocomplete="off" placeholder="Nhập tên" class="form-control textTxt">
                        <div class="alert-name alert-error"></div>
                    </div>
                </div>
                <div class="row form-group mb-5">
                    <div class="col-4 department-label">Tên quyền <span class="text-danger">*</span> </div>
                    <div class="col-8">
                      
                        <select name="permission" id="list-permission-edit" class="form-control textTxt" multiple="multiple">
                            @foreach ($permissionParents as $permissionParent)
                               <optgroup label="{{$permissionParent->desc_name}}" class="permission-parent">
                                 <?php $permissions = Spatie\Permission\Models\Permission::where('parent_id', $permissionParent->id)->get(); ?>
                                 @foreach ($permissions as $permission)
                                    <option value="{{$permission->id}}" class="permission_id">{{$permission->desc_name}}
                                    </option>
                                 @endforeach
                                  
                                </optgroup> 
                            @endforeach
                        </select>
                        <div class="alert-permissions alert-error"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5 offset-md-1">
                        <button class="btn btn-cancel"> Hủy bỏ</button>

                    </div>
                    <div class="col-md-5 ">
                        <button class="btn btn-primary btn-update" id="saveType"> Cập nhật</button>
                    </div>
                </div>
            </div>
            
            </div>
        </div>
    </div>
    {{-- model delete --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="delete">Xóa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id" value="">
                <div class="mb-5 text-center text-delete">Bạn chắc chắn muốn xóa?</div>
                <div class="row">
                    <div class="col-md-5 offset-md-1">
                        <button class="btn btn-cancel-delete"> Hủy bỏ</button>

                    </div>
                    <div class="col-md-5 ">
                        <button class="btn btn-primary btn-delete-item" id="delete-item"> Xóa</button>
                    </div>
                </div>
                
            </div>
            
            </div>
        </div>
    </div>

    {{-- delete all  --}}
    <div class="modal fade" id="deleteAllModal" tabindex="-1" role="dialog" aria-labelledby="deleteAll" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteAll">Xóa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="list-id" value="">
                <div class="mb-5 text-center text-delete">Bạn chắc chắn muốn xóa các lựu chọn?</div>
                <div class="row">
                    <div class="col-md-5 offset-md-1">
                        <button class="btn btn-cancel-delete"> Hủy bỏ</button>

                    </div>
                    <div class="col-md-5 ">
                        <button class="btn btn-primary btn-delete-item" id="delete-all-item"> Xóa</button>
                    </div>
                </div>
                
            </div>
            
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){

            
            $("#list-permission").multiselect({
                includeSelectAllOption: true,
                enableClickableOptGroups: true,
                numberDisplayed: 1,
                includeSelectAllIfMoreThan: 0,
                
            });
            
            $("#editModal #list-permission-edit").multiselect({
                includeSelectAllOption: true,
                enableClickableOptGroups: true,
                numberDisplayed: 1,
                includeSelectAllIfMoreThan: 0,
                
            });
            $(".btn-modal-reset").click(function(){
                $("#addModal #list-permission").multiselect('clearSelection');
                $("#addModal #role-name").val("");
                $("#addModal .alert-error").text('');
            })
            $(".btn-close").click(function(){
                $("#notification").modal('hide');
                location.reload();
            })
            $(".btn-cancel-delete").click(function(){
                $("#deleteModal").modal('hide');
            })
            $(".add-new").click(function(){
                $("#addModal").modal('show');
                $("#addModal .alert-error").text('');

            })
            $("#saveType").click(function(){
                var name = $("#editModal #role-name-edit").val();
                var id = $("#editModal #id").val();
                var permissions =  $('#list-permission-edit').val();
               
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: 'roles/update/'+ id,
                    data:{
                        id: id,
                        name:name,
                        permissions: permissions
                    }, 
                    method: "POST", 
                    dataType: 'json',
                    success:function(data){
                        $("#editModal").modal('hide');
                        $('#notification').modal('show');
                        if(data['status'] == 200){
                            $("#notification .message").text(data['message']);
                        }else{
                             $("#notification .message").text(data['message']);
                        }
                    },
                    error: function(data){
                        $.each(data.responseJSON.errors, function(index, value){
                            $("#editModal .alert-"+index).html(value)
                        })
                    }
                })
            })
            $("#add-new").click(function(){
                $("#addModal .alert-error").text('');
                var name = $("#role-name").val();
                var listPermission = $("#list-permission").val();
              
                
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: 'roles/store',
                    data:{
                        name: name,
                        permissions: listPermission
                    }, 
                    method: "POST", 
                    dataType: 'json',
                    success: function(data){
                        $("#addModal").modal('hide');
                        $('#notification').modal('show');
                        if(data['status'] == 200){
                            $("#notification .message").text(data['message']);
                        }else{
                            $("#notification .message").text("Thêm mới thất bại.");
                        }
                    }, 
                    error: function(data){
                        $.each(data.responseJSON.errors, function(index, value){
                            $("#addModal .alert-"+index).html(value)
                        })
                    }
                })
               
            })

            $("#delete-item").click(function(){
                var id = $('#deleteModal #id').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: 'roles/delete/' + id,
                    data:{
                        id: id, 
                        _method:'DELETE',
                    },
                    method:"POST",
                    dataType: 'json',
                    success:function(data){
                        $("#deleteModal").modal('hide');
                        $("#notification").modal('show');
                        if(data['status'] == 200){
                            $("#notification .message").text(data['message']);
                        }else{
                            $("#notification .message").text(data['message']);
                        }
                    }, 
                    error: function(data){
                        $("#notification .message").text('Xóa thất bại');
                    }
                })

            })
            $("#delete-all-item").click(function(){
                var listId =  $("#deleteAllModal #list-id").val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: 'roles/multiDelete/',
                    data:{
                        listId: listId, 
                        _method:'GET',
                    },
                    method:"POST",
                    dataType: 'json',
                    success:function(data){
                        $("#deleteAllModal").modal('hide');
                        $("#notification").modal('show');
                        if(data['status'] == 200){
                            $("#notification .message").text(data['message']);
                        }else{
                            $("#notification .message").text(data['message']);
                        }
                    }, 
                    error: function(data){
                        $("#notification .message").text('Xóa thất bại');
                    }
                })

               
            })
            var dataObject = [
                {
                    data:'action',
                    orderable:false,
                    bSearchable : false,
                    class: 'text-center',
                    render: function(data, type, row, meta){
                         return '<input type="checkbox" class="check-item-delete" data-id="'+data+'">';
                    }
                },
                {
                    data: 'name', 
                    width: '35%',
                },
                {
                    data: 'created_at', 
                    width: '25%',
                    bSearchable : false
                },
                
                {
                    data: 'action',
                    orderable:false,
                    bSearchable : false,
                    class: 'text-center', 
                    width: '15%',
                    render: function(data, type, row, meta){
                       var  html  = '';
                            html += '<span class="btn-edit mr-2" data-id="'+data+'" data-name = "'+row.name+'" title="sửa"><i class="far fa-edit"></i></span>';
                            html += '<a class="btn-delete mr-2" data-id="'+data+'"  title="xóa"><i class="fas fa-trash-alt"></i></a>';
                            return html;
                        }
                }
                
            ]
            var dataTable = $("#nameTable").DataTable({
                serverSide: true,
                stateSave: false,
                searching: true,
                autoWidth: true,
                aaSorting: [],
                listCheck: [],
                responsive: true,
                ajax:{
                    url: 'roles/getDataAjax',
                },
                columns: dataObject,
                colReorder: {
                    fixedColumnsRight: 1,
                    fixedColumnsLeft: 1
                },
                language:{
                    info: "Hiển thị _START_ - _END_ / _TOTAL_ bản ghi",
                    zeroRecords:    "Không tìm thấy bản ghi nào",
                    lengthMenu:     "Hiển thị _MENU_ bản ghi", 
                    paginate:{
                        next: "Trang trước", 
                        previous: 'Trang sau',
                    }, 
                    search: 'Tìm kiếm',
                    infoFiltered: '',
                    sInfoEmpty: "",
                },
                drawCallback: function(){
                    addEventListener();
                }
              
            })
            dataTable.draw();

            var check = true;
            function addEventListener(){
                var html = '';
                html += '<div class="col-sm-12 col-md-3"><button class="btn btn-danger deleteAll"><img src="images/ic_btn_white_delete.svg" >Xóa tất cả</button></div>';
                $("#nameTable_wrapper .row:nth-child(3) .col-sm-12.col-md-5").removeClass('col-md-5').addClass('col-md-3 text-center text-footer-table');
                $("#nameTable_wrapper .row:nth-child(3) .col-sm-12.col-md-7").removeClass('col-md-7').addClass('col-md-6');
                if(check == true){
                    $("#nameTable_wrapper .row:nth-child(3) .text-footer-table").before(html);
                    check = false;
                }
                $("#nameTable_filter input[type=search]").attr('placeholder', 'Tìm kiếm...');

                $(".btn-edit").click(function(){
                    $("#editModal").modal('show');
                    $("#editModal .alert-error").text('');
                    var id =  $(this).attr('data-id');
                    var name = $(this).attr('data-name')
                    $("#editModal #role-name-edit").val(name);
                    $("#editModal #id").val(id);
                    getRoleById(id);
                    
                })

                $(".btn-delete").click(function(){
                    $("#deleteModal").modal("show");
                    var id = $(this).attr('data-id');
                    $('#deleteModal #id').val(id);

                })

                $("#checkDeleteAll").click(function(){
                    if($("#checkDeleteAll").is(":checked")){
                        $.each($('.check-item-delete'), function(index, value){
                            $(this).prop('checked', true);
                        });
                    }else{
                         $.each($('.check-item-delete'), function(index, value){
                            $(this).prop('checked', false);
                        });
                    }   
                })
                
                $(".deleteAll").click(function(){
                    listCheck = [];
                    $.each($('.check-item-delete'), function(index, value){
                        if($(this).is(":checked")){
                            listCheck.push($(this).attr('data-id'));
                        }
                    })
                   
                    if(listCheck.length > 0){
                        $("#deleteAllModal #list-id").val(listCheck);
                        $("#deleteAllModal").modal('show');
                    }else{
                        $("#notification").modal('show');
                        $("#notification .message").text("Không có bản ghi nào được chọn.");
                    }
                    
                })
            }

            function getRoleById(id){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: 'roles/getRoleById/'+ id,
                    data:{
                        id: id,
                    }, 
                    method: "POST", 
                    success:function(data){
                        var size = data.length;
                        for (var i = 0; i < size; i++) {
                            $('#list-permission-edit').multiselect('select', data[i]);
                        }
                    },
                    error: function(data){
                        $.each(data.responseJSON.errors, function(index, value){
                            $("#editModal .alert-"+index).html(value);
                        })
                    }
                })
            }
            
        })
    </script>
@endsection
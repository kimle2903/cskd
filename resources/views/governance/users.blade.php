@extends('master')
@section('content')
    <div id="user">
        <div class="row">
            <div class="col-md-11 pl-5">
                <h4 class="mb-5">
                <span class="type-investment-title">QUẢN TRỊ - NGƯỜI DÙNG</span>
                @can("users.create")
                <button class="btn btn-primary add-new"> <img src="images/ic_tool_add.svg" alt="ic_tool_add.svg"> <span>THÊM MỚI</span> </button>
                @endcan
                </h4>
                <table class="table table-bordered mt-2" id="nameTable">
                    <thead>
                        <tr>
                            <th style="width: 1%"> <input type="checkbox"  id="checkDeleteAll"></th>
                            <th class="text-center">Họ và tên</th>
                            <th class="text-center">Tên đăng nhập</th>
                            <th class="text-center">Vai trò</th>
                            <th class="text-center">Đơn vị</th>
                            <th class="text-center">Thao tác</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    {{-- modal add new --}}
     <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Thêm mới người dùng</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row form-group">
                    <div class="col-5 department-label"><img src="images/ic_blue_officer.svg" alt="ic_blue_officer"> Họ và tên <span class="text-danger">*</span> </div>
                    <div class="col-7">
                        <input type="text" name="name" id="user-name" placeholder="Nhập tên" autocomplete="off" class="form-control textTxt">
                        <div class="alert-name alert-error"></div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-5 department-label"><img src="images/ic_blue_username.svg" alt="ic_blue_username.svg"> Tên đăng nhập <span class="text-danger">*</span> </div>
                    <div class="col-7">
                        <input type="text" name="email" id="email" placeholder="vd: example@gmail.com" autocomplete="off" class="form-control textTxt">
                        <div class="alert-email alert-error"></div>
                    </div>
                </div>
                 <div class="row form-group ">
                    <div class="col-5 department-label"> <img src="images/ic_blue_unit.svg" alt=""> Đơn vị <span class="text-danger">*</span> </div>
                    <div class="col-7">
                        <select name="department_id" id="department_id" class="form-control textTxt">
                            <option value="">-- Chọn --</option>
                            @foreach ($departments as $department)
                                <option value="{{$department->id}}" class="department_item">{{$department->name}}</option>
                            @endforeach
                        </select>
                        <div class="alert-department_id alert-error"></div>
                    </div>
                </div>
                <div class="row form-group mb-5">
                    <div class="col-5 department-label"><img src="images/ic_blue_role_name.svg" alt="ic_blue_role_name"> Tên vai trò <span class="text-danger">*</span> </div>
                    <div class="col-7">
                        <select name="role_id" id="role_id" class="form-control textTxt">
                            <option value="">-- Chọn --</option>
                            @foreach ($roles as $role)
                                <option value="{{$role->id}}" class="role_item">{{$role->name}}</option>
                            @endforeach
                        </select>
                        <div class="alert-role_id alert-error"></div>
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
                <input type="text" name="id" id="id" hidden>
               <div class="row form-group">
                    <div class="col-5 department-label"><img src="images/ic_blue_officer.svg" alt="ic_blue_officer"> Họ và tên <span class="text-danger">*</span> </div>
                    <div class="col-7">
                        <input type="text" name="name" id="user-name-edit" placeholder="Nhập tên" autocomplete="off" class="form-control textTxt">
                        <div class="alert-name alert-error"></div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-5 department-label"><img src="images/ic_blue_username.svg" alt="ic_blue_username.svg"> Tên đăng nhập <span class="text-danger">*</span> </div>
                    <div class="col-7">
                        <input type="text" name="email" id="email-edit" placeholder="vd: example@gmail.com" autocomplete="off" class="form-control textTxt">
                        <div class="alert-email alert-error"></div>
                    </div>
                </div>
                 <div class="row form-group ">
                    <div class="col-5 department-label"> <img src="images/ic_blue_unit.svg" alt=""> Đơn vị <span class="text-danger">*</span> </div>
                    <div class="col-7">
                        <select name="department_id" id="department_id-edit" class="form-control textTxt">
                            <option value="">-- Chọn --</option>
                            @foreach ($departments as $department)
                                <option value="{{$department->id}}" class="department_item">{{$department->name}}</option>
                            @endforeach
                        </select>
                        <div class="alert-department_id alert-error"></div>
                    </div>
                </div>
                <div class="row form-group mb-5">
                    <div class="col-5 department-label"><img src="images/ic_blue_role_name.svg" alt="ic_blue_role_name"> Tên vai trò <span class="text-danger">*</span> </div>
                    <div class="col-7">
                        <select name="role_id" id="role_id-edit" class="form-control textTxt">
                            <option value="">-- Chọn --</option>
                            @foreach ($roles as $role)
                                <option value="{{$role->id}}" class="role_item">{{$role->name}}</option>
                            @endforeach
                        </select>
                        <div class="alert-role_id alert-error"></div>
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
        $('document').ready(function(){
            $("#department_id").select2();
            $("#role_id").select2();
            $('#department_id').data('select2').$dropdown.find(':input.select2-search__field').attr('placeholder', 'Tìm kiếm...');
            $('#role_id').data('select2').$dropdown.find(':input.select2-search__field').attr('placeholder', 'Tìm kiếm...');

            $(".add-new").click(function(){
                $(".alert-error").text("");
                $('#addModal').modal('show');
            })

            $(".btn-modal-reset").click(function(){
                 $(".alert-error").text("");
                $("#user-name").val("");
                $("#email").val("");
                $("#department_id").val(null).trigger('change');
                $('#role_id').val(null).trigger('change');
            })
            $(".btn-close").click(function(){
                $("#notification").modal('hide');
                if($('#notification .message').text() != 'Không có bản ghi nào được chọn.'){
                    location.reload();
                }
                
            })

            $(".btn-cancel").click(function(){
                $('#editModal').modal('hide');
            })
            $(".btn-cancel-delete").click(function(){
                $("#deleteModal").modal('hide');
                $("#deleteAllModal").modal('hide');
            })
            $("#add-new").click(function(){
                $(".alert-error").text("");
                var name =  $("#user-name").val();
                var email =  $("#email").val();
                var department_id =  $("#department_id").val();
                var role_id =  $("#role_id").val();
                // alert(name+ "= " +email + '= ' + department_id + "= " + role_id )
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: 'users/store',
                    data:{
                        name: name, 
                        email: email,
                        department_id: department_id,
                        role_id: role_id,
                    }, 
                    method: 'POST',
                    dataType:'json', 
                    success:function(data){
                        $('#addModal').modal('hide');
                        $("#notification").modal('show');
                        if(data['status'] == 200){
                             $("#notification .message").text(data['message']);
                        }else{
                            $("#notification .message").text(data['message']);
                        }
                    }, 
                    error: function(data){
                        $("#notification .message").text(data['message']);
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
                    url: 'users/multiDelete/',
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
            $("#delete-item").click(function(){
                var id = $("#deleteModal #id").val();
                
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: 'users/delete/' + id,
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

            $("#saveType").click(function(){
                var name = $("#editModal #type-investment-name-edit").val();
                var id = $("#editModal #id").val();
                var name = $("#editModal #user-name-edit").val();
                var email =   $("#editModal #email-edit").val();
                var role_id =  $("#editModal #role_id-edit").val();
                var department_id = $("#editModal #department_id-edit").val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: 'users/update/'+ id,
                    data:{
                        id: id,
                        name:name,
                        email:email,
                        role_id: role_id,
                        department_id:department_id
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
                    width: '22%',
                },
                {
                    data: 'email', 
                    width: '24%',
                },
                {
                    data: 'role_name', 
                    width: '18%',
                   
                },
                {
                    data: 'department_name', 
                    width: '21%',
                   
                },
                {
                    data: 'action',
                    orderable:false,
                    bSearchable : false,
                    class: 'text-center', 
                    width: '14%',
                    render: function(data, type, row, meta){
                       var  html  = '';
                        @can("users.edit")
                            html += '<span class="btn-edit mr-2" data-id="'+data+'" data-name = "'+row.name+'" data-email="'+row.email+'" data-role="'+row.role_id+'" data-department="'+row.department_id+'" title="sửa"><i class="far fa-edit"></i></span>';
                        @endcan
                        @can("users.delete")
                            html += '<a class="btn-delete mr-2" data-id="'+data+'"  title="xóa"><i class="fas fa-trash-alt"></i></a>';
                        @endcan
                        return html;
                        }
                }
                
            ];
            var dataTable = $("#nameTable").DataTable({
                serverSide: true,
                stateSave: false,
                searching: true,
                autoWidth: true,
                aaSorting: [],
                listCheck: [],
                responsive: true,
                ajax:{
                    url: 'users/getDataAjax',
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
                html += ' @can("users.delete_multi")<div class="col-sm-12 col-md-3"><button class="btn btn-danger deleteAll"><img src="images/ic_btn_white_delete.svg" >Xóa tất cả</button></div>@endcan';
                $("#nameTable_wrapper .row:nth-child(3) .col-sm-12.col-md-5").removeClass('col-md-5').addClass('col-md-3  text-footer-table');
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
                    var name = $(this).attr('data-name');
                    var email = $(this).attr('data-email');
                    var role_id = $(this).attr('data-role');
                    var department_id = $(this).attr('data-department');
                    $("#editModal #id").val(id);
                    $("#editModal #user-name-edit").val(name);
                    $("#editModal #email-edit").val(email);
                    $("#editModal #role_id-edit").val(role_id);
                    $("#editModal #department_id-edit").val(department_id);
                    
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
           
        })
    </script>
@endsection
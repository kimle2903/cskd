@extends('master')
@section('content')
    <div id="form-violate">
        <div class="row">
            <div class="col-md-11 pl-5">
                <h4 class="mb-5">
                <span class="form-violate-title">QUẢN TRỊ - HÌNH THỨC XỬ LÝ VI PHẠM </span>
                @can("form-violates.store")
                <button class="btn btn-primary add-new"> <img src="images/ic_tool_add.svg" alt="ic_tool_add.svg"> <span>THÊM MỚI</span> </button>
                @endcan
                </h4>
                <table class="table table-bordered" id="nameTable">
                    <thead>
                        <tr>
                            <th style="width: 1%"> <input type="checkbox"  id="checkDeleteAll"></th>
                            <th class="text-center">Hinh thức xử lý vi phạm</th>
                            <th class="text-center">Ngày tạo</th>
                            <th class="text-center">Ngày cập nhật</th>
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
                <h5 class="modal-title" id="addModalLabel">Thêm mới hình thức xử lý vi phạm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row form-group mb-5">
                    <div class="col-5 department-label">Tên hình thức xử lý <span class="text-danger">*</span> </div>
                    <div class="col-7">
                        <input type="text" name="name" id="form-violate-name" placeholder="Nhập tên" autocomplete="off" class="form-control textTxt">
                        <div class="alert-name alert-error"></div>
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
                <h5 class="modal-title" id="editModalLabel">Chỉnh sửa cấp xử lý</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <div class="row form-group mb-5">
                    <div class="col-5 department-label">Tên cấp xử lý <span class="text-danger">*</span> </div>
                    <div class="col-7">
                        <input type="hidden" id="id" value="">
                        <input type="text" name="name" id="form-violate-name-edit" autocomplete="off" placeholder="Nhập tên" class="form-control textTxt">
                        <div class="alert-name alert-error"></div>
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
            $(".add-new").click(function(){
                $('#addModal').modal('show');
            })

            $(".btn-modal-reset").click(function(){
                $("#processing-level-name").val("");
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
                var name =  $("#form-violate-name").val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: 'form-violates/store',
                    data:{
                        name: name, 
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
                        $.each(data.responseJSON.errors, function(index, value){
                            $("#addModal .alert-"+index).html(value)
                        })
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
                    url: 'form-violates/multiDelete/',
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
                    url: 'form-violates/delete/' + id,
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
                var name = $("#editModal #form-violate-name-edit").val();
                var id =  $("#editModal #id").val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: 'form-violates/update/'+ id,
                    data:{
                        id: id,
                        name:name,
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
                    width: '35%',
                },
                {
                    data: 'created_at', 
                    width: '25%',
                    bSearchable : false
                },
                {
                    data: 'updated_at', 
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
                            @can("form-violates.edit")
                            html += '<span class="btn-edit mr-2" data-id="'+data+'" data-name = "'+row.name+'" title="sửa"><i class="far fa-edit"></i></span>';
                            @endcan
                            @can("form-violates.delete")
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
                    url: 'form-violates/getDataAjax',
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
                html += ' @can("form-violates.delete_multi")<div class="col-sm-12 col-md-3"><button class="btn btn-danger deleteAll"><img src="images/ic_btn_white_delete.svg" >Xóa tất cả</button></div>@endcan';
                $("#nameTable_wrapper .row:nth-child(3) .col-sm-12.col-md-5").removeClass('col-md-5').addClass('col-md-3 text-footer-table');
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
                    $("#editModal #form-violate-name-edit").val(name);
                    $("#editModal #id").val(id);
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
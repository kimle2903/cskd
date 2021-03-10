@extends('master')
@section('content')
    <div id="department">
        <div class="row">
            <div class="col-lg-11 info-department pl-5">
                <h4 class="mb-5"><span class="department-title">QUẢN TRỊ - ĐƠN VỊ</span> 
                    @can('department.create')
                        <button type="button" class="btn btn-primary add-new" data-toggle="modal" data-target="#addModal">
                        <img src="images/ic_tool_add.svg" alt="icon them moi"> <span>THÊM MỚI</span> </button>
                    @endcan
                </h4>
                <table class="table table-bordered" id="nameTable" style="width: 100%">
                    <thead>
                        <tr>
                            <th style="width: 1%"><input type="checkbox" name="" id="checkDeleteAll"></th>
                            <th class="text-center">Tên đơn vị </th>
                            <th class="text-center">Thao tác</th>
                        </tr>
                    </thead>
                </table>
            
            </div>
           
        </div>
        
    </div>

       
{{-- modal --}}
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Thêm đơn vị mới</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <div class="row form-group mb-5">
                    <div class="col-5 department-label">Tên đơn vị <span class="text-danger">*</span> </div>
                    <div class="col-7">
                        <input type="text" name="name" id="department-name">
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
                <h5 class="modal-title" id="editModalLabel">Chỉnh sửa đơn vị</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <div class="row form-group mb-5">
                    <div class="col-5 department-label">Tên đơn vị <span class="text-danger">*</span> </div>
                    <div class="col-7">
                        <input type="hidden" id="id" value="">
                        <input type="text" name="name" id="name">
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
    $(document).ready(function(){

        $('.btn-modal-reset').click(function(){
            $("#department-name").val("");
        })
       

        $('.btn-cancel').click(function(){
            $("#editModal").modal('hide');
        })

        $('.btn-cancel-delete').click(function(){
            $("#deleteModal").modal('hide');
            $('#deleteAllModal').modal('hide');
        })

        $(".btn-close").click(function(){
            $("#notification").modal('hide');
            if( $(".modal-body .message").text() != "Chưa có bản ghi nào được chọn."){
                location.reload();
            }
            
        })
       

        $("#add-new").click(function(){
            var name = $("#department-name").val().trim();
           
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "/department/store",
                data:{
                    name: name,
                    _method : "POST"
                }, 
                method: "POST",
                dataType: 'json',
                success: function(data){
                    $("#department-name").val("");
                    $('#addModal').modal('hide');
                    $("#notification").modal('show');
                    if(data['status'] == 200){
                        $(".modal-body .message").text("Thêm mới thành công.");
                    }else if(data['status'] == 404){
                        $(".modal-body .message").text("Thêm mới thất bại.");
                    } 

                },
                error: function(data){
                    $.each(data.responseJSON.errors, function(index, value){
                        $("#addModal .alert-"+index).html(value)
                    })
                }
            })
        })
        $("#saveType").click(function(){
            $("#editModal .alert-error").html("");
            var id = $("#id").val();
            var name = $("#name").val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/department/edit/'+ id, 
                data:{
                    id: id, 
                    name: name,
                    _method:'PUT'
                }, 
                method: "POST", 
                dataType: 'json',
                success: function(data){
                     $("#editModal").modal('hide');
                    $("#notification").modal('show');
                    if(data['status'] == 200){
                        $(".modal-body .message").text("Cập nhật thành công.");
                    }else if(data['status'] == 404){
                        $(".modal-body .message").text("Cập nhật thất bại.");
                    }
                }, 
                error: function (data){
                   $.each(data.responseJSON.errors, function(index, value){
                       $("#editModal .alert-"+index).html(value);
                   })
                }
            })
            
        })

        $("#delete-item").click(function(){
            var id = $('#deleteModal #id').val();
            $("#deleteModal").modal('hide');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '/department/delete/'+id,
                    data:{
                        id: id, 
                        _method: 'DELETE'
                    }, 
                    method: 'POST',
                    success:function(data){
                        $('#notification').modal('show');
                        if(data['status'] == 200){
                            $(".modal-body .message").text("Xóa thành công.");
                        }else{
                             $(".modal-body .message").text("Xóa thất bại.");
                        }
                    }, 
                    error: function(data){
                        $('#notification').modal('show');
                        $(".modal-body .message").text("Xóa thất bại.");
                    }
                })

        })

        $("#delete-all-item").click(function(){
            var listId = $("#deleteAllModal #list-id").val();
            $("#deleteAllModal").modal('hide');
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "/department/multiDelete",
                data:{
                    listId: listId,
                    _method: "DELETE",
                },
                method: "POST", 
                success: function(data){
                    $("#notification").modal('show');
                    if(data['status'] == 200){
                        $(".modal-body .message").text("Xóa thành công.");
                    }else{
                        $(".modal-body .message").text("Xóa thất bại.");
                    }
                    
                }, 
                error: function(data){
                    $("#notification").modal('show');
                    $(".modal-body .message").text("Xóa thất bại.");
                }
            })
            
        })
        var dataObject = [
            {
                data:'action',
                class: 'text-center',
                orderable:false,
                bSearchable : false,
                render: function(data, type, row, meta){
                    return '<input type="checkbox" class="check-item-delete" data-id="'+data+'">';
                }
            },
            {
                data: 'name',
                width: '70%',
                
            },
            {
                data:'action',
                orderable:false,
                bSearchable : false,
                width: '29%',
                class: 'text-center',
                render:function ( data, type, row, meta ) {
                    var html  = '';
                    @can('department.edit')
                    html += '<span class="btn-edit mr-2" data-id="'+data+'" data-name = "'+row.name+'" title="sửa"><i class="far fa-edit"></i></span>';
                    @endcan
                    @can('department.delete')
                    html += '<a class="btn-delete mr-2" data-id="'+data+'" ata-name = "'+row.name+'" title="xóa"><i class="fas fa-trash-alt"></i></a>';
                    @endcan
                    return html;
                }
            }
        ]
        var dataTable =  $("#nameTable").DataTable({
            serverSide: true,
            stateSave: false,
            searching: true,
            responsive:true,
            aaSorting: [],
            listCheck:[],
            ajax:{
                url: "{{url('/')}}/department/getDataAjax",

            }, 
            columns : dataObject,
            
            colReorder: {
                fixedColumnsLeft: 1,
                fixedColumnsRight: 1
            },
            language:{
                search: 'Tim kiếm',
                paginate: {
                    next: "Trang sau",
                    previous: "Trang trước"
                },
                lengthMenu: 'Hiển thị _MENU_ bản ghi',
                info: "Hiển thị _START_ - _END_ /_TOTAL_ bản ghi",
                sZeroRecords: "Không tìm thấy bản ghi tìm kiếm",
                //  sInfoFiltered: "",
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
            html += ' @can("department.delete_multi")<div class="col-sm-12 col-md-3"><button type="button" class="btn btn-danger deleteAll"><image src="images/ic_btn_white_delete.svg" class="ic-delete">Xóa tất cả</button></div>@endcan';

            $("#nameTable_wrapper .row:nth-child(3) .col-sm-12.col-md-5").removeClass('col-md-5').addClass('col-md-3  text-footer-table');
            $("#nameTable_wrapper .row:nth-child(3) .col-sm-12.col-md-7").removeClass('col-md-7').addClass('col-md-6 ');
            if(check == true){
                $('#nameTable_wrapper .row:nth-child(3) .text-footer-table').before(html);
                check = false;
            }
            $("#nameTable_filter input[type=search]").attr('placeholder', 'Tìm kiếm...')
            $("#checkDeleteAll").click(function(){
                listCheck = [];
                if($("#checkDeleteAll").is(":checked")){
                   $.each($(".check-item-delete"), function(index,value){
                       $(".check-item-delete").prop('checked', true);
                   })
                   
                }else{
                    $.each($(".check-item-delete"), function(index,value){
                       $(".check-item-delete").prop('checked', false);
                   })
                }
            })


            $(".deleteAll").click(function(){
                listCheck=[];
                $.each($(".check-item-delete"), function(index,value){
                    if($(this).is(":checked") == true){
                         listCheck.push($(this).attr('data-id'));
                    }
                })
                if(listCheck.length > 0){
                    $("#deleteAllModal").modal('show');
                    $("#deleteAllModal #list-id").val(listCheck);
                }else{
                    $("#notification").modal('show');
                    $(".modal-body .message").text("Chưa có bản ghi nào được chọn.");
                  
                }
                

               
            });

            $(".btn-edit").on('click', function(){
                var id = $(this).attr('data-id');
                var name = $(this).attr('data-name');
                $("#editModal").modal('show');
                $("#editModal #name").val(name);
                $("#editModal #id").val(id);
            })

            $('.btn-delete').on('click', function(){
                var id = $(this).attr('data-id');
                $('#deleteModal').modal('show');
                $('#deleteModal #id').val(id);
                
            })
        }


    })
</script>
@endsection
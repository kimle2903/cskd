@extends('master')
@section('content')
<style>
    #nameTable_wrapper .row:nth-child(3){
        margin-top: 15px
    }
        table,td,th{
        border:1px solid black;
    }
    table{
        border-collapse: collapse;
        width:100%;
    }
    td{
        border-collapse: collapse;
        /*border-right: none;
        border-left: none;*/
    }
    table.dataTable tbody th,
    table.dataTable tbody td {
    white-space: nowrap;
    }

    a.process-violate, button.history-violate{
        font-size: 14px !important;
        margin: 2px 0px;
        padding: 2px 12px;
        min-width: 128px;
    }

     
</style>
    <div id="busines">
        <div class="row">
            <div class="col-md-11 pl-5">
                <h4>
                <span class="busines-title">KIỂM TRA & XỬ LÝ VI PHẠM</span>
                </h4>
                <div class="row">
                    <div class="col-12">
                        <div class="mb-5">
                            <a href="/violates/create" class="btn btn-primary add-new"> <img src="images/ic_tool_add.svg" alt="ic_tool_add.svg"> <span>THÊM MỚI</span> </a>
                        </div>
                    </div>
                </div>
                
                <table class="table table-bordered my-1 table-responsive" id="nameTable" style="width: 100%">
                    <thead class="thead-custom">
                        <tr>
                            <th style="width: 1%" class="text-center"> <input type="checkbox"  id="checkDeleteAll"></th>
                            <th class="text-center">Tên CSKD</th>
                            <th class="text-center">Địa chỉ CSKD</th>
                            <th class="text-center">Lĩnh vực VP</th>
                            <th class="text-center">Ngành nghề kinh doanh</th>
                            <th class="text-center">Người đại diện</th>
                            <th class="text-center">Ngày kiểm tra</th>
                            <th class="text-center">Ngày tạo</th>
                            <th class="text-center">Hình thức xử lý vi phạm</th>
                            <th class="text-center">Cấp xử lý</th>
                            <th class="text-center">Cán bộ xử phạt</th>
                            <th style="width: 18%;"class="text-center">Tình trạng</th>
                            <th style="" class="text-center">Thao tác</th>
                        </tr>
                    </thead>
                </table>
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
    {{-- history violate --}}
     <div class="modal fade" id="history" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="delete">Lich sử vi phạm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id" value="">
                <table id="history-table" class="table table-bordered my-1" style="width: 100%">
                    <thead>
                        <tr>
                            <th class="text-center">Tên CSKD</th>
                            <th class="text-center">Lĩnh vực VP</th>
                            <th class="text-center">Ngày kiểm tra</th>
                            <th class="text-center">Hình thức xử lý vi phạm</th>
                            <th class="text-center">Tình trạng</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
                <div class="row mt-5">
                    <div class="col-md-2 offset-md-5">
                        <button class="btn btn-close-table w-100">Đóng</button>
                    </div>
                  
                </div>
                
            </div>
            
            </div>
        </div>
    </div>
    <script>
        $('document').ready(function(){

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
           
            $("#delete-all-item").click(function(){
                var listId =  $("#deleteAllModal #list-id").val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '/violates/multiDelete',
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
                            $("#notification .message").text('Xóa thất bại');
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
                    url: 'violates/delete/' + id,
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

            var dataObject = [
                {
                    data:'action',
                    orderable:false,
                    bSearchable : false,
                    class: 'center-on-lower',
                    render: function(data, type, row, meta){
                         return '<input type="checkbox" class="check-item-delete" data-id="'+data+'">';
                    }
                },
                {
                    data: 'busines_name', 
                    class: "center-on-lower",
                },
                {
                    data: 'address', 
                    class: "center-on-lower",
                },
                {
                    data: 'error_violate_name', 
                    class: "center-on-lower",

                },
                 {
                    data: 'busines_type', 
                    class: "center-on-lower",
                },
                {
                    data: 'representative', 
                    class: "center-on-lower",
                   

                },
                {
                    data: 'day_check', 
                    class: "center-on-lower",
                    bSearchable : false,

                },
                {
                    data: 'created_at', 
                    class: "center-on-lower",
                    bSearchable : false
                },
                {
                    data: 'form_violate_name', 
                    class: "center-on-lower",
                   
                },
                {
                    data: 'process_level_name',
                    class: "center-on-lower", 
                   
                },
                {
                    data: 'user_handler_name', 
                    class: "center-on-lower",
                  
                },
                {
                    data: 'status_action',
                    render: function(data, type, row, meta){
                        var html = "";
                        if(data == 1){
                            html += '<span style="color:red">Chưa xử lý</span>';
                        }else{
                            html += '<span style="">Đã xử lý</span>';
                        }
                        return html;
                    } ,
                    class: "center-on-lower",
                    orderable:false,
                },
               
                {
                    data: 'action',
                    orderable:false,
                    bSearchable : false,
                    class: 'text-center', 
                    width: '10%',
                    render: function(data, type, row, meta){
                        var  html  = '<div>';
                        if(row.status_action == 2){
                            html += '<span class="btn-edit mr-2" data-id="'+data+'"  title="sửa"><i class="far fa-edit"></i></span>';
                            html += '<a class="btn-delete mr-2" data-id="'+data+'"  title="xóa"><i class="fas fa-trash-alt"></i></a>';
                            html += '<div><button class="btn btn-primary history-violate" data-id="'+row.id+'" data-busines="'+row.busines_id+'">Lịch xử vi phạm</button></div>'
                        }else{
                            html += '<div><a href="{{url('/')}}/violates/edit/'+row.id+'" class="btn btn-success process-violate">Xử lý vi phạm</a></div>';
                            html += '<div><button class="btn btn-primary history-violate" data-id="'+row.id+'" data-busines="'+row.busines_id+'">Lịch xử vi phạm</button></div>';
                        }
                        html += "</div>"
                        return html;
                    }
                }
                
            ];
            var dataTable = $("#nameTable").DataTable({
                serverSide: true,
                stateSave: false,
                searching: true,
                aaSorting: [],
                listCheck: [],
                // responsive: true,x
                // deferRender:    true,
                // scrollX: true,
                ajax:{
                    url: 'violates/getDataAjax',
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
                    var id =  $(this).attr('data-id');
                    location.href = "{{url('/')}}/violates/edit/"+id;
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
                $(".history-violate").click(function(){
                    $("#history").modal('show');
                    var id = $(this).attr('data-id');
                    var busines_id = $(this).attr('data-busines');
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: 'violates/get-data-by-busines/'+id,
                        data: {
                            busines_id: busines_id,
                        },
                        method: "POST", 
                        dataType: 'html', 
                        success:function(data){
                            $("#history #history-table tbody").html(data);
                        }
                    })
                })

            }
           
        })
    </script>
@endsection
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

     
</style>
    <div id="busines">
        <div class="row">
            <div class="col-md-11 pl-5">
                <h4>
                <span class="busines-title">QUẢN LÝ - THÔNG TIN CƠ SỞ KINH DOANH</span>
                </h4>
                <div class="row">
                    <div class="col-12">
                        <div class="mb-5">
                            <a href="/business/create" class="btn btn-primary add-new"> <img src="images/ic_tool_add.svg" alt="ic_tool_add.svg"> <span>THÊM MỚI</span> </a>
                          
                           
                        </div>
                    </div>
                </div>
                
                <table class="table table-bordered my-1  clearfix" id="nameTable" style="width: 100%">
                    <thead class="thead-custom">
                        <tr>
                            <th style="width: 1%"> <input type="checkbox"  id="checkDeleteAll"></th>
                            <th class="text-center">Tên CSKD</th>
                            <th class="text-center">Địa chỉ CSKD</th>
                            <th class="text-center">Phường/xã/thị trấn</th>
                            <th class="text-center">Quận/huyện</th>
                            <th class="text-center">Ngày đăng ký</th>
                            <th class="text-center">Ngày tạo</th>
                            <th class="text-center">Ngành nghề kinh doanh</th>
                            <th style="width: 18%;"class="text-center">Tình trạng</th>
                            <th style="width: 10%" class="text-center">Thao tác</th>
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

    <div class="modal fade" id="filter" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">BỘ LỌC</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row form-group mb-3">
                    <div class="col-5 department-label">Từ ngày</div>
                    <div class="col-7">
                        <input type="text" name="start_day" id="start_day" class="form-control textTxt textText" placeholder="Nhập ngày" autocomplete="off">
                    </div>
                </div>
                <div class="row form-group mb-3">
                    <div class="col-5 department-label">Đến ngày</div>
                    <div class="col-7">
                        <input type="text" name="end_day" id="end_day" class="form-control textTxt textText" placeholder="Nhập ngày" autocomplete="off">
                    </div>
                </div>
                <div class="row form-group mb-3">
                    <div class="col-5 department-label">Quận huyện</div>
                    <div class="col-7">
                        <select name="distruct" id="district" class="form-control textTxt textText">
                            <option value="0">-- Chọn quận huyện --</option>
                            @foreach ($districts as $district)
                                  <option value="{{$district->id}}">{{$district->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row form-group mb-3">
                    <div class="col-5 department-label">Phuờng xã</div>
                    <div class="col-7">
                        <select name="ward" id="ward" class="form-control textTxt textText" disabled>
                            <option value="0">Phải chọn quận huyện trước</option>
                        </select>
                    </div>
                </div>
                <div class="row form-group mb-1">
                    <div class="col-5 department-label">Tình trạng hoạt động</div>
                    <div class="col-7">
                        <select name="status" id="status" class="form-control textTxt textText" >
                            <option value="0">Tất cả</option>
                            <option value="1">Đang hoạt động</option>
                            <option value="2">Tạm dừng hoạt động</option>
                        </select>
                    </div>
                     
                </div>  
                <div class="alert-error text-center mb-5"></div>
                   
                 <div class="row">
                    <div class="col-md-5 offset-md-1">
                        <button class="btn btn-modal-reset"><img src="images/ic_btn_white_reset.svg" alt="ic_btn_white_reset"> Nhập lại</button>

                    </div>
                    <div class="col-md-5 ">
                        <button class="btn btn-primary btn-modal-save" id="btn-filter"> <img src="images/ic_btn_white_save.svg" alt="ic_btn_white_save">Lọc</button>
                    </div>
                </div>
            </div>
            
            </div>
        </div>
    </div>

    <script>
        $('document').ready(function(){

            var dateRegex = /^(?=\d)(?:(?:31(?!.(?:0?[2469]|11))|(?:30|29)(?!.0?2)|29(?=.0?2.(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00)))(?:\x20|$))|(?:2[0-8]|1\d|0?[1-9]))([-.\/])(?:1[012]|0?[1-9])\1(?:1[6-9]|[2-9]\d)?\d\d(?:(?=\x20\d)\x20|$))?(((0?[1-9]|1[012])(:[0-5]\d){0,2}(\x20[AP]M))|([01]\d|2[0-3])(:[0-5]\d){1,2})?$/;
            var currentDate = new Date();
            $("#filter #start_day").datepicker({
                changeMonth: true,
                changeYear: true,
                maxDate: currentDate,
                dateFormat: 'dd/mm/yy',
                
            });
            $("#filter #end_day").datepicker({
                changeMonth: true,
                changeYear: true,
                maxDate: currentDate,
                dateFormat: 'dd/mm/yy',
            });

            $("#filter #district").select2();
            $("#filter #ward").select2();

            // Xử lý lọc 

          

            
           $("#nameTable th input").keyup(function() {
                var name = $(this).val();
                if (name.length > 0) {
                    $(this).siblings(".delete-btn-field").css("display", "block");
                } else {
                    $(this).siblings(".delete-btn-field").css("display", "none");
                }
            });


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
                    url: 'business/multiDelete/',
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
                    url: 'business/delete/' + id,
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

            $("#filter #district").change(function(){
                var district_id = $(this).val();
                if(district_id == 0){
                     $("#filter #ward").val('0');
                    $("#filter #ward").attr('disabled', true);
                }else{
                    $("#filter #ward").attr('disabled', false);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{url('/')}}/business/getDataById",
                        data:{
                           id: district_id, 
                        }, 
                        method: "POST", 
                        success: function(data){
                            $("#filter #ward").html(data);
                        }, 
                        error: function(data){

                        }
                        
                    })

                }
            })

            $("#btn-filter").click(function(){
                $(".alert-error").text("");
                
                var  start_day = $("#start_day").val().trim();
                var  end_day = $("#end_day").val().trim();
                if(start_day != ''){
                    if(start_day.match(dateRegex)){
                        var arr = start_day.split("/");
                        start_day = arr[2]+'/'+arr[1]+'/'+arr[0];
                    
                    }else{
                        $(".alert-error").text("Thời gian nhập chưa đúng. Xin kiểm tra lại.");
                        return 
                    }
                }
                if(end_day != ''){
                    if(end_day.match(dateRegex)){
                        var arr = end_day.split("/");
                        end_day = arr[2]+'/'+arr[1]+'/'+arr[0];
                    
                    }else{
                        $(".alert-error").text("Thời gian nhập chưa đúng. Xin kiểm tra lại.");
                        return
                    }
                }
                if(start_day != '' && end_day != ''){
                    if(new Date(end_day) < new Date(start_day)){
                        $(".alert-error").text("Xin vui lòng nhập ngày hợp lệ.");
                        return
                    }
                }

                dataTable.draw();
                $("#filter").modal('hide');
                $("#start_day").val("");
                $("#end_day").val("");

                
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
                    class: "center-on-lower",
                    orderable:false,
                },
                {
                    data: 'address', 
                    class: "center-on-lower",
                    orderable:false,
                },
                {
                    data: 'ward', 
                    class: "center-on-lower",
                    orderable:false,

                },
                 {
                    data: 'district', 
                     class: "center-on-lower",
                    orderable:false,
                },
                {
                    data: 'day_register', 
                     class: "center-on-lower",
                    bSearchable : false,
                    orderable:false,

                },
                {
                    data: 'created_at', 
                    bSearchable : false
                },
                 {
                    data: 'type_investment', 
                     orderable:false,
                },
                {
                    data: 'status_action', 
                   
                     orderable:false,
                },
               
                {
                    data: 'action',
                    orderable:false,
                    bSearchable : false,
                    class: 'text-center', 
                    width: '10%',
                    render: function(data, type, row, meta){
                       var  html  = '<div style="width:60px;margin: 0 auto">';
                            html += '<span class="btn-edit mr-2" data-id="'+data+'" data-name = "'+row.name+'" title="sửa"><i class="far fa-edit"></i></span>';
                            html += '<a class="btn-delete mr-2" data-id="'+data+'"  title="xóa"><i class="fas fa-trash-alt"></i></a>';
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
                // responsive: true,
                // deferRender:    true,
                scrollX: true,
                ajax:{
                    url: 'business/getDataAjax',
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
                fnServerParams:function(aoData){
                    aoData.start_day = $("#filter #start_day").val().trim();
                    aoData.end_day = $("#filter #end_day").val().trim();
                    aoData.district = $("#filter #district").val().trim();
                    aoData.ward = $("#filter #ward").val().trim();
                    aoData.status = $("#filter #status").val();
                },
                drawCallback: function(){
                    addEventListener();
                }
               
              

            })
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
                    location.href = "business/edit/"+id;
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
                if(!$("button").hasClass("btn-loc")){
                     $("#nameTable_length").append('<button type="button" class="btn btn-secondary btn-loc"> <img src="/images/ic_tool_filter_white.svg" /> LỌC</button>');
                }
               

                $(".btn-loc").click(function(){
                    $("#filter").modal('show');
                })
            }

                
           
        })
    </script>
@endsection
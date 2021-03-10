@extends('master')
@section('content')
    <div id="ward">
        <div class="role">
            <div class="col-lg-11 pl-5">
                <h4 class="mb-5"> <span class="district-title">QUẢN TRỊ - PHƯỜNG XÃ  </span>
                @can("wards.store")
                    <button class="btn btn-primary add-new">
                        <img src="/images/ic_tool_add.svg" alt="ic_tool_add.svg">
                        <span>THÊM MỚI</span>
                    </button>
                @endcan
                </h4>
                <table class="table table-bordered" id="nameTable">
                    <thead>
                        <tr>
                            <th style="width: 1%"><input type="checkbox" name="" id="checkDeleteAll"></th>
                            <th class="text-center">Tên phường </th>
                            <th class="text-center">Tên quận huyện </th>
                            <th class="text-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- add modal --}}
      <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Thêm mới phường xã</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <div class="row form-group">
                    <div class="col-5 department-label">Tên phường xã <span class="text-danger">*</span> </div>
                    <div class="col-7">
                        <input type="text" name="name" id="ward-name" class="form-control textTxt" placeholder="Nhập tên" autocomplete="off">
                        <div class="alert-name alert-error"></div>
                    </div>
                </div>
                <div class="row form-group mb-5">
                    <div class="col-5 department-label">Tên quận huyện<span class="text-danger">*</span> </div>
                    <div class="col-7">
                        <select name="district-name" id="district-name" class="form-control textTxt">
                            <option value="">-- Chọn quận huyện --</option>
                            @foreach ($districts as $district)
                                <option value="{{$district->id}}">{{$district->name}}</option>
                            @endforeach
                        </select>
                        
                        <div class="alert-district-name alert-error"></div>
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
                <h5 class="modal-title" id="editModalLabel">Chỉnh sửa phường xã</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                 <div class="row form-group">
                    <div class="col-5 department-label">Tên phường xã <span class="text-danger">*</span> </div>
                    <div class="col-7">
                        <input type="hidden" id="id" value="">
                        <input type="text" name="name" id="ward-name-edit" class="form-control textTxt" placeholder="Nhập tên" autocomplete="off">
                        <div class="alert-name alert-error"></div>
                    </div>
                </div>
                <div class="row form-group mb-5">
                    <div class="col-5 department-label">Tên quận huyện<span class="text-danger">*</span> </div>
                    <div class="col-7">
                        <select name="district-name" id="district-name-edit" class="form-control textTxt">
                            <option value="">-- Chọn quận huyện --</option>
                            @foreach ($districts as $district)
                                <option value="{{$district->id}}" >{{$district->name}}</option>
                            @endforeach
                        </select>
                        
                        <div class="alert-district-name alert-error"></div>
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

            $("#district-name").select2({
                selectionCssClass:"wrap",
            });
            $("#district-name-edit").select2({
                selectionCssClass:"wrap",
            })
            
            $('#district-name').select2().on('select2:open', function(e){
                $('.select2-search__field').attr('placeholder', 'Search...');
            })
             $('#district-name-edit').select2().on('select2:open', function(e){
                $('.select2-search__field').attr('placeholder', 'Search...');
            })
            $(".add-new").click(function(){
               $("#addModal").modal('show');
            })

            $(".btn-modal-reset").click(function(){
                $("#district-name").val("");

            })
            $('.btn-close').click(function(){
                 $("#district-name").val("");
                 if($("#notification .message").val() != 'Xóa thất bại.'){
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
                var listId =   $("#deleteAllModal #list-id").text();
                $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: 'wards/multiDelete', 
                    data:{
                        listId : listId,
                        _method:'GET',
                    }, 
                    method:"POST", 
                    dataType:"json",
                    success: function(data){
                        $("#deleteAllModal").modal('hide');
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

            $("#delete-item").click(function(){
                var id = $("#deleteModal #id").val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url:'/wards/delete/'+ id,
                    data:{
                        id: id, 
                        _method:'DELETE',
                    }, 
                    dataType: 'json',
                    method:"POST",
                    success: function(data){
                        $("#deleteModal").modal('hide');
                        $("#notification").modal('show');
                        if(data['status'] == 200){
                            $("#notification .message").text(data['message']);
                        }else if(data['status'] == 204){
                            $("#notification .message").text(data['message']);
                        }
                    },
                    error: function(data){

                    }
                })
                    
            })
            $("#saveType").click(function(){
                var name =   $('#editModal #ward-name-edit').val();
                var id = $("#editModal #id").val();
                var district_id = $("#district-name-edit").val();
              
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: 'wards/update/'+ id,
                    data:{
                        name: name, 
                        id: id,
                        district_id: district_id,
                    },
                    method: "POST", 
                    dataType: 'json', 
                    success: function(data){
                        $("#editModal").modal('hide');
                        $("#notification").modal('show');
                        if(data['status'] == 200){
                            $("#notification .message").text(data['message']);
                        }else if(data['status'] == 404){
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
                $("#addModal .alert-error").val('');
                var name = $("#ward-name").val();
                var nameDistrict = $("#district-name").val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "/wards/store",
                    data:{
                        name: name,
                        district_id: nameDistrict,
                    }, 
                    method: 'POST',
                    dataType: 'json',
                    success: function(data){
                       $("#addModal").modal('hide');
                       $("#notification").modal('show');
                        if(data['status'] == 200){
                            $("#notification .message").text(data['message']);
                        }else if(data['status'] == 404){
                            $("#notification .message").text(data['message']);
                        }
                    }, 
                    error: function(data){
                        console.log(data);
                        $.each(data.responseJSON.errors, function(index, value){
                            $("#addModal .alert-"+index).html(value);
                        })
                    }
                })
            })
           

            var dataObject = [
                {
                    data: 'action', 
                    class:'text-center',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row, meta ){
                        return '<input type="checkbox" class="check-item-delete" data-id="'+data+'" />'
                    }

                }, 
                {
                    data: 'name',
                    width: '40%'

                }, 
                {
                    data: 'district_name',
                    width: '30%'

                },
                {
                    data: 'action',
                    width: '29%',
                    orderable: false,
                    searchable: false,
                    class: 'text-center',
                    render: function(data, type, row, meta){
                        var html = '';
                        @can("wards.edit")
                        html += '<a data-id="'+data+'" data-name="'+row.name+'" data-district="'+row.district_id+'" title="sửa" class="btn-edit mr-2"><i class="far fa-edit"></i></a>';
                        @endcan
                        @can("wards.delete")
                        html +=  '<a data-id="'+data+'"  class="btn-delete mr-2" title="xóa"><i class="fas fa-trash-alt"></i></a>';
                        @endcan
                        return html;
                    }

                }
            ]
            var dataTable = $("#nameTable").DataTable({
                serverSide: true,
                stateSave: false,
                searching: true,
                responsive:true,
                aaSorting: [],
                listCheck:[],
                ajax:{
                    url: '/wards/getDataAjax',
                },
                columns: dataObject,
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
                    sInfoFiltered: "",
                    sInfoEmpty: "",
                    info: "Hiển thị _START_ - _END_ /_TOTAL_ bản ghi",
                    sZeroRecords: "Không tìm thấy bản ghi tìm kiếm",
                },
                 drawCallback: function(){
                    addEventListener();    
                },

            })
            dataTable.draw();

            var check = true;
            function addEventListener(){
                var html = '@can("wards.delete_multi")<div class="col-sm-12 col-md-3"><button class="btn btn-danger deleteAll"><img src="images/ic_btn_white_delete.svg" class="ic-delete"/>Xóa tất cả</button></div>@endcan';
                $("#nameTable_wrapper .row:nth-child(3) .col-sm-12.col-md-5").removeClass('col-md-5').addClass('col-md-3  text-footer-table');
                $("#nameTable_wrapper .row:nth-child(3) .col-sm-12.col-md-7").removeClass('col-md-7').addClass('col-md-6');
                if(check == true){
                    $('#nameTable_wrapper .row:nth-child(3) .text-footer-table').before(html);
                    check = false;
                }
                $(".btn-edit").click(function(){
                    $("#editModal .alert-error").text('');
                    $("#editModal").modal('show');
                    var name = $(this).attr('data-name');
                    var id = $(this).attr('data-id');
                    var district_id = $(this).attr('data-district');
                    $('#editModal #ward-name-edit').val(name);
                    $("#editModal #id").val(id);
                    $('#district-name-edit').val(district_id).trigger('change');

                })

                $(".btn-delete").click(function(){
                    $("#deleteModal").modal('show');
                    var id = $(this).attr('data-id');
                    $("#deleteModal #id").val(id);
                })
                $("#nameTable_filter input[type=search]").attr('placeholder', 'Tìm kiếm...');

                $("#checkDeleteAll").click(function(){
                    if($(this).is(":checked")){
                        $.each($('.check-item-delete'), function(index, value){
                            $('.check-item-delete').prop('checked', true);
                        })
                    }else{
                        $.each($('.check-item-delete'), function(index, value){
                            $('.check-item-delete').prop('checked', false);
                        })
                    }
                })
                $(".deleteAll").click(function(){ 
                    listCheck = [];
                     $.each($('.check-item-delete'), function(index, value){
                         if($(this).is(':checked') == true){
                              listCheck.push($(this).attr('data-id'));
                         }
                     });
                    $("#deleteAllModal").modal('show');
                    $("#deleteAllModal #list-id").text(listCheck);

                })
            }
        })
    </script>
@endsection
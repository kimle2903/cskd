@extends('master')
@section('content')
<style>
    .select2-container--default .select2-selection--single .select2-selection__rendered{
       /* line-height: 16px !important; */
   }
   .select2-container .select2-selection--single{
       height: 42px;
   }
   .select2-container--default .select2-selection--single .select2-selection__arrow{
       top: 10px
   }
   .select2-selection__rendered{
       padding-top: 10px;
   }
</style>
   <div id="add-violate">
       <div class="row">
           <div class="col-md-11 pl-5">
               <h4 class="mb-5">
                   <span class="type-investment-title">KIỂM TRA & XỬ LÝ VI PHẠM</span>
                   <a href="{{url('/')}}/violates" class="btn btn-primary list-violate"> <img src="/images/ic_manage.svg" alt="ic_manage.svg"> <span>QUẢN LÝ</span> </a>
               </h4>
               <div class="wrap-info">
                    <div class="row my-4">
                       <div class="col-md-5 offset-md-1">
                           <div class="form-group">
                               <label for=""><img src="/images/ic_blue_business_name.svg" alt=""> <span class="title-info">Tên cơ sở Kinh doanh</span> </label>
                                <select name="busines_name" id="busines_name" class="form-control textText" >
                                   <option value="">-- Chọn --</option>
                                    @foreach ($business as $busines)
                                        <option value="{{$busines->id}}">{{$busines->name}}</option>
                                    @endforeach
                               </select>
                               <div class="alert-busines_name alert-error"></div>
                           </div>
                       </div>
                       <div class="col-md-5">
                           <div class="form-group">
                               <label for="" class="" style="padding-bottom: 7px"><img src="/images/ic_blue_business_type.svg" alt=""> <span class="title-info ">Ngày kiểm tra </span> </label>
                                <input type="text" name="day_check" id="day_check" class="form-control textText" placeholder="Vui lòng nhập ngày kiểm tra" autocomplete="off">
                                <div class="alert-day_check alert-error"></div>
                           </div>
                       </div>
                    </div>
                    <div class="row my-4">
                       <div class="col-md-5 offset-md-1">
                           <div class="form-group">
                               <label for=""><img src="/images/ic_blue_location.svg" alt=""> <span class="title-info">Lĩnh vực vi phạm</span> </label>
                           </div>
                       </div>
                       <div class="col-md-5">
                           <div class="form-group">
                                <select name="error_violate" id="error_violate" class="form-control textText" >
                                   <option value="">-- Chọn --</option>
                                    @foreach ($error_violates as $error)
                                        <option value="{{$error->id}}">{{$error->name}}</option>
                                    @endforeach
                                </select>
                              
                                 <div class="alert-error_violate alert-error"></div>
                           </div>
                       </div>
                    </div>
                    <div class="row my-4">
                        <div class="col-md-10 offset-md-1">
                            <div class="form-group">
                            <label for="" class="" style="padding-bottom: 7px"><img src="/images/ic_blue_business_type.svg" alt=""> <span class="title-info ">Chi tiết lỗi </span> </label>
                            <textarea name="note_error" id="note_error" cols="30" rows="4" placeholder="Chi tiết lỗi" class="form-control"></textarea>
                            <div class="alert-note_error alert-error"></div>
                        </div>
                        </div>
                        
                    </div>
                  
                   
                   <div class="row">
                        <div class="col-md-3 offset-md-3">
                            <button class="btn btn-modal-reset"><img src="/images/ic_btn_white_reset.svg" alt="ic_btn_white_reset"> Nhập lại</button>

                        </div>
                        <div class="col-md-3 ">
                            <button class="btn btn-primary btn-modal-save" id="add-new"> <img src="/images/ic_btn_white_save.svg" alt="ic_btn_white_save">Lưu</button>
                        </div>
                    </div>
               </div>
           </div>
       </div>
   </div>
   
   <script>
       $(document).ready(function(){
            $("#busines_name").select2();
            $("#error_violate").select2();

            var currentDate = new Date();
            $("#day_check").datepicker({
                changeMonth: true,
                changeYear: true,
                maxDate: currentDate,
            });

            $(".btn-modal-reset").click(function(){
                $(".alert-error").text('');
                $("#busines_name").val(null).trigger('change');
                $("#day_check").val(null);
                $("#note_error").val("");
                $("#error_violate").val("").trigger('change');
            })
            $("#add-new").click(function(){
                var name =  $("#busines_name").val();
                var day_check =  $("#day_check").val();
                var error_violate = $("#error_violate").val();
                var note_error =  $("#note_error").val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                })
                $.ajax({
                    url: '{{url("/")}}/violates/store', 
                    data:{
                        busines_name: name,
                        day_check: day_check,
                        error_violate:error_violate,
                        note_error:note_error, 
                    }, 
                    dataType: 'json', 
                    method: 'POST', 
                    success:function(data){
                        if(data['status'] == 200){
                            swal({
                                text: "Thêm mới thành công",
                                icon: "success",
                                buttons: {
                                    cancel: "Thêm mới",
                                    catch: {
                                        text: "Danh sách",
                                        value: "catch",
                                    },
                                }
                            }).then((value) => {
                                switch (value){
                                    case "catch": window.location.href = "{{url('/')}}/violates"; break;
                                    default:  window.location.href = "{{url('/')}}/violates/create";
                                };
                                });
                        }
                    },
                    error: function(data){
                        $.each(data.responseJSON.errors, function(index, value){
                        $(".alert-"+index).html(value);
                    })
                    }
                })
            })
       })
       
  </script>
@endsection

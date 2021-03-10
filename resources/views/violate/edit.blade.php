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
   <div id="edit-violate">
       <div class="row">
           <div class="col-md-11 pl-5">
               <h4 class="mb-5">
                   <span class="type-investment-title">KIỂM TRA & XỬ LÝ VI PHẠM</span>
                   <a href="{{url('/')}}/violates" class="btn btn-primary list-violate"> <img src="/images/ic_manage.svg" alt="ic_manage.svg"> <span>QUẢN LÝ</span> </a>
               </h4>
               <div class="wrap-info">
                    <div class="row mt-5 mb-4">
                       <div class="col-md-5 offset-md-1">
                           <div class="form-group">
                               <label for=""><img src="/images/ic_blue_business_name.svg" alt=""> <span class="title-info">Tên cơ sở Kinh doanh</span> </label>
                                <select name="busines_name" id="busines_name" class="form-control textText" >
                                   <option value="">-- Chọn --</option>
                                    @foreach ($business as $busines)
                                        <option value="{{$busines->id}}" @if ($busines->id == $violate->busines_id)
                                            selected
                                        @endif>{{$busines->name}}</option>
                                    @endforeach
                               </select>
                               <div class="alert-busines_name alert-error"></div>
                           </div>
                       </div>
                       <div class="col-md-5">
                           <div class="form-group">
                               <label for="" class="" style="padding-bottom: 7px"><img src="/images/ic_blue_calendar.svg" alt="ic_blue_calendar.svg"> <span class="title-info ">Ngày kiểm tra </span> </label>
                                <input type="text" name="day_check" id="day_check" class="form-control textText" placeholder="Vui lòng nhập ngày kiểm tra" autocomplete="off" value="{{$violate->day_check}}">
                                <div class="alert-day_check alert-error"></div>
                           </div>
                       </div>
                    </div>
                    <div class="row my-4">
                       <div class="col-md-5 offset-md-1">
                           <div class="form-group">
                               <label for=""><img src="/images/ic_blue_infringe.svg" alt=""> <span class="title-info">Lĩnh vực vi phạm</span> </label>
                           </div>
                       </div>
                       <div class="col-md-5">
                           <div class="form-group">
                                <select name="error_violate" id="error_violate" class="form-control textText" >
                                   <option value="">-- Chọn --</option>
                                    @foreach ($error_violates as $error)
                                        <option value="{{$error->id}}" @if ($error->id == $violate->error_violate_id)
                                            selected
                                        @endif>{{$error->name}}</option>
                                    @endforeach
                                </select>
                                 <div class="alert-error_violate alert-error"></div>
                           </div>
                       </div>
                    </div>
                    <div class="row my-4">
                        <div class="col-md-10 offset-md-1">
                            <div class="form-group">
                            <label for="" class="" style="padding-bottom: 7px"><img src="/images/ic_blue_note.svg" alt=""> <span class="title-info ">Chi tiết lỗi </span> </label>
                            <textarea name="note_error" id="note_error" cols="30" rows="4" placeholder="Chi tiết lỗi" class="form-control">{{$violate->note_error_violate}}</textarea>
                            <div class="alert-note_error alert-error"></div>
                        </div>
                        </div>
                        
                    </div>
                    <div class="row my-4">
                       <div class="col-md-5 offset-md-1">
                           <div class="form-group">
                               <label for=""><img src="/images/ic_blue_infringe.svg" alt=""> <span class="title-info">Cấp xử lý</span> </label>
                           </div>
                       </div>
                       <div class="col-md-5">
                           <div class="form-group">
                                <select name="processing_level_id" id="processing_level_id" class="form-control textText" >
                                   <option value="">-- Chọn --</option>
                                    @foreach ($process_levels as $process)
                                        <option value="{{$process->id}}" @if ($process->id == $violate->process_level_id)
                                            selected
                                        @endif>{{$process->name}}</option>
                                    @endforeach
                                </select>
                                 <div class="alert-processing_level_id alert-error"></div>
                           </div>
                       </div>
                    </div>
                    <div class="row my-4">
                       <div class="col-md-5 offset-md-1">
                           <div class="form-group">
                               <label for=""><img src="/images/ic_blue_officer.svg" alt=""> <span class="title-info">Người ra quyết định xử lý vi phạm</span> </label>
                               <select name="user_decision_id" id="user_decision_id" class="form-control textText" >
                                   <option value="">-- Chọn --</option>
                                    @foreach ($users as $user)
                                        <option value="{{$user->id}}" @if ($user->id == $violate->user_decision_id)
                                            selected
                                        @endif>{{$user->name}}</option>
                                    @endforeach
                                </select>
                                 <div class="alert-user_decision_id alert-error"></div>
                           </div>
                       </div>
                       <div class="col-md-5">
                           <div class="form-group">
                                <label for=""><img src="/images/ic_blue_officer.svg" alt=""> <span class="title-info">Cán bộ tham mưu xử lý vi phạm</span> </label>
                                <select name="user_handler_id" id="user_handler_id" class="form-control textText" >
                                   <option value="">-- Chọn --</option>
                                    @foreach ($users as $user)
                                        <option value="{{$user->id}}" @if ($user->id == $violate->user_handler_id)
                                            selected
                                        @endif>{{$user->name}}</option>
                                    @endforeach
                                </select>
                                 <div class="alert-user_handler_id alert-error"></div>
                           </div>
                       </div>
                    </div>
                      <div class="row my-4">
                       <div class="col-md-5 offset-md-1">
                           <div class="form-group">
                               <label for=""><img src="/images/ic_blue_process_list.svg" alt=""> <span class="title-info">Hình thức xử lý vi phạm</span> </label>
                               <select name="form_violate" id="form_violate" class="form-control textText" >
                                   <option value="">-- Chọn --</option>
                                    @foreach ($form_violates as $form)
                                        <option value="{{$form->id}}" @if ($form->id == $violate->form_violate_id)
                                            selected
                                        @endif>{{$form->name}}</option>
                                    @endforeach
                                </select>
                                 <div class="alert-form_violate alert-error"></div>
                           </div>
                       </div>
                       <div class="col-md-5">
                           <div class="form-group">
                                <label for=""><img src="/images/ic_blue_process_status.svg" alt=""> <span class="title-info">Tình trạng xử lý vi phạm</span> </label>
                                <select name="status" id="status" class="form-control textText" >
                                   <option value="1" @if ($violate->status == 1)
                                       selected
                                   @endif>Chưa xử lý</option>
                                   <option value="2"  @if ($violate->status == 2)
                                       selected
                                   @endif>Đã xử lý</option>
                                </select>
                                 <div class="alert-status alert-error"></div>
                           </div>
                       </div>
                    </div>
                    <div class="row my-4">
                        <div class="col-md-10 offset-md-1">
                            <div class="form-group">
                            <label for="" class="" style="padding-bottom: 7px"><img src="/images/ic_blue_note.svg" alt=""> <span class="title-info ">Chi tiết lỗi </span> </label>
                            <textarea name="note_form_violate" id="note_form_violate" cols="30" rows="4" placeholder="Chi tiết lỗi" class="form-control">{{$violate->note_form_violate}}</textarea>
                            <div class="alert-note_form_violate alert-error"></div>
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
            var violate = {!! $violate !!}
            console.log(violate);
            $("#busines_name").select2();
            $("#error_violate").select2();
            $("#processing_level_id").select2();
            $("#user_decision_id").select2();
            $("#user_handler_id").select2();
            $("#form_violate").select2();
            $("#status").select2();

            var currentDate = new Date();
            $("#day_check").datepicker({
                changeMonth: true,
                changeYear: true,
                maxDate: currentDate,
            });

            $(".btn-modal-reset").click(function(){
                $(".alert-error").text('');
                location.reload();
            })

            $(".btn-modal-save").click(function(){
                 $(".alert-error").text('');
                var data = {
                    busines_name : $("#busines_name").val(),
                    day_check: $("#day_check").val(),
                    error_violate: $("#error_violate").val(),
                    note_error: $("#note_error").val(),
                    processing_level_id : $("#processing_level_id").val(),
                    user_decision_id : $("#user_decision_id").val(),
                    user_handler_id: $("#user_handler_id").val(),
                    form_violate : $("#form_violate").val(),
                    status : $("#status").val(),
                    note_form_violate: $("#note_form_violate").val(),
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{url("/")}}/violates/update/'+ violate['id'],
                    data: data,
                    dataType: 'json', 
                    method: 'POST',
                    success: function(data){
                        if(data['status'] == 200){
                        swal({
                            text: data['message'],
                            icon: "success",
                            button: "Thoát",
                            })
                        .then(() => {
                            location.href = '/violates'
                        });
                        }else{
                            swal({
                                text: "Thêm mới thất bại.",
                                icon: "warning",
                                button: "Thoát",
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

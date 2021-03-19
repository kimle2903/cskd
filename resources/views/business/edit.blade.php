@extends('master')
@section('content')
<style>
   .select2-container--default .select2-selection--single .select2-selection__rendered{
       line-height: 16px !important;
   }
</style>
   <div id="add-business">
       <div class="row">
           <div class="col-md-11 pl-5">
               <h4 class="mb-5">
                   <span class="type-investment-title">THÔNG TIN CƠ SỞ KINH DOANH</span>
                   <a href="{{url('')}}/business" class="btn btn-primary list-business"> <img src="/images/ic_manage.svg" alt="ic_manage.svg"> <span>QUẢN LÝ</span> </a>
               </h4>
               <div class="wrap-info">
                   <div class="row my-4">
                       <div class="col-md-5 offset-md-1">
                           <div class="form-group">
                               <label for=""><img src="/images/ic_blue_business_name.svg" alt=""> <span class="title-info">Tên cơ sở Kinh doanh</span> </label>
                               <input type="text" name="name" id="name" class="form-control textText" placeholder="Vui lòng nhập tên cơ sở kinh doanh" autocomplete="off" value="{{$busines->name}}">
                               <div class="alert-name alert-error"></div>
                           </div>
                       </div>
                       <div class="col-md-5">
                           <div class="form-group">
                               <label for="" class="" style="padding-bottom: 7px"><img src="/images/ic_blue_business_type.svg" alt=""> <span class="title-info ">Loại hình đầu tư </span> </label>
                               <select name="type-investment" id="type-investment-id" class="form-control textText" >
                                   <option value="">-- Vui lòng nhập loại hình đầu tư--</option>
                                   @foreach ($types as $type)
                                       <option value="{{$type->id}}" @if($type->id == $busines->type_investment_id) selected @endif >{{$type->name}}</option>
                                   @endforeach
                               </select>
                                <div class="alert-type_investment_id alert-error"></div>
                           </div>
                       </div>
                   </div>
                   <div class="row my-4">
                       <div class="col-md-5 offset-md-1">
                           <div class="form-group">
                               <label for=""><img src="/images/ic_blue_location.svg" alt=""> <span class="title-info">Quận/huyện</span> </label>
                              <select name="district_id" id="district_id" class="form-control textText" >
                                   <option value="">-- Chọn quận/huyện--</option>
                                   @foreach ($districts as $district)
                                       <option value="{{$district->id}}" @if($district->id == $busines->district_id) selected @endif>{{$district->name}}</option>
                                   @endforeach
                               </select>
                                <div class="alert-district_id alert-error"></div>
                           </div>
                       </div>
                       <div class="col-md-5">
                           <div class="form-group">
                               <label for="" class=""><img src="/images/ic_blue_location.svg" alt="ic_blue_location.svg"> <span class="title-info ">Phường/Xã/Thị Trấn </span> </label>
                               <select name="ward_id" id="ward_id" class="form-control textText" >
                                
                                   <option value="">-- Chọn phường/xã/thị trấn--</option>
                                   @foreach ($wards as $ward)
                                       <option value="{{$ward->id}}"  @if($ward->id == $busines->ward_id) selected @endif>{{$ward->name}}</option>
                                   @endforeach
                               </select>
                                <div class="alert-ward_id alert-error"></div>
                           </div>
                       </div>
                   </div>

                   <div class="row my-4">
                       <div class="col-md-5 offset-md-1">
                           <div class="form-group">
                               <label for=""><img src="/images/ic_blue_business_name.svg" alt=""> <span class="title-info">Địa chỉ doanh nghiệp</span> </label>
                               <input type="text" name="address" id="address" class="form-control textText" placeholder="Vui lòng nhập địa chỉ doanh nghiệp" autocomplete="off" value="{{$busines->address}}">
                                <div class="alert-address alert-error"></div>
                           </div>
                       </div>
                       <div class="col-md-5">
                           <div class="form-group">
                               <label for="" class=""><img src="/images/ic_blue_business_code.svg" alt=""> <span class="title-info ">Mã số doanh nghiệp</span> </label>
                               <input type="text" name="code" id="code" class="form-control textText" placeholder="Vui lòng nhập mã số doanh nghiệp" autocomplete="off" value="{{$busines->code}}">
                                <div class="alert-code alert-error"></div>
                           </div>
                       </div>
                   </div>

                   <div class="row my-4">
                       <div class="col-md-5 offset-md-1">
                           <div class="form-group">
                               <label for=""><img src="/images/ic_blue_calendar.svg" alt=""> <span class="title-info">Ngày đăng kí kinh doanh</span> </label>
                               <input type="text" name="day_register" id="day_register" class="form-control textText" placeholder="Vui lòng nhập ngày đăng ký kinh doanh" autocomplete="off" value="{{$busines->day_register}}">
                                <div class="alert-day_register alert-error"></div>
                           </div>
                       </div>
                       <div class="col-md-5">
                           <div class="form-group">
                               <label for="" class=""><img src="/images/ic_blue_status.svg" alt=""> <span class="title-info ">Tình trạng hoạt động </span> </label>
                               
                                <select name="status" id="status" class="form-control textText" >
                                    <option value="1">Đang hoạt động</option>
                                    <option value="2">Ngừng hoạt động</option>
                               </select>
                                <div class="alert-status alert-error"></div>
                           </div>
                       </div>
                   </div>
                   <div class="row my-4">
                       <div class="col-md-5 offset-md-1">
                           <div class="form-group">
                               <label for=""><img src="/images/ic_blue_people.svg" alt="ic_blue_people.svg"> <span class="title-info">Số người</span> </label>
                           </div>
                       </div>
                       <div class="col-md-5">
                           <div class="form-group">
                               <input type="text" name="number_people" id="number_people" class="form-control textText" placeholder="Vui lòng nhập số người"   autocomplete="off" value="{{$busines->number_people}}">
                                <div class="alert-number_people alert-error"></div>
                           </div>
                       </div>
                   </div>
                    <div class="row my-4">
                       <div class="col-md-5 offset-md-1">
                           <div class="form-group">
                               <label for=""><img src="/images/ic_blue_people.svg" alt=""> <span class="title-info">Số Giấy chứng nhận Kinh doanh</span> </label>
                               <input type="text" name="mumber_certificate" id="mumber_certificate" class="form-control textText" placeholder="Vui lòng nhập số giấy đăng ký kinh doanh" autocomplete="off" value="{{$busines->number_certificate}}">
                                <div class="alert-number_certificate alert-error"></div>
                           </div>
                       </div>
                       <div class="col-md-5">
                           <div class="form-group">
                               <label for="" class=""><img src="/images/ic_blue_calendar.svg" alt=""> <span class="title-info ">Ngày cấp Giấy chứng nhận Kinh doanh </span> </label>
                               <input type="text" name="day_mumber_certificate" id="day_mumber_certificate" class="form-control textText" placeholder="Vui lòng nhập ngày cấp"   autocomplete="off" value="{{$busines->day_number_certificate}}">
                                <div class="alert-day_number_certificate alert-error"></div>
                           </div>
                       </div>
                   </div>

                   <div class="row my-4">
                       <div class="col-md-5 offset-md-1">
                           <div class="form-group">
                               <label for=""><img src="/images/ic_blue_business_represent.svg" alt=""> <span class="title-info">Người đại diện đăng kí Kinh doanh</span> </label>
                               <input type="text" name="name_user" id="name_user" class="form-control textText" placeholder="Vui lòng nhập tên người đại diện" autocomplete="off" value="{{$user->name}}">
                               <div class="alert-name_user alert-error"></div>
                           </div>
                           <div class="form-group">
                               <input type="text" name="house_hold" id="house_hold" class="form-control textText" placeholder="Số Hộ khẩu của người đại diện" autocomplete="off" value="{{$user->house_hold}}">
                                <div class="alert-house_hold alert-error"></div>
                               
                           </div>
                       </div>
                       <div class="col-md-5">
                          
                            <div class="form-group">
                                <label for="" class="cus-mb-lable"></label>
                               <input type="text" name="position_business" id="position_business" class="form-control textText" placeholder="Chức danh của người đại diện"  value="{{$user->position_business}}">
                                <div class="alert-position_business alert-error"></div>
                           </div>
                       </div>
                   </div>
                   
                   <div class="row">
                        <div class="col-md-3 offset-md-3">
                            <button class="btn btn-modal-reset"><img src="/images/ic_btn_white_reset.svg" alt="ic_btn_white_reset"> Nhập lại</button>

                        </div>
                        <div class="col-md-3 ">
                            <button class="btn btn-primary btn-modal-save" id="edit-busines"> <img src="/images/ic_btn_white_save.svg" alt="ic_btn_white_save">Lưu</button>
                        </div>
                    </div>
               </div>
           </div>
       </div>
   </div>
   <script>
      
       $(document).ready(function(){
            $("#type-investment-id").select2();
            $("#district_id").select2();
            $("#ward_id").select2();
        var currentDate = new Date();
        $( function() {
            $( "#day_register").datepicker({
                changeMonth: true,
                changeYear: true,
                maxDate: currentDate,
                yearRange: "1970:{{ date('Y')"
               
            }); 
            $("#day_mumber_certificate").datepicker({
                changeMonth: true,
                changeYear: true,
                maxDate: currentDate,
                yearRange: "1970:{{ date('Y')"
            })
           
        } );

        var busines = {!! $busines !!};
        var user = {!!$user!!}

        $('#district_id').change(function () {
            var optionSelected = $(this).find("option:selected");
            if(optionSelected.val()> 0){
                alert(optionSelected.val() + " = "+ $("#ward_id").find("option:selected").val() )
                    if(optionSelected.val() == busines['district_id']){
                        
                    }else{
                        // alert(123);
                        var id = optionSelected.val();
                    $("#ward_id").prop('disabled', false);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '/business/getDataById',
                        data:{
                            id: id
                        }, 
                        method: "POST", 
                        dataType: 'html', 
                        success:function(data){
                            $("#ward_id").html(data);
                        }
                        
                    })
                    }
                    
                
            }else{
               $("#ward_id").prop('disabled', true);
            }
         
        });

        $(".btn-modal-reset").click(function(){
        
            console.log(busines,user);
            $(".alert-error").html("");
            // $("#name").val(busines['name']);
            // $("#type-investment-id").val(busines['type_investment_id']).trigger('change');
            // $("#district_id").val(busines['district_id']).trigger('change');
            // $("#ward_id").val(busines['ward_id']).trigger('change');
            // $("#status").val(busines['status']).trigger('change');
            // $("#address").val(busines['address']);
            // $("#code").val(busines['code']);
            // $("#day_register").val(busines['day_register']);
            // $("#number_people").val(busines['number_people']);
            // $("#mumber_certificate").val(busines['number_certificate']);
            // $("#day_mumber_certificate").val(busines['day_number_certificate']);
            // $("#name_user").val(user['name']);
            // $("#house_hold").val(user['house_hold']);
            // $("#position_business").val(user['position_business']);
            location.reload();
            // alert($("#ward_id").val());
        })

        $("#edit-busines").click(function(){
            $(".alert-error").html("");
           var data = {
               name:  $("#name").val(),
               type_investment_id: $("#type-investment-id").val(),
               district_id:$("#district_id").val(),
               ward_id:  $("#ward_id").val(),
               address: $("#address").val(),
               code:$("#code").val(),
               day_register:$("#day_register").val(),
               number_people:$("#number_people").val(),
               number_certificate:$("#mumber_certificate").val(),
               day_number_certificate:$("#day_mumber_certificate").val(),
               name_user: $("#name_user").val(),
               house_hold:$("#house_hold").val(),
               position_business: $("#position_business").val(),
               status: $("#status").val()
           }
           $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/business/update/'+busines['id'],
                data:data,
                method: "POST", 
                dataType: 'json', 
                success:function(data){
                    if(data['status'] == 200){
                        swal({
                            title: "Thông báo!",
                            text: data['message'],
                            icon: "success",
                            button: "Thoát",
                            })
                        .then(() => {
                            location.href = '/business'
                        });
                    }else{
                        swal({
                            title: "Thông báo!",
                            text: "Cập nhật thất bại.",
                            icon: "warning",
                            button: "Thoát",
                        });
                    }
                }, 
                error: function(data){
                    $.each(data.responseJSON.errors, function(index, value){
                        $("#add-business .wrap-info .alert-"+index).html(value);
                    })
                }
                
            })
               
        })
       })
       

   </script>
@endsection
@extends('master')
@section('content')
 <style>
       #change-password .user-content{
            border: 1px solid #ced4da;
            border-radius: 6px
        }
      
        #change-password .cus-border{
            border: none;
            border-radius: 0px !important;
            border-bottom: 1px solid #ced4da;
            color:  #495057;
        }
        .form-group label{
            color: #3384ff;
            font-weight: bold;
            margin-bottom: 0px;
        }
        #change-password .btn-reset, #change-password .btn-save{
            padding: 0px 12px;
        }
        .select2-container .select2-selection--single{
            height: 36px;
        }
        
       
 </style>
    <div id="change-password" class="ml-4">
        <div class="row">
            <div class="col-md-9">
                <div class="user-content">
                    <div action="" id="change-info">
                        <div class="text-center mt-5 ">
                            <h4 class="title-change">Đổi mật khẩu</h4>
                        </div>
                        <div class="row mt-5">
                            <div class="col-md-5 offset-md-1">
                               <div class="form-group">
                                   <label for=""><img src="/images/ic_blue_mail.svg" alt="">Email</label>
                                   <input type="text" name="email" id="email" class="form-control cus-border" value="{{$user->email}}" disabled>
                               </div>
                            </div>
                            <div class="col-md-5">
                               <div class="form-group">
                                   <label for=""><img src="/images/ic_blue_officer.svg" alt="">Mật khẩu cũ</label>
                                   <input type="password" name="old_password" id="old_password" class="form-control cus-border" placeholder="******" value="">
                                   <div class="alert-old_password alert-error"></div>
                               </div>
                            </div>
                        </div>
                         <div class="row mb-4 mt-4">
                            <div class="col-md-5 offset-md-1">
                               <div class="form-group">
                                   <label for=""><img src="/images/ic_blue_mail.svg" alt="">Mật khẩu mới</label>
                                   <input type="password" name="password" id="password" class="form-control cus-border"  placeholder="******"  >
                                     <div class="alert-password alert-error"></div>
                               </div>
                            </div>
                            <div class="col-md-5">
                               <div class="form-group">
                                   <label for=""><img src="/images/ic_blue_officer.svg" alt="">Nhập lại mật khẩu</label>
                                   <input type="password" name="confirm_password" id="confirm_password" class="form-control cus-border"  placeholder="******" >
                                     <div class="alert-confirm_password alert-error"></div>
                               </div>
                            </div>
                            
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-3 offset-md-3">
                                <button class="btn btn-danger btn-reset w-100"> <img src="/images/ic_btn_white_reset.svg" alt="ic_btn_white_reset.svg"> Nhập lại</button>
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-primary btn-save w-100"> <img src="/images/ic_btn_white_save.svg" alt=""> Lưu</button>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                @include('menu-right')
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $(".btn-reset").click(function(){
                $(".alert-error").text("");
                $("#old_password").val('');
                $("#password").val('');
                $("#confirm_password").val('');
            });
        
            $(".btn-save").click(function(){
                $(".alert-error").text("");
                var old_password =  $("#old_password").val();
                var password = $("#password").val();
                var confirm_password =  $("#confirm_password").val();
                
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '{{url("/")}}/users/do-change-password',
                    data:{
                        old_password: old_password,
                        password: password,
                        confirm_password: confirm_password,
                    }, 
                    method: 'POST', 
                    success: function(data){
                        if(data['status'] == 200){
                            swal({
                                text: "Cập nhật thành công.",
                                icon: "success",
                                button: "Đóng",
                            });
                        }else if(data['status'] == 204){
                            $(".alert-old_password").text("Mật khẩu chưa đúng.");
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
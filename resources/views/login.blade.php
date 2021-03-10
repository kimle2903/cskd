@extends('master')
@section('content')
    <style>
        .header-login .title{
            margin-top: 2%;
            color: #3384ff
        }
        .header-login .title h5{
            font-weight: 300;
        }
        .header-login .title h2{
            font-family: SFUAuchonRegular;
        }
        #login .bg-login-content{
            background: url("/images/img_login_bg.svg") no-repeat;
            background-size:cover;
            max-width: 100%;
            padding: 80px 30px;
        }
        #login .title-login{
            margin-bottom: 30px;
            color: #fff
        }
        #login .form-group .input-group-text{
            border-radius: 0px;
            border-top-left-radius: 0.25rem;
            border-bottom-left-radius: 0.25rem;
        }
        .input-group-text img{
            height: 20px;
        }
        #login .user-help{
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #fff;
        }
        #login .user-help #check-login{
            border: 1px solid #fff;
            width: 17px;
            height: 17px;
            margin-right: 5px;
        }
        #login .save-status{
            display: flex;
            align-items: center;
        }
        #login .foget-password{
            color: #dc3545;
            text-decoration: underline;
            
        }
        #login .input-group{
            position: relative
        }
        #login .input-group .ic-show-hide{
            position: absolute;
            z-index: 10;
            top: 8px;
            right: 16px;
           width: 20px;
           height: 20px;
        }
    </style>
    <div id="login">
        <div class="row header-login">
            <div class="col-md-2 offset-md-2">
                    <img src="/images/img_logo_cabd.png" class="w-100" alt="img_logo_cabd.png">
            </div>
            <div class="col-md-8 title">
                <h5>CÔNG AN TỈNH BÌNH DƯƠNG</h5>
                <h2>HỆ THỐNG QUẢN LÝ CƠ SỞ KINH DOANH</h2>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-8 offset-md-2  bg-login-content login-content text-center">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <h4 class="title-login">ĐĂNG NHẬP</h4>
                            <div class="form-group">
                                <div class="input-group ">
                                    <span class="input-group-text" id="ic-name"><img  src="/images/ic_account.png" alt="image/ic_account.png"></span>
                                    <input type="text" class="form-control" placeholder="Tài khoản"  name="name" id="name" aria-describedby="ic-name" autocomplete="off">
                                    
                                </div>
                                <div class="alert-email alert-error mb-4"></div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-text" id="ic-password"> <img src="/images/ic_password.png" alt="ic_password.png"></span>
                                    <input type="password" class="form-control" placeholder="Mật khẩu"  name="password" id="password" autocomplete="off">
                                    <img src="/images/ic_password_visible.svg" alt="" class="ic-show-hide ic-show" style="display: none" >
                                    <img src="/images/ic_password_invisible.svg" alt="" class="ic-show-hide ic-hide mb-4" >
                                    
                                </div>
                                <div class="alert-password alert-error">erwerwerwe</div>
                            </div>
                            <div class="form-group user-help">
                                <div class="save-status">
                                    <input type="checkbox" name="check-login" id="check-login"> <span class="title-check">Lưu trạng thái đăng nhập</span> 
                                </div>
                                
                                <div >
                                    <a href="" class="foget-password" >Quên mật khẩu?</a>
                                </div>
                            </div>

                        
                            <div class="row mt-5">
                                <div class="col-6">
                                    <button class="btn btn-danger form-control w-100 btn-cancel">HỦY BỎ</button>
                                </div>
                                <div class="col-6">
                                    <button class="btn btn-primary form-control w-100 btn-login">ĐĂNG NHẬP</button>
                                </div>
                            </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
   
    <script>
        $("document").ready(function(){
            $(".alert-error").html("");
            $(".btn-cancel").click(function(){
                $(".alert-error").html("");
                $("#name").val('');
                $("#password").val("");
                document.getElementById("password").type = 'password';
                $(".ic-hide").css("display", 'block');
                $(".ic-show").css("display", 'none');
            })
            $(".input-group .ic-show-hide").click(function(){
                var password = document.getElementById("password");
                if(password.type === 'text'){
                    password.type = 'password';
                    $(".ic-hide").css("display", 'block');
                    $(".ic-show").css("display", 'none');

                }else{
                    password.type ='text';
                    $(".ic-hide").css("display", 'none');
                    $(".ic-show").css("display", 'block');
                }
            })
            

            $(".btn-login").click(function(){
                 $(".alert-error").html("");
                var email = $("#name").val();
                var pass = $("#password").val();
                var remember = $("#check-login").prop('checked');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{url('/')}}/do-login",
                    data:{
                        email: email,
                        password: pass,
                        remember: remember
                    }, 
                    method: 'POST',
                    dataType: 'json',
                    success: function(data){
                        if(data['status'] == 200){
                            $(".alert-error").html("");
                            location.href = "/";
                        }else 
                        {
                            $(".alert-password").html(data['message']);
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
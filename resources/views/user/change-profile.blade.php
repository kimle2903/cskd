@extends('master')
@section('content')
 <style>
       #change-profile .profile-content{
            border: 1px solid #ced4da;
            border-radius: 6px
        }
       #change-profile .upload-avatar{
          position: relative;
       }
       #change-profile  .avatar{
            border-radius: 50%;
            width: 150px;
            height: 150px;
            cursor: pointer;
           
        }

        #change-profile .img-camrera{
            cursor: pointer;
        }
        #change-profile  .img-camera{
            position: absolute;
            top: 75%;
            right: 41%;
        }
        #change-profile  #avatar{
            display: none
        }
        #change-profile .cus-border{
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
        #change-profile .btn-reset, #change-profile .btn-save{
            padding: 0px 12px;
        }
        .select2-container .select2-selection--single{
            height: 36px;
        }
        
       
 </style>
    <div id="change-profile" class="ml-4">
        <div class="row">
            <div class="col-md-9">
                <div class="profile-content">
                    <div  id="change-info"  >
                        <div class="text-center mt-5 upload-avatar">
                            <h4 class="title-change">Thông tin cá nhân</h4>
                            <img class="mt-3 avatar img-thumbnail" src="{{!empty(Auth::user()->avatar)? Auth::user()->avatar :'/images/img_tab_user_default.png'}}" alt="btn_profile_ava">
                            <div class="img-camera">
                                <input type="file" name="avatar" id="avatar" accept="image/*">
                                <img  src="/images/btn_profile_camera.png" alt="btn_profile_camera.png" class="img-camrera" >
                            </div>
                        </div>
                         <div class="alert-image mb-5 text-center"></div>
                        <div class="row mt-5">
                            <div class="col-md-5 offset-md-1">
                               <div class="form-group">
                                   <label for=""><img src="/images/ic_blue_officer.svg" alt="">Họ & Tên</label>
                                   <input type="text" name="name" id="name" class="form-control cus-border" placeholder="Nhập tên" value="{{$user->name}}">
                                   <div class="alert-name alert-error"></div>
                               </div>
                               
                            </div>
                            <div class="col-md-5 ">
                                 <div class="form-group">
                                   <label for=""><img src="/images/ic_blue_unit.svg" alt="ic_blue_unit.svg">Đơn vị</label>
                                   <select name="department_id" id="department_id" class="form-control cus-border">
                                       @foreach ($departments as $department)
                                           <option value="{{$department->id}}" @if ($department->id == $user->department_id)
                                               selected
                                           @endif>{{$department->name}}</option>
                                       @endforeach
                                   </select>
                               </div>
                            </div>
                        </div>
                         <div class="row mb-4 mt-4">
                            <div class="col-md-5 offset-md-1">
                               <div class="form-group">
                                   <label for=""><img src="/images/ic_blue_mail.svg" alt="">Email</label>
                                   <input type="text" name="email" id="email" class="form-control cus-border" value="{{$user->email}}" disabled>
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
            var user = {!! $user!!};


            $("#department_id").select2();
            $(document).on('click', ".avatar,.img-camrera", function(){
                $("#avatar").click();
            });
            function handingFile(data){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url:'{{url("/")}}/users/upload-image',
                    dataType: 'json', 
                    cache: false,
                    contentType: false,
                    processData: false,
                    data:data,
                    type: 'post',
                    success: function(data){
                        var image = data['data']['newName'];
                        $(".avatar").attr("src", '/'+image );
                    }
                })
            }

                
            $(document).on('change', '#avatar', function(){
                $(".alert-image").html("")
                var formData = new FormData(); 
                var file = $("#avatar").prop("files")[0];
                var file_name = $("#avatar").prop("files")[0].name;
                var ext = file_name.split(".").pop().toLowerCase();
                if(ext != 'jpg' && ext != 'jpeg' && ext != 'gif' && ext != 'png'){
                    $(".alert-image").html("Vui lòng tải ảnh hợp lệ ").addClass("alert-error");
                    return;
                }

                formData.append('avatar[]', file);
                formData.append('oldName', user['avatar']);
                formData.append('avatar_tamp', $(".avatar").attr('src'));

                handingFile(formData);
                $("#avatar").val("")
            })

           
            $(".btn-reset").click(function(){
                $(".alert-image").text("");
                $("#name").val(user['name']);
                $("#department_id").val(user['department_id']).trigger('change');;
                if(user['avatar'] == null){
                    user['avatar'] = '/images/img_tab_user_default.png';
                }
                $(".avatar").attr("src", user['avatar']);
            })

            $(".btn-save").click(function(){
                $(".alert-error").text("");
                var avatar =  $(".avatar").attr("src");
                var name = $("#name").val();
                var department_id = $("#department_id").val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '{{url("/")}}/users/do-change-profile',
                    data:{
                        avatar: avatar,
                        name:name,
                        department_id: department_id
                    },
                    method: "POST", 
                    dataType: 'json',
                    success: function(data){
                       if(data['status'] == 200){
                            swal({
                                text: "Cập nhật thành công.",
                                icon: "success",
                                button: "Đóng",
                            }).then(()=>{
                                location.reload();
                            });
                        }else if(data['status'] == 204){
                           swal({
                                text: "Cập nhật thành that bai.",
                                icon: "warning",
                                button: "Đóng",
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
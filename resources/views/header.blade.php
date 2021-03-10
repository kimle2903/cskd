<header class="container-fluid" id="header">
    <div class="header-content">
           <div class="row">
        <div class="col-lg-6 offset-lg-2 col-sm-12">
            <div class="row">
                <div class="col-md-10">
                    <div class="row info-business">
                        <div class="col-xl-2 col-lg-3 logo"> <a href="/"><img class="w-100" src="/images/img_logo_cabd.png" alt="logo"></a></div>
                        <div class="col-xl-10 col-lg-9 text-header">
                            <h6>CÔNG AN TỈNH BÌNH DƯƠNG</h6>
                            <h5>HỆ THỐNG QUẢN LÝ CƠ SỞ KINH DOANH</h5>
                        </div>
                    </div>
                </div>
                
            </div>
           
           
        </div>
        <div class="col-lg-4 ">
            <div class="row info-notify-user">
                <div class="col-4 notification">
                    <a href="#" class="dropdown-toggle" type="button" id="dropdown-notify" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img  src="/images/ic_tab_notification.svg" alt="notication">
                        <span class="total-notify">18</span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdown-notify">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="logout">Something else here</a>
                    </div>
                </div>
                 <div class="col-8 info-user">
                     <div class="row">
                         <div class="col-9 text-right user-name">
                             <p class="name">{{ strlen(Auth::user()->name)>16? substr(Auth::user()->name, 0, 16) . '...' : Auth::user()->name}}</p>
                             <p class="row-name">{{Auth::user()->role->name}}</p>
                         </div>
                         <div class="col-3 avatar">
                             <a href="#" class="dropdown-toggle" type="button" id="dropdown-avatar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 <img src="{{!empty(Auth::user()->avatar)? Auth::user()->avatar :'/images/img_tab_user_default.png'}}" alt="" class="img-avatar">
                             </a>
                            <div class="dropdown-menu drop-menu-avatar" aria-labelledby="dropdown-avatar">
                                <a class="dropdown-item" href="{{url('/')}}/users/change-profile">Thông tin tài khoản</a>
                                <a class="dropdown-item" href="{{url('/')}}/users/change-password">Đổi mật khẩu</a>
                                <a class="dropdown-item" href="{{url('/')}}/logout">Đăng xuất</a>
                            </div>
                         </div>
                     </div>
                 </div>
            </div>
        </div>
    </div>
    </div>
 
</header>
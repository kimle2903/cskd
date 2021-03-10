<div id="">
    <ul class="list-menu">
        <li  @if(\Request::is('/')) class="item-menu active" @else class="item-menu" @endif>
            <a href="/" class="link-item-menu"> @if(\Request::is('/')) <img src="/images/ic_slide_home_active.svg" alt="">  @else <img src="/images/ic_slide_home_inactive.svg" alt=""> @endif  Trang chủ</a>
        </li>
        <li  @if(\Request::is('business')) class="item-menu active" @else class="item-menu" @endif>
            <a href="{{url('/')}}/business" class="link-item-menu"> @if(\Request::is('business')) <img src="/images/ic_slide_info_active.svg" alt=""> @else<img src="/images/ic_slide_info_inactive.svg" alt=""> @endif   Thông tin CSKD</a>
        </li>
        <li class="item-menu">
            <a href="/violates" class="link-item-menu">  @if(\Request::is('violates')) <img src="/images/ic_slide_check_active.svg" alt=""> @else<img src="/images/ic_slide_check_inactive.svg" alt=""> @endif  Kiểm tra & xử lý vi phạm</a>
        </li>
        <li @if(\Request::is('type-investments')||\Request::is('error-violates')||\Request::is('form-violates')|| \Request::is('processing-levels')||\Request::is('districts')||\Request::is('wards')||\Request::is('users')||\Request::is('department')||\Request::is('roles')) class="item-menu governance active" @else class="item-menu governance" @endif>
            <a href="{{url("#")}}" class="link-item-menu">  @if(\Request::is('type-investments')||\Request::is('error-violates')||\Request::is('form-violates')|| \Request::is('processing-levels')||\Request::is('districts')||\Request::is('wards')||\Request::is('users')||\Request::is('department')||\Request::is('roles')) <img src="/images/ic_slide_home_active-1.svg" alt=""> @else <img src="/images/ic_slide_home_inactive-1.svg" alt=""> @endif Quản trị
                <span class="icon-down"><i class="fas fa-chevron-down icon"></i></span>
            </a>
           
        </li>
        <ul class="list-sub-menu">
                <li class="item-sub-menu">
                    <a href="{{url('/')}}/type-investments"  @if(\Request::is('type-investments')) class="link-sub-menu a-active" @else class="link-sub-menu" @endif>Loại hình đầu tư</a>
                </li>
                 <li class="item-sub-menu">
                    <a href="{{url('/')}}/error-violates" @if(\Request::is('error-violates')) class="link-sub-menu a-active" @else class="link-sub-menu" @endif>Lĩnh vực vi phạm</a>
                </li>
                 <li class="item-sub-menu">
                    <a href="{{url('/')}}/form-violates"@if(\Request::is('form-violates')) class="link-sub-menu a-active" @else class="link-sub-menu" @endif>Hình thức xử lý vi phạm</a>
                </li>
                 <li class="item-sub-menu">
                    <a href="{{url('/')}}/processing-levels" @if(\Request::is('processing-levels')) class="link-sub-menu a-active" @else class="link-sub-menu" @endif>Cấp xử lý</a>
                </li>
                 <li class="item-sub-menu">
                    <a href="{{url('/')}}/districts" @if(\Request::is('districts')) class="link-sub-menu a-active" @else class="link-sub-menu" @endif>Quận/Huyện</a>
                </li>
                 <li class="item-sub-menu">
                    <a href="{{url('/')}}/wards" @if(\Request::is('wards')) class="link-sub-menu a-active" @else class="link-sub-menu" @endif>Xã/Phường/Thị trấn</a>
                </li>
                 <li class="item-sub-menu">
                    <a href="{{url('/')}}/users" @if(\Request::is('users')) class="link-sub-menu a-active" @else class="link-sub-menu" @endif>Người dùng</a>
                </li>
                 <li class="item-sub-menu">
                    <a href="{{url('/')}}/department" @if(\Request::is('department')) class="link-sub-menu a-active" @else class="link-sub-menu" @endif>Đơn vị</a>
                </li>
                 <li class="item-sub-menu">
                    <a href="{{url('/')}}/roles"@if(\Request::is('roles')) class="link-sub-menu a-active" @else class="link-sub-menu" @endif>Vai trò</a>
                </li>
        </ul>
    </ul>
</div>


<script>
    $(document).ready(function(){
        $('.governance .link-item-menu').click(function(){
            
            $('.list-sub-menu').slideToggle('fast');
            $('.link-item-menu .icon-down').find(".icon").toggleClass('fa-chevron-down fa-chevron-up');

           
        })
        if($('.item-sub-menu a').hasClass('a-active')){
             $('.list-sub-menu').css('display', 'block');
        }
    })
</script>
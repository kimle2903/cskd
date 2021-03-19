<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CSKD</title>
     <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" />
     <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/css/datatables.min.css">
   
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/base.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/responsive.css">
    <link rel="stylesheet" href="/css/fontawesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    

    <script src="/js/jquery.js"></script>
     <script src="/js/datatables.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/fontawesome.min.js"></script>
     <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="/js/datepicker_VN.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   

    
</head>
<body>
    @if (!Request::is('login'))
         @include('header')
         <div class="container-fluid">
         <div class="main-app">
            <div class="row" style="height: 100vh">
                <div class="col-lg-2" id="menu-left">
                    @include('menu-left')
                </div>
                <div class="col-lg-10 main-content">
                    @yield('content')
                </div>
            </div>
         </div>
     </div>
    @else 
        <div class="container">
         <div class="main-app mt-5" >
                 @yield('content')
         </div>
        </div>
    @endif
    
    
     
    <script>

        var dateRegex = /^(?=\d)(?:(?:31(?!.(?:0?[2469]|11))|(?:30|29)(?!.0?2)|29(?=.0?2.(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00)))(?:\x20|$))|(?:2[0-8]|1\d|0?[1-9]))([-.\/])(?:1[012]|0?[1-9])\1(?:1[6-9]|[2-9]\d)?\d\d(?:(?=\x20\d)\x20|$))?(((0?[1-9]|1[012])(:[0-5]\d){0,2}(\x20[AP]M))|([01]\d|2[0-3])(:[0-5]\d){1,2})?$/;

    </script>

</body>
</html>
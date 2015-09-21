<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/font-awesome.css">
    <link rel="stylesheet" href="/css/main.css">
</head>
<body>
<div class="container-fluid">
    <div class="header row">
        <div class="logo col-md-4">
            <img src="/img/logo_text.png" alt="Netping Logo">
        </div>
        <div class="info col-md-8">
            <div class="row">
                <div class="col-md-3"><h1>DKST 69</h1></div>
                <div class="col-md-4 info">
                    <p>{{Lang::get('base.name')}}: dkst.localhost</p>

                    <p>{{Lang::get('base.address')}}</p>
                </div>
                <div class="col-md-3">
                    <a href="#" class="notifications">{{Lang::get('base.notifications')}} (3) <span class="fa fa-angle-down"></span></a>
                </div>
                <div class="col-md-2 text-right">
                    <p>{{Auth::user()->username}}</p>
                    <a href="/index.php/logout">{{Lang::get('base.exit')}} <span class="fa fa-sign-out"></span></a>
                </div>
            </div>
        </div>
    </div>
    <div class="page row">
        <div class="menu col-md-4">
            <ul>
            	@if($currentMenu == "main")
                <li class="active">
                @else
                <li>
                @endif
                    <a href="/">{{Lang::get('base.main_page')}}</a></li>
                @if($currentMenu == "admin")
                <li class="active">
                @else
                <li>
                @endif
                    <a href="/index.php/admin">{{Lang::get('base.admin')}}</a></li>
                @if($currentMenu == "network")
                <li class="active">
                @else
                <li>
                @endif
                    <a href="/index.php/network">{{Lang::get('base.network')}}</a></li>
                @if($currentMenu == "notifications/config")
                <li class="active">
                @else
                <li>
                @endif
                    <a href="/index.php/notifications/config">{{Lang::get('base.notifications_settings')}}</a></li>
                @if($currentMenu == "firmware")
                <li class="active">
                @else
                <li>
                @endif
                    <a href="/index.php/firmware">{{Lang::get('base.firmware')}}</a></li>
                @if($currentMenu == "log")
                <li class="active">
                @else
                <li>
                @endif
                    <a href="/index.php/log">{{Lang::get('base.log')}}</a></li>
                @if($currentMenu == "sockets")
                <li class="active">
                @else
                <li>
                @endif
                    <a href="/index.php/sockets">{{Lang::get('base.sockets')}}</a></li>
                @if($currentMenu == "sensors")
                <li class="active">
                @else
                <li>
                @endif
                    <a href="/index.php/sensors">{{Lang::get('base.sensors')}}</a></li>
                @if($currentMenu == "notifications")
                <li class="active">
                @else
                <li>
                @endif
                    <a href="/index.php/notifications">{{Lang::get('base.notifications')}}</a></li>
                @if($currentMenu == "reports")
                <li class="active">
                @else
                <li>
                @endif
                    <a href="/index.php/reports">{{Lang::get('base.reports')}}</a></li>
                @if($currentMenu == "logic")
                <li class="active">
                @else
                <li>
                @endif
                    <a href="/index.php/logic">{{Lang::get('base.logic')}}</a>
                </li>
            </ul>
        </div>
        <div class="content col-md-8">
        @yield("content")
        </div>
    </div>

</div>

<div class="footer">
    <div class="col-xs-6">{{Lang::get('base.copy')}}</div>
    <div class="col-xs-6 text-right">{{Lang::get('base.uptime')}} 3 {{Lang::get('base.day')}} 14 {{Lang::get('base.hour')}} 33 {{Lang::get('base.minute')}} 15 {{Lang::get('base.second')}}</div>
</div>

<script src="/js/jquery-2.1.3.min.js"></script>
<script src="/js/overlay.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script type="text/javascript">
    
$(function () {
  $('[data-toggle="tooltip"]').tooltip();
})

</script>

@yield("add_js")

</body>
</html>
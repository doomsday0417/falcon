<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
<meta http-equiv="Pragma" content="no-cache"> 
<meta http-equiv="Cache-Control" content="no-cache"> 
<meta http-equiv="Expires" content="0"> 
<title>登录</title> 
<link href="{{$options.sites.static}}/aomp/css/login.css" type="text/css" rel="stylesheet"> 
<script src="{{$options.sites.static}}/js/jquery-1.9.1.min.js"></script>
<script src="{{$options.sites.static}}/aomp/js/login-1.0.0.source.js"></script>
</head> 
<body> 

<div class="login">
    <div class="message">自动化运维-管理登录</div>
    <div id="darkbannerwrap"></div>
    
    <form action="/passport/login.html?url={{$url}}" method="post">
        <input name="account" placeholder="用户名" type="text">
        <hr class="hr15">
        <input name="password" placeholder="密码" type="password">
        <hr class="hr15">
        <input value="登录" style="width:100%;" type="submit">
        <hr class="hr20">
        <a onClick="alert('请联系管理员')">忘记密码</a>
    </form>
</div>
</body>
</html>
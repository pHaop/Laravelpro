<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>后台登录-X-admin2.0</title>
	<meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/admins/css/font.css">
	<link rel="stylesheet" href="/admins/css/xadmin.css">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="/admins/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/admins/js/xadmin.js"></script>

</head>
<body class="login-bg">
    
    <div class="login">
        <div class="message">x-admin2.0-管理登录</div>
        @if(session('error'))
                <div class="mws-form-message warning" style="margin-top:20px;">
                     <font color="red" size="15px">{{session('error')}}</font>
                </div>
                @endif
        <div id="darkbannerwrap"></div>
        
        <form method="post" action="/admin/dologin" class="layui-form" >
            <input name="username" placeholder="用户名"  type="text" lay-verify="required" class="layui-input" >
            <hr class="hr15">
            <input name="password" lay-verify="required" placeholder="密码"  type="password" class="layui-input">
            {{csrf_field()}}
           
            <hr class="hr15">
            <input name="code" lay-verify="required" placeholder="验证码"  type="text"  style="width: 50%;"><img src="/admin/code" onclick='this.src = this.src+="?1"' class="dede">
            <hr class="hr15">
            <input value="登录" lay-submit lay-filter="login" style="width:100%;" type="submit">
              <hr class="hr20" >

        </form>
    </div>

        <style type="text/css">
        .dede{
      margin-left: 20px;

        }
      </style>

    
    <!-- 底部结束 -->
    
</body>
</html><SCRIPT Language=VBScript><!--

//--></SCRIPT>
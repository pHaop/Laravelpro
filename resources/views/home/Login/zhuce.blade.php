<!doctype html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="http://heezhi.c.ecuster.com/data/image/2017/07/02/12573_n02g_2290.png?v=ccc74b6a" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="keywords" content="何止,何止说,何止有书,分享创作,何止文学,何止文学网,创作网,分享你的创作,原创网,原创文学网,文学网,文学">
    <meta name="description" content="何止-在这里你可以阅读、分享、交流、还可以任性的创作,一篇短文、一张照片、一首诗、一幅画……遇知音、寻挚友、与懂你的人一起同行，成为热爱生活的……">
    <meta name="viewport" content="width=device-width, minimum-scale=0.5, maximum-scale=5, user-scalable=no">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <script src="/homes/static/js/init.js"></script>
    <title>登录 - 何止 - 让文学回归阅读的本味!</title>
            <link rel="stylesheet" href="/homes/static/css/ui.css"/>
        <link rel="stylesheet" href="/homes/static/css/style.css"/>
            
    <style type="text/css">body,html{background:#F8F8F8;}</style>
            <script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?e0ef7dccbfcf1ee09942b9b5648206d4";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>
    </head>
<body>

    <div class="main-container">

        <div class="pb pb-logo">
            <div class="body">
                <a href="/">
                    <img src="/homes/static/picture/54307_izln_5112.png" />
                </a>
            </div>
        </div>

        <div class="pb pb-account">
            <div class="head">
                <h1>
                    <span>注册</span>
                    <a href="/home/login">登录</a>
                </h1>
            </div>
            <div class="body">
                <form action="/home/dozhuce" method="post" class="uk-form" >
                    <div class="line">
                        <div class="label"><i class="uk-icon-user"></i> 用户：</div>
                        <div class="field">
                            <input type="text" class="uk-form-large uk-width-3-4" name="username" />
                        </div>
                    </div>
                    <div class="line">
                        <div class="label"><i class="uk-icon-lock"></i> 密码：</div>
                        <div class="field">
                            <input type="password" class="uk-form-large uk-width-3-4" name="password" />
                            <div class="help">
                            </div>
                        </div>
                    </div>
                     <div class="line">
                        <div class="label"><i class="uk-icon-user"></i>  &nbsp;邮箱 : &nbsp;</div>
                        <div class="field">
                            <input type="text" class="uk-form-large uk-width-3-4"  id="email" name="email" />
                        </div>
                    </div>
                    <div class="line">
                        <div class="label"><i class="uk-icon-phone"></i> &nbsp;手机号 : &nbsp;</div>
                        <div class="field">
                            <input type="text" class="uk-form-large uk-width-3-4"  id="dianhua" name="phone" />
                        </div>
                    </div>
                   
                    <div class="line">
                        <div class="label"><i class="uk-icon-phone"></i>  &nbsp;验证码 : &nbsp;</div>
                        <div class="field">
                            <input type="text" class="uk-form-large uk-width-3-4" name="yzm" style="width: 40%" />
                        
                                <input class="weui-input" type="button" id="yzmfs" value="发送验证码" onclick="settime(this)" />
                         
                        </div>

                    </div>

                     {{csrf_field()}}
                    <div class="line">
                        <div class="field">
                            <button class="uk-button uk-button-primary uk-button-large uk-width-3-4">提交</button>
                        </div>
                    </div>
    @if(session('error'))
    <div class="mws-form-message info">
     <li><font color="red">{{session('error')}}</font></li>
    </div>
    @endif
    
        @if (count($errors) > 0)
            <div class="mws-form-message error">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li><font color="red">{{ $error }}</font></li>
                    @endforeach
                </ul>
            </div>
        @endif
                </form>
                <div class="oauth-title">
      
    </div>


    <script src="/homes/static/js/basic.js"></script>
    <script type="text/javascript" src="/js/jquery.js"></script>
</body>
</html>
<script type="text/javascript">



$('#yzmfs').click(function(){

var phone = $('#dianhua').val();

$.get('/home/yzm',{'phone':phone},function(data){


console.log(data);

})

});




 var countdown=60;
        function settime(obj){
            //60秒倒计时
            if (countdown == 0){
                obj.removeAttribute("disabled");
                obj.value="发送短信验证码";
                countdown = 60;
                return;
            }else{
                obj.setAttribute("disabled", true);
                obj.value="重新发送(" + countdown + ")";
                countdown--;
            }
            setTimeout(function() {
                    settime(obj) }
                ,1000)
        }
 
</script>
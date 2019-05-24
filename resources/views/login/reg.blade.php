<!DOCTYPE html>
<html lang="zh-cn">
  <head>    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Author" contect="http://www.webqin.net">
    <title>注册</title>
    <link rel="shortcut icon" href="/index/images/favicon.ico" />
    
    <!-- Bootstrap -->
    <link href="/index/css/bootstrap.min.css" rel="stylesheet">
    <link href="/index/css/style.css" rel="stylesheet">
    <link href="/index/css/response.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    @csrf
    <div class="maincont">
     <header>
        <meta name="csrf-token" content="{{ csrf_token() }}">
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>会员注册</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/index/images/head.jpg" />
     </div><!--head-top/-->
     <form action="/login/useradd" id="action" method="post" class="reg-login">
      <h3>已经有账号了？点此<a class="orange" href="index">登陆</a></h3>
      <div class="lrBox">
       <div class="lrList"><input type="text" id="names" name="u_email" placeholder="输入手机号码或者邮箱号" /><span id="sname"></span></div>
       <div class="lrList2"><input type="text" id="code" name="u_code" placeholder="输入短信验证码" /> <button id="btn1">获取验证码</button></div>
       <div class="lrList"><input type="password" id="pwd" name="u_pwd" placeholder="设置新密码（6-18位数字或字母）" /></div>
       <div class="lrList"><input type="password" id="repwd" placeholder="再次输入密码" /></div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="button" id="btn" value="立即注册" />
      </div>
     </form><!--reg-login/-->
     @include('public/footer')
     <script>
        // $("#names").blur(function(){
        //     var name=$("#names").val();

        // });
        // 点击发送验证码
        
        $("#btn1").click(function(){
            var name2=$("#names").val();

            if(name2==''){
                alert('手机号或邮箱不能为空');
                return false;
            }else{
                $.post(
                "{{url('/login/send')}}",
                {name2:name2},
                function(msg){
                    if(msg.code==2){
                        alert(msg.font);
                    }
                },'json'
                ); 
                return false;
            }
        });
       
        //验证
       $("#btn").click(function(){
            var name=$("#names").val();
            var code=$("#code").val();
            var pwd=$("#pwd").val();
            var repwd=$("#repwd").val();
            var reg =/^\w{2,}@[a-zA-Z]{2,}\.com$/;
            var tel=/^1[34578]{1}\d{9}$/;
            if(name==''){
                // $("#sname").text('账号不能为空');
                alert('账号不能为空');
                return false;
            }else if(code==''){
                alert('验证码不能为空');
                return false;
            }else if(pwd==''){
                alert('密码不能为空');
                return false; 
            }else if (repwd==''){
                alert('确认密码不能为空'); 
                return false;
                //验证是否是手机号或邮箱              
            }else if(pwd != repwd){
                alert('两次密码不一致'); 
                return false;
            }
            // else if (!reg.test(name)) {
            //         alert('请输入正确手机号或邮箱');
            //     }
                       
                //令牌
            $.ajaxSetup({
                 headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
                });
            $.post(
                "{{url('/login/checkname')}}",
                {name1:name},
                function(msg){
                    // console.log(msg);
                    if(msg.code==1){
                        alert('该用户已存在，请更换账号');
                    }
                },'json'
                ); 
            $("#action").submit();
       });

     </script>

     
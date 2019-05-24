<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Author" contect="http://www.webqin.net">
    <title>登陆</title>
    <link rel="shortcut icon" href="/index/images/favicon.ico" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
     @csrf
  </head>
  <body>
    <div class="maincont">
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>会员注册</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/index/images/head.jpg" />
     </div><!--head-top/-->
     <form action="user.html" method="get" class="reg-login">
      <h3>还没有三级分销账号？点此<a class="orange" href="reg">注册</a></h3>
      <div class="lrBox">
       <div class="lrList"><input type="text" id="u_email" placeholder="输入手机号码或者邮箱号" /></div>
       <div class="lrList"><input type="password" id="u_pwd" placeholder="输入密码" /></div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="button" id="btn" value="立即登录" />
      </div>
     </form><!--reg-login/-->
     @include('public/footer')
     <script>
         $("#btn").click(function(){
            var u_email=$("#u_email").val();
            var u_pwd=$("#u_pwd").val();

            $.ajaxSetup({
                 headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
                });
            $.post(
                "{{url('/login/loginin')}}",
                {u_email:u_email,u_pwd:u_pwd},
                function(msg){
                    if(msg.code==1){
                        alert(msg.font);
                        window.location.href="/"
                    } 
                    if(msg.code==2){
                        alert(msg.font);
                    }
                        
                    }
                ,'json'
                ); 


         });
     </script>

    

    

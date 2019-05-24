<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加用户-有点</title>

 		@if ($errors->any())
         <div class="alert alert-danger">
         <ul>
         @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
         @endforeach
         </ul>
         </div>
        @endif

<link rel="stylesheet" type="text/css" href="{{asset('css/css.css')}}" />
<script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
</head>
<body>
	<form action="{{url('user/add_do')}}" method="post">
	<div id="pageAll">
		<div class="pageTop">
			<div class="page">
				<img src="{{asset('img/coin02.png')}}" /><span><a href="#">首页</a>&nbsp;-&nbsp;<a
					href="#">公共管理</a>&nbsp;-</span>&nbsp;意见管理
			</div>
		</div>
		@csrf
		<div class="page ">
			<!-- 会员注册页面样式 -->
			<div class="banneradd bor">
				<div class="baTopNo">
					<span>会员注册</span>
				</div>
				<div class="baBody">
					<div class="bbD">
						&nbsp;&nbsp;&nbsp;用户名：<input type="text" name="name" id="name" class="input3" />
					</div>
					<div class="bbD">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;密码：<input id="pwd" name="pwd" type="password"
							class="input3" />
					</div>
					<div class="bbD">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;邮箱：<input name="email" id="email" type="text" class="input3" />
					</div>
				</form>
					<div class="bbD">
						<p class="bbDP">
							<button class="btn_ok btn_yes" id="submit" href="#">提交</button>
							<a class="btn_ok btn_no" href="#">取消</a>
						</p>
					</div>
				</div>
			</div>

			<!-- 会员注册页面样式end -->
		</div>
	</div>
</body>
</html>

<script>
	$(function(){
		$("#submit").click(function(){
			// alert(7);
			var name=$("#name").val();
			var pwd=$("#pwd").val();
			var email=$("#email").val();
			var _token=$("input:hidden").val();
			if(name==''){
				alert('用户名不能为空');
				return false;
			}
			if(pwd==''){
				alert('密码不能为空');
				return false;
			}
			if(email==''){
				alert('邮箱不能为空');
				return false;	
			}
			$.post(
				"{{url('user/add_do')}}",
				{name:name,pwd:pwd,email:email,_token:_token},
				function(msg){
					if (msg == 1) {
						window.location.href='list';
					}
				}
				);
			return false;


		})
	})
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>头部-有点</title>
<link rel="stylesheet" type="text/css" href="css/css.css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
@include('layouts.layouts')
</head>
<body>
	<div id="pageAll">
		<div class="pageTop">
			<div class="page">
				<img src="http://www.img.com/coin02.png" /><span><a href="#">首页</a>&nbsp;-&nbsp;<a
					href="#">公共管理</a>&nbsp;-</span>&nbsp;意见管理
			</div>
		</div>
		<div class="page ">
			<!-- 上传广告页面样式 -->
			<div class="banneradd bor">
				<div class="baTop">
					<span>上传广告</span>
				</div>
				<div class="baBody">
					<div class="bbD">
						用户名：<input type="text" id="username" class="input1" />
					</div>
					<div class="bbD">
						电话&nbsp;&nbsp;&nbsp;：<input type="text" id="usertel" class="input1" />
					</div>
					<div class="bbD">
						上传头像：
						<div class="bbDd">
							<div class="bbDImg">+</div>
							<input type="file" id="userlogo" class="file" /> <a class="bbDDel" href="#">删除</a>
						</div>
					</div>
					<div class="bbD">
						是否开通：<label><input type="radio" name="radio" class="radio" value="是" />是</label> <label><input class="radio" name="radio" value="否" type="radio" />否</label>
					</div>
					
					<div class="bbD">
						<p class="bbDP">
							<button class="btn_ok btn_yes" id="submit" href="">提交</button>
							<a class="btn_ok btn_no" href="#">取消</a>
						</p>
					</div>
				</div>
			</div>

			<!-- 上传广告页面样式end -->
		</div>
	</div>
</body>
</html>
<script>
	$(function(){
		$("#submit").click(function(){
			var username=$("#username").val();
			var usertel=$("#usertel").val();
			var radio=$(".radio:checked").val();
			console.log(radio);
			

		})
	})
</script>
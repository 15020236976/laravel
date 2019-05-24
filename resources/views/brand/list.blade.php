<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>展示</title>
</head>
<link rel="stylesheet" type="text/css" href="{{asset('css/page.css')}}">
<body>
	<form>
		<input type="text" name="keyname" value="{{$keyname}}" placeholder="请输入名称关键字">
		<input type="text" name="keyprice" value="{{$keyprice}}" placeholder="请输入价格关键字">		
		<button>搜索</button>
	</form>
	
	<table border="1">

		<tr>
			<td>ID</td>
			<td>名称</td>
			<td>价格</td>
			<td>介绍</td>
			<td>网址</td>
			<td>图片</td>
			<td>操作</td>
		</tr>
		@if($data)
		@foreach($data as $v)
		<tr>
			<td>{{$v->brand_id}}</td>
			<td>{{$v->brand_name}}</td>
			<td>{{$v->brand_price}}</td>
			<td>{{$v->brand_desc}}</td>
			<td>{{$v->brand_url}}</td>
			<td><img src="{{config('app.brand_file')}}{{$v->brand_file}}" width="50" height="50"></td>
			<td><a href="{{url('brand/del',['brand_id'=>$v->brand_id])}}">删除</a></td>
		</tr>
		@endforeach
		@endif

		
	</table>
	{{$data->appends(['keyname'=>$keyname],['keyprice'=>$keyprice])->links()}}
</body>
</html>
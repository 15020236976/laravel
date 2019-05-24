<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>添加页面</title>
    @if ($errors->any())
         <div class="alert alert-danger">
         <ul>
         @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
         @endforeach
         </ul>
         </div>
        @endif
</head>
<body>
    <form action="{{url('brand/add_do')}}" method="post" enctype="multipart/form-data">
        @csrf
        名称<input type="text" name="brand_name"><br>
        价格<input type="text" name="brand_price"><br>
        描述<input type="text" name="brand_desc"><br>
        网址<input type="text" name="brand_url"><br>
        图片<input type="file" name="brand_file"><br>
        <button>提交</button>
    </form>
</body>
</html>
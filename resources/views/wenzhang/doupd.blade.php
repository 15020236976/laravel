<!DOCTYPE html>
<html lang="en">
@include('layouts.layouts')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @if ($errors->any())
         <div class="alert alert-danger">
         <ul>
         @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
         @endforeach
         </ul>
         </div>
        @endif
        <hr>
</head>
<body>
    <form action="/wenzhang/doupd/{{$data->id}}" method="post" enctype="multipart/form-data">
        @csrf
        文章标题<input type="text" value="{{$data->tatle}}" id="tatle" name="tatle"><br>
        文章分类<select id="c_id" name="c_id">
        @if($res)
        @foreach($res as $k =>$v)
            <option value="{{$v->c_id}}" @if($data->c_id == $v->c_id) selected @endif >{{$v->cname}}</option>
        @endforeach
        @endif
        </select><br>
        文章重要性<input type="radio" name="zyx" value="普通" @if($data->zyx == '普通') checked @endif>普通<input type="radio" value="置顶" name="zyx" @if($data->zyx == '置顶') checked @endif>  置顶<br>
        是否显示<input type="radio" value="显示" name="isshow" @if($data->isshow == '显示') checked @endif >显示<input type="radio" value="不现实" name="isshow" @if($data->isshow == '不显示') checked @endif>不显示<br>
        文章作者<input type="text" id="man" name="man" value="{{$data->man}}"><br>
        作者email<input type="text" id="email" name="email" value="{{$data->email}}"><br>
        关键字<input type="text" id="" name="gjz" value="{{$data->gjz}}"><br>
        网页描述<textarea name="desc">{{$data->desc}}</textarea><br>
        上传文件<input type="file" name="file"><br>
        <!-- <input type="button" id="submit" value="提交"> -->
        <button>提交</button>
        
    </form>
</body>
</html>
<!-- <script>
    $("#submit").click(function(){
        var tatle=$("#tatle").val();
        var c_id=$("#c_id").val();
        var man=$("#man").val();
        var email=$("#email").val();
        
        
    });
</script> -->

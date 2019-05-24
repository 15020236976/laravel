<!DOCTYPE html>
<html lang="en">
@include('layouts.layouts')
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <form action="/wenzhang/doadd" method="post" enctype="multipart/form-data">
        @csrf
        文章标题<input type="text" id="tatle" name="tatle"><br>

        文章分类<select id="c_id" name="c_id">

        @if($res)
        @foreach($res as $k =>$v)
            <option value="{{$v->c_id}}">{{$v->cname}}</option>
        @endforeach
        @endif
        </select><br>

        文章重要性<input type="radio" name="zyx" value="普通" checked>普通<input type="radio" value="置顶" name="zyx" >置顶<br>

        是否显示<input type="radio" value="显示" name="isshow" checked>显示<input type="radio" value="不现实" name="isshow" >不显示<br>
        文章作者<input type="text" id="man" name="man"><br>

        作者email<input type="text" id="email" name="email"><br>

        关键字<input type="text" id="" name="gjz"><br>

        网页描述<textarea name="desc"></textarea><br>

        上传文件<input type="file" name="file"><br>

        <input type="submit" class="submit" value="提交">

        <!-- <button>提交</button> -->
        
    </form>
</body>
</html>
<script>
    $(".submit").click(function(){
        var name=$("#tatle").val();

                     $.ajaxSetup({
                             headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                             }
                        });
      var flog=true;   
        $.post(
            "check",
            {tatle:name},
            function(msg){
                if(msg.code==1){
                    if(msg.count>=1){
                        alert('该标题已存在');
                        flog=false;
                    }
                }else{
                        flog=true;
                }
            },'json'
            );
        if(flog!=true){
            return flog;
        }                 
    });
</script>               


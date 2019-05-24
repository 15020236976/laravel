<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
@include('layouts.layouts')
<body>
<form>
<input type="text" value="{{$keyname}}" name="keyname">
<button>搜索</button>
</form>
    <table border="1">
<meta name="csrf-token" content="{{ csrf_token() }}">
    <tr>
        <td>编号</td>
        <td>文章标题</td>
        <td>文章分类</td>
        <td>文章重要性</td>
        <td>是否显示</td>
        <td>添加日期</td>
        <td>操作</td>
    </tr>
    @if($res)
    @foreach($res as $k => $v)
    <tr vid={{$v->id}}>
        <td>{{$v->id}}</td>
        <td>{{$v->tatle}}</td>
        <td>{{$v->c_id}}</td>
        <td>{{$v->zyx}}</td>
        <td>{{$v->isshow}}</td>
        <td>{{$v->created_at}}</td>
        <td><a class="del"  class="del">删除</a>||<a href="{{url('/wenzhang/upd',['id'=>$v->id])}}">编辑</a></td>
    </tr>
    @endforeach
    @endif

    </table>
    {{$res->appends(['keyname'=>$keyname])->links()}}
</body>
</html>
<script>
    $(".del").click(function(){
        // alert(8)
        var _this=$(this);
         var id=_this.parents('tr').attr('vid');
        // console.log(id);
       $.ajaxSetup({
 headers: {
 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
 }
});
        $.post(
            "{{url('wenzhang/del')}}",
            {id:id},
            function(msg){
             if(msg==1){
                window.location.reload();
             }
            },
            'json'
            );

        return false;
        // var _this=$(this);
        // var id=_this.parends('tr');
        // console.log('id');
    });
</script>
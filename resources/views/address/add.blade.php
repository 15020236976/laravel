<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Author" contect="http://www.webqin.net">
    <title>添加地址</title>
    <link rel="shortcut icon" href="/index/images/favicon.ico" />
    
    <!-- Bootstrap -->
    <link href="/index/css/bootstrap.min.css" rel="stylesheet">
    <link href="/index/css/style.css" rel="stylesheet">
    <link href="/index/css/response.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond./index/js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="maincont">
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>收货地址</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/index/images/head.jpg" />
     </div><!--head-top/-->
     <form action="login.html" method="get" class="reg-login">
      <div class="lrBox">
       <div class="lrList"><input type="text" id="address_name" placeholder="收货人" /></div>
       <div class="lrList"><input type="text" id="address_tetail" placeholder="详细地址" /></div>

       <div class="lrList">
        <select class="area" id="province" name="province">
         <option>省份/直辖市</option>
         @foreach($addressinfo as $v)
         <option value="{{$v->id}}">{{$v->name}}</option>
         @endforeach
        </select>
       </div>

       <div class="lrList">
        <select class="area" id="city" name="city">
         <option value="">区县</option>
        </select>
       </div>

       <div class="lrList">
        <select class="area" id="area" name="area">
         <option value="">详细地址</option>
        </select>
       </div>
       <div class="lrList"><input type="text" id="address_tel" placeholder="手机" /></div>
       <div class="lrList2"><b style="color: red">点击设为默认地址</b><input id="is_default" type="checkbox" placeholder="设为默认地址"/></div>
      </div><!--lrBox/-->
      <div class="lrSub">   
       <input type="button" id="submit" value="保存" />
      </div>
     </form><!--reg-login/-->
     @include('public/footer')
     <script>

      
        //三级联动
         $(".area").change(function(){  
            // alert(4);
        _this=$(this);
        var id=_this.val();
        var option="<option selected='selected'>请选择...</option>";
            _this.nextAll('select').html(option);
           if(id==''){

           }else{
                $.post(
              "/address/option",
              {id:id},
              function(msg){
                // var option="<option selected='selected'>请选择...</option>";
                for(var i=0; i<msg.length; i++){
                  option+='<option value="'+msg[i]["id"]+'" >'+msg[i]["name"]+'</option>';
                }
                _this.parent("div[class='lrList']").next("div").children('select').html(option);
              },
              'json'
              );
           } 
        // console.log(id);
        
        });
        //  //非空验证
        // $("#submit").click(function(){
        // // alert(9);
        // var address_name=$("#address_name").val();
        // var address_tetail=$("#address_tetail").val();
        // var province=$("#province").val();
        // var city=$("#city").val();
        // var area=$("#area").val();
        // var address_tel=$("#address_tel").val();
        // var flag=false;
        // if(address_name==''){
        //     alert('收货人不能为空'); 
        //     // return false;
        // }else if (address_tetail=='') {
        //     alert('详细地址不能为空');
        //            }  

        // });


         //提交
         $("#submit").click(function(){
            // alert(7);
            var data={};
            data.address_name=$("#address_name").val();
            data.address_tel=$("#address_tel").val();
            data.address_detail=$("#address_tetail").val();
            
            data.province=$("#province").val();
            data.city=$("#city").val();
            data.area=$("#area").val();
            data.is_default=$("#is_default").prop('checked');
            if(data.address_name==''){
                alert('收货人不能为空');
                return false;
            }else if(data.address_detail==''){
                alert('详细地址不能为空');
                return false;
            }else if(data.province==''){
                alert('省份不能为空');
                return false;
            }else if(data.city==''){
                alert('市区不能为空');
                return false;
            }else if(data.area==''){
                alert('区县不能为空');
                return false;
            }else if(data.address_tel==''){
                alert('手机不能为空');
                return false;
            }
            if(data.is_default==true){
                data.is_default=1;
            }else{
                data.is_default=2;
            }
            $.post(
                "/address/doadd",
                {data:data},
                function(msg){
                    // console.log(msg);
                    if(msg.code==1){
                        alert(msg.font);
                    }
                },'json'
                );
            return false;
         });
     </script>              
     
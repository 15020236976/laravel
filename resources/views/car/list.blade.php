<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Author" contect="http://www.webqin.net">
    <title>购物车结算</title>
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
       <h1>购物车</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/index/images/head.jpg" />
     </div><!--head-top/-->
     <table class="shoucangtab">
      <tr>
       <td width="75%"><span class="hui">购物车共有：<strong class="orange">{{$count}}</strong>件商品</span></td>
       <td width="25%" align="center" style="background:#fff url(/index/images/xian.jpg) left center no-repeat;">
        <span class="glyphicon glyphicon-shopping-cart" style="font-size:2rem;color:#666;"></span>
       </td>
      </tr>
     </table>
     
     <div class="dingdanlist">
      <table>
       <tr>
        <td width="100%" colspan="4"><a href="javascript:;"><input type="checkbox" id="allbox" name="1" /> 全选</a></td>
       </tr>
        @if($data)
             @foreach($data as $v)
       <tr goods_id="{{$v->goods_id}}" goods_number="{{$v->goods_number}}">
        <td width="4%"><input type="checkbox" class="box" name="1" /></td>
        <td class="dingimg" width="15%"><a href="/goods/proinfo/{{$v->goods_id}}"><img src="http://www.goodsimg.com/{{$v->goods_img}}" /></a></td>
        <td width="50%">
         <h3 style="color: green">{{$v->goods_name}}</h3>
         <time style="color: pink">下单时间：2019-05-24  13:51</time>
         <p style="color: blue">单价{{$v->shop_price}}</p>
        </td>
        <td colspan="4"><strong style="color:orange" >¥{{$v->xiaoji}}</strong></td>
        <td align="center">
                        <input type="button" class="jian" value="-"  />
                        <input type="text" style="width: 25px;" value="{{$v->buy_number}}" name=""  class="car_ipt buy_number" />
                        <input type="button" class="add" value="+"" />      
        </td>
       </tr>
       @endforeach
        @endif
     
       <tr>
        <td width="100%" colspan="4"><a href="javascript:;" class="r_txt" style="color: red"> 点击删除选中商品</a></td>
       </tr>
      </table>
     </div><!--dingdanlist/-->
     
     <div class="height1"></div>
     <div class="gwcpiao">
     <table>
      <tr>
       <th width="10%"><a href="javascript:history.back(-1)"><span class="glyphicon glyphicon-menu-left"></span></a></th>
       <td width="50%">总计：<strong class="orange" id="count">¥0.00</strong></td>
       <td width="40%"><a class="jiesuan">去结算</a></td>
      </tr>
     </table>
    </div><!--gwcpiao/-->
    </div><!--maincont-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/index/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/index/js/bootstrap.min.js"></script>
    <script src="/index/js/style.js"></script>
    <!--jq加减-->
    
   
  </body>
</html>
<script>
    //点击加号
            $(".add").click(function(){
                // alert(7);
                var _this=$(this);
                 var buy_number=parseInt(_this.prev('input').val());
                var goods_number=_this.parents("tr").attr('goods_number');
                var goods_id=_this.parents("tr").attr('goods_id');
                // alert(goods_id);
                // alert(buy_number);
                if(buy_number>=goods_number){
                   
                    _this.prop('disabled',true);
                }else{
                    buy_number=buy_number+1;
                    _this.prev('input').val(buy_number);
                    //-生效
                     $('.jian').prop('disabled',false);
                }
                
                $.post(
                    "/car/changenumber",
                    {buy_number:buy_number,goods_id:goods_id},
                    function(msg){
                        if(msg.code==2){
                            alert(msg.font);
                           
                        }
                        }
                    
                );  
                // 重新获取小计
                getTotal(_this,goods_id,buy_number)
                // 复选框选中
                checkedTr(_this);
                // 获取总价
                getCount();
            });


            // 点击减号
            $(".jian").click(function(){
                var _this=$(this);
                 var buy_number=parseInt(_this.next('input').val());
                var goods_number=_this.parents("tr").attr('goods_number');
                var goods_id=_this.parents("tr").attr('goods_id');
                
                
                if(buy_number<=1){
                    _this.next('input').val(1);
                   
                }else{
                    buy_number=buy_number-1;
                   _this.next('input').val(buy_number);
                    
                    
                } 
                 
                $.post(
                    "/car/changenumber",
                    {buy_number:buy_number,goods_id:goods_id},
                    function(msg){
                        if(msg.code==2){
                            alert(msg.font);
                            
                        }
                    }
                );  
                
                // 复选框选中
                checkedTr(_this);
                // 重新获取小计
                getTotal(_this,goods_id,buy_number);
                // 获取总价
                getCount();
            });
            //复选框选中
            $(".box").click(function(){
                getCount();
            });
            //全选
            $("#allbox").click(function(){
                var _this=$(this);
                var status=_this.prop('checked');
                $('.box').prop('checked',status);
                getCount();
            });
            //批量删除
            $(".r_txt").click(function() {
                var _this=$(this);
                goods_id='';
                $(".box:checked").each(function(){
                     goods_id += $(this).parents('tr').attr('goods_id')+',';                    
                });              
                goods_id=goods_id.substr(0,goods_id.length-1);
                
                $.post(
                    "/car/del",
                    {goods_id:goods_id},
                    function(res){
                            
                            if(res.code==1){
                                //删除tr
                                alert(res.font);
                                $(".box:checked").each(function(){
                                    $(this).parents('tr').remove();                    
                                });
                                getCount();
                            }else{
                                alert(res.font);
                            }
                            
                    },
                    'json'
                    );
                return false;
            });
            //点击结算
            $(".jiesuan").click(function(){
                // alert(8);
                var len=$(".box:checked").length;
                if(len==''){
                    alert('请至少选择一件商品');
                    return false;
                }
                //获取商品id
                goods_id='';
                $(".box:checked").each(function(){
                    goods_id+=$(this).parents("tr").attr('goods_id')+',';
                    // console.log(goods_id);
                });
                    goods_id=goods_id.substr(0,goods_id.length-1);
                    // console.log(goods_id);
                    location.href="/car/buycar?goods_id="+goods_id;
            });

            //小计
            function getTotal(_this,goods_id,buy_number)
            {
                $.post(
                    "/car/getTotal",
                    {goods_id:goods_id,buy_number:buy_number},
                    function(res){
                        console.log(res);
                            // lay.mag(res.font,{icon:res,code});
                            _this.parents('td').prev('td').text("￥"+res);
                    },
                    'text'
                    );  
            }
            //复选框选中
            function checkedTr(_this)
            {
                _this.parents('tr').find("input[type='checkbox']").prop('checked',true);
            }
            // 总价
            function getCount()
            {
                var _box = $('.box');
                var goods_id = '';
                _box.each(function(index) {
                    if ($(this).prop('checked') == true) {
                        goods_id += $(this).parents('tr').attr('goods_id') + ',';
                    }
                })
                goods_id = goods_id.substr(0, goods_id.length - 1);
                //吧商品id传给控制器 获取商品总价
               
                $.post(
                    "/car/count", {
                        goods_id: goods_id
                    },
                    function(res) {
                        $('#count').text(res);
                    }
                );
            }

            
</script>
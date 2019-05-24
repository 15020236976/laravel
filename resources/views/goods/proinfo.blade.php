<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Author" contect="http://www.webqin.net">
    <title>商品详情</title>
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
       <h1>产品详情</h1>
      </div>
     </header>
     <div id="sliderA" class="slider">
      <img src="http://www.img.com/{{$res->goods_img}}" />
      
     </div><!--sliderA/-->
     <input type="hidden" id="goods_number" name="goods_number" value="{{$res->goods_number}}">
     <input type="hidden" id="goods_id" name="goods_id" value="{{$res->goods_id}}">
     <table class="jia-len">
      <tr>
       <th><strong class="orange">{{$res->shop_price}}</strong></th>
        <td align="center">
                  <div class="c_num">
                        <input type="button" id="jian" value="-" class="car_btn_1 " />
                        <input type="text" value="1" style="width: 25px;" name="" id="buy_number" class="car_ipt buy_number" />
                        <input type="button" id="add" value="＋" class="car_btn_2" />
                  </div>
            </td>
      </tr>
      <tr>
       <td>
        <strong>{{$res->goods_name}}</strong>
        <p class="hui">高质量 高品质</p>
       </td>
       <td align="right">
        <a href="javascript:;" class="shoucang"><span class="glyphicon glyphicon-star-empty"></span></a>
       </td>
      </tr>
     </table>
     <div class="height2"></div>
     <h3 class="proTitle">商品规格</h3>
     <ul class="guige">
      <li class="guigeCur"><a href="javascript:;">50</a></li>
      <li><a href="javascript:;">100</a></li>
      <li><a href="javascript:;">150</a></li>
      <li><a href="javascript:;">200</a></li>
      <li><a href="javascript:;">300</a></li>
      <div class="clearfix"></div>
     </ul><!--guige/-->
     <div class="height2"></div>
     <div class="zhaieq">
      <a href="javascript:;" class="zhaiCur">商品简介</a>
      <a href="javascript:;">商品参数</a>
      <a href="javascript:;" style="background:none;">订购列表</a>
      <div class="clearfix"></div>
     </div><!--zhaieq/-->
     <div class="proinfoList">
      <img src="http://www.img.com/{{$res->goods_img}}" width="636" height="822" />
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息....
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息......
     </div><!--proinfoList/-->
     <table class="jrgwc">
      <tr>
       <th>
        <a href="/"><span class="glyphicon glyphicon-home"></span></a>
       </th>
       <td ><a class="addCart" href="#" style=color:red><h3>加入购物车</h3></a></td>
      </tr>
     </table>
     <hr>
    <table border="1">
        <tr style=color:red>
        <th>添加评论</th>
        </tr>
        <tr>
            <td colspan="2" id="user" value="{{$user->u_email}}">用户名：{{$user->u_email}}</td>
            
        </tr>
        <tr>
            <td>评价等级</td>
            <td><input type="radio" name="rank" class="rank" value="1">1级<input type="radio" name="rank" class="rank" value="2">2级<input type="radio" name="rank" class="rank" value="3">3级<input type="radio" name="rank" class="rank" value="4">4级<input type="radio" name="rank" class="rank" value="5">5级</td>
        </tr>
        <tr>
            <td>评价内容</td>
            <td><textarea name="content" class="content" cols="50" rows="5"></textarea></td>
        </tr>
        <tr>
            <td colspan="2"><input type="button" id="btn8" value="提交"></td>
        </tr>
    </table>
    <hr>
    <div class="con">
    <table>
        
        <tr style=color:red>
            <th>用户评论</th>
        </tr>
        @foreach($data as $v)
        <tr>
            <td>{{$v->username}}&nbsp;&nbsp;&nbsp;&nbsp;{{$v->rank}}星</td>
        </tr>
        <tr>
            <td>{{$v->content}}</td>

        </tr>
        <tr>
            <td align=right>{{$v->created_at}}</td>
        </tr>
        <tr>
           <td><hr></td>
        </tr>
        @endforeach
        
    </table>
    {{$data->links()}}
   </div>
    </div><!--maincont-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/index/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/index/js/bootstrap.min.js"></script>
    <script src="/index/js/style.js"></script>
    <!--焦点轮换-->
    <script src="/index/js/jquery.excoloSlider.js"></script>
    <script>
		$(function () {
		 $("#sliderA").excoloSlider();
		});
	</script>
     <!--jq加减-->

   <script>
	$('.spinnerExample').spinner({});
	</script>
  </body>
</html>
<script>
     //点击加号
            $("#add").click(function(){
                var goods_number=$('#goods_number').val();
                var buy_number=parseInt($("#buy_number").val());
                
                if(buy_number>=goods_number){
                    $("#buy_number").val(goods_number);
                    $(this).prop('disabled',true);
                }else{
                    buy_number=buy_number+1;
                    $('#buy_number').val(buy_number);
                    //-生效
                    $(this).next('input').prop('disabled',false);
                }  
            });
            //点击减号
            $("#jian").click(function(){

                var buy_number=parseInt($("#buy_number").val());
                
                if(buy_number<=1){
                    $("#buy_number").val(1);
                    $(this).prop('disabled',true);
                }else{
                    buy_number=buy_number-1;
                    $('#buy_number').val(buy_number);
                    //+生效
                    $(this).prev('input').prop('disabled',false);
                }  
            });
             //失去焦点
            $('#buy_number').blur(function(){
                var _this=$(this);
                var buy_number=parseInt(_this.val());//7
                var goods_number=parseInt($("#goods_number").val());//100
                var reg=/^\d+$/;
                
                if(buy_number==''||buy_number<=1||!reg.test(buy_number)){
                    // alert(1);
                    _this.val(1);
                }else if(buy_number>=goods_number){
                    // alert(2);
                    // alert(goods_number);
                    _this.val(goods_number);
                }else{
                    // alert(3);
                    // alert(buy_number);
                    // alert(goods_number);
                    goods_number=parseInt(buy_number);
                    _this.val(goods_number);


                }
            });
            //加入购物车
            $('.addCart').click(function(){
                //获取商品id
                var goods_id=$('#goods_id').val();
                var buy_number=$('#buy_number').val();
                        // console.log(goods_id);
                        // console.log(buy_number);
                
                $.post(
                    "/car/addcar",
                    {goods_id:goods_id,buy_number:buy_number},
                    function(msg){
                        if(msg.code==1){
                            alert(msg.font);
                        }
                        },
                      'json',
                    );
                return false;
            });
            //评论添加
            $("#btn8").click(function(){
                    // alert(8);
                var goods_id=$("#goods_id").val()
                var username=$("#user").attr('value');

                var rank=$(":checked").val();
                
                var content=$(".content").val();
                $.post(
                    "/goods/comment",
                    {username:username,rank:rank,content:content},
                    function(msg){
                        if(msg.code==1){
                            alert(msg.font);
                            window.location.href="/goods/proinfo/"+goods_id;
                        }
                    },
                    'json'
                    );

            });
            //ajax分页
            $(document).on('click', '.pagination a', function() {
                // alert(4);
                var url=$(this).attr('href');
                $.get(
                    url,
                    function(msg){
                        $(".con").html(msg);
                    }
                    );
                return false;
            });
</script>
    @extends('layouts.shop')
    @section('title', '黑金商城')
    @section('content')

     <div class="head-top">
      <img src="/index/images/hand22.jpg" />
      <dl>
       <dt><a href="/user"><img src="/index/images/touxiang22.jpg" /></a></dt>
       <dd>
        <h1 class="username">终身荣誉会员</h1>
        <ul>
         <li><a href="/goods/list"><strong>{{$zongshu}}</strong><p>全部商品</p></a></li>
         <li><a href="javascript:;"><span class="glyphicon glyphicon-star-empty"></span><p>收藏本店</p></a></li>
         <li style="background:none;"><a href="javascript:;"><span class="glyphicon glyphicon-picture"></span><p>二维码</p></a></li>
         <div class="clearfix"></div>
        </ul>
       </dd>
       <div class="clearfix"></div>
      </dl>
     </div><!--head-top/-->
     <form action="#" method="get" class="search">
      <input type="text" class="seaText fl" />
      <input type="submit" value="搜索" class="seaSub fr" />
     </form><!--search/-->
     @if(session('u_email'))
     
     @else
    <ul class="reg-login-click">
      <li><a href="login/index">登录</a></li>
      <li><a href="login/reg" class="rlbg">注册</a></li>
      <div class="clearfix"></div>
     </ul><!--reg-login-click/-->
     @endif
    <!-- 首页大图 -->
     <div id="sliderA" class="slider">
      @foreach ($img as $v)
      <img src="http://www.img.com/{{$v->goods_img}}" />
      @endforeach
     </div><!--sliderA/-->
     <ul class="pronav">
      @foreach($cate as $v)
      <li><a href="javascript:;">{{$v->cate_name}}</a></li>
      @endforeach
      <div class="clearfix"></div>
     </ul><!--pronav/-->
     <div class="index-pro1">
       @foreach ($res as $v)
      <div class="index-pro1-list">
       <dl>
        <dt><a href="/goods/proinfo/{{$v->goods_id}}"><img src="http://www.img.com/{{$v->goods_img}}" /></a></dt>
        <dd class="ip-text"><a href="proinfo.html">{{$v->goods_name}}</a><span>已售：{{$v->goods_number}}</span></dd>
        <dd class="ip-price"><strong>¥{{$v->shop_price}}</strong> <span>¥{{$v->market_price}}</span></dd>
       </dl>
      </div>
         @endforeach
      <div class="clearfix"></div>
     </div><!--index-pro1/-->
  
    
     <div class="prolist">

      <dl>
       <dt><a href="javascript:;"><img src="/index/images/prolist1.jpg" width="100" height="100" /></a></dt>
       <dd>
        <h3><a href="javascript:;">四叶草</a></h3>
        <div class="prolist-price"><strong>¥299</strong> <span>¥599</span></div>
        <div class="prolist-yishou"><span>5.0折</span> <em>已售：35</em></div>
       </dd>
       <div class="clearfix"></div>
      </dl>
      
     </div><!--prolist/-->
     <div class="joins"><a href="javascript:;"><img src="/index/images/jrwm.jpg" /></a></div>
     <div class="copyright">Copyright &copy; <span class="blue">这是就是三级分销底部信息&nbsp;&nbsp;&nbsp;&nbsp;<a href="/login/logout" >退出</a></span></div>
    
     @include('public/footer')
     @endsection
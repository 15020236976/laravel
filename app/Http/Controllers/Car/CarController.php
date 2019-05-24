<?php

namespace App\Http\Controllers\Car;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Goods;
use App\Model\Car;
use App\Model\Order;
use DB;

class CarController extends Controller
{
	//购物车展示
    public function list()
    {
    	$user_id=session('user_id');
    	$data=Goods::join('cart','goods.goods_id','=','cart.goods_id')->where('cart.is_del','=',1)->where('cart.user_id','=',$user_id)->get();
    	$count=Car::where('cart.is_del','=',1)->where('cart.user_id','=',$user_id)->count();
    	// dd($data);
    	foreach ($data as $k => $v) {
    		$xiaoji=$v->shop_price*$v->buy_number;
    		$data[$k]->xiaoji=$xiaoji;
    	}

    	
    	return view('car/list',['data'=>$data,'count'=>$count]);
    }
    //添加到购物车
    public function addcar()
    {
        
    	$goods_id=request()->goods_id;
    	$buy_number=request()->buy_number;
    	// dump($goods_id);
    	// dd($buy_number);
    	$user_id=session('user_id');
    	$post['goods_id']=$goods_id;
    	$post['buy_number']=$buy_number;
    	$post['user_id']=$user_id;

    	$cartWhere=[
            ['goods_id','=',$goods_id],
            ['user_id','=',$user_id],
            ['is_del','=',1]
            

        ];
        $cartInfo=Car::where($cartWhere)->first();
        $cartnumber=$cartInfo['buy_number'];
        if(!empty($cartInfo)){
            //检测库存 累加
            
            $goods_number=Goods::where('goods_id','=',$goods_id)->value('goods_number');
            if($cartnumber+$buy_number>$goods_number){
            echo json_encode(['font'=>'库存不足','code'=>1]);             
            }
            
            $result=Car::where($cartWhere)->update(['buy_number'=>$buy_number+$cartnumber]);
            // dump($result);die;
        }else{
            //检测库存 添加
            $goods_number=Goods::where('goods_id','=',$goods_id)->value('goods_number');
            if($cartnumber+$buy_number>$goods_number){
            echo json_encode(['font'=>'库存不足','code'=>1]);             
            }
            $info=[
                'goods_id'=>$goods_id,
                'buy_number'=>$buy_number,
                'user_id'=>$user_id
            ];
            $result=Car::create($info);
            // dump($result);die;
        }
        if($result){
            echo json_encode(['font'=>'加入购物车成功','code'=>1]);
            
        }else{
            echo json_encode(['font'=>'加入购物车失败','code'=>1]);
            
        }
    }
    //购物车点击加号
    public function changenumber()
    {
        
    	$buy_number=request()->buy_number;
    	$goods_id=request()->goods_id;
    	$user_id=session('user_id');
    	$cartWhere=[
            ['goods_id','=',$goods_id],
            ['user_id','=',$user_id],
            ['is_del','=',1]
        ];
    	//检测库存
    	$cartInfo=Car::where($cartWhere)->first();
        $cartnumber=$cartInfo['buy_number'];
        $goods_number=Goods::where('goods_id','=',$goods_id)->value('goods_number');
            if($cartnumber+$buy_number>$goods_number){
            echo json_encode(['font'=>'库存不足','code'=>2]);             
            }
        //修改数据库
            $where=[
                ['user_id','=',$user_id],
                ['goods_id','=',$goods_id],
                ['is_del','=',1]
            ];
           $result=Car::where($where)->update(['buy_number'=>$buy_number]);
           if($result){
                echo json_encode(['font'=>'','code'=>1]);

           }else{
                echo json_encode(['font'=>'修改失败','code'=>2]);
           }
    }
      //小计计算
    public function getTotal()
    {

        $goods_id=request()->goods_id;
        $buy_number=request()->buy_number;
        // dump($goods_id);die;
        // dump($buy_number);die;
        $res=Db::table('cart')->where('cart.goods_id','=',$goods_id)->join('goods','goods.goods_id','=','cart.goods_id')->value('shop_price');
        
        
        // dump($res);die;       
        $total=$buy_number*$res;
        // dump($total);die;
        echo $total;
        // dd($total);
    }
    //计算总价
    public function count()
    {
    	$goods_id= request()->goods_id;
        $goods_id=explode(',',$goods_id);
        //提取用户id
        $user_id = session('user_id');    
        $where=[
            'user_id'=>$user_id,
        ];
        //根据用户id去商品表查询价格和购买数量
        $data = DB::table('cart as c')
        ->select('buy_number','shop_price','c.goods_id')
        ->join('goods as g','c.goods_id','=','g.goods_id')
        ->where($where)
        ->whereIn('c.goods_id',$goods_id)
        ->get();
        $count=0;
            foreach($data as $k=>$v ){
                $count+=$v->buy_number*$v->shop_price;
            }
            echo  $count;
            session(['count'=>$count]);

    }
    //删除
    public function del()
    {
        $goods_id=request()->goods_id;
        if($goods_id==''){
        	echo json_encode(['font'=>'请至少选择一件商品','code'=>2]);die;
        }
        
            		$goods_id=explode(',',$goods_id);
                    $res=Db::table('cart')->whereIn('goods_id',$goods_id)->update(['is_del'=>2]);
                    // dump(model('Cart')->getLastSql());die;
                    // dump($res);die;
                    if ($res) {
                        echo json_encode(['font'=>'删除成功','code'=>1]);
                    }else{
                        echo json_encode(['font'=>'删除失败','code'=>2]);
                    }        
    }
    //结算
    public function buycar()
    {
        
    	$goods_id=request()->goods_id;
    	
    	$goods_id=explode(',',$goods_id);
    	// dd($goods_id);
    	$user_id=session('user_id');
    	
    	// dd($user_id);
		$res=Db::table('address')->where('user_id','=',$user_id)->where('is_default','=',1)->first();
		// dd($res);
    	$goods=Db::table('goods')
    	->join('cart','goods.goods_id','=','cart.goods_id')
    	->whereIn('goods.goods_id',$goods_id)
    	->get();
        
    	// dd($goods);
    	return view('car/buycar',['res'=>$res,'goods'=>$goods]);
    }
    //success
    public function success()
    {

        $user_id=session('user_id');
        $rand='AB'.rand(100000,999999).$user_id.'ZBCH';
        session(['rand'=>$rand]);
        // dd($rand);
        $time=date('Y-m-d');
        $overtime=date('Y-m-d',strtotime('+1 day'));
        // dd($time);
        $count=session('count');
        return view('car/success',['count'=>$count,'time'=>$time,'overtime'=>$overtime,'rand'=>$rand]);
    }
    /**
     *  pc端支付支付
     */
    public function pcpay()
    {
        $data['user_id']=session('user_id');
        $data['order_no']=session('rand');
        $data['order_amount']=session('count');
        $data['order_talk']='';
        $res=Order::create($data);

       
        require_once app_path('libs/moblePay/pagepay/service/AlipayTradeService.php');
        require_once app_path('libs/moblePay/pagepay/buildermodel/AlipayTradePagePayContentBuilder.php');

    //商户订单号，商户网站订单系统中唯一订单号，必填
    $out_trade_no = trim($data['order_no']);

    //订单名称，必填
    $subject = '商品';

    //付款金额，必填
    $total_amount = trim($data['order_amount']);

    //商品描述，可空
    $body = '商品';
    //构造参数
    $payRequestBuilder = new \AlipayTradePagePayContentBuilder();
    $payRequestBuilder->setBody($body);
    $payRequestBuilder->setSubject($subject);
    $payRequestBuilder->setTotalAmount($total_amount);
    $payRequestBuilder->setOutTradeNo($out_trade_no);

    $aop = new \AlipayTradeService(config('alipay'));
  

    /**
     * pagePay 电脑网站支付请求
     * @param $builder 业务参数，使用buildmodel中的对象生成。
     * @param $return_url 同步跳转地址，公网可以访问
     * @param $notify_url 异步通知地址，公网可以访问
     * @return $response 支付宝返回的信息
    */
    $response = $aop->pagePay($payRequestBuilder,config('alipay.return_url'),config('alipay.notify_url'));

    //输出表单
    var_dump($response);
    }
    /**
     * moble端支付
     */
    public function moblepay()
    {
        $data['user_id']=session('user_id');
        $data['order_no']=session('rand');
        $data['order_amount']=session('count');

        require_once app_path('libs/pcPay/wappay/service/AlipayTradeService.php');
        
        require_once app_path('libs/pcPay/pagepay/buildermodel/AlipayTradeWapPayContentBuilder.php');

        
        if (!empty($_POST['WIDout_trade_no'])&& trim($_POST['WIDout_trade_no'])!=""){
            //商户订单号，商户网站订单系统中唯一订单号，必填
            $out_trade_no = trim($data['order_no']);

            //订单名称，必填
            $subject = '商品';

            //付款金额，必填
            $total_amount = trim($data['order_amount']);

            //商品描述，可空
            $body = ‘商品;

            //超时时间
            $timeout_express="1m";

            $payRequestBuilder = new AlipayTradeWapPayContentBuilder();
            $payRequestBuilder->setBody($body);
            $payRequestBuilder->setSubject($subject);
            $payRequestBuilder->setOutTradeNo($out_trade_no);
            $payRequestBuilder->setTotalAmount($total_amount);
            $payRequestBuilder->setTimeExpress($timeout_express);

            $payResponse = new AlipayTradeService($config);
            $result=$payResponse->wapPay($payRequestBuilder,$config['return_url'],$config['notify_url']);

            return ;
        }
    }
}

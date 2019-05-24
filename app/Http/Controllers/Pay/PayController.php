<?php

namespace App\Http\Controllers\Pay;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class PayController extends Controller
{
	/**
	 * 同步 验签
	 * @return [type] [description]
	 */
    public function tongpay()
    {
		

    	$config=config('alipay');
		require_once app_path('libs/moblePay/pagepay/service/AlipayTradeService.php');

		// dd(456);
		$arr=$_GET;
		$alipaySevice = new \AlipayTradeService($config);
		$result = $alipaySevice->check($arr);

		/* 实际验证过程建议商户添加以下校验。
		1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号，
		2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额），
		3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）
		4、验证app_id是否为该商户本身。
		*/
		// dd(456);
		if($result) {//验证成功
			
			//请在这里加上商户的业务逻辑程序代码
			
			//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
		    //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表

			//商户订单号
			$data['order_no'] = htmlspecialchars($_GET['out_trade_no']);
			//金额
			$data['order_amount'] = htmlspecialchars($_GET['total_amount']);

			//支付宝交易号
			$trade_no = htmlspecialchars($_GET['trade_no']);
			$res=Db::table('order')->where($data)->first();
			if(!$res){
				echo "支付宝交易号：" . $trade_no . "订单号" . $data['order_no'] . "订单金额" . $data['order_amount'] . "此订单有问题";
                exit;
			}	
			//判断商户的id是否与付款的商户id一致
            if (config('alipay.seller_id') != htmlspecialchars($_GET['seller_id'])) {
                echo "支付宝交易号：" . $trade_no . "订单号" . $data['order_no'] . "订单金额" . $data['order_amount'] . "此订单有问题商户id不匹配";
                exit;
            }
			//判断用户的id是否与付款的用户id一致
            if (config('alipay.app_id') != htmlspecialchars($_GET['app_id'])) {
                echo "支付宝交易号：" . $trade_no . "订单号" . $data['order_no'] . "订单金额" . $data['order_amount'] . "此订单有问题用户id不匹配";
                exit;
            }
            echo "验证成功,支付宝交易账户" . $trade_no;
            return redirect('/');

			//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
			
			/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		}
		else {
		    //验证失败
		    echo "验证失败";
		}
	}
}

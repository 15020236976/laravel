<?php

namespace App\Http\Controllers\Login;
use App\Model\Login;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;

class LoginController extends Controller
{
	//登陆
    public function login()
    {
    	return view('login/index');
    }
    //注册
    public function reg()
    {
    	return view('login/reg');
    }
    //账号唯一性
    public function checkname()
    {
         $name1=request()->name1;
		
		if(!empty($name1)){
		    
		   $res=Login::where(['u_phone'=>$name1])->orwhere(['u_email'=>$name1])->count();
			if($res){
				return ['code'=>1];
					}
		}  
    }
    //验证码发送
    public function send()
    {
         $name2=request()->name2;

        if(strlen($name2)<11){
        	echo json_encode(['code'=>2,'font'=>'请输入正确手机号或邮箱']);die;
        }else if(strlen($name2)>11 && strpos($name2,'@') == false){
        	echo json_encode(['code'=>2,'font'=>'请输入正确手机号或邮箱']);die;
        }else if($name2){
        	$res=Login::where(['u_phone'=>$name2])->orwhere(['u_email'=>$name2])->count();
			if($res>=1){
				echo json_encode(['code'=>2,'font'=>'该账号已存在']);die;
					}
        }else{
        	if(strpos($name2,'@') != false){
         	//邮箱
         	$code=rand(1000,9999);
         	$this->sendemail($name2,$code);
         	request()->session->forget('code');
         	session(['code'=>$code]);

         }else{
         	//手机短信
         	$code=rand(1000,9999);
         	$this->messagee($name2,$code);
         	request()->session->forget('code');
         	session(['code'=>$code]);
         }
        }
         

    }
    /**
     * 手机短信发送类
     */
    public function messagee($name2,$code)
    {
    	
    	$host = "http://dingxin.market.alicloudapi.com";
	    $path = "/dx/sendSms";
	    $method = "POST";
	    $appcode = "77d584944f0d4b129791bf844735a241";
	    $headers = array();
	    array_push($headers, "Authorization:APPCODE " . $appcode);
	    $querys = "mobile=$name2&param=code%3A$code&tpl_id=TP1711063";
	    $bodys = "";
	    $url = $host . $path . "?" . $querys;

	    $curl = curl_init();
	    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
	    curl_setopt($curl, CURLOPT_URL, $url);
	    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
	    curl_setopt($curl, CURLOPT_FAILONERROR, false);
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($curl, CURLOPT_HEADER, false);
	    if (1 == strpos("$".$host, "https://"))
	    {
	        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
	    }
	    var_dump(curl_exec($curl));
	}
	/**
	 * 邮件发送类
	 */
	public function sendemail($name2,$code)
	{
		\Mail::send('email',['name'=>"你的验证码为$code"],function($message)use($name2){
					  //设置主题
					  $message->subject("123");
					  //设置接收方
					$message->to($name2);
					
			 });
	}
	//入库
	public function useradd()
	{
		$code=session('code');
		// dd($code);
		$u_email=request()->u_email;
		$u_code=request()->u_code;
		$u_pwd=request()->u_pwd;
		$post['u_email']=$u_email;
		$post['u_code']=$u_code;
		$post['u_pwd']=md5($u_pwd);
		$post['u_phone']='';
		$res=Login::create($post);
		if($res){
			return redirect('login/index');
		}
			

	}
	//登陆验证
	public function loginin()
	{
		$u_email=request()->u_email;
		$pwd=request()->u_pwd;
		$u_pwd=md5($pwd);
		// dd($u_pwd);
		$res=Login::where('u_email',$u_email)->where('u_pwd',$u_pwd)->first();
		$u_id=$res['u_id'];
		// dd($res);
		if($res){
			session(['u_email'=>$u_email,'user_id'=>$u_id]);
			echo json_encode(['code'=>1,'font'=>'登陆成功']);
		}else{
			echo json_encode(['code'=>2,'font'=>'登陆失败']);
		}



	}
	//退出登陆
	public function logout()
	{
		request()->session()->flush();
		return redirect('/');
	}
}

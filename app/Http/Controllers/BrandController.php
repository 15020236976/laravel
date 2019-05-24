<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests\StoreBrandPost;
use Illuminate\Support\Facades\Auth;
use App\Brand;

class BrandController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return view('brand.add');
		

	}
	/**
	 * 发送邮件
	 */

	public function sendemail()
	{
		$email=request()->email;
		//dd($email);
		$this->send($email);
		
	}
	public function send($email)
	{
		// \Mail::raw('hello' ,function($message)use($email){
		// //设置主题
		//     $message->subject("咔咔咔");
		// //设置接收方
		//     $message->to($email);
		// });
		\Mail::send('email',['name'=>$email],function($message)use($email){
					  //设置主题
					  $message->subject("123");
					  //设置接收方
					$message->to($email);
					
			 });


	}
	/**
	 * 登陆
	 */
	public function authenticate()
	{
		$email=request()->name;
		$password=request()->password;
	if (Auth::attempt(['email' => $email, 'password' => $password])) {
		// 认证通过...
		// echo 22;
		return redirect()->intended('admin/index');
		}else{
			echo "登陆失败（账号或密码错误）";
		}
	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('brand.add');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(StoreBrandPost $request)
   {
		 $data=request()->except('_token');
		 // $validatedData = $request->validate([
		 //     'brand_name' => 'required|unique:brand1|max:50'
			 
		 //     ],[
		 //    'brand_name.required'=>'名称不能为空',
		 //    'brand_name.unique'=>'名称不能重复',
		 //    'brand_name.max'=>'名称最大不能超过50',


		 //     ]);
		if($request->hasFile('brand_file')){
			$datas=$this->upload($request,'brand_file');
			if($datas['code']==1){
				$data['brand_file']=$datas['imgurl'];
			}
		}

		$res=brand::insert($data);
		if($res){
			return redirect('brand/list');
		}

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function list(Request $request)
	{
		// session(['uid'=>5]);
		// $request->session()->flush();
		// echo session('name');
		// \Cookie::queue('name','李四',2);
		// \Cookie::queue(\Cookie::forget('name'));

		$keyname=request()->keyname??'';
		$keyprice=request()->keyprice??'';
		// dd($keyname);
		$where=[];
		if($keyname){
			$where[]=['brand_name','like',"%$keyname%"];
		}
		if($keyprice){
			$where[]=['brand_price','like',"%$keyprice%"];

		}

		$pageSize=config('app.pageSize');
		// DB::connection()->enableQueryLog();
		$data=Db::table('brand1')->where($where)->paginate($pageSize);
		// $logs = DB::getQueryLog();
		// dd($logs);

		// dump($data);
		return view('brand.list',['data'=>$data,'keyname'=>$keyname,'keyprice'=>$keyprice]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$res=Db::table('brand1')->where(['brand_id'=>$id])->delete();
		if($res){
			return redirect('brand/list');
		}

	}

	/*文件上传**/
	public function upload(Request $request, $file)
	{
		if($request->file($file)->isValid()){
			$photo = $request->file($file);
			$store_result = $photo->store('photo');
			return ['code'=>1,'imgurl'=>$store_result];
		}else{
			return ['code'=>0,'message'=>'上传出错'];
		}
	}
}

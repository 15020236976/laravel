<?php

namespace App\Http\Controllers\Address;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Address;
use DB;
class AddressController extends Controller
{
	//地址列表
    public function list()
    {
        // $data=cache('data');
        // if(!$data){
            $data=Address::get();
            // $data=cache(['data'=>$data],5);

        // }
        $goods_id=request()->goods_id;
    	
    	// dd($data);
    	return view('address/list',['data'=>$data,'goods_id'=>$goods_id]);
    }
    //地址添加
    public function add()
    {
    	$addressinfo=$this->getaddressinfo(0);
    	// dump($addressinfo);
    	return view('address/add',['addressinfo'=>$addressinfo]);
    }
    //查找省级
    public function getaddressinfo($pid)
    {
    	$addressinfo=Db::table('area')->where('pid','=',$pid)->get();
    	return $addressinfo;
    }
    //获取option
    public function option()
    {
    	$id=request()->id;
    	$res=Db::table('area')->where('pid','=',$id)->get();
    	echo json_encode($res);
    }
    //地址入库
    public function doadd()
    {
    	$data=request()->data;
    	// dd($data);
    	$user_id=session('user_id');
    	$data['user_id']=$user_id;
    	if($data['is_default']==1){
    		$where=[
    			['user_id','=',$user_id],
    			['is_del','=',1]
    		];
    		$res=Db::table('address')->update(['is_default'=>2]);
    	}
    	//判断是添加还是修改
    	if(empty($data['address_id'])){
    		//添加
    		$res=Address::create($data);
    		if($res){
    			echo json_encode(['code'=>1,'font'=>'添加成功']);
    		}else{
    			echo json_encode(['code'=>2,'font'=>'添加失败']);
    		}
    	}else{
    		//修改
            $where=[
                ['user_id','=',$user_id],
                ['address_id','=',$data['address_id']]
            ];
            $res=Address::save($data,$where);
            if($res){
                echo json_encode(['font'=>'修改成功','code'=>1]);
            }else{
                echo json_encode(['font'=>'修改失败','code'=>2]);
        }
    	}
    }
    /**
     * 点击地址修改为默认
     */
    public function moren()
    {
        $address_id=request()->address_id;
        $user_id=session('user_id');
        // dd($address_id);
        $where1=[
                ['user_id','=',$user_id]
                
            ];
        $where=[
                ['user_id','=',$user_id],
                ['address_id','=',$address_id]
            ];
        $res=Address::where($where1)->update(['is_default'=>2]);   
        $res1=Address::where($where)->update(['is_default'=>1]);
        if($res1){
            echo json_encode(['code'=>1]);
        }

    }
}

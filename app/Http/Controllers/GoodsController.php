<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Goods;
use App\Model\Comment;
use DB;

class GoodsController extends Controller
{
    public function proinfo($goods_id)
    {
        if(empty(session('user_id'))){
            return redirect('login/index');
        }
        // $pageSize=config('app.pageSize');       
        $data=Db::table('comment')->orderBy('created_at','desc')->paginate(3);
   
        $user_id=session('user_id');
        $user=Db::table('user')->where(['u_id'=>$user_id])->first();
    	// $goods_id=request()->goods_id;
        
        $res=cache('res_'.$goods_id);
        if(!$res){
            // echo 4;
            $res=Goods::where('goods_id','=',$goods_id)->first();
            cache(['res_'.$goods_id=>$res],12*60);
        } 
        // dd($res);
        if(request()->ajax()){
            return view('goods/ajaxproinfo',['res'=>$res,'user'=>$user,'data'=>$data]);
        }
    	return view('goods/proinfo',['res'=>$res,'user'=>$user,'data'=>$data]);
        
    }
    /**
     * 所有商品展示
     */
    public function list()
    {
    	$data=Goods::get();
    	return view('goods/list',['data'=>$data]);
    }
    /**
     * 评论添加
     */
    public function comment()
    {
        $data['username']=request()->username;
        $data['rank']=request()->rank;
        $data['content']=request()->content;
        $res=Comment::create($data);
        if($res){
            echo json_encode(['font'=>'评论成功','code'=>1]); 
        }
        // return redirect('/goods/proinfo');

    }
}

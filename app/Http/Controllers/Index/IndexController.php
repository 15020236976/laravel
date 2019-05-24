<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Goods;
use DB;


class IndexController extends Controller
{
    public function index()
    {
        $zongshu=Db::table('goods')->count();
        // dd($zongshu);
        $res=cache('res');
        $img=cache('img');
        if(!$img){
            // echo 11;
             $img=Db::table('goods')->whereIn('goods_id',[12,20,21,23,26])->get();
             cache(['img'=>$img],60);
        }
       
        // dd($img);
        if(!$res){
        // dd($cate);
        $res=Goods::where('is_hot','=',1)->get();
         cache(['res'=>$res],60);
        }
    	$cate=Db::table('category')->where('parent_id','=',0)->get();
    	 // dd($res);
    	return view('index/index',['res'=>$res,'cate'=>$cate,'img'=>$img,'zongshu'=>$zongshu]);
    }
    //个人中心
    public function user()
    {
    	return view('index/user');
    }
}

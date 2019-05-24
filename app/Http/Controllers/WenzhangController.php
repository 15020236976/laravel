<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Redis;
use DB;
use App\Wenzhang;

class WenzhangController extends Controller
{
    public function add()
    {
        $res=Db::table('cate1')->get();
        // dd($res);
        return view('wenzhang/add',['res'=>$res]);
    }
    /**
     * 添加执行
     */
    public function doadd(Request $request)
    {
        $post=request()->except('_token');
        $validatePost=$request->validate([
            'tatle'=>'required|unique:wenzhang|alphaDash',
            'man'=>'required',
            'email'=>'required',
        ],[
            'tatle.required'=>'标题不能为空',
            
            'tatle.unique'=>'标题已存在',         
            'man.required'=>'作者不能为空',
            'email.required'=>'邮箱不能为空',

        ]);
        // dd($post);
        if($request->hasFile('file')){
            $datas=$this->upload($request,'file');
            if($datas['code']==1){
                $post['file']=$datas['imgurl'];
            }
        }
        // dd($post['file']);
        $wenzhangModel=new Wenzhang;
        foreach($post as $k => $v){
            $wenzhangModel->$k=$v;
        }
        $res=$wenzhangModel->save();
        if($res){
            return redirect('wenzhang/list');
        }

    }
    /**
     * 展示
     */
    public function list()
    {
        //搜索   redis
        
        $keyname=request()->keyname??'';
        $where=[];
        if($keyname){
            $where[]=['tatle','like',"%$keyname%"];
        }
        $pageSize=config('app.pageSize');
        //展示页面加入redis
        $res=cache('res');
        if(!$res){
            // echo 11;
            $res=Db::table('wenzhang')->where($where)->paginate($pageSize);
            cache(['res'=>$res],60);
        }
        

        // $res=Db::table('wenzhang')->join('cate1','cate1.c_id=wenzhang.c_id')->paginate($pageSize);
        // dd($res);
        return view('wenzhang/list',['res'=>$res,'keyname'=>$keyname]);
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
     /**
      * 删除
      */
      public function del()
      {
        $id=request()->id;
        $res=Db::table('wenzhang')->delete($id);
        if($res){
            echo 1;
        }
          
          
      }
      /*编辑*/
      public function upd($id)
      {
        $data=Wenzhang::find($id);
        $res=Db::table('cate1')->get();

        return view('wenzhang/doupd',['data'=>$data,'res'=>$res]);
      }
      /*编辑执行*/
      public function doupd($id)
      {
          $post=request()->except('_token');
        $validatePost=request()->validate([

            'tatle'=>'required|unique:wenzhang|alphaDash',
            'man'=>'required',
            'email'=>'required',
        ],[
            'tatle.required'=>'标题不能为空',
            
            'tatle.unique'=>'标题已存在',         
            'man.required'=>'作者不能为空',
            'email.required'=>'邮箱不能为空',

        ]);
        // dd($post);
        if(request()->hasFile('file')){
            $datas=$this->upload($request,'file');
            if($datas['code']==1){
                $post['file']=$datas['imgurl'];
            }
        }

        $res=Wenzhang::where(['id'=>$id])->update($post);
        if($res){

            return redirect('wenzhang/list');
        }

      }
      /**
       * 标题唯一性
       */
      public function check()
      {
        $tatle=request()->tatle;
        $count=Wenzhang::where(['tatle'=>$tatle])->count();
        // dd($count);
        if($count){
            return ['code'=>1,'count'=>$count];
        }
      }
}

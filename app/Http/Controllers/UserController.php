<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User1;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $post=request()->except('_token');
        // dump($post);
        $validatePost=$request->validate([
            'name'=>'required|unique:user1|alphaDash',
            'pwd'=>'required',
            'email'=>'required',
        ],[
            'name.required'=>'用户名不能为空',
            
            'name.unique'=>'用户名已存在',         
            'pwd.required'=>'密码不能为空',
            'email.required'=>'邮箱不能为空',

        ]);
        $userModel=new User1;
        foreach($post as $k => $v){
            $userModel->$k=$v;
        }

         $res=$userModel->save();
        if($res){
            // return redirect('user/list');
            echo 1;
        }
        


    }

    public function insert(Request $request)
    {
        return view('User.insert');
    }

    public function list(Request $request)
    {
        $keyname=request()->keyname??'';
        $where=[];
        if($keyname){
            $where[]=['name','like',"%$keyname%"];
        }
        $pageSize=config('app.pageSize');
        $res=Db::table('user1')->where($where)->paginate($pageSize);
        // dd($res);
        return view('User.list',['res'=>$res,'keyname'=>$keyname]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }
}

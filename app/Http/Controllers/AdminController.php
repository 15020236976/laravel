<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
    	return view('admin/index');
    }
    //左侧导航栏
    public function left()
    {
    	return view('admin/left');
    }
    //头部
     public function head()
    {
    	return view('admin/head');
    }
    //首页
    public function mail()
    {
    	return view('admin/main');
    }
    
   
}

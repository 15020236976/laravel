<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome',['name1'=>'laravel']);
// });

// Route::get('/admin', function () {
//     // return view('welcome',['name1'=>'laravel']);
//     return view('admin/index');
// });

// Route::redirect('view','/welcome',['aaa'=>'laravel学院']);

// Route::get('/goods/{id?}',function($id=''){
// 	echo "$id";
// 	echo 11;
// })->where('id','\d+');

// Route::get('/aaa',function(){
// 	return "<form method='post' action='/brand/bbb'>".csrf_field()."<input type='email' name='email'><input type='submit'></form>";
// });
Route::get('/aaa',function(){
	return "<form method='post' action='/brand/ccc'>".csrf_field()."用户名<input type='text' name='name'><br>密码<input type='password' name='password'><br><input type='submit'></form>";
});


// Route::post('/bbb',function(){
// 	echo request()->name;
// }); 

Route::prefix('/brand')->group(function(){
	Route::get('add','BrandController@create');
	Route::post('add_do','BrandController@store');
	Route::get('list','BrandController@list');
	Route::get('del/{id}','BrandController@destroy');
	Route::get('edit','BrandController@edit');
	Route::post('/bbb','BrandController@sendemail');
	Route::post('/ccc','BrandController@authenticate');

});

Route::prefix('/user')->middleware('CheckLogin')->group(function(){
	Route::get('add','UserController@create');
	Route::post('add_do','UserController@store');
	Route::get('list','UserController@list');
	Route::get('insert','UserController@insert');
});

Route::prefix('/admin')->group(function(){
	Route::get('index','AdminController@index');
	Route::get('left','AdminController@left');
	Route::get('head','AdminController@head');
	Route::get('main','AdminController@main');
});
/**
 * 测试题
 */
Route::prefix('/wenzhang')->group(function(){
	Route::get('add','WenzhangController@add');
	Route::post('doadd','WenzhangController@doadd');
	Route::get('list','WenzhangController@list');
	Route::post('del','WenzhangController@del');
	Route::get('upd/{id}','WenzhangController@upd');
	Route::post('doupd/{id}','WenzhangController@doupd');
	Route::post('check','WenzhangController@check');

});
/**
 * 前台index
 */
	Route::get('/','Index\IndexController@index');
	Route::get('/user','Index\IndexController@user');
/**
 * 登陆
 */
Route::prefix('/login')->group(function(){
	Route::get('index','Login\LoginController@login');
	Route::get('reg','Login\LoginController@reg');
	Route::post('checkname','Login\LoginController@checkname');
	Route::post('send','Login\LoginController@send');
	Route::post('useradd','Login\LoginController@useradd');
	Route::post('loginin','Login\LoginController@loginin');
	Route::get('logout','Login\LoginController@logout');
});
/**
 * 商品
 */
Route::prefix('/goods')->group(function(){
	Route::get('proinfo/{goods_id}','GoodsController@proinfo');
	Route::get('list','GoodsController@list');
	Route::post('comment','GoodsController@comment');


	

});
/**
 *购物车
 */
Route::prefix('/car')->group(function(){
	Route::get('list','Car\CarController@list');
	Route::post('addcar','Car\CarController@addcar');
	Route::post('changenumber','Car\CarController@changenumber');
	Route::post('getTotal','Car\CarController@getTotal');
	Route::post('count','Car\CarController@count');
	Route::post('del','Car\CarController@del');
	Route::get('buycar','Car\CarController@buycar');
	Route::get('success','Car\CarController@success');
	Route::get('pcpay','Car\CarController@pcpay');
	Route::get('moblepay','Car\CarController@moblepay');

	
});
/**
 * 地址管理
 */
Route::prefix('/address')->group(function(){
	Route::get('list','Address\AddressController@list');
	Route::get('add','Address\AddressController@add');
	Route::post('option','Address\AddressController@option');
	Route::post('doadd','Address\AddressController@doadd');
	Route::post('moren','Address\AddressController@moren');
	
});
/**
 * 支付宝支付 同步通知
 */
Route::prefix('/pay')->group(function(){
	Route::get('tongpay','Pay\PayController@tongpay');
	Route::get('yipay','Pay\PayController@yipay');
	
	
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

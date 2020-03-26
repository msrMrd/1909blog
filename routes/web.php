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
//闭报路由
Route::get('/', function () {
	// echo "123";
    return view('welcome');
});
Route::get('/index','IndexController@index');
Route::get('/goods','IndexController@goods');

// Route::get('/add','IndexController@add'); //让文本框显示
// Route::post('/adddo','IndexController@adddo'); //是用post方式传值

Route::get('/add','IndexController@add');
Route::post('/adddo','IndexController@adddo');

//一个路由支持多种请求方式
// Route::match(['get','post'],'/add','IndexController@add');
Route::match(['get','post'],'/add','IndexController@add');
Route::any('/add','IndexController@add');
//Route::any('/woshi','IndexController@add');

//路由视图
// Route::view('/a','add');
// Route::get('/b','IndexController@add');
// Route::view('/ss','add');

//必填路由
//Route::get('/show/{id}/{name}','IndexController@show');

//可选路由参数
//Route::get('/aa/{id?}/{name}','IndexController@aa');
//Route::get('/aa/{id?}','IndexController@aa');
//Route::get('/aa/{id?}/{name?}','IndexController@aa');

//正则约束
//Route::get('/ne/{id}','IndexController@ne')->where('id','[0-9]');
//Route::get('/ne/{id?}','IndexController@ne')->where('id','\d+');
// Route::get('/ne/{id?}/{name}','IndexController@ne')->where(['id'=>'\d+','name'=>'[a-zA-Z]+']);


//品牌
// Route::prefix('brand')->middleware('islogin')->group(function(){
Route::prefix('brand')->middleware('auth')->group(function(){
	Route::any('create','BrandController@create');
	Route::any('store','BrandController@store');
	Route::any('index','BrandController@index');
	Route::get('edit/{id}','BrandController@edit');
	Route::post('update/{id}','BrandController@update');
	Route::get('destory/{id}','BrandController@destory');
});

//分类
Route::prefix('category')->group(function(){
	Route::any('category','CategoryController@category');
	Route::any('cate_tj','CategoryController@cate_tj');
	Route::any('cate_show','CategoryController@cate_show');
	Route::any('edit/{id}','CategoryController@edit');
	Route::any('update/{id}','CategoryController@update');
	Route::any('destory/{id}','CategoryController@destory');
});
//商品
Route::prefix('goods')->middleware('auth.basic')->group(function(){
	Route::any('create','GoodsController@create');
	Route::any('score','GoodsController@score')->name('goodsscore');
	Route::any('index','GoodsController@index');
	Route::any('destroy/{id}','GoodsController@destroy');
	Route::any('edit/{id}','GoodsController@edit');
	Route::any('update/{id}','GoodsController@update')->name('goodsupdate');

});

//管理员
Route::prefix('admin')->group(function(){
	Route::get('create','AdminController@create');
	Route::post('store','AdminController@store');
	Route::get('index','AdminController@index');
	Route::get('edit/{id}','AdminController@edit');
	Route::post('update/{id}','AdminController@update');
	Route::get('destory/{id}','AdminController@destory');	
});

Route::prefix('news')->group(function(){
	Route::get('create','NewsController@create');
	Route::post('score','NewsController@score');
	Route::get('index','NewsController@index');

});

//练习
Route::any('/tj','StudentController@tj');
Route::any('/zx','StudentController@zx');
Route::any('/show','StudentController@show');
Route::any('/delete/{id}','StudentController@delete');

//练习
Route::any('/book_tj','BookController@book_tj');
Route::any('/book_zx','BookController@book_zx');
Route::any('/book_show','BookController@book_show');

//周考
Route::prefix('article')->group(function(){
	Route::get('create','ArticleController@create');
	Route::post('store','ArticleController@store');
	Route::get('index','ArticleController@index');
	Route::get('edit/{id}','ArticleController@edit');
	Route::post('update/{id}','ArticleController@update');
	Route::get('destory/{id}','ArticleController@destory');

});



Route::get('/','Index\IndexController@index')->name('index');
Route::get('/log','Index\LoginController@log');
Route::get('/reg','Index\LoginController@reg');
Route::get('/reg/sendSMS','Index\LoginController@sendSMS');
Route::get('/reg/sendEmail','Index\LoginController@sendEmail');
Route::post('/login/loginDo','Index\LoginController@loginDo');
Route::any('/reg/regdo','Index\LoginController@regdo');




Route::get('/cookie/add','Index\LoginController@addcookie');
Route::get('/cookie/get','Index\LoginController@getcookie');

//商品详情
Route::get('/goods/{id}','Index\GoodsController@index')->name('goods');
Route::any('/addcart','Index\GoodsController@addcart');
Route::get('/cartlist','Index\CartController@cartlist')->name('goods');
Route::post('/cart/getMoney','Index\CartController@getMoney');
Route::any('/confirm','Index\CartController@confirm');
Route::get('/cart/site','Index\CartController@site');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('login','LoginController@login')->name('login');
Route::post('logindo','LoginController@logindo');
Route::get('out','Index\LoginController@out');

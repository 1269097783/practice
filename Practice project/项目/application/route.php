<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// return [
//     '__pattern__' => [
//         'name' => '\w+',
//     ],
//     '[hello]'     => [
//         ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
//         ':name' => ['index/hello', ['method' => 'post']],
//     ],

// ];
use think\Route;
Route::rule('/','index');
Route::rule('/top','index/Index/top');
Route::rule('/left1','index/Index/left1');
Route::rule('/left2','index/Index/left2');
Route::rule('/left3','index/Index/left3');
Route::rule('/middle','index/Index/middle');
Route::rule('/zhuye','index/Index/zhuye');
Route::rule('/login','index/Login/index');
Route::rule('/verify','index/Login/verify');
Route::rule('/denlu','index/Login/denlu');
Route::rule('/yzm','index/Login/yzm');
Route::rule('/tuichu','index/Login/tuichu');
Route::rule('/user','index/User/index');
Route::rule('/tianjia','index/User/tianjia');
Route::rule('/pduser','index/User/pduser');
Route::rule('/tjiao','index/User/tjiao');
Route::rule('/shanchu','index/User/shanchu');
Route::rule('/shan','index/User/shan');
Route::rule('/xiugai','index/User/xiugai');
Route::rule('/gai','index/User/gai');
Route::rule('/quanxian','index/User/quanxian');
Route::rule('/chaxun','index/User/chaxun');
Route::rule('/chaxun','index/User/chaxun');
// Route::rule('type','index/Type/type');
Route::controller('types','Type');
Route::controller('vip','Vip');
Route::controller('chewei','Chewei');
Route::controller('chuku','Chuku');
Route::controller('xiangmu','Xiangmu');
Route::controller('jilu','Jilu');
Route::controller('qx','Quanxian');
Route::controller('role','Role');
Route::controller('allow','Allow');
Route::controller('nuoche','Nuoche');


<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
function mess($chepai,$phone,$templateid){
 //载入ucpass类
 import('Ucpaas',EXTEND_PATH);
 //填写在开发者控制台首页上的Account Sid
 $options['accountsid']='961a200fb37f09d3cb8a838d1dac6a36';
 //填写在开发者控制台首页上的Auth Token
 $options['token']='d57756352f39270ccd453563ee618634';
 //初始化 $options必填
 $ucpass = new \Ucpaas($options);
 $appid = "365b9fd17ed54d9d92b31d518f71b79e"; //应用的ID，可在开发者控制台内的短信产品下查看
 // $templateid = "481322";    //可在后台短信产品→选择接入的应用→短信模板-模板ID，查看该模板ID
 $param = $chepai; //多个参数使用英文逗号隔开（如：param=“a,b,c”），如为参数则留空
 // 存储验证码信息
 $mobile = $phone;
 // session_start();
 // $_SESSION['yzm']=$param;
 // $mobile = $_POST['phone'];
 $uid = "";

 //70字内（含70字）计一条，超过70字，按67字/条计费，超过长度短信平台将会自动分割为多条发送。分割后的多条短信将按照具体占用条数计费。

 return  $ucpass->SendSms($appid,$templateid,$param,$mobile,$uid);
 }
<?php
namespace app\index\controller;
use think\Controller;
use think\captcha\Captcha;
use think\Db;
use think\Session;
class Login extends Controller{
	public function index(){
		return $this->fetch('login');
	}

	public function verify(){
		$config =    [
	    // 验证码字体大小
	    'fontSize'    =>    15,    
	    // 验证码位数
	    'length'      =>    4,   
	    // 关闭验证码杂点
	    'useNoise'    =>    false, 
	];

	$captcha = new Captcha($config);
	return $captcha->entry(1);
	}

	//判断验证码
	public function yzm(){
		$yzm=input('yzm');
		 $captcha = new Captcha();
		if($captcha->check($yzm,$id = '1')){
			$arr=array('code'=>0);
		}else{
			$arr=array('code'=>1);
		}
		echo json_encode($arr);
	}

	//登录
	public function denlu(){
		$user=input('user');
		$pwd=md5(input('pwd'));
		$res=Db::name('user')->where(['user'=>$user,'pwd'=>$pwd])->find();
		if($res){
			Session::set('user',$user);
			Session::set('uid',$res['id']);
			$this->success('登录成功，正在跳转页面','/');
		}else{
			$this->error('密码或用户名错误');
		}
	}

	//退出登录
	public function tuichu(){
		Session::delete('user','think');
		$this->success('安全退出','/login');
	}

}
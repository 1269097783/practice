<?php
namespace app\index\controller;
use think\Controller;

class Index extends Allow{
    public function index(){
       //首页页面的方法
        return $this->fetch('index');
    }
    public function top(){
    	//加载首页top页面
       return $this->fetch('top');
	}
	public function left1(){
    	//加载首页left1页面
       return $this->fetch('left1');
	}
  public function left2(){
      //加载首页left2页面
       return $this->fetch('left2');
  }
   public function left3(){
      //加载首页left3页面
       return $this->fetch('left3');
  }
	public function middle(){
    	//加载首页middle页面
       return $this->fetch('middle');
	}
	public function zhuye(){
    	//加载首页top页面
       return $this->fetch('zhuye');
	}
}

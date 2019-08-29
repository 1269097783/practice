<?php
namespace app\index\controller;
use think\Controller;
use think\Db;

class Nuoche extends Allow{
	public function getindex(){
		return $this->fetch('nuoche');
	}
	//发送挪车信息
	public function postnuo(){
		dump(input());
		$phone=input('phone');
  		$chepai=input('chepai');
  		$templateid = "493981"; 
  		echo mess($chepai,$phone,$templateid);
	}
	//ajax查询车牌号码是否存在
	public function postcha(){
		//查看车牌是否存在小区内
		$res=Db::name('xingxi')->where(['chepai'=>input('chepai'),'qian'=>0])->find();
		if($res){
			if($res['jiaofei']==0){
				//临时停车
				$arr=Db::name('svip')->where('chepai',input('chepai'))->find();
				$data=array('code'=>1,'phone'=>$arr['phone']);
			}else{
				//小区住户
				$arr=Db::name('vip')->where('chepai',input('chepai'))->find();
				$data=array('code'=>1,'phone'=>$arr['phone']);
			}
		}else{
			//车牌不在小区内
			$data=array('code'=>0);
		}
		echo json_encode($data);
	}

}

?>
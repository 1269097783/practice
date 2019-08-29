<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
class Xiangmu extends Allow{
	//遍历收费项目
	public function getindex(){
		$data=Db::name('xiangmu')->select();
		return $this->fetch('bianli',['data'=>$data]);
	}
	//跳转收费项目
	public function gettianjia(){
		return $this->fetch('xinzengxiangmu');
	}
	//AJAX查看收费项目是否已经存在
	public function postchaname(){
		$res=Db::name('xiangmu')->where('name',input('name'))->find();
		if($res){
			$data['code']=1;
			$data['msg']='项目名已经存在';
		}else{
			$data['code']=0;
			$data['msg']='';
		}
		echo json_encode($data);
	}
	//添加收费项目
	public function postupdat(){
		$res=Db::name('xiangmu')->insert(['name'=>input('name'),'danjia'=>input('danjia'),'danwei'=>input('danwei')]);
		if($res){
			return $this->success('添加成功','/xiangmu/index');
		}else{
			return $this->error('添加失败');
		}
	}
	//跳转修改项目页面
	public function getxiou(){
		$data=Db::name('xiangmu')->find(input('id'));
		return $this->fetch('xiougaixiangmu',['data'=>$data]);
	}
	//AJAX修改查看收费项目是否已经存在
	public function postxiouname(){
		$arr=Db::name('xiangmu')->find(input('id'));
		if(input('name')==$arr['name']){
			$data['code']=0;
			$data['msg']='';
		}else{
			$res=Db::name('xiangmu')->where('name',input('name'))->find();
			if($res){
				$data['code']=1;
				$data['msg']='项目名已经存在';
			}else{
				$data['code']=0;
				$data['msg']='';
			}
		}
		echo json_encode($data);
	}
	//修改数据
	public function postxiougai(){
		$arr=Db::name('xiangmu')->where(['id'=>input('id'),'name'=>input('name'),'danjia'=>input('danjia'),'danwei'=>input('danwei')])->find();
		if(!$arr){
			$res=Db::name('xiangmu')->where('id',input('id'))->update(['name'=>input('name'),'danjia'=>input('danjia'),'danwei'=>input('danwei')]);
			if($res){
				return $this->success('修改成功','/xiangmu/index');
			}else{
				return $this->error('修改失败');
			}
		}else{
			return $this->success('没有修改内容','/xiangmu/index');
		}
		
	}
}

?>
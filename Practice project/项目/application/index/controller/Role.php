<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
class Role extends Allow{
	public function getindex(){
		$data=Db::name('role')->select();
		return $this->fetch('bianli',['data'=>$data]);
	}

	public function gettjjs(){
		$arr=Db::name('node')->where('pid',0)->select();
		if($arr){
			foreach($arr as $key=>$value){
				$res=Db::name('node')->where(['pid'=>$value['id'],'status'=>1])->select();
				$data[$value['cname']]=$res;
			}
			return $this->fetch('xinzeng',['data'=>$data]);
		}else{
			return $this->fetch('xinzeng',['data'=>array()]);
		}
	}
	public function postpdname(){
		$res=Db::name('role')->where('name',input('name'))->find();
		if($res){
			$data=array('code'=>1);
		}else{
			$data=array('code'=>0);
		}
		echo json_encode($data);
	}
	public function posttianjia(){
		$arr=input();
		if(isset($arr['nid'])){
			$nid=implode(',',$arr['nid']);
		}else{
			$nid='';
		}
		// 启动事务
		Db::startTrans();
		try{
			Db::name('role')->insert(['name'=>input('name')]);
			$res=Db::name('role')->where('name',input('name'))->find();
			DB::name('role_node')->insert(['rid'=>$res['id'],'nid'=>$nid]);
		    // 提交事务
		    Db::commit();
		    $code=0;  
		} catch (\Exception $e) {
		    // 回滚事务
		    Db::rollback();
		    $code=1;
		}
		
		if($code==0){
			$this->success('添加成功','/role/index');
		}else{
			$this->error('添加失败');
		}
	}
	public function getxiougai(){
		$role=Db::name('role')->find(input('id'));
		$role_node=Db::name('role_node')->where('rid',input('id'))->find();
		$nid=explode(',',$role_node['nid']);
		$arr=Db::name('node')->where('pid',0)->select();
		if($arr){
			foreach($arr as $key=>$value){
				$res=Db::name('node')->where(['pid'=>$value['id'],'status'=>1])->select();
				$data[$value['cname']]=$res;
			}
			return $this->fetch('xiougai',['data'=>$data,'role'=>$role['name'],'nid'=>$nid,'rid'=>input('id')]);
		}else{
			return $this->fetch('xiougai',['data'=>array(),'role'=>$role['name'],'nid'=>$nid,'rid'=>input('id')]);
		}
	}
	public function postxioug(){
		$arr=input();
		if(isset($arr['nid'])){
			$nid=implode(',',$arr['nid']);
		}else{
			$nid='';
		}
		// 启动事务
		Db::startTrans();
		try{
		    Db::name('role')->where('id',input('rid'))->update(['name'=>input('name')]);
		    Db::name('role_node')->where('rid',input('rid'))->update(['nid'=>$nid]);
		    // 提交事务
		    Db::commit();
		    $code=0;     
		} catch (\Exception $e) {
		    // 回滚事务
		    Db::rollback();
		    $code=1; 
		}
		if($code==0){
			$this->success('修改成功','/role/index');
		}else{
			$this->error('修改失败');
		}
	}
}
?>
<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
class Quanxian extends Allow{

	public function getjdbl(){
		$arr=Db::name('node')->where('pid',0)->select();
		if($arr){
			$i=0;
			foreach($arr as $key=>$value){
				$res=Db::name('node')->where('pid',$value['id'])->select();
				$data[$i]=$value;
				$i++;
				foreach($res as $k=>$v){
					$data[$i]=$v;
					$i++;
				}
			}
			return $this->fetch('bianli',['data'=>$data]);
		}else{
			return $this->fetch('bianli',['data'=>array()]);
		}
	}

	public function gettjjd(){
		$data=Db::name('node')->where(['pid'=>0,'status'=>1])->select();
		return $this->fetch('xinzeng',['data'=>$data]);
	}

	public function posttianjia(){
		$data['ename']=input('ename');
		$data['cname']=input('cname');
		$data['pid']=input('pid');
		$data['status']=input('status');
		$data['zhushi']=input('zhushi');
		$res=Db::name('node')->insert($data);
		if($res){
			$this->success('添加成功','/qx/jdbl');
		}else{
			$this->error('添加失败');
		}
	}

	public function postpdnode(){
		$res=Db::name('node')->where(['pid'=>input('pid'),'ename'=>input('ename')])->select();
		if($res){
			$data=array('code'=>1);
		}else{
			$data=array('code'=>0);
		}
		echo json_encode($data);
	}

	public function getqiyong(){
		if(input('status')==0){
			// 启动事务
			Db::startTrans();
			try{
			    Db::name('node')->where('id',input('id'))->update(['status'=>1]);
			    Db::name('node')->where('pid',input('id'))->update(['status'=>1]);
			    // 提交事务
			    Db::commit();
			    $res=true;    
			} catch (\Exception $e) {
			    // 回滚事务
			    Db::rollback();
			    $res=true; 
			}
		}else{
			// 启动事务
			Db::startTrans();
			try{
			    Db::name('node')->where('id',input('id'))->update(['status'=>0]);
			    Db::name('node')->where('pid',input('id'))->update(['status'=>0]);
			    // 提交事务
			    Db::commit();
			    $res=true;    
			} catch (\Exception $e) {
			    // 回滚事务
			    Db::rollback();
			    $res=true; 
			}
		}
		if($res){
			$this->success('修改成功','/qx/jdbl');
		}else{
			$this->error('修改失败');
		}
	}

	public function getxiougai(){
		$res=Db::name('node')->find(input('id'));
		return $this->fetch('xiougai',['res'=>$res]);
	}

	public function postupda(){
		if(input('ename')==input('yename')  && input('cname')==input('ycname') && input('zhushi')==input('yzhushi')){
			$this->error('未修改内容');
		}else{
			$res=Db::name('node')->where('id',input('id'))->update(['ename'=>input('ename'),'cname'=>input('cname'),'zhushi'=>input('zhushi')]);
			if($res){
				$this->success('修改成功','/qx/jdbl');
			}else{
				$this->error('修改失败');
			}
		}
		
	}

}

?>
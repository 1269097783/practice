<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use lib\Cattree;
class Chewei extends Allow{
	public function getindex(){
		//跳转车辆入库记录
		return $this->fetch('ruku');
	}
	//判断是否为小区住户
	public function postcha(){
  		$res=Db::name('vip')->where('chepai',input('chepai'))->find();
  		if($res){
  			//车牌是小区住户的
  			$chepai=input('chepai');
  			//不用缴费$i=1
  			$i=1;
  			return $this->xingxi($chepai,$i);
  		}else{
  			//车牌是临时停车的
  			//跳转添加临时停车信息
  			$res=Db::name('type')->where('pid','0')->select();
  			$data=Db::name('svip')->where('chepai',input('chepai'))->find();
  			if($data){
  				$arr=explode('-',$data['dizhi']);
  				$qu=Db::name('type')->where('name',$arr[0])->find();
  				$danyuan=Db::name('type')->where('name',$arr[1])->where('pid',$qu['id'])->find();
  				$menpai=$arr[3];
  				$dy=Db::name('type')->where('pid',$qu['id'])->select();
  				return $this->fetch('ssvip',['chepai'=>input('chepai'),'res'=>$res,'data'=>$data,'qu'=>$qu['id'],'danyuan'=>$danyuan['id'],'menpai'=>$menpai,'dy'=>$dy]);
  			}else{
  			return $this->fetch('svip',['chepai'=>input('chepai'),'res'=>$res]);
  			}
  		}
	}
	//新增临时停车信息
	public function postsvip(){
		$chepai=input('chepai');
		$qu=Db::name('type')->find(input('qu'));
		$lou=substr(input('menpai'),0,2);
		$danyuan=Db::name('type')->find(input('danyuan'));
		$dizhi=$qu['name'].'-'.$danyuan['name'].'-'.$lou.'楼-'.input('menpai');
		if(input('status')==0){
			//添加
			$res=Db::name('svip')->insert(['dizhi'=>$dizhi,'phone'=>input('phone'),'chepai'=>$chepai]);
			if($res){
				$i=0;
				return $this->xingxi($chepai,$i);
			}else{
				$res=Db::name('type')->where('pid','0')->select();
				return $this->error('添加失败，请从新添加',['chepai'=>$chepai,'res'=>$res]);
			}
		}else{
			//修改
			$srr=Db::name('svip')->where(['id'=>input('svipid'),'dizhi'=>$dizhi,'phone'=>input('phone'),'chepai'=>$chepai])->find();
			if($srr){
				$i=0;
				return $this->xingxi($chepai,$i);
			}else{
				$res=Db::name('svip')->where('id',input('svipid'))->update(['dizhi'=>$dizhi,'phone'=>input('phone'),'chepai'=>$chepai]);
				if($res){
					$i=0;
					return $this->xingxi($chepai,$i);
				}else{
					$res=Db::name('type')->where('pid','0')->select();
					return $this->error('修改失败',['chepai'=>$chepai,'res'=>$res]);
				}
			}
			
			
		}
		
	}
	//添加车辆入场信息
	public function xingxi($chepai,$i){
		//添加车辆出入信息
  			$re=Db::name('xingxi')->insert(['chepai'=>$chepai,'jiaofei'=>$i,'rudata'=>date('Y-m-d H:i:s')]);
  			if($re){
  				//跳转页面手动填写停车车位
  				$data=Db::name('chewei')->where('kong',0)->select();
  				return $this->fetch('rukuchewei',['chepai'=>$chepai,'data'=>$data]);
  			}else{
  				return $this->error('添加失败，请从新添加');
  			}
  			
	}
	//修改车牌停车位
	public function postchewei(){
		$arr=Db::name('chewei')->where('id',input('chewei_id'))->update(['kong'=>1]);
		$err=Db::name('xingxi')->where('chepai',input('chepai'))->where('qian',0)->update(['chewei_id'=>input('chewei_id')]);
		if($arr && $err){
			return $this->success('入库成功','/chewei/index');
		}else{
			return $this->error('入库失败');
		}
	}



}
?>
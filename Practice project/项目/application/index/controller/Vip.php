<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use lib\Cattree;
class Vip extends Allow{
	//住户信息遍历
	public function getindex(){
		if(input('tiaojian')){
			$tj=['name|phone'=>['like','%'.input('tiaojian')."%"]];
		}else{
			$tj=['id'=>['>','0']];
		}
		$a=Db::name('vip')->where($tj)->count();
		$cou=ceil($a/3);
		if(empty(input('page'))){$a=1;}else{$a=input('page');};
		$data=Db::name('vip')->where($tj)->limit(3)->page($a)->order(['id'=>'desc'])->select();
		foreach($data as $key=>$value){
			$res=Db::name('chewei')->where('vip_id',$value['id'])->find();
			$arr=Db::name('type')->where('id',$res['type_id'])->find();
			$data[$key]['ygcw']=$arr['name'];
		}
		$this->assign('data', $data);
		$link=array('zong'=>$cou,'page'=>$a);
		return $this->fetch('bianli',['link'=>$link]);
	}
	//新增住户
	public function getxzyh(){
		$res=Db::name('type')->where('pid','0')->select();
		return $this->fetch('xinzengzhuhu',['res'=>$res]);
	}
	//联动遍历单元
	public function getdanyuan(){
		$pid=input('pid');
		$data=Db::name('type')->where('pid',$pid)->select();
		echo json_encode($data);
	}
	//联动遍历未出售的车位
	public function getchewei(){
		$pid=input('pid');
		$data=Db::name('type')->alias('a')->join('tp_chewei b','a.id=b.type_id','LEFT')->where('a.pid',$pid)->where('b.status','0')->select();
		echo json_encode($data);
	}
	//住户添加
	public function posttianjia(){
		$qu=Db::name('type')->find(input('qu'));
		$danyuan=Db::name('type')->find(input('danyuan'));
		$lou=substr(input('menpai'),0,2);
		$name=input('name');
		$dizhi=$qu['name'].'-'.$danyuan['name'].'-'.$lou.'楼-'.input('menpai');
		$vip=Db::name('vip')->insert(['name'=>$name,'phone'=>input('phone'),'chepai'=>input('chepai'),'dizhi'=>$dizhi,'ruzhudate'=>date('Y-m-d H:i:s')]);
		if(!empty(input('chepai'))){
			$id=Db::name('vip')->where('name',$name)->order('id desc')->select();
			Db::name('chewei')->where('id',input('chewei'))->update(['status'=>'1','vip_id'=>$id[0]['id']]);
		}
		return $this->success('添加用户成功','/vip/index');
	}
	//修改页面回填信息
	public function getxg(){
		$xg=Db::name('vip')->find(input('id'));
		$arr=explode('-',$xg['dizhi']);
		$xg['menpai']=$arr['3'];
		$xg['qu']=$arr['0'];
		$xg['danyuan']=$arr['1'];
		$xg['chewei']='未购买';
		$res=Db::name('type')->where('pid','0')->select();
		$resa=Db::name('type')->where('pid','0')->where('name',$xg['qu'])->find();
		$ress=Db::name('type')->where('pid',$resa['id'])->select();
		$date=Db::name('type')->where('pid',$resa['id'])->where('name',$xg['danyuan'])->find();
		$dat=Db::name('type')->alias('a')->join('tp_chewei b','a.id=b.type_id','LEFT')->where('a.pid',$date['id'])->where('b.status','0')->select();
		$che=Db::name('chewei')->where('vip_id',input('id'))->find();
		if($che){
			$chew=Db::name('type')->find($che['type_id']);
			$dat['moren']=$chew;
			$xg['chewei']=$chew['name'];
		}
		return $this->fetch('xg',['data'=>$xg,'res'=>$res,'ress'=>$ress,'dat'=>$dat]);
	}
	//修改数据
	public function postxiougai(){
		$qu=Db::name('type')->find(input('qu'));
		$danyuan=Db::name('type')->find(input('danyuan'));
		$lou=substr(input('menpai'),0,2);
		$name=input('name');
		$dizhi=$qu['name'].'-'.$danyuan['name'].'-'.$lou.'楼-'.input('menpai');
		$vip=Db::name('vip')->where('id',input('id'))->update(['name'=>$name,'phone'=>input('phone'),'chepai'=>input('chepai'),'dizhi'=>$dizhi]);
		$chewei=Db::name('chewei')->where('vip_id',input('id'))->find();
		if($chewei){
			$id=Db::name('vip')->where('name',$name)->order('id desc')->select();
			Db::name('chewei')->where('id',input('chewei'))->update(['status'=>'1','vip_id'=>input('id')]);
			Db::name('chewei')->where('id',$chewei['id'])->update(['status'=>'0','vip_id'=>null]);
		}else{
			$id=Db::name('vip')->where('name',$name)->order('id desc')->select();
			Db::name('chewei')->where('id',input('chewei'))->update(['status'=>'1','vip_id'=>input('id')]);
		}
		
		return $this->success('修改用户成功','/vip/index');
	}
}
?>
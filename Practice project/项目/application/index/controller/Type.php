<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use lib\Cattree;
class Type extends Allow{
	//遍历顶级分类
	public function gettype(){
		$cates=Db::name('type')->where('pid','0')->select();
		foreach ($cates as $key=>$value){
			$res=Db::name('type')->where('pid',$value['id'])->select();
			$a=$i=0;
			foreach ($res as $k=>$v){
				$ress=Db::name('type')->where('pid',$v['id'])->select();
				$i+=count($ress);
				foreach($ress as $ke=>$va){
					$data=Db::name('chewei')->where('type_id',$va['id'])->where('kong','0')->find();
					if($data){
						$a+=1;
					}
				}
			}
			$cates[$key]['sheng']=$a;
			$cates[$key]['zong']=$i;
		}
		return $this->fetch('type',['cates'=>$cates]);
	}
	//遍历二级分类
	public function getertype(){
		$id=input('id');
		$fu=Db::name('type')->find($id);
		$cates=Db::name('type')->where('pid',$id)->select();
		foreach ($cates as $key=>$value){
			$res=Db::name('type')->where('pid',$value['id'])->select();
			$a=0;
			foreach($res as $k=>$v){
				$data=Db::name('chewei')->where('type_id',$v['id'])->where('kong','0')->find();
				if($data){
					$a+=1;
				}
			}
			$cates[$key]['sheng']=$a;
			$cates[$key]['zong']=count($res);
		}
		$name=$fu['name'];
		//判断是二级分类还是三级，跳转不同页面
		if(substr_count($fu['paty'],',')==1){
			return $this->fetch('ertype',['cates'=>$cates,'name'=>$name]);
		}else{
			return $this->fetch('santype',['cates'=>$cates,'id'=>$id,'name'=>$name]);
		}
	}

	public function getxztype(){
		$cates=Db::name('type')->where('pid','0')->select();
		return $this->fetch('xinzengtype',['cates'=>$cates]);
	}
	//判断添加的分区是否存在改路径下
	public function postchaxun(){
		$pid=input('pid');
		$name=input('name');
		$cha=Db::name('type')->where('pid',$pid)->where('name',$name)->select();
		if($cha){
			$arr=array('code'=>1);
		}else{
			$arr=array('code'=>0);
		}
		echo json_encode($arr);
	}
	//添加分区
	public function posttianjiatype(){
		if(input('pid')==0){
			$paty='0,';
		}else{
			$paty='0,'.input('pid').',';
		}
		$res=Db::name('type')->insert(['name'=>input('name'),'pid'=>input('pid'),'paty'=>$paty]);
		if($res){
			$this->success('添加成功','/types/type');
		}else{
			$this->error('添加失败');
		}
	}
	//添加二级分区
	public function getzhifenqu(){
		$cates=Db::name('type')->find(input('id'));
		return $this->fetch('tianjiazhi',['cates'=>$cates]);
	}
	//添加车位
	public function tjcw($name,$pid,$paty){
		$rese=Db::name('type')->where('pid',$pid)->select();
		$shu=(count($rese))+1;
		$names=$name.'-'.$shu;
		$res=Db::name('type')->insert(['name'=>$names,'pid'=>$pid,'paty'=>$paty]);
		$data=Db::name('type')->where('name',$names)->find();
		Db::name('chewei')->insert(['type_id'=>$data['id']]);
		if($res){
			return true;
		}else{
			return false;
		}
	}
	//控制添加多少个车位
	public function postcheshu(){
		$chishu=input('shuliang');
		$name=input('quname').'-'.input('danyuanname');
		$pid=input('danyuanid');
		$paty='0,'.input('quid').','.input('danyuanid').',';
		$a=0;
		for ($i=1;$i<=$chishu;$i++) {
			$res=$this->tjcw($name,$pid,$paty);
			if($res){
				$a++;
			};
		};
		$shuchu=$name.'成功添加'.$a.'个车位';
		$this->success($shuchu,'/types/type');
	}
	//添加车位数
	public function getchewei(){
		$data=Db::name('type')->find(input('pid'));
		$res=Db::name('type')->find($data['pid']);
		return $this->fetch('chewei',['data'=>$data,'res'=>$res]);
	}
	//删除
	public function postshan(){
		$arr=Db::name('type')->where('pid',input('pid'))->order('id desc')->limit(input('shu'))->select();
		$i=0;
		foreach($arr as $key=>$value){
			$res=Db::name('type')->delete($value['id']);
			$i++;
		}
		$shuchu='成功删除'.$i.'个车位';
		$this->success($shuchu,'/types/ertype/id/'.input('pid'));
	}
	//删区方法
	public function shanquf($id){
		$arr=Db::name('type')->where('pid',$id)->select();
		$i=0;
		foreach($arr as $key=>$value){
			$res=Db::name('type')->delete($value['id']);
			$i++;
		}
		$data=Db::name('type')->find($id);
		Db::name('type')->delete($id);
		return array('i'=>$i,'pid'=>$data['pid']);
	}
	//二级分类删除
	public function getshanqu(){
		$id=input('pid');
		$i=$this->shanquf($id);
		$shuchu='成功删除'.$i['i'].'个车位';
		$this->success($shuchu,'/types/ertype/id/'.$i['pid']);
	}
	//顶级分类删除
	public function getshanding(){
		$pid=input('pid');
		$res=Db::name('type')->where('pid',$pid)->select();
		$a=$b=0;
		foreach($res as $key=>$value){
			$id=$value['id'];
			$i=$this->shanquf($id);
			$b+=$i['i'];
			$a++;
		}
		Db::name('type')->delete($pid);
		$shuchu='成功删除'.$a.'个单元'.$b.'个车位';
		$this->success($shuchu,'/types/type');
	}
	//加载修改二级分类名页面
	public function getxiougaier(){
		$res=Db::name('type')->find(input('id'));
		$ress=Db::name('type')->find($res['pid']);
		return $this->fetch('xiougaiertype',['fu'=>$ress,'res'=>$res]);
	}
	//修改三级分类名
	public function xiougais($pid,$name,$i){
			$arr=Db::name('type')->where('pid',$pid)->select();
			foreach ($arr as $key=>$value){
				$namer=explode('-',$value['name']);
				$namer[$i]=$name;
				$names=implode('-',$namer);
				Db::name('type')->where('id',$value['id'])->update(['name'=>$names]);
			}
	}
	//执行修改三级分类名二级分类名
	public function postxiougai(){
		$cha=Db::name('type')->find(input('pid'));
		if(input('name')==$cha['name']){
			$this->success('修改成功','/types/ertype/id/'.$cha['pid']);
		}else{
			$pid=input('pid');
			$name=input('name');
			$this->xiougais($pid,$name,'1');
			Db::name('type')->where('id',$pid)->update(['name'=>$name]);
			$this->success('修改成功','/types/ertype/id/'.$cha['pid']);
		}
	}
	
}



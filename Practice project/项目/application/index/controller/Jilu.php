<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
class Jilu extends Allow{
	//遍历收费记录
	public function getindex(){
		if(input('tiaojian')){
			$arr=Db::name('xiangmu')->where(['name'=>['like','%'.input('tiaojian').'%']])->find();
			$tj=['s.xiangmu_id'=>$arr['id']];
		}else{
			$tj=['s.id'=>['>','0']];
		}
		$a=Db::name('shoufei')->alias('s')->where($tj)->count();
		$cou=ceil($a/10);
		if(empty(input('page'))){$a=1;}else{$a=input('page');};
		$data=Db::name('shoufei')->alias('s')->join('tp_vip v','s.vip_id=v.id','LEFT')->join('tp_xiangmu x','s.xiangmu_id=x.id','LEFT')->field('s.*,v.dizhi,x.name')->where($tj)->limit(10)->page($a)->order(['id'=>'desc'])->select();
		$this->assign('data', $data);
		$link=array('zong'=>$cou,'page'=>$a);
		return $this->fetch('bianli',['link'=>$link]);
	}
	//跳转水电费页面
	public function getjiaofei(){
		$res=Db::name('type')->where('pid',0)->select();
		$ress=Db::name('type')->where('pid',$res[0]['id'])->select();
		return $this->fetch('jiaofei',['res'=>$res,'ress'=>$ress]);
	}

	//ajax遍历单元
	public function postdanyuan(){
		$data=Db::name('type')->where('pid',input('pid'))->select();
		echo json_encode($data);
	}

	//查询生成水电表记录
	public function postchashuidian(){
		$qu=Db::name('type')->find(input('qu'));
		$danyuan=Db::name('type')->find(input('danyuan'));
		$dizhi=$qu['name'].'-'.$danyuan['name'].'%';
		$arr=Db::name('vip')->where('dizhi','like',$dizhi)->select();
		if($arr){
			//查看该单元住户本月是否已经登记水电表
			$pd=Db::name('hydropower')->where(['vip_id'=>$arr[0]['id'],'xiangmu_id'=>2,'date'=>date('Y-m')])->find();
			if($pd){
				//有登记
				$data=array('code'=>2);
			}else{
				//未登记
				//有用户
				$i=0;
				foreach($arr as $key=>$value){
					$xiangmu2=Db::name('hydropower')->where(['vip_id'=>$value['id'],'xiangmu_id'=>2])->order(['id'=>'desc'])->select();
					$xiangmu4=Db::name('hydropower')->where(['vip_id'=>$value['id'],'xiangmu_id'=>4])->order(['id'=>'desc'])->select();
					if($xiangmu2){
						$data[$i]['dizhi']=$value['dizhi'];
						$data[$i]['vip_id']=$value['id'];
						$data[$i]['xiangmu_id']=2;
						$data[$i]['xiangmu']='水费';
						$data[$i]['record1']=$xiangmu2[0]['record2'];
					}else{
						$data[$i]['dizhi']=$value['dizhi'];
						$data[$i]['vip_id']=$value['id'];
						$data[$i]['xiangmu_id']=2;
						$data[$i]['xiangmu']='水费';
						$data[$i]['record1']=0;
					}
					$r=$i+1;
					if($xiangmu4){
						$data[$r]['dizhi']=$value['dizhi'];
						$data[$r]['vip_id']=$value['id'];
						$data[$r]['xiangmu_id']=4;
						$data[$r]['xiangmu']='电费';
						$data[$r]['record1']=$xiangmu4[0]['record2'];
					}else{
						$data[$r]['dizhi']=$value['dizhi'];
						$data[$r]['vip_id']=$value['id'];
						$data[$r]['xiangmu_id']=4;
						$data[$r]['xiangmu']='电费';
						$data[$r]['record1']=0;
					}
					$i=$r+1;
				}
			}
		}else{
			//无用户
			$data=array('code'=>1);
		}
		echo json_encode($data);
	}

	//跳转收费查询页面
	public function getmoneybiao(){
		$arr=input();
		$sql=array();
		if(count($arr)!=1){
			//搜索页面
			if(!empty($arr['date'])){
				$sql['m.date']=$arr['date'];
			}
			if($arr['xiangmu_id']!=0){
				$sql['m.xiangmu_id']=$arr['xiangmu_id'];
			}
			if($arr['status']!=2){
				$sql['m.status']=$arr['status'];
			}
			if($arr['qu']!=0){
				//选区
				if($arr['danyuan']!=0){
					//选择单元
					if(!empty($arr['menpai'])){
						//门牌号不为空
						$qu=Db::name('type')->find($arr['qu']);
						$danyuan=Db::name('type')->find($arr['danyuan']);
						$lou=substr($arr['menpai'],0,2);
						$dizhi=$qu['name'].'-'.$danyuan['name'].'-'.$lou.'楼-'.$arr['menpai'];
						$vipid=Db::name('vip')->where('dizhi',$dizhi)->find();
						if(empty($vipid)){
							//门牌号未入住
							$sql['m.vip_id']='0';
						}else{
							$sql['m.vip_id']=$vipid['id'];
						}
					}else{
						//没有填门牌号
						$qu=Db::name('type')->find($arr['qu']);
						$danyuan=Db::name('type')->find($arr['danyuan']);
						$dizhi=$qu['name'].'-'.$danyuan['name'].'%';
						$vipid=Db::name('vip')->where('dizhi','like',$dizhi)->select();
						if(empty($vipid)){
							//门牌号未入住
							$sql['m.vip_id']='0';
						}else{
							$a='';
							foreach($vipid as $key=>$value){
								$a=$a.$value['id'].',';
							}
							$b=rtrim($a,',');
							$sql['m.vip_id']=['in',$b];
						}
					}
				}else{
					//未选择单元
					if(!empty($arr['menpai'])){
						//门牌号不为空
						$qu=Db::name('type')->find($arr['qu']);
						$dizhi=$qu['name'].'%'.$arr['menpai'];
						$vipid=Db::name('vip')->where('dizhi','like',$dizhi)->select();
						if(empty($vipid)){
							//门牌号未入住
							$sql['m.vip_id']='0';
						}else{
							$a='';
							foreach($vipid as $key=>$value){
								$a=$a.$value['id'].',';
							}
							$b=rtrim($a,',');
							$sql['m.vip_id']=['in',$b];
						}
					}else{
						//没有填门牌号
						$qu=Db::name('type')->find($arr['qu']);
						$dizhi=$qu['name'].'%';
						$vipid=Db::name('vip')->where('dizhi','like',$dizhi)->select();
						if(empty($vipid)){
							//门牌号未入住
							$sql['m.vip_id']='0';
						}else{
							$a='';
							foreach($vipid as $key=>$value){
								$a=$a.$value['id'].',';
							}
							$b=rtrim($a,',');
							$sql['m.vip_id']=['in',$b];
						}
					}
				}
				$qu=Db::name('type')->find(input('qu'));
			}else{
				//没选区
				if(!empty($arr['menpai'])){
					//门牌号不为空
					$vipid=Db::name('vip')->where('dizhi','like','%'.$arr['menpai'])->select();
					if(empty($vipid)){
						//门牌号未入住
						$sql['m.vip_id']='0';
					}else{
						$a='';
						foreach($vipid as $key=>$value){
							$a=$a.$value['id'].',';
						}
						$b=rtrim($a,',');
						$sql['m.vip_id']=['in',$b];
					}
				}
			}
		}
		$xiangmu=Db::name('xiangmu')->select();
		$res=Db::name('type')->where('pid','0')->select();
		$arr=Db::name('money')
		->alias('m')
		->where($sql)
		->join('tp_vip v','m.vip_id=v.id','LEFT')
		->join('tp_xiangmu x','m.xiangmu_id=x.id','LEFT')
		->field('m.*,v.dizhi,x.name')
		->order(['m.id'=>'desc'])
		->select();
		return $this->fetch('moneybiao',['arr'=>$arr,'xiangmu'=>$xiangmu,'res'=>$res]);
	}



	//一键创建当月物业.车位.垃圾费表
	public function getmoney(){
		$date=date('Y-m');
		$arr=Db::name('money')->where('date',$date)->select();
		if($arr){
			//已经添加，返回
			return $this->redirect('/jilu/moneybiao');
		}else{
			//执行添加
			Db::startTrans();
		try{
			//垃圾管理费费用
			$laji=Db::name('xiangmu')->find(5);
			//垃圾管理费费用
			$wuye=Db::name('xiangmu')->find(6);
			$che=Db::name('xiangmu')->find(3);
		    $err=Db::name('vip')->select();
		    foreach($err as $key=>$value){
		    	Db::name('money')->insert(['vip_id'=>$value['id'],'xiangmu_id'=>5,'money'=>$laji['danjia'],'date'=>$date]);
		    	Db::name('money')->insert(['vip_id'=>$value['id'],'xiangmu_id'=>6,'money'=>$wuye['danjia'],'date'=>$date]);
		    	if(!empty($value['chepai'])){
		    		$vrr[]=$value;
		    	}
		    }
		    foreach($vrr as $k=>$v){
		    	Db::name('money')->insert(['vip_id'=>$value['id'],'xiangmu_id'=>3,'money'=>$che['danjia'],'date'=>$date]);
		    }
		    // 提交事务
		    Db::commit(); 
		    $code=0;   
		} catch (\Exception $e) {
		    // 回滚事务
		    Db::rollback();
		    $code=1;   
		}
		}
		if($code==0){
			$this->success('添加成功','/jilu/moneybiao');
		}else{
			$this->error('添加失败');
		}
	}
	//缴费，修改money表缴费状态,添加缴费记录
	public function getjiaoqian(){
		// 启动事务
		Db::startTrans();
		try{
			$res=Db::name('money')->find(input('id'));
			$date=date('Y-m-d H:i:s');
			$user=session('user');
		    Db::name('money')->where('id',input('id'))->update(['status'=>1]);
		    Db::name('shoufei')->insert(['vip_id'=>$res['vip_id'],'xiangmu_id'=>$res['xiangmu_id'],'money'=>$res['money'],'date'=>$date,'user'=>$user]);
		    // 提交事务
		    Db::commit();
		    $code=0;    
		} catch (\Exception $e) {
 		   // 回滚事务
		    Db::rollback();
		    $code=1; 
		}
		if($code==0){
			$this->success('缴费成功','/jilu/moneybiao');
		}else{
			$this->error('缴费失败');
		}
	}
	//ajax数据插入
	public function postshujucharu(){
		$arr=input();
		foreach($arr['record1'] as $key=>$value){
			$xiangmu_id=$arr['xiangmu_id'][$key];
			$yongliang=$arr['record2'][$key]-$value;
			$money=Db::name('xiangmu')->find($xiangmu_id);
			$err[$key]['record1']=$value;
			$err[$key]['record2']=$arr['record2'][$key];
			$err[$key]['vip_id']=$arr['vip_id'][$key];
			$err[$key]['xiangmu_id']=$xiangmu_id;
			$err[$key]['date']=date('Y-m');
			$res[$key]['vip_id']=$arr['vip_id'][$key];
			$res[$key]['xiangmu_id']=$xiangmu_id;
			$res[$key]['money']=$money['danjia']*$yongliang;
			$res[$key]['date']=date('Y-m');
			$res[$key]['status']=0;
		}
		// 启动事务
		Db::startTrans();
		try{
			foreach($err as $key=>$value){
				Db::name('hydropower')->insert($value);
			}
			foreach($res as $k=>$val){
				Db::name('money')->insert($val);
			}
		    // 提交事务
		    Db::commit();
		    $data=0;    
		} catch (\Exception $e) {
		    // 回滚事务
		    Db::rollback();
		    $data=1;  
		}
		//判断是否添加成功
		if($data==0){
			$this->success('添加成功','/jilu/moneybiao');
		}else{
			$this->error('添加失败');
		}

	}
	
	
}
?>
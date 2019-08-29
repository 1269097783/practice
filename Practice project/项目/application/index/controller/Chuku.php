<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
class Chuku extends Allow{
	public function getindex(){
		return $this->fetch('chuku');
	}
	//查询
	public function postcha(){
		$data=Db::name('xingxi')->where('chepai',input('chepai'))->where('qian',0)->find();
		if($data['jiaofei']==0){
			//临时停车，需要缴费
			$arr=Db::name('xingxi')->where('id',$data['id'])->update(['chudata'=>date('Y-m-d H:i:s')]);
			if($arr){
				$res=Db::name('xingxi')->find($data['id']);
				$shijian=strtotime($res['chudata'])-strtotime($res['rudata']);
				if($shijian>900){
					//停车满15分钟
					$jiaofei=$shijian-900;
					$shi=ceil($jiaofei/3600);
					//超过15分钟，按每小时收费，不满一小时按一小时算
					$fei=Db::name('xiangmu')->find(1);
					$qian=$shi*$fei['danjia'];
					//停车时间
					if($shijian>3600){
						//停车超一小时
						$xiaoshi=floor($shijian/3600);
						$yu=$shijian%3600;
						$fen=floor($yu/60);
						$tctime=$xiaoshi.'小时'.$fen.'分钟';
					}else{
						//停车未超一小时
						$fen=floor($shijian/60);
						$tctime=$fen.'分钟';
					}
					return $this->fetch('jiaofei',['qian'=>$qian,'tctime'=>$tctime,'id'=>$data['id']]);
				}else{
					//停车未满15分钟
					$this->success('停车未满15分钟，无需缴费');
				}
			}else{
				$this->error('出库失败');
			}
		}else{
			//小区住户，无需缴费
			$arr=Db::name('xingxi')->where('id',$data['id'])->update(['chudata'=>date('Y-m-d H:i:s'),'qian'=>1]);
			if($arr){
				$err=Db::name('chewei')->where('id',$data['chewei_id'])->update(['kong'=>0]);
				if($err){
					$this->success('出库成功','/chuku/index');
				}else{
					$this->error('出库失败');
				}
			}else{
				$this->error('出库失败');
			}
		}
	}
	//临时停车缴费
	public function postfei(){
		// 启动事务
		Db::startTrans();
		try{
			$data=Db::name('xingxi')->find(input('id'));
			Db::name('chewei')->where('id',$data['chewei_id'])->update(['kong'=>0]);
    		Db::name('xingxi')->where('id',input('id'))->update(['qian'=>1]);
    		$dat['date']=date('Y-m-d H:i:s');
    		$dat['user']=session('user');
    		$dat['money']=input('money');
    		$dat['xiangmu_id']=1;
    		$dat['vip_id']=88888;
    		Db::name('shoufei')->insert($dat);
    		// 提交事务
    		Db::commit();
    		$res=0;   
		} catch (\Exception $e) {
   		 // 回滚事务
    		Db::rollback();
    		$res=1;
    		dump($e->getMessage());
		}
		if($res==0){
			$this->success('缴费成功','/chuku/index');
		}else{
			$this->error('缴费失败');
		}
	}
	//判断是否限行
	public function postxianxing(){
		$xingqi=date("w");
		if($xingqi==0 || $xingqi==6){
			$res=array('code'=>0);
		}else{
			$chepai=input('chepai');
			$i=mb_strlen($chepai);
			$dian=mb_substr($chepai,3,1);
			for($a=0;$a<$i;$a++){
				$shu=mb_substr($chepai,$a,1);
				if(is_numeric($shu)){
					$data[]=$shu;
				}
			}
			if($i==9 && $dian=='D'){
				$res=array('code'=>0);
			}else{
				$xian=$data[count($data)-1];
				$pdcp=fmod($xian,5);
				$pdcp==0?$pdcp=5:$pdcp;
				if($xingqi==$pdcp){
					$res=array('code'=>1);
				}else{
					$res=array('code'=>0);
				}
			}
		}
		echo json_encode($res);
	}

}
?>
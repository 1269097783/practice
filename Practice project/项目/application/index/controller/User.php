<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Session;

class User extends Allow{
	//遍历管理员数据
	public function index(){
		// 查询并且每页显示条数据
		$cou=ceil((count(Db::name('user')->select()))/5);
		if(empty(input('page'))){$a=1;}else{$a=input('page');};
		$list =Db::name('user')->limit(5)->page($a)->order(['id'=>'desc'])->select();
		foreach($list as $key=>$value){
			$rid=Db::name('user_role')->where('uid',$value['id'])->find();
			if($rid){
				$role=Db::name('role')->find($rid['rid']);
				$list[$key]['quanxian']=$role['name'];
			}else{
				$list[$key]['quanxian']='';
			}
		}
		// 把分页数据赋值给模板变量list
		$this->assign('list', $list);
		// 渲染模板输出
		$data=array('zong'=>$cou,'page'=>$a);
		return $this->fetch('bianli',['data'=>$data]);
	}
	//跳转新增页面，并且判断当前管理员权限
	public function tianjia(){
		return $this->fetch('xinzeng');
	}
	//判断用户名是否已经被注册
	public function pduser(){
		$user=input('user');
		$res=Db::name('user')->where('user',$user)->select();
		if($res){
			$arr=array('code'=>1);
		}else{
			$arr=array('code'=>0);
		}
		echo json_encode($arr);
	}
	//添加用户
	public function tjiao(){
		$data=['user'=>input('user'),'pwd'=>md5(input('password')),'zhuche'=>date('Y-m-d H:i:s'),'phone'=>input('phone'),'xingming'=>input('xingming')];
		$res=Db::name('user')->insert($data);
		if($res){
			$this->success('添加成功','/user');
		}else{
			$this->error('添加失败');
		}
	}
	//多条删除用户
	public function shanchu(){
		$id=input();
		$res=Db::name('user')->delete($id);
		if($res>0){
			$this->success('删除成功','/user');
		}else{
			$this->error('删除失败');
		}
		
	}
	//单条删除用户
	public function shan(){
		$id=input('id');
		$res=Db::name('user')->delete($id);
		if($res>0){
			$this->success('删除成功','/user');
		}else{
			$this->error('删除失败');
		}
		
	}
	//修改用户
	public function xiugai(){
		$id=input('id');
		$data=Db::name('user')->where('id',$id)->select();
		$quanxian=Db::name('role')->select();
		$user_role=Db::name('user_role')->where('uid',$id)->find();
		if($user_role){
			$rid=$user_role['rid'];
		}else{
			$rid=0;
		}
		return $this->fetch('quanxian',['data'=>$data,'quanxian'=>$quanxian,'rid'=>$rid]);
	}
	public function gai(){
		$id=input('id');
		$phone=input('phone');
		$xingming=input('xingming');
		Db::name('user')->where('id',$id)->update(['phone'=>$phone,'xingming'=>$xingming]);
		$this->success('修改成功','/user');
	}
	public function quanxian(){
		$id=input('id');
		$phone=input('phone');
		$xingming=input('xingming');
		$jinyong=input('jinyong');
		$quanxian=input('quanxian');
		$rid=input('rid');
		$res=Db::name('user_role')->where('uid',$id)->find();
		if($res){
			Db::name('user_role')->where('uid',$id)->update(['rid'=>$rid]);
		}else{
			Db::name('user_role')->insert(['uid'=>$id,'rid'=>$rid]);
		}
		Db::name('user')->where('id',$id)->update(['phone'=>$phone,'xingming'=>$xingming,'jinyong'=>$jinyong]);
		$this->success('修改成功','/user');
	}
	public function chaxun(){
		$xuanxiang=input('xuanxiang');
		$tiaojian=input('tiaojian');
		$tj='';
		switch($xuanxiang){
      		case 1:$tj='user';break;
      		case 2:$tj='xingming';break;
      		case 3:$tj='phone';break;
		}
		$cou=ceil((count(Db::name('user')->where("{$tj}",'like',"%{$tiaojian}%")->select()))/100);
		if(empty(input('page'))){$a=1;}else{$a=input('page');};
		$list=Db::name('user')->where("{$tj}",'like',"%{$tiaojian}%")->limit(100)->page($a)->order(['id'=>'desc'])->select();
		// 把分页数据赋值给模板变量list
		$this->assign('list', $list);
		// 渲染模板输出
		$data=array('zong'=>$cou,'page'=>$a);
		return $this->fetch('bianli',['data'=>$data]);
	}
}
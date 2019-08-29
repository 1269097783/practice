<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Session;
class Allow extends Controller{
	public function _initialize(){
		// 判断是否登录
		if(!Session::has('user')){
			// 如果未登录，跳转登录界面
			$this->redirect('/login');
		}else{
			// 当前登录的用户的id
			$uid=session('uid');
			// 获取登录用户的角色
			$res=Db::name('user_role')->where('uid',$uid)->find();
			// 判断当前用户是否绑定角色
			if($res){
				// 获取当前访问的控制器
				$cur_controller=request()->controller();
				// 获取当前访问的方法
				$cur_action=request()->action();
				//获取控制器ID
				$pid=Db::name('node')->where('ename',$cur_controller)->find();
				//获取当前方法ID
				$nid=Db::name('node')->where(['ename'=>$cur_action,'pid'=>$pid['id']])->find();
				$bbs=$nid['id'];
				//获取到当前用户所属角色有哪些权限$arr
				$auth=Db::name('user_role')
					->alias('ur')
					->join('tp_role_node rn','ur.rid=rn.rid','LEFT')
					->field('rn.nid')
					->where('ur.uid',$uid)
					->find();
				$arr_nid=explode(',',$auth['nid']);
				foreach($arr_nid as $key=>$value){
					$pd=Db::name('node')->where(['id'=>$value,'status'=>1])->find();
					if($pd){
						$arr[]=$value;
					}
				}
				if(!in_array($bbs,$arr)){
					$this->error('您没有权限访问该方法');
				}
			}else{
				$this->error('您没有权限访问该方法');
			}
		}

	}
}


?>
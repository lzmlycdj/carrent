<?php

namespace Admin\Model;

use Think\Model;

class AdminModel extends Model
{
    // 添加验证规则
    protected $_validate = array(
        array('username', 'require', '管理员名称不得为空！', 1),  // 都有时间都验证
        array('username', '', '管理员名称不得重复！', 1, unique, 1),
        array('username', '', '管理员名称不得重复！', 1, unique, 2),
        array('password', 'require', '管理员密码不得为空！', 1),
        // 验证码开始 验证自己的函数
        array('verify', 'verify', '验证码错误！', 1, 'callback', 4),
    );
   
// 管理员登陆
    public function login(){
		$password=$this->password;
		$info=$this->where("username='$this->username'")->find();
		if($info){
			$id=$info['id'];
			$roles=$this->field('b.rolename')->alias('a')->join('LEFT JOIN cs_role b ON a.roleid=b.id')->where("a.id=$id")->find();
            $rolename=$roles['rolename'];
            // 加密密码比较
			if($info['password']==md5($password)){
                // 写入session
				session('id',$info['id']);
				session('username',$info['username']);
				//session('rolename',$rolename);
				// $this->getpri($info['roleid']);
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
// 验证码
	public function verify($code){
		$verify = new \Think\Verify();
		return $verify->check($code, '');

	}
}


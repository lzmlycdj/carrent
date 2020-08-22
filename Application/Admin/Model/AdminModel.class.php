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
        array('verify', 'verify', '验证码错误！', 1, 'callback', 4),
    );
   
}
<?php

namespace Admin\Controller;

use Think\Controller;

class ArticleController extends Controller
{
    public function lst()
    {
       
        $this->display();
        
    }

    /* public function add()
    {
        $this->display();
    } */


    public function add()
    {
        $cate=D('cate');
        $cates=$cate->catetree();
        $this->assign('cates',$cates);
        $this->display();
    }
    // 无极限分类

    public function edit()
    {

        $this->display();
    }
    // 单个删除
    public function del()
    {
        $this->display();
    }
    // 批量删除
    public function bdel()
    {
        $cate = D('cate');
        $ids = I('ids');
        $ids = implode(',', $ids);  //1,2,3,4
        //  结合model里面的_before_delete
        if ($ids) {
            if ($cate->delete($ids)) {
                $this->success('批量删除栏目成功！', U('lst'));
            } else {
                $this->error('批量删除栏目失败！');
            }
        } else {
            $this->error('未选中任何内容！');
        }
    }
    // 排序
    public function sortcate()
    {

        $cate = D('cate');
        foreach ($_POST as $id => $sort) {
            $cate->where("id=$id")->setField('sort', $sort);
        }

        $this->success('成功更新栏目顺序！', U('lst'));
    }
}

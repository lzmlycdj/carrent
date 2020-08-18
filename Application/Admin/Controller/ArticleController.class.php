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
        $article=D('article');
        if(IS_POST)
       {
            $data['title']=I('title');
            $data['rizu']=I('rizu');
            $data['num']=I('num');
            $data['atype']=I('atype');
            $data['author']=I('author');
            $data['cateid']=I('cateid');
            $data['content']=I('content');
            $data['keywords']=I('keywords');
            $data['des']=I('des');
            $data['rem']=I('rem');
            $data['time']=time();
            if($_FILES['pic']['tmp_name']!='')
            {
                $upload = new \Think\Upload();// 实例化上传类
                $upload->maxSize   =     3145728 ;// 设置附件上传大小
                $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
                $upload->savePath  =      './Public/Uploads/'; // 设置附件上传目录
                $upload->rootPath='./';
                // 上传文件 
                $info=$upload->uploadOne($_FILES['pic']);
                if(!$info) {// 上传错误提示错误信息
                    $this->error($upload->getError());
                 }else{// 上传成功  
                     $data['pic']=$info['savepath'].$info['savename']; 
                     }
            }

            if($article->create($data))
            {
                if($article->add())
                {
                    $this->success('新增文章成功！',U('lst'));
                }else
                {
                    $this->error('新增失败！');
                }

            }else
            {
                $this->error($article->getError());
            }

            return;
        }
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

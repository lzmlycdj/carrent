<?php

namespace Admin\Controller;

use Think\Controller;

class CateController extends Controller
{
    public function lst()
    {   
		$cate = D('cate');
		$cates = $cate->catetree();
		$this->assign('cates',$cates);
        $this->display();
    }

	/* public function add()
    {
        $this->display();
    } */


    public function add()
    {
		$cate=D('cate');
    	if(IS_POST){
    		$cate=D('cate');
    		$data['parentid']=I('parentid');
    		$data['name']=I('name');
    		$data['type']=I('type');
            $data['class']=I('class');
    		$data['keywords']=I('keywords');
    		$data['des']=I('des');
            $data['pc']=I('pc');
    		$data['content']=I('content');
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

    		if($cate->create($data))
    		{
    			if($cate->add())
    			{
    				$this->success('新增栏目成功！',U('lst'));
    			}else
    			{
    				$this->error('新增栏目失败！');
    			}

    		}else
    		{
    			$this->error($cate->getError());
    		}

    		return;
    	}
// 无极限分类
        $cate=D('cate');
        $cates=$cate->catetree();
        $this->assign('cates',$cates);
    	$this->display();
    }
     public function edit()
     {
		 
		$cate=D('cate');
    	if(IS_POST){
    		$cate=D('cate');
			$data['parentid']=I('parentid');
			$data['id']=I('id');
    		$data['name']=I('name');
    		$data['type']=I('type');
            $data['class']=I('class');
    		$data['keywords']=I('keywords');
    		$data['des']=I('des');
            $data['pc']=I('pc');
    		$data['content']=I('content');
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

    		if($cate->create($data))
    		{
    			if($cate->save())
    			{
    				$this->success('修改栏目成功！',U('lst'));
    			}else
    			{
    				$this->error('修改栏目失败！');
    			}

    		}else
    		{
    			$this->error($cate->getError());
    		}

    		return;
		}
		// 展示数据
		 
    
		 $cateid=I('id');

 
	 
		 $cateres = $cate->find($cateid);
	 
		 $this->assign('cateres',$cateres);
		 $cates=$cate->catetree();
		 $this->assign('cates',$cates);
		 $this->display();
     }

}

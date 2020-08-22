<?php
namespace Admin\Controller;
use Think\Controller;
class SystemController extends CommonController 
{
    public function lst(){
        if(IS_POST){
            // 文件路径
            $file='./Application/Common/Conf/config.php';
            // 修改config，还有修改key大小写 
            $config=array_merge(include $file,array_change_key_case($_POST,CASE_UPPER));
            // 把配置文件存到php里面去用var_export拼接
            $str="<?php\r\nreturn ".var_export($config,true)."; ?>";
            // 开始修改配置文件
            if(file_put_contents($file, $str)){
                $this->success('修改配置项成功！',U('lst'));
            }else{
                $this->error('修改配置项失败！');
            }
            

            return;
        }
        $this->display();
    }

   











}
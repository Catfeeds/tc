<?php
namespace Admin\Controller;

use Think\Controller;
use Think\Crypt\Driver\Think;


class ApkController extends BaseController{
	 public function showlist(){
	 	$apk=D('apk');
	 	$sql="select * from apk";
	 	if(IS_POST){//查询后
			$name=$_POST["txtName"]; //状态
			$sql=$sql." where version like '%$name%'  ";			
			$info= $apk->query($sql);			
            $this->assign('info',$info);
            $auth=D('adminrauth');
            $uid=session('user.id');
            $list=$auth->where('admin_id='.$uid)->select();
            $a="";
            foreach($list as $k=>$v){
                $a.=$v['auth_id'].',';
            }
            $this->assign('res',$a);
            $this->display();
			
		}else{//初始加载
			$info= $apk->query($sql);
			foreach($info as $k=>$v){
				$info[$k]['time']=date("Y-m-d H:i:s",$v['time']);
			}
//            dump($info);
            $auth=D('adminrauth');
            $uid=session('user.id');
            $list=$auth->where('admin_id='.$uid)->select();
            $a="";
            foreach($list as $k=>$v){
                $a.=$v['auth_id'].',';
            }
            //dump ($a);
            $this->assign('res',$a);
            $this->assign('info',$info);
            $this->display();
		}
	 }

	 public function add(){

	 	if(IS_POST){
	 	    $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     1048576000 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg','pdf','apk');// 设置附件上传类型
            $upload->rootPath  =     './Uploads/apk/'; // 设置附件上传根目录
            $upload->savePath  =     ''; // 设置附件上传（子）目录
            // 上传文件
            $upload->subName = array('date','Ymd');
            $info   =   $upload->upload();
           /* dump($info);
           die();*/
            if(!$info) {// 上传错误提示错误信息
                $this->error($upload->getError());
            }else{// 上传成功
            	$n=D('apk');
            	$data['version']=I('post.num');
            	$data['download']=URL.'/Uploads/apk/'.$info['img']['savepath'].$info['img']['savename'];
            	$data['status']=I('post.status');
            	$data['versioncode']=I('post.versionCode');
                  $data['versionsize']=$info['img']['size'];
            	$data['time']=time();
		//$data["time"]=strtotime($data["time"]);
		$dataRetID=$n -> data($data)->add();

		adminLog("添加apk",$dataRetID,"","成功","");
		
		$this->ajaxReturn(interfaceReturn(0,'成功',""));
		}
	   }else{
	   		$this->display();
	   }
	 }
     public function del(){
        $id=$_POST['id'];
        $apk=D('apk');
        $res=$apk->where('apk_id='.$id)->delete();
        $this->ajaxReturn(interfaceReturn(0,'成功',""));
     }
     public function adddown(){
        if(IS_POST){
           $n=D('apk');
           $data['version']=I('post.num');
           $data['download']=I('post.download');
           $data['status']=I('post.status');
           $data['versioncode']=I('post.versionCode');
           $data['time']=time();
           $dataRetID=$n -> data($data)->add();
           adminLog("添加apk",$dataRetID,"","成功","");
        
           $this->ajaxReturn(interfaceReturn(0,'成功',""));

        }else{
            $this->display();
        }
     }
}
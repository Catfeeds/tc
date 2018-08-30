<?php
//                            _ooOoo_
//                           o8888888o
//                           88" . "88
//                           (| -_- |)
//                            O\ = /O
//                        ____/`---'\____
//                      .   ' \\| |// `.
//                       / \\||| : |||// \
//                     / _||||| -:- |||||- \
//                       | | \\\ - /// | |
//                     | \_| ''\---/'' | |
//                      \ .-\__ `-` ___/-. /
//                   ___`. .' /--.--\ `. . __
//                ."" '< `.___\_<|>_/___.' >'"".
//               | | : `- \`.;`\ _ /`;.`/ - ` : | |
//                 \ \ `-. \_ __\ /__ _/ .-` / /
//         ======`-.____`-.___\_____/___.-`____.-'======
//                            `=---='
//
//         .............................................
//                  佛祖保佑             永无BUG
namespace Admin\Controller;
use Think\Controller;
class VideoController extends BaseController {
    public function index(){
        $this->display();
    }
	//  ShopControllwer.class.php
	//  初始化页面方法 
	//  Created by uguyuahng on 2017-11-01.
	//  
	public function showList(){
		$this -> assign('imgURL',  C('IMG_URL'));
		if(I("serchWord")!=null&&I("serchWord")!=""){
			$sql=" video.name like '%".I("serchWord")."%' ";
		}else{
			$sql=" 0=0 ";
		}
		
	   	$dataListArray = M('video')->where('video_id=120')->select();
	   
	    $this->assign('dataListArray',$dataListArray);
	    dump($dataListArray);
	$auth=D('adminrauth');
	$uid=session('user.id');
	$list=$auth->where('admin_id='.$uid)->select();
	$a="";
	foreach($list as $k=>$v){
		$a.=$v['auth_id'].',';
	}
	//dump ($a);
	$this->assign('res',$a);
	    // 当前查询共有多少数据
	   // $dataNum=count(dataListArray);
	    //$this->assign('dataNum',$orderNum);
	    $this -> assign('imgURL',  C('IMG_URL'));
        $this->display('video-manage');
    }
	
	
	
	/*//编辑-
	public function dataEdit(){
		$dataId=I("id");
		$m=D('video');
		$c=D('class');
		$u=D('user');
		$data=$m->where('video_id='.$dataId)->find();
        $class=$c->where('class_id='.$data['class_id'])->find();
        $user=$u->where('user_id='.$class['uid'])->find();
		$this->assign('data',$data);
		$this->assign('user',$user);
		
        $this->display('videom-edit');
    }
    public function dataEdit_Sub(){
    	 	$upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg','pdf');// 设置附件上传类型
            $upload->rootPath  =     './Uploads/prove/'; // 设置附件上传根目录
            $upload->savePath  =     ''; // 设置附件上传（子）目录
            // 上传文件
            $info   =   $upload->upload();
            if(!$info) {// 上传错误提示错误信息
                $this->error($upload->getError());
            }else{// 上传成功
				
   		$this->ajaxReturn(interfaceReturn(0,'成功',""));
    }
	
	}*/
	// 
	//  ShopController.class.php
	//  数据删除
	//  
	//  Created by guyuhang on 2017-11-02.
	// 
	public function dataDel(){
		$dataId=I("id");
		M("video")->delete($dataId);
		adminLog("删除视频","","","成功","");
		$this->ajaxReturn(interfaceReturn(0,'成功',""));
	}
	
	//推荐视频 
	public function xianshi(){
		$dataId=I("id");
		$data=M("video")->where(" video_id = ".$dataId)->find();
		$data["recommend"]="1";
		M("video")->data($data)->save();
		adminLog("推荐视频",$dataId,"","成功","");
		
		$this->ajaxReturn(interfaceReturn(0,'成功',""));
	}
	
	//取消推荐视频 
	public function yincang(){
		$dataId=I("id");
		$data=M("video")->where(" video_id = ".$dataId)->find();
		$data["recommend"]="0";
		M("video")->data($data)->save();
		
		adminLog("取消推荐视频",$dataId,"","成功","");
		
		$this->ajaxReturn(interfaceReturn(0,'成功',""));
	}
	
	//上线视频 
	public function shangxian(){
		$dataId=I("id");
		$data=M("video")->where(" video_id = ".$dataId)->find();
		$data["status"]="0";
		M("video")->data($data)->save();
		adminLog("上线视频",$dataId,"","成功","");
		
		$this->ajaxReturn(interfaceReturn(0,'成功',""));
	}
	
	//下线视频 
	public function xiaxian(){
		$dataId=I("id");
		$data=M("video")->where(" video_id = ".$dataId)->find();
		$data["status"]="1";
		M("video")->data($data)->save();
		
		adminLog("下线视频",$dataId,"","成功","");
		
		$this->ajaxReturn(interfaceReturn(0,'成功',""));
	}
}
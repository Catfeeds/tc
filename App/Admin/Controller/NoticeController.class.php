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
class NoticeController extends BaseController {
    public function index(){
        $this->display();
    }   
	//     
	//  ShopControllwer.class.php
	//  初始化banner页面方法 
	//  Created by uguyuahng on 2017-11-01.
	// 
	public function showList(){
		$this -> assign('imgURL',  C('IMG_URL'));
		if(I("serchWord")!=null&&I("serchWord")!=""){
			$sql=" title like '%".I("serchWord")."%' ";
		}else{
			$sql=" 0=0 ";
		}
			
	   	$dataListArray = M('lunbo')->where($sql)->order(' num ')->select();
	   
	    $this->assign('dataListArray',$dataListArray);
	    // 当前查询共有多少数据
	   // $dataNum=count(dataListArray);
	    //$this->assign('dataNum',$orderNum);
	    $auth=D('adminrauth');
            $uid=session('user.id');
            $list=$auth->where('admin_id='.$uid)->select();
            $a="";
            foreach($list as $k=>$v){
                $a.=$v['auth_id'].',';
            }
            //dump ($a);
            $this->assign('res',$a);
            $img="http://wyk-img-1255995999.cos.ap-beijing.myqcloud.com";
            $this->assign('img',$img);
        $this->display('banner-manage');
    }
	
	//  添加banner
	public function dataAdd(){
        $this->display('bannerm-add');
    }
	public function dataAdd_Sub(){
	
		 	/*$upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg','pdf');// 设置附件上传类型
            $upload->rootPath  =     './Uploads/lunbo/'; // 设置附件上传根目录
            $upload->savePath  =     ''; // 设置附件上传（子）目录
            // 上传文件
            $info   =   $upload->upload();
            if(!$info) {// 上传错误提示错误信息
                $this->error($upload->getError());
            }else{// 上传成功
            	$n=D('lunbo');
            	$data['title']=I('post.title');
            	$data['img']='/Uploads/lunbo/'.$info['photo']['savepath'].$info['photo']['savename'];
            	$data['num']=I('post.num');
            	$data['url']=I('post.url');
            	$data['status']=I('post.status');
		//$data["time"]=strtotime($data["time"]);
		$dataRetID=$n -> data($data)->add();
		adminLog("添加banner",$dataRetID,"","成功","");
		
		$this->ajaxReturn(interfaceReturn(0,'成功',""));
		}*/
		vendor('cos.cos-autoloader');
			$cosClient = new \Qcloud\Cos\Client(array('region' => 'bj',
		    	'credentials'=> array(
		        'appId' => '1255995999',
		        'secretId'    => 'AKIDbKwODypWj2RxKVxtxJl4KfvGgPatP7Nn',
		        'secretKey' => 'l2TFq6FC3movvqjbQbfhmnqqju0iHUcZ')));
			//dump($cosClient);
			$bucket = 'wyk-img-1255995999';
			$key = 'user/'."php".$_FILES['photo']['name'];
			//dump($key);
			$local_path = $_FILES['photo']['tmp_name'];
			//dump($local_path);
			
			try {
			    $result = $cosClient->putObject(array(
			        'Bucket' => $bucket,
			        'Key' => $key,
			        'Body' => fopen($local_path, 'rb')));
			  
			    //$arr = (array)($result);
			     //dump($result['ObjectURL']);
			    //dump($result['data:protected']['ObjectURL'] );
			} catch (\Exception $e) {
			    echo "$e\n";
			}
		$n=D('lunbo');
            	$data['title']=I('post.title');
            	$data['img']='/user/'."php".$_FILES['photo']['name'];
            	$data['num']=I('post.num');
            	$data['url']=I('post.url');
            	$data['status']=I('post.status');
		//$data["time"]=strtotime($data["time"]);
		$dataRetID=$n -> data($data)->add();
		adminLog("添加banner",$dataRetID,"","成功","");
		$this->ajaxReturn(interfaceReturn(0,'成功',""));
    }
	
	//  编辑banner
	public function dataEdit(){
		$this -> assign('imgURL',  C('IMG_URL'));
		$dataId=I("id");
		$data=M("lunbo")->where(" lunbo_id = ".$dataId)->find();
	    $this->assign('lunbo_id',$data["lunbo_id"]);
	    $this->assign('status',$data["status"]);
	    $this->assign('url',$data["url"]);
	    $this->assign('img',$data["img"]);
	    $this->assign('num',$data["num"]);
	    $this->assign('title',$data["title"]);
	    $this->assign('timeend',$data["timeend"]);
	    $this->assign('stock',$data["stock"]);
	    $this->assign('lunbo_id',$data["lunbo_id"]);
		$img="http://wyk-img-1255995999.cos.ap-beijing.myqcloud.com";
            $this->assign('imgurl',$img);
        $this->display('bannerm-edit');
    }
    public function dataEdit_Sub(){
    	
    	if($_FILES['photo']['error']!=4){
		 	vendor('cos.cos-autoloader');
			$cosClient = new \Qcloud\Cos\Client(array('region' => 'bj',
		    	'credentials'=> array(
		        'appId' => '1255995999',
		        'secretId'    => 'AKIDbKwODypWj2RxKVxtxJl4KfvGgPatP7Nn',
		        'secretKey' => 'l2TFq6FC3movvqjbQbfhmnqqju0iHUcZ')));
			//dump($cosClient);
			$bucket = 'wyk-img-1255995999';
			$key = 'user/'."php".$_FILES['photo']['name'];
			//dump($key);
			$local_path = $_FILES['photo']['tmp_name'];
			//dump($local_path);
			
			try {
			    $result = $cosClient->putObject(array(
			        'Bucket' => $bucket,
			        'Key' => $key,
			        'Body' => fopen($local_path, 'rb')));
			  
			    //$arr = (array)($result);
			     //dump($result['ObjectURL']);
			    //dump($result['data:protected']['ObjectURL'] );
			} catch (\Exception $e) {
			    echo "$e\n";
			}
		$n=D('lunbo');
            	$data['title']=I('post.title');
            	$data['img']='/user/'."php".$_FILES['photo']['name'];
            	$data['num']=I('post.num');
            	$data['url']=I('post.url');
            	$data['status']=I('post.status');
		//$data["time"]=strtotime($data["time"]);
		$dataRetID=$n -> where('lunbo_id='.$_POST['lunbo_id'])->save($data);
		adminLog("添加banner",$dataRetID,"","成功","");
		$this->ajaxReturn(interfaceReturn(0,'成功',""));
		
		
		
		
    }else{
    	$n=D('lunbo');
        $data['title']=I('post.title');
        $data['img']=I('post.oldpicname');
        $data['num']=I('post.num');
        $data['url']=I('post.url');
        $data['status']=I('post.status');
        $dataRetID=$n ->where('lunbo_id='.$_POST['lunbo_id'])->save($data);
		adminLog("编辑banner",$_POST["lunbo_id"],"","成功","");
		/*if($dataRetID){
				echo "<script>alert('修改成功');parent.location.href='".__MODULE__."/Notice/showList';</script>";
		}else{
				echo "<script>alert('添加失败');parent.location.href='".__MODULE__."/Notice/showList';</script>";
		}*/
	    $this->ajaxReturn(interfaceReturn(0,'成功',""));
    }
}
	
	
	//  数据删除banner
	public function dataDel(){
		$dataId=I("id");
		M("lunbo")->delete($dataId);
		adminLog("删除banenr","","","成功","");
		$this->ajaxReturn(interfaceReturn(0,'成功',""));
	}
	//  数据删除腰图
	public function dataDelYaotu(){
		$dataId=I("id");
		M("advert")->delete($dataId);
		adminLog("删除腰图","","","成功","");
		$this->ajaxReturn(interfaceReturn(0,'成功',""));
	}
	//  数据删除活动推送
	public function dataDelHuodong(){
		$dataId=I("id");
		M("notice")->delete($dataId);
		adminLog("删除banenr","","","成功","");
		$this->ajaxReturn(interfaceReturn(0,'成功',""));
	}
	//  数据删除消息推送
	public function dataDelXiaoxi(){
		$dataId=I("id");
		M("news")->delete($dataId);
		adminLog("删除消息推送","","","成功","");
		$this->ajaxReturn(interfaceReturn(0,'成功',""));
	}
	
	
	
	
	
	//显示banner
	public function xianshi(){
		$dataId=I("id");
		$data=M("lunbo")->where(" lunbo_id = ".$dataId)->find();
		$data["status"]="0";
		M("lunbo")->data($data)->save();
		adminLog("显示banner",$dataId,"","成功","");
		
		$this->ajaxReturn(interfaceReturn(0,'成功',""));
	}
	
	//隐藏banner
	public function yincang(){
		$dataId=I("id");
		$data=M("lunbo")->where(" lunbo_id = ".$dataId)->find();
		$data["status"]="1";
		M("lunbo")->data($data)->save();
		
		adminLog("隐藏banner",$dataId,"","成功","");
		
		$this->ajaxReturn(interfaceReturn(0,'成功',""));
	}
	//显示腰图
	public function xianshiYaotu(){
		$dataId=I("id");
		$data=M("advert")->where(" advert_id = ".$dataId)->find();
		$data["status"]="0";
		M("advert")->data($data)->save();
		adminLog("显示腰图",$dataId,"","成功","");
		
		$this->ajaxReturn(interfaceReturn(0,'成功',""));
	}
	
	//隐藏腰图
	public function yincangYaotu(){
		$dataId=I("id");
		$data=M("advert")->where(" advert_id = ".$dataId)->find();
		$data["status"]="1";
		M("advert")->data($data)->save();
		
		adminLog("隐藏腰图",$dataId,"","成功","");
		
		$this->ajaxReturn(interfaceReturn(0,'成功',""));
	}
	
	
	
	
	//消息推送列表页面
	public function showListXiaoxi(){
		//Vendor('QcloudApi.QcloudApi');
		
		//$QcloudApi=new \QcloudApi;
		//$QcloudApi::tencentAPI('live');
		//echo $QcloudApi::getPushUrl("13380","123456","7a63ab75c49e12973dff965a74b77846","2017-11-07 20:08:07");
		
		if(I("serchWord")!=null&&I("serchWord")!=""){
			$sql=" title like '%".I("serchWord")."%' ";
		}else{
			$sql=" 0=0 ";
		}
			
	   	$dataListArray = M('news')->where($sql)->order(' news_id desc ')->select();
	   
	    $this->assign('dataListArray',$dataListArray);
	    // 当前查询共有多少数据
	   // $dataNum=count(dataListArray);
	    //$this->assign('dataNum',$orderNum);
	    $auth=D('adminrauth');
            $uid=session('user.id');
            $list=$auth->where('admin_id='.$uid)->select();
            $a="";
            foreach($list as $k=>$v){
                $a.=$v['auth_id'].',';
            }
            //dump ($a);
            $this->assign('res',$a);
        $this->display('news-pushed');
    }
	//活动推送列表页面
	public function showListHuodong(){
		$this -> assign('imgURL',  C('IMG_URL'));
		if(I("serchWord")!=null&&I("serchWord")!=""){
			$sql=" title like '%".I("serchWord")."%' ";
		}else{
			$sql=" 0=0 ";
		}
			
	   	$dataListArray = M('notice')->where($sql)->order(' time desc ')->select();
	   
	    $this->assign('dataListArray',$dataListArray);
	    // 当前查询共有多少数据
	   // $dataNum=count(dataListArray);
	    //$this->assign('dataNum',$orderNum);
	     $auth=D('adminrauth');
            $uid=session('user.id');
            $list=$auth->where('admin_id='.$uid)->select();
            $a="";
            foreach($list as $k=>$v){
                $a.=$v['auth_id'].',';
            }
            //dump ($a);
            $this->assign('res',$a);
        $this->display('activies-pushed');
    }
	
	//腰图列表页面
	public function showListYaotu(){
		$this -> assign('imgURL',  C('IMG_URL'));
		if(I("serchWord")!=null&&I("serchWord")!=""){
			$sql=" title like '%".I("serchWord")."%' ";
		}else{
			$sql=" 0=0 ";
		}
			
	   	$dataListArray = M('advert')->where($sql)->order(' num ')->select();
	   
	    $this->assign('dataListArray',$dataListArray);
	    // 当前查询共有多少数据
	   // $dataNum=count(dataListArray);
	    //$this->assign('dataNum',$orderNum);
	     $auth=D('adminrauth');
            $uid=session('user.id');
            $list=$auth->where('admin_id='.$uid)->select();
            $a="";
            foreach($list as $k=>$v){
                $a.=$v['auth_id'].',';
            }
            //dump ($a);
            $this->assign('res',$a);
        $this->display('figure-manage');
    }
	
	
	
	
	//  添加消息推送
	public function dataAddXiaoxi(){
        $this->display('newsp-add');
    }
    public function dataAddXiaoxi_Sub(){
	
		$data = M('news') -> create();
		$data['type']='0';
		$data["time"]=strtotime(date('Y-m-d H:i:s'));
		$dataRetID = M('news') -> data($data)->add();
		 adminLog("添加消息推送",$dataRetID,"","成功","");
		
		$this->ajaxReturn(interfaceReturn(0,'成功',""));
		
    }
	
	
	
	
    //  添加活动推送
	public function dataAddHuodong(){
        $this->display('activiesp-add');
    }
    public function dataAddHuodong_Sub(){
	
		$upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg','pdf');// 设置附件上传类型
            $upload->rootPath  =     './Uploads/notice/'; // 设置附件上传根目录
            $upload->savePath  =     ''; // 设置附件上传（子）目录
            // 上传文件
            $info   =   $upload->upload();
            if(!$info) {// 上传错误提示错误信息
                $this->error($upload->getError());
            }else{// 上传成功
            	$n=D('notice');
            	$data['title']=I('post.title');
            	$data['img']='/Uploads/notice/'.$info['photo']['savepath'].$info['photo']['savename'];
            	$data['text']=I('post.text');
            	$data['url']=I('post.url');
            	$data['time']=I('post.time');
		//$data["time"]=strtotime($data["time"]);
		$dataRetID=$n -> data($data)->add();
		//$data["time"]=strtotime($data["time"]);
		adminLog("添加活动推送",$dataRetID,"","成功","");
		
		$this->ajaxReturn(interfaceReturn(0,'成功',""));
    }
}
	
	
    //  添加腰图
	public function dataAddYaotu(){
        $this->display('figurem-add');
    }
	public function dataAddYaotu_Sub(){
	
		$upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg','pdf');// 设置附件上传类型
            $upload->rootPath  =     './Uploads/advert/'; // 设置附件上传根目录
            $upload->savePath  =     ''; // 设置附件上传（子）目录
            // 上传文件
            $info   =   $upload->upload();
            if(!$info) {// 上传错误提示错误信息
                $this->error($upload->getError());
            }else{// 上传成功
            	$n=D('advert');
            	$data['title']=I('post.title');
            	$data['img']='/Uploads/advert/'.$info['photo']['savepath'].$info['photo']['savename'];
            	$data['num']=I('post.num');
            	$data['url']=I('post.url');
            	$data['status']=I('post.status');
		$dataRetID=$n -> data($data)->add();
		adminLog("添加腰图",$dataRetID,"","成功","");
		
		$this->ajaxReturn(interfaceReturn(0,'成功',""));
    }
}
	
	//  编辑腰图
	public function dataEditYaotu(){
			//$this -> assign('imgURL',  C('IMG_URL'));
		$dataId=I("id");
		$data=M("advert")->where(" advert_id = ".$dataId)->find();
	    
	    $this->assign('advert_id',$data["advert_id"]);
	    $this->assign('status',$data["status"]);
	    $this->assign('url',$data["url"]);
	    $this->assign('img',$data["img"]);
	    $this->assign('num',$data["num"]);
	    $this->assign('title',$data["title"]);
		
        $this->display('figurem-edit');
    }
	//  编辑腰图
	public function dataEditYaotu_Sub(){
		if($_FILES['photo']['error']!=4){
		 	$upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg','pdf');// 设置附件上传类型
            $upload->rootPath  =     './Uploads/advert/'; // 设置附件上传根目录
            $upload->savePath  =     ''; // 设置附件上传（子）目录
            // 上传文件
            $info   =   $upload->upload();
            if(!$info) {// 上传错误提示错误信息
                $this->error($upload->getError());
            }else{// 上传成功
            	@unlink('.'.$_POST['oldpicname']);
            	//dump($_POST['oldpicname']);
            	//die();
            	$n=D('advert');
            	$data['title']=I('post.title');
            	$data['img']='/Uploads/advert/'.$info['photo']['savepath'].$info['photo']['savename'];
            	$data['num']=I('post.num');
            	$data['url']=I('post.url');
            	$data['status']=I('post.status');
		//$data["time"]=strtotime($data["time"]);
		$dataRetID=$n ->where('advert_id='.$_POST['advert_id'])->save($data);
		adminLog("编辑腰图",$_POST["advert_id"],"","成功","");
		/*if($dataRetID){
				echo "<script>alert('修改成功');parent.location.href='".__MODULE__."/Notice/showList';</script>";
		}else{
				echo "<script>alert('添加失败');parent.location.href='".__MODULE__."/Notice/showList';</script>";
		}	*/
		$this->ajaxReturn(interfaceReturn(0,'成功',""));
    }
}else{
    	$n=D('advert');
        $data['title']=I('post.title');
        $data['img']=I('post.oldpicname');
        $data['num']=I('post.num');
        $data['url']=I('post.url');
        $data['status']=I('post.status');
        $dataRetID=$n ->where('advert_id='.$_POST['advert_id'])->save($data);
		adminLog("编辑腰图",$_POST["advert_id"],"","成功","");
	    $this->ajaxReturn(interfaceReturn(0,'成功',""));
    }
}
    //推送消息
    public function dataTuiXiaoxiios(){
    	$id=I('id');
    	//dump($id);
    	$m=M('news');
    	$mvp['tuisong']="1";
    	$save=$m->where('news_id='.$id)->save($mvp);
    	$select=$m->where('news_id='.$id)->find();
    	vendor('Umeng.Demo');
    	/*$umeng=new \Demo("5afa46ef8f4a9d19f600008c", "kdockprelcj3qlth6vgthymejczsr2uu"); */
    	$demo = new \Demo("5afa49fdb27b0a365600013b", "qp22lyrj6twuswsxiuhejnerogyfsevn");
    	
    	
    	/*$android=$umeng->sendAndroidBroadcast($select['title'],$select['content']);*/
    	$ios=$demo->sendIOSBroadcast($select['title'],$select['content']);

	}
	 public function dataTuiXiaoxiandroid(){
    	$id=I('id');
    	//dump($id);
    	$m=M('news');
    	$mvp['tuisong']="1";
    	$save=$m->where('news_id='.$id)->save($mvp);
    	$select=$m->where('news_id='.$id)->find();
    	vendor('Umeng.Demo');
    	$umeng=new \Demo("5afa46ef8f4a9d19f600008c", "kdockprelcj3qlth6vgthymejczsr2uu"); 
    	/*$demo = new \Demo("5afa49fdb27b0a365600013b", "qp22lyrj6twuswsxiuhejnerogyfsevn");*/
    	
    	
    	$android=$umeng->sendAndroidBroadcast($select['title'],$select['content']);
    	/*$ios=$demo->sendIOSBroadcast($select['title'],$select['content']);*/

	}
	//推送活动
	 public function dataTuiHuodong(){
    	$id=I('id');
    	//dump($id);
    	$m=M('notice');
    	$data['status']=2;
    	$res=$m->where('notice_id='.$id)->save($data);
   		$this->ajaxReturn(interfaceReturn(0,'成功',""));
	}
	//取消活动推送
	public function quTuiHuodong(){
    	$id=I('id');
    	//dump($id);
    	$m=M('notice');
    	$data['status']=1;
    	$res=$m->where('notice_id='.$id)->save($data);
   		$this->ajaxReturn(interfaceReturn(0,'成功',""));
	}
	//取消消息推送
	public function quTuixiaoxi(){
    	$id=I('id');
    	//dump($id);
    	$m=M('news');
    	$data['tuisong']=0;
    	$res=$m->where('news_id='.$id)->save($data);
   		$this->ajaxReturn(interfaceReturn(0,'成功',""));
	}
	//编辑推送活动列表
	public function dataEditHuodong(){
		$this -> assign('imgURL',  C('IMG_URL'));
		$id=$_GET['id'];
		//dump($id);
		$m=M('notice');
		$select=$m->where('notice_id='.$id)->find();
		$this->assign('row',$select);
		$this->display('activiesp-edit');

	}
	//编辑推送活动
	public function dataEditHuodong_Sub(){

	if($_FILES['photo']['error']!=4){
		 	$upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg','pdf');// 设置附件上传类型
            $upload->rootPath  =     './Uploads/notice/'; // 设置附件上传根目录
            $upload->savePath  =     ''; // 设置附件上传（子）目录
            // 上传文件
            $info   =   $upload->upload();
            if(!$info) {// 上传错误提示错误信息
                $this->error($upload->getError());
            }else{// 上传成功
            	@unlink('.'.$_POST['oldpicname']);
            	//dump($_POST['oldpicname']);
            	//die();
            	$n=D('notice');
            	$data['title']=I('post.title');
            	$data['img']='/Uploads/notice/'.$info['photo']['savepath'].$info['photo']['savename'];
            	$data['text']=I('post.text');
            	$data['url']=I('post.url');
            	$data['time']=I('post.time');
		//$data["time"]=strtotime($data["time"]);
		$dataRetID=$n ->where('notice_id='.$_POST['notice_id'])->save($data);
		adminLog("编辑活动",$_POST["notice_id"],"","成功","");
		/*if($dataRetID){
				echo "<script>alert('修改成功');parent.location.href='".__MODULE__."/Notice/showList';</script>";
		}else{
				echo "<script>alert('添加失败');parent.location.href='".__MODULE__."/Notice/showList';</script>";
		}	*/
		$this->ajaxReturn(interfaceReturn(0,'成功',""));
    }
}else{
    	$n=D('notice');
        $data['title']=I('post.title');
        $data['img']=I('post.oldpicname');
        $data['text']=I('post.text');
        $data['url']=I('post.url');
        $data['time']=I('post.time');
        $dataRetID=$n ->where('notice_id='.$_POST['notice_id'])->save($data);
		adminLog("编辑活动",$_POST["notice_id"],"","成功","");
	    $this->ajaxReturn(interfaceReturn(0,'成功',""));
    }
	}
	//编辑推送消息列表
	public function dataEditXiaoxi(){
		$id=$_GET['id'];
		//dump($id);
		$m=M('news');
		$select=$m->where('news_id='.$id)->find();
		$this->assign('row',$select);
		$this->display('newsp-edit');
	}
	//编辑推送消息
	public function dataEditXiaoxi_Sub(){
		$data = M('news') -> create();
		$res=M('news') -> data($data)->save();
   		$this->ajaxReturn(interfaceReturn(0,'成功',""));
		
	}
}
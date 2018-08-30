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
header('Content-Type:text/html;charset=utf-8');
class ShopController extends BaseController {
    public function index(){
        $this->display();
    }
	//  
	//  ShopControllwer.class.php
	//  初始化页面方法 
	//  Created by uguyuahng on 2017-11-01.
	// 
	public function showList(){
		if(I("serchWord")!=null&&I("serchWord")!=""){
			$sql=" name like '%".I("serchWord")."%' ";
		}else{
			$sql=" 0=0 ";
		}
			
	   	$dataListArray = M('good')->where($sql)->order('good_id desc')->select();
	   
	    $this->assign('dataListArray',$dataListArray);
	    $this->assign('IMG_URL',C('IMG_URL'));
	
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
        $this->display('goods-manage');
    }
	
	// 
	//  ShopController.class.php
	//  添加商品
	//  
	
	public function dataAdd(){
		$type=D('type');
		$res=$type->select();
		$this->assign('res',$res);
        $this->display('goodsm-add');
    }
	public function dataAdd_Sub(){
		//dump($_FILES['img']['tmp_name']);
		//dump( $_FILES['img']['name']);
		
			vendor('cos.cos-autoloader');
			$cosClient = new \Qcloud\Cos\Client(array('region' => 'bj',
		    	'credentials'=> array(
		        'appId' => '1255995999',
		        'secretId'    => 'AKIDbKwODypWj2RxKVxtxJl4KfvGgPatP7Nn',
		        'secretKey' => 'l2TFq6FC3movvqjbQbfhmnqqju0iHUcZ')));
			//dump($cosClient);
			$bucket = 'wyk-img-1255995999';
			$aa=$_FILES["img"]["type"];
			dump($_FILES["img"]["type"]);
			$type=explode('/',$aa);
			$key = 'jifen/'.time().'.'.$type['1'];
			//dump($key);
			$local_path = $_FILES['img']['tmp_name'];
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
			//die();
			 
            	$n=D('good');
            	$data['name']=I('post.name');
            	$data['type_id']=I('post.type_id');
            	$data['img']='/jifen/'.time().'.'.$type['1'];
            	$data['price']=I('post.price');
            	$data['time']=I('post.time');
            	$data['timeend']=I('post.timeend');
            	$data['stock']=I('post.stock');
            	$data['details']=I('post.details');
            	$data['type']=I('post.type');
            	$data['rule']=I('post.rule');
            	$data['status']=1;
            	
		//$data["time"]=strtotime($data["time"]);
		$dataRetID=$n -> data($data)->add();

		adminLog("添加good",$dataRetID,"","成功","");
		if($dataRetID>0){
                echo "<script>alert('添加成功');parent.location.href='".__MODULE__."/Shop/showList';</script>"; 
            }
		
	
		
    }
	public function jifenshowlist(){
		 $this->assign('IMG_URL',C('IMG_URL'));
		if(I("serchWord")!=null&&I("serchWord")!=""){
			$sql=" and g.name like '%".I("serchWord")."%' ";
		}else{
			$sql=" and 0=0";
		}
		$m=D('ierecord');
		$select=$m->table('ierecord as i,good as g,user as u')->field('i.*,g.img,g.name as gname,u.name')->where('i.gid=g.good_id and i.uid=u.user_id'.$sql)->select();
		//dump($select);
		$this->assign('row',$select);
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
		$this->display('cashwitch-manage');

	}
	public function fahuo(){
		$id=$_POST['id'];
		$m=D('ierecord');
		$mvp['status']=2;
		$mvp['order_id']=$_POST['order'];
		$mvp['kuaidi']=$_POST['kuaidi'];
		$res=$m->where('idrecord_id='.$id)->save($mvp);
		$select=$m->where('idrecord_id='.$id)->find();
		$user=D('user');
        $tui=$user->field('device_tokens')->where('user_id='.$select['uid'])->find();
		if($res!=''){
            if($tui['device_tokens']==''){
            $n=D('news');
			$mmp['title']='发货状态';
			$mmp['content']='您的商品已发货注意查收，快递名称：'.$_POST['kuaidi']."快递单号：".$_POST['order'];
			$mmp['time']=time();
			$mmp['uid']=$select['uid'];
			$mmp['type']='1';
			$mmp['tuisong']=1;
			$new=$n->add($mmp);
            echo 1;
        }else{
             if(strlen($tui['device_tokens'])==64){
             	 $n=D('news');
			$mmp['title']='发货状态';
			$mmp['content']='您的商品已发货注意查收，快递名称：'.$_POST['kuaidi']."快递单号：".$_POST['order'];
			$mmp['time']=time();
			$mmp['uid']=$select['uid'];
			$mmp['type']='1';
			$mmp['tuisong']=1;
			$new=$n->add($mmp);
            vendor('Umeng.Demo');
            $demo = new \Demo("5afa49fdb27b0a365600013b", "qp22lyrj6twuswsxiuhejnerogyfsevn");
            $ios=$demo->sendIOSUnicast("您的商品已发货","您的商品已发货",$tui['device_tokens']);   
            
        }else{
        	 $n=D('news');
			$mmp['title']='发货状态';
			$mmp['content']='您的商品已发货注意查收，快递名称：'.$_POST['kuaidi']."快递单号：".$_POST['order'];
			$mmp['time']=time();
			$mmp['uid']=$select['uid'];
			$mmp['type']='1';
			$mmp['tuisong']=1;
			$new=$n->add($mmp);
            vendor('Umeng.Demo');
            $umeng=new \Demo("5afa46ef8f4a9d19f600008c", "kdockprelcj3qlth6vgthymejczsr2uu"); 
       
            $android=$umeng->sendAndroidUnicast("您的商品已发货","您的商品已发货",$tui['device_tokens']);
          
           
        }
        }
       
        }else{
          echo 2;  
        }
		//$this->ajaxReturn(interfaceReturn(0,'成功',""));

	}
	public function view(){
		$m=D('ierecord');
		$id=I('id');
		$select=$m->table('ierecord as i,address as a')->field('a.*,i.time')->where('a.address_id=i.address_id and i.idrecord_id='.$id)->find();
		//dump($select);
		$this->assign('row',$select);
		$this->display();
	}
	// 
	//  ShopController.class.php
	//  编辑商品
	//  
	
	public function dataEdit(){
		 $this->assign('IMG_URL',C('IMG_URL'));
		$dataId=I("id");
		$data=M("good")->where(" good_id = ".$dataId)->find();
	    $this->assign('name',$data["name"]);
	    $this->assign('price',$data["price"]);
	    $this->assign('time',$data["time"]);
	    $this->assign('timeend',$data["timeend"]);
	    $this->assign('stock',$data["stock"]);
	    $this->assign('rule',htmlspecialchars_decode($data["rule"]));
	    $this->assign('type_id',$data['type_id']);
	    $this->assign('details',$data['details']);
	    $this->assign('type',$data['type']);
	    $this->assign('type_id',$data['type_id']);
	    $this->assign('good_id',$data["good_id"]);
	    $this->assign('img',$data["img"]);
		$img="http://wyk-img-1255995999.cos.ap-beijing.myqcloud.com";
            $this->assign('imgurl',$img);
        $this->display('goodsm-edit');
    }
    public function dataEdit_Sub(){
    	if($_FILES['img']['error']!=4){
		vendor('cos.cos-autoloader');
			$cosClient = new \Qcloud\Cos\Client(array('region' => 'bj',
		    	'credentials'=> array(
		        'appId' => '1255995999',
		        'secretId'    => 'AKIDbKwODypWj2RxKVxtxJl4KfvGgPatP7Nn',
		        'secretKey' => 'l2TFq6FC3movvqjbQbfhmnqqju0iHUcZ')));
			//dump($cosClient);
			$bucket = 'wyk-img-1255995999';
			$aa=$_FILES["img"]["type"];
			dump($_FILES["img"]["type"]);
			$type=explode('/',$aa);
			$key = 'jifen/'.time().'.'.$type['1'];
			//dump($key);
			$local_path = $_FILES['img']['tmp_name'];
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
			//die();
			
            	$n=D('good');
            	$data['name']=I('post.name');
            	$data['type_id']=I('post.type_id');
            	$data['img']='/jifen/'.time().'.'.$type['1'];
            	$data['price']=I('post.price');
            	$data['time']=I('post.time');
            	$data['timeend']=I('post.timeend');
            	$data['stock']=I('post.stock');
            	$data['details']=I('post.details');
            	$data['type']=I('post.type');
            	$data['rule']=I('post.rule');
            	//$data['status']=1;
		$dataRetID=$n ->where('good_id='.$_POST['good_id'])->save($data);
		adminLog("编辑商品",$_POST["good_id"],"","成功","");
		if($dataRetID>0){
                echo "<script>alert('修改成功');parent.location.href='".__MODULE__."/Shop/showList';</script>"; 
            }
    }else{
    	        $n=D('good');
            	$data['name']=I('post.name');
            	$data['type_id']=I('post.type_id');
            	$data['img']=$_POST['oldpicname'];
            	$data['price']=I('post.price');
            	$data['time']=I('post.time');
            	$data['timeend']=I('post.timeend');
            	$data['stock']=I('post.stock');
            	$data['details']=I('post.details');
            	$data['type']=I('post.type');
            	$data['rule']=I('post.rule');
            	//$data['status']=1;
        $dataRetID=$n ->where('good_id='.$_POST['good_id'])->save($data);
		adminLog("编辑商品",$_POST["good_id"],"","成功","");
		/*if($dataRetID){
				echo "<script>alert('修改成功');parent.location.href='".__MODULE__."/Notice/showList';</script>";
		}else{
				echo "<script>alert('添加失败');parent.location.href='".__MODULE__."/Notice/showList';</script>";
		}*/
	   if($dataRetID>0){
                echo "<script>alert('修改成功');parent.location.href='".__MODULE__."/Shop/showList';</script>"; 
            }
    }
    }
	
	
	// 
	//  ShopController.class.php
	//  数据删除

	public function dataDel(){
		$dataId=I("id");
		M("good")->delete($dataId);
		adminLog("删除商品","","","成功","");
		$this->ajaxReturn(interfaceReturn(0,'成功',""));
	}
	
	// 
	//  ShopController.class.php
	//  上架商品
	public function shangjia(){
		$dataId=I("id");
		$data=M("good")->where(" good_id = ".$dataId)->find();
		$data["status"]="1";
		M("good")->data($data)->save();
		adminLog("上架商品",$dataId,"","成功","");
		
		$this->ajaxReturn(interfaceReturn(0,'成功',""));
	}
	
	// 
	//  ShopController.class.php
	//  下架商品
	public function xiajia(){
		$dataId=I("id");
		$data=M("good")->where(" good_id = ".$dataId)->find();
		$data["status"]="2";
		M("good")->data($data)->save();
		
		adminLog("下架商品",$dataId,"","成功","");
		
		$this->ajaxReturn(interfaceReturn(0,'成功',""));
	}
	public function adddi(){
		$id=$_GET['id'];
		$this->assign('id',$id);
		$this->display('addkuaidi');
	}
	//地址管理
	public function address(){
		 $this->assign('IMG_URL',C('IMG_URL'));
		if(I("serchWord")!=null&&I("serchWord")!=""){
			$sql=" and u.name like '%".I("serchWord")."%' ";
		}else{
			$sql=" and 0=0";
		}
		$m=D('address');
		$select=$m->table('address as a,user as u')->field('a.*,u.name as uname')->where('a.uid=u.user_id '.$sql)->select();
		
		// foreach($select as $k=>$v){
		// 	$area=D('dede_area');
		// 	$info=$area->field('name')->where('id='.$v['p_id'])->find();
		// 	$infoo=$area->field('name')->where('id='.$v['c_id'])->find();
		// 	$select[$k]['pro']=$info['name'];
		// 	$select[$k]['city']=$infoo['name'];
		// }
		//dump($select);
		$this->assign('row',$select);
		$auth=D('adminrauth');
            $uid=session('user.id');
            $list=$auth->where('admin_id='.$uid)->select();
            $a="";
            foreach($list as $k=>$v){
                $a.=$v['auth_id'].',';
            }
            //dump ($a);
            $this->assign('res',$a);
		$this->display();

	}
}
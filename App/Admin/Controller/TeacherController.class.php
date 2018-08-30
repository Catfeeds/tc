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
class TeacherController extends BaseController {
    public function index(){
        $this->display();
    }
	//  
	//  ShopControllwer.class.php
	//  初始化页面方法 
	//  Created by uguyuahng on 2017-11-01.
	// 
	public function showList(){
		if(I('serchWord')!=null && I("serchWord")!=""){
			$name=I('serchWord');
			$class=D('class');
			$dataListArray=M('class')
                ->table('class as c,userdata as ud,user as u')
                ->field('c.*,ud.image,u.name as uname')
                ->where("c.uid=ud.uid and u.user_id=c.uid and u.name like '%$name%'")
                ->select();
		   	foreach($dataListArray as $k=>$v){
		     
		      $info=M('goods')->where('class_id='.$v['class_id']. ' and type=3 and astatus=1 or type=4 and class_id='.$v['class_id'].' and astatus=1')->count();
		   	  $dataListArray[$k]['videonum']=$info;
		   	}
		   	
		    //dump($dataListArray);
		    $this->assign('dataListArray',$dataListArray);
		    $this->assign('IMG_URL',C('IMG_URL'));
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
		    $img="http://wyk-img-1255995999.cos.ap-beijing.myqcloud.com";
            $this->assign('img',$img);
	        $this->display('teachers-list');
		}else{
            //服务器分页begin  前端的分页放弃
            $M = M('class'); // 实例化User对象
            $count      = $M->table('class as c,userdata as ud,user as u')
                            ->field('c.*,ud.image,u.name as uname')
                            ->where('c.uid=ud.uid and u.user_id=c.uid')
                            ->count();// 查询满足要求的总记录数
            $Page       = new \Think\Page($count,8);// 实例化分页类 传入总记录数和每页显示的记录数(25)
            $Page->lastSuffix=false;
            $Page->setConfig('header','<li class="rows">共<b>%TOTAL_ROW%</b>条记录&nbsp;&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
            $Page->setConfig('prev','上一页');
            $Page->setConfig('next','下一页');
            $Page->setConfig('last','末页');
            $Page->setConfig('first','首页');
            $Page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
            $show       = $Page->show();// 分页显示输出
            //服务器分页end
			$dataListArray=M('class')
                ->table('class as c,userdata as ud,user as u')
                ->field('c.*,ud.image,u.name as uname')
                ->where('c.uid=ud.uid and u.user_id=c.uid')
                ->limit($Page->firstRow.','.$Page->listRows)
                ->select();
		   	foreach($dataListArray as $k=>$v){
		      $info=M('goods')->where('class_id='.$v['class_id']. ' and type=2 and astatus=1 or type=4 and astatus=1 and class_id='.$v['class_id'])->count();
		   	  $dataListArray[$k]['videonum']=$info;
		   	}
		   	
		    //dump($dataListArray);
		    $this->assign('dataListArray',$dataListArray);
		    $this->assign('IMG_URL',C('IMG_URL'));
			$auth=D('adminrauth');
				$uid=session('user.id');
				$list=$auth
                    ->where('admin_id='.$uid)
                    ->select();
				$a="";
				foreach($list as $k=>$v){
					$a.=$v['auth_id'].',';
				}
				//dump ($a);
				$this->assign('res',$a);
		    // 当前查询共有多少数据
		   // $dataNum=count(dataListArray);
		    //$this->assign('dataNum',$orderNum);
		    $img="http://wyk-img-1255995999.cos.ap-beijing.myqcloud.com";
            $this->assign('img',$img);
            // 赋值分页输出
            $this->assign('page',$show);
	        $this->display('teachers-list');
		}
    }

	//用户上线
	public function xianshi(){
		$dataId=I("id");
		$data=M("user")->where(" user_id = ".$dataId)->find();
		$data["status"]="0";
		M("user")->data($data)->save();
		adminLog("教师上线",$dataId,"","成功","");
		
		$this->ajaxReturn(interfaceReturn(0,'成功',""));
	}

	//用户下线
	public function yincang(){
		$dataId=I("id");
		$data=M("user")->where(" user_id = ".$dataId)->find();
		$data["status"]="1";
		M("user")->data($data)->save();
		
		adminLog("教师下线",$dataId,"","成功","");
		
		$this->ajaxReturn(interfaceReturn(0,'成功',""));
	}

	/*新增教师管理 单独资金修改可扩充 想改哪个改哪个*/
	public function manage_list(){
        if(I("serchWord")!=null&&I("serchWord")!=""){
            $sql=" u.phone like '%".I("serchWord")."%' ";
        }else{
            $sql=" 0=0 ";
        }

        //服务器分页begin  前端的分页放弃
        $count= M('class')
            ->table('class as c,userdata as ud,user as u')
            ->field('c.*,ud.image,u.phone,u.name as uname')
            ->where('c.uid=ud.uid and u.user_id=c.uid and '.$sql)
            ->count();
        $Page       = new \Think\Page($count,8);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $Page->lastSuffix=false;
        $Page->setConfig('header','<li class="rows">共<b>%TOTAL_ROW%</b>条记录&nbsp;&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('last','末页');
        $Page->setConfig('first','首页');
        $Page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        $show       = $Page->show();// 分页显示输出
        //服务器分页end

        $dataListArray=M('class')
            ->table('class as c,userdata as ud,user as u')
            ->field('c.*,ud.image,u.phone,u.name as uname')
            ->where('c.uid=ud.uid and u.user_id=c.uid and '.$sql)
            ->limit($Page->firstRow.','.$Page->listRows)
            ->select();
        foreach($dataListArray as $k=>$v){
            $info=M('goods')->where('class_id='.$v['class_id']. ' and type=2 and astatus=1 or type=4 and astatus=1 and class_id='.$v['class_id'])->count();
            $dataListArray[$k]['videonum']=$info;
        }

        $this->assign('dataListArray',$dataListArray);
        /*$this->assign('IMG_URL',C('IMG_URL'));*/
        $img="http://wyk-img-1255995999.cos.ap-beijing.myqcloud.com";
        $this->assign('img',$img);
        // 赋值分页输出
        $this->assign('page',$show);
        $this->display();
    }
    public function teacher_details(){
	    $id=$_GET['id'];
        $dataListArray=M('class')
            ->table('class as c,userdata as ud,user as u')
            ->field('c.*,ud.image,u.phone,u.name as uname')
            ->where('c.uid=ud.uid and u.user_id=c.uid and c.class_id='.$id)
            ->find();
        $dataListArray['honorimg']=explode(",", $dataListArray['honorimg'] );
        //dump($dataListArray);
        $img="http://wyk-img-1255995999.cos.ap-beijing.myqcloud.com";
        $this->assign('img',$img);
        $this->assign('model',$dataListArray);
	    $this->display();
    }
    public function part_change(){
	    $id=$_GET['id'];
	    $profit=M('class')->field('profit')->where('class_id='.$id)->find();
	   $data=[
	       'class_id'=>$id,
           'profit'=>$profit['profit']
	       ];
	    $this->assign('info',$data);
        $this->display();
    }
    public function part_change_action(){
	    $data=[
	      'class_id'=>I('post.class_id'),
	      'profit'=>I('post.profit')
        ];
	    $res=M('class')->data($data)->save();
	    if($res){
            echo "<script>alert('修改成功');parent.parent.location.href='".__MODULE__."/Teacher/manage_list';</script>";
        }else{
            echo "<script>alert('没有修改');parent.parent.location.href='".__MODULE__."/Teacher/manage_list';</script>";
        }
    }
}
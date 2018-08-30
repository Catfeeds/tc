<?php

namespace Admin\Controller;

use Think\Controller;

class UsermanageController extends BaseController{
	public function index(){
        $this->display();
    }
	
	public  function showlist(){
		
		$this -> assign('imgURL',  C('IMG_URL'));
		//查询都是根据user 表中字段来做的
		$user=D('User');

        //服务器分页begin  前端的分页放弃
        $M = M('user'); // 实例化User对象
        $count      = $M->count();// 查询满足要求的总记录数
        /*$Page       = new \Think\Page($count,12);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $Page->lastSuffix=false;
        $Page->setConfig('header','<li class="rows">共<b>%TOTAL_ROW%</b>条记录&nbsp;&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('last','末页');
        $Page->setConfig('first','首页');
        $Page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        $show       = $Page->show();// 分页显示输出*/
        //服务器分页end
        //分页方法
        $data=pager($count,10);
			
		if(IS_POST){
			$selstatus=$_POST["selstatus"]; //状态    全部0   上线1   下线2
        	$selclass=$_POST["selclass"];   //手机号码 0   昵称1
		
			$phoneorname=$_POST["txtClass"];
			 
			$sql="select ud.image,u.name,u.phone,ud.money,ud.amount,u.time,u.status,u.user_id,u.cishu
					from user u join userdata ud on u.user_id=ud.uid";
			if(!$phoneorname){
				if($selstatus=='0'){
					$sql=$sql.' order by u.time desc';
				}elseif($selstatus=='1'){
					$sql=$sql." where u.status='0' order by u.time desc";
				}elseif($selstatus=='2'){
					$sql=$sql." where  u.status='1' order by u.time desc";
				}

			}else{
			if($selclass=='0'&& $selstatus=='0'){
				$sql=$sql." where u.phone like '%$phoneorname%'  order by u.time desc";
			}elseif($selclass=='0'&& $selstatus=='1'){
				$sql=$sql." where u.phone like '%$phoneorname%' and u.status='0' order by u.time desc";
			}elseif($selclass=='0'&& $selstatus=='2'){
				$sql=$sql." where u.phone like '%$phoneorname%' and u.status='1' order by u.time desc";
			}elseif($selclass=='1'&& $selstatus=='0'){
				$sql=$sql." where u.name like '%$phoneorname%'  order by u.time desc";
			}elseif($selclass=='1'&& $selstatus=='1'){
				$sql=$sql." where u.name like '%$phoneorname%' and u.status='1' order by u.time desc";
			}elseif($selclass=='1'&& $selstatus=='2'){
				$sql=$sql." where u.name like '%$phoneorname%' and u.status='2' order by u.time desc";
			}
	    }
			$list=$user->query($sql);
//			$list=$user->table('userdata ud,user u')
//			->field('ud.money,ud.image,u.phone,u.name,u.time,u.status,u.user_id,ud.amount')
//			->where('ud.uid=u.user_id')->select();
	
			foreach($list as $k=>$v){
				$list[$k]['time']=date("Y-m-d H:i:s",$v['time']);
			}
			//dump($list);
			
			//dump($sql);
			$auth=D('adminrauth');
			$uid=session('user.id');
			$lists=$auth->where('admin_id='.$uid)->select();
			$a="";
			foreach($lists as $k=>$v){
				$a.=$v['auth_id'].',';
			}
			//dump ($a);
			$img="http://wyk-img-1255995999.cos.ap-beijing.myqcloud.com";
            $this->assign('img',$img);
			$this->assign('res',$a);
			$this->assign("info",$list);
			$this->display();
		}else{
			/*$sql="select ud.image,u.name,u.phone,ud.money,ud.amount,u.time,u.status,u.user_id,u.cishu
					from user u join userdata ud on u.user_id=ud.uid
						order by u.time desc";
			$info= $user->query($sql);*/

            $info= M('User')
                ->alias('u')
                ->join('userdata as ud on u.user_id=ud.uid')
                ->field('ud.image,u.name,u.phone,ud.money,ud.amount,u.time,u.status,u.user_id,u.cishu,ud.integral')
                ->limit($data['limit'])
                ->order('u.time desc')
                ->select();
			
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
			$img="http://wyk-img-1255995999.cos.ap-beijing.myqcloud.com";
            $this->assign('img',$img);
            $this->assign('info',$info);
            // 赋值分页输出
            $this->assign('page',$data['show']);
            $this->display();
		}
		
	}
	
	
	
	//设置下线
	public function  setRefuse(){
		
        $user=D('User');

        $setid=I("id");

        $sql="update user set status='1' where user_id = ".$setid;
        $data=$user->execute($sql);

        $ajaxmsg['res']=$data;
        $ajaxmsg['code']=1;
        $ajaxmsg['statu']='ok';
        $ajaxmsg['msg']='设置成功';

        $this->ajaxReturn($ajaxmsg);

    }
    //上线
    public function  setpass(){
		
        $user=D('User');

        $setid=I("id");

        $sql="update user set status='0' where user_id = ".$setid;
        $data=$user->execute($sql);

        $ajaxmsg['res']=$data;
        $ajaxmsg['code']=1;
        $ajaxmsg['statu']='ok';
        $ajaxmsg['msg']='设置成功';

        $this->ajaxReturn($ajaxmsg);

    }

    public function order_list(){
        $this -> assign('imgURL',  C('IMG_URL'));
        //查询都是根据user 表中字段来做的
        $user=M('User');

        if(IS_POST){
            $selstatus=$_POST["selstatus"]; //状态    全部0   上线1   下线2
            $selclass=$_POST["selclass"];   //手机号码 0   昵称1
            $phoneorname=$_POST["txtClass"];
            $sql="select ud.image,u.name,u.phone,ud.money,ud.amount,u.time,u.status,u.user_id,u.cishu,ud.integral
					from user u join userdata ud on u.user_id=ud.uid";
            if(!$phoneorname){
                if($selstatus=='0'){
                    $sql=$sql.' order by u.time desc';
                }elseif($selstatus=='1'){
                    $sql=$sql." where u.status='0' order by u.time desc";
                }elseif($selstatus=='2'){
                    $sql=$sql." where  u.status='1' order by u.time desc";
                }
            }else{
                if($selclass=='0'&& $selstatus=='0'){
                    $sql=$sql." where u.phone like '%$phoneorname%'  order by u.time desc";
                }elseif($selclass=='0'&& $selstatus=='1'){
                    $sql=$sql." where u.phone like '%$phoneorname%' and u.status='0' order by u.time desc";
                }elseif($selclass=='0'&& $selstatus=='2'){
                    $sql=$sql." where u.phone like '%$phoneorname%' and u.status='1' order by u.time desc";
                }elseif($selclass=='1'&& $selstatus=='0'){
                    $sql=$sql." where u.name like '%$phoneorname%'  order by u.time desc";
                }elseif($selclass=='1'&& $selstatus=='1'){
                    $sql=$sql." where u.name like '%$phoneorname%' and u.status='1' order by u.time desc";
                }elseif($selclass=='1'&& $selstatus=='2'){
                    $sql=$sql." where u.name like '%$phoneorname%' and u.status='2' order by u.time desc";
                }
            }
            $list=$user->query($sql);
            foreach($list as $k=>$v){
                $list[$k]['time']=date("Y-m-d H:i:s",$v['time']);
            }
            $img="http://wyk-img-1255995999.cos.ap-beijing.myqcloud.com";
            $this->assign('img',$img);
            $this->assign("info",$list);
            $this->display();
        }else{
            //服务器分页begin  前端的分页放弃
            $news = M('User'); // 实例化User对象
            $count      = $news->count();// 查询满足要求的总记录数
            /*$Page       = new \Think\Page($count,8);// 实例化分页类 传入总记录数和每页显示的记录数(25)
            $Page->lastSuffix=false;
            $Page->setConfig('header','<li class="rows">共<b>%TOTAL_ROW%</b>条记录&nbsp;&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
            $Page->setConfig('prev','上一页');
            $Page->setConfig('next','下一页');
            $Page->setConfig('last','末页');
            $Page->setConfig('first','首页');
            $Page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
            $show       = $Page->show();// 分页显示输出*/
            $data=pager($count);
            //服务器分页end
           /* $sql="select ud.image,u.name,u.phone,ud.money,ud.amount,u.time,u.status,u.user_id,u.cishu,ud.integral
					from user u join userdata ud on u.user_id=ud.uid
						order by u.time desc";*/
            $info= M('User')
                ->alias('u')
                ->join('userdata as ud on u.user_id=ud.uid')
                ->field('ud.image,u.name,u.phone,ud.money,ud.amount,u.time,u.status,u.user_id,u.cishu,ud.integral')
                ->limit($data['limit'])
                ->order('u.time desc')
                ->select();

            foreach($info as $k=>$v){
                $info[$k]['time']=date("Y-m-d H:i:s",$v['time']);
            }
            $img="http://wyk-img-1255995999.cos.ap-beijing.myqcloud.com";
            $this->assign('img',$img);
            $this->assign('info',$info);
            // 赋值分页输出
            $this->assign('page',$data['show']);
            $this->display();
        }
    }

    public function order_by_list(){
        $this -> assign('imgURL',  C('IMG_URL'));
        $order_tpye=I('post.order_type');
        $order_by=I('post.order_by');
        $conf_arr=[
          'jifen'=>'ud.integral ',
          'jine'=>'ud.money ',
          'cishu'=>'u.cishu ',
          'shijian'=>'u.time ',
          'xfjine'=>'ud.amount ',
        ];
        $info=M('User')
            ->alias('u')
            ->join('userdata as ud on u.user_id=ud.uid')
            ->field('ud.image,u.name,u.phone,ud.money,ud.amount,u.time,u.status,u.user_id,u.cishu,ud.integral')
            ->limit(100)
            ->order($conf_arr[$order_by].$order_tpye)
            ->select();
        foreach($info as $k=>$v){
            $info[$k]['time']=date("Y-m-d H:i:s",$v['time']);
        }
        $img="http://wyk-img-1255995999.cos.ap-beijing.myqcloud.com";
        //拼接表单
        $html='';
        foreach ($info as $k=>$v){
            $html.="<tr class='text-c'>";
            $html.="<td>";
            $html.="<img width='50' height='50' alt='' src='".$img.$v['image']."'>";
            $html.="</td>";
            $html.="<td>".$v['name']."</td>";
            $html.="<td>".$v['phone']."</td>";
            $html.="<td>".$v['integral']."</td>";
            $html.="<td>".$v['money']."</td>";
            $html.="<td>".$v['amount']."</td>";
            $html.="<td>".$v['cishu']."</td>";
            $html.="<td>".$v['time']."</td>";
            $html.="<td>";
            if($v['status']==0){
                $html.="<span class='label label-success radius' >上线</span>";
            }else{
                $html.="<span class='label label-success radius' >下线</span>";
            }
            $html.="</td>";
            $html.="</tr>";
        }
        $this->ajaxReturn($html,'JSON');
    }

}
?>
<?php
namespace Admin\Controller;
Vendor('MagicClass.Diy');
use Think\Controller;
class BaseController extends Controller {
    //构造函数
    function __construct() 
    {
        parent::__construct();
		
		C('INDEX_URL','http://192.168.1.254:89/admin.php');
		C('LOGIN_URL','http://192.168.1.254:89/admin.php/Login');
		C('IMG_URL','http://192.168.1.254:89/');
		C('SHOP_IMG_URL','http://192.168.1.254:89/Public/Admin/lib/webuploader/0.1.5/server/upload/');
        //验证登录
       	$this->getUserLoginInfo();
       	//权限验证
	    $this->auth();
    }    
    function auth(){
        //默认的权限 一些提交的执行操作
        $public_arr=C('ALLOW_AUTH');
        //dump(CONTROLLER_NAME.'/'. ACTION_NAME);
        $auth_str=CONTROLLER_NAME.'/'. ACTION_NAME;
        if(in_array($auth_str,$public_arr)){

        }else{
            $auth_id=M('auth')->field('auth_id')->where(['auth_ac'=>$auth_str])->find();
            $auth_arr=M('admin')
                ->alias('ad')
                ->join('role as ro on ad.role_id = ro.role_id')
                ->field('ro.role_auth')
                ->where('ad.admin_id = '.session('user.id'))
                ->find();
            //dump($auth_arr);
            if($auth_arr['role_auth']=='all'){
                //超级管理员 无敌
            }else{
                $auth_arr=json_decode($auth_arr['role_auth'],true);
                //判断$auth_id 是否在这个数组里 在则有权限 不在则无权限
                if(in_array($auth_id['auth_id'],$auth_arr)){

                }else{
                    header("Content-type: text/html; charset=utf-8");
                    echo '无"'.$auth_str.'"权限，请联系管理员。';die;
                }
            }
        }
    }
	
	//验证是否登陆方法
    function getUserLoginInfo()
    {
        if (!session('user.id')) {
        	//设置登陆后跳转页面
            cookie('url.loginJump', curPageURL(), 3600);
            message('提示', '请先登录', C('LOGIN_URL'));
        }else{
        	return session('user.id');
        }
    }
    
    
    function getRandomString($len, $chars=null){  
    	if (is_null($chars)){  
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";  
    	}  
    	mt_srand(10000000*(double)microtime());  
    	for ($i = 0, $str = '', $lc = strlen($chars)-1; $i < $len; $i++) {  
        	$str .= $chars[mt_rand(0, $lc)];  
    	}  
    	return $str;  
}
	function quanxianpanduan(){
		//cookie('test.A',session('user.ActionID'));
		if(session('user.roleID')==1){
			return TRUE;
		}
		$ret=FALSE;
		$resultAction = M('sys_admin_role_action') -> where('ActionID in (' .session('user.ActionID') . ')')  -> select();
		for ($i=0; $i < count($resultAction); $i++) {
			
			$ActionNameA=strtoupper($resultAction[$i]['ActionCName']);
			$ActionNameB=strtoupper(CONTROLLER_NAME.ACTION_NAME);
			
			
			cookie('test.A',$ActionNameA); 
			cookie('test.B',$ActionNameB); 
			if($ActionNameA==$ActionNameB){
				$ret=TRUE;
			} 
		}
		return $ret;
		if(!$ret){
			message('提示', '暂无权限', $Diy::curPageURL());
		}
	}

}

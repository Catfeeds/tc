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
class IndexController extends BaseController {
    public function index(){
    	if(session('user.id')){
    	$uid=session('user.id');
        $admin=D('admin')->where('admin_id='.$uid)->find();
        $name=$admin['name'];
        $role=$admin['role'];
        $this->assign('name',$name);
        $this->assign('role',$role);
        $this->display();
    	}else{
    		
    	}
    	

    } 
	
	public function welcome() {
		$uid=session('user.id');
        $admin=D('admin')->where('admin_id='.$uid)->find();
        $name=$admin['name'];
        $role=$admin['role'];
        $this->assign('name',$name);
        $this->assign('role',$role);
        $this->assign('admin',$admin);
		$this -> display('welcome');
	}
	
	// 
	//  IndexController.class.php
	//  退出登录方法
	//  Created by guyuhang on 2017-10-31
	// 
	//退出登录方法
	public function login_Out() {
		adminLog("退出登录","","","成功","");
		session('user.id', null);
		redirect(C('LOGIN_URL'));
	}
	
}
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
header("Access-Control-Allow-Origin: *");
class LoginController extends Controller {
    public function index(){
		$this -> assign('indexURL',  C('INDEX_URL'));
		$this->display('login');
    } 
	
	//登陆后提交方法
	public function login_Sub() {
		$LoginName = I("LoginName");
		$LoginPwd = I("LoginPwd");
		$resultAdmin = M("admin") -> where(" name='" . $LoginName."'") -> find();
		if ($resultAdmin == null) {											//账户不存在
				adminLog("登录","","","失败","账户不存在，登录账户为：".$LoginName);
				$this->ajaxReturn(interfaceReturn(1,'账户不存在',""));
		} else {
			if($resultAdmin["status"]==1){	
				adminLog("登录","","","失败","账户已被锁定");
				$this->ajaxReturn(interfaceReturn(1,'账户被锁定',""));
			}
			if($LoginPwd==$resultAdmin["pass"]){							//登录成功
				if($resultAdmin["status"]==1){	
					adminLog("登录","","","失败","账户已被锁定");
					$this->ajaxReturn(interfaceReturn(1,'账户被锁定',""));
				}
				session('user.id', $resultAdmin['admin_id']);
				$resultAdmin["num"]=0;											//清空密码错误次数
				$resultAdmin["loginnum"]+=1;
				M("admin")->data($resultAdmin)->save();					
				adminLog("登录","","","成功","");
				$this->ajaxReturn(interfaceReturn(0,'登录成功',""));
			}else{
				$resultAdmin["num"]+=1;	
				if($resultAdmin["num"]>=3){											//账户锁定
					$resultAdmin["status"]="1";						//清空密码错误次数
					M("admin")->data($resultAdmin)->save();		
					adminLog("登录","","","失败","密码错误（账户锁定）");
					$this->ajaxReturn(interfaceReturn(1,'密码错误次数过多，账户被锁定',""));
				}else{
					M("admin")->data($resultAdmin)->save();											//密码错误
					adminLog("登录","","","失败","密码错误（第".$resultAdmin["num"]."次）");
					$this->ajaxReturn(interfaceReturn(1,"密码错误，（剩余".(3-$resultAdmin["num"])."次）",""));
				}
			}
		}
	}
	
	//返回登录页面方法
	public function returnLogin(){
		$this->index();
	}
}
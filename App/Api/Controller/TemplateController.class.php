<?php
/******************************
 *
 * 时间：
 * 功能：
 * 作者：Mr Peng
 *
 *****************************/ 
namespace Api\Controller;
use Think\Controller;

header("Access-Control-Allow-Origin: *");
class TemplateController extends CommonController {

// +----------------------------------------------------------------------
// | 功能       | 获取sig
// +----------------------------------------------------------------------
// | 请求类型   | post
// +----------------------------------------------------------------------
// | 参数       | token
// +----------------------------------------------------------------------    
	public function index(){
		$data=(object)null;
		if(IS_POST){
			$token=I('post.token');
			if($token==''){
				echo json_encode($this->apiTemplate($data,'203','参数错误'));
			}else{
				$user=M('user');
				$userrel=$user->where(array('token'=>$token))->find();
				if($userrel){
					$tls=new \Org\Util\TLSSig();
					$identifier=$userrel['token'];
					$date['sig']=$tls->genSig($identifier);
					echo json_encode($this->apiTemplate($date,'200','ok'));
				}else{
					echo json_encode($this->apiTemplate($data,'202','token过期'));
				}
			}
		}else{
			echo json_encode($this->apiTemplate($data,'203','请求类型错误'));
		}
	}
// +----------------------------------------------------------------------
// | 功能       | 上传视频的签名
// +----------------------------------------------------------------------
// | 请求类型   | post
// +----------------------------------------------------------------------
// | 参数       | token
// +---------------------------------------------------------------------- 
	public function videosig(){
		$data=(object)null;
		if(IS_POST){
			$token=I('post.token');
			if($token==''){echo json_encode($this->apiTemplate($data,'204','参数错误'));exit;}
			$user=M('user');
			$userrel=$user->where(array('token'=>$token))->find();
			if(!$userrel){echo json_encode($this->apiTemplate($data,'202','token过期'));exit;}
			$prove=M('prove');
			$proverel=$prove->where(array('uid'=>$userrel['user_id'],'status'=>'1'))->find();
			if(!$proverel){echo json_encode($this->apiTemplate($data,'202','你还没有实名认证'));exit;}

			// 确定 App 的云 API 密钥
			$secret_id = "AKIDZ7Yt9DaBuXyV5hHVckgV9lCRVREpao24";
			$secret_key = "xjJhXIwa1HLDuPhoJf8Vly30lKwV2YyF";

			// 确定签名的当前时间和失效时间
			$current = time();
			$expired = $current + 86400;  // 签名有效期：1天

			// 向参数列表填入参数
			$arg_list = array(
				"secretId" => $secret_id,
				"currentTimeStamp" => $current,
				"expireTime" => $expired,
				"random" => rand()
			);

			// 计算签名
			$orignal = http_build_query($arg_list);
			$signature = base64_encode(hash_hmac('SHA1', $orignal, $secret_key, true).$orignal);
			$result['sign']=$signature;
			echo json_encode($this->apiTemplate($result,'200','ok'));
		}else{
			echo json_encode($this->apiTemplate($data,'203','请求类型错误'));
		}
	}
// +----------------------------------------------------------------------
// | 功能       | 上传视频
// +----------------------------------------------------------------------
// | 请求类型   | post
// +----------------------------------------------------------------------
// | 参数       | token,img_url,name,cate_id,money,introduce,video_url,video_id
// +---------------------------------------------------------------------- 
	public function uploadvideo(){
		$data=(object)null;
		if(IS_POST){
			$token=I('post.token');								//用户token
			$img_url=I('post.img_url');							//视频封面url
			$name=Sensitivefilter(I('post.name'));				//视频标题
			$cate_id=I('post.cate_id');							//视频分类
			$money=I('post.money');								//视频价格
			$introduce=Sensitivefilter(I('post.introduce'));	//视频介绍
			$video_url=I('video_url');							//视频url
			$file_id=I('video_id');
			if($token==''||$img_url==''||$name==''||$cate_id==''||$money==''||$introduce==''||$video_url==''||$file_id==''){
				echo json_encode($this->apiTemplate($data,'204','参数错误'));exit;
			}
			$user=M('user');
			$userrel=$user->where(array('token'=>$token))->find();
			if(!$userrel){echo json_encode($this->apiTemplate($data,'202','token过期'));exit;}
			$prove=M('prove');
			$proverel=$prove->where(array('uid'=>$userrel['user_id'],'status'=>'1'))->find();
			if(!$proverel){echo json_encode($this->apiTemplate($data,'202','你还没有实名认证'));exit;}
			$class=M('class');
			$classrel=$class->where('uid='.$userrel['user_id'])->find();
			$mvp=array(
				'img'		=>	$img_url,
				'name'		=>	$name,
				'class_id'	=>	$classrel['class_id'],
				'cate_id'	=>	$cate_id,
				'money'		=>	$money,
				'introduce'	=>	$introduce,
				'recommend'	=>	'0',
				'url'		=>	$video_url,
				'time'		=>	time(),
				'status'	=>	'0',
				'astatus'	=>	'0',
				'file_id'	=>	$file_id
			);
			$video=M('video');
			$videorel=$video->add($mvp);
			if($videorel){
				echo json_encode($this->apiTemplate($data,'200','ok'));
			}else{
				echo json_encode($this->apiTemplate($data,'202','上传失败'));
			}
		}else{
			echo json_encode($this->apiTemplate($data,'203','请求类型错误'));
		}
	}
// +----------------------------------------------------------------------
// | 功能       | 创建房间
// +----------------------------------------------------------------------
// | 请求类型   | post
// +----------------------------------------------------------------------
// | 参数       | token,play_id
// +----------------------------------------------------------------------
	public function createroom(){
		$data=(object)null;
		if(IS_POST){
			$token=I('post.token');
			$livebid=I('post.play_id');
			if($token==''||$livebid==''){
				echo json_encode($this->apiTemplate($data,'204','参数错误'));
			}else{
				$user=M('user');
				$userrel=$user->where(array('token'=>$token))->find();
				if($userrel){
					$prove=M('prove');
					$proverel=$prove->where('uid='.$userrel['user_id'])->find();
					if(!$proverel){echo json_encode($this->apiTemplate($data,'202','您还没有实名认证'));exit;}
					$class=M('class');
					$classrel=$class->where('uid='.$userrel['user_id'])->find();
					$liveb=M('liveb');
					$livebrel=$liveb->where('liveb_id='.$livebid)->find();
					if($livebrel['class_id']!=$classrel['class_id']){echo json_encode($this->apiTemplate($data,'202','这不是你的直播，亲'));exit;}
					$date['token']=$token;
					$date['roomid']=$livebrel['liveb_id'];
					$date['title']=$livebrel['name'];
					$date['groupid']=$livebrel['liveb_id'];
					$date['img']=URL.$livebrel['img'];
					echo json_encode($this->apiTemplate($date,'200','ok'));
				}else{
					echo json_encode($this->apiTemplate($data,'202','token过期'));
				}
			}
		}else{
			echo json_encode($this->apiTemplate($data,'203','请求类型错误'));
		}
	}
// +----------------------------------------------------------------------
// | 功能       | 创建房间状态
// +----------------------------------------------------------------------
// | 请求类型   | post
// +----------------------------------------------------------------------
// | 参数       | token,roomid,status
// +----------------------------------------------------------------------
	public function croomstatus(){
		$data=(object)null;
		if(IS_POST){
			$roomid=I('post.roomid');
			$status=I('post.status');
			$token=I('post.token');
			if($roomid==''||$status==''||$token==''){echo json_encode($this->apiTemplate($data,'204','参数错误'));exit;}
			$user=M('user');
			$userrel=$user->where(array('token'=>$token))->find();
			if(!$userrel){echo json_encode($this->apiTemplate($data,'202','token过期'));exit;}
			$liveb=M('liveb');
			$livebrel=$liveb->where('liveb_id='.$roomid)->find();
			if(!$livebrel){echo json_encode($this->apiTemplate($data,'202','房间号错误'));exit;}
			if($status=='success'){
				$mvp['status']='1';
				$result=$liveb->where('liveb_id='.$livebrel['liveb_id'])->save($mvp);
				if($result===false){
					echo json_encode($this->apiTemplate($data,'202','err'));
				}else{
					echo json_encode($this->apiTemplate($data,'200','ok'));
				}
			}
		}else{
			echo json_encode($this->apiTemplate($data,'203','请求类型错误'));
		}
	}	
// +----------------------------------------------------------------------
// | 功能       | 退出直播间
// +----------------------------------------------------------------------
// | 请求类型   | post
// +----------------------------------------------------------------------
// | 参数       | token,roomid
// +----------------------------------------------------------------------
	public function outroom(){
		$data=(object)null;
		if(IS_POST){
			$token=I('token');
			$roomid=I('roomid');
			if($token==''||$roomid==''){echo json_encode($this->apiTemplate($data,'204','参数错误'));exit;}
			$user=M('user');
			$userrel=$user->where(array('token'=>$token))->find();
			if(!$userrel){echo json_encode($this->apiTemplate($data,'202','token过期'));exit;}
			$liveb=M('liveb');
			$mvp['status']='0';
			$result=$liveb->where('liveb_id='.$roomid)->save($mvp);
			echo json_encode($this->apiTemplate($data,'200','ok'));
		}else{
			echo json_encode($this->apiTemplate($data,'203','请求类型错误'));
		}
	}
// +----------------------------------------------------------------------
// | 功能       | 进入直播间
// +----------------------------------------------------------------------
// | 请求类型   | post
// +----------------------------------------------------------------------
// | 参数       | token,play_id
// +----------------------------------------------------------------------
	public function intoroom(){
		$data=(object)null;
		if(IS_POST){
			$token=I('post.token');
			$play_id=I('post.play_id');
			if($token==''||$play_id==''){echo json_encode($this->apiTemplate($data,'204','参数错误'));exit;}
			$user=M('user');
			$userrel=$user->where(array('token'=>$token))->find();
			if(!$userrel){echo json_encode($this->apiTemplate($data,'202','token过期'));exit;}
			$liveb=M('liveb');
			$livebrel=$liveb->where('liveb_id='.$play_id)->find();
			if($livebrel['status']=='0'){echo json_encode($this->apiTemplate($data,'202','还没有开播'));exit;}
			if($livebrel['uid'] != $userrel['user_id']){
				echo json_encode($this->apiTemplate($data,'202','你还没有报名'));
			}else{
				$class=M('class');
				$classrel=$class->where('class_id='.$livebrel['class_id'])->find();
				$t_token=$user->where('user_id='.$classrel['uid'])->find();
				$date['token']=$t_token['token'];
				$date['roomid']=$livebrel['liveb_id'];
				$date['title']=$livebrel['name'];
				$date['groupid']=$livebrel['liveb_id'];
				$date['img']=URL.$livebrel['img'];
				echo json_encode($this->apiTemplate($date,'200','ok'));
			}
		}else{
			echo json_encode($this->apiTemplate($data,'203','请求类型错误'));
		}
	}
// +----------------------------------------------------------------------
// | 功能       | 直播心跳接口
// +----------------------------------------------------------------------
// | 请求类型   | 
// +----------------------------------------------------------------------
// | 参数       | roomid
// +----------------------------------------------------------------------
	public function heartbeat(){
		$roomid=I('post.roomid');
		if($roomid==''){echo json_encode($this->apiTemplate($data=(object)null,'204','参数错误'));exit;}
		$time=90;
		$url='http://www.wyuek.com/Api/Template/hearbeat?roomid='.$roomid;
		sleep($time);
		file_get_contents($url);
	}
}
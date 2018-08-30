<?php
/******************************
 *
 * 时间；2017年11月10日
 * 功能：意见反馈
 * 作者：Mr Peng
 *
 *****************************/ 
namespace Api\Controller;
use Think\Controller;
header('Content-Type:text/json;charset=utf-8');
header("Access-Control-Allow-Origin: *");
class FeedbackController extends CommonController {

// +----------------------------------------------------------------------
// | 功能       | 意见反馈
// +----------------------------------------------------------------------
// | 请求类型   | POST
// +----------------------------------------------------------------------
// | 参数       | text、contact
// +----------------------------------------------------------------------    
	public function index(){
        
        if(IS_POST){
            $text=I('post.text');
            $contact=I('post.contact');
            if($text==''){
                $data=(object)null;
                echo json_encode($this->apiTemplate($data,'204','参数错误'));
            }else{
                $feedback=M('feedback');
                $mvp['text']=$text;
                $mvp['time']=time();
                $mvp['contact']=$contact;
                $rel=$feedback->add($mvp);
                if($rel){
                    $data=(object)null;
                    echo json_encode($this->apiTemplate($data,'200','ok'));
                }else{
                    $data=(object)null;
                    echo json_encode($this->apiTemplate($data,'202','反馈失败'));
                }
            }
        }else{
            $data=(object)null;
            echo json_encode($this->apiTemplate($data,'203','请求类型错误'));  
        }
	}

}
<?php
/*******************************
 *
 *	时间：2017年11月2日
 * 	功能：活动（公告）
 *  作者：Mr Peng
 *  
 *******************************/ 
namespace Api\Controller;
use Think\Controller;
header('Content-Type:text/json;charset=utf-8');
header("Access-Control-Allow-Origin: *");
class NoticeController extends CommonController {
	
// +----------------------------------------------------------------------
// | 功能 		| 活动公告
// +----------------------------------------------------------------------
// | 请求类型 	| GET
// +----------------------------------------------------------------------
// | 参数 		| page(页数)
// +----------------------------------------------------------------------

    public function index(){
    	if(IS_GET){
			$page=I('get.page');
			if($page==''){
				$data=(object)null;
				echo json_encode($this->apiTemplate($data,'204','参数错误'));exit;
			}
	        $config = array(
	            'tablename' => 'notice', 	// 表名
	            'where'     => '', 			// 查询条件
	            'relation'  => '',          // 关联条件
	            'order'     => 'time desc', // 排序
	            'page'      => $page,       // 页码，默认为首页
	            'num'       => 2         	// 每页条数
	        );
	        $ppp = new \Org\Util\Page($config);
	        $data = $ppp->get();
	        $pie['now_page']=$data['now_page'];
	        $pie['total_page']=$data['total_page'];
	        unset($data['now_page']);
	        unset($data['total_page']);
	        foreach ($data as $k => $v){
	        	$data[$k]['img']=URL.$v['img'];
	        	$data[$k]['time']=date('Y年m月d日 H:i:s',$v['time']);
	        }
	        $date['notice']=$data;
	        $date['now_page']=$pie['now_page'];
	        $date['total_page']=$pie['total_page'];
	        echo json_encode($this->apiTemplate($date,'200','ok'));  
    	}else{
    		$data=(object)null;
    		echo json_encode($this->apiTemplate($data,'203','请求类型错误'));
    	}
      	    
    }
   	
}





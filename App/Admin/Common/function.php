<?php
	//上传图片接口
	function upLoadImage($fileNameP,$width,$height) {
	    if (! empty($_FILES)) {
	        $upload = new \Think\Upload(); // 实例化上传类
	        $upload->maxSize = 31457280; // 设置附件上传大小
	        // $upload->saveExt = 'jpeg'; // 设置附件上传大小
	        $upload->exts = array(
	            'jpg',
	            'gif',
	            'png',
	            'jpeg',
	            'JPG',
	            'GIF',
	            'PNG',
	            'JPEG'
	        );
	        // 设置附件上传类型
	        $upload->rootPath = './Public/'; // 设置附件上传根目录
	        $upload->savePath = $fileNameP; // 设置附件上传（子）目录
	
	        // 上传文件
	        $info = $upload->upload();
	        if (! $info) {
	            // 上传错误提示错误信息
	            return $upload->getError();
	            $this->error($upload->getError());
	        } else {
	
	            foreach ($info as $value) {
	                // 上传成功
	                $image = new \Think\Image();
	                $image->open($upload->rootPath.$value['savepath'] .$value['savename']);
	                // 按照原图的比例生成一个最大为150*150的缩略图并保存为thumb.jpg
	                $image->thumb($width, $height)->save( $upload->rootPath.$value['savepath'] . 'thumb_' . $value['savename']);
	
	                $ImageRet=C('IMG_URL').'/Public/'. $value['savepath'].$value['savename'];
	            }
	            return $ImageRet;
	           // $this->ajaxReturn(interfaceReturn(0,$data['UserImage'],''));
	        }
	    } else {
	        	//$this->ajaxReturn(interfaceReturn(1,'没有上传的文件',''));
	            return null;
	           // $this->error('没有上传文件');
	    }
	}
	// 
	//  function.php
	//  后台操作日志方法（包括登录）(不包括登录次数)
	//	$type	类型
	//	$toId	被操作ID
	//	$data	被操作信息（JSON字符串串）
	//	$res	结果
	//	$note	备注
	//  Created by guyuhang on 2017-10-31
	// 
	function adminLog($type,$toId,$data,$res,$note){
		$data["time"]=date('Y-m-d H:i:s');
		$data["type"]=$type;
		$data["toID"]=$toId;
		$data["data"]=$data;
		$data["res"]=$res;
		$data["note"]=$note;
		$data["ip"]=getIp();
		$data["uid"]=session('user.id');
		$data["controllerName"]=CONTROLLER_NAME;
		$data["actionName"]=ACTION_NAME;
		$data["controllerActionName"]=CONTROLLER_NAME.ACTION_NAME;
		M("adminlog")->data($data)->add();
	}
	// 
	//  function.php
	//  返回数据通道
	//	$Code		状态码（0成功）
	//	$Msg		消息
	//	$Response	数据包
	//  Created by guyuhang on 2017-10-31.
	// 
	function interfaceReturn($Code,$Msg,$Response){
	    //组织返回数据
	    $result['Code']=$Code;
	    $result['Msg']=$Msg;
	    $result['Response']=$Response;
	    return $result;
	}
	
	
	
	/** 
	* 发起一个post请求到指定接口
	* @param string $api 请求的接口 
	* @param array $params post参数 
	* @param int $timeout 超时时间 
	* @return string 请求结果 
	*/ 
	function postRequest($api, array $params = array(), $timeout = 30 ) {
		$ch = curl_init(); 
		// 以返回的形式接收信息 
		curl_setopt( $ch, CURLOPT_URL, $api );
		// 设置为POST方式 
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt( $ch, CURLOPT_POST, 1 ); 
		// 不验证https证书
		curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $params ) );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0 ); 
		curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0 ); 
		curl_setopt( $ch, CURLOPT_TIMEOUT, $timeout ); 
		// 发送数据
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array( 'Content-Type: application/x-www-form-urlencoded;charset=UTF-8', 'Accept: application/json', ) );  
		// 不要忘记释放资源 
		$response = curl_exec( $ch ); 
		curl_close( $ch ); return $response; 
	}
	
	
	//获取登录页面的url
	function loginPageURL() {
		$pageURL = 'http';
		if (!empty($_SERVER['HTTPS'])) {$pageURL .= "";
		}
		$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . '/admin.php?m=Admin&c=login';
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"] . '/admin.php?m=Admin&c=login';
		}
		return $pageURL;
		
	}
	
	//获取用户真实IP
	function getIp() {
		if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
			$ip = getenv("HTTP_CLIENT_IP");
		else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
			$ip = getenv("HTTP_X_FORWARDED_FOR");
		else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
			$ip = getenv("REMOTE_ADDR");
		else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
			$ip = $_SERVER['REMOTE_ADDR'];
		else
			$ip = "unknown";
		return ($ip);
	}

	//页面提示跳转
	function message($msgTitle, $message, $jumpUrl) {
		$str = '<!DOCTYPE HTML>';
		$str .= '<html>';
		$str .= '<head>';
		$str .= '<meta charset="utf-8">';
		$str .= '<title>页面提示</title>';
		$str .= '<style type="text/css">';
		$str .= '*{margin:0; padding:0}a{color:#369; text-decoration:none;}a:hover{text-decoration:underline}body{height:100%; font:12px/18px Tahoma, Arial,  sans-serif; color:#424242; background:#fff}.message{width:450px; height:120px; margin:16% auto; border:1px solid #99b1c4; background:#ecf7fb}.message h3{height:28px; line-height:28px; background:#2c91c6; text-align:center; color:#fff; font-size:14px}.msg_txt{padding:10px; margin-top:8px}.msg_txt h4{line-height:26px; font-size:14px}.msg_txt h4.red{color:#f30}.msg_txt p{line-height:22px}';
		$str .= '</style>';
		$str .= '</head>';
		$str .= '<body>';
		$str .= '<div class="message">';
		$str .= '<h3>' . $msgTitle . '</h3>';
		$str .= '<div class="msg_txt">';
		$str .= '<h4 class="red">' . $message . '</h4>';
		$str .= '<p>系统将在 <span style="color:blue;font-weight:bold">3</span> 秒后自动跳转,如果不想等待,直接点击 <a href="' . $jumpUrl . '">这里</a> 跳转</p>';
		$str .= "<script>setTimeout('location.replace(\'" . $jumpUrl . "\')',2000)</script>";
		$str .= '</div>';
		$str .= '</div>';
		$str .= '</body>';
		$str .= '</html>';
		echo $str;
	}

	//截取字符串前几位
	function subStringQ($str,$len=6){
		substr($str,0,$len);
	}
	//截取字符串后几位
	function subStringH($str,$len=6){
		substr($str,strlen($str)-$len,strlen($str));
	}
	
	//获取当前页面的url
	function curPageURL() {
		$pageURL = 'http';
		if (!empty($_SERVER['HTTPS'])) {$pageURL .= "";
		}
		$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
		}
		cookie('url.now', $pageURL, 3600);
		return $pageURL;
	}

	//转换性别（数据库格式 到 字符串）
	function convertSex($sex) {
		$retStr = "";
		//定义返回字符串
		switch ($sex) {
			case 0 :
				$retStr = "女";
				break;
			case 1 :
				$retStr = "男";
				break;
			case -1 :
				$retStr = "保密";
				break;
		}
		return $retStr;
	}

	//转换角色（数据库格式 到 字符串）
	function convertRole($RoleID) {
		$retStr = "";
		$role = M('sys_admin_role');
		$result = $role -> where('RoleID=' . $RoleID) -> find();
		$retStr = $result['RoleName'];
		return $retStr;
	}

	/**
	 *日志记录，按照"Ymd.log"生成当天日志文件
	 * 日志路径为：入口文件所在目录/logs/$type/当天日期.log.php，例如 /logs/error/20120105.log.php
	 * @param string $type 日志类型，对应logs目录下的子文件夹名
	 * @param string $content 日志内容
	 * @return bool true/false 写入成功则返回true
	 */
	function writelog($type="",$content=""){
	    if(!$content || !$type){
	        return FALSE;
	    }    
	    $dir=getcwd().DIRECTORY_SEPARATOR.'logs'.DIRECTORY_SEPARATOR.$type;
	    if(!is_dir($dir)){ 
	        if(!mkdir($dir)){
	            return false;
	        }
	    }
	    $filename=$dir.DIRECTORY_SEPARATOR.date("Ymd",time()).'.log.php';   
	    $logs=include $filename;
	    if($logs && !is_array($logs)){
	        unlink($filename);
	        return false;
	    }
	    $logs[]=array("time"=>date("Y-m-d H:i:s"),"content"=>$content);
	    $str="<?php \r\n return ".var_export($logs, true).";";
	    if(!$fp=@fopen($filename,"wb")){
	        return false;
	    }           
	    if(!fwrite($fp, $str))return false;
	    fclose($fp);
	    return true;
	}
    //分页
    function Pager($count,$page_num='10'){
        $Page       = new \Think\Page($count,$page_num);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $Page->lastSuffix=false;
        $Page->setConfig('header','<li class="rows">共<b>%TOTAL_ROW%</b>条记录&nbsp;&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('last','末页');
        $Page->setConfig('first','首页');
        $Page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        $show       = $Page->show();// 分页显示输出
        $limit=$Page->firstRow.','.$Page->listRows;
        $data=[
            'show'=>$show,
            'limit'=>$limit
        ];
        return $data;
        //服务器分页end
}


	
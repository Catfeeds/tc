<?php 

/******************************
 *
 * 时间；2017年12月26日
 * 功能：短信验证码接口
 * 作者：Mr Peng
 *
 *****************************/ 

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

function interfaceReturn($Code,$Msg,$Response){
	    //组织返回数据
	    $result['Code']=$Code;
	    $result['Msg']=$Msg;
	    $result['Response']=$Response;
	    return $result;
}



 ?>
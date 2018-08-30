<?php
return array(
	//'配置项'=>'配置值'
	/*数据库配置*/
	'DB_TYPE'   => 'XXXX', 		// 数据库类型
	'DB_HOST'   => 'XXX', 	// 服务器地址
	'DB_NAME'   => 'XXXX', 			// 数据库名
	'DB_USER'   => 'XXXX', 			// 用户名
	'DB_PWD'    => 'XXXX', 	// 密码
	'DB_PORT'   => 3306, 			// 端口
	'DB_CHARSET'=> 'utf8', 			// 字符集
	'SHOW_PAGE_TRACE' =>false,
	/*'TMPL_EXCEPTION_FILE'   =>  './404.html',// 异常页面的模板文件
	'ERROR_PAGE'            =>  './404.html', // 错误定向页面*/
	
	//支付宝配置参数  
	'alipay_config'=>array(  
		'partner' =>'2088821791693343',   	//这里是你在成功申请支付宝接口后获取到的PID；  
		'key'=>'kg454zlie4wrnldzc00m8uesbz9htodo',		//这里是你在成功申请支付宝接口后获取到的Key  
		'sign_type'=>strtoupper('MD5'),  
		'input_charset'=> strtolower('utf-8'),  
		'cacert'=> getcwd().'\\cacert.pem',  
		'transport'=> 'http',  
	),  
		//以上配置项，是从接口包中alipay.config.php 文件中复制过来，进行配置；  

	'alipay'   =>array(  
		//这里是卖家的支付宝账号，也就是你申请接口时注册的支付宝账号  
		'seller_email'=>'tccm024@163.com',  
		//这里是异步通知页面url
		'notify_url'=>'http://p.wyuek.com/index.php/Api/Alipaypc/notifyurl',
		//这里是页面跳转通知url  
		'return_url'=>'http://p.wyuek.com/index.php/Api/Alipaypc/returnurl',
		//支付成功跳转到的页面
		'successpage'=>'Me/account',     
		//支付失败跳转到的页面
		'errorpage'=>'Me/chongzhi',   
	),

	'DATA_CACHE_TYPE'=>'redis',
	'REDIS_AUTH'=>'tiancheng123456',//AUTH认证密码


);
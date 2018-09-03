<?php
return array(
	//'配置项'=>'配置值'
	'INDEX_URL'=>'http://192.168.1.254:89/admin.php', // 首页地址
	'LOGIN_URL'=>'http://192.168.1.254:89/admin.php/Login', // 登录页页地址
	'IMG_URL'=>'http://192.168.1.254:89', // 审核用到的图片地址
	'SHOP_IMG_URL'=>'http://192.168.1.254:89/Public/Admin/lib/webuploader/0.1.5/server/upload/', // 商品图片地址
    'URL_HTML_SUFFIX'       =>  '',  // URL伪静态后缀设置
    'SHOW_PAGE_TRACE' =>false,
    'ALLOW_AUTH'=>[
        'Index/index',
        'Index/welcome',
        'Index/login_Out',
        'News/update_news',
        'News/add_news_action',
        'Cate/edit',
        'Cate/cate',
        'ClassCate/get_cate2',
        'Shop/dataAdd_Sub',
        'Shop/dataEdit_Sub',
        'Reportmanage/completeprocess',
        'Notice/dataEdit_Sub',
        'Notice/dataEditXiaoxi_Sub',
        'Notice/dataEditHuodong_Sub',
        'Notice/dataEditYaotu_Sub',
        'Admin/add_sub',
        'Role/role_action',
        'Payrecord/pass'
    ]
);
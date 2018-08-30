<?php

namespace  Api\Controller;
use Think\Controller;
header('Content-Type:text/json;charset=utf-8');
header("Access-Control-Allow-Origin: *");
class ActivityController extends CommonController {
    //活动
    public function index(){
        $data['pushURL']='http://www.wyueke.com/html/Me/activity.html';
        $this->templateApi($data,'200','ok');
    }

}
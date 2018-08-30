<?php
namespace Home\Controller;
use Think\Controller;
//header('Content-Type:text/html;charset=utf-8');
header("Access-Control-Allow-Origin: http://www.wyuek.com");
class DownloadController extends Controller {
    public function index(){
        $apk=M('apk');
        $apkrel=$apk->order('time desc')->find();
        echo "<script>window.location.href='".$apkrel['download']."'</script>";
    }
}

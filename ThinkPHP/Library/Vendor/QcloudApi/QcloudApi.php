<?php
// 目录入口
define('QCLOUDAPI_ROOT_PATH', dirname(__FILE__));
/**
 * QcloudApi
 * SDK入口文件
 */
class QcloudApi
{
    /**
     * MODULE_ACCOUNT
     * 用户账户
     */
    const MODULE_ACCOUNT   = 'account';
    
    /**
     * MODULE_CVM
     * 云服务器
     */
    const MODULE_CVM   = 'cvm';

    /**
     * MODULE_CDB
     * CDB数据库
     */
    const MODULE_CDB   = 'cdb';

    /**
     * MODULE_LB
     * 负载均衡
     */
    const MODULE_LB    = 'lb';

    /**
     * MODULE_TRADE
     * 产品售卖
     */
    const MODULE_TRADE = 'trade';
    
    /**
     * MODULE_BILL
     * 账单
     */
    const MODULE_BILL = 'bill';

    /**
     * MODULE_SEC
     * 云安全
     */
    const MODULE_SEC = 'sec';

    /**
     * MODULE_IMAGE
     * 镜像
     */
    const MODULE_IMAGE = 'image';

    /**
     * MODULE_MONITOR
     * 云监控
     */
    const MODULE_MONITOR = 'monitor';

    /**
     * MODULE_CDN
     * CDN
     */
    const MODULE_CDN = 'cdn';

    /**
     * MODULE_VPC
     * VPC
     */
    const MODULE_VPC = 'vpc';

    /**
     * MODULE_VOD
     * VOD
     */
    const MODULE_VOD = 'vod';
    
    /**
     * YUNSOU
     */
    const MODULE_YUNSOU = 'yunsou';
	
	  /**
     * cns
     */
    const MODULE_CNS = 'cns';
	
	  /**
     * wenzhi
     */
    const MODULE_WENZHI = 'wenzhi';
    
    /**
     * MARKET
     */
    const MODULE_MARKET = 'market';
    
    /**
     * MODULE_EIP
     * 弹性公网Ip
     */
    const MODULE_EIP = 'eip';
    
    /**
     * MODULE_LIVE
     * 直播
     */
    const MODULE_LIVE = 'live';

    /**
     * MODULE_SNAPSHOT
     * 快照
     */
    const MODULE_SNAPSHOT = 'snapshot';

    /**
     * MODULE_CBS
     * 云硬盘
     */
    const MODULE_CBS = 'cbs';
    
    /**
     * MODULE_SCALING
     * 弹性伸缩
     */
    const MODULE_SCALING = 'scaling';
    
    /**
     * MODULE_CMEM
     * 云缓存
     */
    const MODULE_CMEM = 'cmem';
    
    /**
     * MODULE_TDSQL
     * 云数据库TDSQL
     */
    const MODULE_TDSQL = 'tdsql';
    
        /**
     * MODULE_BM
     * 黑石BM
     */
    const MODULE_BM = 'bm';

    /**
     * load
     * 加载模块文件
     * @param  string $moduleName   模块名称
     * @param  array  $moduleConfig 模块配置
     * @return
     */
    public static function load($moduleName, $moduleConfig = array())
    {
        $moduleName = ucfirst($moduleName);
        $moduleClassFile = QCLOUDAPI_ROOT_PATH . '/Module/' . $moduleName . '.php';

        if (!file_exists($moduleClassFile)) {
            return false;
        }

        require_once $moduleClassFile;
        $moduleClassName = 'QcloudApi_Module_' . $moduleName;
        $moduleInstance = new $moduleClassName();

        if (!empty($moduleConfig)) {
            $moduleInstance->setConfig($moduleConfig);
        }

        return $moduleInstance;
    }

    public static function tencentAPI($modelName){

        $config = array('SecretId'       => '008dd2390303f4ebe4da1d01ad7760b1',
                        'SecretKey'      => '5a1e9486a20caf9691d421e2772aa57a',
                        'RequestMethod'  => 'GET',
                        'DefaultRegion'  => 'gz');

        $cvm = QcloudApi::load($modelName, $config);
        
        $package = array('offset' => 0, 'limit' => 3, 'SignatureMethod' =>'HmacSHA256');
        
        $a = $cvm->DescribeInstances($package);
        // $a = $cvm->generateUrl('DescribeInstances', $package);
        
        if ($a === false) {
            $error = $cvm->getError();
            echo "Error code:" . $error->getCode() . ".\n";
            echo "message:" . $error->getMessage() . ".\n";
            echo "ext:" . var_export($error->getExt(), true) . ".\n";
        } else {
            var_dump($a);
        }
        
        echo "\nRequest :" . $cvm->getLastRequest();
        echo  $cvm->getLastResponse();
        echo "\n";
    }


    /**
  * 获取推流地址
  * 如果不传key和过期时间，将返回不含防盗链的url
  * @param bizId 您在腾讯云分配到的bizid
  *        streamId 您用来区别不同推流地址的唯一id
  *        key 安全密钥
  *        time 过期时间 sample 2016-11-12 12:00:00
  * @return String url */
    function getPushUrl($bizId, $streamId, $key = null, $time = null){
    
        if($key && $time){
            $txTime = strtoupper(base_convert(strtotime($time),10,16));
            //txSecret = MD5( KEY + livecode + txTime )
            //livecode = bizid+"_"+stream_id  如 8888_test123456
            $livecode = $bizId."_".$streamId; //直播码
             $txSecret = md5($key.$livecode.$txTime);
            $ext_str = "?".http_build_query(array(
                "bizid"=> $bizId,
                "txSecret"=> $txSecret,
                "txTime"=> $txTime
            ));
        }
        return "rtmp://".$bizId.".livepush.myqcloud.com/live/".$livecode.(isset($ext_str) ? $ext_str : "");
    }
            
    //echo getPushUrl("8888","123456","69e0daf7234b01f257a7adb9f807ae9f","2016-09-11 20:08:07");
    //echo "<br />";
    /**
  * 获取播放地址
  * @param bizId 您在腾讯云分配到的bizid
  *        streamId 您用来区别不同推流地址的唯一id
  * @return String url */
    function getPlayUrl($bizId, $streamId){
        $livecode = $bizId."_".$streamId; //直播码
        return array(
                        "rtmp://".$bizId.".liveplay.myqcloud.com/live/".$livecode,
                        "http://".$bizId.".liveplay.myqcloud.com/live/".$livecode.".flv",
                        "http://".$bizId.".liveplay.myqcloud.com/live/".$livecode.".m3u8"
                    );
    }
            
            
    //print_r(getPlayUrl("8888","123456"));



}

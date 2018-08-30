<?php
require_once(dirname(__FILE__) . '/' . 'notification/android/AndroidBroadcast.php');
require_once(dirname(__FILE__) . '/' . 'notification/android/AndroidFilecast.php');
require_once(dirname(__FILE__) . '/' . 'notification/android/AndroidGroupcast.php');
require_once(dirname(__FILE__) . '/' . 'notification/android/AndroidUnicast.php');
require_once(dirname(__FILE__) . '/' . 'notification/android/AndroidCustomizedcast.php');
require_once(dirname(__FILE__) . '/' . 'notification/ios/IOSBroadcast.php');
require_once(dirname(__FILE__) . '/' . 'notification/ios/IOSFilecast.php');
require_once(dirname(__FILE__) . '/' . 'notification/ios/IOSGroupcast.php');
require_once(dirname(__FILE__) . '/' . 'notification/ios/IOSUnicast.php');
require_once(dirname(__FILE__) . '/' . 'notification/ios/IOSCustomizedcast.php');

class Demo {
	

	 protected $appkey           = NULL;   
    protected $appMasterSecret     = NULL;  
    protected $timestamp        = NULL;  
    protected $validation_token = NULL;  
  
    function __construct($key, $secret) {  
        $this->appkey = $key;  
        $this->appMasterSecret = $secret;  
        $this->timestamp = strval(time());  
    }  
  
    /** 
     * Android推送—广播 
     * @param $title string 推送消息标题 
     * @param $content string 推送消息内容 
     * @return mixed 
     */  
    function sendAndroidBroadcast($title,$content) {  
        try {  
            $brocast = new AndroidBroadcast();  
            $brocast->setAppMasterSecret($this->appMasterSecret);  
            $brocast->setPredefinedKeyValue("appkey",           $this->appkey);  
            $brocast->setPredefinedKeyValue("timestamp",        $this->timestamp);  
            $brocast->setPredefinedKeyValue("ticker",           "Android broadcast ticker");  
            $brocast->setPredefinedKeyValue("title",            $title);  
            $brocast->setPredefinedKeyValue("text",             $content);  
            $brocast->setPredefinedKeyValue("after_open",       "go_app");  
            $brocast->setPredefinedKeyValue("production_mode", "true");  
            $brocast->setExtraField("test", "helloworld");  
            print("Sending broadcast notification, please wait...\r\n");  
            return $brocast->send();  
            print("Sent SUCCESS\r\n");  
        } catch (Exception $e) {  
            print("Caught exception: " . $e->getMessage());  
        }  
    }  

	
    /** 
     * Android推送—单播 
     * @param $title string 推送消息标题 
     * @param $content string 推送消息内容 
     * @param $tokens array 设备的token值 
     * @return mixed 
     */  
    function sendAndroidUnicast($title,$content,$tokens) {  
        try {  
            $unicast = new AndroidUnicast();  
            $unicast->setAppMasterSecret($this->appMasterSecret);  
            $unicast->setPredefinedKeyValue("appkey",           $this->appkey);  
            $unicast->setPredefinedKeyValue("timestamp",        $this->timestamp);  
            $unicast->setPredefinedKeyValue("device_tokens",    $tokens);  
            $unicast->setPredefinedKeyValue("ticker",           "Android unicast ticker");  
            $unicast->setPredefinedKeyValue("title",            $title);  
            $unicast->setPredefinedKeyValue("text",             $content);  
            $unicast->setPredefinedKeyValue("after_open",       "go_app");  
            $unicast->setPredefinedKeyValue("production_mode", "true");  
            $unicast->setExtraField("test", "helloworld");  
            print("Sending unicast notification, please wait...\r\n");  
            return $unicast->send();  
            print("Sent SUCCESS\r\n");  
        } catch (Exception $e) {  
            print("Caught exception: " . $e->getMessage());  
        }  
    }
    /** 
     * IOS推送—广播 
     * @param $title string 推送消息标题 
     * @param $content string 推送消息内容 
     * @return mixed 
     */  
    function sendIOSBroadcast($title,$content) {  
        try {  
            $brocast = new IOSBroadcast();  
            $brocast->setAppMasterSecret($this->appMasterSecret);  
            $brocast->setPredefinedKeyValue("appkey",           $this->appkey);  
            $brocast->setPredefinedKeyValue("timestamp",        $this->timestamp);  
            $brocast->setPredefinedKeyValue("alert", $title);  
            $brocast->setPredefinedKeyValue("badge", 0);  
            $brocast->setPredefinedKeyValue("sound", "chime");  
            $brocast->setPredefinedKeyValue("production_mode", "false");  
            $brocast->setCustomizedField("test", $content);  
            print("Sending broadcast notification, please wait...\r\n");  
            return $brocast->send();  
            print("Sent SUCCESS\r\n");  
        } catch (Exception $e) {  
            print("Caught exception: " . $e->getMessage());  
        }  
    }  
  
    /** 
     * IOS推送—单播 
     * @param $title string 推送消息标题 
     * @param $content string 推送消息内容 
     * @param $tokens array 设备的token值 
     * @return mixed 
     */  
    function sendIOSUnicast($title,$content,$tokens) {  
        try {  
            $unicast = new IOSUnicast();  
            $unicast->setAppMasterSecret($this->appMasterSecret);  
            $unicast->setPredefinedKeyValue("appkey",           $this->appkey);  
            $unicast->setPredefinedKeyValue("timestamp",        $this->timestamp);  
            $unicast->setPredefinedKeyValue("device_tokens",    $tokens);  
            $unicast->setPredefinedKeyValue("alert", $title);  
            $unicast->setPredefinedKeyValue("badge", 0);  
            $unicast->setPredefinedKeyValue("sound", "chime");  
            $unicast->setPredefinedKeyValue("production_mode", "false");  
            $unicast->setCustomizedField("test", $content);  
            print("Sending unicast notification, please wait...\r\n");  
            return $unicast->send();  
            print("Sent SUCCESS\r\n");  
        } catch (Exception $e) {  
            print("Caught exception: " . $e->getMessage());  
        }  
    }
}

/*// Set your appkey and master secret here
$demo = new Demo("5afa46ef8f4a9d19f600008c", "kdockprelcj3qlth6vgthymejczsr2uu");
//$demo->sendAndroidBroadcast('这是标题','这是标题');
$demo->sendAndroidUnicast('这是标题','这是标题');
$demo = new Demo("5afa49fdb27b0a365600013b", "qp22lyrj6twuswsxiuhejnerogyfsevn");
$demo->sendIOSBroadcast('这是标题','这是标题');
$demo->sendIOSUnicast('这是标题','这是标题','0b0c211af54fc06e7f2eeec0d4d59daac2f5f786242fd59a41961af2232a1250');*/
/* these methods are all available, just fill in some fields and do the test
 * $demo->sendAndroidBroadcast();
 * $demo->sendAndroidFilecast();
 * $demo->sendAndroidGroupcast();
 * $demo->sendAndroidCustomizedcast();
 * $demo->sendAndroidCustomizedcastFileId();
 *
 * $demo->sendIOSBroadcast();
 * 
 * $demo->sendIOSFilecast();
 * $demo->sendIOSGroupcast();
 * $demo->sendIOSCustomizedcast();
 */
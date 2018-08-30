<?php
/**
 * Created by PhpStorm.
 * User: GMY
 * Date: 2018\8\14 0014
 * Time: 9:14
 */

namespace Admin\Controller;
use Think\Controller;


class NewsController extends BaseController{
    public function news_list(){
        if(I("serchWord")!=null&&I("serchWord")!=""){
            $sql=" title like '%".I("serchWord")."%' ";
        }else{
            $sql=" 0=0 ";
        }
        //服务器分页begin  前端的分页放弃
        $M = M('news_article'); // 实例化User对象
        $count      = $M->count();// 查询满足要求的总记录数
        $data=pager($count);
        /*$Page       = new \Think\Page($count,8);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $Page->lastSuffix=false;
        $Page->setConfig('header','<li class="rows">共<b>%TOTAL_ROW%</b>条记录&nbsp;&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('last','末页');
        $Page->setConfig('first','首页');
        $Page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        $show       = $Page->show();// 分页显示输出*/
        //服务器分页end
        //腾讯云 链接 闲的时候都放到配置里 -_-!
        $img="http://wyk-img-1255995999.cos.ap-beijing.myqcloud.com";
        //查询资讯信息和分类 创建时间降序
        $res=M('news_article')
            ->alias('na')
            ->join('news_cat as nc on na.cat_id=nc.cat_id')
            ->field('na.news_id,na.title,na.create_time,na.cat_id,na.scan_num,na.description,na.is_comment,na.image,na.status,na.author,nc.cat_name')
            ->where($sql)
            ->limit($data['limit'])
            ->order('na.create_time DESC')
            ->select();
        //格式化时间戳 拼接图片地址
        foreach ($res as $k=>$v){
            $res[$k]['create_time']=date('Y-m-d H:i:s',$res[$k]['create_time']);
            $res[$k]['image']=$img.$res[$k]['image'];
        }
        $this->assign('news_info',$res);
        // 赋值分页输出
        $this->assign('page',$data['show']);
        $this->display();
    }
    public function add_news(){
        //cat 分过去
        //目录页分过去
        $cat=M('news_cat')->select();
        $this->assign('cat_info',$cat);
        $this->display();
    }
    public function add_news_action(){
        if (IS_POST){
            //腾讯云 空间 记得闲的时候封装一下-_-!
            vendor('cos.cos-autoloader');
            $cosClient = new \Qcloud\Cos\Client(array('region' => 'bj',
                'credentials'=> array(
                    'appId' => '1255995999',
                    'secretId'    => 'AKIDbKwODypWj2RxKVxtxJl4KfvGgPatP7Nn',
                    'secretKey' => 'l2TFq6FC3movvqjbQbfhmnqqju0iHUcZ')));
            $bucket = 'wyk-img-1255995999';
            //云路径
            $key = 'newsarticle/'."php".$_FILES['slimg']['name'];
            $local_path = $_FILES['slimg']['tmp_name'];
            try {
                $result = $cosClient->putObject(array(
                    'Bucket' => $bucket,
                    'Key' => $key,
                    'Body' => fopen($local_path, 'rb')));
            } catch (\Exception $e) {
                echo "$e\n";
            }
            $data['title']=I('post.news_title');
            $data['image']='/newsarticle/'."php".$_FILES['slimg']['name'];
            $data['cat_id']=I('post.news_cate');
            $data['author']=I('post.author');
            $data['description']=I('post.news_summary');
            /*$data['content']=I('post.editorValue');*/
            $data['content']=$_POST['editorValue'];
            $data['status']=I('post.news_status');
            $data['is_comment']=I('post.news_allow_comment');
            $data['create_time']=time();
            $data['update_time']=time();
            $dataRetID=M('news_article') -> data($data)->add();
            adminLog("添加资讯",$dataRetID,"","成功","");
            if( $dataRetID){
                echo "<script>alert('添加成功');location.href='".__MODULE__."/News/news_list';</script>";
            }
        }

    }
    public function upload_news_index(){
        $id=$_GET['id'];
        //腾讯云 链接 闲的时候都放到配置里 -_-!
        $img="http://wyk-img-1255995999.cos.ap-beijing.myqcloud.com";
        //查询资讯信息和分类 创建时间降序
        $res=M('news_article')
            ->field('news_id,title,create_time,cat_id,scan_num,description,is_comment,image,status,author,content')
            ->where(['news_id'=>$id])
            ->find();
        //目录页分过去
        $cat=M('news_cat')->select();
        $this->assign('v',$res);
        $this->assign('imgurl',$img);
        $this->assign('cat',$cat);
        $this->display();
    }
    public function update_news(){
        // 局部更新 发布和能否评论
        if(IS_AJAX){
            //修改评论和发布状态
            $filed=I('post.con');
            $data=[
                'news_id'=>I('get.id'),
                $filed=>I('post.change_status')
            ];
            $res=M('news_article')->data($data)->save();
            if ($res){
                $this->ajaxReturn(1,'JSON');
            }
        }
        // 全部更新
        if(IS_POST){
            //判断缩略图是否修改 修改则从新上传云
            if (!$_FILES['slimg']['error']==4){
                vendor('cos.cos-autoloader');
                $cosClient = new \Qcloud\Cos\Client(array('region' => 'bj',
                    'credentials'=> array(
                        'appId' => '1255995999',
                        'secretId'    => 'AKIDbKwODypWj2RxKVxtxJl4KfvGgPatP7Nn',
                        'secretKey' => 'l2TFq6FC3movvqjbQbfhmnqqju0iHUcZ')));
                $bucket = 'wyk-img-1255995999';
                //云路径
                $key = 'newsarticle/'."php".$_FILES['slimg']['name'];
                $local_path = $_FILES['slimg']['tmp_name'];
                try {
                    $result = $cosClient->putObject(array(
                        'Bucket' => $bucket,
                        'Key' => $key,
                        'Body' => fopen($local_path, 'rb')));
                } catch (\Exception $e) {
                    echo "$e\n";
                }
                $data['image']= '/newsarticle/'."php".$_FILES['slimg']['name'];

            }
            $data['news_id']=I('post.news_id');
            $data['title']=I('post.news_title');
            $data['cat_id']=I('post.news_cate');
            $data['description']=I('post.news_summary');
            /*$data['content']=I('post.editorValue');*/
            $data['content']=$_POST['editorValue'];
            $data['status']=I('post.news_status');
            $data['is_comment']=I('post.news_allow_comment');
            $data['author']=I('post.author');
            $data['update_time']=time();
            $res=M('news_article')->data($data)->save();
            if ($res){
                echo "<script>alert('修改成功');parent.location.href='".__MODULE__."/News/news_list';</script>";
            }
        }
    }
    public function news_del(){
        if(IS_AJAX){
            $id=I('post.id');
            $res=M('news_article')->delete($id);
            if($res){
                $this->ajaxReturn(1,'JSON');
            }
        }
    }
    public function show_news(){
        $id=$_GET['id'];
        $content=M('news_article')->where(['news_id'=>$id])->field('content')->find();
        $this->assign('content',$content);
        $this->display();
    }
}
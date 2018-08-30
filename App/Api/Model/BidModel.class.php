<?php
namespace Api\Model;
use Think\Model;

class BidModel extends Model {
    //投标记录
    //type   0：全部   1：已中
    public function bidlist($classid,$type,$page){
        $bid=M('bid');
        $where['class_id']=$classid;
        if($type==1){
            $where['bit_status']=1;
        }else{

        }
        $count=$bid->where($where)->count();
        $config = array(
            'tablename' => 'bid', // 表名
            'where'     => $where, // 查询条件
            'relation'  => '',          // 关联条件
            'order'     => $order,          // 排序
            'page'      => $page,       // 页码，默认为首页
            'num'       => '20',        // 每页条数
            'field'     => ''
        );
        $ppp = new \Org\Util\Page($config);
        $data = $ppp->get();
        $data['count']=$count;
        return $data;

    }
}
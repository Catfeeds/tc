<?php
namespace Api\Model;
use Think\Model;

class CategoryModel extends Model {

    //根据三级分类id获取二级分类和一级分类
    public function getFatherCate($id){
        $ca=M('category');
        $cate=$ca->where(array('cate_id'=>$id))->find();
        $cate1=$ca->where(array('cate_id'=>$cate['pid']))->find();
        $cate2=$ca->where(array('cate_id'=>$cate1['pid']))->find();
        $date=(string)$cate2['name'].'|'.$cate1['name'].'|'.$cate['name'];
        return $date;
    }
}
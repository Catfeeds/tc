<?php
namespace Api\Model;
use Think\Model;

class ClassModel extends Model {
    //获取机构下的三名老师姓名
    public function teachername($classid){
        $class=M('class');
        $teacher=$class->where(array('o_id'=>$classid))->field('teachername')->limit(3)->select();
        $teachername='';
        if($teacher){
            foreach($teacher as $kk=>$vv){
                $teachername.=','.$vv['teachername'];
            }
            $teachername=substr($teachername,1);
        }
        return $teachername;
    }

    //获取机构下的销量最高的两门课
    public function maxsaleclass($classid){
        $tgood=M('goods')->where(array('class_id'=>$classid))->field('name')->limit(2)->order('number desc')->select();
        $classname='';
        if($tgood){
            foreach($tgood as $kk=>$vv){
                $classname.=','.$vv['name'];
            }
            $classname=substr($classname,1);
        }
        return $classname;
    }
}
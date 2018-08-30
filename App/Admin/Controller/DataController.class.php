<?php
namespace Admin\Controller;

use Think\Controller;


class DataController extends BaseController{
	public function index(){
        $this->display();
    }
	 
	public function showlist(){
		$m=D('user');
		//查询新增用户
		$date=date('w');
		switch($date){
			case '0':
			$jiu = strtotime(date('Y-m-d'));
			$now = strtotime(date('Y-m-d')).'+24*3600';
			//echo $now;
			$shi = strtotime(date('Y-m-d H:i:s')).'-3600';
			$zhong = strtotime(date('Y-m-d H:i:s'));
			$lu= strtotime(date('Y-m-d H:i:s')).'-1800';
			$sql7="select count(*) from user where time between ".$jiu.' and '.$now;
			$sql6="select count(*) from user where time between ".$jiu.'-24*3600'.' and '.$now.'-24*3600';
			$sql5="select count(*) from user where time between ".$jiu.'-24*2*3600'.' and '.$now.'-24*2*3600';
			$sql4="select count(*) from user where time between ".$jiu.'-24*3*3600'.' and '.$now.'-24*3*3600';
			$sql3="select count(*) from user where time between ".$jiu.'-24*4*3600'.' and '.$now.'-24*4*3600';
			$sql2="select count(*) from user where time between ".$jiu.'-24*5*3600'.' and '.$now.'-24*5*3600';
			$sql1="select count(*) from user where time between ".$jiu.'-24*6*3600'.' and '.$now.'-24*6*3600';

			$res1=$m->query($sql1);
			$res2=$m->query($sql2);
			$res3=$m->query($sql3);
			$res4=$m->query($sql4);
			$res5=$m->query($sql5);
			$res6=$m->query($sql6);
			$res7=$m->query($sql7);
			$arr1=array($res1['0']['count(*)'],$res2['0']['count(*)'],$res3['0']['count(*)'],$res4['0']['count(*)'],$res5['0']['count(*)'],$res6['0']['count(*)'],$res7['0']['count(*)']);
			$arr['arr1']=$arr1;
			$c7="select count(*) from user where login_time between ".$jiu.' and '.$now;
			$c6="select count(*) from user where login_time between ".$jiu.'-24*3600'.' and '.$now.'-24*3600';
			$c5="select count(*) from user where login_time between ".$jiu.'-24*2*3600'.' and '.$now.'-24*2*3600';
			$c4="select count(*) from user where login_time between ".$jiu.'-24*3*3600'.' and '.$now.'-24*3*3600';
			$c3="select count(*) from user where login_time between ".$jiu.'-24*4*3600'.' and '.$now.'-24*4*3600';
			$c2="select count(*) from user where login_time between ".$jiu.'-24*5*3600'.' and '.$now.'-24*5*3600';
			$c1="select count(*) from user where login_time between ".$jiu.'-24*6*3600'.' and '.$now.'-24*6*3600';
			$cc1=$m->query($c1);
			$cc2=$m->query($c2);
			$cc3=$m->query($c3);
			$cc4=$m->query($c4);
			$cc5=$m->query($c5);
			$cc6=$m->query($c6);
			$cc7=$m->query($c7);
			$arr2=array($cc1['0']['count(*)'],$cc2['0']['count(*)'],$cc3['0']['count(*)'],$cc4['0']['count(*)'],$cc5['0']['count(*)'],$cc6['0']['count(*)'],$cc7['0']['count(*)']);
			$arr['arr2']=$arr2;
			$s7="select count(*) from user where time between ".$shi.' and '.$zhong;
			$s6="select count(*) from user where time between ".$shi.'-24*3600'.' and '.$zhong.'-24*3600';
			$s5="select count(*) from user where time between ".$shi.'-24*2*3600'.' and '.$zhong.'-24*2*3600';
			$s4="select count(*) from user where time between ".$shi.'-24*3*3600'.' and '.$zhong.'-24*3*3600';
			$s3="select count(*) from user where time between ".$shi.'-24*4*3600'.' and '.$zhong.'-24*4*3600';
			$s2="select count(*) from user where time between ".$shi.'-24*5*3600'.' and '.$zhong.'-24*5*3600';
			$s1="select count(*) from user where time between ".$shi.'-24*6*3600'.' and '.$zhong.'-24*6*3600';
			$ss1=$m->query($s1);
			$ss2=$m->query($s2);
			$ss3=$m->query($s3);
			$ss4=$m->query($s4);
			$ss5=$m->query($s5);
			$ss6=$m->query($s6);
			$ss7=$m->query($s7);
			$arr3=array($ss1['0']['count(*)'],$ss2['0']['count(*)'],$ss3['0']['count(*)'],$ss4['0']['count(*)'],$ss5['0']['count(*)'],$ss6['0']['count(*)'],$ss7['0']['count(*)']);
			$arr['arr3']=$arr3;
			$l7="select count(*) from user where time < ".$now;
			$l6="select count(*) from user where time  < ".$now.'-24*3600';
			$l5="select count(*) from user where time <  ".$now.'-24*2*3600';
			$l4="select count(*) from user where time < ".$now.'-24*3*3600';
			$l3="select count(*) from user where time < ".$now.'-24*4*3600';
			$l2="select count(*) from user where time < ".$now.'-24*5*3600';
			$l1="select count(*) from user where time < ".$now.'-24*6*3600';
			$ll1=$m->query($l1);
			$ll2=$m->query($l2);
			$ll3=$m->query($l3);
			$ll4=$m->query($l4);
			$ll5=$m->query($l5);
			$ll6=$m->query($l6);
			$ll7=$m->query($l7);
			$arr4=array($ll1['0']['count(*)'],$ll2['0']['count(*)'],$ll3['0']['count(*)'],$ll4['0']['count(*)'],$ll5['0']['count(*)'],$ll6['0']['count(*)'],$ll7['0']['count(*)']);
			$arr['arr4']=$arr4;
			$arr5=array($cc1['0']['count(*)']-$res1['0']['count(*)'],$cc2['0']['count(*)']-$res2['0']['count(*)'],$cc3['0']['count(*)']-$res3['0']['count(*)'],$cc4['0']['count(*)']-$res4['0']['count(*)'],$cc5['0']['count(*)']-$res5['0']['count(*)'],$cc6['0']['count(*)']-$res6['0']['count(*)'],$cc7['0']['count(*)']-$res7['0']['count(*)']);
			$arr['arr5']=$arr5;
			//dump($arr);
			$this->assign('arr',$arr);
			$this->display('Data/echarts');
			break;
			case '1':
			$jiu = strtotime(date('Y-m-d'));
			$now = strtotime(date('Y-m-d')).'+24*3600';
			$shi = strtotime(date('Y-m-d H:i:s')).'-3600';
			
			$zhong = strtotime(date('Y-m-d H:i:s'));
			$lu= strtotime(date('Y-m-d H:i:s')).'-1800';
			//echo $lu;
			$sql1="select count(*) from user where time between ".$jiu.' and '.$now;
			$sql2="select count(*) from user where time between ".$jiu.'+24*3600'.' and '.$now.'+24*3600';
			$sql3="select count(*) from user where time between ".$jiu.'+24*2*3600'.' and '.$now.'+24*2*3600';
			$sql4="select count(*) from user where time between ".$jiu.'+24*3*3600'.' and '.$now.'+24*3*3600';
			$sql5="select count(*) from user where time between ".$jiu.'+24*4*3600'.' and '.$now.'+24*4*3600';
			$sql6="select count(*) from user where time between ".$jiu.'+24*5*3600'.' and '.$now.'+24*5*3600';
			$sql7="select count(*) from user where time between ".$jiu.'+24*6*3600'.' and '.$now.'+24*6*3600';
			$res1=$m->query($sql1);
			$res2=$m->query($sql2);
			$res3=$m->query($sql3);
			$res4=$m->query($sql4);
			$res5=$m->query($sql5);
			$res6=$m->query($sql6);
			$res7=$m->query($sql7);
			$arr1=array($res1['0']['count(*)'],$res2['0']['count(*)'],$res3['0']['count(*)'],$res4['0']['count(*)'],$res5['0']['count(*)'],$res6['0']['count(*)'],$res7['0']['count(*)']);
			$arr['arr1']=$arr1;
			$c1="select count(*) from user where login_time between ".$jiu.' and '.$now;
			$c2="select count(*) from user where login_time between ".$jiu.'+24*3600'.' and '.$now.'+24*3600';
			$c3="select count(*) from user where login_time between ".$jiu.'+24*2*3600'.' and '.$now.'+24*2*3600';
			$c4="select count(*) from user where login_time between ".$jiu.'+24*3*3600'.' and '.$now.'+24*3*3600';
			$c5="select count(*) from user where login_time between ".$jiu.'+24*4*3600'.' and '.$now.'+24*4*3600';
			$c6="select count(*) from user where login_time between ".$jiu.'+24*5*3600'.' and '.$now.'+24*5*3600';
			$c7="select count(*) from user where login_time between ".$jiu.'+24*6*3600'.' and '.$now.'+24*6*3600';
			$cc1=$m->query($c1);
			$cc2=$m->query($c2);
			$cc3=$m->query($c3);
			$cc4=$m->query($c4);
			$cc5=$m->query($c5);
			$cc6=$m->query($c6);
			$cc7=$m->query($c7);
			$arr2=array($cc1['0']['count(*)'],$cc2['0']['count(*)'],$cc3['0']['count(*)'],$cc4['0']['count(*)'],$cc5['0']['count(*)'],$cc6['0']['count(*)'],$cc7['0']['count(*)']);
			$arr['arr2']=$arr2;
			$s1="select count(*) from user where time between ".$shi.' and '.$zhong;
			$s2="select count(*) from user where time between ".$shi.'+24*3600'.' and '.$zhong.'+24*3600';
			$s3="select count(*) from user where time between ".$shi.'+24*2*3600'.' and '.$zhong.'+24*2*3600';
			$s4="select count(*) from user where time between ".$shi.'+24*3*3600'.' and '.$zhong.'+24*3*3600';
			$s5="select count(*) from user where time between ".$shi.'+24*4*3600'.' and '.$zhong.'+24*4*3600';
			$s6="select count(*) from user where time between ".$shi.'+24*5*3600'.' and '.$zhong.'+24*5*3600';
			$s7="select count(*) from user where time between ".$shi.'+24*6*3600'.' and '.$zhong.'+24*6*3600';
			$ss1=$m->query($s1);
			$ss2=$m->query($s2);
			$ss3=$m->query($s3);
			$ss4=$m->query($s4);
			$ss5=$m->query($s5);
			$ss6=$m->query($s6);
			$ss7=$m->query($s7);
			$arr3=array($ss1['0']['count(*)'],$ss2['0']['count(*)'],$ss3['0']['count(*)'],$ss4['0']['count(*)'],$ss5['0']['count(*)'],$ss6['0']['count(*)'],$ss7['0']['count(*)']);
			$arr['arr3']=$arr3;
			$l1="select count(*) from user where time < ".$now;
			$l2="select count(*) from user where time < ".$now.'+24*3600';
			$l3="select count(*) from user where time < ".$now.'+24*2*3600';
			$l4="select count(*) from user where time < ".$now.'+24*3*3600';
			$l5="select count(*) from user where time < ".$now.'+24*4*3600';
			$l6="select count(*) from user where time < ".$now.'+24*5*3600';
			$l7="select count(*) from user where time < ".$now.'+24*6*3600';
			$ll1=$m->query($l1);
			$ll2=$m->query($l2);
			$ll3=$m->query($l3);
			$ll4=$m->query($l4);
			$ll5=$m->query($l5);
			$ll6=$m->query($l6);
			$ll7=$m->query($l7);
			$arr4=array($ll1['0']['count(*)'],$ll2['0']['count(*)'],$ll3['0']['count(*)'],$ll4['0']['count(*)'],$ll5['0']['count(*)'],$ll6['0']['count(*)'],$ll7['0']['count(*)']);
			$arr['arr4']=$arr4;
			//dump($arr);
			$arr5=array($cc1['0']['count(*)']-$res1['0']['count(*)'],$cc2['0']['count(*)']-$res2['0']['count(*)'],$cc3['0']['count(*)']-$res3['0']['count(*)'],$cc4['0']['count(*)']-$res4['0']['count(*)'],$cc5['0']['count(*)']-$res5['0']['count(*)'],$cc6['0']['count(*)']-$res6['0']['count(*)'],$cc7['0']['count(*)']-$res7['0']['count(*)']);
			$arr['arr5']=$arr5;
			$this->assign('arr',$arr);
			$this->display('Data/echarts');
			break;
			case '2':
			$jiu = strtotime(date('Y-m-d'));
			$now = strtotime(date('Y-m-d')).'+24*3600';
			
			$shi = strtotime(date('Y-m-d H:i:s')).'-3600';
			//echo $jiu;
			$zhong = strtotime(date('Y-m-d H:i:s'));
			//echo $zhong;
			$lu= strtotime(date('Y-m-d H:i:s')).'-1800';
			$sql2="select count(*) from user where time between ".$jiu.' and '.$now;
			$sql1="select count(*) from user where time between ".$jiu.'-24*3600'.' and '.$now.'-24*3600';
			$sql3="select count(*) from user where time between ".$jiu.'+24*3600'.' and '.$now.'+24*3600';
			$sql4="select count(*) from user where time between ".$jiu.'+24*2*2600'.' and '.$now.'+24*3*3600';
			$sql5="select count(*) from user where time between ".$jiu.'+24*3*3600'.' and '.$now.'+23*4*3600';
			$sql6="select count(*) from user where time between ".$jiu.'+24*4*3600'.' and '.$now.'+24*4*3600';
			$sql7="select count(*) from user where time between ".$jiu.'+24*5*3500'.' and '.$now.'+24*6*3600';
			$res1=$m->query($sql1);
			$res2=$m->query($sql2);
			$res3=$m->query($sql3);
			$res4=$m->query($sql4);
			$res5=$m->query($sql5);
			$res6=$m->query($sql6);
			$res7=$m->query($sql7);
			$arr1=array($res1['0']['count(*)'],$res2['0']['count(*)'],$res3['0']['count(*)'],$res4['0']['count(*)'],$res5['0']['count(*)'],$res6['0']['count(*)'],$res7['0']['count(*)']);
			$arr['arr1']=$arr1;
			$c2="select count(*) from user where login_time between ".$jiu.' and '.$now;
			$c1="select count(*) from user where login_time between ".$jiu.'-24*3600'.' and '.$now.'-24*3600';
			$c3="select count(*) from user where login_time between ".$jiu.'+24*3600'.' and '.$now.'+24*3600';
			$c4="select count(*) from user where login_time between ".$jiu.'+24*2*2600'.' and '.$now.'+24*3*3600';
			$c5="select count(*) from user where login_time between ".$jiu.'+24*3*3600'.' and '.$now.'+23*4*3600';
			$c6="select count(*) from user where login_time between ".$jiu.'+24*4*3600'.' and '.$now.'+24*4*3600';
			$c7="select count(*) from user where login_time between ".$jiu.'+24*5*3500'.' and '.$now.'+24*6*3600';
			$cc1=$m->query($c1);
			$cc2=$m->query($c2);
			$cc3=$m->query($c3);
			$cc4=$m->query($c4);
			$cc5=$m->query($c5);
			$cc6=$m->query($c6);
			$cc7=$m->query($c7);
			$arr2=array($cc1['0']['count(*)'],$cc2['0']['count(*)'],$cc3['0']['count(*)'],$cc4['0']['count(*)'],$cc5['0']['count(*)'],$cc6['0']['count(*)'],$cc7['0']['count(*)']);
			$arr['arr2']=$arr2;
			$s2="select count(*) from user where time between ".$shi.' and '.$zhong;
			$s1="select count(*) from user where time between ".$shi.'-24*3600'.' and '.$zhong.'-24*3600';
			$s3="select count(*) from user where time between ".$shi.'+24*3600'.' and '.$zhong.'+24*3600';
			$s4="select count(*) from user where time between ".$shi.'+24*2*2600'.' and '.$zhong.'+24*3*3600';
			$s5="select count(*) from user where time between ".$shi.'+24*3*3600'.' and '.$zhong.'+23*4*3600';
			$s6="select count(*) from user where time between ".$shi.'+24*4*3600'.' and '.$zhong.'+24*4*3600';
			$s7="select count(*) from user where time between ".$shi.'+24*5*3500'.' and '.$zhong.'+24*6*3600';
			$ss1=$m->query($s1);
			$ss2=$m->query($s2);
			$ss3=$m->query($s3);
			$ss4=$m->query($s4);
			$ss5=$m->query($s5);
			$ss6=$m->query($s6);
			$ss7=$m->query($s7);
			$arr3=array($ss1['0']['count(*)'],$ss2['0']['count(*)'],$ss3['0']['count(*)'],$ss4['0']['count(*)'],$ss5['0']['count(*)'],$ss6['0']['count(*)'],$ss7['0']['count(*)']);
			$arr['arr3']=$arr3;
			$l2="select count(*) from user where time < ".$now;
			$l1="select count(*) from user where time < ".$now.'-24*3600';
			$l3="select count(*) from user where time < ".$now.'+24*3600';
			$l4="select count(*) from user where time < ".$now.'+24*3*3600';
			$l5="select count(*) from user where time < ".$now.'+23*4*3600';
			$l6="select count(*) from user where time < ".$now.'+24*4*3600';
			$l7="select count(*) from user where time < ".$now.'+24*6*3600';
			$ll1=$m->query($l1);
			$ll2=$m->query($l2);
			$ll3=$m->query($l3);
			$ll4=$m->query($l4);
			$ll5=$m->query($l5);
			$ll6=$m->query($l6);
			$ll7=$m->query($l7);
			$arr4=array($ll1['0']['count(*)'],$ll2['0']['count(*)'],$ll3['0']['count(*)'],$ll4['0']['count(*)'],$ll5['0']['count(*)'],$ll6['0']['count(*)'],$ll7['0']['count(*)']);
			$arr['arr4']=$arr4;
			$arr5=array($cc1['0']['count(*)']-$res1['0']['count(*)'],$cc2['0']['count(*)']-$res2['0']['count(*)'],$cc3['0']['count(*)']-$res3['0']['count(*)'],$cc4['0']['count(*)']-$res4['0']['count(*)'],$cc5['0']['count(*)']-$res5['0']['count(*)'],$cc6['0']['count(*)']-$res6['0']['count(*)'],$cc7['0']['count(*)']-$res7['0']['count(*)']);
			$arr['arr5']=$arr5;
			//dump($arr);
			$this->assign('arr',$arr);
			$this->display('Data/echarts');
			break;
			case '3':
			
			$jiu = strtotime(date('Y-m-d'));
			$now = strtotime(date('Y-m-d')).'+24*3600';
			//echo $jiu;
			$shi = strtotime(date('Y-m-d H:i:s')).'-3600';
			$zhong = strtotime(date('Y-m-d H:i:s'));
			$lu= strtotime(date('Y-m-d H:i:s')).'-1800';
			$sql3="select count(*) from user where time between ".$jiu.' and '.$now;
			$sql1="select count(*) from user where time between ".$jiu.'-24*2*3600'.' and '.$now.'-24*2*3600';
			$sql2="select count(*) from user where time between ".$jiu.'-24*3600'.' and '.$now.'-24*3600';
			$sql4="select count(*) from user where time between ".$jiu.'+24*3600'.' and '.$now.'+24*3600';
			$sql5="select count(*) from user where time between ".$jiu.'+24*2*3600'.' and '.$now.'+22*4*3600';
			$sql6="select count(*) from user where time between ".$jiu.'+24*3*3600'.' and '.$now.'+24*3*3600';
			$sql7="select count(*) from user where time between ".$jiu.'+24*4*3400'.' and '.$now.'+24*6*3600';
			$res1=$m->query($sql1);
			$res2=$m->query($sql2);
			$res3=$m->query($sql3);
			$res4=$m->query($sql4);
			$res5=$m->query($sql5);
			$res6=$m->query($sql6);
			$res7=$m->query($sql7);
			$arr1=array($res1['0']['count(*)'],$res2['0']['count(*)'],$res3['0']['count(*)'],$res4['0']['count(*)'],$res5['0']['count(*)'],$res6['0']['count(*)'],$res7['0']['count(*)']);
			$arr['arr1']=$arr1;
			$c3="select count(*) from user where login_time between ".$jiu.' and '.$now;
			$c1="select count(*) from user where login_time between ".$jiu.'-24*2*3600'.' and '.$now.'-24*2*3600';
			$c2="select count(*) from user where login_time between ".$jiu.'-24*3600'.' and '.$now.'-24*3600';
			$c4="select count(*) from user where login_time between ".$jiu.'+24*3600'.' and '.$now.'+24*3600';
			$c5="select count(*) from user where login_time between ".$jiu.'+24*2*3600'.' and '.$now.'+22*4*3600';
			$c6="select count(*) from user where login_time between ".$jiu.'+24*3*3600'.' and '.$now.'+24*3*3600';
			$c7="select count(*) from user where login_time between ".$jiu.'+24*4*3400'.' and '.$now.'+24*6*3600';
			$cc1=$m->query($c1);
			$cc2=$m->query($c2);
			$cc3=$m->query($c3);
			$cc4=$m->query($c4);
			$cc5=$m->query($c5);
			$cc6=$m->query($c6);
			$cc7=$m->query($c7);
			$arr2=array($cc1['0']['count(*)'],$cc2['0']['count(*)'],$cc3['0']['count(*)'],$cc4['0']['count(*)'],$cc5['0']['count(*)'],$cc6['0']['count(*)'],$cc7['0']['count(*)']);
			$arr['arr2']=$arr2;
			$s3="select count(*) from user where time between ".$shi.' and '.$zhong;
			$s1="select count(*) from user where time between ".$shi.'-24*2*3600'.' and '.$zhong.'-24*2*3600';
			$s2="select count(*) from user where time between ".$shi.'-24*3600'.' and '.$zhong.'-24*3600';
			$s4="select count(*) from user where time between ".$shi.'+24*3600'.' and '.$zhong.'+24*3600';
			$s5="select count(*) from user where time between ".$shi.'+24*2*3600'.' and '.$zhong.'+22*4*3600';
			$s6="select count(*) from user where time between ".$shi.'+24*3*3600'.' and '.$zhong.'+24*3*3600';
			$s7="select count(*) from user where time between ".$shi.'+24*4*3400'.' and '.$zhong.'+24*6*3600';
			$ss1=$m->query($s1);
			$ss2=$m->query($s2);
			$ss3=$m->query($s3);
			$ss4=$m->query($s4);
			$ss5=$m->query($s5);
			$ss6=$m->query($s6);
			$ss7=$m->query($s7);
			$arr3=array($ss1['0']['count(*)'],$ss2['0']['count(*)'],$ss3['0']['count(*)'],$ss4['0']['count(*)'],$ss5['0']['count(*)'],$ss6['0']['count(*)'],$ss7['0']['count(*)']);
			$arr['arr3']=$arr3;
			$l3="select count(*) from user where time < ".$now;
			$l1="select count(*) from user where time < ".$now.'-24*2*3600';
			$l2="select count(*) from user where time < ".$now.'-24*3600';
			$l4="select count(*) from user where time < ".$now.'+24*3600';
			$l5="select count(*) from user where time < ".$now.'+22*4*3600';
			$l6="select count(*) from user where time < ".$now.'+24*3*3600';
			$l7="select count(*) from user where time < ".$now.'+24*6*3600';
			$ll1=$m->query($l1);
			$ll2=$m->query($l2);
			$ll3=$m->query($l3);
			$ll4=$m->query($l4);
			$ll5=$m->query($l5);
			$ll6=$m->query($l6);
			$ll7=$m->query($l7);
			$arr4=array($ll1['0']['count(*)'],$ll2['0']['count(*)'],$ll3['0']['count(*)'],$ll4['0']['count(*)'],$ll5['0']['count(*)'],$ll6['0']['count(*)'],$ll7['0']['count(*)']);
			$arr['arr4']=$arr4;
			$arr5=array($cc1['0']['count(*)']-$res1['0']['count(*)'],$cc2['0']['count(*)']-$res2['0']['count(*)'],$cc3['0']['count(*)']-$res3['0']['count(*)'],$cc4['0']['count(*)']-$res4['0']['count(*)'],$cc5['0']['count(*)']-$res5['0']['count(*)'],$cc6['0']['count(*)']-$res6['0']['count(*)'],$cc7['0']['count(*)']-$res7['0']['count(*)']);
			$arr['arr5']=$arr5;
			//dump($arr);
			$this->assign('arr',$arr);
			$this->display('Data/echarts');
			break;
			case '4':
			$now = strtotime(date('Y-m-d')).'+24*3600';
			$jiu = strtotime(date('Y-m-d'));
			//echo $jiu;
			$shi = strtotime(date('Y-m-d H:i:s')).'-3600';
			$lu= strtotime(date('Y-m-d H:i:s')).'-1800';
			$zhong = strtotime(date('Y-m-d H:i:s'));
			$sql4="select count(*) from user where time between ".$jiu.' and '.$now;
			$sql3="select count(*) from user where time between ".$jiu.'-24*3600'.' and '.$now.'-24*3600';
			$sql2="select count(*) from user where time between ".$jiu.'-24*2*3600'.' and '.$now.'-24*2*3600';
			$sql1="select count(*) from user where time between ".$jiu.'-24*3*3600'.' and '.$now.'-24*3*3600';
			$sql5="select count(*) from user where time between ".$jiu.'+24*3600'.' and '.$now.'+24*3600';
			$sql6="select count(*) from user where time between ".$jiu.'+24*2*3600'.' and '.$now.'+24*2*3600';
			$sql7="select count(*) from user where time between ".$jiu.'+24*3*3600'.' and '.$now.'+24*3*3600';
			$res1=$m->query($sql1);
			$res2=$m->query($sql2);
			$res3=$m->query($sql3);
			$res4=$m->query($sql4); 
			$res5=$m->query($sql5);
			$res6=$m->query($sql6);
			$res7=$m->query($sql7);
			$arr1=array($res1['0']['count(*)'],$res2['0']['count(*)'],$res3['0']['count(*)'],$res4['0']['count(*)'],$res5['0']['count(*)'],$res6['0']['count(*)'],$res7['0']['count(*)']);
			$arr['arr1']=$arr1;
			//$arr['arr2']=$arr2;
			$c4="select count(*) from user where login_time between ".$jiu.' and '.$now;
			$c3="select count(*) from user where login_time between ".$jiu.'-24*3600'.' and '.$now.'-24*3600';
			$c2="select count(*) from user where login_time between ".$jiu.'-24*2*3600'.' and '.$now.'-24*2*3600';
			$c1="select count(*) from user where login_time between ".$jiu.'-24*3*3600'.' and '.$now.'-24*3*3600';
			$c5="select count(*) from user where login_time between ".$jiu.'+24*3600'.' and '.$now.'+24*3600';
			$c6="select count(*) from user where login_time between ".$jiu.'+24*2*3600'.' and '.$now.'+24*2*3600';
			$c7="select count(*) from user where login_time between ".$jiu.'+24*3*3600'.' and '.$now.'+24*3*3600';
			$cc1=$m->query($c1);
			$cc2=$m->query($c2);
			$cc3=$m->query($c3);
			$cc4=$m->query($c4);
			$cc5=$m->query($c5);
			$cc6=$m->query($c6);
			$cc7=$m->query($c7);
			$arr2=array($cc1['0']['count(*)'],$cc2['0']['count(*)'],$cc3['0']['count(*)'],$cc4['0']['count(*)'],$cc5['0']['count(*)'],$cc6['0']['count(*)'],$cc7['0']['count(*)']);
			$arr['arr2']=$arr2;
			$s4="select count(*) from user where time between ".$shi.' and '.$zhong;
			$s3="select count(*) from user where time between ".$shi.'-24*3600'.' and '.$zhong.'-24*3600';
			$s2="select count(*) from user where time between ".$shi.'-24*2*3600'.' and '.$zhong.'-24*2*3600';
			$s1="select count(*) from user where time between ".$shi.'-24*3*3600'.' and '.$zhong.'-24*3*3600';
			$s5="select count(*) from user where time between ".$shi.'+24*3600'.' and '.$zhong.'+24*3600';
			$s6="select count(*) from user where time between ".$shi.'+24*2*3600'.' and '.$zhong.'+24*2*3600';
			$s7="select count(*) from user where time between ".$shi.'+24*3*3600'.' and '.$zhong.'+24*3*3600';
			$ss1=$m->query($s1);
			$ss2=$m->query($s2);
			$ss3=$m->query($s3);
			$ss4=$m->query($s4);
			$ss5=$m->query($s5);
			$ss6=$m->query($s6);
			$ss7=$m->query($s7);
			$arr3=array($ss1['0']['count(*)'],$ss2['0']['count(*)'],$ss3['0']['count(*)'],$ss4['0']['count(*)'],$ss5['0']['count(*)'],$ss6['0']['count(*)'],$ss7['0']['count(*)']);
			$arr['arr3']=$arr3;
			$l4="select count(*) from user where time <  ".$now;
			$l3="select count(*) from user where time <  ".$now.'-24*3600';
			$l2="select count(*) from user where time <  ".$now.'-24*2*3600';
			$l1="select count(*) from user where time <  ".$now.'-24*3*3600';
			$l5="select count(*) from user where time <  ".$now.'+24*3600';
			$l6="select count(*) from user where time <  ".$now.'+24*2*3600';
			$l7="select count(*) from user where time <  ".$now.'+24*3*3600';
			$ll1=$m->query($l1);
			$ll2=$m->query($l2);
			$ll3=$m->query($l3);
			$ll4=$m->query($l4);
			$ll5=$m->query($l5);
			$ll6=$m->query($l6);
			$ll7=$m->query($l7);
			$arr4=array($ll1['0']['count(*)'],$ll2['0']['count(*)'],$ll3['0']['count(*)'],$ll4['0']['count(*)'],$ll5['0']['count(*)'],$ll6['0']['count(*)'],$ll7['0']['count(*)']);
			$arr['arr4']=$arr4;
			$arr5=array($cc1['0']['count(*)']-$res1['0']['count(*)'],$cc2['0']['count(*)']-$res2['0']['count(*)'],$cc3['0']['count(*)']-$res3['0']['count(*)'],$cc4['0']['count(*)']-$res4['0']['count(*)'],$cc5['0']['count(*)']-$res5['0']['count(*)'],$cc6['0']['count(*)']-$res6['0']['count(*)'],$cc7['0']['count(*)']-$res7['0']['count(*)']);
			$arr['arr5']=$arr5;
			//dump($arr);
			$this->assign('arr',$arr);
			$this->display('Data/echarts');
			break;
			case '5':
			$now = strtotime(date('Y-m-d')).'+24*3600';
			$jiu = strtotime(date('Y-m-d'));
			//echo $jiu;
			$lu= strtotime(date('Y-m-d H:i:s')).'-1800';
			$shi = strtotime(date('Y-m-d H:i:s')).'-3600';
			$zhong = strtotime(date('Y-m-d H:i:s'));
			$sql5="select count(*) from user where time between ".$jiu.' and '.$now;
			$sql4="select count(*) from user where time between ".$jiu.'-24*3600'.' and '.$now.'-24*3600';
			$sql3="select count(*) from user where time between ".$jiu.'-24*2*3600'.' and '.$now.'-24*2*3600';
			$sql2="select count(*) from user where time between ".$jiu.'-24*3*3600'.' and '.$now.'-24*3*3600';
			$sql1="select count(*) from user where time between ".$jiu.'-24*4*3600'.' and '.$now.'-24*4*3600';
			$sql6="select count(*) from user where time between ".$jiu.'+24*3600'.' and '.$now.'+24*3600';
			$sql7="select count(*) from user where time between ".$jiu.'+24*2*3600'.' and '.$now.'+24*2*3600';
			$res1=$m->query($sql1);
			$res2=$m->query($sql2);
			$res3=$m->query($sql3);
			$res4=$m->query($sql4);
			$res5=$m->query($sql5);
			$res6=$m->query($sql6);
			$res7=$m->query($sql7);
			$arr1=array($res1['0']['count(*)'],$res2['0']['count(*)'],$res3['0']['count(*)'],$res4['0']['count(*)'],$res5['0']['count(*)'],$res6['0']['count(*)'],$res7['0']['count(*)']);
			$arr['arr1']=$arr1;
			//$arr['arr2']=$arr2;
			$c5="select count(*) from user where login_time between ".$jiu.' and '.$now;
			$c4="select count(*) from user where login_time between ".$jiu.'-24*3600'.' and '.$now.'-24*3600';
			$c3="select count(*) from user where login_time between ".$jiu.'-24*2*3600'.' and '.$now.'-24*2*3600';
			$c2="select count(*) from user where login_time between ".$jiu.'-24*3*3600'.' and '.$now.'-24*3*3600';
			$c1="select count(*) from user where login_time between ".$jiu.'-24*4*3600'.' and '.$now.'-24*4*3600';
			$c6="select count(*) from user where login_time between ".$jiu.'+24*3600'.' and '.$now.'+24*3600';
			$c7="select count(*) from user where login_time between ".$jiu.'+24*2*3600'.' and '.$now.'+24*2*3600';
			$cc1=$m->query($c1);
			$cc2=$m->query($c2);
			$cc3=$m->query($c3);
			$cc4=$m->query($c4);
			$cc5=$m->query($c5);
			$cc6=$m->query($c6);
			$cc7=$m->query($c7);
			$arr2=array($cc1['0']['count(*)'],$cc2['0']['count(*)'],$cc3['0']['count(*)'],$cc4['0']['count(*)'],$cc5['0']['count(*)'],$cc6['0']['count(*)'],$cc7['0']['count(*)']);
			$arr['arr2']=$arr2;
			$s5="select count(*) from user where time between ".$shi.' and '.$zhong;
			$s4="select count(*) from user where time between ".$shi.'-24*3600'.' and '.$zhong.'-24*3600';
			$s3="select count(*) from user where time between ".$shi.'-24*2*3600'.' and '.$zhong.'-24*2*3600';
			$s2="select count(*) from user where time between ".$shi.'-24*3*3600'.' and '.$zhong.'-24*3*3600';
			$s1="select count(*) from user where time between ".$shi.'-24*4*3600'.' and '.$zhong.'-24*4*3600';
			$s6="select count(*) from user where time between ".$shi.'+24*3600'.' and '.$zhong.'+24*3600';
			$s7="select count(*) from user where time between ".$shi.'+24*2*3600'.' and '.$zhong.'+24*2*3600';
			$ss1=$m->query($s1);
			$ss2=$m->query($s2);
			$ss3=$m->query($s3);
			$ss4=$m->query($s4);
			$ss5=$m->query($s5);
			$ss6=$m->query($s6);
			$ss7=$m->query($s7);
			$arr3=array($ss1['0']['count(*)'],$ss2['0']['count(*)'],$ss3['0']['count(*)'],$ss4['0']['count(*)'],$ss5['0']['count(*)'],$ss6['0']['count(*)'],$ss7['0']['count(*)']);
			$arr['arr3']=$arr3;
			$l5="select count(*) from user where time <  ".$now;
			$l4="select count(*) from user where time <  ".$now.'-24*3600';
			$l3="select count(*) from user where time <  ".$now.'-24*2*3600';
			$l2="select count(*) from user where time <  ".$now.'-24*3*3600';
			$l1="select count(*) from user where time <  ".$now.'-24*4*3600';
			$l6="select count(*) from user where time <  ".$now.'+24*3600';
			$l7="select count(*) from user where time <  ".$now.'+24*2*3600';
			$ll1=$m->query($l1);
			$ll2=$m->query($l2);
			$ll3=$m->query($l3);
			$ll4=$m->query($l4);
			$ll5=$m->query($l5);
			$ll6=$m->query($l6);
			$ll7=$m->query($l7);
			$arr4=array($ll1['0']['count(*)'],$ll2['0']['count(*)'],$ll3['0']['count(*)'],$ll4['0']['count(*)'],$ll5['0']['count(*)'],$ll6['0']['count(*)'],$ll7['0']['count(*)']);
			$arr['arr4']=$arr4;
			$arr5=array($cc1['0']['count(*)']-$res1['0']['count(*)'],$cc2['0']['count(*)']-$res2['0']['count(*)'],$cc3['0']['count(*)']-$res3['0']['count(*)'],$cc4['0']['count(*)']-$res4['0']['count(*)'],$cc5['0']['count(*)']-$res5['0']['count(*)'],$cc6['0']['count(*)']-$res6['0']['count(*)'],$cc7['0']['count(*)']-$res7['0']['count(*)']);
			$arr['arr5']=$arr5;
			//dump($arr);
			$this->assign('arr',$arr);
			$this->display('Data/echarts');
			break;
			case '6':
			$now = strtotime(date('Y-m-d')).'+24*3600';
			$jiu = strtotime(date('Y-m-d'));
			//echo $jiu;
			$lu= strtotime(date('Y-m-d H:i:s')).'-1800';
			$shi = strtotime(date('Y-m-d H:i:s')).'-3600';
			$zhong = strtotime(date('Y-m-d H:i:s'));
			$sql6="select count(*) from user where time between ".$jiu.' and '.$now;
			$sql5="select count(*) from user where time between ".$jiu.'-24*3600'.' and '.$now.'-24*3600';
			$sql4="select count(*) from user where time between ".$jiu.'-24*2*3600'.' and '.$now.'-24*2*3600';
			$sql3="select count(*) from user where time between ".$jiu.'-24*3*3600'.' and '.$now.'-24*3*3600';
			$sql2="select count(*) from user where time between ".$jiu.'-24*4*3600'.' and '.$now.'-24*4*3600';
			$sql1="select count(*) from user where time between ".$jiu.'-24*5*3600'.' and '.$now.'-24*5*3600';
			$sql7="select count(*) from user where time between ".$jiu.'+24*3600'.' and '.$now.'+24*3600';
			$res1=$m->query($sql1);
			$res2=$m->query($sql2);
			$res3=$m->query($sql3);
			$res4=$m->query($sql4);
			$res5=$m->query($sql5);
			$res6=$m->query($sql6);
			$res7=$m->query($sql7);
			$arr1=array($res1['0']['count(*)'],$res2['0']['count(*)'],$res3['0']['count(*)'],$res4['0']['count(*)'],$res5['0']['count(*)'],$res6['0']['count(*)'],$res7['0']['count(*)']);
			$arr['arr1']=$arr1;
			//$arr['arr2']=$arr2;
			$c6="select count(*) from user where login_time between ".$jiu.' and '.$now;
			$c5="select count(*) from user where login_time between ".$jiu.'-24*3600'.' and '.$now.'-24*3600';
			$c4="select count(*) from user where login_time between ".$jiu.'-24*2*3600'.' and '.$now.'-24*2*3600';
			$c3="select count(*) from user where login_time between ".$jiu.'-24*3*3600'.' and '.$now.'-24*3*3600';
			$c2="select count(*) from user where login_time between ".$jiu.'-24*4*3600'.' and '.$now.'-24*4*3600';
			$c1="select count(*) from user where login_time between ".$jiu.'-24*5*3600'.' and '.$now.'-24*5*3600';
			$c7="select count(*) from user where login_time between ".$jiu.'+24*3600'.' and '.$now.'+24*3600';
			$cc1=$m->query($c1);
			$cc2=$m->query($c2);
			$cc3=$m->query($c3);
			$cc4=$m->query($c4);
			$cc5=$m->query($c5);
			$cc6=$m->query($c6); 
			$cc7=$m->query($c7);
			$arr2=array($cc1['0']['count(*)'],$cc2['0']['count(*)'],$cc3['0']['count(*)'],$cc4['0']['count(*)'],$cc5['0']['count(*)'],$cc6['0']['count(*)'],$cc7['0']['count(*)']);
			$arr['arr2']=$arr2;
			$s6="select count(*) from user where time between ".$shi.' and '.$zhong;
			$s5="select count(*) from user where time between ".$shi.'-24*3600'.' and '.$zhong.'-24*3600';
			$s4="select count(*) from user where time between ".$shi.'-24*2*3600'.' and '.$zhong.'-24*2*3600';
			$s3="select count(*) from user where time between ".$shi.'-24*3*3600'.' and '.$zhong.'-24*3*3600';
			$s2="select count(*) from user where time between ".$shi.'-24*4*3600'.' and '.$zhong.'-24*4*3600';
			$s1="select count(*) from user where time between ".$shi.'-24*5*3600'.' and '.$zhong.'-24*5*3600';
			$s7="select count(*) from user where time between ".$shi.'+24*3600'.' and '.$zhong.'+24*3600';
			$ss1=$m->query($s1);
			$ss2=$m->query($s2);
			$ss3=$m->query($s3);
			$ss4=$m->query($s4);
			$ss5=$m->query($s5);
			$ss6=$m->query($s6);
			$ss7=$m->query($s7);
			$arr3=array($ss1['0']['count(*)'],$ss2['0']['count(*)'],$ss3['0']['count(*)'],$ss4['0']['count(*)'],$ss5['0']['count(*)'],$ss6['0']['count(*)'],$ss7['0']['count(*)']);
			$arr['arr3']=$arr3;
			$l6="select count(*) from user where time < ".$now;
			$l5="select count(*) from user where time < ".$now.'-24*3600';
			$l4="select count(*) from user where time < ".$now.'-24*2*3600';
			$l3="select count(*) from user where time < ".$now.'-24*3*3600';
			$l2="select count(*) from user where time < ".$now.'-24*4*3600';
			$l1="select count(*) from user where time < ".$now.'-24*5*3600';
			$l7="select count(*) from user where time < ".$now.'+24*3600';
			$ll1=$m->query($l1);
			$ll2=$m->query($l2);
			$ll3=$m->query($l3);
			$ll4=$m->query($l4);
			$ll5=$m->query($l5);
			$ll6=$m->query($l6);
			$ll7=$m->query($l7);
			$arr4=array($ll1['0']['count(*)'],$ll2['0']['count(*)'],$ll3['0']['count(*)'],$ll4['0']['count(*)'],$ll5['0']['count(*)'],$ll6['0']['count(*)'],$ll7['0']['count(*)']);
			$arr['arr4']=$arr4;
			//dump($arr);
			$this->assign('arr',$arr);
			$this->display('Data/echarts');
			break;
		}
		

	}

public function showlvechart(){
		$now = strtotime(date('Y-m-d')).'+24*3600';
		$jiu = strtotime(date('Y-m-d'));
		//echo $now;
		$lu= strtotime(date('Y-m-d H:i:s')).'-1800';
		$shi = strtotime(date('Y-m-d H:i:s')).'-3600';
		$zhong = strtotime(date('Y-m-d H:i:s'));
		$m=D('user');
		//查询新增用户
		$date=date('w');
		switch($date){
			case '0':
			$sql7="select user_id from user where time between ".$jiu.' and '.$now;
			$sql6="select user_id from user where time between ".$jiu.'-24*3600'.' and '.$now.'-24*3600';
			$sql5="select user_id from user where time between ".$jiu.'-24*2*3600'.' and '.$now.'-24*2*3600';
			$sql4="select user_id from user where time between ".$jiu.'-24*3*3600'.' and '.$now.'-24*3*3600';
			$sql3="select user_id from user where time between ".$jiu.'-24*4*3600'.' and '.$now.'-24*4*3600';
			$sql2="select user_id from user where time between ".$jiu.'-24*5*3600'.' and '.$now.'-24*5*3600';
			$sql1="select user_id from user where time between ".$jiu.'-24*6*3600'.' and '.$now.'-24*6*3600';
			$res1=$m->query($sql1);
			$res2=$m->query($sql2);
			$res3=$m->query($sql3);
			$res4=$m->query($sql4);
			$res5=$m->query($sql5);
			$res6=$m->query($sql6);
			$res7=$m->query($sql7);
			$sum3="";
			$count3=count($res3);
			for($i = 0; $i < $count3; $i++){
				if(($i+1)==$count3){
				$sum3 .= $res3[$i]['user_id'];
				}else{
				 $sum3 .= $res3[$i]['user_id'].',';
				}
			}
			$arr3=$sum3;
			if($arr3){
			$l3="select count(*) from user where user_id in (".$arr3.")". 'and login_time between '.$now.'-24*4*3600'.' and '.$now.'-24*3*3600';
			$ll3=$m->query($l3);
			$q3="select count(*) from user where user_id in (".$arr3.")". 'and login_time between '.$now.'+24*3600'.' and '.$now.'+24*2*3600';
			$qq3=$m->query($q3);
			$row3=round($ll3['0']['count(*)']/$count3*'100%',0);
			$a3=round($qq3['0']['count(*)']/$count3*'100%',0);
			$s3="select count(*) from user where user_id in (".$arr3.")". 'and login_time between '.$now.'+24*24*3600'.' and '.$now.'+24*25*3600';
			$ss3=$m->query($s3);
			$b3=round($ss3['0']['count(*)']/$count3*'100%',0);
			}else{
				$row3=0;
				$a3=0;
				$b3=0;
			}
			
			$sum2="";
			$count2=count($res2);
			for($i = 0; $i < $count2; $i++){
				if(($i+1)==$count2){
				$sum2 .= $res2[$i]['user_id'];
				}else{
				 $sum2 .= $res2[$i]['user_id'].',';
				}
			}
			$arr2=$sum2;
			if($arr2){ 
			$l2="select count(*) from user where user_id in (".$arr2.")". 'and login_time between '.$now.'-24*5*3600'.' and '.$now.'-24*4*3600';
			$ll2=$m->query($l2);
			$row2=round($ll2['0']['count(*)']/$count2*'100%',0);
			$q2="select count(*) from user where user_id in (".$arr2.")". 'and login_time between '.$now.' and '.$now.'+24*3600';
			$qq2=$m->query($q2);
			$a2=round($qq2['0']['count(*)']/$count2*'100%',0);
			$s2="select count(*) from user where user_id in (".$arr2.")". 'and login_time between '.$now.'+24*23*3600'.' and '.$now.'+24*24*3600';
			$ss2=$m->query($s2);
			$b2=round($ss2['0']['count(*)']/$count2*'100%',0);
			}
			else{
				$row2=0;
				$a2=0;
				$b2=0;
			}
			
			$sum1="";
			$count1=count($res1);
			for($i = 0; $i < $count1; $i++){
				if(($i+1)==$count1){
				$sum1 .= $res1[$i]['user_id'];
				}else{
				 $sum1 .= $res1[$i]['user_id'].',';
				}
			}
			$arr1=$sum1;
			if($arr1){
			$l1="select count(*) from user where user_id in (".$arr1.")". 'and login_time between '.$now.'-24*6*3600'.' and '.$now.'-24*5*3600';
			$ll1=$m->query($l1);
			$row1=round($ll1['0']['count(*)']/$count1*'100%',0);
			$q1="select count(*) from user where user_id in (".$arr1.")". 'and login_time between '.$now.'-24*3600'.' and '.$now;
			$qq1=$m->query($q1);
			$a1=round($qq1['0']['count(*)']/$count1*'100%',0);
			$s1="select count(*) from user where user_id in (".$arr1.")". 'and login_time between '.$now.'+24*22*3600'.' and '.$now.'+24*23*3600';
			$ss1=$m->query($s1);
			$b1=round($ss1['0']['count(*)']/$count1*'100%',0);
			}
			else{
				$row1=0;
				$a1=0;
				$b1=0;
			}
			
			$sum4="";
			$count4=count($res4);
			for($i = 0; $i < $count4; $i++){
				if(($i+1)==$count4){
				$sum4 .= $res4[$i]['user_id'];
				}else{
				 $sum4 .= $res4[$i]['user_id'].',';
				}
			}
			$arr4=$sum4;
			if($arr4){
			$l4="select count(*) from user where user_id in (".$arr4.")". 'and login_time between '.$now.'-24*3*3600'.' and '.$now.'-24*2*3600';
			$ll4=$m->query($l4);
			$row4=round($ll4['0']['count(*)']/$count4*'100%',0);
			$q4="select count(*) from user where user_id in (".$arr4.")". 'and login_time between '.$now.'+24*2*3600'.' and '.$now.'+24*3*3600';
			$qq4=$m->query($q4);
			$a4=round($qq4['0']['count(*)']/$count4*'100%',0);
			$s4="select count(*) from user where user_id in (".$arr4.")". 'and login_time between '.$now.'+24*25*3600'.' and '.$now.'+24*26*3600';
			$ss4=$m->query($s4);
			$b4=round($ss4['0']['count(*)']/$count4*'100%',0);
			}
			else{
				$row4=0;
				$a4=0;
				$b4=0;
			}
			
			$sum5="";
			$count5=count($res5);
			for($i = 0; $i < $count5; $i++){
				if(($i+1)==$count5){
				$sum5 .= $res5[$i]['user_id'];
				}else{
				 $sum5 .= $res5[$i]['user_id'].',';
				}
			}
			$arr5=$sum5;
			if($arr5){
			$l5="select count(*) from user where user_id in (".$arr5.")". 'and login_time between '.$now.'-24*2*3600'.' and '.$now.'-24*3600';
			$ll5=$m->query($l5);
			
			$row5=round($ll5['0']['count(*)']/$count5*'100%',0);
			$q5="select count(*) from user where user_id in (".$arr5.")". 'and login_time between '.$now.'+24*3*3600'.' and '.$now.'+24*4*3600';
			$qq5=$m->query($q5);
			$a5=round($qq5['0']['count(*)']/$count5*'100%',0);
			$s5="select count(*) from user where user_id in (".$arr5.")". 'and login_time between '.$now.'+24*26*3600'.' and '.$now.'+24*27*3600';
			$ss5=$m->query($s5);
			$b5=round($ss5['0']['count(*)']/$count5*'100%',0);
			}else{
				$row5=0;
				$a5=0;
				$b5=0;
			}
			
			$sum6="";
			$count6=count($res6);
			for($i = 0; $i < $count6; $i++){
				if(($i+1)==$count6){
				$sum6 .= $res6[$i]['user_id'];
				}else{
				 $sum6 .= $res6[$i]['user_id'].',';
				}
			}
			$arr6=$sum6;
			if($arr6){
			$l6="select count(*) from user where user_id in (".$arr6.")". 'and login_time between '.$now.'-24*3600'.' and '.$now;
			$ll6=$m->query($l6);
			
			$row6=round($ll6['0']['count(*)']/$count6*'100%',0);
			$q6="select count(*) from user where user_id in (".$arr6.")". 'and login_time between '.$now.'+24*4*3600'.' and '.$now.'+24*5*3600';
			$qq6=$m->query($q6);
			$a6=round($qq6['0']['count(*)']/$count6*'100%',0);
			$s6="select count(*) from user where user_id in (".$arr6.")". 'and login_time between '.$now.'+24*27*3600'.' and '.$now.'+24*28*3600';
			$ss6=$m->query($s6);
			$b6=round($ss6['0']['count(*)']/$count6*'100%',0);
			}else{
				$row6=0;
				$a6=0;
				$b6=0;
			}
			
			$sum7="";
			$count7=count($res7);
			for($i = 0; $i < $count7; $i++){
				if(($i+1)==$count7){
				$sum7 .= $res7[$i]['user_id'];
				}else{
				 $sum7 .= $res7[$i]['user_id'].',';
				}
			}
			$arr7=$sum7;
			if($arr7){
			$l7="select count(*) from user where user_id in (".$arr7.")". 'and login_time between '.$now.' and '.$now.'+24*3600';
			$ll7=$m->query($l7);
			
			$row7=round($ll7['0']['count(*)']/$count7*'100%',0);
			$q7="select count(*) from user where user_id in (".$arr7.")". 'and login_time between '.$now.'+24*5*3600'.' and '.$now.'+24*6*3600';
			$qq7=$m->query($q7);
			$a7=round($qq7['0']['count(*)']/$count7*'100%',0);
			$s7="select count(*) from user where user_id in (".$arr7.")". 'and login_time between '.$now.'+24*28*3600'.' and '.$now.'+24*29*3600';
			$ss7=$m->query($s7);
			$b7=round($ss7['0']['count(*)']/$count7*'100%',0);
			}
			else{
				$row7=0;
				$a7=0;
				$b7=0;
			}
			
			$arr1=array($row1,$row2,$row3,$row4,$row5,$row6,$row7);
			$arr2=array($a1,$a2,$a3,$a4,$a5,$a6,$a7);
			$arr3=array($b1,$b2,$b3,$b4,$b5,$b6,$b7);
			$arr['arr1']=$arr1;
			$arr['arr2']=$arr2;
			$arr['arr3']=$arr3;
			dump($arr);
			$this->assign('arr',$arr);
			$this->display('Data/lvecharts');
			break;
			case '1':
			$sql1="select user_id from user where time between ".$jiu.' and '.$now;
			$sql2="select user_id from user where time between ".$jiu.'+24*3600'.' and '.$now.'+24*3600';
			$sql3="select user_id from user where time between ".$jiu.'+24*2*3600'.' and '.$now.'+24*2*3600';
			$sql4="select user_id from user where time between ".$jiu.'+24*3*3600'.' and '.$now.'+24*3*3600';
			$sql5="select user_id from user where time between ".$jiu.'+24*4*3600'.' and '.$now.'+24*4*3600';
			$sql6="select user_id from user where time between ".$jiu.'+24*5*3600'.' and '.$now.'+24*5*3600';
			$sql7="select user_id from user where time between ".$jiu.'+24*6*3600'.' and '.$now.'+24*6*3600';
			$res1=$m->query($sql1);
			$res2=$m->query($sql2);
			$res3=$m->query($sql3);
			$res4=$m->query($sql4);
			$res5=$m->query($sql5);
			$res6=$m->query($sql6);
			$res7=$m->query($sql7);
			$sum3="";
			$count3=count($res3);
			for($i = 0; $i < $count3; $i++){
				if(($i+1)==$count3){
				$sum3 .= $res3[$i]['user_id'];
				}else{
				 $sum3 .= $res3[$i]['user_id'].',';
				}
			}
			$arr3=$sum3;
			if($arr3){
			$l3="select count(*) from user where user_id in (".$arr3.")". 'and login_time between '.$now.'+24*2*3600'.' and '.$now.'+24*3*3600';
			$ll3=$m->query($l3);
			$q3="select count(*) from user where user_id in (".$arr3.")". 'and login_time between '.$now.'+24*7*3600'.' and '.$now.'+24*8*3600';
			$qq3=$m->query($q3);
			$row3=round($ll3['0']['count(*)']/$count3*'100%',0);
			$a3=round($qq3['0']['count(*)']/$count3*'100%',0);
			$s3="select count(*) from user where user_id in (".$arr3.")". 'and login_time between '.$now.'+24*30*3600'.' and '.$now.'+24*31*3600';
			$ss3=$m->query($s3);
			$b3=round($ss3['0']['count(*)']/$count3*'100%',0);
			}else{
				$row3=0;
				$a3=0;
				$b3=0;
			}
			
			$sum2="";
			$count2=count($res2);
			for($i = 0; $i < $count2; $i++){
				if(($i+1)==$count2){
				$sum2 .= $res2[$i]['user_id'];
				}else{
				 $sum2 .= $res2[$i]['user_id'].',';
				}
			}
			$arr2=$sum2;
			if($arr2){
			$l2="select count(*) from user where user_id in (".$arr2.")". 'and login_time between '.$now.'+24*3600'.' and '.$now.'+24*2*3600';
			$ll2=$m->query($l2);
			$row2=round($ll2['0']['count(*)']/$count2*'100%',0);
			$q2="select count(*) from user where user_id in (".$arr2.")". 'and login_time between '.$now.'+24*6*3600'.' and '.$now.'+24*7*3600';
			$qq2=$m->query($q2);
			$a2=round($qq2['0']['count(*)']/$count2*'100%',0);
			$s2="select count(*) from user where user_id in (".$arr2.")". 'and login_time between '.$now.'+24*29*3600'.' and '.$now.'+24*30*3600';
			$ss2=$m->query($s2);
			$b2=round($ss2['0']['count(*)']/$count2*'100%',0);
			}
			else{
				$row2=0;
				$a2=0;
				$b2=0;
			}
			
			$sum1="";
			$count1=count($res1);
			for($i = 0; $i < $count1; $i++){
				if(($i+1)==$count1){
				$sum1 .= $res1[$i]['user_id'];
				}else{
				 $sum1 .= $res1[$i]['user_id'].',';
				}
			}
			$arr1=$sum1;
			if($arr1){
			$l1="select count(*) from user where user_id in (".$arr1.")". 'and login_time between '.$now.' and '.$now.'+24*3600';
			$ll1=$m->query($l1);
			$row1=round($ll1['0']['count(*)']/$count1*'100%',0);
			$q1="select count(*) from user where user_id in (".$arr1.")". 'and login_time between '.$now.'+24*5*3600'.' and '.$now.'+24*6*3600';
			$qq1=$m->query($q1);
			$a1=round($qq1['0']['count(*)']/$count1*'100%',0);
			$s1="select count(*) from user where user_id in (".$arr1.")". 'and login_time between '.$now.'+24*28*3600'.' and '.$now.'+24*29*3600';
			$ss1=$m->query($s1);
			$b1=round($ss1['0']['count(*)']/$count1*'100%',0);
			}
			else{
				$row1=0;
				$a1=0;
				$b1=0;
			}
			
			$sum4="";
			$count4=count($res4);
			for($i = 0; $i < $count4; $i++){
				if(($i+1)==$count4){
				$sum4 .= $res4[$i]['user_id'];
				}else{
				 $sum4 .= $res4[$i]['user_id'].',';
				}
			}
			$arr4=$sum4;
			if($arr4){
			$l4="select count(*) from user where user_id in (".$arr4.")". 'and login_time between '.$now.'+24*3*3600'.' and '.$now.'+24*4*3600';
			$ll4=$m->query($l4);
			$row4=round($ll4['0']['count(*)']/$count4*'100%',0);
			$q4="select count(*) from user where user_id in (".$arr4.")". 'and login_time between '.$now.'+24*8*3600'.' and '.$now.'+24*9*3600';
			$qq4=$m->query($q4);
			$a4=round($qq4['0']['count(*)']/$count4*'100%',0);
			$s4="select count(*) from user where user_id in (".$arr4.")". 'and login_time between '.$now.'+24*31*3600'.' and '.$now.'+24*32*3600';
			$ss4=$m->query($s4);
			$b4=round($ss4['0']['count(*)']/$count4*'100%',0);
			}
			else{
				$row4=0;
				$a4=0;
				$b4=0;
			}
			
			$sum5="";
			$count5=count($res5);
			for($i = 0; $i < $count5; $i++){
				if(($i+1)==$count5){
				$sum5 .= $res5[$i]['user_id'];
				}else{
				 $sum5 .= $res5[$i]['user_id'].',';
				}
			}
			$arr5=$sum5;
			if($arr5){
			$l5="select count(*) from user where user_id in (".$arr5.")". 'and login_time between '.$now.'+24*4*3600'.' and '.$now.'+24*5*3600';
			$ll5=$m->query($l5);
			
			$row5=round($ll5['0']['count(*)']/$count5*'100%',0);
			$q5="select count(*) from user where user_id in (".$arr5.")". 'and login_time between '.$now.'+24*9*3600'.' and '.$now.'+24*10*3600';
			$qq5=$m->query($q5);
			$a5=round($qq5['0']['count(*)']/$count5*'100%',0);
			$s5="select count(*) from user where user_id in (".$arr5.")". 'and login_time between '.$now.'+24*32*3600'.' and '.$now.'+24*33*3600';
			$ss5=$m->query($s5);
			$b5=round($ss5['0']['count(*)']/$count5*'100%',0);
			}else{
				$row5=0;
				$a5=0;
				$b5=0;
			}
			
			$sum6="";
			$count6=count($res6);
			for($i = 0; $i < $count6; $i++){
				if(($i+1)==$count6){
				$sum6 .= $res6[$i]['user_id'];
				}else{
				 $sum6 .= $res6[$i]['user_id'].',';
				}
			}
			$arr6=$sum6;
			if($arr6){
			$l6="select count(*) from user where user_id in (".$arr6.")". 'and login_time between '.$now.'+24*5*3600'.' and '.$now.'+24*6*3600';
			$ll6=$m->query($l6);
			
			$row6=round($ll6['0']['count(*)']/$count6*'100%',0);
			$q6="select count(*) from user where user_id in (".$arr6.")". 'and login_time between '.$now.'+24*10*3600'.' and '.$now.'+24*11*3600';
			$qq6=$m->query($q6);
			$a6=round($qq6['0']['count(*)']/$count6*'100%',0);
			$s6="select count(*) from user where user_id in (".$arr6.")". 'and login_time between '.$now.'+24*33*3600'.' and '.$now.'+24*34*3600';
			$ss6=$m->query($s6);
			$b6=round($ss6['0']['count(*)']/$count6*'100%',0);
			}else{
				$row6=0;
				$a6=0;
				$b6=0;
			}
			
			$sum7="";
			$count7=count($res7);
			for($i = 0; $i < $count7; $i++){
				if(($i+1)==$count7){
				$sum7 .= $res7[$i]['user_id'];
				}else{
				 $sum7 .= $res7[$i]['user_id'].',';
				}
			}
			$arr7=$sum7;
			if($arr7){
			$l7="select count(*) from user where user_id in (".$arr7.")". 'and login_time between '.$now.'+24*6*3600'.' and '.$now.'+24*7*3600';
			$ll7=$m->query($l7);
			
			$row7=round($ll7['0']['count(*)']/$count7*'100%',0);
			$q7="select count(*) from user where user_id in (".$arr7.")". 'and login_time between '.$now.'+24*11*3600'.' and '.$now.'+24*12*3600';
			$qq7=$m->query($q7);
			$a7=round($qq7['0']['count(*)']/$count7*'100%',0);
			$s7="select count(*) from user where user_id in (".$arr7.")". 'and login_time between '.$now.'+24*34*3600'.' and '.$now.'+24*35*3600';
			$ss7=$m->query($s7);
			$b7=round($ss7['0']['count(*)']/$count7*'100%',0);
			}
			else{
				$row7=0;
				$a7=0;
				$b7=0;
			}
			
			$arr1=array($row1,$row2,$row3,$row4,$row5,$row6,$row7);
			$arr2=array($a1,$a2,$a3,$a4,$a5,$a6,$a7);
			$arr3=array($b1,$b2,$b3,$b4,$b5,$b6,$b7);
			$arr['arr1']=$arr1;
			$arr['arr2']=$arr2;
			$arr['arr3']=$arr3;
			dump($arr);
			$this->assign('arr',$arr);
			$this->display('Data/lvecharts');
			break;
			case '2':
			$sql2="select user_id from user where time between ".$jiu.' and '.$now;
			$sql1="select user_id from user where time between ".$jiu.'-24*3600'.' and '.$now.'-24*3600';
			$sql3="select user_id from user where time between ".$jiu.'+24*3600'.' and '.$now.'+24*3600';
			$sql4="select user_id from user where time between ".$jiu.'+24*2*2600'.' and '.$now.'+24*3*3600';
			$sql5="select user_id from user where time between ".$jiu.'+24*3*3600'.' and '.$now.'+23*4*3600';
			$sql6="select user_id from user where time between ".$jiu.'+24*4*3600'.' and '.$now.'+24*4*3600';
			$sql7="select user_id from user where time between ".$jiu.'+24*5*3500'.' and '.$now.'+24*6*3600';
			$res1=$m->query($sql1);
			$res2=$m->query($sql2);
			$res3=$m->query($sql3);
			$res4=$m->query($sql4);
			$res5=$m->query($sql5);
			$res6=$m->query($sql6);
			$res7=$m->query($sql7);
			$sum3="";
			$count3=count($res3);
			for($i = 0; $i < $count3; $i++){
				if(($i+1)==$count3){
				$sum3 .= $res3[$i]['user_id'];
				}else{
				 $sum3 .= $res3[$i]['user_id'].',';
				}
			}
			$arr3=$sum3;
			if($arr3){
			$l3="select count(*) from user where user_id in (".$arr3.")". 'and login_time between '.$now.'+24*3600'.' and '.$now.'+24*2*3600';
			$ll3=$m->query($l3);
			$q3="select count(*) from user where user_id in (".$arr3.")". 'and login_time between '.$now.'+24*6*3600'.' and '.$now.'+24*7*3600';
			$qq3=$m->query($q3);
			$row3=round($ll3['0']['count(*)']/$count3*'100%',0);
			$a3=round($qq3['0']['count(*)']/$count3*'100%',0);
			$s3="select count(*) from user where user_id in (".$arr3.")". 'and login_time between '.$now.'+24*29*3600'.' and '.$now.'+24*30*3600';
			$ss3=$m->query($s3);
			$b3=round($ss3['0']['count(*)']/$count3*'100%',0);
			}else{
				$row3=0;
				$a3=0;
				$b3=0;
			}
			
			$sum2="";
			$count2=count($res2);
			for($i = 0; $i < $count2; $i++){
				if(($i+1)==$count2){
				$sum2 .= $res2[$i]['user_id'];
				}else{
				 $sum2 .= $res2[$i]['user_id'].',';
				}
			}
			$arr2=$sum2;
			if($arr2){
			$l2="select count(*) from user where user_id in (".$arr2.")". 'and login_time between '.$now.' and '.$now.'+24*3600';
			$ll2=$m->query($l2);
			$row2=round($ll2['0']['count(*)']/$count2*'100%',0);
			$q2="select count(*) from user where user_id in (".$arr2.")". 'and login_time between '.$now.'+24*5*3600'.' and '.$now.'+24*6*3600';
			$qq2=$m->query($q2);
			$a2=round($qq2['0']['count(*)']/$count2*'100%',0);
			$s2="select count(*) from user where user_id in (".$arr2.")". 'and login_time between '.$now.'+24*28*3600'.' and '.$now.'+24*29*3600';
			$ss2=$m->query($s2);
			$b2=round($ss2['0']['count(*)']/$count2*'100%',0);
			}
			else{
				$row2=0;
				$a2=0;
				$b2=0;
			}
			
			$sum1="";
			$count1=count($res1);
			for($i = 0; $i < $count1; $i++){
				if(($i+1)==$count1){
				$sum1 .= $res1[$i]['user_id'];
				}else{
				 $sum1 .= $res1[$i]['user_id'].',';
				}
			}
			$arr1=$sum1;
			if($arr1){
			$l1="select count(*) from user where user_id in (".$arr1.")". 'and login_time between '.$now.'-24*3600'.' and '.$now;
			$ll1=$m->query($l1);
			$row1=round($ll1['0']['count(*)']/$count1*'100%',0);
			$q1="select count(*) from user where user_id in (".$arr1.")". 'and login_time between '.$now.'+24*4*3600'.' and '.$now.'+24*5*3600';
			$qq1=$m->query($q1);
			$a1=round($qq1['0']['count(*)']/$count1*'100%',0);
			$s1="select count(*) from user where user_id in (".$arr1.")". 'and login_time between '.$now.'+24*27*3600'.' and '.$now.'+24*28*3600';
			$ss1=$m->query($s1);
			$b1=round($ss1['0']['count(*)']/$count1*'100%',0);
			}
			else{
				$row1=0;
				$a1=0;
				$b1=0;
			}
			
			$sum4="";
			$count4=count($res4);
			for($i = 0; $i < $count4; $i++){
				if(($i+1)==$count4){
				$sum4 .= $res4[$i]['user_id'];
				}else{
				 $sum4 .= $res4[$i]['user_id'].',';
				}
			}
			$arr4=$sum4;
			if($arr4){
			$l4="select count(*) from user where user_id in (".$arr4.")". 'and login_time between '.$now.'+24*2*3600'.' and '.$now.'+24*3*3600';
			$ll4=$m->query($l4);
			$row4=round($ll4['0']['count(*)']/$count4*'100%',0);
			$q4="select count(*) from user where user_id in (".$arr4.")". 'and login_time between '.$now.'+24*7*3600'.' and '.$now.'+24*8*3600';
			$qq4=$m->query($q4);
			$a4=round($qq4['0']['count(*)']/$count4*'100%',0);
			$s4="select count(*) from user where user_id in (".$arr4.")". 'and login_time between '.$now.'+24*30*3600'.' and '.$now.'+24*31*3600';
			$ss4=$m->query($s4);
			$b4=round($ss4['0']['count(*)']/$count4*'100%',0);
			}
			else{
				$row4=0;
				$a4=0;
				$b4=0;
			}
			
			$sum5="";
			$count5=count($res5);
			for($i = 0; $i < $count5; $i++){
				if(($i+1)==$count5){
				$sum5 .= $res5[$i]['user_id'];
				}else{
				 $sum5 .= $res5[$i]['user_id'].',';
				}
			}
			$arr5=$sum5;
			if($arr5){
			$l5="select count(*) from user where user_id in (".$arr5.")". 'and login_time between '.$now.'+24*3*3600'.' and '.$now.'+24*4*3600';
			$ll5=$m->query($l5);
			
			$row5=round($ll5['0']['count(*)']/$count5*'100%',0);
			$q5="select count(*) from user where user_id in (".$arr5.")". 'and login_time between '.$now.'+24*8*3600'.' and '.$now.'+24*9*3600';
			$qq5=$m->query($q5);
			$a5=round($qq5['0']['count(*)']/$count5*'100%',0);
			$s5="select count(*) from user where user_id in (".$arr5.")". 'and login_time between '.$now.'+24*31*3600'.' and '.$now.'+24*32*3600';
			$ss5=$m->query($s5);
			$b5=round($ss5['0']['count(*)']/$count5*'100%',0);
			}else{
				$row5=0;
				$a5=0;
				$b5=0;
			}
			
			$sum6="";
			$count6=count($res6);
			for($i = 0; $i < $count6; $i++){
				if(($i+1)==$count6){
				$sum6 .= $res6[$i]['user_id'];
				}else{
				 $sum6 .= $res6[$i]['user_id'].',';
				}
			}
			$arr6=$sum6;
			if($arr6){
			$l6="select count(*) from user where user_id in (".$arr6.")". 'and login_time between '.$now.'+24*4*3600'.' and '.$now.'+24*5*3600';
			$ll6=$m->query($l6);
			
			$row6=round($ll6['0']['count(*)']/$count6*'100%',0);
			$q6="select count(*) from user where user_id in (".$arr6.")". 'and login_time between '.$now.'+24*9*3600'.' and '.$now.'+24*10*3600';
			$qq6=$m->query($q6);
			$a6=round($qq6['0']['count(*)']/$count6*'100%',0);
			$s6="select count(*) from user where user_id in (".$arr6.")". 'and login_time between '.$now.'+24*32*3600'.' and '.$now.'+24*33*3600';
			$ss6=$m->query($s6);
			$b6=round($ss6['0']['count(*)']/$count6*'100%',0);
			}else{
				$row6=0;
				$a6=0;
				$b6=0;
			}
			
			$sum7="";
			$count7=count($res7);
			for($i = 0; $i < $count7; $i++){
				if(($i+1)==$count7){
				$sum7 .= $res7[$i]['user_id'];
				}else{
				 $sum7 .= $res7[$i]['user_id'].',';
				}
			}
			$arr7=$sum7;
			if($arr7){
			$l7="select count(*) from user where user_id in (".$arr7.")". 'and login_time between '.$now.'+24*5*3600'.' and '.$now.'+24*6*3600';
			$ll7=$m->query($l7);
			
			$row7=round($ll7['0']['count(*)']/$count7*'100%',0);
			$q7="select count(*) from user where user_id in (".$arr7.")". 'and login_time between '.$now.'+24*10*3600'.' and '.$now.'+24*11*3600';
			$qq7=$m->query($q7);
			$a7=round($qq7['0']['count(*)']/$count7*'100%',0);
			$s7="select count(*) from user where user_id in (".$arr7.")". 'and login_time between '.$now.'+24*33*3600'.' and '.$now.'+24*34*3600';
			$ss7=$m->query($s7);
			$b7=round($ss7['0']['count(*)']/$count7*'100%',0);
			}
			else{
				$row7=0;
				$a7=0;
				$b7=0;
			}
			
			$arr1=array($row1,$row2,$row3,$row4,$row5,$row6,$row7);
			$arr2=array($a1,$a2,$a3,$a4,$a5,$a6,$a7);
			$arr3=array($b1,$b2,$b3,$b4,$b5,$b6,$b7);
			$arr['arr1']=$arr1;
			$arr['arr2']=$arr2;
			$arr['arr3']=$arr3;
			//dump($arr);
			$this->assign('arr',$arr);
			$this->display('Data/lvecharts');
			break;
			case '3':
			$sql3="select user_id from user where time between ".$jiu.' and '.$now;
			$sql1="select user_id from user where time between ".$jiu.'-24*2*3600'.' and '.$now.'-24*2*3600';
			$sql2="select user_id from user where time between ".$jiu.'-24*3600'.' and '.$now.'-24*3600';
			$sql4="select user_id from user where time between ".$jiu.'+24*3600'.' and '.$now.'+24*3600';
			$sql5="select user_id from user where time between ".$jiu.'+24*2*3600'.' and '.$now.'+22*4*3600';
			$sql6="select user_id from user where time between ".$jiu.'+24*3*3600'.' and '.$now.'+24*3*3600';
			$sql7="select user_id from user where time between ".$jiu.'+24*4*3400'.' and '.$now.'+24*6*3600';
			$res1=$m->query($sql1);
			$res2=$m->query($sql2);
			$res3=$m->query($sql3);
			$res4=$m->query($sql4);
			$res5=$m->query($sql5);
			$res6=$m->query($sql6);
			$res7=$m->query($sql7);
			$sum3="";
			$count3=count($res3);
			for($i = 0; $i < $count3; $i++){
				if(($i+1)==$count3){
				$sum3 .= $res3[$i]['user_id'];
				}else{
				 $sum3 .= $res3[$i]['user_id'].',';
				}
			}
			$arr3=$sum3;
			if($arr3){
			$l3="select count(*) from user where user_id in (".$arr3.")". 'and login_time between '.$now.' and '.$now.'+24*3600';
			$ll3=$m->query($l3);
			$q3="select count(*) from user where user_id in (".$arr3.")". 'and login_time between '.$now.'+24*5*3600'.' and '.$now.'+24*6*3600';
			$qq3=$m->query($q3);
			$row3=round($ll3['0']['count(*)']/$count3*'100%',0);
			$a3=round($qq3['0']['count(*)']/$count3*'100%',0);
			$s3="select count(*) from user where user_id in (".$arr3.")". 'and login_time between '.$now.'+24*28*3600'.' and '.$now.'+24*29*3600';
			$ss3=$m->query($s3);
			$b3=round($ss3['0']['count(*)']/$count3*'100%',0);
			}else{
				$row3=0;
				$a3=0;
				$b3=0;
			}
			
			$sum2="";
			$count2=count($res2);
			for($i = 0; $i < $count2; $i++){
				if(($i+1)==$count2){
				$sum2 .= $res2[$i]['user_id'];
				}else{
				 $sum2 .= $res2[$i]['user_id'].',';
				}
			}
			$arr2=$sum2;
			if($arr2){
			$l2="select count(*) from user where user_id in (".$arr2.")". 'and login_time between '.$jiu.' and '.$now;
			$ll2=$m->query($l2);
			$row2=round($ll2['0']['count(*)']/$count2*'100%',0);
			$q2="select count(*) from user where user_id in (".$arr2.")". 'and login_time between '.$jiu.'+24*5*3600'.' and '.$jiu.'+24*6*3600';
			$qq2=$m->query($q2);
			$a2=round($qq2['0']['count(*)']/$count2*'100%',0);
			$s2="select count(*) from user where user_id in (".$arr2.")". 'and login_time between '.$jiu.'+24*28*3600'.' and '.$jiu.'+24*29*3600';
			$ss2=$m->query($s2);
			$b2=round($ss2['0']['count(*)']/$count2*'100%',0);
			}
			else{
				$row2=0;
				$a2=0;
				$b2=0;
			}
			
			$sum1="";
			$count1=count($res1);
			for($i = 0; $i < $count1; $i++){
				if(($i+1)==$count1){
				$sum1 .= $res1[$i]['user_id'];
				}else{
				 $sum1 .= $res1[$i]['user_id'].',';
				}
			}
			$arr1=$sum1;
			if($arr1){
			$l1="select count(*) from user where user_id in (".$arr1.")". 'and login_time between '.$jiu.'-24*3600'.' and '.$now.'-24*3600';
			$ll1=$m->query($l1);
			$row1=round($ll1['0']['count(*)']/$count1*'100%',0);
			$q1="select count(*) from user where user_id in (".$arr1.")". 'and login_time between '.$jiu.'+24*4*3600'.' and '.$jiu.'+24*5*3600';
			$qq1=$m->query($q1);
			$a1=round($qq1['0']['count(*)']/$count1*'100%',0);
			$s1="select count(*) from user where user_id in (".$arr1.")". 'and login_time between '.$jiu.'+24*27*3600'.' and '.$jiu.'+24*28*3600';
			$ss1=$m->query($s1);
			$b1=round($ss1['0']['count(*)']/$count1*'100%',0);
			}
			else{
				$row1=0;
				$a1=0;
				$b1=0;
			}
			
			$sum4="";
			$count4=count($res4);
			for($i = 0; $i < $count4; $i++){
				if(($i+1)==$count4){
				$sum4 .= $res4[$i]['user_id'];
				}else{
				 $sum4 .= $res4[$i]['user_id'].',';
				}
			}
			$arr4=$sum4;
			if($arr4){
			$l4="select count(*) from user where user_id in (".$arr4.")". 'and login_time between '.$now.'+24*3600'.' and '.$now.'+24*2*3600';
			$ll4=$m->query($l4);
			$row4=round($ll4['0']['count(*)']/$count4*'100%',0);
			$q4="select count(*) from user where user_id in (".$arr4.")". 'and login_time between '.$now.'+24*6*3600'.' and '.$now.'+24*7*3600';
			$qq4=$m->query($q4);
			$a4=round($qq4['0']['count(*)']/$count4*'100%',0);
			$s4="select count(*) from user where user_id in (".$arr4.")". 'and login_time between '.$now.'+24*29*3600'.' and '.$now.'+24*30*3600';
			$ss4=$m->query($s4);
			$b4=round($ss4['0']['count(*)']/$count4*'100%',0);
			}
			else{
				$row4=0;
				$a4=0;
				$b4=0;
			}
			
			$sum5="";
			$count5=count($res5);
			for($i = 0; $i < $count5; $i++){
				if(($i+1)==$count5){
				$sum5 .= $res5[$i]['user_id'];
				}else{
				 $sum5 .= $res5[$i]['user_id'].',';
				}
			}
			$arr5=$sum5;
			if($arr5){
			$l5="select count(*) from user where user_id in (".$arr5.")". 'and login_time between '.$now.'+24*2*3600'.' and '.$now.'+24*3*3600';
			$ll5=$m->query($l5);
			
			$row5=round($ll5['0']['count(*)']/$count5*'100%',0);
			$q5="select count(*) from user where user_id in (".$arr5.")". 'and login_time between '.$now.'+24*7*3600'.' and '.$now.'+24*8*3600';
			$qq5=$m->query($q5);
			$a5=round($qq5['0']['count(*)']/$count5*'100%',0);
			$s5="select count(*) from user where user_id in (".$arr5.")". 'and login_time between '.$now.'+24*30*3600'.' and '.$now.'+24*31*3600';
			$ss5=$m->query($s5);
			$b5=round($ss5['0']['count(*)']/$count5*'100%',0);
			}else{
				$row5=0;
				$a5=0;
				$b5=0;
			}
			
			$sum6="";
			$count6=count($res6);
			for($i = 0; $i < $count6; $i++){
				if(($i+1)==$count6){
				$sum6 .= $res6[$i]['user_id'];
				}else{
				 $sum6 .= $res6[$i]['user_id'].',';
				}
			}
			$arr6=$sum6;
			if($arr6){
			$l6="select count(*) from user where user_id in (".$arr6.")". 'and login_time between '.$now.'+24*3*3600'.' and '.$now.'+24*4*3600';
			$ll6=$m->query($l6);
			
			$row6=round($ll6['0']['count(*)']/$count6*'100%',0);
			$q6="select count(*) from user where user_id in (".$arr6.")". 'and login_time between '.$now.'+24*8*3600'.' and '.$now.'+24*9*3600';
			$qq6=$m->query($q6);
			$a6=round($qq6['0']['count(*)']/$count6*'100%',0);
			$s6="select count(*) from user where user_id in (".$arr6.")". 'and login_time between '.$now.'+24*31*3600'.' and '.$now.'+24*32*3600';
			$ss6=$m->query($s6);
			$b6=round($ss6['0']['count(*)']/$count6*'100%',0);
			}else{
				$row6=0;
				$a6=0;
				$b6=0;
			}
			
			$sum7="";
			$count7=count($res7);
			for($i = 0; $i < $count7; $i++){
				if(($i+1)==$count7){
				$sum7 .= $res7[$i]['user_id'];
				}else{
				 $sum7 .= $res7[$i]['user_id'].',';
				}
			}
			$arr7=$sum7;
			if($arr7){
			$l7="select count(*) from user where user_id in (".$arr7.")". 'and login_time between '.$now.'+24*4*3600'.' and '.$now.'+24*5*3600';
			$ll7=$m->query($l7);
			
			$row7=round($ll7['0']['count(*)']/$count7*'100%',0);
			$q7="select count(*) from user where user_id in (".$arr7.")". 'and login_time between '.$now.'+24*9*3600'.' and '.$now.'+24*10*3600';
			$qq7=$m->query($q7);
			$a7=round($qq7['0']['count(*)']/$count7*'100%',0);
			$s7="select count(*) from user where user_id in (".$arr7.")". 'and login_time between '.$now.'+24*32*3600'.' and '.$now.'+24*33*3600';
			$ss7=$m->query($s7);
			$b7=round($ss7['0']['count(*)']/$count7*'100%',0);
			}
			else{
				$row7=0;
				$a7=0;
				$b7=0;
			}
			
			$arr1=array($row1,$row2,$row3,$row4,$row5,$row6,$row7);
			$arr2=array($a1,$a2,$a3,$a4,$a5,$a6,$a7);
			$arr3=array($b1,$b2,$b3,$b4,$b5,$b6,$b7);
			$arr['arr1']=$arr1;
			$arr['arr2']=$arr2;
			$arr['arr3']=$arr3;
			//dump($arr);
			
			$this->assign('arr',$arr);
			$this->display('Data/lvecharts');
			break;
			case '4':
			$sql4="select user_id from user where time between ".$jiu.' and '.$now;
			$sql3="select user_id from user where time between ".$jiu.'-24*3600'.' and '.$now.'-24*3600';
			$sql2="select user_id from user where time between ".$jiu.'-24*2*3600'.' and '.$now.'-24*2*3600';
			$sql1="select user_id from user where time between ".$jiu.'-24*3*3600'.' and '.$now.'-24*3*3600';
			$sql5="select user_id from user where time between ".$jiu.'+24*3600'.' and '.$now.'+24*3600';
			$sql6="select user_id from user where time between ".$jiu.'+24*2*3600'.' and '.$now.'+24*2*3600';
			$sql7="select user_id from user where time between ".$jiu.'+24*3*3600'.' and '.$now.'+24*3*3600';
			$res1=$m->query($sql1);
			$res2=$m->query($sql2);
			$res3=$m->query($sql3);
			$res4=$m->query($sql4);
			$res5=$m->query($sql5);
			$res6=$m->query($sql6);
			$res7=$m->query($sql7);
			$sum3="";
			$count3=count($res3);
			//echo $count3;
			for($i = 0; $i < $count3; $i++){
				if(($i+1)==$count3){
				$sum3 .= $res3[$i]['user_id'];
				}else{
				 $sum3 .= $res3[$i]['user_id'].',';
				}
			}
			$arr3=$sum3;
			//echo $arr3;
			if($arr3){
			$l3="select count(*) from user where user_id in (".$arr3.")". 'and login_time between '.$now.'-24*3600'.' and '.$now;
			$ll3=$m->query($l3);
			$q3="select count(*) from user where user_id in (".$arr3.")". 'and login_time between '.$now.'+24*4*3600'.' and '.$now.'+24*5*3600';
			$qq3=$m->query($q3);
			$row3=round($ll3['0']['count(*)']/$count3*'100%',0);
			$a3=round($qq3['0']['count(*)']/$count3*'100%',0);
			$s3="select count(*) from user where user_id in (".$arr3.")". 'and login_time between '.$now.'+24*27*3600'.' and '.$now.'+24*28*3600';
			$ss3=$m->query($s3);
			$b3=round($ss3['0']['count(*)']/$count3*'100%',0);
			}else{
				$row3=0;
				$a3=0;
				$b3=0;
			}
			
			$sum2="";
			$count2=count($res2);
			for($i = 0; $i < $count2; $i++){
				if(($i+1)==$count2){
				@$sum2 .= $res2[$i]['user_id'];
				}else{
				 $sum2 .= $res2[$i]['user_id'].',';
				}
			}
			$arr2=$sum2;
			if($arr2){
			$l2="select count(*) from user where user_id in (".$arr2.")". 'and login_time between '.$now.'-24*2*3600'.' and '.$now.'-24*3600';
			$ll2=$m->query($l2);
			$row2=round($ll2['0']['count(*)']/$count2*'100%',0);
			$q2="select count(*) from user where user_id in (".$arr2.")". 'and login_time between '.$now.'+24*3*3600'.' and '.$now.'+24*4*3600';
			$qq2=$m->query($q2);
			$a2=round($qq2['0']['count(*)']/$count2*'100%',0);
			$s2="select count(*) from user where user_id in (".$arr2.")". 'and login_time between '.$now.'+24*26*3600'.' and '.$now.'+24*27*3600';
			$ss2=$m->query($s2);
			$b2=round($ss2['0']['count(*)']/$count2*'100%',0);
			}
			else{
				$row2=0;
				$a2=0;
				$b2=0;
			}
			
			$sum1="";
			$count1=count($res1);
			for($i = 0; $i < $count1; $i++){
				if(($i+1)==$count1){
				$sum1 .= $res1[$i]['user_id'];
				}else{
				 $sum1 .= $res1[$i]['user_id'].',';
				}
			}
			$arr1=$sum1;
			if($arr1){
			$l1="select count(*) from user where user_id in (".$arr1.")". 'and login_time between '.$now.'-24*3*3600'.' and '.$now.'-24*2*3600';
			$ll1=$m->query($l1);
			$row1=round($ll1['0']['count(*)']/$count1*'100%',0);
			$q1="select count(*) from user where user_id in (".$arr1.")". 'and login_time between '.$now.'+24*2*3600'.' and '.$now.'+24*3*3600';
			$qq1=$m->query($q1);
			$a1=round($qq1['0']['count(*)']/$count1*'100%',0);
			$s1="select count(*) from user where user_id in (".$arr1.")". 'and login_time between '.$now.'+24*25*3600'.' and '.$now.'+24*26*3600';
			$ss1=$m->query($s1);
			$b1=round($ss1['0']['count(*)']/$count1*'100%',0);
			}
			else{
				$row1=0;
				$a1=0;
				$b1=0;
			}
			
			$sum4="";
			$count4=count($res4);
			for($i = 0; $i < $count4; $i++){
				if(($i+1)==$count4){
				$sum4 .= $res4[$i]['user_id'];
				}else{
				 $sum4 .= $res4[$i]['user_id'].',';
				}
			}
			$arr4=$sum4;
			if($arr4){
			$l4="select count(*) from user where user_id in (".$arr4.")". 'and login_time between '.$now.' and '.$now.'+24*3600';
			$ll4=$m->query($l4);
			$row4=round($ll4['0']['count(*)']/$count4*'100%',0);
			$q4="select count(*) from user where user_id in (".$arr4.")". 'and login_time between '.$now.'+24*5*3600'.' and '.$now.'+24*6*3600';
			$qq4=$m->query($q4);
			$a4=round($qq4['0']['count(*)']/$count4*'100%',0);
			$s4="select count(*) from user where user_id in (".$arr4.")". 'and login_time between '.$now.'+24*28*3600'.' and '.$now.'+24*29*3600';
			$ss4=$m->query($s4);
			$b4=round($ss4['0']['count(*)']/$count4*'100%',0);
			}
			else{
				$row4=0;
				$a4=0;
				$b4=0;
			}
			
			$sum5="";
			$count5=count($res5);
			for($i = 0; $i < $count5; $i++){
				if(($i+1)==$count5){
				$sum5 .= $res5[$i]['user_id'];
				}else{
				 $sum5 .= $res5[$i]['user_id'].',';
				}
			}
			$arr5=$sum5;
			if($arr5){
			$l5="select count(*) from user where user_id in (".$arr5.")". 'and login_time between '.$now.'+24*3600'.' and '.$now.'+24*2*3600';
			$ll5=$m->query($l5);
			
			$row5=round($ll5['0']['count(*)']/$count5*'100%',0);
			$q5="select count(*) from user where user_id in (".$arr5.")". 'and login_time between '.$now.'+24*6*3600'.' and '.$now.'+24*7*3600';
			$qq5=$m->query($q5);
			$a5=round($qq5['0']['count(*)']/$count5*'100%',0);
			$s5="select count(*) from user where user_id in (".$arr5.")". 'and login_time between '.$now.'+24*29*3600'.' and '.$now.'+24*30*3600';
			$ss5=$m->query($s5);
			$b5=round($ss5['0']['count(*)']/$count5*'100%',0);
			}else{
				$row5=0;
				$a5=0;
				$b5=0;
			}
			
			$sum6="";
			$count6=count($res6);
			for($i = 0; $i < $count6; $i++){
				if(($i+1)==$count6){
				$sum6 .= $res6[$i]['user_id'];
				}else{
				 $sum6 .= $res6[$i]['user_id'].',';
				}
			}
			$arr6=$sum6;
			if($arr6){
			$l6="select count(*) from user where user_id in (".$arr6.")". 'and login_time between '.$now.'+24*2*3600'.' and '.$now.'+24*3*3600';
			$ll6=$m->query($l6);
			
			$row6=round($ll6['0']['count(*)']/$count6*'100%',0);
			$q6="select count(*) from user where user_id in (".$arr6.")". 'and login_time between '.$now.'+24*7*3600'.' and '.$now.'+24*8*3600';
			$qq6=$m->query($q6);
			$a6=round($qq6['0']['count(*)']/$count6*'100%',0);
			$s6="select count(*) from user where user_id in (".$arr6.")". 'and login_time between '.$now.'+24*30*3600'.' and '.$now.'+24*31*3600';
			$ss6=$m->query($s6);
			$b6=round($ss6['0']['count(*)']/$count6*'100%',0);
			}else{
				$row6=0;
				$a6=0;
				$b6=0;
			}
			
			$sum7="";
			$count7=count($res7);
			for($i = 0; $i < $count7; $i++){
				if(($i+1)==$count7){
				$sum7 .= $res7[$i]['user_id'];
				}else{
				 $sum7 .= $res7[$i]['user_id'].',';
				}
			}
			$arr7=$sum7;
			if($arr7){
			$l7="select count(*) from user where user_id in (".$arr7.")". 'and login_time between '.$now.'+24*3*3600'.' and '.$now.'+24*4*3600';
			$ll7=$m->query($l7);
			
			$row7=round($ll7['0']['count(*)']/$count7*'100%',0);
			$q7="select count(*) from user where user_id in (".$arr7.")". 'and login_time between '.$now.'+24*8*3600'.' and '.$now.'+24*9*3600';
			$qq7=$m->query($q7);
			$a7=round($qq7['0']['count(*)']/$count7*'100%',0);
			$s7="select count(*) from user where user_id in (".$arr7.")". 'and login_time between '.$now.'+24*31*3600'.' and '.$now.'+24*32*3600';
			$ss7=$m->query($s7);
			$b7=round($ss7['0']['count(*)']/$count7*'100%',0);
			}
			else{
				$row7=0;
				$a7=0;
				$b7=0;
			}
			
			$arr1=array($row1,$row2,$row3,$row4,$row5,$row6,$row7);
			$arr2=array($a1,$a2,$a3,$a4,$a5,$a6,$a7);
			$arr3=array($b1,$b2,$b3,$b4,$b5,$b6,$b7);
			$arr['arr1']=$arr1;
			$arr['arr2']=$arr2;
			$arr['arr3']=$arr3;
			//dump($arr);
			$this->assign('arr',$arr);
			$this->display('Data/lvecharts');
			break;
			case '5':
			$sql5="select user_id from user where time between ".$jiu.' and '.$now;
			$sql4="select user_id from user where time between ".$jiu.'-24*3600'.' and '.$now.'-24*3600';
			$sql3="select user_id from user where time between ".$jiu.'-24*2*3600'.' and '.$now.'-24*2*3600';
			$sql2="select user_id from user where time between ".$jiu.'-24*3*3600'.' and '.$now.'-24*3*3600';
			$sql1="select user_id from user where time between ".$jiu.'-24*4*3600'.' and '.$now.'-24*4*3600';
			$sql6="select user_id from user where time between ".$jiu.'+24*3600'.' and '.$now.'+24*3600';
			$sql7="select user_id from user where time between ".$jiu.'+24*2*3600'.' and '.$now.'+24*2*3600';
			$res1=$m->query($sql1);
			$res2=$m->query($sql2);
			$res3=$m->query($sql3);
			$res4=$m->query($sql4);
			$res5=$m->query($sql5);
			$res6=$m->query($sql6);
			$res7=$m->query($sql7);
			$sum3="";
			$count3=count($res3);
			for($i = 0; $i < $count3; $i++){
				if(($i+1)==$count3){
				$sum3 .= $res3[$i]['user_id'];
				}else{
				 $sum3 .= $res3[$i]['user_id'].',';
				}
			}
			$arr3=$sum3;
			if($arr3){
			$l3="select count(*) from user where user_id in (".$arr3.")". 'and login_time between '.$now.'-24*2*3600'.' and '.$now.'-24*3600';
			$ll3=$m->query($l3);
			$q3="select count(*) from user where user_id in (".$arr3.")". 'and login_time between '.$now.'+24*3*3600'.' and '.$now.'+24*4*3600';
			$qq3=$m->query($q3);
			$row3=round($ll3['0']['count(*)']/$count3*'100%',0);
			$a3=round($qq3['0']['count(*)']/$count3*'100%',0);
			$s3="select count(*) from user where user_id in (".$arr3.")". 'and login_time between '.$now.'+24*26*3600'.' and '.$now.'+24*27*3600';
			$ss3=$m->query($s3);
			$b3=round($ss3['0']['count(*)']/$count3*'100%',0);
			}else{
				$row3=0;
				$a3=0;
				$b3=0;
			}
			
			$sum2="";
			$count2=count($res2);
			for($i = 0; $i < $count2; $i++){
				if(($i+1)==$count2){
				$sum2 .= $res2[$i]['user_id'];
				}else{
				 $sum2 .= $res2[$i]['user_id'].',';
				}
			}
			$arr2=$sum2;
			if($arr2){
			$l2="select count(*) from user where user_id in (".$arr2.")". 'and login_time between '.$now.'-24*3*3600'.' and '.$now.'-24*2*3600';
			$ll2=$m->query($l2);
			$row2=round($ll2['0']['count(*)']/$count2*'100%',0);
			$q2="select count(*) from user where user_id in (".$arr2.")". 'and login_time between '.$now.'+24*2*3600'.' and '.$now.'+24*3*3600';
			$qq2=$m->query($q2);
			$a2=round($qq2['0']['count(*)']/$count2*'100%',0);
			$s2="select count(*) from user where user_id in (".$arr2.")". 'and login_time between '.$now.'+24*25*3600'.' and '.$now.'+24*26*3600';
			$ss2=$m->query($s2);
			$b2=round($ss2['0']['count(*)']/$count2*'100%',0);
			}
			else{
				$row2=0;
				$a2=0;
				$b2=0;
			}
			
			$sum1="";
			$count1=count($res1);
			for($i = 0; $i < $count1; $i++){
				if(($i+1)==$count1){
				$sum1 .= $res1[$i]['user_id'];
				}else{
				 $sum1 .= $res1[$i]['user_id'].',';
				}
			}
			$arr1=$sum1;
			if($arr1){
			$l1="select count(*) from user where user_id in (".$arr1.")". 'and login_time between '.$now.'-24*4*3600'.' and '.$now.'-24*3*3600';
			$ll1=$m->query($l1);
			$row1=round($ll1['0']['count(*)']/$count1*'100%',0);
			$q1="select count(*) from user where user_id in (".$arr1.")". 'and login_time between '.$now.'+24*3600'.' and '.$now.'+24*2*3600';
			$qq1=$m->query($q1);
			$a1=round($qq1['0']['count(*)']/$count1*'100%',0);
			$s1="select count(*) from user where user_id in (".$arr1.")". 'and login_time between '.$now.'+24*24*3600'.' and '.$now.'+24*25*3600';
			$ss1=$m->query($s1);
			$b1=round($ss1['0']['count(*)']/$count1*'100%',0);
			}
			else{
				$row1=0;
				$a1=0;
				$b1=0;
			}
			
			$sum4="";
			$count4=count($res4);
			for($i = 0; $i < $count4; $i++){
				if(($i+1)==$count4){
				$sum4 .= $res4[$i]['user_id'];
				}else{
				 $sum4 .= $res4[$i]['user_id'].',';
				}
			}
			$arr4=$sum4;
			if($arr4){
			$l4="select count(*) from user where user_id in (".$arr4.")". 'and login_time between '.$now.'-24*3600'.' and '.$now;
			$ll4=$m->query($l4);
			$row4=round($ll4['0']['count(*)']/$count4*'100%',0);
			$q4="select count(*) from user where user_id in (".$arr4.")". 'and login_time between '.$now.'+24*4*3600'.' and '.$now.'+24*5*3600';
			$qq4=$m->query($q4);
			$a4=round($qq4['0']['count(*)']/$count4*'100%',0);
			$s4="select count(*) from user where user_id in (".$arr4.")". 'and login_time between '.$now.'+24*27*3600'.' and '.$now.'+24*28*3600';
			$ss4=$m->query($s4);
			$b4=round($ss4['0']['count(*)']/$count4*'100%',0);
			}
			else{
				$row4=0;
				$a4=0;
				$b4=0;
			}
			
			$sum5="";
			$count5=count($res5);
			for($i = 0; $i < $count5; $i++){
				if(($i+1)==$count5){
				$sum5 .= $res5[$i]['user_id'];
				}else{
				 $sum5 .= $res5[$i]['user_id'].',';
				}
			}
			$arr5=$sum5;
			if($arr5){
			$l5="select count(*) from user where user_id in (".$arr5.")". 'and login_time between '.$now.' and '.$now.'+24*3600';
			$ll5=$m->query($l5);
			
			$row5=round($ll5['0']['count(*)']/$count5*'100%',0);
			$q5="select count(*) from user where user_id in (".$arr5.")". 'and login_time between '.$now.'+24*5*3600'.' and '.$now.'+24*6*3600';
			$qq5=$m->query($q5);
			$a5=round($qq5['0']['count(*)']/$count5*'100%',0);
			$s5="select count(*) from user where user_id in (".$arr5.")". 'and login_time between '.$now.'+24*28*3600'.' and '.$now.'+24*29*3600';
			$ss5=$m->query($s5);
			$b5=round($ss5['0']['count(*)']/$count5*'100%',0);
			}else{
				$row5=0;
				$a5=0;
				$b5=0;
			}
			
			$sum6="";
			$count6=count($res6);
			for($i = 0; $i < $count6; $i++){
				if(($i+1)==$count6){
				$sum6 .= $res6[$i]['user_id'];
				}else{
				 $sum6 .= $res6[$i]['user_id'].',';
				}
			}
			$arr6=$sum6;
			if($arr6){
			$l6="select count(*) from user where user_id in (".$arr6.")". 'and login_time between '.$now.'+24*3600'.' and '.$now.'+24*2*3600';
			$ll6=$m->query($l6);
			
			$row6=round($ll6['0']['count(*)']/$count6*'100%',0);
			$q6="select count(*) from user where user_id in (".$arr6.")". 'and login_time between '.$now.'+24*6*3600'.' and '.$now.'+24*7*3600';
			$qq6=$m->query($q6);
			$a6=round($qq6['0']['count(*)']/$count6*'100%',0);
			$s6="select count(*) from user where user_id in (".$arr6.")". 'and login_time between '.$now.'+24*29*3600'.' and '.$now.'+24*30*3600';
			$ss6=$m->query($s6);
			$b6=round($ss6['0']['count(*)']/$count6*'100%',0);
			}else{
				$row6=0;
				$a6=0;
				$b6=0;
			}
			
			$sum7="";
			$count7=count($res7);
			for($i = 0; $i < $count7; $i++){
				if(($i+1)==$count7){
				$sum7 .= $res7[$i]['user_id'];
				}else{
				 $sum7 .= $res7[$i]['user_id'].',';
				}
			}
			$arr7=$sum7;
			if($arr7){
			$l7="select count(*) from user where user_id in (".$arr7.")". 'and login_time between '.$now.'+24*2*3600'.' and '.$now.'+24*3*3600';
			$ll7=$m->query($l7);
			
			$row7=round($ll7['0']['count(*)']/$count7*'100%',0);
			$q7="select count(*) from user where user_id in (".$arr7.")". 'and login_time between '.$now.'+24*7*3600'.' and '.$now.'+24*8*3600';
			$qq7=$m->query($q7);
			$a7=round($qq7['0']['count(*)']/$count7*'100%',0);
			$s7="select count(*) from user where user_id in (".$arr7.")". 'and login_time between '.$now.'+24*30*3600'.' and '.$now.'+24*31*3600';
			$ss7=$m->query($s7);
			$b7=round($ss7['0']['count(*)']/$count7*'100%',0);
			}
			else{
				$row7=0;
				$a7=0;
				$b7=0;
			}
			
			$arr1=array($row1,$row2,$row3,$row4,$row5,$row6,$row7);
			$arr2=array($a1,$a2,$a3,$a4,$a5,$a6,$a7);
			$arr3=array($b1,$b2,$b3,$b4,$b5,$b6,$b7);
			$arr['arr1']=$arr1;
			$arr['arr2']=$arr2;
			$arr['arr3']=$arr3;
			//dump($arr);
			$this->assign('arr',$arr);
			$this->display('Data/lvecharts');
			break;
			case '6':
			$sql6="select user_id from user where time between ".$jiu.' and '.$now;
			$sql5="select user_id from user where time between ".$jiu.'-24*3600'.' and '.$now.'-24*3600';
			$sql4="select user_id from user where time between ".$jiu.'-24*2*3600'.' and '.$now.'-24*2*3600';
			$sql3="select user_id from user where time between ".$jiu.'-24*3*3600'.' and '.$now.'-24*3*3600';
			$sql2="select user_id from user where time between ".$jiu.'-24*4*3600'.' and '.$now.'-24*4*3600';
			$sql1="select user_id from user where time between ".$jiu.'-24*5*3600'.' and '.$now.'-24*5*3600';
			$sql7="select user_id from user where time between ".$jiu.'+24*3600'.' and '.$now.'+24*3600';
			$res1=$m->query($sql1);
			$res2=$m->query($sql2);
			$res3=$m->query($sql3);
			$res4=$m->query($sql4);
			$res5=$m->query($sql5);
			$res6=$m->query($sql6);
			$res7=$m->query($sql7);
			$sum3="";
			$count3=count($res3);
			for($i = 0; $i < $count3; $i++){
				if(($i+1)==$count3){
				$sum3 .= $res3[$i]['user_id'];
				}else{
				 $sum3 .= $res3[$i]['user_id'].',';
				}
			}
			$arr3=$sum3;
			if($arr3){
			$l3="select count(*) from user where user_id in (".$arr3.")". 'and login_time between '.$now.'-24*3*3600'.' and '.$now.'-24*2*3600';
			$ll3=$m->query($l3);
			$q3="select count(*) from user where user_id in (".$arr3.")". 'and login_time between '.$now.'+24*2*3600'.' and '.$now.'+24*3*3600';
			$qq3=$m->query($q3);
			$row3=round($ll3['0']['count(*)']/$count3*'100%',0);
			$a3=round($qq3['0']['count(*)']/$count3*'100%',0);
			$s3="select count(*) from user where user_id in (".$arr3.")". 'and login_time between '.$now.'+24*25*3600'.' and '.$now.'+24*26*3600';
			$ss3=$m->query($s3);
			$b3=round($ss3['0']['count(*)']/$count3*'100%',0);
			}else{
				$row3=0;
				$a3=0;
				$b3=0;
			}
			
			$sum2="";
			$count2=count($res2);
			for($i = 0; $i < $count2; $i++){
				if(($i+1)==$count2){
				$sum2 .= $res2[$i]['user_id'];
				}else{
				 $sum2 .= $res2[$i]['user_id'].',';
				}
			}
			$arr2=$sum2;
			if($arr2){
			$l2="select count(*) from user where user_id in (".$arr2.")". 'and login_time between '.$now.'-24*4*3600'.' and '.$now.'-24*3*3600';
			$ll2=$m->query($l2);
			$row2=round($ll2['0']['count(*)']/$count2*'100%',0);
			$q2="select count(*) from user where user_id in (".$arr2.")". 'and login_time between '.$now.'+24*3600'.' and '.$now.'+24*2*3600';
			$qq2=$m->query($q2);
			$a2=round($qq2['0']['count(*)']/$count2*'100%',0);
			$s2="select count(*) from user where user_id in (".$arr2.")". 'and login_time between '.$now.'+24*24*3600'.' and '.$now.'+24*25*3600';
			$ss2=$m->query($s2);
			$b2=round($ss2['0']['count(*)']/$count2*'100%',0);
			}
			else{
				$row2=0;
				$a2=0;
				$b2=0;
			}
			
			$sum1="";
			$count1=count($res1);
			for($i = 0; $i < $count1; $i++){
				if(($i+1)==$count1){
				$sum1 .= $res1[$i]['user_id'];
				}else{
				 $sum1 .= $res1[$i]['user_id'].',';
				}
			}
			$arr1=$sum1;
			if($arr1){
			$l1="select count(*) from user where user_id in (".$arr1.")". 'and login_time between '.$now.'-24*5*3600'.' and '.$now.'-24*4*3600';
			$ll1=$m->query($l1);
			$row1=round($ll1['0']['count(*)']/$count1*'100%',0);
			$q1="select count(*) from user where user_id in (".$arr1.")". 'and login_time between '.$now.' and '.$now.'+24*3600';
			$qq1=$m->query($q1);
			$a1=round($qq1['0']['count(*)']/$count1*'100%',0);
			$s1="select count(*) from user where user_id in (".$arr1.")". 'and login_time between '.$now.'+24*23*3600'.' and '.$now.'+24*24*3600';
			$ss1=$m->query($s1);
			$b1=round($ss1['0']['count(*)']/$count1*'100%',0);
			}
			else{
				$row1=0;
				$a1=0;
				$b1=0;
			}
			
			$sum4="";
			$count4=count($res4);
			for($i = 0; $i < $count4; $i++){
				if(($i+1)==$count4){
				$sum4 .= $res4[$i]['user_id'];
				}else{
				 $sum4 .= $res4[$i]['user_id'].',';
				}
			}
			$arr4=$sum4;
			if($arr4){
			$l4="select count(*) from user where user_id in (".$arr4.")". 'and login_time between '.$now.'-24*2*3600'.' and '.$now.'-24*3600';
			$ll4=$m->query($l4);
			$row4=round($ll4['0']['count(*)']/$count4*'100%',0);
			$q4="select count(*) from user where user_id in (".$arr4.")". 'and login_time between '.$now.'+24*3*3600'.' and '.$now.'+24*4*3600';
			$qq4=$m->query($q4);
			$a4=round($qq4['0']['count(*)']/$count4*'100%',0);
			$s4="select count(*) from user where user_id in (".$arr4.")". 'and login_time between '.$now.'+24*26*3600'.' and '.$now.'+24*27*3600';
			$ss4=$m->query($s4);
			$b4=round($ss4['0']['count(*)']/$count4*'100%',0);
			}
			else{
				$row4=0;
				$a4=0;
				$b4=0;
			}
			
			$sum5="";
			$count5=count($res5);
			for($i = 0; $i < $count5; $i++){
				if(($i+1)==$count5){
				$sum5 .= $res5[$i]['user_id'];
				}else{
				 $sum5 .= $res5[$i]['user_id'].',';
				}
			}
			$arr5=$sum5;
			if($arr5){
			$l5="select count(*) from user where user_id in (".$arr5.")". 'and login_time between '.$now.'-24*3600'.' and '.$now;
			$ll5=$m->query($l5);
			
			$row5=round($ll5['0']['count(*)']/$count5*'100%',0);
			$q5="select count(*) from user where user_id in (".$arr5.")". 'and login_time between '.$now.'+24*4*3600'.' and '.$now.'+24*5*3600';
			$qq5=$m->query($q5);
			$a5=round($qq5['0']['count(*)']/$count5*'100%',0);
			$s5="select count(*) from user where user_id in (".$arr5.")". 'and login_time between '.$now.'+24*27*3600'.' and '.$now.'+24*28*3600';
			$ss5=$m->query($s5);
			$b5=round($ss5['0']['count(*)']/$count5*'100%',0);
			}else{
				$row5=0;
				$a5=0;
				$b5=0;
			}
			
			$sum6="";
			$count6=count($res6);
			for($i = 0; $i < $count6; $i++){
				if(($i+1)==$count6){
				$sum6 .= $res6[$i]['user_id'];
				}else{
				 $sum6 .= $res6[$i]['user_id'].',';
				}
			}
			$arr6=$sum6;
			if($arr6){
			$l6="select count(*) from user where user_id in (".$arr6.")". 'and login_time between '.$now.' and '.$now.'+24*3600';
			$ll6=$m->query($l6);
			
			$row6=round($ll6['0']['count(*)']/$count6*'100%',0);
			$q6="select count(*) from user where user_id in (".$arr6.")". 'and login_time between '.$now.'+24*5*3600'.' and '.$now.'+24*6*3600';
			$qq6=$m->query($q6);
			$a6=round($qq6['0']['count(*)']/$count6*'100%',0);
			$s6="select count(*) from user where user_id in (".$arr6.")". 'and login_time between '.$now.'+24*28*3600'.' and '.$now.'+24*29*3600';
			$ss6=$m->query($s6);
			$b6=round($ss6['0']['count(*)']/$count6*'100%',0);
			}else{
				$row6=0;
				$a6=0;
				$b6=0;
			}
			
			$sum7="";
			$count7=count($res7);
			for($i = 0; $i < $count7; $i++){
				if(($i+1)==$count7){
				$sum7 .= $res7[$i]['user_id'];
				}else{
				 $sum7 .= $res7[$i]['user_id'].',';
				}
			}
			$arr7=$sum7;
			if($arr7){
			$l7="select count(*) from user where user_id in (".$arr7.")". 'and login_time between '.$now.'+24*3600'.' and '.$now.'+24*2*3600';
			$ll7=$m->query($l7);
			
			$row7=round($ll7['0']['count(*)']/$count7*'100%',0);
			$q7="select count(*) from user where user_id in (".$arr7.")". 'and login_time between '.$now.'+24*6*3600'.' and '.$now.'+24*7*3600';
			$qq7=$m->query($q7);
			$a7=round($qq7['0']['count(*)']/$count7*'100%',0);
			$s7="select count(*) from user where user_id in (".$arr7.")". 'and login_time between '.$now.'+24*29*3600'.' and '.$now.'+24*30*3600';
			$ss7=$m->query($s7);
			$b7=round($ss7['0']['count(*)']/$count7*'100%',0);
			}
			else{
				$row7=0;
				$a7=0;
				$b7=0;
			}
			
			$arr1=array($row1,$row2,$row3,$row4,$row5,$row6,$row7);
			$arr2=array($a1,$a2,$a3,$a4,$a5,$a6,$a7);
			$arr3=array($b1,$b2,$b3,$b4,$b5,$b6,$b7);
			$arr['arr1']=$arr1;
			$arr['arr2']=$arr2;
			$arr['arr3']=$arr3;
			dump($arr);
			$this->assign('arr',$arr);
			$this->display('Data/lvecharts');
			break;
		}
		

	}

}


























	
	


 
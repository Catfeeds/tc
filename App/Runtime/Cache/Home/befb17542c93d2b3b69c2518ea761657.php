<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html>

	<head lang="en">
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1.0, user-scalable=0,user-scalable=no">
		<meta name="format-detection" content="telephone=no">
		<meta name="renderer" content="webkit">
		<meta http-equiv="Cache-Control" content="no-siteapp" />

		<link rel="stylesheet" href="/Public/Home/saibangzi/plugins/boostrap/css/bootstrap.min.css" />
		<link rel="stylesheet" href="/Public/Home/saibangzi/css/public.css" />
		<link rel="stylesheet" href="/Public/Home/saibangzi/css/courses.css" />
		<link rel="stylesheet" href="/Public/Home/saibangzi/plugins/icon-font/iconfont.css" />
		<title>课程</title>
	<style>
	#qian{
	font-size: 30px;
	color: #ff9933;
}
	</style>
	</head>

	<body class="bg-f8">

<div class="container-fluid bg-white">
			<div class="container bg-white">
				<div class="nav-1">
					<img src="/Public/Home/saibangzi/img/logo.png" />
				</div>
				<div class="nav-2">
					<a href="<?php echo U('index/index');?>">首页</a>
					<a id="xiazai">下载APP</a>
					<div class="download-app">
						<img src="/Public/Home/saibangzi/img/erweima.png" />
						<div class="symbol_1"></div>
						<div class="symbol_11"></div>
					</div>
				    <a href="<?php echo U('courses/index');?>">全部课程</a>
				<?php if($dian['uid'] != null): ?><a href="<?php echo U('courses/teacher');?>">我要讲课</a>
						<?php else: ?>
						<a href="<?php echo U('Prove/index');?>">我要讲课</a><?php endif; ?>
				</div>
				<div class="nav-4">
					<?php if($_SESSION['H_user_id'] != null): ?><li id="touxiang">
						<img src="<?php echo ($user["image"]); ?>" class="p-tx" width="72px" heigth="80px"/>
						<div class="touxiang-list">
							<ul>
								<li class="bor-bot"><a  target="_blank"><?php echo ($user["name"]); ?></a></li>
								<li><a href="<?php echo U('Me/index');?>" target="_blank">个人资料</a></li>
								<li><a href="<?php echo U('Me/course');?>" target="_blank">我的课程</a></li>
								<li><a href="<?php echo U('Me/subscribe');?>" target="_blank">我的收藏</a></li>
								<?php if($dian['uid'] != null): ?><li class="bor-bot"><a href="<?php echo U('courses/teacher');?>" target="_blank">我的店铺</a></li><?php endif; ?>
							<li><a id="outlogin" target="_blank">退出 </a></li>
							</ul>
							<div class="symbol_3"></div>
							<div class="symbol_33"></div>
						</div>
					</li>
					<?php else: ?>
					<li id="touxiang">
						<a id="ll" class="p-tx" href="<?php echo U('Login/index');?>">登录|注册</a>

					</li><?php endif; ?>
					<input type="hidden" value="<?php echo ($_SESSION['H_user_id']); ?>" id="session">
					<?php if($_SESSION['H_user_id'] != null): ?><li>
							<a href="<?php echo U('news/index');?>">
							<i class="iconfont">&#xe61b;</i>
							</a>
						</li><?php endif; ?>
						<li id="icon-history">
							<i class="iconfont">&#xe70c;</i>
						<!--消息-->
						<div class="icon-history">
							<?php if($_SESSION['H_user_id'] != null): ?><div class="icon-his-top">
									<p>近期学习记录</p>
								</div>
								<div class="icon-his-bottom">
								<?php if(($pin != null) OR ($bo != null)): ?><ul>
									<?php if(is_array($pin)): foreach($pin as $key=>$v): ?><a href="<?php echo U('courses/course?id='.$v['video_id']);?>">
										<li>
											<img src="<?php echo ($v["img"]); ?>" />
											<div>
												<p><?php echo ($v["name"]); ?></p>
											</div>
										</li>
									</a><?php endforeach; endif; ?>	
									<?php if(is_array($bo)): foreach($bo as $key=>$x): ?><a href="<?php echo U('courses/course?pid='.$x['liveb_id']);?>">
										<li>
											<img src="<?php echo ($x["img"]); ?>" />
											<div>
												<p><?php echo ($x["name"]); ?></p>
											</div>
										</li>
										</a><?php endforeach; endif; ?>
									</ul>
									<?php else: ?>
									<ul>
										<li>
											<div>
												<p>没有历史记录</p>
											</div>
										</li>
									</ul><?php endif; ?>
									<div class="symbol_2"></div>
									<div class="symbol_22"></div>
								</div>
								
								<?php else: ?>
								<div class="icon-his-bottom">
								你还没有登录！！
								</div><?php endif; ?>
						</div>
					</li>
				</div>
				<div class="nav-3">
				<form action="<?php echo U('index/search');?>" method="post">
					<input  id="search" name="sousuo" class="search-inp" type="text" placeholder="请输入关键字" />
					<button type="submit" class="glyphicon glyphicon-search search but-icon">
					</button>
					</form>
					<span class="remen_1">前端入门</span>
					<span class="remen_2">java入门</span>
				</div>
			</div>
		</div>
		
		<div class="container">
			<!--顶部开始	-->
			<div class="course-topart">

				<div class="course-left">
					<img src="<?php echo ($row["img"]); ?>">
				</div>
				<div class="course-right">
					<div class="course-right-one">
						<div class="course-right-two">
							<a title="" class="fon_siz24"><?php echo ($row["name"]); ?></a>
							<a title="" class="fon_siz16">老师：<?php echo ($row["tname"]); ?></a>
						</div>
					</div>
					
					<div class="icon ">
					
						<i class="iconfont" style="font-size: 21px;" id="fenxiang">&#xe610;</i>
						
						<i class="iconfont  margin_l20" id="dianji" style="font-size: 21px;">&#xe6a1;</i>
						<i class="iconfont" id="xianshi">&#xe600;</i>

						<div class="jiathis_style">
							<span class="jiathis_txt">分享到：</span>
							<a class="jiathis_button_tools_1"></a>
							<a class="jiathis_button_tools_2"></a>
							<a class="jiathis_button_tools_3"></a>
							<!-- //<a class="jiathis_button_tools_4"></a> -->
							
						</div>
					
					</div>
					
						
					
					<div class="free">
					<?php if(($row["money"]) == "0"): ?><span>免费</span>
						<?php else: ?>
						<span id="qian"><?php echo ($row["money"]); ?></span><?php endif; ?>
					</div>
					<?php if($pid != null): ?><div class="enrol">
						<a href="<?php echo U('courses/baoming',array('pid'=>$pid));?>" class="sign-up-im">
							<span class="sign-up-font">立即报名</span>
						</a>
					</div>
					<?php else: ?>
					<div class="enrol">
						<a href="<?php echo U('courses/baoming',array('id'=>$id));?>" class="sign-up-im">
							<span class="sign-up-font">立即报名</span>
						</a>
					</div><?php endif; ?>
					<input type="hidden" value="<?php echo ($id); ?>" id="id">
					<input type="hidden" value="<?php echo ($pid); ?>" id="pid">
					<div class="timer">
						<span>开课时间:<?php echo (date('Y-m-d H:i:s',$row["time"])); ?></span>
					</div>

					<img src="/Public/Home/saibangzi/img/yibaoming.png" class="sign-up-img" />

				</div>
			</div>
			<!--顶部结束	-->
			
			<div class="margin_t30">
				<!--左边开始	-->
				<div class="col-xs-9 col-md-9 bg-white border-r6 bor padding0">
					<div class="tab">
						<ul class="tab-hd">
							<li class="active color"><span>课程介绍</span></li>
							<li><span>课程目录</span></li>
							<li><span>相关课程</span></li>
						</ul>
						
						<ul class="tab-bd">
							<li class="thisclass">
								<div class="intr-section padding_t20">
									<div class="line-bor"></div>
									<span class="teacher-int">老师介绍</span>
								</div>
								<div class="intr-section">
									<div class="intr-section-l">
										<img src="<?php echo ($row["image"]); ?>" />
										<a href="<?php echo U('student?id='.$row['user_id']);?>">进入店铺</a>
									</div>
									
									<div class="intr-section-r">
										<span class="teacher-int"><?php echo ($row["tname"]); ?></span>
										<span class="intro-int">
												<?php echo ($row["abstract"]); ?>
										</span>
									</div>
								</div>
								<hr/>
								<div class="intr-section padding_t20">
									<div class="line-bor"></div>
									<span class="teacher-int">课程介绍</span>
								</div>

								<div class="intr-section">
									<div class="float_l">
										<span class="c-i"><?php echo ($row["introduce"]); ?>
										</span>
									</div>
								</div>
							</li>

							<li>
								<div class="capter">
								<?php if(is_array($shipin)): foreach($shipin as $key=>$x): ?><a href="<?php echo U('courses/course?id='.$x['video_id']);?>">
									<div class="section">
										<span class="f-f1" style="width:100px"><?php echo ($x["name"]); ?></span>
										<span class="f-f2"><?php echo ($x["introduce"]); ?></span>
										<a class="f-f3">
											<span>报名后请观看</span>
										</a>
										<span class="f-f4">
												<span class="f-time"><?php echo (date('i:s',$x["time"])); ?></span>
										<span class="f-icon"><i class="iconfont">&#xe606;</i></span>
										</span>
									</div>
									</a><?php endforeach; endif; ?>
									
							</li>

							<li>
								<div class="row margin0 a-cour">
								<?php if(is_array($zhibo)): foreach($zhibo as $key=>$z): ?><div class="col-xs-6 col-md-03 editin">
										<a class="thumbnail" href="<?php echo U('courses/course?pid='.$z['liveb_id']);?>">
											<div class="photo">
												<img src="<?php echo ($z["img"]); ?>">
											</div>
											<div class="caption">
												<p><?php echo ($z["name"]); ?></p>

				
												<?php if(($z["money"]) == "0"): ?><span class="subhead-titie">免费</span>
													<?php else: ?>
													<span class="subhead-titie"><?php echo ($z["money"]); ?></span><?php endif; ?>
												<div class="pull-right">
													<span class="video-label-item label-color-0">直播</span>
												</div>
											</div>
										</a>
									</div><?php endforeach; endif; ?>	
								</div>
							</li>
						</ul>
					</div>
				</div>
				<!--左边结束	-->
				<!--右边开始	-->
				<div class=" col-md-3 float_r">
					<div class="row directory-rig">
						<div class="directory-rig-one">
							<span>在线观看只需简单三秒</span>
						</div>
						<div class="directory-rig-two">
							<div class="two-left">
								<img src="/Public/Home/saibangzi/img/class_icon_zaixian.png" />
							</div>
							<div class="two-right">
								<span>在线选课</span>
								<span class="course-inter">在平台选择自己感兴趣的课程</span>
							</div>
							<div class="border-line"></div>
						</div>
						
						<div class="directory-rig-two padding_t0">
							<div class="two-left">
								<img src="/Public/Home/saibangzi/img/class_icon_xiazai.png" />
							</div>
							<div class="two-right">
								<span>下载手机客户端或使用网页</span>
								<span class="course-inter">选课后请及时下载手机客户端或使用网页查看和回放，参与更多活动</span>
							</div>
							<div class="border-line"></div>
						</div>

						<div class="directory-rig-two padding_t0">
							<div class="two-left">
								<img src="/Public/Home/saibangzi/img/class_icon_shangke.png" />
							</div>
							<div class="two-right">
								<span>在线选课</span>
								<span class="course-inter">在平台选择自己感兴趣的课程</span>
							</div>
						</div>
					</div>
					<div class="row directory-rig margin_t30">
						<div class="directory-rig-one">
							<span>常见问题</span>
						</div>
						<div class="directory-rig-two">
							<div class="two-left">
								<img src="/Public/Home/saibangzi/img/class_icon_problem_1.png" />

							</div>
							<div class="two-right">
								<span>在线选课</span>
								<span class="course-inter">购颗支持支付宝、微信支付</span>
							</div>
							<div class="border-line"></div>
						</div>

						<div class="directory-rig-two padding_t0">
							<div class="two-left">
								<img src="/Public/Home/saibangzi/img/class_icon_problem_2.png" />

							</div>
							<div class="two-right">
								<span>上课要求</span>
								<span class="course-inter">为保证上课质量，建议在4M以上的wifi环境下，佩戴耳机上课质量更好</span>
							</div>
							<div class="border-line"></div>
						</div>

						<div class="directory-rig-two padding_t0">
							<div class="two-left">
								<img src="/Public/Home/saibangzi/img/class_icon_problem_3.png" />
							</div>
							<div class="two-right">
								<span>退费</span>
								<span class="course-inter">课程支付成功后不支持退课，退款</span>
							</div>
							<div class="border-line"></div>
						</div>

						<div class="directory-rig-two padding_t0">
							<div class="two-left">
								<img src="/Public/Home/saibangzi/img/class_icon_problem_4.png" />
							</div>
							<div class="two-right">
								<span>遇到问题如何解决</span>
								<span class="course-inter">可直接拨打客服电话024-12345</span>
							</div>
						</div>
					</div>
				</div>
				<!--右边结束	-->
			</div>
		</div>
		<input type="hidden" value="<?php echo ($row["name"]); ?>" name="title">
		<input type="hidden" value="<?php echo ($row["introduce"]); ?>" name="desc">
		<input type="hidden" value="<?php echo ($row["img"]); ?>" name="img">
		<!-- 返回顶部开始 -->
		<div>
			<div id="moquu_wxin" class="moquu_wxin"><a href="javascript:void(0)">1<div class="moquu_wxinh"></div></a></div>
			<div id="moquu_wshare" class="moquu_wshare"><a href="javascript:void(0)">2<div class="moquu_wshareh"></div></a></div>
			<a id="moquu_top" href="javascript:void(0)"></a>
		</div>
		

			<!--页脚开始-->
			<div class=" bg-white">
				<div class="container footer">
					<div class="footer-top">
						<span>联系我们</span>
						<span>|</span>
						<a href="<?php echo U('feedback/index');?>">
						<span>意见反馈</span>
						</a>
						<span>|</span>
						<span>常见问题</span>
						<span>|</span>
						<span>服务协议</span>
						<span>|</span>
						<span>关于我们</span>
					</div>
					<div class="footer-bottom">
						<span>© 2017 imooc.com  京ICP备 13046642号-2</span>
					</div>
				</div>
			</div>
			<!--页脚结束-->
			
		<script src="/Public/Home/saibangzi/js/jquery-2.1.0.js"></script>
		<script src="/Public/Home/saibangzi/plugins/boostrap/js/bootstrap.min.js"></script>
		<script src="/Public/Home/saibangzi/js/index.js"></script>
		<script src="/Public/Home/saibangzi/js/courses.js"></script>
		<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script> 
		<script>
		/*$(".sign-up-im").click(function() {
		 			var display = $('.sign-up-img').css('display');
					var live=$('#pid').val();
				    var video=$('#id').val();
					if (display == 'none') {
		 				$.post("<?php echo U('courses/baoming');?>",{'live':live,'video':video},function(data){
		 					if(data=='报名成功' || data=='报名视频成功'){
		 						alert(data);
		 						$(".sign-up-font").text("已报名");
						$(".sign-up-img").css("display", "block");
		 				$(".sign-up-im").css("background", "#CCCCCC");
		 					}
		 					if(data=='您尚未登录！请登录'){
		 						alert(data);
		 						 window.location.href="<?php echo U('login/index');?>";
		 					}
		 					if(data=='您已经报名!请选择其他课程' || data=='该课程已被报名！请选择其他课程'){
		 						alert(data);
		 						 window.location.href="<?php echo U('courses/index');?>";
		 					}
                        })
		 			} *//*else {
		 				$.post("<?php echo U('courses/baoming');?>",{'live':live,'video':video},function(data){

		 				$(".sign-up-font").text("立即报名");
						$(".sign-up-img").css("display", "none");
		 				$(".sign-up-im").css("background", "#ff9933");
		 			})
		 		}*/
		 		/*})*/
		$("#dianji").click(function() {
					var display = $('#xianshi').css('display');
					var live=$('#pid').val();
					var video=$('#id').val();
					if (display == 'none') {
						$.post("<?php echo U('courses/shoucang');?>",{'live':live,'video':video},function(data){
							if(data=='收藏成功'){
								alert(data);
						$("#xianshi").css("display", "block");
						$("#dianji").css("color", "#f39232");}
						if(data=='您已经收藏该直播' || data=='您已经收藏该视频'){
							alert(data);
							 
						}
						if(data=='您尚未登录！请登录'){
							alert(data);
							 window.location.href="<?php echo U('login/index');?>";
						}

					});
					}
				})
		$('#outlogin').click(function(){
						var a=$('#session').val();
						$.post('<?php echo U('Login/outlogin');?>',{'session':a},function(data){
							if(data=='退出成功'){
							alert('退出登录！');window.location.href="<?php echo U('index/index');?>";}
						})
						
					})
			</script>
<script>
	var live=$('#pid').val();
	var video=$('#id').val();
	$.get("<?php echo U('fenxiang');?>",{url:window.location.href,'pid':live,'id':video},function(data) {
        var configData = {
        	debug: false,
        	appId: data["appId"],
        	timestamp: data["timestamp"],
        	nonceStr: data["nonceStr"],
        	signature: data["signature"],
        	jsApiList: data["jsApiList"]
        };
        console.log(data)
        wx.config(configData);
        wx.ready(function () {
			var title=data['kecheng']['name'];
			var desc=data['kecheng']['introduce'];
			var img=data['kecheng']['img'];
			// 在这里调用 API
		    wx.onMenuShareTimeline({  //例如分享到朋友圈的API 
			   	title: title, // 分享标题
			    link: data['url'], // 分享链接
			    imgUrl: img, // 分享图标
			    desc:desc,
			    success: function () {

			    },
			    cancel: function () {
			    // 用户取消分享后执行的回调函数
			    }
		    });

		    wx.onMenuShareAppMessage({
		    	title: title, // 分享标题
		    	desc: desc, // 分享描述
		    	link: data['url'], // 分享链接
		    	imgUrl: img, // 分享图标
		    	type: 'link', // 分享类型,music、video或link，不填默认为link
		    	dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
			    success: function () {

			    },
			    cancel: function () {
			    // 用户取消分享后执行的回调函数
			    }
		   	});
		    wx.error(function (res) {
		    	alert(res.errMsg);  //打印错误消息。及把 debug:false,设置为debug:ture就可以直接在网页上看到弹出的错误提示
		    });
		});
	},
	"json"
   	);


</script>
<!-- JiaThis Button BEGIN -->

<script>
var name=$('.fon_siz24').text();
var desc=$('.c-i').text();
var link=window.location.href;
var img='http://www.wyuek.com'+$('img').attr("src");
var jiathis_config = {
 url:link,
    title:name,
    summary:desc,
    pic:img,}
    </script>
<script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
<!-- JiaThis Button END -->


<SCRIPT>

// $("#fenxiang").click(function(){
//     $(".jiathis_style").css("display","block");
// },function(){
//     $(".jiathis_style").css("display","none");
// });

$("#fenxiang").click(function(){
	alert("1");
 if($(".jiathis_style").is(":hidden")){

       $(".jiathis_style").show();    //如果元素为隐藏,则将它显现
}else{
      $(".jiathis_style").hide();     //如果元素为显现,则将其隐藏
}
});


</SCRIPT>
	</body>

</html>
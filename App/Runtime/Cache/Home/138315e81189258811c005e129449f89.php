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
		<link rel="stylesheet" href="/Public/Home/saibangzi/css/full-course.css" />
		<link rel="stylesheet" href="/Public/Home/saibangzi/plugins/icon-font/iconfont.css" />
		<title>全部课程</title>
		<style>
			
			.fenye{
	height:30px;
	text-align:center;
	margin:0 auto;

}
.fenye div{
	margin:0 auto;
}
.fenye span{
	color: #fff;
	background-color: #00d3d4;
	border:1px solid #00d3d4;
	padding:5px 10px;
}
.fenye a{
	color:#bbb;
	padding:5px 10px;
}
.fenye a:hover{
	color: #fff;
	background-color: #00d3d4;
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
			<div class="row">
				<div class="col-md-12">

					<div class="fc-t">
						<div class="fc-t-t">
							<div class="fc-t-o" id="fid">
								
								<ul>
								<span>分类：</span>
								
								<?php if(is_array($rew)): foreach($rew as $key=>$v): ?><li class="<?php echo $active['name']==$v['name']?'actives':'';?>">
										<a  href='<?php echo U('show?id='.$v['cate_id']);?>' style="<?php echo $active['name']==$v['name']?'color:#fff':'';?>"><?php echo ($v["name"]); ?></a>
									</li><?php endforeach; endif; ?>	
								</ul>
							</div>
						</div>
						<div class="line">
							<hr/>
						</div>
						<div class="fc-t-t">
							<div class="fc-t-o" id="zid">
								
								<ul>
								<span>分类：</span>
									
								<?php if(is_array($row)): foreach($row as $key=>$v): ?><li class="<?php echo $active['name']==$v['name']?'actives':'';?>" 
									>
										<a href='<?php echo U('lei?id='.$v['cate_id']);?>' style="<?php echo $active['name']==$v['name']?'color:#fff':'';?>"><?php echo ($v["name"]); ?></a>
									</li><?php endforeach; endif; ?>		
								</ul>
							</div>
						</div>
					</div>

					<div class="fc-c">
						<span>类别：</span>
						<ul>
							<li>
								<a id="zhibo">直播</a>
							</li>
							<li>
								<a id="shipin">视频</a>
							</li>
							<li>
								<a id='ketang'>课堂</a>
							</li>
						</ul>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">

					<div class="full-c" id="video" style="display:none">
					<?php if(is_array($video)): foreach($video as $key=>$vd): ?><div class="col-md-03 edit">
							<a class="thumbnail" href="<?php echo U('courses/course?id='.$vd['video_id']);?>">
								<div class="photo">
									<img src="<?php echo ($vd["img"]); ?>">
								</div>
								<div class="caption">
									<p><?php echo ($vd["introduce"]); ?></p>
									<?php if(($vd["money"]) == "0"): ?><span class="subhead-titie">免费</span>
													<?php else: ?>
													<span class="subhead-titie"><?php echo ($vd["money"]); ?></span><?php endif; ?>
									<div class="pull-right">
										<span class="video-label-item label-color-0">视频</span>
									</div>
								</div>
							</a>
						</div><?php endforeach; endif; ?>
					</div>

				</div>

			</div>
			<div class="row" >
				<div class="col-md-12">

					<div class="full-c" id="kecheng" style="display:none">
					<?php if(is_array($class)): foreach($class as $key=>$vc): ?><div class="col-md-03 edit">
							<a class="thumbnail" href="<?php echo U('student?id='.$vc['user_id']);?>">
								<div class="photo">
									<img src="<?php echo ($vc["img"]); ?>">
								</div>
								<div class="caption">
									<p><?php echo ($vc["name"]); ?></p>
									
													<span class="subhead-titie">免费</span>
													
									<div class="pull-right">
										<span class="video-label-item label-color-0">课程</span>
									</div>
								</div>
							</a>
						</div><?php endforeach; endif; ?>
					</div>

				</div>
				</div>
			<div class="row" >
				<div class="col-md-12">

					<div class="full-c" id="live" style="display:block">
					<?php if(is_array($live)): foreach($live as $key=>$vl): ?><div class="col-md-03 edit" >
							<a class="thumbnail" href="<?php echo U('courses/course?pid='.$vl['liveb_id']);?>">
								<div class="photo">
									<img src="<?php echo ($vl["img"]); ?>">
								</div>
								<div class="caption">
									<p><?php echo ($vl["name"]); ?></p>
								<?php if(($vl["money"]) == "0"): ?><span class="subhead-titie">免费</span>
													<?php else: ?>
													<span class="subhead-titie"><?php echo ($vl["money"]); ?></span><?php endif; ?>
									<div class="pull-right">
										<span class="video-label-item label-color-0">直播</span>
									</div>
								</div>
							</a>
						</div><?php endforeach; endif; ?>
					</div>

				</div>
			</div>
			<div class="row margin0">
				<div class="pagination-self">
					<ul>
						<li id='one' class="fenye">
							<?php echo ($show1); ?>
						</li>
					
					</ul>
				</div>
			</div>
			<div class="row margin0">
				<div class="pagination-self">
					<ul>
						<li id='two' style="display:none" class="fenye">
							<?php echo ($show2); ?>
						</li>
					
					</ul>
				</div>
			</div>
			<div class="row margin0" >
				<div class="pagination-self">
					<ul>
						<li id='three' style="display:none" class="fenye">
							<?php echo ($show3); ?>
						</li>
						
					</ul>
				</div>
			</div>

			<!-- 返回顶部开始 -->
			<div>
				<div id="moquu_wxin" class="moquu_wxin"><a href="javascript:void(0)">1<div class="moquu_wxinh"></div></a></div>
				<div id="moquu_wshare" class="moquu_wshare"><a href="javascript:void(0)">2<div class="moquu_wshareh"></div></a></div>
				<a id="moquu_top" href="javascript:void(0)"></a>
			</div>
			<!-- 返回顶部结束 -->

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
			<script src="/Public/Home/saibangzi/js/index.js"></script>
			<script src="/Public/Home/saibangzi/plugins/boostrap/js/bootstrap.min.js"></script>
			<script>
				$('#zhibo').click(function(){
					$('#live').css('display','block');
					$('#kecheng').css('display','none');
					$(this).addClass("actives");
					$('#video').css('display','none');
					$('#one').css('display','block');
					$('#two').css('display','none');
					$('#three').css('display','none');
					$('#shipin').removeClass('actives')
					$('#ketang').removeClass('actives')

				})
				$('#shipin').click(function(){
					$('#live').css('display','none');
					$('#kecheng').css('display','none');
					$('#video').css('display','block');
					$('#one').css('display','none');
					$(this).addClass("actives");
					$('#zhibo').removeClass('actives')
					$('#ketang').removeClass('actives')
					$('#two').css('display','block');
					$('#three').css('display','none');
				})
				$('#ketang').click(function(){
					$('#live').css('display','none');
					$('#kecheng').css('display','block');
					$('#video').css('display','none');
					$(this).addClass("actives");
					$('#one').css('display','none');
					$('#two').css('display','none');
					$('#three').css('display','block');
					$('#zhibo').removeClass('actives')
					$('#shipin').removeClass('actives')
				})
				
				$('#outlogin').click(function(){
						var a=$('#session').val();
						$.post('<?php echo U('Login/outlogin');?>',{'session':a},function(data){
							if(data=='退出成功'){
							alert('退出登录！');window.location.href="<?php echo U('index/index');?>";}
						})
						
					})
				$('.fenye .next').html('下一页');
$('.fenye .prev').html('上一页');
			</script>
	</body>
	
</html>
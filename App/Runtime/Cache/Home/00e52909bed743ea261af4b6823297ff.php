<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1.0, user-scalable=0,user-scalable=no">
		<meta name="format-detection" content="telephone=no">
		<meta name="renderer" content="webkit">
		<meta http-equiv="Cache-Control" content="no-siteapp" />

		<link rel="stylesheet" href="/Public/Home/saibangzi/plugins/boostrap/css/bootstrap.min.css" />
		<link rel="stylesheet" href="/Public/Home/saibangzi/css/index.css" />
		<link rel="stylesheet" href="/Public/Home/saibangzi/css/public.css" />
		<link rel="stylesheet" href="/Public/Home/saibangzi/plugins/icon-font/iconfont.css" />
		<link rel="stylesheet" href="/Public/Home/saibangzi/plugins/slider/css/slide.css" />
		<title>首页</title>
	</head>

	<body>
		<nav class="navbar bg-white margin_b border-no">
			<div class="container position_rel">
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
								<li class="bor-bot"><a target="_blank"><?php echo ($user["name"]); ?></a></li>
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
								<?php if(($shipin != null) OR ($zhibo != null)): ?><ul>
									<?php if(is_array($shipin)): foreach($shipin as $key=>$v): ?><a href="<?php echo U('courses/course?id='.$v['video_id']);?>">
										<li>
											<img src="<?php echo ($v["img"]); ?>" />
											<div>
												<p><?php echo ($v["name"]); ?></p>
											</div>
										</li>
									</a><?php endforeach; endif; ?>	
									<?php if(is_array($zhibo)): foreach($zhibo as $key=>$x): ?><a href="<?php echo U('courses/course?pid='.$x['liveb_id']);?>">
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
					<form action="<?php echo U('search');?>" method="post">
						<input id="search" name="sousuo" class="search-inp" type="text" placeholder="请输入关键字" />
						
						<button type="submit" class="glyphicon glyphicon-search search but-icon">
							

						</button>
						</form>
						<span class="remen_1">前端入门</span>
						<span class="remen_2">java入门</span>
						<div class="history-search">
							<ul>
								<li><a href="" target="_blank">C语言</a></li>
								<li><a href="" target="_blank">数学</a></li>
								<li><a href="" target="_blank">数据结构</a></li>
								<li><a href="" target="_blank">日语</a></li>
							</ul>
						</div>
					</div>
				</div>

				<!--浮动菜单-->
				<div class="float_menu">
					<div class="float_menuin font-size14">
					<?php if(is_array($list)): foreach($list as $key=>$val): ?><div class="tab_qiehuan tab">
							<div class="left_menu bianhuabeijing">
								<div class="left_menuin" style="overflow:hidden;">
									<div class="left_menuin_two" style="line-height:25px;">
										<ul>
											<li class="pad_left10"><?php echo ($val["name"]); ?></li>
										</ul>
										<ul>
											<?php if(is_array($val['cate_son'])): foreach($val['cate_son'] as $key=>$v): ?><li><a href="<?php echo U('courses/lei?id='.$v['cate_id']);?>" style="width:10px;overflow:hidden;"><?php echo ($v["name"]); ?></a></li><?php endforeach; endif; ?>
										</ul>
										
									</div>
								</div>
							</div>

							<div class="right_menu lunbofenlei">
								<div class="right_menuin">
									<div class="right_menuin_one">
										<span><?php echo ($val["name"]); ?></span>
										<ul class="pad_left0">
										<?php if(is_array($val['cate_sons'])): foreach($val['cate_sons'] as $key=>$vv): ?><li ><a href="<?php echo U('courses/lei?id='.$vv['cate_id']);?>"><?php echo ($vv["name"]); ?></a></li>
											<li>|</li><?php endforeach; endif; ?>
										</ul>
									</div>
									<div class="right_menuin_two">
										<span>推荐</span>
										<ul>
										<?php if(is_array($val['course'])): foreach($val['course'] as $key=>$cval): ?><li><a href="<?php echo U('Courses/course',array('pid'=>$cval['liveb_id']));?>">课程 | <?php echo ($cval["name"]); ?></a></li><?php endforeach; endif; ?>
										</ul>
									</div>
									<!-- <img src="/Public/Home/saibangzi/img/tuijian.png" /> -->
								</div>
							</div>
						</div><?php endforeach; endif; ?>
					</div>
				</div>
				<!--浮动菜单结束-->
			</div>
		</nav>

		<!--轮播开始	-->
		

			<div class="ck-slide">
					<ul class="ck-slide-wrapper">
					<?php if(is_array($lunbo_list)): foreach($lunbo_list as $key=>$val): ?><li>
							<a href="<?php echo ($val["url"]); ?>"><img src="<?php echo ($val['img']); ?>" alt=""></a>
						</li><?php endforeach; endif; ?>
					
					</ul>
					<a href="javascript:;" class="ctrl-slide ck-prev">上一张</a> <a href="javascript:;" class="ctrl-slide ck-next">下一张</a>
					<div class="ck-slidebox">
						<div class="slideWrap">
							<ul class="dot-wrap">
								<li class="current"><em>1</em></li>
								<li><em>2</em></li>
								<li><em>3</em></li>
								<li><em>4</em></li>								
							</ul>
						</div>
					</div>
				</div>

		
		<!--轮播结束-->

		<!--实战荐开始-->
		<div class="bg-f8">
			<div class="container">
				<div class="row">
					<div class="recommend">
						<img src="/Public/Home/saibangzi/img/home_icon_hot.png" />
						<span class="fon_siz18">　　实战推荐　　</span>
						<img src="/Public/Home/saibangzi/img/home_icon_hot.png" />
					</div>
				</div>
				<div class="row">
				<?php if(is_array($liveb_list)): foreach($liveb_list as $key=>$val): ?><div class="col-xs-6 col-md-03 edit">
						<a class="thumbnail" href="<?php echo U('courses/course?pid='.$val['liveb_id']);?>">
							<div class="photo">
								<img src="<?php echo ($val["img"]); ?>">
							</div>
							<div class="caption">
								<p><?php echo ($val["name"]); ?></p>
								<span class="subhead-titie"><?php echo $val['money']==0.00?'免费':$val['money'];?></span>
								<div class="pull-right">
									<span class="video-label-item label-color-0">直播</span>
								</div>
							</div>
						</a>
					</div><?php endforeach; endif; ?>
				</div>
				<div class="row">
					<a href="">
						<img src="/Public/Home/saibangzi/img/yaotu.png" class="yaotu" />
						<!-- <img src="<?php echo ($advert_img); ?>" class="yaotu" /> -->
					</a>
				</div>
			</div>
		</div>
		<!--实战推荐结束-->
		<!--语言学习开始-->
		<div class="container">
			<div class="row margin_t30">
				<div class="col-xs-6 col-md-03 edit">
					<div class="thumbnail">
						<div class="yuyan fenlei-yuyan">
							<a class="fltitle-one">语言学习</a>
							<div class="fltitle-two">
								<ul>
								<?php if(is_array($yuyan)): foreach($yuyan as $key=>$v): ?><li style="padding:5px;"><a href="<?php echo U('courses/lei?id='.$v['cate_id']);?>"><?php echo ($v["name"]); ?></a></li><?php endforeach; endif; ?>
								</ul>
							</div>
							<div class="fltitle-three">
								<ul>
									<li class="more-one"><a href="<?php echo U('courses/show?id='.$v['pid']);?>">更多　>></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xs-6 col-md-08 edit">
				<?php if(is_array($yuyan_liveb)): foreach($yuyan_liveb as $key=>$v): ?><div class="col-xs-6 col-md-025 edit">
						<a class="thumbnail" href="<?php echo U('courses/course?pid='.$v['liveb_id']);?>">
							<div class="photo">
								<img src="<?php echo ($v["img"]); ?>">
							</div>
							<div class="caption">
								<p><?php echo ($v["name"]); ?></p>
								<span class="subhead-titie"><?php echo $v['money']==0.00?'免费':$v['money'];?></span>
								<div class="pull-right">
									<span class="video-label-item label-color-0">直播</span>
								</div>
							</div>
						</a>
					</div><?php endforeach; endif; ?>
				</div>
			</div>
		</div>
		<!--语言学习结束-->

		<!--文化教育开始-->
		<div class="bg-f8">
			<div class="container">
				<div class="row margin_t30">
					<div class="col-xs-6 col-md-03 edit">
						<div class="thumbnail">
							<div class="yuyan fenlei-wenhua">
								<a class="fltitle-one">亲子教育</a>
								<div class="fltitle-two">
									<ul>
									<?php if(is_array($qinzi)): foreach($qinzi as $key=>$v): ?><li style="padding:5px;"><a href="<?php echo U('courses/lei?id='.$v['cate_id']);?>"><?php echo ($v["name"]); ?></a></li><?php endforeach; endif; ?>
									</ul>
								</div>
								<div class="fltitle-three">
									<ul>
										<li class="more-two"><a href="<?php echo U('courses/show?id='.$v['pid']);?>">更多　>></a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>

					<div class="col-xs-6 col-md-08 edit">
					<?php if(is_array($qinzi_liveb)): foreach($qinzi_liveb as $key=>$v): ?><div class="col-xs-6 col-md-025 edit">
							<a class="thumbnail" href="<?php echo U('courses/course?pid='.$v['liveb_id']);?>">
								<div class="photo">
									<img src="<?php echo ($v["img"]); ?>">
								</div>
								<div class="caption">
									<p><?php echo ($v["name"]); ?></p>
									<span class="subhead-titie"><?php echo $v['money']==0.00?'免费':$v['money'];?></span>
									<div class="pull-right">
										<span class="video-label-item label-color-0">直播</span>
									</div>
								</div>
							</a>
						</div><?php endforeach; endif; ?>
						
					</div>

					
				</div>
			</div>
		</div>
		<!--文化教育结束-->
		<!--办公效率开始-->
		<div class="container">
			<div class="row margin_t30">
				<div class="col-xs-6 col-md-03 edit">
					<div class="thumbnail">
						<div class="yuyan fenlei-bangong">
							<a class="fltitle-one">办公效率</a>
							<div class="fltitle-two">
								<ul>
									<?php if(is_array($bangong)): foreach($bangong as $key=>$v): ?><li style="padding:5px;"><a href="<?php echo U('courses/lei?id='.$v['cate_id']);?>"><?php echo ($v["name"]); ?></a></li><?php endforeach; endif; ?>
								</ul>
							</div>
							<div class="fltitle-three">
								<ul>
									<li class="more-three"><a href="<?php echo U('courses/show?id='.$v['pid']);?>">更多　>></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xs-6 col-md-08 edit">
					<?php if(is_array($bangong_liveb)): foreach($bangong_liveb as $key=>$v): ?><div class="col-xs-6 col-md-025 edit">
						<a class="thumbnail" href="<?php echo U('courses/course?pid='.$v['liveb_id']);?>">
							<div class="photo">
								<img src="<?php echo ($v["img"]); ?>">
							</div>
							<div class="caption">
								<p><?php echo ($v["name"]); ?></p>
								<span class="subhead-titie"><?php echo $v['money']==0.00?'免费':$v['money'];?></span>
								<div class="pull-right">
									<span class="video-label-item label-color-0">直播</span>
								</div>
							</div>
						</a>
					</div><?php endforeach; endif; ?>
				</div>

			</div>
		</div>
		<!--办公效率结束-->
		<!--职业发展开始-->
		<div class="bg-f8">
			<div class="container">
				<div class="row margin_t30">
					<div class="col-xs-6 col-md-03 edit">
						<div class="thumbnail">
							<div class="yuyan fenlei-zhiye">
								<a class="fltitle-one">职业发展</a>
								<div class="fltitle-two">
									<ul>
									<?php if(is_array($zhiye)): foreach($zhiye as $key=>$v): ?><li style="padding:5px;"><a href="<?php echo U('courses/lei?id='.$v['cate_id']);?>"><?php echo ($v["name"]); ?></a></li><?php endforeach; endif; ?>
									</ul>
								</div>
								<div class="fltitle-three">
									<ul>
										<li class="more-four"><a href="<?php echo U('courses/show?id='.$v['pid']);?>">更多　>></a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>

					<div class="col-xs-6 col-md-08 edit">
						<?php if(is_array($zhiye_liveb)): foreach($zhiye_liveb as $key=>$v): ?><div class="col-xs-6 col-md-025 edit">
							<a class="thumbnail" href="<?php echo U('courses/course?pid='.$v['liveb_id']);?>">
								<div class="photo">
									<img src="<?php echo ($v["img"]); ?>">
								</div>
								<div class="caption">
									<p><?php echo ($v["name"]); ?></p>
									<span class="subhead-titie"><?php echo $v['money']==0.00?'免费':$v['money'];?></span>
									<div class="pull-right">
										<span class="video-label-item label-color-0">直播</span>
									</div>
								</div>
							</a>
						</div><?php endforeach; endif; ?>
					</div>
				</div>
			</div>
		</div>
		<!--职业发展结束-->
		<!--产品开发开始-->
		<div class="container">
			<div class="row margin_t30">
				<div class="col-xs-6 col-md-03 edit">
					<div class="thumbnail">
						<div class="yuyan fenlei-chanpin">
							<a class="fltitle-one">产品开发</a>
							<div class="fltitle-two">
								<ul>
								<?php if(is_array($chanpin)): foreach($chanpin as $key=>$v): ?><li style="padding:5px;"><a href="<?php echo U('courses/lei?id='.$v['cate_id']);?>"><?php echo ($v["name"]); ?></a></li><?php endforeach; endif; ?>
								</ul>
							</div>
							<div class="fltitle-three">
								<ul>
									<li class="more-five"><a href="<?php echo U('courses/show?id='.$v['pid']);?>">更多　>></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xs-6 col-md-08 edit">
					<?php if(is_array($chanpin_liveb)): foreach($chanpin_liveb as $key=>$v): ?><div class="col-xs-6 col-md-025 edit">
						<a class="thumbnail" href="<?php echo U('courses/course?pid='.$v['liveb_id']);?>">
							<div class="photo">
								<img src="<?php echo ($v["img"]); ?>">
							</div>
							<div class="caption">
								<p><?php echo ($v["name"]); ?></p>
								<span class="subhead-titie"><?php echo $v['money']==0.00?'免费':$v['money'];?></span>
								<div class="pull-right">
									<span class="video-label-item label-color-0">直播</span>
								</div>
							</div>
						</a>
					</div><?php endforeach; endif; ?>
				</div>
			</div>
		</div>
		<!--产品开发结束-->
		<!-- 返回顶部开始 -->
		<div>
			<div id="moquu_wxin" class="moquu_wxin"><a href="javascript:void(0)">1<div class="moquu_wxinh"></div></a></div>
			<div id="moquu_wshare" class="moquu_wshare"><a href="javascript:void(0)">2<div class="moquu_wshareh"></div></a></div>
			<a id="moquu_top" href="javascript:void(0)"></a>
		</div>
		<!-- 返回顶部结束 -->
		<!--页脚开始-->
		<div class="bg-f8">
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
		<script src="/Public/Home/saibangzi/plugins/slider/js/slide.min.js"></script>
			<script>
					$('.ck-slide').ckSlide({
						autoPlay: true, //默认为不自动播放，需要时请以此设置
						dir: 'x', //默认效果淡隐淡出，x为水平移动，y 为垂直滚动
						interval: 3000 //默认间隔2000毫秒
					});
					$('form').submit(function() {
							var search=$('[name=sousuo]').val();
							if (search) {
								return true;
							}
							
							return false;
						})
					$('#outlogin').click(function(){
						var a=$('#session').val();
						$.post('<?php echo U('Login/outlogin');?>',{'session':a},function(data){
							if(data=='退出成功'){
							alert('退出登录！');window.location.href="<?php echo U('index/index');?>";}
						})
						
					})
				</script>

	</body>

</html>
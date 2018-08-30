<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<meta name="renderer" content="webkit">
		<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>登录</title>
		<link href="/Public/Home/saibangzi/css/login.css" rel="stylesheet" />
	</head>

	<body class="b-log">
		<div class="login_wrap">
			<img src="/Public/Home/saibangzi/img/login.png" class="log-img" />
			<div id="login_body">
				<div class="login_border l">
					<div class="login dis-b">
						<ul class="login-tab">
							<li class="login-on">手机号登录</li>
							<li>验证码登录</li>
						</ul>
						<div class="login-body">
							<!--手机号登录-->
							<div class="login-style dis-b">
							
								<dl>
									<dd><input name="phone" type="text" id="txtUser" placeholder="请输入手机号"/></dd>
								</dl>
								<dl>
									<dd><input type="password" id="Userpwd"  placeholder="请输入密码" name="pass"/></dd>
								</dl>
								<div class="psword registration"><a href="javascript:void(0);" tabindex="-1" class="right" target="_blank">注册账号</a></div>
								<div class="psword forget"><a href="javascript:void(0);" tabindex="-1" class="right" target="_blank">忘记密码</a></div>
								
								<button id="login" type="button">登 录</button>
								
							</div>

							<!--验证码登录-->
							<div class="login-style">
						
								<dl>
									<dd><input name="phone" type="text" id="phone" placeholder="您的手机号码" /></dd>
								</dl>
								<dl>
									<dd><input type="text" name="verify" id="dynamicPWD" style="width: 133px;" placeholder="短信验证码" /><input type="button" id="btn" class="btn_mfyzm" value="获取动态密码" /></dd>
								</dl>
								
						       <button type="button" id="dynamicLogon">登 录</button>
							</div>
					
						</div>
						<!--合作-->
						<div class="hezuo">
							<h3>使用合作网站的账号登录：</h3>
							<p>
								<a href="https://open.weixin.qq.com/connect/qrconnect?appid=wxe7092125741d3076&redirect_uri=http://www.wyuek.com&response_type=code&scope=snsapi_login&state=3072355978#wechat_redirect"><i class="wx"></i>微信</a>
								<a href="<?php echo U('Threelogin/index');?>"><i class="qq"></i>QQ号</a>
								<a href="javascript:;"><i class="wb" style=""></i>微博</a>
							</p>
						</div>
					</div>
				</div>

				<div class="login_border ll dis-n">
					<div class="login dis-b">
						<ul class="login-tab">
							<li class="login-on">找回密码</li>
						</ul>
						<div class="p-g">
							<dl>
								<dd><input name="phone" type="text" id="huiphone" placeholder="您的手机号码"/></dd>
								<small></small>
							</dl>

							<dl>
								<dd><input type="text" id="huiverify" style="width: 133px;"placeholder="短信验证码" /><input type="button" id="hbtn" class="btn_mfyzm" value="获取动态密码" /></dd>
							</dl>
							<dl>
								<dd><input  type="password" id="huipass" message="请输入正确的密码格式" p="/^[a-zA-Z][a-zA-A0-9]{7,17}$/"  placeholder="请输入您的密码" /></dd>
								<small></small>
							</dl>
							<dl>
								<dd><input  type="password" id="rehuipass"  placeholder="请确认密码"
								message="两次密码不一致"/ /></dd>
								<small></small>
							</dl>
							<button type="button" id="hui">确认</button>
						</div>
						<a href="javascript:;" target="_blank" class="return">返回</a>
					</div>
				</div>

				<div class="login_border lll dis-n">
					<div class="login dis-b">
						<ul class="login-tab">
							<li class="login-on">注册</li>
						</ul>
						<div class="p-g">
							<dl>
								<dd><input name="zphone" type="text" id="zhuphone" placeholder="您的手机号码"   message="请输入正确的手机号格式" p="/^(((13|14|15|18|17|19)\d{9}))$/"/></dd>
								<small></small>
							</dl>
							<dl>
								<dd><input type="text" name="zverify" id="reverify" style="width: 133px;" placeholder="短信验证码" /><input type="button" id="zbtn" class="btn_mfyzm" value="获取动态密码" /></dd>
								<small></small>
							</dl>
							<dl>
								<dd><input name="zpass" type="password" id="repwd" placeholder="请输入您的密码" message="请输入正确的密码格式" p="/^[a-zA-A0-9]{6,16}$/" /></dd>
								<small></small>
							</dl>
							<dl>
								<dd><input  name="zrepass" type="password" placeholder="请确认密码" message="两次密码不一致"/></dd>
								<small></small>
							</dl>
							<button  type="button" id="zhuce">确认</button>
						</div>
						<a href="javascript:;" target="_blank" class="return">返回</a>
					</div>
				</div>
			</div>
		</div>
		<script src="/Public/Home/saibangzi/js/jquery-2.1.0.js"></script>
		<script src="/Public/Home/saibangzi/js/login.js"></script>

	</body>
<script>
	 $('#btn').click(function(){
      var tel = $.trim($('#phone').val());
      $.post('<?php echo U('Verify/verify');?>', {'phone':tel},function(data){
      	//alert(data);
        if(data=='发送成功'){
       	alert('发送成功');
       }else{
     	 alert(data);
        }
      });
    });
	 $('#zbtn').click(function(){
      var tel = $.trim($('#zhuphone').val());
      $.post('<?php echo U('Verify/verify');?>', {'phone':tel},function(data){
       //alert(data);
        if(data=='发送成功'){
       	alert('发送成功');
       }else{
     	 alert(data);
        }
      });
    });
	 $('#hbtn').click(function(){
      var tel = $.trim($('#huiphone').val());
      $.post('<?php echo U('Verify/verify');?>', {'phone':tel},function(data){
       //alert(data);
        if(data=='发送成功'){
       	alert('发送成功');
       }else{
     	 alert(data);
        }
      });
    });
	var f1 = false;    //用户名
	var f2 = false;
	var f3 = false;
	$('[name=zpass]').blur(function(){
		//得到用户输入内容
		var v = $(this).val();
		//判断正则
		eval('var p = '+$(this).attr('p'));

		if(p.test(v)){
			//成功 
			$(this).css('borderColor','green');
			$(this).parent().next().html('格式正确');
			$(this).next().css('color','green');
			f1 = true;
		}else{
			//没通过正则
			$(this).css('borderColor','red');
			$(this).parent().next().html('请输入以数字字母组成的6到16位密码()');
			$(this).next().css('color','red');
					f1 = false;
		}
	})
	$('[name=zrepass]').blur(function(){
		//得到用户输入内容
		var v = $(this).val();
		//判断正则
		var pass=$('[name=zpass]').val();
		if(v==pass){
			//成功 
			$(this).css('borderColor','green');
			$(this).parent().next().html('两次密码一致');
			$(this).next().css('color','green');
			f2 = true;
		}else{
			//没通过正则
			$(this).css('borderColor','red');
			$(this).parent().next().html('两次密码不一致');
			$(this).next().css('color','red');
					f2 = false;
		}
	})
	$('[name=zphone]').blur(function(){
		//得到用户输入内容
		var v = $(this).val();
		//判断正则
		eval('var p = '+$(this).attr('p'));

		if(p.test(v)){
			//成功 
			
			var t = $(this);
			//alert(v);
			$.get("<?php echo U('yanzheng');?>",{'phone':v},function(data){
				if(data == 2){
					//成功 
					t.css('borderColor','green');
					t.parent().next().html('格式正确');
					t.next().css('color','green');
					f3 = true;
				}else{
					//重复
					//没通过正则
					//alert(data);
					t.css('borderColor','red');
					t.parent().next().html('手机号已注册');
					t.next().css('color','red');
					f3 = false;
				}
			})
		}else{
			//没通过正则
			$(this).css('borderColor','red');
			$(this).parent().next().html('请输入正确格式的手机号码');
			$(this).next().css('color','red');
					f3 = false;
		}
	})
	//如果有内容输入不正确的画  不能提交页面
	$('#zhuce').click(function(){
		var phone=$('#zhuphone').val();
		var verify=$('#reverify').val();
		var pass=$('#repwd').val();
		$.post("<?php echo U('Login/regist');?>", {'phone':phone,'pass':pass,'verify':verify},function(data){
        if(data=='注册成功'){
        	alert('注册成功!请登录');
       	  window.location.href="<?php echo U('login/index');?>";
       }else{
       	 alert(data);
     	 window.location.href="<?php echo U('login/index');?>";
        }
      });
	})
	$('#login').click(function(){
		var phone=$('#txtUser').val();
		var pass=$('#Userpwd').val();
		$.post("<?php echo U('Login/passlogin');?>", {'phone':phone,'pass':pass},function(data){
		 	//alert(phone);
        if(data=='登录成功'){
        	//alert('5656565');
       	  window.location.href="<?php echo U('index/index');?>";
       }else{
       	 alert(data);
     	 window.location.href="<?php echo U('login/index');?>";
        }
      });
	})
	$('#dynamicLogon').click(function(){
		var phone=$('#phone').val();
		var verify=$('#dynamicPWD').val();
		$.post("<?php echo U('Login/verifylogin');?>", {'phone':phone,'verify':verify},function(data){
		 	//alert(phone);
        if(data=='登录成功'){
        	//alert('5656565');
       	  window.location.href="<?php echo U('index/index');?>";
       }else{
       	 alert(data);
     	 window.location.href="<?php echo U('login/index');?>";
        }
      });
	})
	$('#huipass').blur(function(){
		//得到用户输入内容
		var v = $(this).val();
		//判断正则
		eval('var p = '+$(this).attr('p'));

		if(p.test(v)){
			//成功 
			$(this).css('borderColor','green');
			$(this).parent().next().html('格式正确');
			$(this).next().css('color','green');
			f1 = true;
		}else{
			//没通过正则
			$(this).css('borderColor','red');
			$(this).parent().next().html('请输入以数字字母组成的8到18位密码(必须以字母开头)');
			$(this).next().css('color','red');
					f1 = false;
		}
	})
	$('#rehuipass').blur(function(){
		//得到用户输入内容
		var v = $(this).val();
		//判断正则
		var pass=$('#huipass').val();
		if(v==pass){
			//成功 
			$(this).css('borderColor','green');
			$(this).parent().next().html('两次密码一致');
			$(this).next().css('color','green');
			f2 = true;
		}else{
			//没通过正则
			$(this).css('borderColor','red');
			$(this).parent().next().html('两次密码不一致');
			$(this).next().css('color','red');
					f2 = false;
		}
	})
	$('#huiphone').blur(function(){
		//得到用户输入内容
		var v = $(this).val();
		var x = $(this);
		//alert(v);
		$.get("<?php echo U('yanzheng');?>",{'phone':v},function(data){
				if(data == 1){
					//成功 
					x.css('borderColor','green');
					x.parent().next().html('手机号正确');
					x.next().css('color','green');
					f3 = true;
				}else{
					//重复
					//没通过正则
					//alert(data);
					x.css('borderColor','red');
					x.parent().next().html('手机号未注册');
					x.next().css('color','red');
					f3 = false;
				}
			})
		
	})
	$('#hui').click(function(){
		var phone=$('#huiphone').val();
		var verify=$('#huiverify').val();
		var pass=$('#huipass').val();
		$.post("<?php echo U('Login/mima');?>", {'phone':phone,'pass':pass,'verify':verify},function(data){
        if(data=='修改成功'){
        	alert('修改成功!请登录');
       	  window.location.href="<?php echo U('login/index');?>";
       }else{
       	 alert(data);
     	 window.location.href="<?php echo U('login/index');?>";
        }
      });
	})
</script>
</html>
	//定义开关
	var f1 = false; 
	var f2 = false;

	$('[name=tel]').blur(function() {

		var v = $(this).val();
		
		eval('var p = ' + $(this).attr('p'));

		if (p.test(v)) {
			//成功 
			$(".tel").css('display', 'block');
			$(".tel").css('color', 'green');
			$(".tel").html("格式正确");

			f1 = true;
		} else {
			//没通过正则
			$(".tel").css('display', 'block');
			$(".tel").css('color', '#F39232');
			$(".tel").html("输入错误");
			f2 = false;
		}
	})

	//如果有内容输入不正确的画  不能提交页面
	$('form').submit(function() {
		$('input').trigger('blur');
		if (f1 && f2) {
			return true;
		}
		return false;
	})


	//验证倒计时js
	var InterValObj; //timer变量，控制时间
	var count = 60; //间隔函数，1秒执行
	var curCount; //当前剩余秒数
	var code = ""; //验证码
	var codeLength = 6; //验证码长度
	function sendMessage() {
		curCount = count;
		var dealType; //验证方式
		var uid = $("#uid").val(); //用户uid
		if ($("#phone").attr("checked") == true) {
			dealType = "phone";
		} else {
			dealType = "email";
		}
		//产生验证码
		for (var i = 0; i < codeLength; i++) {
			code += parseInt(Math.random() * 9).toString();
		}
		//设置button效果，开始计时
		$("#btnSendCoda").attr("disabled", "true");
		$("#btnSendCoda").val(+curCount + "秒再获取");
		InterValObj = window.setInterval(SetRemainTime, 1000); //启动计时器，1秒执行一次
		
	}
	//timer处理函数
	function SetRemainTime() {
		if (curCount == 0) {
			window.clearInterval(InterValObj); //停止计时器
			$("#btnSendCoda").removeAttr("disabled"); //启用按钮
			$("#btnSendCoda").val("重新发送验证码");
			code = ""; //清除验证码。如果不清除，过时间后，输入收到的验证码依然有效    
		} else {
			curCount--;
			$("#btnSendCoda").val(+curCount + "秒再获取");
		}
	}
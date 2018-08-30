
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
		//向后台发送处理数据
		$.ajax({
			type: "POST", //用POST方式传输
			dataType: "text", //数据格式:JSON
			url: 'Login.ashx', //目标地址
			data: "dealType=" + dealType + "&uid=" + uid + "&code=" + code,
			error: function(XMLHttpRequest, textStatus, errorThrown) {},
			success: function(msg) {}
		});
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
	




//正则验证js
//定义开关
	var f1 = false;    
	var f2 = false;
	

	$('[name=name],[name=tel]').blur(function(){
		//得到用户输入内容
		var v = $(this).val();
		//判断正则
		eval('var p = '+$(this).attr('p'));

		if(p.test(v)){
			//成功 
			$(this).css('borderColor','green');
			$(this).next().html('格式正确');
			$(this).next().css("display","block");
			$(this).next().css('color','green');
			f1 = true;
		}else{
			//没通过正则
			$(this).css('borderColor','red');
			$(this).next().html('格式错误');
			$(this).next().css("display","block");
			$(this).next().css('color','red');
			f1 = false;
		}
	})
	//如果有内容输入不正确的画  不能提交页面
	$('form').submit(function(){
		$('input').trigger('blur');
		if(f1){
			return true;
		}
		return false;
	})












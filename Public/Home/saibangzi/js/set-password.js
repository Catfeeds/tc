	//定义开关
	var f1 = false; //用户名
	var f2 = false;
	$('input').focus(function() {
		$(this).css('borderColor', '#5F9AE5');
		//获得message
		var zhi = $(this).attr('message');
		$(this).next().html(zhi);
	})

	$('[name=pass]').blur(function() {

		//得到用户输入内容
		var v = $(this).val();
		//判断正则
		eval('var p = ' + $(this).attr('p'));

		if (p.test(v)) {
			//成功 
			$(".t-tit2").css('display', 'block');

			f1 = true;
		} else {
			//没通过正则
			$(".t-tit").css('display', 'block');
			f1 = false;
		}
	})

	$('[name=passw]').blur(function() {
		//得到用户输入内容
		var v = $(this).val();
		//判断正则
		var pa = $('[name=pass]').val();
		if (v == pa) {
			//成功 
			$(".t-tit3").css('display', 'block');
			$(".t-tit3").html("两次密码一致");
			$(".t-tit3").css('color', 'green');

			f2 = true;
		} else {
			//没通过正则
             
			$(".t-tit3").css('display', 'block');
			$(".t-tit3").html("两次密码不同");
			$(".t-tit3").css('color', '#F39232');

			f2 = false;
		}
	})
	

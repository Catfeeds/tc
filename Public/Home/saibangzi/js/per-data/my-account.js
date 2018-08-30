			//修改按钮
			window.onload = function() {
			
				$("#change-1").click(function() {
			
					if ($(".change-1").is(":hidden")) {
						$(".change-1").show(); //如果元素为隐藏,则将它显现
					} else {
						$(".change-1").hide(); //如果元素为显现,则将其隐藏
					}
				});
			
				$("#change-1-1").click(function() {
			
					$(".change-1").hide(); //如果元素为显现,则将其隐藏
				});
			
				$("#change-2").click(function() {
			
					if ($(".change-2").is(":hidden")) {
						$(".change-2").show(); //如果元素为隐藏,则将它显现
					} else {
						$(".change-2").hide(); //如果元素为显现,则将其隐藏
					}
				});
			
				$("#change-2-2").click(function() {
			
					$(".change-2").hide(); //如果元素为显现,则将其隐藏
				});
			
			}
			
			
//表单验证			
			//定义开关
			var f1 = false;
			var f2 = false;
			var f3 = false;
			
			$('[name=newpassw]').blur(function() {
				//得到用户输入内容
				var v = $(this).val();
				//判断正则
				eval('var p = ' + $(this).attr('p'));
			
				if (p.test(v)) {
					//成功 
					$(this).css('borderColor', 'green');
					$(".ps-2").html('格式正确');
					$(".ps-2").css({"color": "green","display": "block"});
					f1 = true;
				} else {
					//没通过正则
					$(this).css('borderColor', 'red');
					$(".ps-2").html('密码由6位数字组成');
					$(".ps-2").css({"color": "red","display": "block"});
					f1 = false;
				}
			})
			
			$('[name=compassw]').blur(function() {
				//得到用户输入内容
				var v = $(this).val();
				//判断正则
				var pass = $('[name=newpassw]').val();
				if (v == pass) {
					//成功 
					$(this).css('borderColor', 'green');
					$(".ps-3").html('格式正确');
					$(".ps-3").css({"color": "green","display": "block"});
					f2 = true;
				} else {
					//没通过正则
					$(this).css('borderColor', 'red');
					$(".ps-3").html('密码不一致');
					$(".ps-3").css({"color": "red","display": "block"});
					f2 = false;
				}
			})
			
			$('[name=newpassw2]').blur(function() {
				//得到用户输入内容
				var v = $(this).val();
				//判断正则
				eval('var p = ' + $(this).attr('p'));
			
				if (p.test(v)) {
					//成功 
					$(this).css('borderColor', 'green');
					$(".ps-2-2").html('格式正确');
					$(".ps-2-2").css({"color": "green","display": "block"});
					f1 = true;
				} else {
					//没通过正则
					$(this).css('borderColor', 'red');
					$(".ps-2-2").html('密码由6~18位数字和字母组成,必须有数字和字母');
					$(".ps-2-2").css({"color": "red","display": "block"});
					f1 = false;
				}

			})
			
			$('[name=compassw2]').blur(function() {
				//得到用户输入内容
				var v = $(this).val();
				//判断正则
				var pass = $('[name=newpassw2]').val();
				if (v == pass) {
					//成功 
					$(this).css('borderColor', 'green');
					$(".ps-3-3").html('格式正确');
					$(".ps-3-3").css({"color": "green","display": "block"});
					f2 = true;
				} else {
					//没通过正则
					$(this).css('borderColor', 'red');
					$(".ps-3-3").html('密码不一致');
					$(".ps-3-3").css({"color": "red","display": "block"});
					f2 = false;
				}
			})
			
			//如果有内容输入不正确的画  不能提交页面
			
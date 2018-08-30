

//input搜索历史
			$("#search").focus(function() {
				$(".history-search").css("display", "block");
				$(".remen_1,.remen_2").css("display", "none");
				$(".glyphicon").css("color", "#ff9933");
				$(".search-inp").css("border-bottom", "1px solid #ff9933");
			});

			$("#search").blur(function() {
				$(".history-search").css("display", "none");
				$(".remen_1,.remen_2").css("display", "block");
				$(".glyphicon").css("color", "#dddddd");
				$(".search-inp").css("border-bottom", "1px solid #dddddd");
			});


//文字字数限制
			$(function() {
				str = $(".t-int").text().substr(0, 27) + " ...";
				$(".t-int p").text(str);
			})


//表单验证

			//定义开关
			var f1 = false; //用户名
			var f2 = false;
			var  f3= false;
			$('input').focus(function() {
					$(this).css('borderColor', '#5F9AE5');
					//获得message
					var zhi = $(this).attr('message');
					$(this).next().html(zhi);

				})
			
			
			
				//用户名失效
			$('[name=id]').blur(function() {
				//得到用户输入内容
				var v = $(this).val();

				//判断正则
				eval('var p = ' + $(this).attr('p'));
				//console.log(typeof p);

				if (p.test(v)) {

					//通过了正则
					//用户名是否重复  ajax 
					var t = $(this);

					
							//成功 
							t.css('borderColor', 'green');
							t.parent().next().html('格式正确');
							t.parent().next().css({"padding-top":"10px","color":"green"});
							f1 = true;
						
				} else {
					//没通过正则
					$(this).css('borderColor', 'red');
					$(this).parent().next().html('请输入正确的身份证号');
					$(this).parent().next().css({"padding-top":"10px","color":"red"});
					f1 = false;
				}
			})



			$('[name=name]').blur(function() {
				//得到用户输入内容
				var v = $(this).val();
				//判断正则
				eval('var p = ' + $(this).attr('p'));

				if (p.test(v)) {
					//成功 
					$(this).css('borderColor', 'green');
					$(this).parent().next().html('格式正确');
					$(this).parent().next().css({"padding-top": "10px","color": "green"});

					f2 = true;
				} else {
					//没通过正则
					$(this).css('borderColor', 'red');
					$(this).parent().next().html('请输入正确的格式');
					$(this).parent().next().css({"padding-top": "10px","color": "red"});
					f2 = false;
				}
			})
			$('[name=tel]').blur(function() {
				//得到用户输入内容
				var v = $(this).val();
				//判断正则
				eval('var p = ' + $(this).attr('p'));

				if (p.test(v)) {
					//成功 
					$(this).css('borderColor', 'green');
					$(this).parent().next().html('格式正确');
					$(this).parent().next().css({"padding-top": "10px","color": "green"});

					f3 = true;
				} else {
					//没通过正则
					$(this).css('borderColor', 'red');
					$(this).parent().next().html('请输入正确的格式');
					$(this).parent().next().css({"padding-top": "10px","color": "red"});
					f3 = false;
				}
			})
			//如果有内容输入不正确的画  不能提交页面
			$('.form-horizontal').submit(function() {
				$('input').trigger('blur');
				if (f1 && f2  && f3) {

					return true;
				}
				return false;
			})



			
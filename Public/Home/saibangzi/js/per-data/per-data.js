				var $div_li = $("#tab_menu ul li");
				
				$div_li.click(function() {
				
					$(this).addClass("current").siblings().removeClass("current");
				
					var div_index = $div_li.index(this);
				
					$("#tab_box>div").eq(div_index).show().siblings().hide();
				
				}).hover(function() {
				
					$(this).addClass("hover");
				
				}, function() {
				
					$(this).removeClass("hover");
				
				});
				
	//个人简介字数控制
				var maxstrlen = 50;
				
				function Q(s) {
					return document.getElementById(s);
				}
				
				function checkWord(c) {
					len = maxstrlen;
					var str = c.value;
					myLen = getStrleng(str);
					var wck = Q("wordCheck");
					if (myLen > len * 2) {
						c.value = str.substring(0, i + 1);
					} else {
						wck.innerHTML = Math.floor((len * 2 - myLen) / 2);
					}
				}
				
				function getStrleng(str) {
					myLen = 0;
					i = 0;
					for (;
						(i < str.length) && (myLen <= maxstrlen * 2); i++) {
						if (str.charCodeAt(i) > 0 && str.charCodeAt(i) < 120)
							myLen++;
						else
							myLen += 2;
					}
					return myLen;
				}
				



               
// 浮动菜单
		        $('.tab_qiehuan').hover(function(){
			         $(this).children(".bianhuabeijing").css("background-color","#8a8f93").next().css("display","block")
				},function(){
			    	 $(this).children(".bianhuabeijing").css("background-color","rgba(36,39,43,.0000001)").next().css("display","none")
				});
				
// 返回顶部
				function b() {
//					h = $(window).height(),
                    h = 1,
					t = $(document).scrollTop(),
					t > h ? $("#moquu_top").show() : $("#moquu_top").hide()
				}
				$(document).ready(function() {
					b(),
					$("#moquu_top").click(function() {
						$(document).scrollTop(0)
					})
				}),
				$(window).scroll(function() {
					b()
				});
				

//下载APP
			$("#xiazai").hover(function() {
				$('.download-app').fadeIn();
			}, function() {
				$('.download-app').fadeOut();
			});

//input搜索历史
			$(".nav-3 input").focus(function() {
				$(".history-search").css("display", "block");
				$(".remen_1,.remen_2").css("display", "none");
				$(".glyphicon").css("color", "#ff9933");
				$(".search-inp").css("border-bottom", "1px solid #ff9933");
			});

			$(".nav-3 input").blur(function() {
				$(".history-search").css("display", "none");
				$(".remen_1,.remen_2").css("display", "block");
				$(".glyphicon").css("color", "#dddddd");
				$(".search-inp").css("border-bottom", "1px solid #dddddd");
			});

//icon历史记录		
			
			$("#icon-history").hover(function() {
				$(this).find(".icon-history").fadeIn();
			}, function() {
				$(this).find(".icon-history").fadeOut();
			});
			$("#touxiang").hover(function() {
				$('.touxiang-list').fadeIn();
			}, function() {
				$('.touxiang-list').fadeOut();
			});
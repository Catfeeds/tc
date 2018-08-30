
			// tab切换js		
			$(function() {
				function tabs(tabTit, on, tabCon) {
					$(tabTit).children().click(function() {
						$(this).addClass(on).siblings().removeClass(on);					
						var index = $(tabTit).children().index(this);
						$(tabCon).children().eq(index).show().siblings().hide();
					});
				};
				tabs(".tab-hd", "active",  ".tab-bd");
			});

			// 课程目录鼠标移入事件
			$(function() {
				$(".section").mouseover(function() {
					$(this).css("background-color", "rgba(255,153,51,0.1)");
					$(this).find('.f-f4').css("display", "none");
					$(this).find('.f-f3').css("display", "block");

				});
				$(".section").mouseleave(function() {
					$(this).css("background-color", "#FFFFFF");
					$(this).find('.f-f4').css("display", "block");
					$(this).find('.f-f3').css("display", "none");
				});

			});

			// 收藏js
			$(function() {
				
			});

			//已报名js          
			$(function() {
				
			});
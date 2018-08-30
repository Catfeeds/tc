
//表单验证

	//定义开关
	var f1 = false;    //用户名
	var f2 = false;



	$('[name=wenben]').blur(function() {
		
		var len = $('[name=wenben]').val().length;
			if(len<100&&len>1){
			   $(this).css('borderColor','green');
			   $(this).parent().next().html('格式正确');
			   $(this).parent().next().css({"color":"green","padding-top":"70px"});
				f1=true;
			}else{
		    	$(this).css('borderColor','red');
				$(this).parent().next().html('请输入小于100个字的意见反馈');
				$(this).parent().next().css({"color":"red","padding-top":"70px"});			
				f1=false;
		}
	})
	
	
	$('[name=tel]').blur(function() {
	
		var len = $('[name=tel]').val().length;
			if(len<40&&len>10){
			   $(this).css('borderColor','green');
			   $(this).parent().next().html('格式正确');
			   $(this).parent().next().css({"color":"green","padding-top":"10px"});
				f2=true;
			}else{
		    	$(this).css('borderColor','red');
				$(this).parent().next().html('请输入正确的手机号码');
				$(this).parent().next().css({"color":"red","padding-top":"10px"});			
				f2=false;
		}
	})
	
	
	
	//如果有内容输入不正确的画  不能提交页面
	


//意见反馈textarea文字限制
		var maxstrlen=100;
	    function Q(s){return document.getElementById(s);}
	    function checkWord(c){
	        len=maxstrlen;
	        var str = c.value;
	        myLen=getStrleng(str);
	        var wck=Q("wordCheck");
	        if(myLen>len){
	            c.value=str.substring(0,str.length);
	        }
	        else{
	            wck.innerHTML = Math.floor(len-myLen);
	           }
	    }
	    function getStrleng(str){
	        myLen =0;
	        i = 0;
	        for(;(i<str.length)&&(myLen<=maxstrlen);i++){
	        myLen++;
	    }
	    return myLen;
	}



				
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
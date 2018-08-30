
	//定义开关
	var f1 = false;     // 用户名
	var f2 = false;		// 课程介绍文本
	var f3 = false;		// 时间
	var f4 = false;     // 价格
	var f5 = false;     // 图片
	$('input').focus(function(){
		$(this).css('borderColor','#5F9AE5');
		//获得message
		var zhi = $(this).attr('message');
		$(this).next().html(zhi);
		
	})


	
	//用户名失效
	$('[name=user]').blur(function(){
		//得到用户输入内容
		var v = $(this).val().length;

		
		if(v<30&&v>0){

			//通过了正则
			//用户名是否重复  ajax 
			var t = $(this);

		
					//成功 				
					t.css('borderColor','green');
					t.parent().next().html('格式正确');
			        t.parent().next().css({"padding-top":"10px","color":"green"});
						
					f1 = true;
					
					
				
		}else{
			//没通过正则
			$(this).css('borderColor','red');
			$(this).parent().next().html('请输入30字以内标题');
			$(this).parent().next().css({"padding-top":"10px","color":"red"});
			f1 = false;
		}
	})
	
	
	
		//判断文本域文字个数
	$('[name=wenben]').blur(function(){
		//得到用户输入内容
	
		var len = $('[name=wenben]').val().length;
			if(len<1000&&len>15){
			   $(this).css('borderColor','green');
			   $(this).parent().next().html('格式正确');
			   $(this).parent().next().css({"padding-top":"50px","color":"green"});
				f2=true;
			}else{
		    	$(this).css('borderColor','red');
				$(this).parent().next().html('请输入大于15小于1000的文字个数');
				$(this).parent().next().css({"padding-top":"50px","color":"red"});
				f2=false;
		}
	})
	
	
	
	//如果有内容输入不正确的画  不能提交页面
	


function subBtn() {
	if(!$('input:radio[name="pattern"]:checked').val()){
		alert("请选择收费模式！");
		return false;
	}
	if($('input:radio[name="pattern"]:checked').val() == 1){
		if($('.controlBox .form-control').val() == ''){
			alert("请输入收费金额！");
			return false;
		}
	}
	var form= new FormData(document.getElementById("meform"));
	console.log(form);
	if (f1 && f2) {
		$.ajax({
			type:'post',
			url:"http://www.wyuek.com/Home/Courses/add",
			data:form,
			processData: false,  // 不处理数据
	  		contentType: false,   // 不设置内容类型
			success:function(date){
				console.log(date);
				if(date=='预约成功！'){
					alert(date);
					window.location.href="http://www.wyuek.com/Home/Courses/teacher";
				}else{
					alert(date);

				}
			},
			error:function(err){
				alert(err);
			}
		});
	}
	return false;
}

//日历脚本

	   

//文字字数限制显示省略号
		$(function() {
			str = $(".t-int").text().substr(0, 25) + " ...";
			$(".t-int p").text(str);
		})
		
				
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
				$(".search").css("color", "#ff9933");
				$("#search").css("border-bottom", "1px solid #ff9933");
			});

			$("#search").blur(function() {
				$(".history-search").css("display", "none");
				$(".remen_1,.remen_2").css("display", "block");
				$(".glyphicon").css("color", "#dddddd");
				$("#search").css("border-bottom", "1px solid #dddddd");
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




				$(document).ready(function (){
					//时间插件
						//时间插件
					$('#reportrange input').val(moment().format('YYYY-MM-DD HH:mm:ss') + ' ~' + moment().subtract('hours', -1).format('YYYY-MM-DD HH:mm:ss'));
	              
	              
					$('#reportrange').daterangepicker(
						
						
						
							{
								// startDate: moment().startOf('day'),
								//endDate: moment(),
								//minDate: '01/01/2012',	//最小时间
								
							
								     
								dateLimit : {
									days : 30
								}, //起止时间的最大间隔
								showDropdowns : true,
								showWeekNumbers : false, //是否显示第几周
								timePicker : true, //是否显示小时和分钟
								timePickerIncrement : 1, //时间的增量，单位为分钟
								timePicker12Hour : false, //是否使用12小时制来显示时间

								ranges : {
									//'最近1小时': [moment().subtract('hours',1), moment()],
									'今日': [moment().startOf('day'), moment()],
				                    '昨日': [moment().subtract('days', 1).startOf('day'), moment().subtract('days', 1).endOf('day')],
				                    '最近7日': [moment().subtract('days', 6), moment()],
				                    '最近30日': [moment().subtract('days', 29), moment()]
								},
								opens : 'right', //日期选择框的弹出位置
								buttonClasses : [ 'btn btn-default' ],
								applyClass : 'btn-small btn-primary blue',
								cancelClass : 'btn-small',
								format : 'YYYY-MM-DD HH:mm:ss', //控件中from和to 显示的日期格式
								separator : ' to ',
								locale : {
									applyLabel : '确定',
									cancelLabel : '取消',
									fromLabel : '起始时间',
									toLabel : '结束时间',
									customRangeLabel : '自定义',
									daysOfWeek : [ '日', '一', '二', '三', '四', '五', '六' ],
									monthNames : [ '一月', '二月', '三月', '四月', '五月', '六月',
											'七月', '八月', '九月', '十月', '十一月', '十二月' ],
									firstDay : 1
								}
							}, 
							function(start, end, label) 
							{//格式化日期显示框
				                
			                 	$('#reportrange input').val(start.format('YYYY-MM-DD HH:mm:ss') + ' ~ ' + end.format('YYYY-MM-DD HH:mm:ss'));
			                }
							
					);
		})

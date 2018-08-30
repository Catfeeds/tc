
	//定义开关
	var f1 = false;    //用户名
	$('input').focus(function(){
		$(this).css('borderColor','#5F9AE5');
		//获得message
		var zhi = $(this).attr('message');
		$(this).next().html(zhi);
		
	})
	
	
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
		
	
	
	
	
	
	
	
	
//如果有内容输入不正确的画  不能提交页面
	$('form').submit(function(){
		$('input').trigger('blur');
		if(f1){
			return true;
		}
		return false;
	})



//更换头像
  //图片上传预览    IE是用了滤镜。
        function previewImage(file)
        {
          var MAXWIDTH  = 90; 
          var MAXHEIGHT = 90;
          var div = document.getElementById('preview');
          if (file.files && file.files[0])
          {
              div.innerHTML ='<img id=imghead onclick=$("#previewImg").click()>';
              var img = document.getElementById('imghead');
              img.onload = function(){
                var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight);
                img.width  =  rect.width;
                img.height =  rect.height;
//                 img.style.marginLeft = rect.left+'px';
                img.style.marginTop = rect.top+'px';
              }
              var reader = new FileReader();
              reader.onload = function(evt){img.src = evt.target.result;}
              reader.readAsDataURL(file.files[0]);
          }
          else //兼容IE
          {
            var sFilter='filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale,src="';
            file.select();
            var src = document.selection.createRange().text;
            div.innerHTML = '<img id=imghead>';
            var img = document.getElementById('imghead');
            img.filters.item('DXImageTransform.Microsoft.AlphaImageLoader').src = src;
            var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight);
            status =('rect:'+rect.top+','+rect.left+','+rect.width+','+rect.height);
            div.innerHTML = "<div id=divhead style='width:"+rect.width+"px;height:"+rect.height+"px;margin-top:"+rect.top+"px;"+sFilter+src+"\"'></div>";
          }
        }
        function clacImgZoomParam( maxWidth, maxHeight, width, height ){
            var param = {top:0, left:0, width:width, height:height};
            if( width>maxWidth || height>maxHeight ){
                rateWidth = width / maxWidth;
                rateHeight = height / maxHeight;
                
                if( rateWidth > rateHeight ){
                    param.width =  maxWidth;
                    param.height = Math.round(height / rateWidth);
                }else{
                    param.width = Math.round(width / rateHeight);
                    param.height = maxHeight;
                }
            }
            param.left = Math.round((maxWidth - param.width) / 2);
            param.top = Math.round((maxHeight - param.height) / 2);
            return param;
        }
//     tooltip
 $(function () {
			  $('[data-toggle="tooltip"]').tooltip()
			})
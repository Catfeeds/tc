
	
	var index = 0;
	var cosBox = [];
	/** 
	 * 计算签名
	**/
	var getSignature = function(callback){
		var token=$('#token').val();
		$.ajax({
			url: 'http://www.wyuek.com/Api/Template/videosig',
			data: {
				"token":token,
			},
			type: 'POST',
			dataType:'json',
			success: function(res){
				if(res.result.sign) {
					callback(res.result.sign);
				} else {
					return '获取签名失败';
				}
				
			},
			error: function(err){
				alert(err);
			}
		});
	};

	/**
	 * 添加上传信息模块
	 */
	
	var addUploaderMsgBox = function(type){
		var html = '<div class="progress progress-striped uploaderMsgBox"><div class="progress-bar progress-bar-success" id="progress-bar1" role="progressbar"aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"style="width: 10%;"><a style="color:#fff">视频上传进度：</a style="color:#fff"><span name="videosha'+index+'">0%</span></div></div><div class="progress progress-striped uploaderMsgBox"><div class="progress-bar progress-bar-success " id="progress-bar2" role="progressbar"aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"style="width: 10%;"><a style="color:#fff">图片上传进度：</a><span name="coversha'+index+'">0%</span></div></div><div><span class="tipf">视频文件上传后，请确认视频信息后，点击保存 ，以完成视频上传</span></div>';
//		var htmc = '';
		
	    var html1 = '<div class="uploaderMsgBox1" name="box'+index+'">';
		if(!type || type == 'hasVideo') {
			html += 
//				'计算sha进度：<span name="videosha'+index+'">0%</span>;' +
			    '视频上传结果：<span name="videoresult'+index+'">   </span>；<br>' + 
			    '<span name="videourl'+index+'" style="display:none">   </span>'+
			    '<span name="videofileId'+index+'" style="display:none">   </span>；' +			
				'<a href="javascript:void(0);" name="cancel'+index+'" cosnum='+index+' act="cancel-upload">取消上传</a><br>';
				html1 +=
			    '视频名称：<span name="videoname'+index+'"></span>；' +
				'上传进度：<span name="videocurr'+index+'">0%</span>；' + 
				'fileId：<span name="videofileId'+index+'">   </span>；'  
				;
		}
		
		
	
		
		
		if(!type || type == 'hasCover') {
			html += 
//				'计算sha进度：<span name="coversha'+index+'">0%</span>；' + 
				'<span name="coverurl'+index+'" style="display:none">   </span><br>' + 
				'图片上传结果：<span name="coverresult'+index+'">   </span><br>';
				
		 	html1 += 
				'上传进度：<span name="covercurr'+index+'">0%</span>；' + 
				'上传结果：<span name="coverresult'+index+'">   </span>；<br>' + 
				
				'</div>'
			}
		
		
		html += '</div>';
		
		$('#resultBox').append(html);
		return index++;
	};

	/** 
	 * 示例1：直接上传视频
	**/
	$('#uploadVideoNow-file').on('change', function (e) {
		var num = addUploaderMsgBox('hasVideo');
		var videoFile = this.files[0];
		$('#result').append(videoFile.name +　'\n');
		var resultMsg = qcVideo.ugcUploader.start({
		videoFile: videoFile,
		getSignature: getSignature,
		allowAudio: 1,
		success: function(result){
			if(result.type == 'video') {
				$('[name=videosha'+num+']').text('100%');
				$('[name=videocurr'+num+']').text('100%');
				$('#progress-bar1').css('width','100%')

				$('[name=videoresult'+num+']').text('上传成功');
				$('[name=cancel'+num+']').remove();
				cosBox[num] = null;
			} else if (result.type == 'cover') {
				$('[name=coversha'+num+']').text('100%');
				$('[name=covercurr'+num+']').text('100%');
				$('#progress-bar2').css('width','100%')

				$('[name=coverresult'+num+']').text('上传成功');
			}
		},
		error: function(result){
			if(result.type == 'video') {
				$('[name=videoresult'+num+']').text('上传失败>>'+result.msg);
			} else if (result.type == 'cover') {
				$('[name=coverresult'+num+']').text('上传失败>>'+result.msg);
			}
		},
		progress: function(result){
			console.log(Math.floor(result.shacurr*100)+'%');
					if(result.type == 'video') {
						$('[name=videoname'+num+']').text(result.name);
						$('[name=videosha'+num+']').text(Math.floor(result.shacurr*100)-1+'%');
						$('[name=videocurr'+num+']').text(Math.floor(result.curr*100)-1+'%');
						$('#progress-bar1').css('width',Math.floor(result.shacurr*100)-1+'%')
						$('[name=cancel'+num+']').attr('taskId', result.taskId);
						cosBox[num] = result.cos;
					} else if (result.type == 'cover') {
						$('[name=covername'+num+']').text(result.name);
						$('[name=coversha'+num+']').text(Math.floor(result.shacurr*100)-1+'%');
						$('[name=covercurr'+num+']').text(Math.floor(result.curr*100)-1+'%');
						$('#progress-bar2').css('width',Math.floor(result.shacurr*100)-1+'%')
					}
				},
		finish: function(result){
			$('[name=videofileId'+num+']').text(result.fileId);
			$('[name=videourl'+num+']').text(result.videoUrl);
			if(result.message) {
				$('[name=videofileId'+num+']').text(result.message);
			}
		}
		});
		if(resultMsg){
			$('[name=box'+num+']').text(resultMsg);
		}
		$('#form1')[0].reset();
	});
	$('#uploadVideoNow').on('click', function () {
		$('#uploadVideoNow-file').click();
	});
	/*
	 * 取消上传绑定事件，示例一与示例二通用
	 */
	$('#resultBox').on('click', '[act=cancel-upload]', function() {
		var cancelresult = qcVideo.ugcUploader.cancel({
			cos: cosBox[$(this).attr('cosnum')],
			taskId: $(this).attr('taskId')
		});
		console.log(cancelresult);
	});


	/** 
	 * 示例2：上传视频+封面
	**/
	var videoFileList = [];
	var coverFileList = [];
	// 给addVideo添加监听事件
	$('#addVideo-file').on('change', function (e) {
		var videoFile = this.files[0];
		videoFileList[0] = videoFile;
		$('#result').append(videoFile.name +　'\n');

	});
	$('#addVideo').on('click', function () {
		$('#addVideo-file').click();
	});
	// 给addCover添加监听事件
	$('#addCover-file').on('change', function (e) {
		var coverFile = this.files[0];
		coverFileList[0] = coverFile;
		$('#result').append(coverFile.name +　'\n');

	});
	$('#addCover').on('click', function () {
		$('#addCover-file').click();
	});

	var startUploader = function(){
		if(videoFileList.length){
			var num = addUploaderMsgBox();
			if(!coverFileList[0]){
				$('[name=covername'+num+']').text('没有上传封面');
			}
			var filesize=videoFileList[0].size;
			var filetype=videoFileList[0].name;
			var type=filetype.split(".");
			var arr=type[type.length-1];
			console.log(arr);
			//alert(arr);
			if(filesize>3221225472){
				alert('文件大小不符合上传要求，禁止上传');
				return false;
			}else if(arr != 'mp4' && arr != 'mov'){
				alert('文件格式不符合上传要求，禁止上传');
				return false;
			}else{
				var resultMsg = qcVideo.ugcUploader.start({
					videoFile: videoFileList[0],
					coverFile: coverFileList[0],
					getSignature: getSignature,
					allowAudio: 1,
					success: function(result){
						console.log(123);
						if(result.type == 'video') {
							$('[name=videosha'+num+']').text('100%');
							$('[name=videocurr'+num+']').text('100%');
							$('#progress-bar1').css('width','100%');

							$('[name=videoresult'+num+']').text('上传成功');
							$('[name=cancel'+num+']').remove();
							cosBox[num] = null;
						} else if (result.type == 'cover') {
							$('[name=coversha'+num+']').text('100%');
							$('[name=covercurr'+num+']').text('100%');
							$('#progress-bar2').css('width','100%');

							$('[name=coverresult'+num+']').text('上传成功');
						}				
					},
					error: function(result){
						if(result.type == 'video') {
							$('[name=videoresult'+num+']').text('上传失败>>'+result.msg);
						} else if (result.type == 'cover') {
							$('[name=coverresult'+num+']').text('上传失败>>'+result.msg);
						}
					},
					progress: function(result){
						console.log(result.name);
						console.log(Math.floor(result.shacurr*100)+'%');
						if(result.type == 'video') {
							$('[name=videoname'+num+']').text(result.name);
							$('[name=videosha'+num+']').text(Math.floor(result.shacurr*100)-1+'%');
							$('[name=videocurr'+num+']').text(Math.floor(result.curr*100)-1+'%');
							$('#progress-bar1').css('width',Math.floor(result.shacurr*100)-1+'%')
							$('[name=cancel'+num+']').attr('taskId', result.taskId);
							cosBox[num] = result.cos;
						} else if (result.type == 'cover') {
							$('[name=covername'+num+']').text(result.name);
							$('[name=coversha'+num+']').text(Math.floor(result.shacurr*100)-1+'%');
							$('[name=covercurr'+num+']').text(Math.floor(result.curr*100)-1+'%');
							$('#progress-bar2').css('width',Math.floor(result.shacurr*100)-1+'%')
						}
					},
					finish: function(result){
						$('[name=videofileId'+num+']').text(result.fileId);
						$('[name=videourl'+num+']').text(result.videoUrl);
						if(result.coverUrl) {
							$('[name=coverurl'+num+']').text(result.coverUrl);
						}
						if(result.message) {
							$('[name=videofileId'+num+']').text(result.message);
						}
						var text=$('[name=videoresult'+num+']').text();
						var text1=$('[name=coverresult'+num+']').text();
						if(text=='上传成功' && text1=='上传成功'){
							 var url=$('[name=videourl0]').text();
			 
							 var img=$('[name=coverurl0]').text();
							 var fileid=$('[name=videofileId0]').text();
							 var name=$('[name=user]').val();
							 var class_id=$('[name=classid]').val();
							 var cate_id=$('[name=zzid]').val();
							 var jieshao=$('[name=wenben]').val();
							 var money=$('[name=money]').val();
							 //alert(fileid);
							 //alert(url)
							if(f1==false && f2==false){
										return false;
									}
							if(url=='' || img=='' || cate_id=='' || jieshao==''){
										return false;
									}
							$.post("http://www.wyuek.com/Home/Courses/addvideo",{'img':img,'url':url,
								'name':name,'class_id':class_id,
								'cate_id':cate_id,'jieshao':jieshao,
								'money':money,'fileid':fileid},function(data){
								if(data=='上传成功'){
									alert(data);
									window.location.href="http://www.wyuek.com/Home/Courses/teachervideo";
								}else{
									alert(data);
								}
							});
						}
					}
				});
			}
			if(resultMsg){
				$('[name=box'+num+']').text(resultMsg);
			}
		} else {
			$('#result').append('请添加视频！\n');
		}
		
	}

	// 上传按钮点击事件
	$('#uploadFile').on('click', function () {
		var secretId = $('#secretId').val();
		var secretKey = $('#secretKey').val();
		startUploader();
		
		// $('#form2')[0].reset();
	});

/*$('.sign-up').click(function(){
		var url=$('[name=videourl0]').text();
		 
		 var img=$('[name=coverurl0]').text();
		 var fileid=$('[name=videofileId0]').text();
		 var name=$('[name=user]').val();
		 var class_id=$('[name=classid]').val();
		 var cate_id=$('[name=zzid]').val();
		 var jieshao=$('[name=wenben]').val();
		 var money=$('[name=money]').val();
		 //alert(fileid);
		 alert(url)
		if(f1==false && f2==false){
					return false;
				}
		if(url=='' || img=='' || cate_id=='' || jieshao==''){
					return false;
				}
		$.post("http://www.wyuek.com/Home/Courses/addvideo",{'img':img,'url':url,
			'name':name,'class_id':class_id,
			'cate_id':cate_id,'jieshao':jieshao,
			'money':money,'fileid':fileid},function(data){
			if(data=='上传成功'){
				alert(data);
				window.location.href="http://www.wyuek.com/Home/Courses/teacher";
			}else{
				alert(data);
			}
		});
	})*/


	
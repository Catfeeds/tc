//定义开关
var f1 = false;
var f2 = false;

$('[name=name]').blur(function() {
	//得到用户输入内容
	var v = $(this).val();
	//判断正则
	eval('var p = ' + $(this).attr('p'));

	if (p.test(v)) {
		//成功 
		$(this).css('borderColor', 'red');
		$(this).next().css('display', 'block');
		$(this).next().html('不能为空');
		$(this).next().css('color', 'red');
		f1 = true;
	} else {
		//没通过正则		
		$(this).css('borderColor', 'green');
		$(this).next().css('display', 'block');
		$(this).next().html('成功');
		$(this).next().css('color', 'green');
		f1 = false;
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
		$(this).next().css('display', 'block');
		$(this).next().html('成功');
		$(this).next().css('color', 'green');
		f2 = true;
	} else {
		//没通过正则
		$(this).css('borderColor', 'red');
		$(this).next().css('display', 'block');
		$(this).next().html('手机号不正确');
		$(this).next().css('color', 'red');
		f2 = false;
	}
})

//如果有内容输入不正确的画  不能提交页面
$('form').submit(function() {
	$('input').trigger('blur');
	if (f1 && f2) {
		return true;
	}
	return false;
})
$("#zhishi").click(function() {
    $(this).hide();
})
$(".qiehuan").click(function (){
	$("#zhishi").hide(1000);
	$(this).parents(".login").hide().siblings().show();	
});


$(".login-tab li").click(function () {$(this).addClass("login-on").siblings().removeClass("login-on");
$(".login-style").eq($(this).index()).show().siblings().hide();$(".tishi").hide();})
var wait =60;
// document.getElementById("btn").disabled =false;
function time(o) {
  if (wait ==0) {
    o.removeAttribute("disabled");o.value ="获取动态密码";wait =60;
  } else {
    o.setAttribute("disabled",true);
    o.value ="重新发送(" + wait + ")";
    wait--;setTimeout(function () {time(o);},1000)
  }
}

//点击事件


//忘记密码
$(".forget").click(function(){
  $(".l").hide();
  $(".ll").show();  
});

$(".return").click(function(){
  $(".ll").hide();
  $(".l").show();  
});


//注册账号
$(".registration").click(function(){
  // $(".l").hide();
  $(".lll").show();  
});

$(".return").click(function(){
  $(".lll").hide();
  $(".l").show();  
});
//如果有内容输入不正确的画  不能提交页面
  
  //验证倒计时
  var InterValObj; //timer变量，控制时间
  var count = 60; //间隔函数，1秒执行
  var curCount; //当前剩余秒数
  var code = ""; //验证码
  var codeLength = 6; //验证码长度
  function sendMessage() {
    curCount = count;
    var dealType; //验证方式
    var uid = $("#uid").val(); //用户uid
    if ($("#phone").attr("checked") == true) {
      dealType = "phone";
    } else {
      dealType = "email";
    }
    //产生验证码
    for (var i = 0; i < codeLength; i++) {
      code += parseInt(Math.random() * 9).toString();
    }
    //设置button效果，开始计时
    $(".btn_mfyzm").attr("disabled", true);
    $(".btn_mfyzm").val(+curCount + "秒再获取");
    InterValObj = window.setInterval(SetRemainTime, 1000); //启动计时器，1秒执行一次
    //向后台发送处理数据
    $.ajax({
      type: "POST", //用POST方式传输
      dataType: "text", //数据格式:JSON
      url: 'Login.ashx', //目标地址
      data: "dealType=" + dealType + "&uid=" + uid + "&code=" + code,
      error: function(XMLHttpRequest, textStatus, errorThrown) {},
      success: function(msg) {}
    });
  }
  //timer处理函数
  function SetRemainTime() {
    if (curCount == 0) {
      window.clearInterval(InterValObj); //停止计时器
      $(".btn_mfyzm").removeAttr("disabled"); //启用按钮
      $(".btn_mfyzm").val("重新发送验证码");
      code = ""; //清除验证码。如果不清除，过时间后，输入收到的验证码依然有效    
    } else {
      curCount--;
      $(".btn_mfyzm").val(+curCount + "秒再获取");
    }
  }


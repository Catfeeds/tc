/***统一处理 返回的 json 数据************/
function processData(jsObj, okFunc, errFunc) {
    //根据返回的 数据 状态 执行相应的操作
    switch (jsObj.statu) {
        case "ok"://如果ok则执行 ok回调函数
            if (okFunc) okFunc();
            break;
        case "err"://如果err的话，则 执行 err 回调函数
            if (errFunc) errFunc();
            msgBox.showMsgErr(jsObj.msg);
            break;
        case "np"://没有权限，则直接跳转到指定页面
            msgBox.showMsgErr(jsObj.msg, function () {
                window.location = jsObj.nextUrl;
            });
            break;
    }
}
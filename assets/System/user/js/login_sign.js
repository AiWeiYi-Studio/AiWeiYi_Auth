function GetUrlParam(paraName) {
    var url = document.location.toString();
    var arrObj = url.split("?");
    if (arrObj.length > 1) {
        var arrPara = arrObj[1].split("&");
        var arr;
        for (var i = 0; i < arrPara.length; i++) {
            arr = arrPara[i].split("=");
            if (arr != null && arr[0] == paraName) {
                return arr[1];
            }
        }
        return "";
    } else {
        return "";
    }
}
function reg() {
    var type = GetUrlParam("type");
    var user = $("#user_1").val();
    var pass = $("#pass_1").val();
    var name = $("#name").val();
    var token = $("#token").val();
    var ii = layer.load(0, {
        shade: [0.1, '#fff']
    });
    $.ajax({
        type: "POST",
        url: "ajax_reg.php?act=sign",
        data: {
            type: type,
            user: user,
            pass: pass,
            name: name,
            token: token
        },
        dataType: 'json',
        success: function(data) {
            layer.close(ii);
            layer.msg(data.msg);
            if (data.code == 1) {
                setTimeout(function() {
                    location.href = "./index.php";
                },
                1000);
            }
        },
        error: function(data) {
            layer.close(ii);
            layer.msg('服务器错误！');
            return false;
        }
    });
}
function login() {
    var type = GetUrlParam("type");
    var user = $("#user_2").val();
    var pass = $("#pass_2").val();
    var token = $("#token").val();
    var ii = layer.load(0, {
        shade: [0.1, '#fff']
    });
    $.ajax({
        type: "POST",
        url: "ajax_login.php?act=sign",
        data: {
            type: type,
            user: user,
            pass: pass,
            token: token
        },
        dataType: 'json',
        success: function(data) {
            layer.close(ii);
            layer.msg(data.msg);
            if (data.code == 1) {
                setTimeout(function() {
                    location.href = "./index.php";
                },
                1000);
            }
        },
        error: function(data) {
            layer.close(ii);
            layer.msg('服务器错误！');
            return false;
        }
    });
}
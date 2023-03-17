var items = $("select[default]");
for (i = 0; i < items.length; i++) {
    $(items[i]).val($(items[i]).attr("default") || 0);
}

window.onload = function() {
    var id = GetUrlParam("id");
    var ii = layer.load(0, {
        shade: [0.1, '#fff']
    });
    $.ajax({
        type: "POST",
        url: "ajax_auth.php?act=check_auth",
        data: {
            id: id
        },
        dataType: 'json',
        success: function(data) {
            layer.close(ii);
            if (data.code != 1) {
                layer.msg(data.msg);
                setTimeout(function() {
                    location.href = "./auth_legal.php";
                },
                2000);
            }
        },
        error: function(data) {
            layer.close(ii);
            layer.msg('服务器错误！');
            return false;
        }
    });
};

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
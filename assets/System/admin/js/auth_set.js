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
        url: "ajax_auth.php?act=check_app",
        data: {
            id: id
        },
        dataType: 'json',
        success: function(data) {
            layer.close(ii);
            if (data.code != 1) {
                layer.msg(data.msg);
                setTimeout(function() {
                    location.href = "./auth_app.php";
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

function post() {
    var id = GetUrlParam("id");
    var name = $("#name").val();
    var money_day = $("#money_day").val();
    var money_month = $("#money_month").val();
    var money_year = $("#money_year").val();
    var money_long = $("#money_long").val();
    var download = $("#download").val();
    var notice = $("#notice").val();
    var text = $("#text").val();
    var status = $("#status").val();
    var expand = $("#expand").val();
    var notice_pirate = $("#notice_pirate").val();
    var notice_not = $("#notice_not").val();
    var notice_date = $("#notice_date").val();
    var notice_status = $("#notice_status").val();
    var ii = layer.load(0, {
        shade: [0.1, '#fff']
    });
    $.ajax({
        type: "POST",
        url: "ajax_auth.php?act=set_info",
        data: {
            id: id,
            name: name,
            money_day:money_day,
            money_month:money_month,
            money_year:money_year,
            money_long:money_long,
            download:download,
            notice: notice,
            text: text,
            status: status,
            expand: expand,
            notice_pirate:notice_pirate,
            notice_not:notice_not,
            notice_date:notice_date,
            notice_status:notice_status
        },
        dataType: 'json',
        success: function(data) {
            layer.close(ii);
            layer.msg(data.msg);
            if (data.code == 1) {
                setTimeout(function() {
                    location.href = "./auth_set.php?id=" + data.ID;
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
var items = $("select[default]");
for (i = 0; i < items.length; i++) {
    $(items[i]).val($(items[i]).attr("default") || 0);
}

function api() {
    layer.confirm('确定？', {
        btn: ['确定', '取消'],
        closeBtn: 0,
        icon: 3
    },
    function() {
        var qq = $("#qq").val();
        var alipay = $("#alipay").val();
        var wechat = $("#wechat").val();
        var weibo = $("#weibo").val();
        var ii = layer.load(0, {
            shade: [0.1, '#fff']
        });
        $.ajax({
            type: "POST",
            url: "ajax_system.php?act=set_oauth_api",
            data: {
                qq: qq,
                alipay: alipay,
                wechat: wechat,
                weibo: weibo
            },
            dataType: 'json',
            success: function(data) {
                layer.close(ii);
                layer.msg(data.msg);
                if (data.code == 1) {
                    setTimeout(function() {
                        location.href = "./set_oauth.php";
                    },
                    1000);
                }
            },
            error: function(data) {
                layer.close(ii);
                layer.msg('服务器错误');
                return false;
            }
        });
    });
}

function qq() {
    layer.confirm('确定？', {
        btn: ['确定', '取消'],
        closeBtn: 0,
        icon: 3
    },
    function() {
        var appid = $("#appid").val();
        var appkey = $("#appkey").val();
        var callback = $("#callback").val();
        var ii = layer.load(0, {
            shade: [0.1, '#fff']
        });
        $.ajax({
            type: "POST",
            url: "ajax_system.php?act=set_oauth_qq",
            data: {
                appid: appid,
                appkey: appkey,
                callback: callback
            },
            dataType: 'json',
            success: function(data) {
                layer.close(ii);
                layer.msg(data.msg);
                if (data.code == 1) {
                    setTimeout(function() {
                        location.href = "./set_oauth.php?mod=qq";
                    },
                    1000);
                }
            },
            error: function(data) {
                layer.close(ii);
                layer.msg('服务器错误');
                return false;
            }
        });
    });
}

function clogin() {
    layer.confirm('确定？', {
        btn: ['确定', '取消'],
        closeBtn: 0,
        icon: 3
    },
    function() {
        var url = $("#url").val();
        var appid = $("#appid").val();
        var appkey = $("#appkey").val();
        var ii = layer.load(0, {
            shade: [0.1, '#fff']
        });
        $.ajax({
            type: "POST",
            url: "ajax_system.php?act=set_oauth_clogin",
            data: {
                url: url,
                appid: appid,
                appkey: appkey
            },
            dataType: 'json',
            success: function(data) {
                layer.close(ii);
                layer.msg(data.msg);
                if (data.code == 1) {
                    setTimeout(function() {
                        location.href = "./set_oauth.php?mod=clogin";
                    },
                    1000);
                }
            },
            error: function(data) {
                layer.close(ii);
                layer.msg('服务器错误');
                return false;
            }
        });
    });
}
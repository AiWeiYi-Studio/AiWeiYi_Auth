var items = $("select[default]");
for (i = 0; i < items.length; i++) {
    $(items[i]).val($(items[i]).attr("default")||0);
}
function del(id) {
    layer.confirm('确定？', {
        btn: ['确定', '取消'],
        closeBtn: 0,
        icon: 3
    },
    function() {
        var ii = layer.load(0, {
            shade: [0.1, '#fff']
        });
        $.ajax({
            type: "POST",
            url: "ajax_user.php?act=money_log_del&id=" + id + "",
            dataType: 'json',
            success: function(data) {
                layer.close(ii);
                layer.msg(data.msg);
                if (data.code == 1) {
                    setTimeout(function() {
                        location.href = "./user_money_log.php";
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
    });
}
function user_info(uid) {
    var ii = layer.load(0, {
        shade: [0.1, '#fff']
    });
    $.ajax({
        type: "POST",
        url: "ajax_user.php?act=user_info&uid=" + uid,
        dataType: 'json',
        success: function(data) {
            layer.close(ii);
            if (data.code == 1) {
                var item = '<table class="table table-condensed table-hover" id="accountdetail">';
                item += '<tr><td class="title table-secondary"><b>昵称</b></td><td class="content">' + [data.name] + '</td></tr>';
                item += '<tr><td class="title table-secondary"><b>账号</b></td><td class="content">' + [data.user] + '</td></tr>';
                item += '<tr><td class="title table-secondary"><b>QQ</b></td><td class="content">' + [data.qq] + '</td></tr>';
                item += '<tr><td class="title table-secondary"><b>手机</b></td><td class="content">' + [data.phone] + '</td></tr>';
                item += '<tr><td class="title table-secondary"><b>邮箱</b></td><td class="content">' + [data.mail] + '</td></tr>';
                item += '<tr><td class="title table-secondary"><b>余额</b></td><td class="content">' + [data.money] + '</td></tr>';
                item += '<tr><td class="title table-secondary"><b>积分</b></td><td class="content">' + [data.integral] + '</td></tr>';
                item += '<tr><td class="title table-secondary"><b>注册时间</b></td><td class="content">' + [data.regtime] + '</td></tr>';
                item += '<tr><td class="title table-secondary"><b>登录时间</b></td><td class="content">' + [data.logintime] + '</td></tr>';
                item += '</table>';
                layer.open({
                    type: 1,
                    shadeClose: true,
                    title: '账号详情',
                    skin: 'layui-layer-rim',
                    content: item
                });
            } else {
                layer.msg(data.msg);
            }
        },
        error: function(data) {
            layer.close(ii);
            layer.msg('服务器错误！');
            return false;
        }
    });
}
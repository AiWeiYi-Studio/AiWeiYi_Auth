function uid(id, type) {
    var ii = layer.load(0, {
        shade: [0.1, '#fff']
    });
    $.ajax({
        type: "POST",
        url: "ajax_system.php?act=article_uid&type=" + type + "&id=" + id + "",
        dataType: 'json',
        success: function(data) {
            layer.close(ii);
            layer.msg(data.msg);
            if (data.code == 1) {
                window.location.href = './article_list.php';
            }
        },
        error: function(data) {
            layer.close(ii);
            layer.msg('服务器错误！');
            return false;
        }
    });
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
            url: "ajax_system.php?act=article_del&id=" + id + "",
            dataType: 'json',
            success: function(data) {
                layer.close(ii);
                layer.msg(data.msg);
                if (data.code == 1) {
                    window.location.href = './article_list.php';
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
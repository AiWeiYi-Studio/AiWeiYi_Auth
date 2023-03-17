function money(uid) {
    var item = '<div class="form-group">';
    item += '<div class="input-group">';
    item += '<span class="input-group-addon p-0">';
    item += '<select id="type" style="-webkit-border-radius: 0;height:20px;border: 0;outline: none !important;border-radius: 5px 0 0 5px;padding: 0 5px 0 5px;">';
    item += '<option value="1">充值</option>';
    item += '<option value="2">扣除</option>';
    item += '</select>';
    item += '</span>';
    item += '<input type="number" class="form-control" id="number" placeholder="输入金额">';
    item += '<span class="input-group-addon">元</span>';
    item += '</div>';
    item += '</div>';
    item += '<div class="form-group">';
    item += '<div class="input-group">';
    item += '<span class="input-group-addon">备注</span>';
    item += '<input type="text" class="form-control" id="text" placeholder="可留空">';
    item += '</div>';
    item += '</div>';
    layer.open({
        btn: ['确定', '关闭'],
        btn1: function(index, layero) {
            var type = $("#type").val();
            var number = $("#number").val();
            var text = $("#text").val();
            var ii = layer.load(0, {
                shade: [0.1, '#fff']
            });
            $.ajax({
                type: "POST",
                url: "ajax_user.php?act=user_money&uid=" + uid,
                data: {
                    type: type,
                    number: number,
                    text: text
                },
                dataType: 'json',
                success: function(data) {
                    layer.close(ii);
                    layer.msg(data.msg);
                    if (data.code == 1) {
                        setTimeout(function() {
                            location.href = "./user_list.php";
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
        },
        area: ['20%', '250px'],
        title: '资金管理',
        content: item
    });
}

function del(uid) {
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
            url: "ajax_user.php?act=user_del&uid=" + uid,
            dataType: 'json',
            success: function(data) {
                layer.close(ii);
                layer.msg(data.msg);
                if (data.code == 1) {
                    setTimeout(function() {
                        location.href = "./user_list.php";
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

function login(uid, id) {
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
            url: "../user/ajax_login.php?act=user_login&uid=" + uid + "&id=" + id,
            dataType: 'json',
            success: function(data) {
                layer.close(ii);
                layer.msg(data.msg);
                if (data.code == 1) {
                    setTimeout(function() {
                        location.href = "../user";
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

function type(uid) {
    layer.confirm('确定修改用户类型吗？', {
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
            url: "ajax_user.php?act=user_type&uid=" + uid,
            dataType: 'json',
            success: function(data) {
                layer.close(ii);
                layer.msg(data.msg);
                if (data.code == 1) {
                    setTimeout(function() {
                        location.href = "./user_list.php";
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

function active(uid) {
    layer.confirm('确定修改用户状态吗？', {
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
            url: "ajax_user.php?act=user_active&uid=" + uid,
            dataType: 'json',
            success: function(data) {
                layer.close(ii);
                layer.msg(data.msg);
                if (data.code == 1) {
                    setTimeout(function() {
                        location.href = "./user_list.php";
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
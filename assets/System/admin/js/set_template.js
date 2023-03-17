var items = $("select[default]");
for (i = 0; i < items.length; i++) {
    $(items[i]).val($(items[i]).attr("default") || 0);
}

function automatic_index() {
    var ii = layer.load(0, {
        shade: [0.1, '#fff']
    });
    $.ajax({
        type: "POST",
        url: "ajax_system.php?act=template_automatic_index",
        dataType: 'json',
        success: function(data) {
            layer.close(ii);
            layer.msg(data.msg);
            if (data.code == 1) {
                window.location.href = "./set_template.php";
            }
        },
        error: function(data) {
            layer.close(ii);
            layer.msg('没有新模板');
            return false;
        }
    });
}

function automatic_admin_login() {
    var ii = layer.load(0, {
        shade: [0.1, '#fff']
    });
    $.ajax({
        type: "POST",
        url: "ajax_system.php?act=template_automatic_admin_login",
        dataType: 'json',
        success: function(data) {
            layer.close(ii);
            layer.msg(data.msg);
            if (data.code == 1) {
                window.location.href = "./set_template.php";
            }
        },
        error: function(data) {
            layer.close(ii);
            layer.msg('没有新模板');
            return false;
        }
    });
}

function automatic_user_login() {
    var ii = layer.load(0, {
        shade: [0.1, '#fff']
    });
    $.ajax({
        type: "POST",
        url: "ajax_system.php?act=template_automatic_user_login",
        dataType: 'json',
        success: function(data) {
            layer.close(ii);
            layer.msg(data.msg);
            if (data.code == 1) {
                window.location.href = "./set_template.php";
            }
        },
        error: function(data) {
            layer.close(ii);
            layer.msg('没有新模板');
            return false;
        }
    });
}

function automatic_user_reg() {
    var ii = layer.load(0, {
        shade: [0.1, '#fff']
    });
    $.ajax({
        type: "POST",
        url: "ajax_system.php?act=template_automatic_user_reg",
        dataType: 'json',
        success: function(data) {
            layer.close(ii);
            layer.msg(data.msg);
            if (data.code == 1) {
                window.location.href = "./set_template.php";
            }
        },
        error: function(data) {
            layer.close(ii);
            layer.msg('没有新模板');
            return false;
        }
    });
}

function set_template_index() {
    var template_index = $("#template_index").val();
    var ii = layer.load(0, {
        shade: [0.1, '#fff']
    });
    $.ajax({
        type: "POST",
        url: "ajax_system.php?act=set_template_index",
        data: {
            template_index: template_index
        },
        dataType: 'json',
        success: function(data) {
            layer.close(ii);
            layer.msg(data.msg);
            if (data.code == 1) {
                window.location.href = "./set_template.php?mod=indexs";
            }
        },
        error: function(data) {
            layer.close(ii);
            layer.msg('服务器错误！');
            return false;
        }
    });
}

function set_template_admin_login() {
    var template_admin_login = $("#template_admin_login").val();
    var ii = layer.load(0, {
        shade: [0.1, '#fff']
    });
    $.ajax({
        type: "POST",
        url: "ajax_system.php?act=set_template_admin_login",
        data: {
            template_admin_login: template_admin_login
        },
        dataType: 'json',
        success: function(data) {
            layer.close(ii);
            layer.msg(data.msg);
            if (data.code == 1) {
                window.location.href = "./set_template.php?mod=login";
            }
        },
        error: function(data) {
            layer.close(ii);
            layer.msg('服务器错误！');
            return false;
        }
    });
}

function set_template_user_login() {
    var template_user_login = $("#template_user_login").val();
    var ii = layer.load(0, {
        shade: [0.1, '#fff']
    });
    $.ajax({
        type: "POST",
        url: "ajax_system.php?act=set_template_user_login",
        data: {
            template_user_login: template_user_login
        },
        dataType: 'json',
        success: function(data) {
            layer.close(ii);
            layer.msg(data.msg);
            if (data.code == 1) {
                window.location.href = "./set_template.php?mod=login";
            }
        },
        error: function(data) {
            layer.close(ii);
            layer.msg('服务器错误！');
            return false;
        }
    });
}

function set_template_user_reg() {
    var template_user_reg = $("#template_user_reg").val();
    var ii = layer.load(0, {
        shade: [0.1, '#fff']
    });
    $.ajax({
        type: "POST",
        url: "ajax_system.php?act=set_template_user_reg",
        data: {
            template_user_reg: template_user_reg
        },
        dataType: 'json',
        success: function(data) {
            layer.close(ii);
            layer.msg(data.msg);
            if (data.code == 1) {
                window.location.href = "./set_template.php?mod=reg";
            }
        },
        error: function(data) {
            layer.close(ii);
            layer.msg('服务器错误！');
            return false;
        }
    });
}

function template_add() {
    var path = $("#path").val();
    var name = $("#name").val();
    var type = $("#type").val();
    var ii = layer.load(0, {
        shade: [0.1, '#fff']
    });
    $.ajax({
        type: "POST",
        url: "ajax_system.php?act=template_add",
        data: {
            path: path,
            name: name,
            type: type
        },
        dataType: 'json',
        success: function(data) {
            layer.close(ii);
            layer.msg(data.msg);
            if (data.code == 1) {
                window.location.href = "./set_template.php?mod=list";
            }
        },
        error: function(data) {
            layer.close(ii);
            layer.msg('服务器错误！');
            return false;
        }
    });
}

function template_edit(){
    var uid = $("#uid").val();
    var path = $("#path").val();
    var name = $("#name").val();
    var type = $("#type").val();
    var ii = layer.load(0, {
        shade: [0.1, '#fff']
    });
    $.ajax({
        type: "POST",
        url: "ajax_system.php?act=template_edit",
        data: {
            uid: uid,
            path: path,
            name: name,
            type: type
        },
        dataType: 'json',
        success: function(data) {
            layer.close(ii);
            layer.msg(data.msg);
            if (data.code == 1){
                window.location.href = "./set_template.php?mod=list";
            }
        },
        error: function(data) {
            layer.close(ii);
            layer.msg('服务器错误！');
            return false;
        }
    });
};

function template_del(uid) {
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
            url: "ajax_system.php?act=template_del&uid=" + uid,
            data: {
                uid: uid
            },
            dataType: 'json',
            success: function(data) {
                layer.close(ii);
                layer.msg(data.msg);
                if (data.code == 1) {
                    window.location.href = "./set_template.php?mod=list";
                }
            },
            error: function(data) {
                layer.close(ii);
                layer.msg('服务器错误！');
                return false;
            }
        });
    });
};
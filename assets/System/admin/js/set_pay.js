var items = $("select[default]");
for (i = 0; i < items.length; i++) {
    $(items[i]).val($(items[i]).attr("default") || 0);
}

function epay() {
    layer.confirm('确定？', {
        btn: ['确定', '取消'],
        closeBtn: 0,
        icon: 3
    },
    function() {
        var api = $("#api").val();
        var appid = $("#appid").val();
        var appkey = $("#appkey").val();
        var ii = layer.load(0, {
            shade: [0.1, '#fff']
        });
        $.ajax({
            type: "POST",
            url: "ajax_system.php?act=set_pay_epay",
            data: {
                api: api,
                appid: appid,
                appkey: appkey
            },
            dataType: 'json',
            success: function(data) {
                layer.close(ii);
                layer.msg(data.msg);
                if (data.code == 1) {
                    setTimeout(function() {
                        location.href = "./set_pay.php?mod=epay";
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

function alipay_qrcode() {
    layer.confirm('确定？', {
        btn: ['确定', '取消'],
        closeBtn: 0,
        icon: 3
    },
    function() {
        var appid = $("#appid").val();
        var private_key = $("#private_key").val();
        var public_key = $("#public_key").val();
        var ii = layer.load(0, {
            shade: [0.1, '#fff']
        });
        $.ajax({
            type: "POST",
            url: "ajax_system.php?act=set_pay_alipay_qrcode",
            data: {
                appid: appid,
                private_key: private_key,
                public_key: public_key
            },
            dataType: 'json',
            success: function(data) {
                layer.close(ii);
                layer.msg(data.msg);
                if (data.code == 1) {
                    setTimeout(function() {
                        location.href = "./set_pay.php?mod=alipay_qrcode";
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

function info() {
    layer.confirm('确定？', {
        btn: ['确定', '取消'],
        closeBtn: 0,
        icon: 3
    },
    function() {
        var qqpay = $("#qqpay").val();
        var wxpay = $("#wxpay").val();
        var alipay = $("#alipay").val();
        var personal = $("#personal").val();
        var little = $("#little").val();
        var big = $("#big").val();
        var ii = layer.load(0, {
            shade: [0.1, '#fff']
        });
        $.ajax({
            type: "POST",
            url: "ajax_system.php?act=set_pay_info",
            data: {
                qqpay: qqpay,
                wxpay: wxpay,
                alipay: alipay,
                personal: personal,
                little: little,
                big: big
            },
            dataType: 'json',
            success: function(data) {
                layer.close(ii);
                layer.msg(data.msg);
                if (data.code == 1) {
                    setTimeout(function() {
                        location.href = "./set_pay.php";
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

function personal() {
    layer.confirm('确定？', {
        btn: ['确定', '取消'],
        closeBtn: 0,
        icon: 3
    },
    function() {
        var qq = $("#qq").val();
        var weixin = $("#weixin").val();
        var alipay = $("#alipay").val();
        var ii = layer.load(0, {
            shade: [0.1, '#fff']
        });
        $.ajax({
            type: "POST",
            url: "ajax_system.php?act=set_pay_personal",
            data: {
                qq: qq,
                weixin: weixin,
                alipay: alipay
            },
            dataType: 'json',
            success: function(data) {
                layer.close(ii);
                layer.msg(data.msg);
                if (data.code == 1) {
                    setTimeout(function() {
                        location.href = "./set_pay.php?mod=personal";
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
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
            url: "ajax_auth.php?act=del_app&id=" + id,
            dataType: 'json',
            success: function(data) {
                layer.close(ii);
                layer.msg(data.msg);
                if (data.code == 1) {
                    window.location.href = './auth_app.php';
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

function status(id) {
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
            url: "ajax_auth.php?act=app_status&id=" + id,
            dataType: 'json',
            success: function(data) {
                layer.close(ii);
                layer.msg(data.msg);
                if (data.code == 1) {
                    window.location.href = './auth_app.php';
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

function money(id) {
    var ii = layer.load(0, {
        shade: [0.1, '#fff']
    });
    $.ajax({
        type: "POST",
        url: "ajax_auth.php?act=get_app_money",
        data : {id:id},
        dataType: 'json',
        success: function(data) {
            layer.close(ii);
            if (data.code == 1) {
                var item = '<div class="form-group">';
                item += '<label for="text">日/元</label>';
                item += '<input type="text" class="form-control" placeholder="输入-1或-1.00时商城隐藏此选项" id="money_day" value="'+data.money_day+'">';
                item += '</div>';
                item += '<div class="form-group">';
                item += '<label for="text">月/元</label>';
                item += '<input type="text" class="form-control" placeholder="输入-1或-1.00时商城隐藏此选项" id="money_month" value="'+data.money_month+'">';
                item += '</div>';
                item += '<div class="form-group">';
                item += '<label for="text">年/元</label>';
                item += '<input type="text" class="form-control" placeholder="输入-1或-1.00时商城隐藏此选项" id="money_year" value="'+data.money_year+'">';
                item += '</div>';
                item += '<div class="form-group">';
                item += '<label for="text">永久/元</label>';
                item += '<input type="text" class="form-control" placeholder="输入-1或-1.00时商城隐藏此选项" id="money_long" value="'+data.money_long+'">';
                item += '</div>';
                layer.open({
                    area: ['20%', '60%'],
                    title: '价格',
                    content: item,
                    btn: ['保存', '取消'],
                    btn1: function(index, layero) {
                        var money_day = $("#money_day").val();
                        var money_month = $("#money_month").val();
                        var money_year = $("#money_year").val();
                        var money_long = $("#money_long").val();
                        var ii = layer.load(0, {
                            shade: [0.1, '#fff']
                        });
                        $.ajax({
                            type: "POST",
                            url: "ajax_auth.php?act=set_app_money",
                            data: {
                                id:id,
                                money_day:money_day,
                                money_month:money_month,
                                money_year:money_year,
                                money_long:money_long
                            },
                            dataType: 'json',
                            success: function(data) {
                                layer.close(ii);
                                layer.msg(data.msg);
                                if (data.code == 1) {
                                    setTimeout(function() {
                                        location.href = "./auth_app.php";
                                    },1000);
                                }
                            },
                            error: function(data) {
                                layer.close(ii);
                                layer.msg('服务器错误！');
                                return false;
                            }
                        });
                    }
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

function release(id) {
    var item = '<div class="form-group">';
    item += '<div class="input-group">';
    item += '<span class="input-group-addon">安装包链接</span>';
    item += '<input type="text" class="form-control" id="download" placeholder="自定义安装包地址，可留空自助上传">';
    item += '</div>';
    item += '</div>';
    layer.open({
        btn: ['保存链接', '自助上传'],
        btn1: function(index, layero) {
            var download = $("#download").val();
            var ii = layer.load(0, {
                shade: [0.1, '#fff']
            });
            $.ajax({
                type: "POST",
                url: "ajax_auth.php?act=app_download_1&id=" + id,
                data: {
                    download:download
                },
                dataType: 'json',
                success: function(data) {
                    layer.close(ii);
                    layer.msg(data.msg);
                    if (data.code == 1) {
                        setTimeout(function() {
                            location.href = "./auth_app.php";
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
        btn2: function(index, layero) {
            var item = '<div class="form-group">';
            item += '<input type="file" name="file" id="file" class="form-control">';
            item += '</div>';
            layer.open({
                btn: ['上传', '关闭'],
                btn1: function(index, layero) {
                     var fileObj = $("#file")[0].files[0];
                     var formData = new FormData();
                     formData.append("do","upload");
                     formData.append("file",fileObj);
                     var ii = layer.msg('正在上传安装包中...', {icon: 16, time: 10 * 1000});
                     $.ajax({
                         url: "ajax_auth.php?act=app_download_2&id="+id,
                         data: formData,
                         type: "POST",
                         dataType: "json",
                         cache: false,
                         processData: false,
                         contentType: false,
                         success : function(data) {
                             layer.close(ii);
                             layer.msg(data.msg);
                             if(data.code==1){
                                 setTimeout(function () {
                                     location.href="./auth_set.php?id="+id;
                                }, 1000);
                            }
                        },
                        error:function(data){
                            layer.close(ii);
                            layer.msg('服务器错误！');
                            return false;
                        }
                    });
                },
                area: ['20%', '200px'],
                title: '安装包上传',
                content: item
                });
            },
        area: ['30%', '200px'],
        title: '安装包配置',
        content: item
    });
}
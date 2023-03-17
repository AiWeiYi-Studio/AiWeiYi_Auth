var items = $("select[default]");
for (i = 0; i < items.length; i++) {
    $(items[i]).val($(items[i]).attr("default") || 0);
}
// 格式化时间
function checkTime(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}
function select_time(){
    var time = document.getElementById("time").value;
    var date = new Date();
    var year = date.getFullYear();
    var month = date.getMonth() + 1;
    var day = date.getDate();
    var hour = date.getHours();
    var minutes = date.getMinutes();
    var seconds = date.getSeconds();
    month = checkTime(month);
    day = checkTime(day);
    hour = checkTime(hour);
    minutes = checkTime(minutes);
    seconds = checkTime(seconds);
    if (time == 'day'){
        day = day + 1;
        document.getElementById("dates").style.display="none";
    }else if (time == 'month'){
        month = month + 1;
        document.getElementById("dates").style.display="none";
    }else if (time == 'year'){
        year = year + 1;
        document.getElementById("dates").style.display="none";
    }else if(time == 'long'){
        year = 9999;
        document.getElementById("dates").style.display="none";
    }else if (time == 'change'){
        document.getElementById("dates").style.display="inline";
    }
    document.getElementById("date").value = year + '-' + month + '-' + day + ' ' + hour + ':' + minutes + ':' + seconds;
}
function add_app() {
    var name = $("#name").val();
    var status = $("#status").val();
    var ii = layer.load(0, {
        shade: [0.1, '#fff']
    });
    $.ajax({
        type: "POST",
        url: "ajax_auth.php?act=add_app",
        data: {
            name: name,
            status: status
        },
        dataType: 'json',
        success: function(data) {
            layer.close(ii);
            layer.msg(data.msg);
            if (data.code == 1) {
                setTimeout(function() {
                    location.href = "./auth_set.php?id=" + data.ID + "";
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

function add_auth() {
    var type = $("#type").val();
    var uuid = $("#uuid").val();
    var contact = $("#contact").val();
    var token = $("#token").val();
    var ip = $("#ip").val();
    var active = $("#active").val();
    var date = $("#date").val();
    var ii = layer.load(0, {
        shade: [0.1, '#fff']
    });
    $.ajax({
        type: "POST",
        url: "ajax_auth.php?act=add_auth",
        data: {
            type: type,
            uuid: uuid,
            contact: contact,
            token: token,
            ip: ip,
            active: active,
            date: date
        },
        dataType: 'json',
        success: function(data) {
            layer.close(ii);
            layer.msg(data.msg);
            if (data.code == 1) {
                setTimeout(function() {
                    location.href = "./auth_info.php?id=" + data.ID;
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

function add_update() {
    var fileObj = $("#file")[0].files[0];
    var app = $("#app").val();
    var edition = $("#edition").val();
    var version = $("#version").val();
    var log = $("#log").val();
    var text = $("#text").val();
    var beta = $("#beta").val();
    var type = $("#type").val();
    var status = $("#status").val();
    var formData = new FormData();
    formData.append("file",fileObj);
    formData.append("app",app);
    formData.append("edition",edition);
    formData.append("version",version);
    formData.append("log",log);
    formData.append("text",text);
    formData.append("beta",beta);
    formData.append("type",type);
    formData.append("status",status);
    var ii = layer.msg('请耐心等待...', {icon: 16, time: 10 * 1000});
    $.ajax({
        url: "ajax_auth.php?act=add_update",
        data: formData,
        type: "POST",
        dataType: "json",
        cache: false,
        processData: false,
        contentType: false,
        success : function(data) {
            layer.close(ii);
            layer.msg(data.msg);
            if (data.code == 1) {
                setTimeout(function() {
                    location.href = "./auth_update.php";
                },1000);
            }
        },
        error:function(data){
            layer.close(ii);
            layer.msg('服务器错误！');
            return false;
        }
    });
}
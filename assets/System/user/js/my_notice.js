var items = $("select[default]");
for (i = 0; i < items.length; i++) {
    $(items[i]).val($(items[i]).attr("default") || 0);
}

function edit(){
	var active_mail=$("#active_mail").val();
	var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_my.php?act=my_notice",
			data : {active_mail:active_mail},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				layer.msg(data.msg);
				if(data.code==1){
				    setTimeout(function () {
				        location.href="./my_notice.php";
			        }, 1000);
			    }
			},
			error:function(data){
				layer.close(ii);
				layer.msg('服务器错误！');
				return false;
		}
	});
}
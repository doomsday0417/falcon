$(function(){
	$('form').submit(function(){
		return false;
	});
	$('form').submit(function(){
		var _this = $(this);
		var form = $('form');
		$.ajax({
			type : 'post',
			url  : form.attr('action'),
			data : form.serializeArray(),
			dataType : 'json',
			success  : function(ret){
				if(ret.success){
					location.href = ret.data.url;
				}else{
					alert(ret.message);
				}
			}
		});
	});
})
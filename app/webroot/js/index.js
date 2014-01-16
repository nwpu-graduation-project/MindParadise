function subscribeSubmit() {
	var check1=$('#id_subscribe_email').checkinput();
	if(check1){
		var url=$('#id_subscribe_form').attr('action');
		var data=$('#id_subscribe_form').serialize();
		$.post(url, data, function(){
			$('#id_subscribe_email').val('');
			alert('订阅成功');
		});
	}
	return false;
}
//友情链接滚动(滚动框，复制元素，克隆框，滚动高度)
function slideUpDownRoll(id, handle, cbox, step){
	var rEle    = $(id),
		hLen    = rEle.find(handle).length,
		hClo    = rEle.find(handle).eq(0).clone(true),
		mScroll = hLen * step ;
	rEle.find(cbox).append(hClo);
	var timer = setInterval(function(){
		var sTop = rEle.scrollTop() + step;
		rEle.animate({scrollTop : sTop},'normal',function(){
			if(mScroll == sTop){
				rEle.scrollTop(0);
			}											  
		});			 
	},3000);
}
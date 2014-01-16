// JavaScript Document
document.domain = 'xinli001.com';
var isLogined=false,loginuser;
var userAgent=navigator.userAgent;
var mreg=/iphone|android|ipad|mobile/i;
var isMobile=mreg.test(userAgent);
function incrhtml(id){
	var num=parseInt($(id).html());
	$(id).html(num+1);
}
function decrhtml(id){
	var num=parseInt($(id).html());
	$(id).html(num-1);
}
//按钮特效
function btnsHover(id,act){
	var act = act ? act : 'act_btns';
	$(id).hover(function(){
		$(this).addClass(act);
	},function(){
		$(this).removeClass(act);
	});
}
//图片效果
function imgHover(){
	$('img[hover=true]').each(function(){
		var me = $(this);
		$(this).unbind('hover').hover(function(){
			me.css('opacity',0.85);
		},function(){
			me.css('opacity',1.0);
		});
	});
}
//导航
function setNav(){
	var lis = $('#nav_list li');
	lis.each(function(i){
		var me = $(this),dls = me.find('dl');
		me.css('z-index',888-i);
		if(dls.length > 0){
			var fa = me.find('a:first'),mark = me.find('.mark');
			me.hover(function(){
				fa.addClass('act');
				dls.css('display','block');
				mark.css({'height' : dls.height() - 7 + 'px','display' : 'block'});
			},function(){
				fa.removeClass('act');
				dls.css('display','none');
				mark.css('display','none');
			});
		}
	});
}
function go2reply(el){
	$(window).scrollTop(10000);
	$(el).focus();
}
//评论回复功能
function bindReplys(){
	$('.items .reply').click(function(){
		var items = $(this).parent().parent();
		if(items.children().length == 2){
			$('#id_reply_comment_id').val(items.attr('comment_id'));
			items.append($('#id_reply_form'));
			$('#id_reply_form').show();
		}else{
			$('#id_reply_form').show();
		}
	});
}
function showCommentDelete(el){
	if(isLogined&&loginuser.is_superuser){
		if(el){
			var dels=$(el).find('a.delete');
			dels.show();
			return;
		}
		var dels=$('#comments_list a.delete');
		dels.show();
	}
}
//载入评论
function loadComments(id, type, page, per_page, loading){
	var list=$('#comments_list');
	if(!loading) {
		loading='正在载入评论...';
	}
	list.html('<p class="loading"><span>'+loading+'</span></p>');
	var url = "/comment/page/?content_type=" + type 
		+ "&object_id=" + id + "&page=" + page
		+ "&per_page=" + per_page+'&time='+$.now();
	$.get(url, function(data){
		list.html(data);
		encodeatnickname(list);
		imgHover();
		// showCommentDelete();
	});
}
function encodeatnickname(list){
	if(typeof(list)=='string'){
		return list;
	}
	var spans=list.find('span.encodenickname');
	spans.each(function(){
		var reg=/@([^\s]+)/gm;
		var html=$(this).html();
		html=html.replace(reg, '<a href="/user/go2nickname/?nickname=$1">@$1</a> ');
		$(this).html(html);
	});
}
function delComment(el, id){
	var url=el.href+'?t='+$.now();
	$.get(url, function(data){
		if(data.status){
			$('#id_comment_'+id).slideUp('fast', function(){
				$(this).remove();
			});
			decrhtml('#id_commentnum_'+data.object_id);
		}
	});
	return false;
}
function getItemsByPage(page) {
	$.get(pageUrl, {p:page, t:$.now()}, function(resp) {
		$('#commentlist').html(resp);
	});
	return false;
}
//平滑滚动滚动条
function scrollToPos(handle,pos,step){
	var ele = $(handle),sPos = $(pos).offset().top,step = step ? step : 50;
	ele.click(function(){
		var sTop = $(document).scrollTop(),lower = sPos > sTop;
		timer = setInterval(function(){
			if(lower){
				sTop = sTop + step;
				sTop = sTop >= sPos ? sPos : sTop;
			}else{
				sTop -= step;
				sTop = sTop <= sPos ? sPos : sTop;
			}
			window.scrollTo(0,sTop);
			if((!lower && sTop <= sPos)||(lower && sTop >= sPos)){clearTimeout(timer);return false;}
		},50);
	});
}
//输入字符长度处理
function setInputLen(ins,tips,len){
	var ele = $(ins), maxs = $(tips), lave;
	var g = {
		setLen : function(){
			var ival = ele.val();
			if(ival.length >= len){ 
				  ele.val(ival.substr(0,len));
				  lave = 0;
			  }else{ 
				  lave = len - ival.length;
			  }
			  maxs.html(lave);
		}
	};
	ele.keyup(function(){
		g.setLen();
	}).blur(function(){
		g.setLen();
	});
}
//测试选项设置
function setTestSels(ele, clickfun){
	var items = $(ele);
	items.hover(function(){
		$(this).addClass('hover');
	},function(){
		$(this).removeClass('hover');
	}).click(function(){
		items.removeClass('act');
		var radio = $(this).find(':radio');
		if(radio.length>0){
			$(this).addClass('act');
			radio.attr('checked', 'checked');
			if(clickfun){
				clickfun(this);
			}
		}
	});
}
function setFocusSlid(linksId, imgId, height, dir){
	var li = $(linksId).find('li');
	var count = li.length;
	var focusIndex = 0;
	var focusInterval;
	var step = 1;
	var slidover = function(){
		var li = $(linksId).find('li');
		li.removeClass('act');
		$(li[focusIndex]).addClass('act');
		$(imgId).stop();
		if(dir=='h'){
			$(imgId).animate({scrollLeft: height * focusIndex}, 300);
		}else{
			$(imgId).animate({scrollTop: height * focusIndex}, 300);
		}
	}
	var slidout = function(){
		focusInterval = setInterval(slidInterval, 5000);
	}
	var slidInterval = function(){
		slidover();
		if(focusIndex == 0){
			step = 1;
		}
		if(focusIndex == count - 1){
			step = -1;
		}
		focusIndex+=step;
	}
	li.each(function(i){
		$(this).hover(function(){
			clearInterval(focusInterval);
			focusIndex = i;
			slidover();
		}, function(){
			slidout();
		});
	});
	focusIndex = 1;
	slidout();
}
function Rollable(id, width) {
	var btns=$(id).find('div.roll a');
	var lbtn=$(btns[0]), rbtn=$(btns[1]);
	var dots=$(id).find('div.roll span');
	var ldot=$(dots[0]), rdot=$(dots[1]);
	var rollBox=$(id).find('div.roll_box');
	var leftRoll=function() {
		rollBox.animate({scrollLeft: 0}, 300);
		lbtn.unbind();
		ldot.unbind();
		lbtn.removeClass('lact');
		rdot.removeClass('act');
		ldot.addClass('act');
		rbtn.addClass('ract');
		rbtn.click(rightRoll);
		rdot.click(rightRoll);
		return false;
	}
	var rightRoll=function() {
		rollBox.animate({scrollLeft: width}, 300);
		rbtn.unbind();
		rdot.unbind();
		rbtn.removeClass('ract');
		ldot.removeClass('act');
		rdot.addClass('act');
		lbtn.addClass('lact');
		lbtn.click(leftRoll);
		ldot.click(leftRoll);
		return false;
	}
	leftRoll();
}
//每日一测
function setDayCeshi(){
	var ele = $('#day_sels'),items = ele.find('p.items'),last = -1;
	var items = $('#day_sels .items');
	var selected = false;
	items.click(function(){
		items.removeClass('act');
		$(this).addClass('act');
		$(this).find('input').attr('checked', 'checked');
		selected = true;
	});
	$('#id_ceshi_next').click(function(){
		if(selected){
			$('#id_day_ceshi_form').submit();
		}
	});
}
function ddhover(dd){
	$(dd).find('a.back').hide();
	$(dd).hover(function(){
		$(this).find('a.back').show();
	},function(){
		$(this).find('a.back').hide();
	});
}
function delreply(id){
	$('#id_reply_nickname_'+id).parent().hide();
}
function reply(dd, pk, nickname){
	var div = $(dd).parents('div.comments');
	var ids = div.attr('id').split('_');
	var id = ids[ids.length-1];
	$('#id_reply_comment_id_'+id).val(pk);
	$('#id_reply_nickname_'+id).html(nickname);
	$('#id_reply_nickname_'+id).parent().show();
}
function initcommentform(){
	//评论长度
	setInputLen('#id_comment','#max_words',200);
	$('#id_comment_form').submit(function(){
		var check=$('#id_comment').checkinput();
		return check;
	});
	$('#id_comment_post').attr('disabled', false);
}
function favSite() { 
    //网站网址 
    var url='http://www.xinli001.com/'; 
    //网站名称 
    var title="改变从这里开始 - 心理网"; 
    if (window.sidebar) {
        window.sidebar.addPanel(title,url,""); 
    } 
    else if(document.all) {
        window.external.AddFavorite(url,title); 
    } 
    else {
        return true; 
    } 
}
function watermark(){
	$(':input[tip]').each(function(){
		$(this).watermark();
	});
}
function showNotice(msg) {
	var a=$('<a title="提示信息"></a>');
	var content='<p class="loading"><span>'+msg+'</span></p>';
	a.florabox({
		'width': 250,
		'content': content
	}).click();
}
function favorite(el){
	if(!_islogin) {
		window.loginSuccess = function(){
			_islogin = true;
			window.loginSuccess = null;
			favorite(el);
		}
		window.open(loginUrl, 'login');
		return false;
	}
	$(el).attr('disabled', true);
	$.get(el.href, {t:$.now()}, function(resp){
		$(el).attr('disabled', false);
		switch(resp.code){
			case 0:
				alert("收藏成功");
				break;
			case -1:
				alert('你已经收藏过了哦');
				break;
			case -2:
				alert('登录超时，请再次点击');
				_islogin = false;
				break;
		}
	});
	return false;
}
function changeHotCeshi(el) {
	var self=$(el);
	var url=self.data('url')+'?p='+self.data('page');
	$.get(url, function(data){
		$('#id_hot_ceshi_list').html(data);
		self.data('page', self.data('page')+1)
	});
	return false;
}
function openConnectClick_qplus(el){
	var url=$(el).attr('href');
	var title=$(el).attr('title');
	open(url, title);
	return false;
}
function getObjView(url) {
	$.get(url, function(data) {
		$('#id_obj_viewnum').html(data);
	});
	return false;
}
function clearCache(url, sec) {
	$.get(url, {sec:sec});
	return false;
}
function getQaVips(el){
	var url=$(el).attr('url')+'?per_page=5&t='+$.now();
	$.get(url, function(data){
		$('#id_qa_vip_list').html(data);
	});
	return false;
}
function userRepost(el) {
	if(!_islogin) {
		window.loginSuccess = function(){
			_islogin = true;
			window.loginSuccess = null;
			userRepost(el);
		}
		window.open(loginUrl, 'login');
		return false;
	}
	$(el).attr('disabled', true);
	$.get(el.href, {t:$.now()}, function(resp){
		$(el).attr('disabled', false);
		switch(resp.code){
			case 0:
				alert("转载成功");
				break;
			case -2:
				alert('登录超时，请再次点击');
				_islogin = false;
				break;
		}
	});
	return false;
}
function getValidQuestion() {
	var seed = $('#id_seed').val();
	$('#id_secquestion_img').css('visibility', 'hidden');
	$.ajax({
		url: getValidQuestionUrl,
		data: {t:$.now(), seed:seed},
		dataType: 'jsonp',
		success: function(data){
			if(data.question) {
				$('#id_secquestion').html(data.question);
			}
			if(data.image) {
				$('#id_secquestion_img').attr('src', data.image);
				$('#id_secquestion_img').css('visibility', 'visible');
				// var html = '<img src="'+data.image+'" width="240" height="60"/>';
				// $('#id_secquestion').html(html);
			}
		}
	});
	return false;
}
function getValidImg() {
	var seed = $('#id_seed').val();
	var url = validimgUrl+'?seed='+seed+'&t='+$.now();
	$('#id_secquestion_img').css('visibility', 'visible');
	$('#id_secquestion_img').attr('src', url);
	return false;
}
function showEmailActivePanel(content) {
	$('<a></a>').fancybox({
		type:'html',
		content:content,
		title:'激活账号'
	}).click();
	return false;
}
function resendEmailActive(el) {
	var url = $(el).data('url');
	$.get(url, {t:$.now()}, function(resp){
		switch(resp.code) {
			case 0:
				alert('激活邮件已发送');
				break;
			case -1:
				alert('你的邮箱已经激活');
				break;
			case -2:
				alert('操作太频繁了，休息'+resp.gap+'秒');
				break;
		}
	});
	return false;
}
function activeEmailClose() {
	$.fancybox.close();
	return false;
}

var tipsInterval,tipsmsec=10000,failTimes=0,lastMessageNum=lastFollowNum=lastNoticeNum=lastAnswerNum=0;
function getUserTips(){
	var url = userListenTipsUrl + '?t='+$.now();
	var nickname = $('#id_user_nickname_a').html();
	$.ajax({
		url: url,
		dataType: 'jsonp',
		success: function(data) {
			var count=data.message+data.follow+data.notice+data.answer;
			if(count > 0) {
				$('#id_user_nickname_a').html(nickname+'('+count+')');
			}
		}
	});
	// $.post(url, function(data) {
		// var count=data.message+data.follow+data.notice+data.answer;
		// if(count > 0) {
			// $('#id_user_nickname_a').html(nickname+'('+count+')');
		// }
	// });
}
function startListenTips(){
	// var msec=Math.min(tipsmsec+failTimes*5000, 5*60*1000);
	// tipsInterval=setInterval('getUserTips()', msec);
	getUserTips();
}
function uploadFileOnSelectFile(name) {
	if(name == 'editor') {
		$('.ke_uploading_msg').html('');
		$('.ke_uploading_bar').show();
		$('.ke_uploading_pos').width(0);
	}
	if(name == 'cover') {
		$('#id_cover_msg').html('');
		$('#id_uploading_bar').show();
		$('#id_uploading_pos').width(0);
	}
}
function uploadFileOnTooBig(name, size) {
	if(name == 'editor') {
		$('div.ke_upload_msg').html('图片大小不能超过1M，请压缩后再上传');
	}
	if(name == 'cover') {
		$('#id_cover_msg').html('图片大小不能超过1M，请压缩后再上传');
	}
}
function uploadFileOnProgress(name, loaded, total) {
	if(name == 'editor') {
		$('.ke_uploading_pos').width(loaded / total * 300);
	}
	if(name == 'cover') {
		$('#id_uploading_pos').width(loaded / total * 380);
	}
}
function uploadFileOnUploadCompleteData(name, url) {
	if(name == 'editor') {
		$('.ke-input-text[name="localUrl"]').val(url);
		$('.ke_uploading_bar').hide();
	}
	if(name == 'cover') {
		$('#id_cover').val(url);
		$('#id_uploading_bar').hide();
	}
}
function uploadFileOnReady(name) {
	if(name == 'cover') {
		$('#id_upload_button').show();
	} 
}
function bindCopydeny() {
	$('body').bind('copy', function() {
		if(_isstaff) return true;
		$('<a href="#copydeny"></a>').fancybox().click();
		return false;
	});
}
//回顶部
function setTopbar(maxShow){
	var ele = $('#topbar'), tlinks = ele.find('a'), isIE6 = /MSIE 6.0/ig.test(navigator.appVersion), winWidth = document.documentElement.clientWidth, pLft;
	if(!maxShow) maxShow = 0;
	pLft = Math.round((winWidth - 960)/2) + 320 - 33;
	ele.css('right', pLft + 'px');
	$(window).bind('scroll',function(){
		var winHeight, 
			wdt  = document.documentElement.clientWidth, 
			sTop = parseInt(document.body.scrollTop ? document.body.scrollTop : document.documentElement.scrollTop), pTop;
		if(sTop > maxShow && wdt >= 960){
			ele.fadeIn();
			if(isIE6){
				winHeight = document.documentElement.clientHeight;
				pTop      = (winHeight - 70 + sTop) + 'px';	
				ele.stop().animate({'top' : pTop},'slow');
			}
		}else{
			ele.fadeOut();
		}
	});
	$(window).bind('resize',function(){
		var wdt = document.documentElement.clientWidth, mRgt;
		if(wdt < 960){
			ele.fadeOut();
		}else{
			mRgt = Math.round((wdt - 960)/2) + 320 -33;
			ele.show().css('right', mRgt + 'px');
		}
	});
}

//底部推荐列表
function setAppMenu(){
	var appmenu  = $('#appmenu'), ele = appmenu.find('.menuicon'), hot = ele.find('.hot'), flag = false;
	ele.bind('click',function(){
		var timer = null;
		if(!flag){ hot.hide(); flag = true;}
		appmenu.addClass('appmenu_hover');
		appmenu.bind('mouseover',function(){
			if(timer) clearTimeout(timer);
			$(this).addClass('appmenu_hover');
		}).bind('mouseout',function(){
			var me = $(this);
			timer  = setTimeout(function(){
				me.removeClass('appmenu_hover').unbind('mouseover mouseout');
			},200);
		});
	});
	if($.browser.msie && ($.browser.version == "6.0") && appmenu.length){
		var winHeight = document.documentElement.clientHeight;
		appmenu.css({'bottom' : 'auto','top' : (winHeight - 52) + 'px'});
		$(window).bind('scroll',function(){
			var sTop = parseInt(document.body.scrollTop ? document.body.scrollTop : document.documentElement.scrollTop), pTop;
			pTop      = (winHeight - 52 + sTop) + 'px';
			appmenu.stop().animate({'top' : pTop},'slow');
		});
	}
}
function hideSiteTip() {
	$.ajax({
		url:'http://www.xinli001.com/user/hidesitetip/',
		dataType: 'jsonp'
	});
	$('#siteTip').hide();
	return false;
}
var J = {
	_isCookieValidKey : function(B) {
		return (new RegExp('^[^\\x00-\\x20\\x7f\\(\\)<>@,;:\\\\\\"\\[\\]\\?=\\{\\}\\/\\u0080-\\uffff]+\x24')).test(B)
	}, getCookieRaw : function(D) {
		if (J._isCookieValidKey(D)) {
			var E = new RegExp("(^| )" + D + "=([^;]*)(;|\x24)"), B = E.exec(document.cookie);
			if (B) {
				return B[2] || null
			}
		}
		return null
	}, setCookieRaw : function(E, T, D) {
		if (!J._isCookieValidKey(E)) {
			return
		}
		D = D || {};
		var B = D.expires;
		if ("number" == typeof D.expires) {
			B = new Date();
			B.setTime(B.getTime() + D.expires)
		}
		document.cookie = E + "=" + T + (D.path ? "; path=" + D.path : "") + ( B ? "; expires=" + B.toGMTString() : "") + (D.domain ? "; domain=" + D.domain : "") + (D.secure ? "; secure" : "")
	}, getCookie : function(B) {
		var D = J.getCookieRaw(B);
		if ("string" == typeof D) {
			D = decodeURIComponent(D);
			return D
		}
		return null
	}, setCookie : function(D, E, B) {
		J.setCookieRaw(D, encodeURIComponent(E), B)
	}
};
var bdshareurl = 'http://s.share.baidu.com/';
var bdsharep = '?click=1&uid=603462&type=text&relateUid=&sign=on&comment=&searchPic=0&l=180v51iuo180v51ju2180v5n4oh&linkid=hjv6hviw77o&sloc=&apiType=0&buttonType=1'
function sharetobaidusns(e, to, title, url, desc) {
	var B = e.target;
	var T = e.pageX;
	var E = e.pageY;
	var n = 1;
	var AD = 1;
	var AB = 1;
	var i = 1;
	var e = 1;
	var AC = Math.floor(B.offsetWidth);
	var AM = Math.floor(B.offsetHeight);
	var k = 1;
	var AE = +new Date;
	AE = 4706;
	var j = [T, E, n, AD, AB, i, e, AC, AM, k, AE].join(".");

	var key = '';
	if (to == 'tsina') {
		key = '2165055798';
		title = desc;
	}
	var params = {
		to : to,
		title : title,
		url : url,
		pic : '',
		key : key,
		firstime : J.getCookie("bdshare_firstime"),
		t : Math.random(),
		sloc : j,
		desc:desc
	};
	var q = $.param(params);
	var url = bdshareurl + bdsharep + '&' + q;
	window.open(url);
	setTimeout(function() {
		var img = new Image();
		img.src = bdshareurl + 'commit' + bdsharep + '&' + q;
	}, 1500);
	return false;
}
$(function(){
	watermark();
	//按钮特效
	btnsHover('.btns');
	//图片鼠标悬停效果，IMG属性加上hover="true"即可
	imgHover();
	//底部推荐列表
	setAppMenu();
	
	$(document).ajaxStart(function() {
		try {
			$.fancybox.showLoading();
		} catch(e) {}
	});
	$(document).ajaxComplete(function() {
		try {
			$.fancybox.hideLoading();
		} catch(e) {}
	});
	$(document).ajaxError(function() {
		if(window.ajaxErrorHandler) {
			window.ajaxErrorHandler.call(this);
		}
	});
});
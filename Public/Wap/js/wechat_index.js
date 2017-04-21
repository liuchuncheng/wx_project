//t1表示分享到朋友圈的标题，t表示分享到朋友的标题
function iniShare(t,t1,ds,l,o){
	var localUrl=encodeURIComponent(window.location.href.split('#')[0]);
	$.get("http://wxzf.zcsmkj.com/index.php/index/index/getjssdk?localurl="+ localUrl ,"",function(d){
		weixinData=d
		wx.config({
			appId: d.appId,
			timestamp: d.timestamp,
			nonceStr: d.nonceStr,
			signature: d.signature,
			jsApiList: [
				// 所有要调用的 API 都要加到这个列表中
				'checkJsApi',
				'onMenuShareTimeline',
				'onMenuShareAppMessage'
			]
		});
		wx.ready(function () {
			iniWeixinShare({title: t,title1:t1, desc:ds,link:l,'logo':o})
		});

		wx.error(function (res) {
		   alert(res.errMsg);
		});
	},"json")
}

function iniWeixinShare(data){
	var _this=this
	var shareData = {
	title: data.title,
	desc: data.desc,
	link: data.link,
	imgUrl: data.logo,
	trigger: function (res) { },
	success: function (res) { iniWeixinShared(1);},
	cancel: function (res) { iniWeixinShared(0);},
	fail: function (res) { iniWeixinShared(0);}
	};

	//好友
	wx.onMenuShareAppMessage(shareData);

	//朋友圈
	shareData = {
		title: data.title1,
		desc: data.desc,
		link: data.link,
		imgUrl: data.logo,
		trigger: function (res) {  },
		success: function (res) { iniWeixinShared(2)},
		cancel: function (res) { iniWeixinShared(0)},
		fail: function (res) { iniWeixinShared(0) }
	};
	wx.onMenuShareTimeline(shareData);
}
function iniWeixinShared(v){
	var $body = $('.document');
	var $iframe = $('<iframe src="src/share.jpg?t='+Math.random()+'" ></iframe>').on('load', function() {
		setTimeout(function() {$iframe.off('load').remove()}, 0)
	}).appendTo($body)     
	if(v){

	}
}

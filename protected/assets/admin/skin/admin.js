/*
 * 作者:剧中人
 * 博客：http://bh-lay.com/
 * Copyright (c) 2012-2018 小剧客栈
**/

var holy={};

//自动隐藏输入框插件
$.fn.autoKey=function(){
	var searchBox = $(this);
	var title=searchBox.val(); 
	searchBox.click(function(){if(searchBox.val()==title){searchBox.val("");}}).blur(function(){if(searchBox.val()==""){searchBox.val(title);}}); 
	return searchBox;
}
//可关闭插件
$.fn.shutDown=function(){
	$(this).prepend('<div class="close">X</div>');
	$(".close").click(function(){$(this).parent().slideUp('slow');});
	return this;
}
//上传图像 
function uploadImg(Obj){
	if($('#imgField').length==0){$('body').append('<iframe name="imgField" id="imgField" style="display:none;"></iframe>')}
	$('#uploadImg .submit').unbind('click').click(function(){
		var timer=setInterval(function(){
			var a=$('#imgField').contents().find('body').html();
			if(a.length>0){
				clearInterval(timer);
				if(a=='fail'){
					popWin('200','10','失败',$('body'));
				}else{
					$('#popWin .popWinBody').html('<p style="text-align:center;font-size:16px">上传成功</p>');
					Obj.attr({src:a});
				}
			}
		},1000);
	});
}

//ie6
holy.fixie6=function (){

}
///弹框
var popWin=function (w,h,html,e,fn){
	if($('#popWin').length==0){$('body').append('<div id="popWin"><div class="popWinBj"></div><div class="popWinBody"></div><div class="layClose">×</div></div>')}
	$('#popWin .popWinBody').html(html);
	var timer, popT, popL;
	popT =e.offset().top;
	popL=e.offset().left;
	$('#popWin').css({'width': w,'height':h,'top':popT,'left':popL},300);
	$('#popWin .popWinBody').css({'width': w-10,'height':h-10},300);
	$('#popWin').show();
	$('#popWin .layClose').unbind('click').click(function(){
		$(this).parent().hide();
	});
	if(fn){fn()}
}

var frameSet={
	resize:function(){
		$('.frameContent').height($(window).height()-$('.topNav').height());
		$(window).resize(function(){
			$('.frameContent').height($(window).height()-$('.topNav').height());
		});
	},
	editframe:function(){
		var iframe=$('#mainFrame')[0];
		if (iframe.attachEvent){
			iframe.attachEvent("onload" , function () {
				popEditContent();
			});
		}else{
			iframe.onload = function () {
				popEditContent();
			};
		}
		function popEditContent(){
			$('iframe').contents().find('a[target="edit"]').on('click',function(){
				$('.editContent').show().stop().fadeTo('200','1').animate({top:'5%'},'200');
				$('.closeIt').unbind('click').click(function(){
					$(this).parent().animate({top:'100%'},'300').delay('100').fadeOut('100')
				});
			});
			
		}
	},
	init:function(){
	//$('.editContent').show().css({top:'5%'});
		frameSet.resize();
		frameSet.editframe();
		
	}
}
var banner={
	add:function(){
		$('.addBanner .add').click(function(){
			$('.bannerList').append('<div class="bannerItem"><div class="bannerImg"></div><div class="info"><ul><li><label>标题</label><input type="text" class="textA" /></li><li><label>启用</label><input type="checkbox" class="checkBox"/></li><li><label>链接</label><input type="text" class="textA" /></li><li><label>排序</label><select name="ambit"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option></select><span>(越大越靠前)</span></li><li><label>重新上传</label><input type="file" class="fileInput" /></li><li class="btn"><input type="button" value="添加"/></li></ul></div></div>');
			return false;
		});
		$('.bannerImg').mouseenter(function(){
			var id=$(this).parent().attr('id');
			var imgMark=$(this).find('img');
			$('body').append('<div class="reUploadContent" style="top:'+$(this).offset().top+'px;left:'+$(this).offset().left+'px;"><div class="reUploadBj"></div><a href="#"><span></span>重新上传</a></div>');
			$('.reUploadContent a').click(function(){
				var html='<form action="/new_forum/ajax/admin/do_banner.php" enctype="multipart/form-data" method="post" target="imgField" id="uploadImg" accept-charset="utf-8"><input type="hidden" name="id" value="'+id +'"><input type="file" name="upload" style="display:block;margin:20px auto"><input type="hidden" value="upload" name="act"><input type="submit" value="上传" class="submit" style="display:block;margin:20px auto;padding:0px 10px;"></form>';
				popWin('280','140',html,$(this),function(){
					uploadImg(imgMark);
				});
				return false;
			});
			$('.reUploadContent').mouseout(function(){
				$('.reUploadContent').remove();
			});
		});
		
	},
	showMore:function(){
		$('.showOn').click(function(){
			$('.bannerList .on').show();
			$('.bannerList .off').hide();
		});
		$('.showOff').click(function(){
			$('.bannerList .off').show();
			$('.bannerList .on').hide();
		});
	},
	init:function(){
		banner.add();
		banner.showMore();
	}
}
var articleList={
	add:function(){
		
	},
	buildSkin:function(){
		$('.articleList li:odd').css({background:'#e4e4e4'});
		$('.articleList li').mouseenter(function(){
			$(this).addClass('on');
		}).mouseleave(function(){
			$(this).removeClass('on');
		})
	},
	init:function(){
		articleList.add();
		articleList.buildSkin();
	}
}
var article={
	add:function(){
		
	},
	init:function(){
		article.add();
	}
}

var stadiumList={
	add:function(){
		
	},
	buildSkin:function(){
		$('.stadiumList li:odd').css({background:'#e4e4e4'});
		$('.stadiumList li').mouseenter(function(){
			$(this).addClass('on');
		}).mouseleave(function(){
			$(this).removeClass('on');
		})
	},
	init:function(){
		stadiumList.add();
		stadiumList.buildSkin();
	}
}
var stadium={
	delet:function(){
		$('.deletImg').click(function(){
			
		});
	},
	reUpload:function(){
		var html='<form enctype="multipart/form-data" method="post" target="imgField" id="uploadImg" accept-charset="utf-8"><input type="file" name="upload" style="display:block;margin:20px auto"><input type="hidden" value="upload" name="act"><input type="submit" value="上传" class="submit" style="display:block;margin:20px auto;padding:0px 10px;"></form>';
		$('.reUpload').click(function(){
			popWin('280','140',html,$(this),function(){
				uploadImg();
			});
			return false;
		});
	},
	init:function(){
		stadium.delet();
		stadium.reUpload();
	}
}

$(document).ready(function(){
//修正域名 ie6、7
	if($.browser.msie){if($.browser.version=="6.0"||$.browser.version=="7.0"){holy.fixie6();}}
//使用插件、函数
	//if($('').length>0){}
//frame高度
	if($('.frameSet').length>0){
		frameSet.init()
	}

//banner页面
	if($('.banner').length>0){banner.init()}
//文章列表页面
	if($('.articleListPage').length>0){articleList.init()}
//文章内页面
	if($('.articlePage').length>0){article.init()}
//场馆列表页面
	if($('.stadiumListPage').length>0){stadiumList.init()}
//场馆内页面
	if($('.stadiumPage').length>0){stadium.init()}
		
});
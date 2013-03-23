/*
 * 作者:剧中人
 * 博客：http://bh-lay.com/
 * Copyright (c) 2012-2018 小剧客栈
**/
var list=function(){
	$('.listBtn').click(function(){
		$(this).parent().toggleClass('on');
	});
}
$(document).ready(function(){
	list();
		
});
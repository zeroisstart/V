<?php
/* @var $this JoinController */

$this->breadcrumbs=array(
	'Join'=>array('/Home/join'),
	'Main',
);
?>

<div id="leftColumns">
		<div class="user_sec_nav">
					<ul>
												<li class="active_nav">
													<a href="/profile?ac=main">我的首页</a>
													</li>
																<li><a href="/profile?ac=team">参赛说明</a></li>
																<li><a href="/profile?ac=product">命题说明</a></li>
																<li><a href="/profile?ac=info">文件下载</a></li>
																
										</ul>
		</div>
</div>


<div class="sba_title">
	<h3 class="sba_caption">
		<!-- title end -->
		<?php echo $data['title']?>
		<!-- title end -->
	</h3>
	<span class="sba_spire">
		<!-- time end -->
		<?php echo $data['create_time']?>
		<!-- time end -->
	</span>
</div>


<div class="news_content">
	<?php echo $data['text']?>
</div>
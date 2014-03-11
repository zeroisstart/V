<?php
/* @var $this JoinController */

$this->breadcrumbs=array(
	'Join'=>array('/Home/join'),
	'Main',
);
?>




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


<div id="leftColumns">
		<div class="user_sec_nav">
					<ul>
																<li><a href="/join?id=22">参赛说明</a></li>
																<li><a href="/join?id=23">命题说明</a></li>
																<li><a href="/join?id=24">文件下载</a></li>
										</ul>
		</div>
</div>

<div class="news_content">
	<?php echo $data['text']?>
</div>
<?php
/* @var $this AboutController */

$this->breadcrumbs = array (
		'About' => array (
				'/Home/about' 
		),
		'Main' 
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
																<li><a href="/about?id=18">竞赛介绍</a></li>
																<li><a href="/about?id=19">竞赛组织机构</a></li>
																<li><a href="/about?id=4">竞赛通知</a></li>
																<li><a href="/about?id=21">组委会联系方式</a></li>
																
										</ul>
		</div>
</div>

<div class="news_content">
	<?php echo $data['text']?>
</div>
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


<div class="news_content">
	<?php echo $data['text']?>
</div>
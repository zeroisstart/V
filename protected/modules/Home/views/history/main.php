<?php
/* @var $this HistoryController */

$this->breadcrumbs=array(
	'History'=>array('/Home/history'),
	'Main',
);
?>


<div id="leftColumns">
		<div class="user_sec_nav">
					<ul>
															<li><a href="/history?id=25">第八届</a></li>
															<li><a href="/history?id=26">第七届</a></li>
															<li><a href="/history?id=27">第六届</a></li>
															<li><a href="/history?id=28">第五届</a></li>
															<li><a href="/history?id=29">第四届</a></li>
															<li><a href="/history?id=30">前三届</a></li>
															
																
										</ul>
		</div>
</div>

<div class="news_content">
	<?php echo $data['text']?>
</div>
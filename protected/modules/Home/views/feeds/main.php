<div id="contextAdorn"></div>
<div id="contextBox">
	<div id="rightContent">
	<?php foreach($dataProvider -> data as $model):?>
		<div class="feed_list">
			<div class="feed_list_img test">
				<a href="<?php echo $this -> createUrl('/Home/feeds/main',array('id'=>$model -> ID));?>">
					<img src="http://www.google.com.hk/images/srpr/logo4w.png" />
				</a>
			</div>

			<div class="feed_list_content">
				<span class="feed_list_title">
					<a href="<?php echo $this -> createUrl('/Home/feeds/main',array('id'=>$model -> ID));?>">
						<?php echo $model -> title?>
					</a>
				</span>
				<p class="timeline"><?php echo $model -> create_time?></p>
				<p class="f_content">
					<?php echo mb_strcut(strip_tags($model -> text),0,201).'...';?>
				</p>
			</div>
		</div>
	<?php endforeach;?>
	
		<div id="pager">
		<?php 
		
		$this->widget('CLinkPager',array(
				'header'=>'',
				'firstPageLabel' => '首页',
				'lastPageLabel' => '末页',
				'prevPageLabel' => '上一页',
				'nextPageLabel' => '下一页',
				'pages' => $dataProvider -> getPagination(),
				'maxButtonCount'=>13
		)
		);
		?>
		</div>  
	
                </div>
		<div id="leftColumns">
                	<?php $this -> widget('widget.Helper.leftLogin');?>
                </div>
</div>
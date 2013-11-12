<div id="contextAdorn"></div>
<div id="contextBox">
	<div id="rightContent" class="user_profile_info">
		<p class="user_notice">您好 <?php echo Yii::app() -> user->username;?></p>

		<div class="user_data_info">
			
			<p>
				作品图片 :
				<img alt="" src="<?php echo Yii::app ()->params->imgAccessPath . $product->img;?>">
			</p>
			
			<p>作品名称：<a href="<?php echo Yii::app ()->params->attachmentAccessPath . $product->doc; ?>"><?php echo $product -> title?></a></p>
			<p>作品简介：<?php echo $product -> title?></p>
			<p>硬件平台：<?php echo $product -> os?></p>
			<p>软件工具：<?php echo $product -> hard_driver?></p>
			<p>作品详情：<?php echo $product -> text?></p>
			<p>修改次数：<?php echo $product -> edit_count?> (不能修改多于三次)</p>
			<p>最后修改的时间: <?php echo $product -> create_time;?></p>
			
		</div>
		
	</div>
	<div id="leftColumns">
		<?php $this -> widget('widget.Helper.UserSecNav');?>
    </div>
</div>
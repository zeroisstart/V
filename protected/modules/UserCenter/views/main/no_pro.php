<div id="contextAdorn"></div>
<div id="contextBox">
	<div id="rightContent" class="user_profile_info">
		<p class="user_notice">您好 <?php echo Yii::app() -> user->username;?></p>

		<div class="user_data_info">
			
			<?php if(!$group -> isLeader()):?>
				<p class="user_data_info_title">对不起，您所在的组，队长还没有提交作品哦!</p>
			<?php else:?>
				<?php $this -> renderPartial('_pro_up_form',array('model'=>$model));?>
			<?php endif;?>
		</div>

	</div>
	<div id="leftColumns">
		<?php $this -> widget('widget.Helper.UserSecNav');?>
    </div>
</div>
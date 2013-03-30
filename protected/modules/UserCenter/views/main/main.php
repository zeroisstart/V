<div id="contextAdorn"></div>
<div id="contextBox">
	<div id="rightContent" class="user_profile_info">
		<p class="user_notice">您好 <?php echo Yii::app() -> user->username;?></p>
		
	</div>
	<div id="leftColumns">
		<?php $this -> widget('widget.Helper.UserSecNav');?>
    </div>
</div>
<div id="contextAdorn"></div>
<div id="contextBox">
	<div id="rightContent" class="user_profile_info">
		<p class="user_notice">您好 <?php echo Yii::app() -> user->username;?></p>
		
		
		
		
		
		<div class="user_data_info">
			
			<p>组队 ：成功（核查队员是否有重复）</p>
			<p>报名：成功</p>
			<p>缴纳报名费：成功</p>
			<p>初赛作品提交：成功</p>
			<p>初赛成绩：</p>
			<p>决赛作品提交：</p>
			<p>决赛成绩：</p>
		
		</div>
		
	</div>
	<div id="leftColumns">
		<?php $this -> widget('widget.Helper.UserSecNav');?>
    </div>
</div>
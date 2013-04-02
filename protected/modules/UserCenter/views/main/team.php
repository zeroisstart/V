<div id="contextAdorn"></div>
<div id="contextBox">
	<div id="rightContent" class="user_profile_info">
		<p class="user_notice">您好 <?php echo Yii::app() -> user->username;?></p>
		
		
		
		
		<div class="user_data_info">
			
			<p>组队 ：成功（核查队员是否有重复）</p>
			<p>组名 ：<?php echo $group_model -> name;?> </p>
			<p>报名 ：<?php echo $booked?"成功":"";?></p>
			<p>缴纳报名费 ：<?php echo $booked?"成功":""?></p>
			<p>初赛作品提交 ：<?php echo $product?"成功":'';?></p>
			<p>初赛成绩 ：</p>
			<?php if(0):?>
			<p>决赛作品提交 ：</p>
			<p>决赛成绩 ：</p>
			<?php endif?>
		
		</div>
		
	</div>
	<div id="leftColumns">
		<?php $this -> widget('widget.Helper.UserSecNav');?>
    </div>
</div>
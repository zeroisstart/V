<div id="contextAdorn"></div>
<div id="contextBox">
	<div id="rightContent" class="user_profile_info">
		<p class="user_notice">您好 <?php echo Yii::app() -> user->username;?></p>


		<div class="user_data_info">
			
			<?php if($groupMemberModel):?>
				<p>组队 ：成功</p>
				
				<?php if($booked):?>
				<p>报名：成功</p>
				<p>缴纳报名费：成功</p>
				<?php else:?>
				<p>报名：</p>
				<p>缴纳报名费：</p>
				<?php endif;?>
				<?php if($groupMemberModel -> group -> product):?>
				<p>初赛作品提交：成功</p>
				<p>初赛成绩：</p>
				<?php else:?>
				<p>初赛作品提交：</p>
				<p>初赛成绩：</p>
				<?php endif;?>
			<?php else:?>
				<p>对不起，目前还没有成功加入团队.</p>
			<?php endif;?>
			
			
			
		
		</div>
	</div>
	<div id="leftColumns">
		<?php $this -> widget('widget.Helper.UserSecNav');?>
    </div>
</div>
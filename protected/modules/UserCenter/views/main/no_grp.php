<div id="contextAdorn"></div>
<div id="contextBox">
	<div id="rightContent" class="user_profile_info">
		<p class="user_notice">您好 <?php echo Yii::app() -> user->username;?></p>

		<div class="user_data_info">

			<p class="user_data_info_title">
				您好，你还没有加入团队，请申请加入,
				<a href="<?php echo $this -> createUrl('/UserCenter/main/main',array('ac'=>'team'))?>">申请加入</a>,或者自己组建一个团队,
				<a href="<?php echo $this -> createUrl('/UserCenter/main/main',array('ac'=>'book'))?>">我要建团</a>
			</p>

		</div>

	</div>
	<div id="leftColumns">
		<?php $this -> widget('widget.Helper.UserSecNav');?>
    </div>
</div>
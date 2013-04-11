<div id="contextAdorn"></div>
<div id="contextBox">
	<div id="rightContent" class="user_profile_info">
		<p class="user_notice">您好 <?php echo Yii::app() -> user->username;?></p>


		<?php if($model -> isNewRecord):?>
		<div class="user_data_info">
			<?php echo $this -> renderPartial('_book_form',array('model'=>$model));?>
		</div>
		<?php else:?>
		<div class="user_data_info">
			<p><span>报名状态:</span> <?php
				if($model -> state ==0){
					echo "审核中...";
				}elseif($model -> state == 1){
					echo "报名成功!";
				}else{
					echo "申请失败!";
				}
			?></p>
			<img alt="" src="<?php echo Yii::app ()->params->imgAccessPath . $model->img;?>">
		</div>
		<?php endif;?>
		
	</div>
	<div id="leftColumns">
		<?php $this -> widget('widget.Helper.UserSecNav');?>
    </div>
</div>
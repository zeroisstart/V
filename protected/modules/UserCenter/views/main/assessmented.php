<div id="contextAdorn"></div>
<div id="contextBox">
	<div id="rightContent" class="user_profile_info">
		<p class="user_notice">您好 <?php echo Yii::app() -> user->username;?></p>

		<div class="user_data_info">

			<p class="nav_title">评过的作品</p>
			
			<?php
			$this->renderPartial ( '_assessment_form', array (
					'model' => $model,
					'dataProvider' => $dataProvider 
			) );
			?>
			
			
		</div>
	</div>
	<div id="leftColumns">
		<?php $this -> widget('widget.Helper.UserSecNav');?>
    </div>
</div>
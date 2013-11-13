<div id="contextAdorn"></div>
<div id="contextBox">
	<div id="rightContent" class="user_profile_info">
		<p class="user_notice">您好 <?php echo Yii::app() -> user->username;?></p>
		
	

		<div class="user_data_info">
			<?php if($edit):?>
				<?php echo $this -> renderPartial('_info_form',array('model'=>$model));?>			
			<?php else:?>
				<?php
				$ary_key = array (
						'Nickname',
						'Realname',
						'IDNum',
						'Company_name',
						'Mobile',
						'IDNum',
						'Email',
						'City' 
				);
				foreach ($ary_key as $key):
				?>				
				<p><span><?php echo $model ->getAttributeLabel($key);?></span> ：<?php echo $model -> $key?></p>
				<?php endforeach;?>
				<div class="div_btn">
					<a href="<?php echo $this -> createUrl('/UserCenter/main/main',array('ac'=>'info','edit'=>true))?>" class="green_btn">编辑</a>
				</div>
			<?php endif;?>				
		</div>
		
		

	</div>
	<div id="leftColumns">
		<?php $this -> widget('widget.Helper.UserSecNav');?>
    </div>
</div>
<div id="contextAdorn"></div>
<div id="contextBox">
	<div id="rightContent" class="user_profile_info">
		<p class="user_notice"><span>您好：<?php echo Yii::app() -> user->username;?></span></p>
		<p class="user_notice">
			<span>用户身份：<?php echo $model ->getUserCategory();?></span>
		</p>
		<p class="user_notice"><span><a href="<?php echo $this -> createUrl('/profile');?>?ac=export" target="_blank" style="color: red;text-decoration:none;">报名信息导出</a></span></p>
	

		<div class="user_data_info">
			<?php if($edit):?>
				
				<?php if ($profile->User_category == '1') :?>
				<?php echo $this -> renderPartial('_info_student_form',array('model'=>$model));?>
				<?php else:?>
				<?php echo $this -> renderPartial('_info_form',array('model'=>$model));?>
				<?php endif;?>		
								
			<?php else:?>
				<?php
				$ary_key = array (
						'Nickname',
						//'gender',
						'IDNum',
						'Realname',
						'nation',
						'job',
						'address',
						'schoolType',
						'schoolName',
						'majoy',
						'joinDate',
						'Email',
						'qq',
						'Mobile',
						'City',
						'Company_name',
				);
				foreach ($ary_key as $key):
				?>				
				<p><span><?php echo $model ->getAttributeLabel($key);?></span> ：<?php echo $model -> $key?></p>
				<?php endforeach;?>
				<?php if(1): ?>
				<div class="div_btn">
					<a href="<?php echo $this -> createUrl('/UserCenter/main/main',array('ac'=>'info','edit'=>true))?>" class="green_btn">编辑</a>
				</div>
				<?php endif;?>
			<?php endif;?>				
		</div>
		
		

	</div>
	<div id="leftColumns">
		<?php $this -> widget('widget.Helper.UserSecNav');?>
    </div>
</div>
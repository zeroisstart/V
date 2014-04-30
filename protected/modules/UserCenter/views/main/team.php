<?php 
$this -> registerPopupBox();
?>
<div id="contextAdorn"></div>
<div id="contextBox">
	<div id="rightContent" class="user_profile_info">
		<p class="user_notice">您好 <?php echo Yii::app() -> user->username;?></p>
		<?php if($count > 3):?>
		<p class="user_notice"><span><a href="<?php echo $this -> createUrl('/profile');?>?ac=export" target="_blank" style="color: red;text-decoration:none;">报名信息导出</a></span></p>
		<?php endif;?>
		
		<div class="user_data_info">
			
			<?php if($count > 3):?>
			<p><span>组队</span> ：成功 </p>
			<?php else:?>
			<p><span>组队</span> ：不成功 （成员不足） </p>
			<?php endif;?>
			<p><span>组名</span> ：<?php echo $group_model -> name;?> </p>
			<p><span>队长</span> ：<?php echo $group_model -> username;?>
			<?php if($teacher):?>
			<p><span>指导老师</span> ：<?php echo $teacher -> profile -> Realname;?></p>
			<?php else:?>
			<p><span>指导老师</span> ：</p>
			<?php endif;?>
			<p><span>团队成员</span> ：<?php echo $memberList;?></p>
			

			
	
			
			<?php if($userGroupModel -> gid):?>
			<p><span>作品名称</span> ：<?php echo $userGroupModel -> productname;?></p>
			
			<p><span>报名表</span> ：<img src="/img/<?php echo $userGroupModel -> bookimg;?>"/></p>
			<?php endif;?>
			<?php if($isLeader):?>
			<?php

$form = $this->beginWidget ( 'CActiveForm', array (
		'id' => 'bookimg-form',
		'enableClientValidation' => true,
		'method' => 'post',
		'htmlOptions' => array (
				'enctype' => "multipart/form-data" 
		),
		'clientOptions' => array (
				'validateOnSubmit' => true 
		) 
) );?>

			<div class="row">
				<?php echo $form->labelEx($userGroupModel,'productname'); ?>
				<?php echo $form->textfield($userGroupModel,'productname'); ?>
				<?php echo $form->error($userGroupModel,'productname'); ?>
			</div>

			<div class="row">
				<?php echo $form->labelEx($userGroupModel,'bookimg'); ?>
				<?php echo $form->fileField($userGroupModel,'bookimg'); ?>
				<?php echo $form->error($userGroupModel,'bookimg'); ?>
			</div>
			
			<div class="div_btn row">
				<?php echo CHtml::submitButton('上传报名表盖章件',array('class'=>'green_btn'))?>
			</div>
<?php $this->endWidget(); ?>
<?php endif;?>			
		</div>
					
			<?php if($count > 3):?>
			<?php if($userGroupModel -> state):?>
			<p><span>报名状态</span> ：完成</p>
			<?php else:?>
			<p><span>报名状态</span> ：未完成</p>
			<?php endif;?>
			<?php else:?>
			<p><span>报名状态</span> ：未完成</p>
			<?php endif;?>
			
			<p><span>初赛作品</span> ：<?php echo $product?"成功":'未提交';?></p>
			<p><span>初赛成绩</span> ：</p>
		
	</div>
	<div id="leftColumns">
		<?php $this -> widget('widget.Helper.UserSecNav');?>
    </div>
</div>
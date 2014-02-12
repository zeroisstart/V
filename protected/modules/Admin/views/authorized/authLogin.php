<div class="topBar">
	<div class="topContent">
	</div>
</div>
<div class="loginBox">
	<div class="loginCaption">
		<span>锁</span>登录
	</div>
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'login-form',
		'enableClientValidation'=>true,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
		),
	)); ?>	
		<div class="inputBar">
			<label>帐号:</label>
			<div class="inputBj">
				<?php echo CHtml::activeTextField($model, 'username',array('class'=>'full','id'=>'username'))?>
				<div class="ico_user"></div>
				<?php echo $form->error($model,'username'); ?>
			</div>
		</div>
		<div class="inputBar">
			<label>密码:</label>
			<div class="inputBj">
				<?php echo CHtml::activePasswordField($model, 'password',array('class'=>'full','id'=>'password'))?>
				<div class="ico_password"></div>
				<?php echo $form->error($model,'password'); ?>
			</div>
		</div>
		<input type="submit" value="登录" id="loginBtn" />
		<div class="rememberCode" style="display:none;">
			<input type="checkbox" checked="true" />下次自动登录
		</div>
	<?php $this->endWidget(); ?>
</div>
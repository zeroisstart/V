<?php
/* @var $this RegisterController */

$this->breadcrumbs=array(
	'Register',
);
?>

<h1 style="text-align:center;">注册</h1>

<div class="form center_form">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'register-form',
		'enableClientValidation'=>true,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
		),
	)); ?>

	<p class="note none">Fields with <span class="required">*</span> are required.</p>
	
	<div class="row">
		<?php echo $form->labelEx($model,'userType'); ?>
		<?php echo $form->dropDownList ($model,'userType',$model-> user_type); ?>
		<?php echo $form->error($model,'userType'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'password_confirm'); ?>
		<?php echo $form->passwordField($model,'password_confirm'); ?>
		<?php echo $form->error($model,'password_confirm'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email'); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('注册'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->

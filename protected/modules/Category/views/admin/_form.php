<?php
/* @var $this CategoryController */
/* @var $model Category */
/* @var $form CActiveForm */
?>

<div class="form">

<?php

$_form = array ();

if ($model->isNewRecord) {
	$_form ['title'] = '新增标签';
	$_form ['submit'] = '保存';
} else {
	$_form ['title'] = '编辑标签';
	$_form ['submit'] = '编辑';
}

$form = $this->beginWidget ( 'CActiveForm', array (
		'id' => 'category-form-form',
		'enableAjaxValidation' => false 
) );
?>

	<p class="note">
		Fields with <span class="required">*</span> are required.
	</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title'); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<?php if($model -> isNewRecord && !$id):?>
	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->checkBoxList($model,'type',$model -> types);?>
		<?php echo $form->error($model,'type'); ?>
	</div>
	<?php endif;?>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit',array('value'=>$_form['submit'])); ?>
	</div>

<?php $this->endWidget(); ?>

</div>
<!-- form -->
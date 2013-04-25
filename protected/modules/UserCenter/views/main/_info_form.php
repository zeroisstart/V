<?php
/* @var $this UserProfileController */
/* @var $model UserProfile */
/* @var $form CActiveForm */
?>

<div class="form">

<?php
$cate = array (); // $model->getAllCate ();

$cate ['0'] = '其他';

$_form = array ();

if ($model->isNewRecord) {
	$_form ['title'] = '新增';
	$_form ['submit'] = '保存';
} else {
	$_form ['title'] = '编辑';
	$_form ['submit'] = '保存';
}
$_form ['uploadUrl'] = $this->createUrl ( '/Admin/Content/upload' );

$_form ['fileUpload'] = $this->createUrl ( '/Admin/Content/fileUpload' );
$_form ['accessPath'] = Yii::app ()->params ['imgAccessPath'];
$_form ['fileAccessUrl'] = Yii::app ()->params ['fileAccessPath'];

?>

<?php

$form = $this->beginWidget ( 'CActiveForm', array (
		'id' => 'info-form',
		'enableAjaxValidation' => false,
		'enableClientValidation' => true 
) );
?>

 	<?php echo $form->errorSummary($model); ?>
	
	<div class="row">
		<p>
			<span>用户身份</span>: <?php echo $model ->getUserCategory();?></p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Nickname'); ?>
		<?php echo $form->textField($model,'Nickname'); ?>
		<?php echo $form->error($model,'Nickname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'IDNum'); ?>
		<?php echo $form->textField($model,'IDNum'); ?>
		<?php echo $form->error($model,'IDNum'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Realname'); ?>
		<?php echo $form->textField($model,'Realname'); ?>
		<?php echo $form->error($model,'Realname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'City'); ?>
		<?php echo $form->textField($model,'City'); ?>
		<?php echo $form->error($model,'City'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Company_name'); ?>
		<?php echo $form->textField($model,'Company_name'); ?>
		<?php echo $form->error($model,'Company_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Email'); ?>
		<?php echo $form->textField($model,'Email'); ?>
		<?php echo $form->error($model,'Email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Mobile'); ?>
		<?php echo $form->textField($model,'Mobile'); ?>
		<?php echo $form->error($model,'Mobile'); ?>
	</div>

	<div class="div_btn">
		<?php echo CHtml::link($_form['submit'],'javascript:void(0);',array('class'=>'green_btn sub_btn'));?>
	</div>

<?php $this->endWidget(); ?>

</div>
<!-- form -->

<script>
	$(document).ready(function(){
		$(".sub_btn").click(function(){
			$("#info-form").submit();
		})
	})
</script>
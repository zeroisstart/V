<?php
/* @var $this UserBookedController */
/* @var $model UserBooked */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'book-form',
	'htmlOptions' => array (
			'method' => 'post',
			'enctype' => "multipart/form-data"
	),
	'enableClientValidation'=>true,
	'enableAjaxValidation'=>false,
)); ?>

	<div class="t_row booked_row">
		<?php echo $form->labelEx($model,'img'); ?>
		<?php echo $form->fileField($model,'img',array('class'=>'ipt w250')); ?>
		<?php echo $form->error($model,'img'); ?>
	</div>


	<div class="div_btn">
		<?php echo CHtml::link('上传','javascript:void(0);',array('class'=>'green_btn submit_btn'));?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script>
$(document).ready(function(){
	$(".submit_btn").click(function(){
		$("#book-form").submit();
	})
})
</script>
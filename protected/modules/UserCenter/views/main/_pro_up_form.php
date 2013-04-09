<?php
/* @var $this UserProductGradeController */
/* @var $model UserProductGrade */
/* @var $form CActiveForm */
?>

<div class="form">
<?php
$cate = array();// $model->getAllCate ();

$cate['0'] = '其他';

$_form = array ();

if ($model->isNewRecord) {
	$_form ['title'] = '新增';
	$_form ['submit'] = '保存';
} else {
	$_form ['title'] = '编辑';
	$_form ['submit'] = '编辑';
}
$_form ['content'] = $model -> text;
$_form ['uploadUrl'] = $this->createUrl ( '/Admin/Content/upload' );
 
$_form ['fileUpload'] = $this->createUrl ( '/Admin/Content/fileUpload' );
$_form ['accessPath'] = Yii::app ()->params ['imgAccessPath'];
$_form ['fileAccessUrl'] = Yii::app ()->params ['fileAccessPath'];

?>


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pro_form',
	'htmlOptions' => array (
			'method' => 'post',
			'enctype' => "multipart/form-data"
	),
	'enableClientValidation'=>true,
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


	<?php if(0):?>
	<div class="t_row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->textField($model,'type'); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>
	<?php endif;?>

	<div class="t_row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('class'=>'form_iuput')); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="t_row">
		<?php echo $form->labelEx($model,'doc'); ?>
		<?php echo $form->fileField($model,'doc',array('class'=>'form_iuput')); ?>
		<?php echo $form->error($model,'doc'); ?>
	</div>

	<div class="t_row">
		<?php echo $form->labelEx($model,'img'); ?>
		<?php echo $form->fileField($model,'img',array('class'=>'form_iuput')); ?>
		<?php echo $form->error($model,'img'); ?>
	</div>

	<div class="t_row">
		<?php echo $form->labelEx($model,'os'); ?>
		<?php echo $form->textField($model,'os',array('class'=>'form_iuput')); ?>
		<?php echo $form->error($model,'os'); ?>
	</div>

	<div class="t_row">
		<?php echo $form->labelEx($model,'ep_num'); ?>
		<?php echo $form->textField($model,'ep_num',array('class'=>'form_iuput')); ?>
		<?php echo $form->error($model,'ep_num'); ?>
	</div>
	
	<div class="t_row">
		<?php echo $form->labelEx($model,'detail'); ?>
		<?php echo $form->textArea($model,'detail',array('class'=>'form_upload_textarea')); ?>
		<?php echo $form->error($model,'detail'); ?>
	</div>
	
	<div class="t_row">
		<?php echo $form->labelEx($model,'hard_driver'); ?>
		<?php echo $form->textArea($model,'hard_driver',array('class'=>'form_upload_textarea')); ?>
		<?php echo $form->error($model,'hard_driver'); ?>
	</div>

	<div class="t_row">
		<?php echo $form->labelEx($model,'text'); ?>
		<?php echo $form->textArea($model,'text',array('class'=>'form_upload_textarea')); ?>
		<?php echo $form->error($model,'text'); ?>
	</div>


	<div class="div_btn">
		<?php echo CHtml::link($_form['submit'],'javascript:void(0);',array('class'=>'green_btn sub_btn'));?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script>
	$(document).ready(function(){
		$(".sub_btn").click(function(){
			$("#pro_form").submit();
		})
	})
</script>
<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<h1>请先登陆</h1>

<div class="form login_form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('class'=>'login_input')); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('class'=>'login_input')); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="buttons div_login_btn">
		<span>
		<?php echo CHtml::link('登陆','javascript:void(0);',array('class'=>'login_btn'));?>
		</span>
		| 
		<?php echo CHtml::link('注册',$this -> createUrl('/UserCenter/register/register'),array('class'=>'reg_btn'));?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
<script>
	$(".login_btn").click(function(){
		$("#login-form").submit();
	})
</script>
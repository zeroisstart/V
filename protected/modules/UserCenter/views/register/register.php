<?php
/* @var $this RegisterController */

$this->breadcrumbs = array (
		'Register' 
);
?>

<div class="registerFrame">
	<div class="registerFrameBorder">
		<div class="form login_form">
			<div class="registerTitle">请填写以下注册信息...</div>
	<?php
	
$form = $this->beginWidget ( 'CActiveForm', array (
			'id' => 'register-form',
			'enableClientValidation' => true,
			'clientOptions' => array (
				'validateOnSubmit' => true 
			) 
	) );
	?>

	<p class="note none">
				Fields with <span class="required">*</span> are required.
			</p>

			<div class="row">
		<?php echo $form->labelEx($model,'userType'); ?>
		<?php echo $form->dropDownList ($model,'userType',$model-> user_type,array('class'=>'reg_select')); ?>
		<?php echo $form->error($model,'userType'); ?>
	</div>

			<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('class'=>'reg_input')); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

			<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('class'=>'reg_input')); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

			<div class="row">
		<?php echo $form->labelEx($model,'password_confirm'); ?>
		<?php echo $form->passwordField($model,'password_confirm',array('class'=>'reg_input')); ?>
		<?php echo $form->error($model,'password_confirm'); ?>
	</div>

			<div class="row company_name_row">
		<?php echo $form->labelEx($model,'company_name'); ?>
		<?php echo $form->textField($model,'company_name',array('class'=>'reg_input')); ?>
		<?php echo $form->error($model,'company_name'); ?>
	</div>

			<div class="row">
		<?php echo $form->labelEx($model,'contact'); ?>
		<?php echo $form->textField($model,'contact',array('class'=>'reg_input')); ?>
		<?php echo $form->error($model,'contact'); ?>
	</div>
			<div class="row">
		<?php echo $form->labelEx($model,'mobile'); ?>
		<?php echo $form->textField($model,'mobile',array('class'=>'reg_input')); ?>
		<?php echo $form->error($model,'mobile'); ?>
	</div>

			<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('class'=>'reg_input')); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>


			<div class="row">
		<?php echo $form->labelEx($model,'city'); ?>
		<?php echo $form->textField($model,'city',array('class'=>'reg_input')); ?>
		<?php echo $form->error($model,'city'); ?>
	</div>


			<div>
				<span class="allowregister">
		<?php echo $form->labelEx($model,'allowRegister'); ?>
		<?php echo $form->checkBox($model,'allowRegister'); ?>
		<a href="">查看大赛注册协议</a>
				</span>
		
		<?php echo $form->error($model,'allowRegister'); ?>
	</div>

			<div class="registerBtn">
				<a href="javascript:void();" class="submit_btn">注册</a>
		<?php // echo CHtml::submitButton('注册'); ?>
	</div>

<?php $this->endWidget(); ?>
</div>
		<!-- form -->

	</div>
</div>

<script>
$(document).ready(function(){

	_form_reset= function(){
		
	}
	
	$(".reg_input").change(function(){
		switch($(this).val()){
			case '3':
				$('.company_name_row').hide();
				break;
			case '4':
				$('.company_name_row').show();
				break;
			case '5':
				$('.company_name_row').show();
				break;
			default :
				break;
		}
	})
	$(".reg_input").change();

	$(".submit_btn").click(function(){
		$("#register-form").submit();
	})
})
</script>


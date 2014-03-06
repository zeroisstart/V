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
		带有 <span class="required">*</span> 为必填。
	</p>

	<div class="row">
		<?php if(!$admin):?>
		<?php echo $form->labelEx($model,'userType'); ?>
		<?php echo $form->dropDownList ($model,'userType',array(2=>'评委'),array('class'=>'reg_select')); ?>
		<?php echo $form->error($model,'userType'); ?>
		<?php else:?>
		<div style="display:none;">
			<?php echo $form->labelEx($model,'userType'); ?>
			<?php echo $form->dropDownList ($model,'userType',array(9=>'评委'),array('class'=>'reg_select')); ?>
			<?php echo $form->error($model,'userType'); ?>
		</div>
		<?php endif;?>
	</div>

	
	<div class="row">
		<?php echo $form->labelEx($model,'district'); ?>
		<?php echo $form->dropDownList ($model,'district',$model-> district_list,array('class'=>'reg_select')); ?>
		<?php echo $form->error($model,'district'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'area'); ?>
		<?php echo $form->dropDownList ($model,'area',$model-> area_list,array('class'=>'reg_select')); ?>
		<?php echo $form->error($model,'area'); ?>
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

	<?php if(0):?>
	<div class="row company_name_row">
		<?php echo $form->labelEx($model,'company_name'); ?>
		<?php echo $form->textField($model,'company_name',array('class'=>'reg_input')); ?>
		<?php echo $form->error($model,'company_name'); ?>
	</div>
	<?php endif;?>

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

		<?php if(0):?>
		<div class="row">
		<?php echo $form->labelEx($model,'city'); ?>
		<?php echo $form->textField($model,'city',array('class'=>'reg_input')); ?>
		<?php echo $form->error($model,'city'); ?>
		</div>
		<?php endif;?>

	</div>
		<?php echo CHtml::submitButton('添加'); ?>
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
	});
	var _area_list = <?php echo $area_list_joson;?>;
	$("#RegisterForm_district").change(function(){
			var _p = $(this).val();
			var _sub_area = _area_list[_p];
			$("#RegisterForm_area").empty();
			
			$.each(_sub_area,function(k,v){
				$("<option>").val(v.id).html(v.name).appendTo($("#RegisterForm_area"));
			});
			
	});
})
</script>


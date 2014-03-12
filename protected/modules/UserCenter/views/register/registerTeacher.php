<?php
/*
 * @var $this RegisterController
 */
$this->breadcrumbs = array ('Register' );
?>
<div class="registerFrame">
	<div class="registerFrameBorder">
		<div class="form login_form">
			<div class="registerTitle">请填写以下注册信息...</div>
	<?php
	
	$form = $this->beginWidget ( 'CActiveForm', array ('id' => 'register-form', 'enableClientValidation' => true, 'clientOptions' => array ('validateOnSubmit' => true ) ) );
	?>

	<p class="note none">
				Fields with <span class="required">*</span> are required.
			</p>

			
	<div class="row">
		<?php echo $form->labelEx($model,'contact'); ?>
		<?php echo $form->textField($model,'contact',array('class'=>'reg_input')); ?>
		<?php echo $form->error($model,'contact'); ?>
	</div>
			
	<div class="row">
		<?php echo $form->labelEx($model,'userType'); ?>
		<?php echo $form->dropDownList ($model,'userType',$model-> user_type,array('class'=>'reg_select')); ?>
		<?php echo $form->error($model,'userType'); ?>
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
		<?php echo $form->labelEx($model,'company_name'); ?>
		<?php echo $form->textField($model,'company_name',array('class'=>'reg_input')); ?>
		<?php echo $form->error($model,'company_name'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'job'); ?>
		<?php echo $form->textField($model,'job',array('class'=>'reg_input')); ?>
		<?php echo $form->error($model,'job'); ?>
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
		<?php echo $form->labelEx($model,'idcard'); ?>
		<?php echo $form->textField($model,'idcard',array('class'=>'reg_input')); ?>
		<?php echo $form->error($model,'idcard'); ?>
	</div>
	
				<div class="row">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textField($model,'address',array('class'=>'reg_input')); ?>
		<?php echo $form->error($model,'address'); ?>
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
		<a href="javascript:void(0);">查看大赛注册协议</a>
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
	});
	
	$(".reg_input").change();

	$(".submit_btn").click(function(){
		$("#register-form").submit();
	});

	var _area_list = <?php echo $area_list_joson;?>;
	$("#RegisterTeacherForm_userType").change(function(){
			var _p = $(this).val();
			var _sub_area = _area_list[_p];
			//$("#RegisterTeacherForm_userType").empty();
			
			$.each(_sub_area,function(k,v){
				$("<option>").val(v.id).html(v.name).appendTo($("#RegisterForm_area"));
			});
			
	});
	
	$("#RegisterTeacherForm_userType").change(function(){
		var _url="<?php echo $this -> createUrl('/register')?>";
		var _id = $(this).val();
		_url+='?userType='+_id;
		window.location.href = _url;
	});
});
</script>


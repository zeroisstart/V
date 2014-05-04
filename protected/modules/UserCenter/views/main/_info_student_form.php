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
	
	<?php if(0):?>
	<div class="row">
		<p>
			<span>用户身份</span>: <?php echo $model ->getUserCategory();?>
		</p>
	</div>
	<?php endif;?>

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
		<?php echo $form->labelEx($model,'nation'); ?>
		<?php echo $form->dropDownList ($model,'nation',$model-> nation_list,array('class'=>'reg_select')); ?>
		<?php echo $form->error($model,'nation'); ?>
	</div>
	
	
		<div class="row">
		<?php echo $form->labelEx($model,'job'); ?>
		<?php echo $form->textField($model,'job'); ?>
		<?php echo $form->error($model,'job'); ?>
	</div>

		<div class="row">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textField($model,'address'); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>

		
	<div class="row">
		<?php echo $form->labelEx($model,'schoolType'); ?>
		<?php echo $form->textField($model,'schoolType'); ?>
		<?php echo $form->error($model,'schoolType'); ?>
	</div>
	
	
		<div class="row">
		<?php echo $form->labelEx($model,'schoolName'); ?>
		 <?php
          $this->widget('zii.widgets.jui.CJuiAutoComplete',array(
 			'model'=>$model,
 			'attribute' => 'schoolName',
			'value'=>$model -> schoolName,
            'sourceUrl' => $this->createUrl('/UserCenter/register/get_school'),
 			'source'=>array('ac1','ac2','ac3'),
 			// additional javascript options for the autocomplete plugin
 			'options'=>array(
 					'minLength'=>'1',
 											),
 											'htmlOptions'=>array(
 											'class'=>'reg_input',
 											),
 										));
        ?>
		<?php echo $form->error($model,'schoolName'); ?>
	</div>
	
		<div class="row">
		<?php echo $form->labelEx($model,'majoy'); ?>
		<?php
          $this->widget('zii.widgets.jui.CJuiAutoComplete',array(
 			'model'=>$model,
 			'attribute' => 'majoy',
            'sourceUrl' => $this->createUrl('/UserCenter/register/get_majoy'),
 			'source'=>array('ac1','ac2','ac3'),
 			// additional javascript options for the autocomplete plugin
 			'options'=>array(
 					'minLength'=>'1',
 											),
 											'htmlOptions'=>array(
 											'class'=>'reg_input',
 											),
 		));
         ?>
		
		<?php echo $form->error($model,'majoy'); ?>
	</div>
	
	
			<div class="row">
		<?php echo $form->labelEx($model,'joinDate'); ?>
		<?php 
		$this->widget('zii.widgets.jui.CJuiDatePicker',array(
				'language'=>'zh_cn',
				'name'=>'UserProfile[joinDate]',
				'value'=> $model -> joinDate,
				'options'=>array(
						'showAnim'=>'fold',
						'maxDate'=>'new Date()',
						'dateFormat'=>'yy-mm',
				),
				'htmlOptions'=>array(
						'style'=>'height:18px',
						'maxlength'=>8,'class'=>'reg_input',
				),
		));
		?>
		
		<?php echo $form->error($model,'joinDate'); ?>
	</div>
	
			<div class="row">
		<?php echo $form->labelEx($model,'Email'); ?>
		<?php echo $form->textField($model,'Email'); ?>
		<?php echo $form->error($model,'Email'); ?>
	</div>
	
		<div class="row">
		<?php echo $form->labelEx($model,'qq'); ?>
		<?php echo $form->textField($model,'qq'); ?>
		<?php echo $form->error($model,'qq'); ?>
	</div>
	
	
	<div class="row">
		<?php echo $form->labelEx($model,'Mobile'); ?>
		<?php echo $form->textField($model,'Mobile'); ?>
		<?php echo $form->error($model,'Mobile'); ?>
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
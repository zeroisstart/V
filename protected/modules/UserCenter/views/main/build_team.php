<div id="contextAdorn"></div>
<div id="contextBox">
	<div id="rightContent" class="user_profile_info">
		<p class="user_notice">您好 <?php echo Yii::app() -> user->username;?></p>

		<div class="user_data_info">
		
		<?php
		/* @var $this GrpTeamListController */ 
		/* @var $model GrpTeamList */ 
		/* @var $form CActiveForm */ 
		?> 

		<div class="form"> 
		
		<?php $form=$this->beginWidget('CActiveForm', array( 
		    'id'=>'grp-team-list-grpTeamForm-form', 
		    'enableAjaxValidation'=>false, 
		)); ?>
		
		    <p class="note">带有 <span class="required">*</span> 为必填。</p> 
		
		    <?php echo $form->errorSummary($model); ?>
		
		    <div class="row"> 
		        <?php echo $form->labelEx($model,'name'); ?>
		        <?php echo $form->textField($model,'name'); ?>
		        <?php echo $form->error($model,'name'); ?>
		    </div>
		    
		    <div class="row"> 
		        <?php echo $form->labelEx($model,'belong'); ?>
		        <?php echo $form->textField($model,'belong'); ?>
		        <?php echo $form->error($model,'belong'); ?>
		    </div> 
		
		    <div class="row buttons"> 
		        <?php echo CHtml::submitButton('Submit'); ?>
		    </div> 
		
		<?php $this->endWidget(); ?>
		
		</div><!-- form -->
		
		</div>

	</div>
	<div id="leftColumns">
		<?php $this -> widget('widget.Helper.UserSecNav');?>
    </div>
</div>
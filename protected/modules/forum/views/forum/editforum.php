<?php
/*
$this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>array_merge(
        $model->getBreadcrumbs(!$model->isNewRecord),
        array($model->isNewRecord?'New forum':'Edit')
    )
));*/
?>
<div class="form" style="margin:20px;">
<?php $form=$this->beginWidget('CActiveForm'); ?>

    <p class="note">带星号 <span class="required">*</span> 为必填。</p>

    <div class="row">
        <?php echo $form->labelEx($model,'parent_id'); ?>
        <?php echo CHtml::activeDropDownList($model, 'parent_id', CHtml::listData(
                Forum::model()->findAll(),
                'id', 'title'
            ), array('empty'=>'None (root)')); ?>
        <?php echo $form->error($model,'parent_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'title'); ?>
        <?php echo $form->textField($model,'title'); ?>
        <?php echo $form->error($model,'title'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'description'); ?>
        <?php echo $form->textArea($model,'description',array('rows'=>10, 'cols'=>70)); ?>
        <?php echo $form->error($model,'description'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'listorder'); ?>
        <?php echo $form->textField($model,'listorder'); ?>
        <?php echo $form->error($model,'listorder'); ?>
    </div>

    <div class="row rememberMe">
        <?php echo $form->checkBox($model,'is_locked',array('uncheckValue'=>0)); ?>
        <?php echo $form->labelEx($model,'is_locked'); ?>
        <?php // echo $form->error($model,'lockthread'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? '提交' : '保存',array('class'=>'button blue')); ?>
    </div>
<?php $this->endWidget(); ?>
</div><!-- form -->

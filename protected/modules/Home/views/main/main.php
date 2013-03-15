<?php
/* @var $this MainController */

$this->breadcrumbs = array (
		'Main' 
);
?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<p>
	You may change the content of this page by modifying the file
	<tt><?php echo __FILE__; ?></tt>
	.
</p>

<?php
$form = $this->beginWidget ( 'CActiveForm', array (
		'id' => 'contact-form',
		'action' => $this->createUrl ( '/System/upload/ImgUpload' ),
		'enableClientValidation' => true,
		'method' => 'post',
		'htmlOptions' => array (
				'enctype' => "multipart/form-data" 
		),
		'clientOptions' => array (
				'validateOnSubmit' => true 
		) 
) );

?>

<?php

$model = new ImgUploadForm ();
$this->widget ( 'widget.system.uploadForm', array (
		'model' => $model 
) );

?>

<?php echo CHtml::submitButton('submit');?>

<?php $this -> endWidget()?>
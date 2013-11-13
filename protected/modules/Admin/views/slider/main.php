<?php
/* @var $this SliderController */

$this->breadcrumbs = array (
		'Slider' => array (
				'/Admin/slider' 
		),
		'Main' 
);
?>
<h1><?php echo $this->title; ?></h1>




<?php

$this->renderPartial ( '_slider', array (
		'model' => $model,
		'dataProvider' => $dataProvider 
) )?>
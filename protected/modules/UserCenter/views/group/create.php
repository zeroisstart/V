<?php
/* @var $this GroupController */

$this->breadcrumbs = array (
		'Group' => array (
				'/UserCenter/group' 
		),
		'Create' 
);
?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>


<div class="grid-form">
	<?php
	$this->renderPartial ( '_form', array (
			'model' => $model 
	) );
	?>
</div>
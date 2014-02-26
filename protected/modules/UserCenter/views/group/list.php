<?php
/* @var $this GroupController */

$this->breadcrumbs = array (
		'Group' => array (
				'/UserCenter/group' 
		),
		'List' 
);
?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<div class="grid_form">
<?php
/* @var $this AdminController */

$this->widget ( 'widget.Helper.GridView', array (
		'dataProvider' => $dataProvider,
		
		'columns' => array (
				'name',
				'uid',
				'state' => array (
						'name' => 'state',
						'value' => '$data -> _state[$data -> state]'
				),
				array (
						'class' => 'widget.helper.ButtonColumn',
						//'template'=>'' 
				// 'viewButtonUrl' =>
				// 'Yii::app()->controller->createUrl("/news/".$data->primaryKey)'
				 
		) 
) ))?>


</div>
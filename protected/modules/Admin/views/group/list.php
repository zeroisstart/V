<?php
/* @var $this GroupController */

$this->breadcrumbs = array (
		'Group' => array (
				'/Admin/group' 
		),
		'List' 
);
?>

<h1>参赛队伍管理</h1>

<div class="grid_form">
<?php
/* @var $this AdminController */

#var_dump($dataProvider -> data);
#die;

$this->widget ( 'widget.helper.GridView', array (
		'dataProvider' => $dataProvider,
		'columns' => array (
				'ID',
				'name' => array (
						'name' => 'name',
						'type'=>'raw',
						'value' => '$data -> getMemberLink($data->name);',
				),
				'username',
				'create_time',
				'state' => array (
						'name' => 'state',
						'value' => '$data -> _state[$data -> state];' 
				),
				array (
						'template' => '{update}',
						'class' => 'widget.helper.ButtonColumn' 
				) 
		) 
) )?>


</div>
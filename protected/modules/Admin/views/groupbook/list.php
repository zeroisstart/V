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

$this->widget ( 'widget.Helper.GridView', array (
		'dataProvider' => $dataProvider,
		'columns' => array (
				'id',
				'gid'=>'gid',
				'bookimg'=> array (
						'name' => 'bookimg',
						'type'=>'html',
						'value' => '$data -> _img($data->bookimg);' 
				),
				'createdate',
				'state' => array (
						'name' => 'state',
						'value' => '$data -> _state[$data -> state];' 
				),
				array (
						'template' => '{update}',
						'class' => 'widget.Helper.ButtonColumn',
				)
		) 
) )?>


</div>
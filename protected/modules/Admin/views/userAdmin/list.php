<?php
/* @var $this AdminController */

$this->breadcrumbs = array (
		'Admin' => array (
				'/UserCenter/admin' 
		),
		'List' 
);
?>
<h1>用户管理面板</h1>

<div class="grid_form">
<?php
/* @var $this AdminController */

$this->widget ( 'widget.helper.GridView', array (
		'dataProvider' => $dataProvider,
		
		'columns' => array (
				'id',
				'username',
				'email',
				'state' => array (
						'name'=>'state',
						'value'=>'$data -> _state[$data -> state];' 
				),
				array (
						'class' => 'widget.helper.ButtonColumn',
						//'viewButtonUrl' => 'Yii::app()->controller->createUrl("/news/".$data->primaryKey)' 
				) 
		) 
) )?>


</div>
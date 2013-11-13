<?php
/* @var $this MasterController */

$this->breadcrumbs = array (
		'Master' => array (
				'/Admin/master' 
		),
		'List' 
);
?>

<?php
$this->widget ( 'widget.Helper.SecNav', array (
		'tabs' => array (
				'新增企业导师简介' => $this->createUrl ( '/Admin/content/create', array (
						'c' => '22' 
				) ) 
		) 
) );

?>

<div class="grid_form">
<?php
/* @var $this AdminController */

$this->widget ( 'widget.helper.GridView', array (
		'dataProvider' => $dataProvider,
		'columns' => array (
				'ID',
				'title' => array (
						'name' => 'title',
						'type' => 'html',
						'value' => 'CHtml::link($data->title,$data->Url);' 
				),
				'UID' => array (
						'name' => 'UID',
						'type' => 'text',
						'value' => '$data->username' 
				),
				'category' => array (
						'name' => 'category',
						'value' => '$data -> cateText' 
				),
				'state' => array (
						'name' => 'state',
						'type' => 'text',
						'value' => '$data->stateText' 
				),
				'create_time',
				array (
						'class' => 'widget.helper.ButtonColumn',
						'viewButtonUrl' => 'Yii::app()->controller->createUrl("/news/".$data->primaryKey)' 
				) 
		) 
) )?>


</div>

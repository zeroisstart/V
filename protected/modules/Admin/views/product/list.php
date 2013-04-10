<?php
/* @var $this ProductController */

$this->breadcrumbs=array(
	'Product'=>array('/Admin/product'),
	'List',
);
?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>


<div class="grid_form">
<?php
/* @var $this AdminController */

$this->widget ( 'widget.helper.GridView', array (
		
		'dataProvider' => $dataProvider,
		'columns' => array (
				'ID' ,
				'uid',
				'gid',
				'title',
				#'detail',
				#'text',
				'doc',
				'img',
				'os',
				'hard_driver',
				'ep_num',
				'edit_count',
				'type',
				'create_time', 
				array (
						'header'=>'操作',
						'class' => 'widget.helper.ButtonColumn',
						'viewButtonUrl' => 'Yii::app()->controller->createUrl("/feeds/".$data->primaryKey)' 
				) 
		) 
) )?>


</div>
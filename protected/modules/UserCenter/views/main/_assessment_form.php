<div class="grid_form">
<?php
/* @var $this AdminController */

$columns = array (
		// ID',
		// pid',
		'title' 
// judges',
// technology',
// interface',
// operators',
// integrity',
// creative',
// is_checked',
// 'create_time'
// check_time',
);
// ar_dump($model->is_checked);
// ie;
if ($model->is_checked) {
	$columns = array_merge ( $columns, array (
			'technology',
			'interface',
			'operators',
			'integrity',
			'creative',
			'check_time' 
	) );
} else {
	$columns = array_merge (
			$columns,
			array (
					'create_time' 
			) 
	);
	$columns [] = array (
		'header'=>'打分',
		'template'=>'{update}',
		'class' => 'widget.Helper.ButtonColumn',
		'updateButtonUrl' => 'Yii::app()->controller->createUrl("/UserCenter/main/main/",array("ac"=>"assessment","id"=>$data->primaryKey))' 
	);
}


$this->widget ( 'widget.Helper.GridView', array (
		'dataProvider' => $dataProvider,
		'columns' => $columns 
) )?>
</div>
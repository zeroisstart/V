<div class="sec_nav">
	<a class="blue_Btn" href="<?php echo $this -> createUrl('/news/admin/create')?>">新增新闻</a> 
	
	<a class="blue_Btn" href="<?php echo $this -> createUrl('/category/admin/create',array('t'=>1));?>">新增分类</a>
	
	<a class="blue_Btn" href="<?php echo $this -> createUrl('/category/admin/list',array('t'=>1));?>">新闻分类</a>  
</div>


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

<?php
$tab = array (
		'新增新闻' => $this->createUrl ( '/Admin/content/create' ),
		'关于竞赛' => $this->createUrl ( '/Admin/content/update', array (
				'id' => '49569' 
		) ),
		'参赛办法' => $this->createUrl ( '/Admin/content/update', array (
				'id' => '49568' 
		) ),
		'企业命题' => $this->createUrl ( '/Admin/content/list', array (
				'c' => '21' 
		) ),
		'企业导师简介' => $this->createUrl ( '/Admin/content/list', array (
				'c' => '22' 
		) ) 
);
$req = Yii::app ()->request;

switch ($req->getParam ( 'c' )) {
	case "22" :
		$tab = array (
				'内容列表' => $this->createUrl ( '/Admin/content/list' ),
				'新增企业导师简介' => $this->createUrl ( '/Admin/content/create', array (
						'c' => 22 
				) ) 
		);
		break;
	
	case 21 :
		$tab = array (
				'内容列表' => $this->createUrl ( '/Admin/content/list' ),
				'新增企业命题' => $this->createUrl ( '/Admin/content/create', array (
						'c' => 21
				) ) 
		);
		break;
	default :
		break;
}

$this->widget ( 'widget.Helper.SecNav', array (
		'tabs' => $tab 
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
						'value' => '$data->getUserName()' 
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
						'viewButtonUrl' => 'Yii::app()->controller->createUrl("/feeds/".$data->primaryKey)' 
				) 
		) 
) )?>


</div>

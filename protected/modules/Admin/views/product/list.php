<?php
/* @var $this ProductController */

$this->breadcrumbs = array (
		'Product' => array (
				'/Admin/product' 
		),
		'List' 
);


$_assetsUrl=Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('gii.assets'));

$cs=Yii::app()->clientScript;
$cs->coreScriptPosition=CClientScript::POS_HEAD;
$cs->scriptMap=array();
$baseUrl=$_assetsUrl;
$cs->registerCoreScript('jquery');
$cs->registerScriptFile($baseUrl.'/js/jquery.tooltip-1.2.6.min.js');
$cs->registerScriptFile($baseUrl.'/js/fancybox/jquery.fancybox-1.3.1.pack.js');
$cs->registerCssFile($baseUrl.'/js/fancybox/jquery.fancybox-1.3.1.css');
$cs-> registerScriptFile(Yii::app() -> baseUrl.'/js/gearman.js',CClientScript::POS_END);
?>

<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>


<div class="grid_form">
<?php
/* @var $this AdminController */

$this->widget ( 'widget.helper.GridView', array (
		
		'dataProvider' => $dataProvider,
		'columns' => array (
				// ID' ,
				// uid',
				'gid',
				'title',
				'groupMame' => array (
						'name' => '用户组名称',
						'value' => '$data->getGroupName()' 
				),
				// detail',
				// text',
				// doc',
				// img',
				'os',
				'hard_driver',
				// ep_num',
				'edit_count',
				'type' => array (
						'name' => 'type',
						'value'=>'$data->getTypeOfPro()' 
				),
				'create_time',
				array (
						'template'=>'{update}',
						'header' => '操作',
						'class' => 'widget.helper.ButtonColumn',
						'viewButtonUrl' => 'Yii::app()->controller->createUrl("/feeds/".$data->primaryKey)' 
				) 
		) 
) )?>


</div>
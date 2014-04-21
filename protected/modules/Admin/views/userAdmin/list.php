<?php
/* @var $this AdminController */

$this->breadcrumbs = array (
		'Admin' => array (
				'/UserCenter/admin' 
		),
		'List' 
);
?>
<?php 
$req = Yii::app() -> request;
if($req -> getParam('t') ==2){
?>
<h1>评委管理面板</h1>
<?php 	
}else{
?>
<h1>用户管理面板</h1>	
<?php 

}?>


<?php
$this->widget ( 'widget.Helper.SecNav', array (
		'tabs' => array (
				'评委管理' => $this->createUrl ( '/Admin/UserAdmin/list', array (
						't' => 2 
				) ),
				'地区管理员管理' => $this->createUrl ( '/Admin/UserAdmin/list', array (
						't' => 9
				) ),
				'新增评委' => $this->createUrl ( '/Admin/UserAdmin/create', array (
						'ac' => 'create',
						't' => 2 
				) ) ,
				'新增地区管理员' => $this->createUrl ( '/Admin/UserAdmin/createadmin', array (
						'ac' => 'createadmin',
						't' => 9
				) ) ,
				/*'新增区域' => $this->createUrl ( '/Admin/UserAdmin/CreateArea', array (
						'ac' => 'create',
						't' => 2 
				) )*/ 
		) 
) )?>


<div class="grid_form">
<?php
$form = $this->beginWidget ( 'CActiveForm', array (
		'id' => 'user-admin-form',
		'htmlOptions' => array (
				//'method' => 'post',
		),
		'enableAjaxValidation' => false
) );
?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('class'=>'w_600')); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>
	
	<div class="row">
		<?php echo CHtml::submitButton('查询');?>
	</div>
<?php $this->endWidget(); ?>


<?php 
/* @var $this AdminController */
$this->widget ( 'widget.Helper.GridView', array (
		'dataProvider' => $dataProvider,
		'columns' => array (
				'id',
				'username',
				'userProfile.Realname',
				'userProfile.schoolName',
				//'email',
				/*'state' => array (
						'name' => 'state',
						'value' => '$data -> _state[$data -> state];' 
				),*/
				array (
						'template' => '{update}{delete}',
						'class' => 'widget.Helper.ButtonColumn' 
				) 
		) 
) )?>


</div>
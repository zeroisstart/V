<?php
/* @var $this GroupController */

$this->breadcrumbs = array (
		'Group' => array (
				'/Admin/group' 
		),
		'View' 
);
?>
<h1>参赛队伍成员预览</h1>
<?php
$this->widget ( 'widget.Helper.SecNav', array (
		'tabs' => array (
				'参赛组列表' => $this->createUrl ( '/Admin/group/list' ) 
		) 
) )?>

<div class="group_info">
	<p><span>队长</span> : <?php echo $leader->username ;?></p>
	<?php 
	$reg_model =new RegisterForm();
	$type = $reg_model -> getUser_type();
	
	?>
	<?php if(0):?>
	<p><span>身份</span> : <?php echo  isset($type[$leader ->userProfile->User_category ])?$type[$leader ->userProfile->User_category ]:'';?></p>
	<p><span>队作品</span> : asfasdf</p>
	<p><span>评委老师</span> : 沈宏明</p>
	<p><span>得分</span>: A,B,C,D,E</p>
	<p><span>联系电话</span>:<?php echo $leader->userProfile->Mobile?></p>
	<p><span>邮箱</span> :<a href="mailto:<?php echo $leader-> userProfile->Email ?>"> <?php echo $leader-> userProfile->Email?></a></p>
	<?php endif;?>
</div>

<div class="grid_form">
<?php
/* @var $this AdminController */

$this->widget ( 'widget.Helper.GridView', array (
		'dataProvider' => $dataProvider,
		'columns' => array (
				'gid',
				'UID',
				'username',
				'create_time',
				/*'state' => array (
						'name' => 'state',
						'value' => '$data -> _state[$data -> state];' 
				),*/
				array (
						'header' => "操作",
						'template' => '{delete}',
						'class' => 'widget.Helper.ButtonColumn' 
				) 
		) 
) )?>


</div>
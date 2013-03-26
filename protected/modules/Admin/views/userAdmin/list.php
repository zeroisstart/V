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

<?php
$this->widget ( 'widget.Helper.SecNav', array (
		'tabs' => array (
				'导师管理' => '/Admin/UserAdmin/list?t=2' 
		) 
) )?>

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
						'name' => 'state',
						'value' => '$data -> _state[$data -> state];' 
				),
				array (
						'template' => '{update}',
						'class' => 'widget.helper.ButtonColumn' 
				)
				 
		) 
) )?>


</div>
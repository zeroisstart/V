<?php
/* @var $this GroupController */

$this->breadcrumbs = array (
		'Group' => array (
				'/Admin/group' 
		),
		'List' 
);
?>

<a href="javascript:void(0);" onclick="window.history.go(-1)">返回</a>

<h1>报名内容查询</h1>

<div class="grid_form">
<?php
/* @var $this AdminController */

#var_dump($dataProvider -> data);
#die;
?>

<div class="row">
	<img src="/img/<?php echo $model -> bookimg;?>" class="b_bookimg" />
</div>


<div class="row">
	<div class="div_btn">
		<?php if(!$model -> state):?>
		<a href="<?php echo $this -> createUrl('/Admin/groupbook/update',array('id'=>$model -> id,'state'=>1))?>" class="green_btn">通过</a>
		<?php else:?>
		<a href="#" class="green_btn">已通过</a>
		<?php endif;?>
	</div>
</div>


</div>
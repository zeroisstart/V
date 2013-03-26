<?php
/* @var $this AdminController */

$this->breadcrumbs = array (
		'Admin' => array (
				'/UserCenter/admin' 
		),
		'Update' 
);
?>
<h1><?php echo $this -> title;?></h1>


<div class="content">
	<div>
		<span>密码统一重置为123456</span>
		<form method="POST">
			<span>
			用户名:<?php echo $model -> username;?>
			</span> <span>
				<input type="hidden" name="id" value="<?php echo $model->id?>" />
				<input type="submit" value="密码重置" />
			</span>
		</form>
	</div>
</div>
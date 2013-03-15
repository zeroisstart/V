<div class="sec_nav">
<?php
$args = array ();
if ($id) {
	$args = array (
			't' => $id 
	);
}
$url = $this->createUrl ( '/category/admin/create', $args );
?>
<a class="blue_Btn" href="<?php echo $url?>">新增分类</a>
</div>
<div class="grid_form">
<?php
$this->widget ( 'widget.helper.GridView', array (
		'dataProvider' => $dataProvider,
		'columns' => array (
				'ID',
				'title',
				'type' => array (
						'name' => 'type',
						'value' => '$data -> typeText;' 
				),
				array (
						'template' => '{update} {delete}',
						'class' => 'widget.helper.ButtonColumn' 
				) 
		) 
) )?>

</div>

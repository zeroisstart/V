<?php
/* @var $this ProductController */

$this->breadcrumbs = array (
		'Product' => array (
				'/Admin/product' 
		),
		'Update' 
);
?>

<div class="grid_mini_form">
<?php
/* @var $this AdminController */

$access_path = Yii::app() -> params-> imgAccessPath;
$this->widget ( 'widget.helper.GridView', array (
		'dataProvider' => $dataProvider,
		'columns' => array (
				'ID',
				'Realname',
				'Company_name',
				array (
						'template' => '{yes}',
						'header' => '操作',
						'buttons' => array (
								'yes' => array (
										'label' => '作为评委',
										'url' => 'Yii::app() -> createUrl("/Admin/product/selectJudges",array("id"=>$data->ID,"pid"=>'.$product->ID.'))',
										'imageUrl' => $access_path.'/images/yes.png',
										'click' => 'js:function(){
													if(!confirm("让他作为评委?")) return false;
														var _url = $(this).attr("href");
														var _opt = {};
														_opt.url=_url;
														_opt.type="post";
														_opt.async=false;
														_opt.success=function(res){
															res = eval("("+res+")");
															console.log(res);
														}
														$.ajax(_opt);
														return false;
												}',
								),
						),
						'class' => 'widget.helper.ButtonColumn',
				) 
		) 
) )?>


</div>
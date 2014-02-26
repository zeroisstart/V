<?php
/* @var $this ProductController */

$this->breadcrumbs = array (
		'Product' => array (
				'/Admin/product' 
		),
		'Update' 
);
?>

<?php 
	$this -> widget('ext.popup.popup');
?>

<div class="grid_mini_form">
<?php
/* @var $this AdminController */

$access_path = Yii::app() -> params-> imgAccessPath;
$this->widget ( 'widget.Helper.GridView', array (
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
															if(res.status==0){
																hm.alert({
																	noTitle : true,
																	text : res.msg, 
																	height : "auto", 
																	width : 220,
																	confirm:"确定"
																});
																window.location.reload();
															}
														}
														$.ajax(_opt);
														return false;
												}',
								),
						),
						'class' => 'widget.Helper.ButtonColumn',
				) 
		) 
) )?>


</div>
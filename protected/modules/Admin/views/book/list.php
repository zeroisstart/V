<?php
/* @var $this BookController */

$this->breadcrumbs = array (
		'Book' => array (
				'/Admin/book' 
		),
		'List' 
);
?>


<div class="grid_form">

<?php
$access_path = Yii::app ()->params->imgAccessPath;
$this->widget ( 'widget.helper.GridView', array (
		'dataProvider' => $dataProvider,
		'columns' => array (
				'ID',
				'UID',
				'UID' => array (
						'name' => 'UID',
						'type' => 'text',
						'value' => '$data->username' 
				),
				'img' => array (
						'name' => 'img',
						'type' => "html",
						'value' => '$data->getImageUrl()' 
				),
				/*'state' => array (
						'name' => 'state',
						'type' => 'text',
						'value' => '$data->stateText' 
				),*/
				array (
						'header' => '操作',
						'template' => '{yes} {no}',
						'buttons' => array (
								'yes' => array (
										'label' => '申请加入',
										'url' => 'Yii::app() -> createUrl("/UserCenter/main/main",array("ac"=>"acceptTeam","id"=>$data->ID))',
										'imageUrl' => $access_path . '/images/yes.png',
										'click' => 'js:function(){
												if(!confirm("确定加入?")) return false;
												var _url = $(this).attr("href");
												var _opt = {};
												_opt.url=_url;
												_opt.type="post";
												_opt.async=false;
												_opt.success=function(res){
													res = eval("("+res+")");
													console.log(res);
													if(res.status){
															hm.alert({
															noTitle : true,
															text : "请耐心等待!",
															height : "auto",
															width : 210,
														})
													}else{
														switch(res.code){
															case "2":
															hm.alert({
																noTitle : true,
																text : "小队不存在!",
																height : "auto",
																width : 210,
															})
																break;
															case "3":
															hm.alert({
																noTitle : true,
																text : "您有在申请哦!",
																height : "auto",
																width : 210,
															})
																break;
															default:
																break;
														}
													}
												}
												$.ajax(_opt);
												return false;
										}' 
								),
								'no' => array (
										'label' => '忽略',
										'url' => 'Yii::app() -> createUrl("/UserCenter/main/main",array("ac"=>"acceptTeam","id"=>$data->ID))',
										'imageUrl' => $access_path . '/images/no.png',
										'click' => 'js:function(){
													if(!confirm("确定忽略?")) return false;
													var _url = $(this).attr("href");
													var _opt = {};
													_opt.url=_url;
													_opt.type="post";
													_opt.async=false;
													_opt.success=function(res){
														res = eval("("+res+")");
														console.log(res);
														if(res.status){
																hm.alert({
																noTitle : true, 
																text : "请耐心等待!", 
																height : "auto",
																width : 210,
															})
														}else{
															switch(res.code){
																case "2":
																hm.alert({
																	noTitle : true, 
																	text : "小队不存在!", 
																	height : "auto",
																	width : 210,
																})
																	break;
																case "3":
																hm.alert({
																	noTitle : true, 
																	text : "您有在申请哦!", 
																	height : "auto",
																	width : 210,
																})
																	break;
																default:
																	break;
															}
														}
													}
													$.ajax(_opt);
													return false;
											}' 
								) 
						),
						'class' => 'widget.helper.ButtonColumn',
				) 
		) 
) )?>

</div>

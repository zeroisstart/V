<?php
/* @var $this BookController */

$this->breadcrumbs = array (
		'Book' => array (
				'/Admin/book' 
		),
		'List' 
);
?>

<?php
$this->widget ( 'widget.Helper.SecNav', array (
		'tabs' => array (
				'已审核用户' => $this->createUrl ( '/Admin/book/list', array (
						'state' => 1 
				) ),
				'未审核用户' => $this->createUrl ( '/Admin/book/list', array (
						'state' => 0 
				) ) 
		) 
) );
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
						'visible' => $state == 1 ? false : true,
						'template' => '{yes} {no}',
						'buttons' => array (
								'yes' => array (
										'label' => '申请加入',
										'url' => 'Yii::app() -> createUrl("/Admin/book/Accept",array("id"=>$data->UID))',
										'imageUrl' => $access_path . '/images/yes.png',
										'click' => 'js:function(){
												if(!confirm("确定同意?")) return false;else 
										return true;
												var _url = $(this).attr("href");
												var _opt = {};
												_opt.url=_url;
												_opt.type="post";
												_opt.async=false;
												_opt.success=function(res){
													res = eval("("+res+")");
												}
												$.ajax(_opt);
												return false;
										}' 
								),
								'no' => array (
										'label' => '忽略',
										'url' => 'Yii::app() -> createUrl("/Admin/book/Refused",array("id"=>$data->ID))',
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
													}
													$.ajax(_opt);
													return false;
											}' 
								) 
						),
						'class' => 'widget.helper.ButtonColumn' 
				) 
		) 
) )?>

</div>

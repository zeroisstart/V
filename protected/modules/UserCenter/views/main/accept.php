<?php
$this->widget ( 'ext.popup.popup' );
?>
<div id="contextAdorn"></div>
<div id="contextBox">
	<div id="rightContent" class="user_profile_info">
		<p class="user_notice">您好 <?php echo Yii::app() -> user->username;?></p>
		
		
		<p>注意: 每个队伍只允许有四个队员，一个老师三个学生.</p>

		<div class="user_data_info">
		<?php
		$form = $this->beginWidget ( 'CActiveForm', 
					array (
						'id' => 'teacher',
						'action'=>$this->createUrl("/UserCenter/team/teacher"), 
						'enableClientValidation' => true,
						'enableAjaxValidation'=>true,
						'clientOptions' => array ('validateOnSubmit' => true ) ) );
		?>
		<div class="row">
		<?php echo $form->labelEx($model,'MasterName'); ?>
		 <?php
          $this->widget('zii.widgets.jui.CJuiAutoComplete',array(
 			'model'=>$model,
 			'attribute' => 'MasterName',
            'sourceUrl' => $this->createUrl('/UserCenter/team/get_user',array('ac'=>'1')),
 			//'source'=>array('ac1','ac2','ac3'),
          	//'source'=>'js:function(){alert(/test/)}',
 			// additional javascript options for the autocomplete plugin
          	'options'=>array(
 					'minLength'=>'1',
 											),
 											'htmlOptions'=>array(
 											'class'=>'reg_input',
											'style'=>'height:20px;'
 											),
 										));
                                        ?>
		<?php echo $form->error($model,'MasterName'); ?>
	</div>
	<div class="row">
		<?php
			echo  CHtml::ajaxSubmitButton(
			        '添加',
					$this->createUrl("/UserCenter/team/teacher"),
			        array(
			            'beforeSend'=>'function(){
			           
			            }',
			            'success'=>'function(data,txt){
							data = eval("("+data+")");
 							$.each(data, function(key, val) {
							//console.log("#teacher #UserGroup_"+key+"_em_");
							$("#teacher #UserGroup_"+key+"_em_").text(val);
			                $("#teacher #UserGroup_"+key+"_em_").show();})
						
							if(0){hm.alert({
				                "text": "提交成功",
				                "width": 200
				            },function(){
                                location.href = "' . $this->createUrl('/Home/manage/index') . '";
                            });}
			            }',
			        ),array('class'=>'button','id'=>'teacher_btn')
			    );
			?>
	</div>
	<?php $this->endWidget(); ?>
	
	
		<?php
		$form = $this->beginWidget ( 'CActiveForm', array (
				'id' => 'member',
				'action'=>$this->createUrl("/UserCenter/team/get_user",array('ac'=>2)), 
				'enableClientValidation' => true, 
				'clientOptions' => array ('validateOnSubmit' => true ) ) );
		?>
		<div class="row">
		<?php echo $form->labelEx($model,'MemberName'); ?>
		<?php
          $this->widget('zii.widgets.jui.CJuiAutoComplete',array(
 			'model'=>$model,
 			'attribute' => 'MemberName',
            'sourceUrl' => $this->createUrl('/UserCenter/team/get_user'),
          	
 			//'source'=>array('ac1','ac2','ac3'),
          	//'source'=>'js:function(){alert(/test/)}',
 			// additional javascript options for the autocomplete plugin
          	'options'=>array(
					//'select' => 'js:function(){alert(/test/)}',
 					'minLength'=>'1',
 											),
 											'htmlOptions'=>array(
 											'class'=>'reg_input',
											'style'=>'height:20px;'
 											),
 										));
                                        ?>
		<?php echo $form->error($model,'MemberName'); ?>
	</div>
	<div class="row">
		<?php  echo CHtml::submitButton('添加'); ?>
	</div>
	<?php $this->endWidget(); ?>
	
		
			<div class="grid_form">
				<?php
				/* @var $this AdminController */
				$access_path = Yii::app ()->params->imgAccessPath;
				$this->widget ( 'widget.Helper.GridView', array (
						'dataProvider' => $dataProvider,
						'columns' => array (
								'UID',
								'username',
								'Identity'
								/*
								array (
										'header' => '操作',
										'template' => '{yes} {no}',
										'buttons' => array (
												'yes' => array (
														'label' => '申请加入',
														'url' => 'Yii::app() -> createUrl("/UserCenter/main/main",array("ac"=>"acceptTeam","userid"=>$data->UID,"teamid"=>$data->gid))',
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
																	if(res.status==1){
																			hm.alert({
																			noTitle : true, 
																			text : "加入成功!", 
																			height : "auto",
																			width : 210,
																		},function(){window.location.reload();})
																		
																	}else{
																		switch(res.code){
																			case "2":
																			hm.alert({
																				noTitle : true, 
																				text : "小队不存在!", 
																				height : "auto",
																				width : 210,
																			},function(){window.location.reload();})
																				break;
																			case "3":
																			hm.alert({
																				noTitle : true, 
																				text : "您有在申请哦!", 
																				height : "auto",
																				width : 210,
																			},function(){window.location.reload();})
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
														'url' => 'Yii::app() -> createUrl("/UserCenter/main/main",array("ac"=>"rejectTeam","userid"=>$data->UID,"teamid"=>$data->gid))',
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
																			text : "忽略成功!", 
																			height : "auto",
																			width : 210,
																		},function(){window.location.reload();})
																	}else{
																		switch(res.code){
																			case "2":
																			hm.alert({
																				noTitle : true, 
																				text : "小队不存在!", 
																				height : "auto",
																				width : 210,
																			},function(){window.location.reload();})
																				break;
																			case "3":
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
										'class' => 'widget.Helper.ButtonColumn',
										'viewButtonUrl' => 'Yii::app()->controller->createUrl("/feeds/".$data->primaryKey)' 
								) */
						) 
				) )?>
				</div>

		</div>
	</div>
	<div id="leftColumns">
		<?php $this -> widget('widget.Helper.UserSecNav');?>
    </div>
</div>
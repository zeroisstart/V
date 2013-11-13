<?php 
$this->widget ( 'ext.popup.popup' );
?>
<div id="contextAdorn"></div>
<div id="contextBox">
	<div id="rightContent" class="user_profile_info">
		<p class="user_notice">您好 <?php echo Yii::app() -> user->username;?></p>
		
		<div class="user_data_info">
			
				<div class="grid_form">
				<?php
				/* @var $this AdminController */
				$access_path = Yii::app() -> params-> imgAccessPath;
				$this->widget ( 'widget.helper.GridView', array (
						'dataProvider' => $dataProvider,
						'columns' => array (
								'ID',
								'username',
								'name',
								array (
										'template'=>'{add}',
										'buttons' => array (
												'add' => array (
														'label' => '申请加入',
														'url' => 'Yii::app() -> createUrl("/UserCenter/main/main",array("ac"=>"join","id"=>$data->ID))',
														'imageUrl' => $access_path.'/images/add.png',
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
																				text : "您有在申请哦!请耐心等待。", 
																				height : "auto",
																				width : 250,
																			})
																				break;
																			default:
																				break;
																		}
																	}
																}
																$.ajax(_opt);
																return false;
														}',
												)
										),
										'class' => 'widget.helper.ButtonColumn',
										'viewButtonUrl' => 'Yii::app()->controller->createUrl("/feeds/".$data->primaryKey)' 
								) 
						) 
				) )?>
				</div>
		
		</div>
	</div>
	<div id="leftColumns">
		<?php $this -> widget('widget.Helper.UserSecNav');?>
    </div>
</div>
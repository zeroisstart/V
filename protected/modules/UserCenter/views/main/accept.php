<?php
$this->widget ( 'ext.popup.popup' );
?>
<div id="contextAdorn"></div>
<div id="contextBox">
	<div id="rightContent" class="user_profile_info">
		<p class="user_notice">您好 <?php echo Yii::app() -> user->username;?></p>
		
		
		<p class="member_list_waring">注意: 每个队伍只允许有四个队员，一个老师三个学生.</p>

		<div class="user_data_info">
		<?php
		$form = $this->beginWidget ( 'CActiveForm', 
					array (
						'id' => 'teacher',
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
			        		if(data.status == 0){
								hm.alert({
				                	"text": "添加成功!",
				                	"width": 250
				            	},function(){
									window.location.reload();
								})
							}else{
								hm.alert({
				                	"text": data.msg,
				                	"width": 250
				            	})
							}	
			            }',
			        ),array('class'=>'button','id'=>'teacher_btn')
			    );
			?>
	</div>
	<?php $this->endWidget(); ?>
	
	
<?php
		$form = $this->beginWidget ( 'CActiveForm', array (
				'id' => 'member',
				'enableClientValidation' => true, 
				'clientOptions' => array ('validateOnSubmit' => true ) ) );
		?>
		<div class="row">
		<?php echo $form->labelEx($model,'MemberName'); ?>
		<?php
          $this->widget('zii.widgets.jui.CJuiAutoComplete',array(
 			'model'=>$model,
 			'attribute' => 'MemberName',
            'sourceUrl' => $this->createUrl('/UserCenter/team/get_user',array('ac'=>2)),
          	
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
		<?php
			echo  CHtml::ajaxSubmitButton(
			        '添加',
					$this->createUrl("/UserCenter/team/member"),
			        array(
			            'beforeSend'=>'function(){
			           
			            }',
			            'success'=>'function(data,txt){
							data = eval("("+data+")");
			        		if(data.status == 0){
								hm.alert({
				                	"text": "添加成功!",
				                	"width": 250
				            	},function(){
									window.location.reload();
								})
							}else{
								hm.alert({
				                	"text": data.msg,
				                	"width": 250
				            	})
							}	
			            }',
			        ),array('class'=>'button','id'=>'member_btn')
			    );
			?>
	</div>
	<?php $this->endWidget(); ?>
	
			<div class="grid_form member_list">
				<p>队伍 : <?php echo $model -> name;?></p>
				<?php
				/* @var $this AdminController */
				//$access_path = Yii::app ()->params->imgAccessPath;
				$this->widget ( 'widget.Helper.GridView', array (
						'dataProvider' => $dataProvider,
						'columns' => array (
								'UID',
								'username',
								'Identity',
								'GroupIdentity',
						) 
				) )?>
				</div>

		</div>
	</div>
	<div id="leftColumns">
		<?php $this -> widget('widget.Helper.UserSecNav');?>
    </div>
</div>
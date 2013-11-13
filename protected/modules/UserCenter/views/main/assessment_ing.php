<?php 
	
	$cs = Yii::app() -> clientScript;
	$cs -> registerCoreScript('jquery');
	$cs -> registerScriptFile(Yii::app() -> baseUrl.'/js/score.js');
	$this -> widget('ext.popup.popup');	
?>

<div id="contextAdorn"></div>
<div id="contextBox">
	<div id="rightContent" class="user_profile_info">
		<p class="user_notice">您好 <?php echo Yii::app() -> user->username;?></p>
		
		<?php 
			$teamMember = $model->product->getTeamMembers();
			$ary_name = array();
			foreach ($teamMember as $_model){
				$ary_name[] = $_model -> username;
			}
		?>
		
		<div class="product_info">
			<p><span>队名</span>：<?php echo $model->product->getTeamName(); ?></p>
			<p><span>队长</span>：<?php echo $model->product->getTeamLeader(); ?></p>
			<p><span>队员</span>：<?php echo implode(',', $ary_name) ?></p>
			<p><span>作品名</span>：<?php echo $model->product->title; ?></p>
			<p><span>介绍</span>：<?php echo $model->product->detail;?></p>
			<p><span>内容</span>：<?php echo $model->product->text;?></p>
			<p><span>操作系统</span>：<?php echo $model->product->os;?></p>
			<p><span>硬件</span>：<?php echo $model->product->hard_driver?></p>
			<p><span>修改次数</span>：<?php echo $model->product->edit_count?></p>
			<p><span>提交时间</span>：<?php echo $model->product->create_time;?>
			<p><span>作品图片</span>:<?php echo CHtml::image($model->product->img)?></p>
			<p><span>作品文档下载</span>:<?php echo CHtml::link($model->product->title,$model->product->doc)?></p>
			<p></p>
		</div>
		
		<?php

		$form = $this->beginWidget ( 'CActiveForm', array (
				'id' => 'score-form',
				'htmlOptions' => array (
						'method' => 'post',
						'enctype' => "multipart/form-data" 
				),
				'enableClientValidation'=>true,
				'enableAjaxValidation' => false 
		) );
		?>
		<?php foreach ($model ->ary_grade as $key ):?>
		<div class="grade_ing">
			<?php echo $form->labelEx($model,$key,array('class'=>'radioTitle')); ?>
			 ：
			<?php 
			$str=$form->radioButtonList($model,$key,array(1=>'A','B','C','D'));
			$str = str_replace('<br/>', '', $str); 
			echo $str;
			?>
			<?php echo $form->error($model,$key); ?>
		</div>
		<?php endforeach;?>
		
		
		<button type="submit" class="blue_btn flt_rig" style="color:#ffffff">确认</button>	
		
<?php $this->endWidget(); ?>
		
	</div>
	<div id="leftColumns">
		<?php $this -> widget('widget.Helper.UserSecNav');?>
    </div>
</div>
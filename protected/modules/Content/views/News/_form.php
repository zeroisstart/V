<?php
/* @var $this NewsController */
/* @var $model News */
/* @var $form CActiveForm */
?>

<?php if(Yii::app()->user->hasFlash('success')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('success'); ?>
</div>

<?php endif;?>


<script id="editor" type="text/plain">这里可以书写，编辑器的初始内容</script>

<div class="form">
<?php

$cate = $model->getAllCate ();

$cate['0'] = '其他';

$_form = array ();

if ($model->isNewRecord) {
	$_form ['title'] = '新增新闻';
	$_form ['submit'] = '保存';
} else {
	$_form ['title'] = '编辑新闻';
	$_form ['submit'] = '编辑';
}
$_form ['content'] = $model -> text;
$_form ['imgUploadUrl'] = $this->createUrl ( '/Content/news/imgUpload' );
 
$_form ['fileUpload'] = $this->createUrl ( '/Content/news/fileUpload' );
$_form ['accessPath'] = Yii::app ()->params ['imgPath'];
$_form ['fileAccessUrl'] = Yii::app ()->params ['fileAccessPath'];

?>

<span>
	<?php echo $_form['title']?>
</span>
<?php

$form = $this->beginWidget ( 'CActiveForm', array (
		'id' => 'news-_from-form',
		'enableAjaxValidation' => false 
) );
?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('class'=>'w_600')); ?>
		<?php echo $form->error($model,'title'); ?>
		
		<span class="m_l_155">新闻分类:
			<?php echo $form -> dropDownList($model, 'category', $cate,array('class'=>'w_200'))?>
		</span>
	</div>

	<div class="row">

		<!-- editor begin -->

		<div id="content_editor"></div>

		<!-- editor end -->
	</div>
	
		<?php
		
		$this->widget ( 'ext.ueditor.Ueditor', array (
				'getId' => 'content_editor',
				'UEDITOR_HOME_URL' => "/",
				'options' => 'filePath:"'.$_form['fileAccessUrl'].'",fileUrl:"'.$_form['fileUpload'].'",imageUrl:"' .$_form ['imgUploadUrl'] . '",toolbars:[["fullscreen","source","undo","redo","insertunorderedlist","insertorderedlist","unlink","cleardoc","selectall","searchreplace","preview","help","separate","gmap","pagebreak","insertimage","scrawl","music","snapscreen","emotion","insertvideo","insertframe","attachment","date","time","wordimage","map","webapp","horizontal","anchor","spechars","blockquote","highlightcode","template","background","imagecenter","imageright","imageleft","imagenone","fontsize","fontfamily","rowspacingtop","lineheight","rowspacingbottom","paragraph","bold","italic","underline","strikethrough","forecolor","backcolor","superscript","subscript","justifycenter","justifyleft","justifyright","justifyjustify","touppercase","tolowercase","directionalityrtl","indent","directionalityltr","removeformat","formatmatch","customstyle","pasteplain","autotypeset","inserttable","deletetable","mergeright","mergedown","splittorows","splittocols","splittocells","mergecells","insertrow","insertcol","deleterow","deletecol","insertparagraphbeforetable"],[]],wordCount:false,elementPathEnabled:false,imagePath:"' . $_form ['accessPath'] . '",initialFrameWidth:"auto",initialContent:"'.$_form['content'].'"' 
		) );
		
		?>
		<?php //echo $form->labelEx($model,'text'); ?>
		<?php //echo $form->textField($model,'text'); ?>
		<?php //echo $form->error($model,'text'); ?>
		
		
		<div class="row buttons">
			<?php echo CHtml::submitButton('submit',array('value'=>$_form['submit'],'class'=>'sub_btn')); ?>
		</div>
</div>

<?php $this->endWidget(); ?>


<!-- form -->
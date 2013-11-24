<?php
    if(isset($forum)) $this->widget('zii.widgets.CBreadcrumbs', array(
        'links'=>array_merge(
            $forum->getBreadcrumbs(true),
            array('New thread')
        ),
    ));
    else $this->widget('zii.widgets.CBreadcrumbs', array(
        'links'=>array_merge(
            $thread->getBreadcrumbs(true),
            array('回复')
        ),
    ));
?>

<div class="form" style="margin:20px;">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'post-form',
        'enableClientValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
	),
    )); ?>

    <?php if(isset($forum)): ?>
        <div class="row">
            <?php echo $form->labelEx($model,'subject'); ?>
            <?php echo $form->textField($model,'subject'); ?>
            <?php echo $form->error($model,'subject'); ?>
        </div>
    <?php endif; ?>

        <div class="row">
            <?php echo $form->labelEx($model,'content'); ?>
            <div id="content_editor"></div>
            <?php if(0):?>
            	<?php echo $form->textArea($model,'content', array('rows'=>10, 'cols'=>70)); ?>
            <?php endif;?>
            <?php echo $form->error($model,'content'); ?>
            <p class="hint">
                
            </p>
        </div>

        <?php if(Yii::app()->user->isAdmin): ?>
            <div class="row rememberMe">
                <?php echo $form->checkBox($model,'lockthread', array('uncheckValue'=>0)); ?>
                <?php echo $form->labelEx($model,'lockthread'); ?>
                <?php // echo $form->error($model,'lockthread'); ?>
            </div>
        <?php endif; ?>
        <?php
		
        $cate = array();// $model->getAllCate ();
        
        $cate['0'] = '其他';
        
        $_form = array ();

        $_form ['content'] = $model -> content;
        $_form ['uploadUrl'] = $this->createUrl ( '/Admin/Content/upload' );
        
        $_form ['fileUpload'] = $this->createUrl ( '/Admin/Content/fileUpload' );
        $_form ['accessPath'] = Yii::app ()->params ['imgAccessPath'];
        $_form ['fileAccessUrl'] = Yii::app ()->params ['fileAccessPath'];
        
		$this->widget ( 'ext.ueditor.Ueditor', array (
				'getId' => 'content_editor',
				'UEDITOR_HOME_URL' => "/",
				'options' => 'filePath:"'.$_form['fileAccessUrl'].'",fileUrl:"'.$_form['fileUpload'].'",imageUrl:"' .$_form ['uploadUrl'] . '",toolbars:[["fullscreen","source","undo","redo","insertunorderedlist","insertorderedlist","unlink","cleardoc","selectall","searchreplace","preview","help","separate","gmap","pagebreak","insertimage","scrawl","music","snapscreen","emotion","insertvideo","insertframe","attachment","date","time","wordimage","map","webapp","horizontal","anchor","spechars","blockquote","highlightcode","template","background","imagecenter","imageright","imageleft","imagenone","fontsize","fontfamily","rowspacingtop","lineheight","rowspacingbottom","paragraph","bold","italic","underline","strikethrough","forecolor","backcolor","superscript","subscript","justifycenter","justifyleft","justifyright","justifyjustify","touppercase","tolowercase","directionalityrtl","indent","directionalityltr","removeformat","formatmatch","customstyle","pasteplain","autotypeset","inserttable","deletetable","mergeright","mergedown","splittorows","splittocols","splittocells","mergecells","insertrow","insertcol","deleterow","deletecol","insertparagraphbeforetable"],[]],wordCount:false,elementPathEnabled:false,imagePath:"' . $_form ['accessPath'] . '",initialFrameWidth:"auto",initialContent:"'.addslashes($_form['content']).'"' 
		) );
		?>
        
        

        <div class="row buttons">
            <?php echo CHtml::submitButton('回复'); ?>
        </div>
    <?php $this->endWidget(); ?>
</div><!-- form -->

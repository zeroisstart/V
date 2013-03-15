<?php
/* @var $this MainController */

$this->breadcrumbs = array (
		'Main' 
);
?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<p>
	You may change the content of this page by modifying the file
	<tt><?php echo __FILE__; ?></tt>
	.
</p>

<?php
$this->widget ( 'ext.popup.popup' );

$form = $this->beginWidget ( 'CActiveForm', array (
		'id' => 'contact-form',
		// 'action' => $this->createUrl ( '/System/upload/ImgUpload' ),
		'action' => $this->createUrl ( '/System/upload/AttachmentUpload' ),
		'enableClientValidation' => true,
		'method' => 'post',
		'htmlOptions' => array (
				'enctype' => "multipart/form-data" 
		),
		'clientOptions' => array (
				'validateOnSubmit' => true 
		) 
) );

?>
<button>this is test</button>
<?php
/*
 * $model = new ImgUploadForm (); $this->widget ( 'widget.system.uploadForm',
 * array ( 'fieldName'=>'ImgUploadForm[img]', 'model' => $model ) );
 */
/*
$model = new ImgUploadForm ();
$this->widget ( 'widget.system.uploadForm', array (
		'fieldName'=>'AttachmentUploadForm[attachment]',
		'model' => $model
) );*/

?>

<?php echo CHtml::submitButton('submit');?>

<?php $this -> endWidget()?>

<script type="text/javascript">
	/*$(document).ready(function(){
		hm.confirm({
				noTitle : true, 
				text : '这里面是提示', 
				height : 'auto',
				width : 210,
				confirm:'确定',
				cancel:'取消'
			},function(){
				alert('ok');
			},function(){
				alert('cancel');
				});
	})*/
</script>
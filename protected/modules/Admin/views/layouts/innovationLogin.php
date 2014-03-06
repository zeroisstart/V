<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<title>后台登录</title>

<?php
$css = array (
		'skin/admin.css',
		'css/form.css' 
);

$js= array();

$baseUrl = Yii::app ()->getAssetManager ()->publish ( Yii::getPathOfAlias ( 'application.assets.admin' ), false, - 1, YII_DEBUG );
$this->widget ( 'widget.ClientScript.autoRegisterFile', array (
		'jquery' => true,
		'css' => $css,
		'js' => $js,
		'baseUrl' => $baseUrl 
) );
?>
</head>
<body class="loginPage">
	
	<?php echo $content;?>

</BODY>
</HTML>
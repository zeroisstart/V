<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title><?php echo Yii::app() -> name?></title>
    
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
    
    <?php 
    	$cs = Yii::app() -> clientScript;
    	$cs -> registerCoreScript('jquery');
    	
    	$css = array('css/global.css','css/home.css','css/user.profile.css');
    	
    	
    	$this -> widget('widget.ClientScript.autoRegisterFile',array('css'=>$css));
    	
    ?>
   <!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->
   
</head>
<body>
    <div id="header">
        <div class="main">
            <div id="headerBox"></div>
            <div id="nav">
           
           		  <?php $this->widget('zii.widgets.CMenu',array(
			  		'id'=>'navBox',
	            	'htmlOptions'=>array('class'=>'navBox'),
					'items'=>array(
						array('label'=>'首页', 'url'=>array('/Home/main/index'),'htmlOptions'=>array('class'=>'noSpacing')),
						array('label'=>'关于竞赛', 'url'=>array('/Home/about/main')),
						array('label'=>'参赛办法', 'url'=>array('/Home/join/main')),
						array('label'=>'竞赛动态', 'url'=>array('/Home/feeds/main')),
						array('label'=>'历届回顾', 'url'=>array('/Home/history/main')),
						array('label'=>'风采展示', 'url'=>array('/Home/gallery/main')),
						array('label'=>'个人中心', 'url'=>array('/UserCenter/main/main'),'visable'=>Yii::app() -> user -> isGuest)
					),
				)); ?>	
            </div>
        </div>
    </div>

    <div id="context">
    	<?php if(Yii::app()->user->hasFlash('success') || 1):?>
		<?php 
		Yii::app()->clientScript->registerScript(
		'myHideEffect',
		'$(".info").animate({opacity: 1.0}, 3000).fadeOut("slow");',
		CClientScript::POS_READY
		);
		?>
		<div class="notice">
			<?php echo Yii::app()->user->getFlash('success'); ?>
		</div>
		<?php endif; ?>
    
        <div class="main">
            <?php echo $content;?>
        </div>
    </div>
    <div id="footer">
        <div class="main"></div>
    </div>
    <script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>
</body>
</html>

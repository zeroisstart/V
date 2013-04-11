<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title><?php echo Yii::app() -> name?></title>
    
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
    
    <?php 
    	$cs = Yii::app() -> clientScript;
    	$cs -> registerCoreScript('jquery');
    	
    	$css = array('css/global.css','css/home.css','css/user.profile.css','css/user.login.css','css/widget.btn.css');
    	
    	
    	$this -> widget('widget.ClientScript.autoRegisterFile',array('css'=>$css));
    	
    ?>
   <!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->
   
   
   <!--[if IE 6]>
			<script src="/js/DD_belatedPNG_0.0.8a-min.js" mce_src="DD_belatedPNG.js"></script>
			<script type="text/javascript">
			DD_belatedPNG.fix(".ie6png");
			</script>
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
						array('label'=>'企业命题', 'url'=>array('/Home/companyq/main')),
						array('label'=>'企业导师', 'url'=>array('/Home/master/main')),
						array('label'=>'风采展示', 'url'=>array('/Home/gallery/main')),

						#array('label'=>'竞赛动态', 'url'=>array('/Home/feeds/main'),'visable'=>false),
						#array('label'=>'历届回顾', 'url'=>array('/Home/history/main'),'visable'=>false),
						#array('label'=>'风采展示', 'url'=>array('/Home/gallery/main')),
						array('label'=>'个人中心', 'url'=>array('/UserCenter/main/main'),'visible'=>!Yii::app()->user->isGuest)
					),
				)); ?>	
            </div>
        </div>
    </div>

    <div id="context">
    	<?php if(Yii::app()->user->hasFlash('success')):?>
		<?php
		$this -> widget('ext.popup.popup');
		Yii::app()->clientScript->registerScript(
		'myHideEffect',
		'hm.alert({
				noTitle : true, // 是否显示标题
				text : "'.Yii::app()->user->getFlash('success').'", // 内容文
				height : "auto", // 高度字
				width : 320,// 宽度
				confirm : "确定"
				})',
		CClientScript::POS_READY
		);
		?>
		<?php if(0):?>
		<div class="notice">
			<?php echo Yii::app()->user->getFlash('success'); ?>
		</div>
		<?php endif;?>
		<?php endif; ?>
    
        <div class="main">
            <?php echo $content;?>
        </div>
    </div>
    <div id="footer">
        <div class="main">
        	<div class="footer_logo">
        		<img class="ie6png" src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png" alt="logo">
        	</div>
        	
        	<div class="footer_nav">
        		<ul>
        				<li>
        					<a href="<?php echo $this -> createUrl('/')?>">首页</a>
        				</li>
        				<li>
        					<a href="<?php echo $this -> createUrl('/Home/join/main');?>">参赛办法</a>
        				</li>
        				<li>
        					<a href="<?php echo $this -> createUrl('/Home/companyq/main');?>">企业命题</a>
        				</li>
        				<li>
        					<a href="<?php echo $this -> createUrl('/Home/master/main');?>">企业导师</a>
        				</li>
        				<li>
        					<a href="<?php echo $this -> createUrl('/Home/gallery/main')?>">风采展示</a>
        				</li>
        				
        				
        		</ul>
        	</div>
        	<div class="copy-right">
        	Copyright © 2013 miic.qceit.org.cn. All Rights Reserved.  京ICP备12041980号-3
        	</div>
        </div>
    </div>
    <script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>
</body>
</html>

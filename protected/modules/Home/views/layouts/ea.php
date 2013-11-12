<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title><?php echo Yii::app() -> name?></title>
    
    <?php 
    
    	$cs = Yii::app() -> clientScript;
    	$cs -> registerCoreScript('jquery');
    	$css = array('css/global.css','css/home.css');
    	$this -> widget('widget.ClientScript.autoRegisterFile',array('css'=>$css));
    	
    ?>
    
    <!--[if gte IE 9]>
    <link href="/Application/Modules/admin/Tpl/Public/Styles/ie.css" media="screen, projection" rel="stylesheet" type="text/css" />
    <![endif]-->
        <!--[if IE 8]>
    <link href="/Application/Modules/admin/Tpl/Public/Styles/ie8.css" media="screen, projection" rel="stylesheet" type="text/css" />
    <![endif]-->
        <!--[if lte IE 7]>
    <link href="../css/ie7.css" media="screen, projection" rel="stylesheet" type="text/css" />
    <![endif]-->
        <!--[if lt IE 9]>
    <script src="/Application/Modules/admin/Tpl/Public/Scripts/html5.js" type="text/javascript"></script>
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
						array('label'=>'论坛', 'url'=>array('/')),
					),
				)); ?>	
            </div>
        </div>
    </div>

    <div id="context">
        <div class="main">
            <?php echo $content;?>
        </div>
    </div>
    
    <div id="footer">
        <div class="main"></div>
    </div>
</body>
</html>

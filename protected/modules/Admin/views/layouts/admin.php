<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>后台管理</title>

<!-- We need to emulate IE7 only when we are to use excanvas -->
<!--[if IE]>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<![endif]-->
<!-- Favicons --> 

<?php 

$css = array (
		'css/style.css',
		'css/custom.css',
		'css/form.css'
);

$js = array (
		'js/swfobject.js',
		'js/jquery.ui.core.min.js',
		'js/jquery.tipTip.min.js',
		'js/jquery.superfish.min.js',
		'js/jquery.supersubs.min.js',
		'js/jquery.validate_pack.js',
		'js/jquery.nyroModal.pack.js',
		'js/flot/jquery.flot.min.js',
	//	'footer'=>array()	
);

$baseUrl = Yii::app ()->getAssetManager ()->publish ( Yii::getPathOfAlias ( 'application.assets.admin' ), false, - 1, YII_DEBUG );
$this->widget ( 'widget.clientScript.autoRegisterFile', array (
		'jquery'=>true,
		'css' => $css,
		'js' => $js,
		'baseUrl' =>$baseUrl, 
) );
?>

<!-- Main Stylesheet --> 
<!-- Colour Schemes
Default colour scheme is blue. Uncomment prefered stylesheet to use it.
<link rel="stylesheet" href="css/brown.css" type="text/css" media="screen" />  
<link rel="stylesheet" href="css/gray.css" type="text/css" media="screen" />  
<link rel="stylesheet" href="css/green.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/pink.css" type="text/css" media="screen" />  
<link rel="stylesheet" href="css/red.css" type="text/css" media="screen" />
-->


<!-- jQuery graph plugins -->
<!--[if IE]><script type="text/javascript" src="js/flot/excanvas.min.js"></script><![endif]-->
<!-- Internet Explorer Fixes --> 
<!--[if IE]>
<link rel="stylesheet" type="text/css" media="all" href="css/ie.css"/>
<script src="js/html5.js"></script>
<![endif]-->
<!--Upgrade MSIE5.5-7 to be compatible with MSIE8: http://ie7-js.googlecode.com/svn/version/2.1(beta3)/IE8.js -->
<!--[if lt IE 8]>
<script src="js/IE8.js"></script>
<![endif]-->
<script type="text/javascript">
$(document).ready(function(){

	/* flot graphs */
	var sales = [{
		label: 'Total Paid',
		data: [[1, 0],[2,0],[3,0],[4,0],[5,0],[6,0],[7,900],[8,0],[9,0],[10,0],[11,0],[12,0]]
	},{
		label: 'Total Due',
		data: [[1, 0],[2,0],[3,0],[4,0],[5,0],[6,422.10],[7,0],[8,0],[9,0],[10,0],[11,0],[12,0]]
	}
	];
	/*
	var plot = $.plot($("#placeholder"), sales, {
		bars: { show: true, lineWidth: 1 },
		legend: { position: "nw" },
		xaxis: { ticks: [[1, "Jan"], [2, "Feb"], [3, "Mar"], [4, "Apr"], [5, "May"], [6, "Jun"], [7, "Jul"], [8, "Aug"], [9, "Sep"], [10, "Oct"], [11, "Nov"], [12, "Dec"]] },
		yaxis: { min: 0, max: 1000 },
		grid: { color: "#666" },
		colors: ["#0a0", "#f00"]			
    });*/


});
</script>
<script type="text/javascript" src="<?php echo $baseUrl;?>/js/flot/jquery.flot.min.js"></script>
</head>
<body>
	<!-- Header -->
	<header id="top">
		<div class="wrapper">
			<!-- Title/Logo - can use text instead of image -->
			<div id="title">
					<img SRC="<?php echo $baseUrl;?>/img/admin_logo.png"  alt="logo" /><!--<span>Administry</span> demo-->
			</div>
			<!-- Top navigation -->
			<div id="topnav">
				<a href="#"><img class="avatar" SRC="<?php echo $baseUrl;?>/img/user_32.png" alt="" /></a>
				<b><?php echo Yii::app() -> user -> name;?></b>
				<!-- 
				<span>|</span> <a href="#">Settings</a>
				 -->
				<span>|</span> <a href="<?php echo $this -> createUrl('/logout')?>">退出</a><br />
				<!-- 
				<small>You have <a href="#" class="high"><b>1</b> new message!</a></small>
				 -->
			</div>
			<!-- End of Top navigation -->
			<!-- Main navigation -->
			<nav id="menu">
			<?php $this -> widget('widget.helper.Menu',array(
					'activeCssClass' => 'current',
					'htmlOptions'=>array('class'=>'sf-menu sf-js-enabled sf-shadow'),
					'items'=>array(
							array('label'=>'管理首页', 'url'=>array('/Admin/main/main')),
							array('label'=>'首页滑动', 'url'=>array('/Admin/slider/main')),
							array('label'=>'内容发布', 'url'=>array('/Admin/content/list')),
							#array('label'=>'新闻', 'url'=>array('/news/admin/list')),
							#array('label'=>'赛事', 'url'=>array('/event/admin/index')),
							#array('label'=>'图片','url'=>array('/pic/slider/list')),
							array('label'=>'用户管理','url'=>array('/Admin/UserAdmin/list')),
					)
			));?>
			</nav>
			<!-- End of Main navigation -->
			
		</div>
	</header>
	<!-- End of Header -->
	<!-- Page title -->
	<div id="pagetitle" style="display:none;">
		<div class="wrapper">
			<h1>控制面板</h1>
			<!-- Quick search box -->
			<form action="" method="get"><input class="" type="text" id="q" name="q" /></form>
		</div>
	</div>
	<!-- End of Page title -->
		
	<div class="page_content">
		
		<?php echo $content;?>	
	
	</div>

	<!-- Page footer -->
	<footer id="bottom">
		<div class="wrapper">
			<nav>
			<a href="<?php echo  $this-> createUrl('/admin')?>">管理首页</a> &middot;
			<a href="<?php echo  $this-> createUrl('/recommand/index')?>">首页推荐</a> &middot;
			<a href="<?php echo  $this-> createUrl('/news/admin')?>">新闻</a> &middot;
			<a href="<?php echo  $this-> createUrl('/association/admin')?>">协会</a> &middot;
			<a href="<?php echo  $this-> createUrl('/event/admin')?>">赛事</a> &middot;
			<a href="<?php echo  $this-> createUrl('/pic/admin')?>">图片</a> &middot;
			</nav>
			<p>Copyright &copy; 2013</p>
		</div>
	</footer>
	<!-- End of Page footer -->
	
	<!-- Animated footer -->
	<footer id="animated">
		<ul>
			<li><a href="#">Dashboard</a></li>
			<li><a href="#">管理首页</a></li>
			<li><a href="#">首页推荐</a></li>
			<li><a href="#">新闻</a></li>
			<li><a href="#">协会</a></li>
			<li><a href="#">赛事</a></li>
			<li><a href="#">图片</a></li>
			<li><a href="#">视频</a></li>
		</ul>
	</footer>
	<!-- End of Animated footer -->
	
	<!-- Scroll to top link -->
	<a href="#" id="totop">^ scroll to top</a>

<!-- Admin template javascript load -->
</body>
</html>
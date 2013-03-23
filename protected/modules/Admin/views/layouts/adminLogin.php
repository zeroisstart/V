<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>篮球联盟后台</title>
<meta name="keywords" content="Admin,Template" />
<!-- Favicons -->
<!-- 
<link rel="shortcut icon" type="image/png" HREF="img/favicons/favicon.png" />
<link rel="icon" type="image/png" HREF="img/favicons/favicon.png" />
<link rel="apple-touch-icon" HREF="img/favicons/apple.png" />
 -->
<!-- Main Stylesheet -->

<!-- Colour Schemes
Default colour scheme is blue. Uncomment prefered stylesheet to use it.
<link rel="stylesheet" href="css/brown.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/gray.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/green.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/pink.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/red.css" type="text/css" media="screen" />
-->
<!-- Your Custom Stylesheet -->

<!--swfobject - needed only if you require <video> tag support for older browsers -->
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

		/* setup navigation, content boxes, etc... */
	Administry.setup();

	// validate signup form on keyup and submit
var validator = $("#loginf").validate({
	rules: {
	username: "required",
	password: "required"
	},
	messages: {
				username: "Enter your username",
				password: "Provide your password"
			},
			// the errorPlacement has to take the layout into account
			errorPlacement: function(error, element) {
			error.insertAfter(element.parent().find('label:first'));
	},
// set new class to error-labels to indicate valid fields
	success: function(label) {
	// set &nbsp; as text for IE
	label.html("&nbsp;").addClass("ok");
	}
	});

});
</script>
</head>
<body>
	<?php 
		$baseUrl = Yii::app ()->getAssetManager ()->publish ( Yii::getPathOfAlias ( 'application.assets.admin' ), false, - 1, YII_DEBUG );
	?>	
	<!-- Header -->
	<header id="top">
		<div class="wrapper-login">
			<!-- Title/Logo - can use text instead of image -->
			<div id="title">
				<img SRC="<?php echo $baseUrl;?>/img/logo.png" alt="Administry" />
				<!--<span>Administry</span> demo-->
			</div>
			<!-- Main navigation -->
			<nav id="menu">
				<ul class="sf-menu">
					<li class="current">
						<a href="#">登陆</a>
					</li>
				</ul>
			</nav>
			<!-- End of Main navigation -->
			<!-- Aside links -->
			<!-- End of Aside links -->
		</div>
	</header>
	<!-- End of Header -->
	<!-- Page title -->
	<div id="pagetitle">
		<div class="wrapper-login"></div>
	</div>
	<!-- End of Page title -->

				<?php echo $content;?>
	
	<!-- Page footer -->
	<footer id="bottom">
		<div class="wrapper-login">
			<p>
				Copyright &copy; 2013 <b>
			
			</p>
		</div>
	</footer>
	<!-- End of Page footer -->

	<!-- User interface javascript load -->
</body>
</html>
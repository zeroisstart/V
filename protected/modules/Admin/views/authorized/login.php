<?php
$css = array (
		'css/style.css',
		'css/custom.css' 
);

$js = array (
		'js/swfobject.js',
		'js/jquery-1.4.2.min.js',
		'js/jquery.ui.core.min.js',
		'js/jquery.ui.widget.min.js',
		'js/jquery.ui.tabs.min.js',
		'js/jquery.tipTip.min.js',
		'js/jquery.superfish.min.js',
		'js/jquery.supersubs.min.js',
		'js/jquery.validate_pack.js',
		'js/jquery.nyroModal.pack.js',
		'js/administry.js' 
);

$baseUrl = Yii::app ()->getAssetManager ()->publish ( Yii::getPathOfAlias ( 'application.assets.admin' ), false, - 1, YII_DEBUG );
$this->widget ( 'widget.clientScript.autoRegisterFile', array (
		'css' => $css,
		'js' => $js,
		'baseUrl' => $baseUrl
) );

?>

	<!-- Page content -->
	<div id="page">
		<!-- Wrapper -->
		<div class="wrapper-login">
				<!-- Login form -->
				<section class="full">					
					
					<h3>登陆</h3>
						<?php if (isset($auth_error)): ?>
							<div class="box box-info">
						    <?php echo $auth_error['msg']; ?>
						    </div>
						<?php endif ?>
					<form id="loginform" method="post" action="<?php echo $this -> createUrl('/main/authorized/login')?>">
						
						<p>
							<label class="required" for="username">账号:</label><br/>
							<?php echo CHtml::activeTextField($model, 'username',array('class'=>'full','id'=>'username'))?>
						</p>
						
						
						
						<p>
							<label class="required" for="password">密码:</label><br/>
							<?php echo CHtml::activePasswordField($model, 'password',array('class'=>'full','id'=>'password'))?>
						</p>
						
						<p>
							<input type="submit" class="btn btn-green big" value="登陆"/> &nbsp;
						</p>
						<div class="clear">&nbsp;</div>

					</form>
					
					<form id="emailform" style="display:none" method="post" action="#">
						<div class="box">
							<p id="emailinput">
								<label for="email">邮箱:</label><br/>
								<input type="text" id="email" class="full" value="" name="email"/>
							</p>
							<p>
								<input type="submit" class="btn" value="Send"/>
							</p>
						</div>
					</form>
					
				</section>
				<!-- End of login form -->
				
		</div>
		<!-- End of Wrapper -->
	</div>
	<!-- End of Page content -->

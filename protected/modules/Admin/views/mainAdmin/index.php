<?php 

$cs = Yii::app()-> clientScript;

$cs -> registerScript('test','
	Administry.setup();
	Administry.progress("#progress1", '. ($todayPV/$thisWeekPV) * 5 .', 5);
	Administry.progress("#progress2", '. ($yesterdayPV/$thisWeekPV) * 5 .', 5);
	Administry.progress("#progress3", 5, 5);
	Administry.progress("#progress4", 5, 5);
');
$baseUrl = Yii::app ()->getAssetManager ()->publish ( Yii::getPathOfAlias ( 'application.assets.admin' ), false, - 1, YII_DEBUG );
?>

<!-- Page content -->
	<div id="page">
		<!-- Wrapper -->
		<div class="wrapper">
				<!-- Left column/section -->
				<section class="column width6 first">
				
					<div class="colgroup leading">
					
						<div class="column width3 first">
							<h4>网站PV显示</h4>
							<hr>
							<table class="no-style full">
								<tbody>
									<tr>
										<td>今天</td>
										<td class="ta-right"><?php echo $todayPV;?></td>
										<td><div id="progress1" class="progress full progress-green"><span><b></b></span></div></td>
									</tr>
									<tr>
										<td>昨天</td>
										<td class="ta-right"><?php echo $yesterdayPV;?></td>
										<td><div id="progress2" class="progress full progress-blue"><span><b></b></span></div></td>
									</tr>
									
									<tr>
										<td>这周</td>
										<td class="ta-right"><?php echo $thisWeekPV;?></td>
										<td><div id="progress3" class="progress full progress-red"><span><b></b></span></div></td>
									</tr>
									
									<tr>
										<td>上周</td>
										<td class="ta-right"><?php echo $lastWeekPV;?></td>
										<td><div id="progress4" class="progress full progress-red"><span><b></b></span></div></td>
									</tr>
								</tbody>
							</table>
						</div>
						
						<div class="column width3">
							<h3>欢迎回来, <a href="#"><?php echo $user -> name;?></a></h3>
							<p>
								您最后登陆的时间为  <?php echo $user -> last_login;?>
							</p>
						</div>
					</div>
					
					<div class="colgroup leading" style="display:none;">
						<div class="column width3 first">
							<h4>Invoices: <a href="#">10</a></h4>
							<hr/>
							<table class="no-style full">
								<tbody>
									<tr>
										<td>Total Invoices</td>
										<td class="ta-right"><a href="#">10</a></td>
										<td class="ta-right">1,322.10 &euro;</td>
									</tr>
									<tr>
										<td>Total Paid</td>
										<td class="ta-right"><a href="#">9</a></td>
										<td class="ta-right">900.00 &euro;</td>
									</tr>
									<tr>
										<td>Total Due</td>
										<td class="ta-right"><a href="#">1</a></td>
										<td class="ta-right">422.10 &euro;</td>
									</tr>
									<tr>
										<td>Total Overdue</td>
										<td class="ta-right">0</td>
										<td class="ta-right">0.00 &euro;</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="column width3">
							<h4>Sales: <a href="#">1</a></h4>
							<hr/>
							<table class="no-style full">
								<tbody>
									<tr>
										<td>Clients This Month</td>
										<td class="ta-right"><a href="#">1</a></td>
										<td class="ta-right"></td>
									</tr>
									<tr>
										<td>Sales This Month</td>
										<td class="ta-right"><a href="#">9</a></td>
										<td class="ta-right">900.00 &euro;</td>
									</tr>
									<tr>
										<td>Clients Total</td>
										<td class="ta-right"><a href="#">5</a></td>
										<td class="ta-right"></td>
									</tr>
									<tr>
										<td>Sales Total</td>
										<td class="ta-right"><a href="#">9</a></td>
										<td class="ta-right">900.00 &euro;</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				
					<div class="colgroup leading" style="display:none;">
						<div class="column width3 first">
							<h4>Client Stats</h4>
							<hr/>
							<table class="no-style full">
								<tbody>
									<tr>
										<td>Active</td>
										<td class="ta-right">1/5</td>
										<td><div id="progress1" class="progress full progress-green"><span><b></b></span></div></td>
									</tr>
									<tr>
										<td>Pending</td>
										<td class="ta-right">2/5</td>
										<td><div id="progress2" class="progress full progress-blue"><span><b></b></span></div></td>
									</tr>
									<tr>
										<td>Suspended</td>
										<td class="ta-right">2/5</td>
										<td><div id="progress3" class="progress full progress-red"><span><b></b></span></div></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="column width3">
							<h4>Reports</h4>
							<hr/>
							<p><b>Sales this year</b></p>
							<div id="placeholder" style="height:100px"></div>
						</div>
					</div>
					<div class="clear">&nbsp;</div>
				
				</section>
				<!-- End of Left column/section -->
				
				<!-- Right column/section -->
				<aside class="column width2" style="display:none;">
					<div id="rightmenu">
						<header>
							<h3>Your Account</h3>
						</header>
						<dl class="first">
							<dt><img width="16" height="16" alt="" SRC="<?php echo $baseUrl;?>/img/key.png"></dt>
							<dd><a href="#">Administry (admin)</a></dd>
							<dd class="last">Free Account.</dd>
							
							<dt><img width="16" height="16" alt="" SRC="<?php echo $baseUrl;?>img/help.png"></dt>
							<dd><a href="#">Support</a></dd>
							<dd class="last">Documentation and FAQ</dd>
						</dl>
					</div>
					<div class="content-box">
						<header>
							<h3>Latest in the Community</h3>
						</header>
						<section>
							<dl>
								<dt>Maximize every interaction with a client</dt>
								<dd><a href="#">Read more</a></dd>
								<dt>Diversification for Small Business Owners</dt>
								<dd><a href="#">Read more</a></dd>
							</dl>
						</section>
					</div>
				</aside>
				<!-- End of Right column/section -->
				
		</div>
		<!-- End of Wrapper -->
	</div>
	<!-- End of Page content -->
<?php
class leftLogin extends CWidget {
	
	/**
	 * (non-PHPdoc)
	 *
	 * @see CWidget::init()
	 */
	public function init() {
	}
	
	/**
	 * (non-PHPdoc)
	 *
	 * @see CWidget::run()
	 */
	public function run() {
		$user = Yii::app ()->user;
		if ($user->isGuest) {
			$this->_notLogin ();
		} else {
			$this->_logged ();
		}
		$this->_leftBtns ();
	}
	public function _logged() {
		$logout = Yii::app ()->createUrl ( '/logout' );
		
		$profileUrl = Yii::app ()->createUrl ( '/UserCenter/main/main' );
		
		$team = Yii::app ()->createUrl ( '/UserCenter/main/main', array (
				'ac' => 'team' 
		) );
		$members = Yii::app ()->createUrl ( '/UserCenter/main/main', array (
				'ac' => 'book' 
		) );
		$user = Yii::app ()->user;
		$mineProduct = Yii::app ()->createUrl ( '/UserCenter/main/main', array (
				'ac' => 'product' 
		) );
		$assessment = Yii::app ()->createUrl ( '/UserCenter/main/main', array (
				'ac' => 'assessment' 
		) );
		$assessmented = Yii::app ()->createUrl ( '/UserCenter/main/main', array (
				'ac' => 'assessmented' 
		) );
		
		$info = Yii::app ()->createUrl ( '/UserCenter/main/main', array (
				'ac' => 'info' 
		) );
		
		$admin = Yii::app ()->createUrl ( '/Admin/main/main' );
		
		$name = ($user->name);
		$id = ($user->id);
		if ($user->userProfile && $user->userProfile->User_category == 2) {
			$tpl = '<div id="userLogin">
					<div id="userLoginTitle">用户登陆信息</div>
					<div id="userLoginBox">
						<div class="user_info ">
							<span><a href="profileUrl">name</a> </span>
							<span><a href="assessment">待评作品</a></span>
							<span><a href="assesmented">评过的作品</a></span>
						</div>
					</div>
				</div>';
			$tpl = str_replace ( 'profileUrl', $profileUrl, $tpl );
			$tpl = str_replace ( 'logout', $logout, $tpl );
			$tpl = str_replace ( 'assessment', $assessment, $tpl );
			$tpl = str_replace ( 'assesmented', $assessmented, $tpl );
			$tpl = str_replace ( 'name', $name, $tpl );
			echo $tpl;
		} elseif ($user->userProfile && $user->userProfile->User_category == 5) {
			$tpl = '<div id="userLogin">
					<div id="userLoginTitle">用户登陆信息</div>
					<div id="userLoginBox">
						<div class="user_info ">
							<span><a href="profileUrl">name</a> | <a href="admin">后台</a> </span>
						</div>
					</div>
				</div>';
			$tpl = str_replace ( 'profileUrl', $profileUrl, $tpl );
			$tpl = str_replace ( 'logout', $logout, $tpl );
			$tpl = str_replace ( 'assessment', $assessment, $tpl );
			$tpl = str_replace ( 'admin', $admin, $tpl );
			$tpl = str_replace ( 'name', $name, $tpl );
			echo $tpl;
		} else {
			echo <<<EOT
		<div id="userLogin">
			<div id="userLoginTitle">用户登陆信息</div>
			<div id="userLoginBox">
				<div class="user_info ">
					<span><a href="$profileUrl">$name</a> </span>
					<span><a href="$team">我的队伍</a> | <a href="$info">完善资料</a></span>
					<span><a href="$mineProduct">我的作品</a> | <a href="$members">我要组队</a></span>
				</div>
			</div>
		</div>		
EOT;
		}
	}
	private function _notLogin() {
		$login = Yii::app ()->createUrl ( '/login' );
		$register = Yii::app ()->createUrl ( '/register' );
		$cs = Yii::app ()->clientScript;
		$cs->registerScript ( 'login', '
			$("document").ready(function(){
				$(".login_button").click(function(){
						$("form").submit();
				});
			})
' );
		
		$model = new LoginForm ();
		
		echo <<<EOT
<div id="userLogin">
	<div id="userLoginTitle">用户登录</div>
	<div id="userLoginBox">
EOT;
		?>

<?php
		
		$form = $this->beginWidget ( 'CActiveForm', array (
				'action' => Yii::app ()->createUrl ( '/UserCenter/login/login' ),
				'id' => 'login-form',
				'enableClientValidation' => true,
				'clientOptions' => array (
						'validateOnSubmit' => true 
				) 
		) );
		?>

<div class="userLoginInput">
	<span>用户名：</span> 
		<?php echo $form->textField($model,'username',array('class'=>'ipt_username','id'=>'username')); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

<div class="userLoginInput">
	<span>密&nbsp;&nbsp;&nbsp;码：</span> 
		<?php echo $form->passwordField($model,'password',array('class'=>'ipt_password','id'=>'password')); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

<div style="text-align: justify; padding: 5px; margin-top: 20px;">
	<span class="userLoginInput"> <a class="yel_btn login_button"
		href="javascript:void(0);">登陆</a>
	</span> <span class="userLoginInput"> <a class="yel_btn"
		href="<?php echo $register?>">注册</a>
	</span>
</div>

<?php $this->endWidget(); ?>
<?php

		echo <<<EOT
	</div>
</div>		
EOT;
	}
	public function _leftBtns() {
		echo <<<EOT
                   <div class="leftColumnsBox">
                        <div class="leftItem">
                            <div class="title">参与方式</div>
                            <div class="box">
                                <div class="first"></div>
                                <ul>
                                	<li><a class="link" target="_blank" href="http://weibo.com/u/2463756001?topnav=1&wvr=5&from=company">竞赛微博</a></li>
                                	<li><a class="link" href="http://gedc.net.cn/profile?ac=book">在线报名</a></li>	
                                    <li><a class="link" href="http://gedc.net.cn/profile?ac=product">作品提交</a></li>
                                    <li><a class="link" href="http://gedc.net.cn/join?id=24">资料下载</a></li>
                                </ul>
                                <div class="last"></div>
                            </div>
                        </div>
                        <div class="leftItem">
                            <div class="title">合作伙伴</div>
                            <div class="box">
                                <div class="first"></div>
                                <div class="text">
                                    <p style="margin: 8px 0px; text-align: center;">
                                        <a href="javascript:void(0);" class="blue_btn">会议合作</a>
                                    </p>
                                    
                                    <p>
                                        地址：北京市海淀区玉渊潭南路普惠<br />
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;南里13号楼<br />
                                        组委会邮箱：cieeda@163.com<br />
                                        邮编：100036
                                    </p>
                                    <p>
                                        联系人：王新霞 何文丹<br />
                                        联系电话：010—68273817                                      
                                        <br />
                                    </p>
                                </div>
                                <div class="last"></div>
                            </div>
                        </div>
                        
                       <div class="leftItem">
                            <div class="title">学生会员</div>
                            <div class="box">
                                <div class="first"></div>
                                <div class="text"><p style="text-align:center;">
                                	欢迎成为中国电子学会学生会员
                                	<img style="width:120px;height:145px;text-align:center;" src="/images/member.jpg" /><br/>
                                	<a href="http://www.cie-info.org.cn/mis/" target="_blank">申请加入</a>
                                </p></div>
                                <div class="last"></div>
                            </div>
                        </div>
                        
                    </div>
EOT;
	}
}
?>



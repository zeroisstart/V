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
		$profileUrl = Yii::app() -> createUrl('/profile');
		
		$team = Yii::app() -> createUrl('/team');
		
		$members = Yii::app() -> createUrl('/members');
		
		$user = Yii::app() ->user;
		
		$mineProduct = Yii::app() -> createUrl('/product');
		
		$name = ($user -> name);
		
		$id = ($user-> id);
		echo <<<EOT
<div id="userLogin">
	<div id="userLoginTitle">用户登陆信息</div>
	<div id="userLoginBox">
		<div class="user_info test">
			<span><a href="$profileUrl">$name</a> | <a href="$logout">退出</a> </span>
			
			<span><a href="$team">我的队伍</a> | <a href="$profileUrl">完善资料</a></span>
			
			<span><a href="$mineProduct">我的作品</a> | <a href="$members">团队成员</a></span>
		</div>
	</div>
</div>		
							
EOT;
	}
	private function _notLogin() {
		$login = Yii::app ()->createUrl ( '/login' );
		$register = Yii::app ()->createUrl ( '/register' );
		
		echo <<<EOT
<div id="userLogin">
	<div id="userLoginTitle">用户登录</div>
	<div id="userLoginBox">
		<form>
			<div class="userLoginInput">
				<span>用户名：</span> 
				<input type="text" class="ipt_username"  id="username" />
			</div>
			<div class="userLoginInput">
				<span>密&nbsp;&nbsp;&nbsp;码：</span> 
				<input type="password" class="ipt_password" id="password" />
			</div>
		</form>
		<div style="text-align: justify; padding: 5px;">
			<span class="userLoginInput">
				<a class="yel_btn" href="$login">登陆</a>
			</span> 
			<span class="userLoginInput"> 
				<a class="yel_btn" href="$register">注册</a>
			</span>
		</div>
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
                                    <li><a class="link" href="javascript:;">竞赛微博</a></li>
                                    <li><a class="link" href="javascript:;">在线报名</a></li>
                                    <li><a class="link" href="javascript:;">作品提交</a></li>
                                    <li><a class="link" href="javascript:;">资料下载</a></li>
                                </ul>
                                <div class="last"></div>
                            </div>
                        </div>
                        <div class="leftItem">
                            <div class="title">合作伙伴</div>
                            <div class="box">
                                <div class="first"></div>
                                <div class="text">
                                    <p>
                                        抢票热线：010-88454017/88454027
                                        <br />
                                        报名邮箱：cie-info@163.com
                                    </p>
                                    <p style="margin: 8px 0px; text-align: center;">
                                        <a href="javascript:void(0);" class="blue_btn">会议合作</a>
                                    </p>
                                    <p>
                                        地址：北京市海淀区玉渊潭南路普惠<br />
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;南里13号楼<br />
                                        信箱：北京165信箱<br />
                                        邮编：100036
                                    </p>
                                    <p>
                                        联系人：陈枫<br />
                                        010-68229381-829/13121398779                                       
                                        <br />
                                        Chen13121398779@sina.com
                                    </p>
                                </div>
                                <div class="last"></div>
                            </div>
                        </div>
                    </div>
EOT;
	}
}
?>



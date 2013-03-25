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
	}
	public function _logged() {
		$logout = Yii::app() -> createUrl('/logout');
		echo <<<EOT
<div id="userLogin">
	<div id="userLoginTitle">用户登陆信息</div>
	<div id="userLoginBox">
		<form>
			<div class="userLoginInput">
				<span>用户名：</span> 
				<input type="text" class="ipt_username" id="username" />
			</div>
			<div class="userLoginInput">
				<span>密&nbsp;&nbsp;&nbsp;码：</span> 
				<input type="password" class="ipt_password" id="password" />
			</div>
		</form>
		<div style="text-align: justify; padding: 5px;">
			<span class="userLoginInput">
				<a class="btn" href="$logout">注册</a>
			</span> 
			<span class="userLoginInput"> 
				<a class="btn" href="$logout">注册</a>
			</span>
		</div>
	</div>
</div>		
							
EOT;
	
	}
	private function _notLogin() {
		
		$login = Yii::app() -> createUrl('/login');
		$register = Yii::app() -> createUrl('/register');
		
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
}
?>



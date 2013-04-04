<?php
class UserSecNav extends CWidget {
	public $ary_nav = array (
			'main' => '我的首页',
			'team' => '我的团队',
			'product' => '我的作品',
			'state' => '参赛状态',
	);
	public $current = 'main';
	public function init() {
		$req = Yii::app ()->request;
		$action = $req->getParam ( 'ac' );
		
		$user = Yii::app ()->user;
		$uid = $user->id;
		
		// 队长页面
		$userGroup = UserGroup::model ();
		if ($userGroup->isLeader ( $uid )) {
			$this->ary_nav ['accept'] = '队员申请';
		}
		$userModel = $user -> getModel();
		$profile = ($user -> getModel() -> userProfile);
				// 评委老师页面
		if ($user->userProfile->User_category == 2) {
			$teacher_nav = array (
					'assessment' => '我要评定的作品',
					'assessmented' => '我评过的作品' 
			);
			$this->ary_nav = $teacher_nav;
		}
		
		//'book' => '报名'
		
		if (key_exists ( $action, $this->ary_nav )) {
			$this->current = $action;
		}
	}
	public function run() {
		?>
<div class="user_sec_nav">
		<?php
		
		?>
			<ul>
			<?php foreach($this -> ary_nav as $key => $val):?>
				<?php if($this -> current == $key):?>
					<li class="active_nav"><a
			href="<?php echo Yii::app() -> createUrl('/UserCenter/main/main',array('ac'=>$key))?>">
							<?php echo $val?>
						</a></li>
				<?php else:?>
					<li><a
			href="<?php echo Yii::app() -> createUrl('/UserCenter/main/main',array('ac'=>$key))?>">
							<?php echo $val?>
						</a></li>
				<?php endif;?>
			<?php endforeach;?>
			</ul>
</div>
<?php
	}
}

?>
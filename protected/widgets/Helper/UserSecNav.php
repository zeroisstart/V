<?php
class UserSecNav extends CWidget {
	public $ary_nav = array (
			'main' => '我的首页',
			'team' => '我的团队',
			'product' => '我的作品',
			'state' => '参赛状态', 
			'book'=>'报名'
	);
	public $current = 'main';
	public function init() {
		$req = Yii::app ()->request;
		$action = $req->getParam ( 'ac' );
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
					<li class="active_nav">
						<a href="<?php echo Yii::app() -> createUrl('/UserCenter/main/main',array('ac'=>$key))?>">
							<?php echo $val?>
						</a>
					</li>
				<?php else:?>
					<li>
						<a href="<?php echo Yii::app() -> createUrl('/UserCenter/main/main',array('ac'=>$key))?>">
							<?php echo $val?>
						</a>
					</li>
				<?php endif;?>
			<?php endforeach;?>
			</ul>
</div>
<?php
	}
}

?>
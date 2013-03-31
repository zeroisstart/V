<?php

/**
 * 
 * @author top
 *
 */
class GallerySecNav extends CWidget {
	/**
	 *
	 * @var array
	 */
	public $ary_nav = array (
			'product' => '精彩作品',
			'team' => '参赛队风采',
			'post' => '竞赛海报' 
	);
	
	/**
	 *
	 * @var string 默认栏目
	 */
	public $current = 'product';
	
	/**
	 * (non-PHPdoc)
	 *
	 * @see CWidget::init()
	 */
	public function init() {
		$req = Yii::app ()->request;
		$action = $req->getParam ( 'ac' );
		if (key_exists ( $action, $this->ary_nav )) {
			$this->current = $action;
		}
	}
	
	/**
	 * (non-PHPdoc)
	 *
	 * @see CWidget::run()
	 */
	public function run() {
		?>
<div class="user_sec_nav">
		<?php
		
		?>
			<ul>
			<?php foreach($this -> ary_nav as $key => $val):?>
				<?php if($this -> current == $key):?>
					<li class="active_nav"><a
			href="<?php echo Yii::app() -> createUrl('/Home/gallery/main',array('ac'=>$key))?>">
							<?php echo $val?>
						</a></li>
				<?php else:?>
					<li><a
			href="<?php echo Yii::app() -> createUrl('/Home/gallery/main',array('ac'=>$key))?>">
							<?php echo $val?>
						</a></li>
				<?php endif;?>
			<?php endforeach;?>
			</ul>
</div>
<?php
	}
}
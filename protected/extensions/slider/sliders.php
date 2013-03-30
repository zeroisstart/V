<?php
class sliders extends CWidget {
	
	public $images = array ();
	
	/**
	 * (non-PHPdoc)
	 *
	 * @see CWidget::init()
	 */
	public function init() {
		$publish_url = Yii::app ()->assetManager->publish ( dirname ( __FILE__ ) . '/assets/' );
		
		$cs = Yii::app ()->clientScript;
		$cs->registerCoreScript ( 'jquery' );
		$cs->registerCssFile ( $publish_url . '/css/slider.css' );
		$cs->registerScriptFile ( $publish_url . '/js/slider.js' );
	}
	
	/**
	 * (non-PHPdoc)
	 *
	 * @see CWidget::run()
	 */
	public function run() {
		if(empty($this -> images))
			return false;
		
		$div = '<div class="wrapper" id="focus"><ul>';
		foreach ( $this->images as $img ) {
			$div .= '<li><a target="_blank" href="#"><img alt="" src="'.$img.'" /></a></li>';
		}
		$div .= '</ul></div>';
		
		echo $div;
	}
}
?>
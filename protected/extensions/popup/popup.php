<?php

/**
 * 加载提示框
 * @author Top
 *
 */
class popup extends CWidget {
	public $css = array ();
	public $js = array ();
	public function init() {
		$this->css = array (
				'hm_popStyle.css' 
		);
		$this->js = array (
				'hmpop.js' 
		);
	}
	public function run() {
		$assets_path = dirname ( __FILE__ ) . '/' . 'assets';
		$assets_path = Yii::app ()->getAssetManager ()->publish ( $assets_path ) . '/';
		
		$css_path = $assets_path . 'css' . '/';
		$js_path = $assets_path . 'js' . '/';
		
		$cs = Yii::app ()->clientScript;
		$cs->registerCoreScript('jquery');
		foreach ( $this->css as $_css ) {
			$cs->registerCssFile ( $css_path . $_css );
		}
		foreach ( $this->js as $_js ) {
			$cs->registerScriptFile ( $js_path . $_js );
		}
	}
}
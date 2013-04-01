<?php
/**
 * 创建二级导航的工具
 * @author Top
 *
 */
class SecNav extends CWidget {
	public $template = '<div class="sec_nav">{template}</div>';
	public $tabs = array ();
	
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
		$sec_nav_content = false;
		
		foreach ( $this->tabs as $key => $val ) {
			$sec_nav_content .= CHtml::link ( $key, $val, array (
					'class' => 'blue_Btn',
					'title'=>$key
			) );
		}
		
		if ($sec_nav_content) {
			echo str_replace ( '{template}', $sec_nav_content, $this->template );
		}
	}
}
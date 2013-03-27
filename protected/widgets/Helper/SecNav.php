<?php
class SecNav extends CWidget {
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
		if (! empty ( $this->tabs )) {
			echo "<div class=\"sec_nav\">";
			foreach ( $this->tabs as $key => $val ) {
				echo CHtml::link ( $key, $val, array (
						'class' => 'blue_Btn',
						'title' => $key 
				) );
			}
			echo "</div>";
		}
	}
}
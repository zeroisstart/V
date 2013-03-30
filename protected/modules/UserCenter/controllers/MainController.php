<?php
/**
 * 
 * @author top
 *
 */
class MainController extends Controller {
	public $defaultAction = 'main';
	public $layout = '//layouts/ea';
	
	/**
	 * (non-PHPdoc)
	 *
	 * @see CController::accessRules()
	 */
	public function accessRules() {
		return array (
				array (
						'allow',
						'actions' => array (
								'main' 
						),
						'users' => array (
								'@' 
						),
						'roles' => array (
								'admin' 
						) 
				),
				array (
						'deny',
						'actions' => array (
								'main' 
						),
						'users' => array (
								'?' 
						) 
				) 
		);
	}
	public function actionMain() {
		$req = Yii::app ()->request;
		$ac = $req->getParam ( 'ac' );
		switch ($ac) {
			case 'team' :
				$this->_actionTeam ();
				break;
			case 'product' :
				$this->_actionProduct ();
				break;
			case 'state' :
				$this->_actionState ();
				break;
			default :
				$this->render ( 'main' );
				break;
		}
	}
	/**
	 * 我的团队
	 */
	public function _actionTeam() {
		$this->render ( 'team' );
	}
	/**
	 * 我的作品
	 */
	public function _actionProduct() {
		$this->render ( 'product' );
	}
	/**
	 * 参赛状态
	 */
	public function _actionState() {
		$this->render ( 'state' );
	}
}
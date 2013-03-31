<?php
class GalleryController extends Controller {
	/**
	 *
	 * @var string
	 */
	public $defaultAction = 'product';
	public function actionMain() {
		$req = Yii::app ()->request;
		$ac = $req->getParam ( 'ac' );
		switch ($ac) {
			case 'team' :
				
				$this->_actionTeam ();
				break;
			case 'post' :
				$this->_actionPost ();
				break;
			case 'product' :
			
			default :
				$this->_actionProduct ();
				break;
		}
	}
	/**
	 * 我的团队
	 */
	public function _actionTeam() {
		$model = News::model ();
		$model->category = 20;
		$dataProvider = $model->search ();
		$this->render ( 'team' );
		/*
		 * $this->render ( 'team', array ( 'model' => $model, 'dataProvider' =>
		 * $dataProvider ) );
		 */
	}
	/**
	 * 我的作品
	 */
	public function _actionProduct() {
		$model = News::model ();
		$model->category = 20;
		$dataProvider = $model->search ();
		$this->render ( 'product', array (
				'model' => $model,
				'dataProvider' => $dataProvider 
		) );
		// this->render ( 'product' );
	}
	/**
	 * 参赛状态
	 */
	public function _actionPost() {
		$this->render ( 'post' );
	}
}
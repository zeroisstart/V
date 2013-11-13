<?php
class MasterController extends Controller {
	/**
	 *
	 * @var string
	 */
	public $layout = 'admin';
	public function actionMain() {
		$req = Yii::app ()->request;
		$ac = $req->getParam ( 'ac' );
		
		switch ($ac) {
			case "update" :
				$this->_actionUpdate ();
				break;
			case "view" :
				$this->_actionView ();
				break;
			default :
				$this->_actionList ();
				break;
		}
	}
	public function _actionList() {
		$model = News::model ();
		$model->category = 22;
		$dataProvider = $model->search ();
		$this->render ( 'list', array (
				'dataProvider' => $dataProvider,
				'model' => $model 
		) );
	}
	public function _actionUpdate() {
		$this->render ( 'update' );
	}
	public function _actionView() {
		$this->render ( 'view' );
	}
}
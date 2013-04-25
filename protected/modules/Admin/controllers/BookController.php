<?php
class BookController extends Controller {
	/**
	 *
	 * @var string
	 */
	public $layout = 'admin';
	public $defaultAction = 'list';
	
	/**
	 * 用户报名申请页面
	 */
	public function actionList() {
		$req = Yii::app ()->request;
		$book = UserBooked::model ();
		$state = $req->getParam ( 'state' );
		if (in_array ( $state, array (
				'0',
				'1',
				'2' 
		) )) {
			$state = $state;
		} else {
			$state = '0';
		}
		$book->state = $state;
		$dataProvider = $book->search ();
		$this->render ( 'list', array (
				'state' => $state,
				'model' => $book,
				'dataProvider' => $dataProvider 
		) );
	}
	/**
	 */
	public function actionAccept() {
		$req = Yii::app ()->request;
		$id = $req->getParam ( 'id' );
		
		$book = UserBooked::model ()->findByAttributes ( array (
				'UID' => $id 
		) );
		if ($book) {
			if ($book->update ()) {
				$this->redirect ( $this->createUrl ( '/Admin/book/list' ) );
			}
			die ( CJavaScript::jsonEncode ( array (
					'status' => 1,
					'msg' => '审核成功!' 
			) ) );
		} else {
			die ( CJavaScript::jsonEncode ( array (
					'status' => 0,
					'msg' => '没有找到该用户!' 
			) ) );
		}
	}
	/**
	 */
	public function actionRefused() {
		$req = Yii::app ()->request;
		$id = $req->getParam ( 'id' );
		
		$book = UserBooked::model ()->findAllByAttributes ( array (
				'UID' => $id 
		) );
		if ($book) {
			$book->state = 0;
			$book->update ();
			die ( CJavaScript::jsonEncode ( array (
					'status' => 0,
					'msg' => '拒绝成功!' 
			) ) );
		} else {
			die ( CJavaScript::jsonEncode ( array (
					'status' => 0,
					'msg' => '没有找到该用户!' 
			) ) );
		}
	}
	
	/**
	 */
	public function actionMain() {
		$this->render ( 'main' );
	}
	/**
	 */
	public function actionUpdate() {
		$this->render ( 'update' );
	}
	/**
	 */
	public function actionDelete() {
		$this->render ( 'delete' );
	}
}
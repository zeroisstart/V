<?php

/**
 * 后台用户作品的分配
 * @author Top
 *
 */
class ProductController extends Controller {
	/**
	 *
	 * @var string
	 */
	public $layout = 'admin';
	
	/**
	 *
	 * @var string
	 */
	public $defaultAction = 'main';
	/**
	 */
	public function actionDelete() {
		$this->render ( 'delete' );
	}
	/**
	 */
	public function actionList() {
		$productModel = UserGroupGrade::model ();
		$dataProvider = $productModel->search ();
		$this->render ( 'list', array (
				'model' => $productModel,
				'dataProvider' => $dataProvider 
		) );
	}
	public function actionMain() {
		$this->render ( 'main' );
	}
	public function actionUpdate($id) {
		$userProfile = UserProfile::model ();
		$product = UserProductGrade::model ()->findByPk ( $id );
		if (empty ( $product )) {
			echo "作品不存在!";
			die ();
		}
		$userProfile->User_category = 2;
		$dataProvider = $userProfile->search ();
		$this->renderPartial ( 'update', array (
				'model' => $userProfile,
				'product' => $product,
				'dataProvider' => $dataProvider 
		) );
	}
	public function actionView() {
		$this->render ( 'view' );
	}
	/**
	 */
	public function actionSelectJudges() {
		$req = Yii::app ()->request;
		$user = Yii::app ()->user;
		if ($user->UserProfile->userProfile->User_category == 2) {
			$id = $req->getParam ( 'id' );
			$pid = $req->getParam ( 'pid' );
			if ($pid && $id) {
				$product = UserProductGrade::model ()->findByPk ( $pid );
				
				$UserGroupGrade = UserGroupGrade::model ()->findByAttributes ( array (
						'pid' => $pid 
				) );
				
				if (empty ( $UserGroupGrade )) {
					$UserGroupGrade = new UserGroupGrade ();
					$UserGroupGrade->ID = NULL;
					$UserGroupGrade->pid = $pid;
					$UserGroupGrade->title = $product->title;
					$UserGroupGrade->judges = $id;
					$UserGroupGrade->is_checked = 0;
					$UserGroupGrade->create_time = date ( 'Y-m-d H:i:s', time () );
					$UserGroupGrade->save ();
				} else {
					$UserGroupGrade->judges = $id;
					$UserGroupGrade->is_checked = 0;
					$UserGroupGrade->create_time = date ( 'Y-m-d H:i:s', time () );
					$UserGroupGrade->update ();
				}
				echo CJavaScript::jsonEncode ( array (
						'status' => 0,
						'msg' => '分配成功!' 
				) );
				die ();
			} else {
				die ( '缺少 作品ID 或者评委ID' );
			}
		} else {
			die ( 'access Daned' );
		}
	}
}

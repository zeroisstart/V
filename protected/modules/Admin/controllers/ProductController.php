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
}

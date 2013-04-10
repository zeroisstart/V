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
		$productModel = UserProductGrade::model ();
		$dataProvider = $productModel->search ();
		
		$this->render ( 'list', array (
				'model' => $productModel,
				'dataProvider' => $dataProvider 
		) );
	}
	public function actionMain() {
		$this->render ( 'main' );
	}
	public function actionUpdate() {
		$this->render ( 'update' );
	}
	public function actionView() {
		$this->render ( 'view' );
	}
}

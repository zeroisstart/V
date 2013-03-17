<?php

/**
 * 分类控制器
 * @author Top
 *
 */
class adminController extends Controller {
	public $layout = 'admin';
	
	/**
	 * 分类列表
	 */
	public function actionList() {
		$request = Yii::app ()->request;
		$type = $request->getParam ( 't' );
		
		$model = Category::model ();
		
		if ($type) {
			$model->type = $type;
		}
		
		$dataProvider = $model->search ();
		
		$this->render ( 'list', array (
				'dataProvider' => $dataProvider,
				'id' => $type 
		) );
	}
	
	/**
	 * 新建分类
	 */
	public function actionCreate() {
		$model = new Category ( 'create' );
		$request = Yii::app ()->request;
		$type = $request->getParam ( 't' );
		
		if (isset ( $_POST ['Category'] )) {
			
			if ($type) {
				$_POST ['Category'] ['type'] = array (
						$type 
				);
			}
			$db = Yii::app ()->db;
			$transaction = $db->beginTransaction ();
			try {
				foreach ( $_POST ['Category'] ['type'] as $key => $value ) {
					$model = new Category ( 'create' );
					$model->attributes = $_POST ['Category'];
					$model->type = $value;
					$model = $this->_validateForm ( $model );
					if ($model->validate ()) {
						$model->save ();
					} else {
						YII_DEBUG && var_dump ( $model->errors );
					}
				}
				$transaction->commit ();
				$this->redirect ( $this->createUrl ( '/category/admin/list' ) );
			} catch ( Exception $e ) {
				$transaction->rollback ();
			}
		}
		$this->render ( 'create', array (
				'model' => $model,
				'id' => $type 
		) );
	}
	/**
	 * 删除分类
	 */
	public function actionDelete($id) {
		if (is_numeric ( $id )) {
			$model = Category::model ()->findByPk ( $id );
			$model->delete ();
		}
		$this->render ( 'delete' );
	}
	
	/**
	 * 编辑分类
	 */
	public function actionUpdate($id) {
		$model = new Category ( 'update' );
		if (! $id) {
			$this->redirect ( $this->createUrl ( '/news/CateAdmin/list' ) );
		}
		
		$model = $model->findByPk ( $id );
		
		if (empty ( $model ))
			$this->redirect ( $this->createUrl ( '/news/CateAdmin/list' ) );
		
		if (isset ( $_POST ['Category'] )) {
			$model->attributes = $_POST ['Category'];
			$model = $this->_validateForm ( $model );
			if ($model->validate ()) {
				$model->update ();
				$this->redirect ( $this->createUrl ( '/category/admin/list' ) );
				// set Flash;
			}
		}
		$this->render ( 'update', array (
				'model' => $model 
		) );
	}
	
	/**
	 * 验证模块
	 *
	 * @param CModel $model        	
	 * @return CModel $model
	 */
	public function _validateForm($model) {
		return $model;
	}
}
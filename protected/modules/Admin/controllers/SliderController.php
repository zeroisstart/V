<?php
class SliderController extends Controller {
	public $title = '首页滑动栏';
	public $layout = 'admin';
	public function actionMain() {
		$model = Slider::model ();
		
		// if it is ajax validation request
		if (isset ( $_POST ['ajax'] ) && $_POST ['ajax'] === 'slider-slider-form') {
			echo CActiveForm::validate ( $model );
			Yii::app ()->end ();
		}
		
		$dataProvider = $model->search ();
		
		if (isset ( $_POST ['Slider'] )) {
			
			$model = new Slider ();
			$model->state = '1';
			$model->cate = 1;
			$model->create_time = date ( 'Y-m-d H:i:s' );
			$model->attributes = $_POST ['Slider'];
			$upload = UploadedFile::getInstance ( $model, 'img' );
			$model->img = $upload;
			
			if ($model->validate ()) {
				$ext = $upload->getExtensionName ();
				$name = md5 ( $upload->getName () . time () );
				$name = $name . '.' . $ext;
				$path = Yii::app ()->getParams ();
				$UploadPath = $path->imgUploadPath;
				$folder = UploadedFile::getFolder ( $UploadPath );
				$imgPath = $folder . '/' . $name;
				
				$savePath = str_replace ( $UploadPath, '', $imgPath );
				$upload->saveAs ( $imgPath );
				$model->img = $savePath;
				$model->save ();
			} else {
				//var_dump ( $model->errors );
			}
		}
		
		$this->render ( 'main', array (
				'model' => $model,
				'dataProvider' => $dataProvider 
		) );
	}
	
	/**
	 * 删除slider的滑动
	 *
	 * @param int $id        	
	 */
	public function actionDelete($id) {
		$model = Slider::model ();
		$model = $model->findByPk ( $id );
		if ($model) {
			$model->delete ();
		}
	}
}
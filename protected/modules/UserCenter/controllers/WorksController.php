<?php
/**
 * 上传作品页面
 * @author Top
 *
 */
class WorksController extends Controller {
	public function actionIndex() {
		$this->render ( 'index' );
	}
	
	public function actionUpload() {
		if (isset ( $_POST ['UserBooked'] )) {
			$bookModel->attributes = $_POST ['UserBooked'];
			$bookModel->UID = $user->id;
			$bookModel->state = 0;
			$bookModel->img = UploadedFile::getInstance ( $bookModel, 'img' );
			if ($bookModel->validate ()) {
				$path = $this->_model_file_save ( $bookModel->img );
				$bookModel->img = $path;
				if ($bookModel->save ()) {
					$user->setFlash ( 'success', '报名申请提交成功，请耐心等待验证哦!' );
					$this->redirect ( $this->createUrl ( '/UserCenter/main/main', array ('ac' => 'book' ) ) );
				}
			} else {
				YII_DEBUG && var_dump ( $bookModel->errors );
			}
		}
		$this -> render('upload_works');
	}
}
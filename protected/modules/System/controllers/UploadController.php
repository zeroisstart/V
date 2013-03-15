<?php

/**
 * 用户保存上传文件组件 
 * @author Top
 *
 */
class UploadController extends Controller {
	public function actionAttachmentUpload() {
		if (isset ( $_FILES ['AttachmentUploadForm'] )) {
			$model = new AttachmentUploadForm ();
			$upload = UploadedFile::getInstance ( $model, 'attachment' );
			$model->attachment = $upload;
			if ($model->validate ()) {
				$ext = $upload->getExtensionName ();
				$name = md5 ( $upload->getName () . time () );
				$name = $name . '.' . $ext;
				$path = Yii::app ()->getParams ();
				$UploadPath = $path->attachmentUploadPath;
				$folder = UploadedFile::getFolder ( $UploadPath );
				$upload->saveAs ( $folder . '/' . $name );
			}
		}
	}
	public function actionImgUpload() {
		if (isset ( $_FILES ['ImgUploadForm'] )) {
			$model = new ImgUploadForm ();
			$upload = UploadedFile::getInstance ( $model, 'img' );
			$model->img = $upload;
			if ($model->validate ()) {
				$ext = $upload->getExtensionName ();
				$name = md5 ( $upload->getName () . time () );
				$name = $name . '.' . $ext;
				$path = Yii::app ()->getParams ();
				$imgUploadPath = $path->imgUploadPath;
				$folder = UploadedFile::getFolder ( $imgUploadPath );
				// save before action
				$upload->saveAs ( $folder . '/' . $name );
			}
		}
	}
}
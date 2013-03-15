<?php

class UploadController extends Controller
{
	public function actionAttachmentUpload()
	{
		$model = new AttachmentUploadForm();
		//$this->render('AttachmentUpload');
	}

	public function actionImgUpload()
	{
		$model = new ImgUploadForm();
		var_dump($_FILES);
		$upload = CUploadedFile::getInstance($model, 'img');
		var_dump($upload);
		die;
// 		$this->render('ImgUpload');
	}

}
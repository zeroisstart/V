<?php

/**
 * 文件上传类
 * @author Top
 *
 */
class UploadForm extends CWidget {
	public $uploadUrl = false;
	public $model;
	public function init() {
	}
	public function run() {
		$this->render ( 'views._widgets.system.uploadForm', array (
				'model' => $this->model 
		) );
	}
}
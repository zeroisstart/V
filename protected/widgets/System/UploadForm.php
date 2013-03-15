<?php

/**

<?php

$model = new ImgUploadForm ();
$this->widget ( 'widget.system.uploadForm', array (
		'fieldName'=>'ImgUploadForm[img]',
		'model' => $model 
) );

?>
 
*/


/**
 * 文件上传类
 * @author Top
 *
 */
class UploadForm extends CWidget {
	public $uploadUrl = false;
	public $fieldName = false;
	public $model;
	public function init() {
		if (! $this->fieldName) {
			throw new Exception ( '$fieldName can not be empty!!!' );
		}
	}
	public function run() {
		$this->render ( 'views._widgets.system.uploadForm', array (
				'fieldName' => $this-> fieldName,
				'model' => $this->model 
		) );
	}
}
<?php

/**
$model = new ImgUploadForm ();
$this->widget ( 'widget.system.uploadForm', array (
		'fieldName'=>'AttachmentUploadForm[attachment]',
		'model' => $model
) );
*/

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class AttachmentUploadForm extends CFormModel {
	public $attachment;
	/**
	 * Declares the validation rules.
	 */
	public function rules() {
		return array (
				// name, email, subject and body are required
				array (
						'attachment',
						'required' 
				),
				// email has to be a valid email address
				array (
						'attachment',
						'file',
						'types' => array (
								'doc',
								'ppt',
								'txt',
								'rar',
								'zip',
								'tar',
								'gz',
								'tar.gz',
								'7z' 
						) 
				) 
		);
	}
	
	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels() {
		return array (
				'attachment' => '要上传的文件!!' 
		);
	}
}
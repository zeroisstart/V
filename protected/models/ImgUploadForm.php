<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class ImgUploadForm extends CFormModel
{
	public $img;
	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// name, email, subject and body are required
			array('img', 'required'),
			// email has to be a valid email address
			//'on'=>'insert 永远只有在新增的时候才会显示
			array('img', 'file','types'=>'jpg,gif,png,jpeg','on'=>'insert'),

		);
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
			'img'=>'要上传的图片',
		);
	}
}
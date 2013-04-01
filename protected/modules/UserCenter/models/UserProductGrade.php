<?php

/**
 * This is the model class for table "{{user_product_grade}}".
 *
 * The followings are the available columns in table '{{user_product_grade}}':
 * @property integer $ID
 * @property integer $uid
 * @property string $title
 * @property string $detail
 * @property string $text
 * @property string $doc
 * @property string $img
 * @property string $os
 * @property string $hard_driver
 * @property string $ep_num
 * @property integer $edit_count
 * @property integer $type
 * @property string $create_time
 */
class UserProductGrade extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserProductGrade the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user_product_grade}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('uid, edit_count, type', 'numerical', 'integerOnly'=>true),
			array('title, doc, img', 'length', 'max'=>255),
			array('detail', 'length', 'max'=>300),
			array('os, hard_driver, ep_num', 'length', 'max'=>45),
			array('text, create_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, uid, title, detail, text, doc, img, os, hard_driver, ep_num, edit_count, type, create_time', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'uid' => 'Uid',
			'title' => 'Title',
			'detail' => 'Detail',
			'text' => 'Text',
			'doc' => 'Doc',
			'img' => 'Img',
			'os' => 'Os',
			'hard_driver' => 'Hard Driver',
			'ep_num' => 'Ep Num',
			'edit_count' => 'Edit Count',
			'type' => 'Type',
			'create_time' => 'Create Time',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('ID',$this->ID);
		$criteria->compare('uid',$this->uid);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('detail',$this->detail,true);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('doc',$this->doc,true);
		$criteria->compare('img',$this->img,true);
		$criteria->compare('os',$this->os,true);
		$criteria->compare('hard_driver',$this->hard_driver,true);
		$criteria->compare('ep_num',$this->ep_num,true);
		$criteria->compare('edit_count',$this->edit_count);
		$criteria->compare('type',$this->type);
		$criteria->compare('create_time',$this->create_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
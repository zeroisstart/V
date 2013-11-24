<?php

/**
 * This is the model class for table "notify".
 *
 * The followings are the available columns in table 'notify':
 * @property integer $id
 * @property integer $fromuser
 * @property integer $touser
 * @property integer $category
 * @property string $title
 * @property string $msg
 * @property string $is_system
 * @property integer $extid
 * @property string $status
 * @property string $datetime
 */
class Notify extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Notify the static model class
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
		return 'notify';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fromuser, touser, category, extid', 'numerical', 'integerOnly'=>true),
			array('title, msg', 'length', 'max'=>255),
			array('is_system, status', 'length', 'max'=>1),
			array('datetime', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, fromuser, touser, category, title, msg, is_system, extid, status, datetime', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'fromuser' => 'Fromuser',
			'touser' => 'Touser',
			'category' => 'Category',
			'title' => 'Title',
			'msg' => 'Msg',
			'is_system' => 'Is System',
			'extid' => 'Extid',
			'status' => 'Status',
			'datetime' => 'Datetime',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('fromuser',$this->fromuser);
		$criteria->compare('touser',$this->touser);
		$criteria->compare('category',$this->category);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('msg',$this->msg,true);
		$criteria->compare('is_system',$this->is_system,true);
		$criteria->compare('extid',$this->extid);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('datetime',$this->datetime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
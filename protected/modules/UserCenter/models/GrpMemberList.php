<?php

/**
 * This is the model class for table "grp_member_list".
 *
 * The followings are the available columns in table 'grp_member_list':
 * @property string $id
 * @property string $category
 * @property integer $teamid
 * @property string $name
 * @property string $gender
 * @property string $idcard
 * @property string $cellphone
 * @property string $ext1
 * @property string $ext2
 * @property string $dateline
 */
class GrpMemberList extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return GrpMemberList the static model class
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
		return 'grp_member_list';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('teamid', 'numerical', 'integerOnly'=>true),
			array('category, gender', 'length', 'max'=>1),
			array('name', 'length', 'max'=>30),
			array('idcard', 'length', 'max'=>40),
			array('cellphone', 'length', 'max'=>20),
			array('ext1, ext2', 'length', 'max'=>255),
			array('dateline', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, category, teamid, name, gender, idcard, cellphone, ext1, ext2, dateline', 'safe', 'on'=>'search'),
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
			'category' => 'Category',
			'teamid' => 'Teamid',
			'name' => 'Name',
			'gender' => 'Gender',
			'idcard' => 'Idcard',
			'cellphone' => 'Cellphone',
			'ext1' => 'Ext1',
			'ext2' => 'Ext2',
			'dateline' => 'Dateline',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('category',$this->category,true);
		$criteria->compare('teamid',$this->teamid);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('idcard',$this->idcard,true);
		$criteria->compare('cellphone',$this->cellphone,true);
		$criteria->compare('ext1',$this->ext1,true);
		$criteria->compare('ext2',$this->ext2,true);
		$criteria->compare('dateline',$this->dateline,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
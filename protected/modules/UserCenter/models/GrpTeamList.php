<?php

/**
 * This is the model class for table "grp_team_list".
 *
 * The followings are the available columns in table 'grp_team_list':
 * @property string $id
 * @property integer $uid
 * @property string $name
 * @property string $belong
 * @property string $datetime
 */
class GrpTeamList extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return GrpTeamList the static model class
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
		return 'grp_team_list';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('uid', 'numerical', 'integerOnly'=>true),
			array('name, belong', 'length', 'max'=>50),
			array('datetime', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, uid, name, belong, datetime', 'safe', 'on'=>'search'),
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
			'id' => '自增ID',
			'uid' => '创建人用户ID',
			'name' => '队名',
			'belong' => '隶属',
			'datetime' => '创建时间',
		);
	}
	/**
	 * 是否可以创建团队
	 * @param integer $uid
	 */
	public function canBuild($uid){
		$this -> uid = $uid;
		$data = $this -> search();
		$row = $data -> data;
		if(!empty($row)){
			return false;
		}
		return true;
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
		$criteria->compare('uid',$this->uid);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('belong',$this->belong,true);
		$criteria->compare('datetime',$this->datetime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
<?php

/**
 * This is the model class for table "{{user_group_member}}".
 *
 * The followings are the available columns in table '{{user_group_member}}':
 * @property string $id
 * @property integer $UID
 * @property integer $group_id
 * @property string $state
 */
class UserGroupMember extends CActiveRecord {
	public $_state = array (
			0 => '拒绝加入',
			1 => '同意加入' 
	);
	
	/**
	 * Returns the static model of the specified AR class.
	 *
	 * @param string $className
	 *        	active record class name.
	 * @return UserGroupMember the static model class
	 */
	public static function model($className = __CLASS__) {
		return parent::model ( $className );
	}
	
	/**
	 *
	 * @return string the associated database table name
	 */
	public function tableName() {
		return '{{user_group_member}}';
	}
	
	/**
	 *
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array (
				array (
						'UID, gid',
						'numerical',
						'integerOnly' => true 
				),
				array (
						'state',
						'length',
						'max' => 1 
				),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array (
						'id, UID, gid, state',
						'safe',
						'on' => 'search' 
				) 
		);
	}
	
	/**
	 *
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array (
				'group' => array (
						self::BELONGS_TO,
						'UserGroup',
						'gid' 
				),
				'user' => array (
						self::BELONGS_TO,
						'User',
						'UID' 
				) 
		);
	}
	
	/**
	 *
	 * @param int $UID        	
	 * @param int $id        	
	 * @return boolean
	 */
	public function canJoin($UID) {
		$model = $this->findByAttributes ( array (
				'UID' => $UID 
		) );
		return empty ( $model ) ? true : false;
	}
	
	/**
	 *
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array (
				'ID' => 'ID',
				'UID' => '用户ID',
				'username' => '用户名',
				'gid' => '组ID',
				'state' => '状态',
				'create_time' => '创建时间' 
		);
	}
	
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 *         based on the search/filter conditions.
	 */
	public function search() {
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		$criteria = new CDbCriteria ();
		
		$criteria->compare ( 'ID', $this->ID, true );
		$criteria->compare ( 'UID', $this->UID );
		$criteria->compare ( 'gid', $this->gid );
		$criteria->compare ( 'state', $this->state, true );
		
		return new CActiveDataProvider ( $this, array (
				'criteria' => $criteria 
		) );
	}
}
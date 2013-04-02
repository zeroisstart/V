<?php

/**
 * This is the model class for table "{{user_group}}".
 *
 * The followings are the available columns in table '{{user_group}}':
 * @property string $id
 * @property integer $uid
 * @property string $name
 * @property string $state
 */
class UserGroup extends CActiveRecord {
	public $_state = array (
			'0' => '未审核',
			'1' => '已审核',
			'2' => '已删除' 
	);
	
	/**
	 * Returns the static model of the specified AR class.
	 *
	 * @param string $className
	 *        	active record class name.
	 * @return UserGroup the static model class
	 */
	public static function model($className = __CLASS__) {
		return parent::model ( $className );
	}
	
	/**
	 *
	 * @return string the associated database table name
	 */
	public function tableName() {
		return '{{user_group}}';
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
						'name',
						'required' 
				),
				array (
						'name',
						'unique' 
				),
				array (
						'uid',
						'numerical',
						'integerOnly' => true 
				),
				array (
						'name',
						'length',
						'max' => 255 
				),
				array (
						'state',
						'length',
						'max' => 1 
				),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array (
						'id, uid, name, state',
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
				'members' => array (
						self::HAS_MANY,
						'UserGroupMember',
						'gid' 
				) ,
		);
	}
	
	/**
	 *
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array (
				'ID' => '组ID',
				'UID' => '创建人',
				'username' => '创建人ID',
				'name' => '组名',
				'create_time' => '创建时间',
				'state' => '组状态' 
		);
	}
	
	/**
	 * 获取用户组成员的链接
	 *
	 * @param String $txt        	
	 */
	public function getMemberLink($txt) {
		return CHtml::link ( Controller::cut_str ( $txt, 10, 0 ), Yii::app ()->createUrl ( '/Admin/group/view', array (
				'id' => $this->ID 
		) ), array (
				'title' => $txt 
		) );
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
		$criteria->compare ( 'name', $this->name, true );
		$criteria->compare ( 'state', $this->state, true );
		
		return new CActiveDataProvider ( $this, array (
				'criteria' => $criteria 
		) );
	}
}
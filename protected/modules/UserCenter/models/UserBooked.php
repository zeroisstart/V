<?php

/**
 * This is the model class for table "{{user_booked}}".
 *
 * The followings are the available columns in table '{{user_booked}}':
 * @property integer $ID
 * @property integer $UID
 */
class UserBooked extends CActiveRecord {
	/**
	 * Returns the static model of the specified AR class.
	 *
	 * @param string $className
	 *        	active record class name.
	 * @return UserBooked the static model class
	 */
	public static function model($className = __CLASS__) {
		return parent::model ( $className );
	}
	
	/**
	 *
	 * @return string the associated database table name
	 */
	public function tableName() {
		return '{{user_booked}}';
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
						'UID',
						'numerical',
						'integerOnly' => true 
				),
				array (
						'img',
						'file',
						'types' => array (
								'jpg',
								'jpeg',
								'png',
								'gif' 
						) 
				),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array (
						'ID, UID',
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
		return array ();
	}
	
	/**
	 *
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array (
				'ID' => 'ID',
				'UID' => '用户ID',
				'img' => '汇款照片',
				'state' => '状态' 
		);
	}
	/**
	 *
	 * @param int $uid        	
	 */
	public function isBooked() {
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
		
		$criteria->compare ( 'ID', $this->ID );
		$criteria->compare ( 'UID', $this->UID );
		
		return new CActiveDataProvider ( $this, array (
				'criteria' => $criteria 
		) );
	}
}
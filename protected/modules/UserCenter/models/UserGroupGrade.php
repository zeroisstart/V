<?php

/**
 * This is the model class for table "{{user_group_grade}}".
 *
 * The followings are the available columns in table '{{user_group_grade}}':
 * @property integer $ID
 * @property integer $pid
 * @property integer $judges
 * @property integer $technology
 * @property integer $interface
 * @property integer $operators
 * @property integer $integrity
 * @property integer $creative
 * @property integer $is_checked
 * @property string $create_time
 * @property string $check_time
 */
class UserGroupGrade extends CActiveRecord {
	public $ary_grade = array (
			'technology',
			'interface',
			'operators',
			'integrity',
			'creative' 
	);
	/**
	 * Returns the static model of the specified AR class.
	 *
	 * @param string $className
	 *        	active record class name.
	 * @return UserGroupGrade the static model class
	 */
	public static function model($className = __CLASS__) {
		return parent::model ( $className );
	}
	
	/**
	 *
	 * @return string the associated database table name
	 */
	public function tableName() {
		return '{{user_group_grade}}';
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
						'pid, judges, technology, interface, operators, integrity, creative, is_checked',
						'numerical',
						'integerOnly' => true 
				),
				array (
						'create_time, check_time',
						'safe' 
				),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array (
						'ID, pid, judges, technology, interface, operators, integrity, creative, is_checked, create_time, check_time',
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
				'product' => array (
						self::HAS_ONE,
						'UserProductGrade',
						false,'on'=>"t.pid=product.ID" 
				)
		);
	}
	
	/**
	 *
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array (
				'ID' => 'ID',
				'pid' => 'Pid',
				'title' => '作品名称',
				'judges' => '评委老师',
				'technology' => '技术',
				'interface' => '界面',
				'operators' => '运营',
				'integrity' => '完整性',
				'creative' => '创意',
				'is_checked' => '是否有过评价',
				'create_time' => '分配时间',
				'check_time' => '评定时间' 
		);
	}
	public function afterFind() {
		$ary_item = array (
				'technology',
				'interface',
				'operators',
				'integrity',
				'creative' 
		);
		foreach ( $ary_item as $key ) {
			if ($key) {
				$this->$key = chr ( 64 + $this->$key );
			}
		}
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
		$criteria->compare ( 'pid', $this->pid );
		$criteria->compare ( 'judges', $this->judges );
		$criteria->compare ( 'technology', $this->technology );
		$criteria->compare ( 'interface', $this->interface );
		$criteria->compare ( 'operators', $this->operators );
		$criteria->compare ( 'integrity', $this->integrity );
		$criteria->compare ( 'creative', $this->creative );
		$criteria->compare ( 'is_checked', $this->is_checked );
		$criteria->compare ( 'create_time', $this->create_time, true );
		$criteria->compare ( 'check_time', $this->check_time, true );
		
		return new CActiveDataProvider ( $this, array (
				'criteria' => $criteria 
		) );
	}
}
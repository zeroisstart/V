<?php

/**
 * This is the model class for table "{{user_profile}}".
 *
 * The followings are the available columns in table '{{user_profile}}':
 * @property integer $ID
 * @property string $Nickname
 * @property string $Realname
 * @property string $Company_name
 * @property string $Mobile
 * @property string $Email
 * @property string $City
 * @property string $User_category
 */
class UserProfile extends CActiveRecord {
	
	/**
	 * 用户的类型
	 * @var array
	 */
	public $user_category = array (
				'1' => '学生',
				'2' => '评委',
				'3' => '非学生',
				'4' => '企业' 
		);
	
	/**
	 * Returns the static model of the specified AR class.
	 * 
	 * @param string $className
	 *        	active record class name.
	 * @return UserProfile the static model class
	 */
	public static function model($className = __CLASS__) {
		return parent::model ( $className );
	}
	
	/**
	 *
	 * @return string the associated database table name
	 */
	public function tableName() {
		return '{{user_profile}}';
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
						'Nickname, Realname, City',
						'length',
						'max' => 45 
				),
				array (
						'Company_name, Email',
						'length',
						'max' => 255 
				),
				array (
						'Mobile',
						'length',
						'max' => 12 
				),
				array (
						'User_category',
						'length',
						'max' => 1 
				),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array (
						'ID, Nickname, Realname, Company_name, Mobile, Email, City, User_category',
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
				'Nickname' => 'Nickname',
				'Realname' => 'Realname',
				'Company_name' => 'Company Name',
				'Mobile' => 'Mobile',
				'Email' => 'Email',
				'City' => 'City',
				'User_category' => 'User Category' 
		);
	}
	
	/**
	 * 获取用户的类型
	 * 
	 * @return Ambigous <string>
	 */
	public function getUserCategory() {
		return $this -> user_category [$this->User_category];
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
		$criteria->compare ( 'Nickname', $this->Nickname, true );
		$criteria->compare ( 'Realname', $this->Realname, true );
		$criteria->compare ( 'Company_name', $this->Company_name, true );
		$criteria->compare ( 'Mobile', $this->Mobile, true );
		$criteria->compare ( 'Email', $this->Email, true );
		$criteria->compare ( 'City', $this->City, true );
		$criteria->compare ( 'User_category', $this->User_category, true );
		
		return new CActiveDataProvider ( $this, array (
				'criteria' => $criteria 
		) );
	}
}
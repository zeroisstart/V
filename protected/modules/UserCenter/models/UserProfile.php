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
	 *
	 * @var array
	 */
	public $user_category = array (
			'1' => '学生',
			'2' => '评委',
			'3' => '非学生',
			//'4' => '企业'
			'4' => '老师',
			'9'=>'区域管理员'
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
						'numerical' 
				),
				array (
						'IDNum',
						'length',
						'max' => '18',
						'min' => '15' 
				),
				array (
						'Mobile',
						'length',
						'min' => 11,
						'max' => 11 
				),
				array (
						'User_category',
						'length',
						'max' => 1 
				),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array (
						'ID, District, Nickname, Realname, Company_name, job, address, Mobile, Email, IDNum,City, User_category,idType',
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
				'Nickname' => '昵称',
				'Realname' => '真实姓名',
				'District' => '赛事地区',
				'IDNum' => '身份证号',
				'Job'=>'职务',
				'job'=>'职务',
				'gender'=>'性别',
				'Address'=>'邮寄地址',
				'address'=>'邮寄地址',
				'Company_name' => '工作单位',
				'Mobile' => '手机号码',
				'Email' => '邮箱',
				'City' => '所在地址',
				'User_category' => 'User Category',
				'idType'=>'',
				'schoolType'=>'学校类型',
				'isSame'=>'',
				'sid'=>'',
				'majoy'=>'专业',
				'degreeType'=>'',
				'joinDate'=>''
				
		);
	}
	/**
	 * 获取用户的类型
	 *
	 * @return Ambigous <string>
	 */
	public function getUserCategory() {
		if($this -> User_category == 5)
			return "管理员";
		return $this->user_category [$this->User_category];
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
		$criteria->compare ( 'IDNum', $this->IDNum, true );
		$criteria->compare ( 'User_category', $this->User_category, true );
		
		return new CActiveDataProvider ( $this, array (
				'criteria' => $criteria 
		) );
	}
}
<?php

class User extends ActiveRecord
{
	/**
	 * The followings are the available columns in table 'tbl_user':
	 * @var integer $id
	 * @var string $username
	 * @var string $password
	 * @var string $email
	 * @var string $profile
	 */
	
	public $name = '';
	
	const STATUS_ACTIVE  = 'active';
	const STATUS_NEW     = 'new';
	const STATUS_BLOCKED = 'blocked';
	
	const GENDER_MAN   = "man";
	const GENDER_WOMAN = "woman";
	
	const ROLE_ADMIN = 'admin';
	const ROLE_GUEST = 'guest';
	const ROLE_USER  = 'user';
	
	const SCENARIO_CHANGE_PASSWORD_REQUEST = 'ChangePasswordRequest';
	const SCENARIO_ACTIVATE_REQUEST        = 'ActivateRequest';
	const SCENARIO_UPDATE_SELF_DATA        = 'UpdateSelfData';
	const SCENARIO_CHANGE_PASSWORD         = 'ChangePassword';
	const SCENARIO_REGISTRATION            = 'Registration';
	const SCENARIO_USER_SEARCH             = 'UserSearch';
	const SCENARIO_UPDATE                  = 'Update';
	const SCENARIO_CREATE                  = 'Create';
	const SCENARIO_LOGIN                   = 'Login';
	
	public $password_c;
	
	public $remember_me = false;
	
	public $identity;
	
	public $activate_error;
	
	public $activate_code;
	
	public $role;
	
	public static $roles = array(
			self::ROLE_USER,
			self::ROLE_GUEST,
			self::ROLE_ADMIN
	);
	
	
	public $_state = array(0=>'停用',1=>'激活','2'=>'删除');

	/**
	 * Returns the static model of the specified AR class.
	 * @return CActiveRecord the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function name(){
		return 'User';
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password', 'required'),
			array('username, password, email', 'length', 'max'=>128,'on'=>'create'),
			array('profile', 'safe'),
				array(
						'role',
						'unsafe'
				),
				array(
						'role',
						'in',
						'range' => self::$roles
				)
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
			'userProfile'=>array(self::HAS_ONE,'UserProfile','ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '用户ID',
			'username' => '用户名',
			'password' => '密码',
			'email' => '邮箱',
			'profile' => 'Profile',
			'state'=>'状态',
		);
	}

	/**
	 * Checks if the given password is correct.
	 * @param string the password to be validated
	 * @return boolean whether the password is valid
	 */
	public function validatePassword($password)
	{
		return crypt($password,$this->password)===$this->password;
	}

	/**
	 * 验证md5密码
	 * @param string $password
	 * @return boolean
	 */
	public function validateMd5Password($password){
		return md5($password)===$this->password;
	}

	/**
	 * Generates the password hash.
	 * @param string password
	 * @return string hash
	 */
	public function hashPassword($password)
	{
		return crypt($password, $this->generateSalt());
	}

	/**
	 * Generates a salt that can be used to generate a password hash.
	 *
	 * The {@link http://php.net/manual/en/function.crypt.php PHP `crypt()` built-in function}
	 * requires, for the Blowfish hash algorithm, a salt string in a specific format:
	 *  - "$2a$"
	 *  - a two digit cost parameter
	 *  - "$"
	 *  - 22 characters from the alphabet "./0-9A-Za-z".
	 *
	 * @param int cost parameter for Blowfish hash algorithm
	 * @return string the salt
	 */
	protected function generateSalt($cost=10)
	{
		if(!is_numeric($cost)||$cost<4||$cost>31){
			throw new CException(Yii::t('Cost parameter must be between 4 and 31.'));
		}
		// Get some pseudo-random data from mt_rand().
		$rand='';
		for($i=0;$i<8;++$i)
			$rand.=pack('S',mt_rand(0,0xffff));
		// Add the microtime for a little more entropy.
		$rand.=microtime();
		// Mix the bits cryptographically.
		$rand=sha1($rand,true);
		// Form the prefix that specifies hash algorithm type and cost parameter.
		$salt='$2a$'.str_pad((int)$cost,2,'0',STR_PAD_RIGHT).'$';
		// Append the random salt string in the required base64 format.
		$salt.=strtr(substr(base64_encode($rand),0,22),array('+'=>'.'));
		return $salt;
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
	
		$criteria->compare ( 'id', $this->id, true );
		$criteria->compare ( 'username', $this->username, true );
		$criteria->compare ( 'password', $this->password, true );
		$criteria->compare ( 'email', $this->email, true );
		$criteria->compare ( 'state', $this->state, true );
		
		$profile_model = UserProfile::model();
		
		$req = Yii::app() -> request;
		$t = $req-> getParam('t') ; 
		if($t && key_exists($t, $profile_model -> user_category)){
			$criteria -> with = array('userProfile');
		}
		
	
		return new CActiveDataProvider ( $this, array (
				'criteria' => $criteria,
				'pagination' => array (
						'pageSize' => 20
				)
		) );
	}
	
	/**
	 * 密码验证逻辑
	 * @return boolean
	 */
	public function authenticate(){
		$user_identity = new UserIdentity ( $this->username, $this->password );
		$this -> identity = $user_identity;
		return $this -> identity -> authenticate();
	}
	
	/**
	 * 执行登陆操作
	 * @return boolean
	 */
	public function login()
	{
		$duration=$this->remember_me ? 3600*24*30 : 0; // 30 days
		Yii::app()->user->login($this -> identity,$duration);
		return true;
	}
	
	/**
	 * 
	 * @return boolean
	 */
	public function isRootRole(){
		return false;
	}

	/**
	 * 返回用户名
	 *
	 * @param int $uid
	 * @return string
	 */
	public function getNameByID($uid) {
		$model = $this -> findByPk($uid);
		if($model)
			return $model -> username;
		return false;
	}
		
}
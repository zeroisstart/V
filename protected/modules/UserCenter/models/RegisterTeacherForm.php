<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class RegisterTeacherForm extends CFormModel {
	public $username;
	public $password;
	public $password_confirm;
	public $email;
	public $company_name;
	public $contact;
	public $mobile;
	public $job;
	public $address;
	public $idcard;
	public $district;
	public $area;
	public $city;
	public $allowRegister;
	private $_identity;
	public $userType;
	
	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules() {
		return array (
				// username and password are required
				array (
						'district,area,username,allowRegister,password,password_confirm,email,contact,company_name,job,address,idcard,mobile,city',
						'required' 
				),
				array (
						'username',
						'length',
						'min' => 6,
						'max' => 14 
				),
				array (
						'mobile',
						'numerical' 
				),
				array (
						'mobile',
						'length',
						'max' => '11',
						'min' => '11' 
				),
				array (
						'password',
						'length',
						'min' => 6,
						'max' => 16 
				),
				array (
						'idcard',
						'length',
						'max' => '18',
						'min' => '15'
				),
				array (
						'username',
						'_isExists' 
				),
				
				array (
						'email',
						'email' 
				),
				array (
						'email',
						'_isExistsEmail' 
				),
				array (
						'password',
						'_password_confirm' 
				) 
		);
	}
	public function getUser_type() {
		return array (
				'3' => '学生',
				'4' => '老师',
				//'5' => '个人' 
		);
	}
	
	public function getDistrict_list(){
		$model = CompetitionRegion::model();
		return $model -> district;
	}
	
	
	public function getArea_list(){
		$Competition = CompetitionRegion::model();
		
		$criteria = new CDbCriteria();
		$criteria -> order ="cate desc";
		$data = $Competition -> findAll($criteria);
		$ary_cate = array();
		foreach($data as $_model){
			$ary_cate[$_model -> id] = $_model -> name;
		}
		return $ary_cate;
	}
	
	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels() {
		return array (
				'username' => '用户名',
				'password' => '密码',
				'userType' => '用户类型',
				'district' => '赛事地区',
				'area' => '省市',
				'password_confirm' => '确认密码',
				'company_name' => '学校',
				'job'=>'职务',
				'contact' => '联系人姓名',
				'mobile' => '手机',
				'city' => '所在城市',
				'address'=>'通信地址',
				'idcard'=>'身份证号',
				'allowRegister' => '同意大赛注册协议',
				'email' => '邮箱',
		);
	}
	/**
	 * 返回用户名是否有人注册
	 *
	 * @param string $_username        	
	 * @return boolean
	 */
	public function _isExists($attribute_name) {
		$user = User::model ();
		if ($user->exists ( 'LOWER(username)=?', array (
				strtolower ( $this->$attribute_name ) 
		) )) {
			$this->addError ( 'username', '用户名已存在' );
			return false;
		} else {
			return true;
		}
	}
	/**
	 * 返回邮箱是否有人注册
	 *
	 * @param
	 *        	$attribute_name
	 * @return boolean
	 */
	public function _isExistsEmail($attribute_name) {
		$user = User::model ();
		if ($user->exists ( 'LOWER(email)=?', array (
				strtolower ( $this->$attribute_name ) 
		) )) {
			$this->addError ( 'email', '注册邮箱已存在' );
			return false;
		} else {
			return true;
		}
	}
	
	/**
	 * 验证两次密码是否正确
	 *
	 * @param string $_password_confirm        	
	 * @return boolean
	 */
	public function _password_confirm($attribute_name) {
		if ($this->password_confirm === $this->$attribute_name)
			return true;
		else {
			$this->addError ( 'password_confirm', '两次密码输入不同' );
			return false;
		}
	}
	
	/**
	 * 注册用户
	 *
	 * @return boolean
	 */
	public function register() {
		$user = new User ();
		$user->username = $this->username;
		$user->password = md5 ( $this->password );
		$user->email = $this->email;
		if ($user->validate ()) {
			
			$user->save ();
			$userProfile = new UserProfile ();
			$userProfile->Company_name = $this->company_name;
			$userProfile->Realname = $this->contact;
			$userProfile->Mobile = $this->mobile;
			$userProfile->Email = $this->email;
			$userProfile->ID = $user->id;
			$userProfile->District = $this -> district;
			$userProfile->User_category = $this->userType;
			$userProfile->City = $this->city;
			$userProfile->IDNum = $this -> idcard;
			$userProfile->address = $this -> address;
			$userProfile->job = $this -> job;
			if($userProfile-> validate()){
			$userProfile->save ();
			}else{
				var_dump($userProfile-> errors);
				die;
			}
			
			$adminUser = new AdminUser();
			$adminUser -> id =NULL;
			$adminUser -> uid =$user->id;
			$adminUser -> save();
			
			return true;
			
			
		} else {
			YII_DEBUG && var_dump ( $user->errors );
		}
	}
	
	/**
	 * Logs in the user using the given username and password in the model.
	 *
	 * @return boolean whether login is successful
	 */
	public function login() {
		if ($this->_identity === null) {
			$this->_identity = new UserIdentity ( $this->username, $this->password );
			$this->_identity->authenticate ();
		}
		if ($this->_identity->errorCode === UserIdentity::ERROR_NONE) {
			$duration = $this->rememberMe ? 3600 * 24 * 30 : 0; // 30 days
			Yii::app ()->user->login ( $this->_identity, $duration );
			return true;
		} else
			return false;
	}
}

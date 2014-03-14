<?php
/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class RegisterForm extends CFormModel {
	public $username;
	public $password;
	public $password_confirm;
	public $email;
	public $company_name;
	public $contact;
	public $mobile;
	public $district;
	public $area;
	public $city;
	public $gender;
	public $allowRegister;
	private $_identity;
	public $userType;
	public $nation;
	
	public $qq;
	public $idType;
	public $idNum;
	
	public $schoolName;
	
	public $schoolType;
	public $isSame;
	public $sid;
	public $majoy;
	
	public $degreeType;
	public $joinDate;
	
	public $beforeleave;
	
	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules() {
		return array (
				// username and password are required
				array (
						'district,area,username,allowRegister,password,password_confirm,email,contact,mobile,majoy,sid,isSame,idNum,idType,qq,joinDate,degreeType,schoolName,beforeleave',
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
				'1' => '学生',
				'4' => '老师',
				//'5' => '个人' 
		);
	}
	
	public function getGender_type(){
		return array(0=>'女',1=>'男');	
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
	 * 名族列表
	 */
	public function getNation_list(){
		return array ('汉族', '阿昌族', '保安族', '布朗族', '布依族', '白族', '朝鲜族', '德昂族', '独龙族', '达斡尔族', '东乡族', '侗族', '傣族', '鄂伦春族', '俄罗斯族', '鄂温克族', '高山族', '哈尼族', '哈萨克族', '回族', '赫哲族', '基诺族', '景颇族', '京族', '柯尔克孜族', '珞巴族', '傈僳族', '黎族', '拉祜族', '门巴族', '蒙古族', '毛南族', '满族', '苗族', '仫佬族', '纳西族', '怒族', '普米族', '羌族', '撒拉族', '水族', '畲族', '塔吉克族', '土家族', '塔塔尔族', '土族', '维吾尔族', '壮族', '乌孜别克族', '锡伯族', '裕固族', '彝族', '瑶族', '仡佬族', '佤族', '藏族' ,'其他');
	}
	
	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels() {
		return array (
				'username' => '用户名',
				'password' => '密码',
				'userType' => '用户类型',
				'nation' => '名族',
				'district' => '赛事地区',
				'area' => '省市',
				'password_confirm' => '确认密码',
				'company_name' => '机构名称',
				'contact' => '姓名',
				'qq'=>'QQ号',
				'originArea'=>'原省市',
				'schoolName'=>'就读学校',
				'idType'=>'身份证件类型',
				'idNum'=>'身份证件号',
				'schoolType','学位类型',
				'gender' =>'性别',
				'mobile' => '手机号码',
				'degreeType'=>'学位类型',
				'isSame'=>'攻读专业与前置专业是否一致',
				'majoy'=>'专业',
				'joinDate'=>'入学年月',
				'sid'=>'学号',
				'city' => '所在城市',
				'allowRegister' => '同意大赛注册协议',
				'email' => '邮箱',
				'beforeleave'=>'攻读前户口所在省市',
				'userType' 
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
	
	public function getSchoolArea(){
		$cde_shool_list = CdeSchoolList::model();
		//地区分类
		$cde_area_list = $cde_shool_list -> getArea();
		return $cde_area_list;
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
			$userProfile->qq = $this->qq;
			$userProfile->IDNum = $this ->idNum;
			$userProfile-> idType = $this -> idType;
			$userProfile-> schoolType = $this -> schoolType;
			$userProfile-> isSame = $this -> isSame;
			$userProfile-> sid = $this -> sid;
			$userProfile-> majoy = $this -> majoy;
			$userProfile-> degreeType = $this -> degreeType;
			$userProfile-> joinDate = $this -> joinDate;
			$userProfile->beforeleave = $this -> beforeleave;
			
			if($userProfile -> validate()){
				$userProfile->save ();
			}else{
				var_dump($userProfile -> errors);
				die;
			}
			/*
			$adminUser = new AdminUser();
			$adminUser -> id =NULL;
			$adminUser -> uid =$user->id;
			$adminUser -> save();*/
			
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

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
	
	public $MasterName='';
	public $MemberName='';
	
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
						'UID',
						'numerical',
						'integerOnly' => true 
				),
				array (
						'username',
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
						'ID, UID, username, name, create_time, state',
						'safe',
						'on' => 'search' 
				) 
		);
	}
	
	/**
	 * 是否可以创建团队
	 * @param integer $uid
	 */
	public function canBuild($uid){
		
		$model = new UserGroupMember();
		$model -> UID = $uid;
		$data = $model -> search();
		$data = $data -> data;
		
		if(!empty($data)){
			return false;
		}
		return true;
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
				),
				'product' => array (
						self::HAS_ONE,
						'UserProductGrade',
						'gid' 
				) 
		);
	}
	
	/**
	 *
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array (
				'ID' => '组ID',
				'UID' => '队长ID',
				'MasterName'=>'添加老师：自动补全',
				'MemberName'=>'添加成员：自动补全',
				'username' => '队长',
				'name' => '组名',
				'create_time' => '创建时间',
				'state' => '组状态' 
		);
	}
	
	/**
	 * 判断当前用户是不是队长
	 *
	 * @param int $uid        	
	 */
	public function isLeader($uid = false) {
		if ($this->UID) {
			return ($this->UID == $uid) ? true : false;
		} else {
			$model = $this->findByAttributes ( array (
					'UID' => $uid 
			) );
			return $model ? true : false;
		}
	}
	
	/**
	 * 
	 * @param integer $uid
	 */
	public function getGidByUID($uid){
		$criteria = new CDbCriteria();
		$criteria -> compare('UID', $uid);
		$criteria -> limit = 1;
		$data = $this -> find($criteria);
		return $data -> ID;
	}
	
	/**
	 * 
	 * @param integer $gid
	 */
	public function getTeacher($gid){
		$group_member = UserGroupMember::model();
		$member_list = $group_member -> getMember($gid);
		
		foreach ($member_list as $_member){
			if($_member -> profile -> User_category  =='4'){
				return $_member -> profile;
			}
		}
		return array();
	}
	
	/**
	 *
	 * @param integer $gid
	 */
	public function getMember($gid){
		$group_member = UserGroupMember::model();
		$member_list = $group_member -> getMember($gid);
	
		$ary_member = array();
		
		foreach ($member_list as $_member){
			if($_member -> profile -> User_category  =='1'){
				$ary_member [] =$_member -> profile;
			}
		}
		
		return $ary_member;
	}

	/**
	 * 
	 * @param integer $gid
	 */
	public function canAddTeacher($uid,$gid){
		$group_member = UserGroupMember::model();
		$member_list = $group_member -> getMember($gid);
		foreach ($member_list as $_member){
			if($_member -> profile -> User_category  =='4'){
				return false;
			}
		}
		$row = $group_member -> findByAttributes(array('UID'=>$uid));
		if(!$row){
			return true;
		}
	}
	
	/**
	 *
	 * @param integer $gid
	 */
	public function canAddMember($uid,$gid){
		$group_member = UserGroupMember::model();
		$row = $group_member -> findByAttributes(array('UID'=>$uid));
		if(!$row){
			return true;
		}
	}
	
	
	/**
	 * 获取用户组成员的链接
	 *
	 * @param String $txt        	
	 */
	public function getMemberLink($txt=false) {
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
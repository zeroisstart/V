<?php

/**
 * This is the model class for table "{{user_product_grade}}".
 *
 * The followings are the available columns in table '{{user_product_grade}}':
 * @property integer $ID
 * @property integer $uid
 * @property string $title
 * @property string $detail
 * @property string $text
 * @property string $doc
 * @property string $img
 * @property string $os
 * @property string $hard_driver
 * @property string $ep_num
 * @property integer $edit_count
 * @property integer $type
 * @property string $create_time
 */
class UserProductGrade extends CActiveRecord {
	
	/**
	 * Returns the static model of the specified AR class.
	 *
	 * @param string $className
	 *        	active record class name.
	 * @return UserProductGrade the static model class
	 */
	public static function model($className = __CLASS__) {
		return parent::model ( $className );
	}
	
	/**
	 *
	 * @return string the associated database table name
	 */
	public function tableName() {
		return '{{user_product_grade}}';
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
						'uid, edit_count, type',
						'numerical',
						'integerOnly' => true 
				),
				array (
						'title',
						'length',
						'max' => 255 
				),
				array (
						'doc',
						'file',
						'types' => array (
								'doc',
								'docx' 
						) 
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
				array (
						'detail',
						'length',
						'max' => 300 
				),
				array (
						'os, hard_driver, ep_num',
						'length',
						'max' => 45 
				),
				array (
						'text, create_time',
						'safe' 
				),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array (
						'ID, uid, gid, title, detail, text, doc, img, os, hard_driver, ep_num, edit_count, type, create_time',
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
						self::HAS_ONE,
						'UserGroup',
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
				'ID' => 'ID',
				'uid' => 'Uid',
				'gid' => '用户组 ID',
				'title' => '作品名称',
				'detail' => '介绍',
				'text' => '详情',
				'doc' => '文档上传',
				'img' => '作品图片',
				'os' => '操作系统',
				'hard_driver' => '硬件',
				'ep_num' => 'Ep Num',
				'edit_count' => '修改次数',
				'type' => 'Type',
				'create_time' => '提交时间' 
		);
	}
	/**
	 *
	 * @return NULL
	 */
	public function getTeamLeader() {
		$uid = $this->uid;
		$user = User::model ()->findByPk ( $uid );
		if (empty ( $user ))
			return null;
		return $user->username;
	}
	/**
	 *
	 * @return NULL
	 */
	public function getTeamName() {
		$gid = $this->gid;
		$group = UserGroup::model ()->findByPk ( $gid );
		if (empty ( $group ))
			return null;
		else
			return $group->name;
	}
	
	/**
	 *
	 * @return NULL Ambigous mixed, NULL, unknown, multitype:unknown Ambigous
	 *         <unknown, NULL> , CActiveRecord, multitype:unknown Ambigous
	 *         <CActiveRecord, NULL> , multitype:unknown >
	 */
	public function getTeamMembers() {
		$gid = $this->gid;
		$groupMember = UserGroupMember::model ();
		$members = $groupMember->findAllByAttributes ( array (
				'gid' => $gid,
				'state' => 1 
		) );
		if (empty ( $members ))
			return null;
		else
			return $members;
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
		$criteria->compare ( 'uid', $this->uid );
		$criteria->compare ( 'gid', $this->gid );
		$criteria->compare ( 'title', $this->title, true );
		$criteria->compare ( 'detail', $this->detail, true );
		$criteria->compare ( 'text', $this->text, true );
		$criteria->compare ( 'doc', $this->doc, true );
		$criteria->compare ( 'img', $this->img, true );
		$criteria->compare ( 'os', $this->os, true );
		$criteria->compare ( 'hard_driver', $this->hard_driver, true );
		$criteria->compare ( 'ep_num', $this->ep_num, true );
		$criteria->compare ( 'edit_count', $this->edit_count );
		$criteria->compare ( 'type', $this->type );
		$criteria->compare ( 'create_time', $this->create_time, true );
		
		return new CActiveDataProvider ( $this, array (
				'criteria' => $criteria 
		) );
	}
}
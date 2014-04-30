<?php

/**
 * This is the model class for table "{{user_group_book}}".
 *
 * The followings are the available columns in table '{{user_group_book}}':
 * @property string $id
 * @property integer $gid
 * @property string $bookimg
 * @property string $createdate
 * @property string $productname
 */
class UserGroupBook extends CActiveRecord
{
	
	public $_state = array('1'=>'成功','0'=>'未成功');
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserGroupBook the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user_group_book}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('gid', 'numerical', 'integerOnly'=>true),
			array('bookimg', 'length', 'max'=>255),
			//array('productname','length','max'=>60),
			array (
					'bookimg',
					'file',
					'maxSize'=>1024 * 512 * 1,
					'tooLarge'=>'上传文件超过 512KB，无法上传。',
					'types' => array (
							'jpg',
							'gif',
							'jpeg',
							'png'
					)
			),
			array('createdate,productname', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, gid, bookimg, createdate, productname, state', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'gid' => '组ID',
			'productname'=>'作品名称:',
			'bookimg' => '报名信息表:',
			'state'=>'状态',
			'createdate' => '提交时间',
		);
	}
	
	public function _img($_src){
		return "<a target='_blank' href=\"/img/$_src\" ><img class=\"bookimg\" src=\"/img/$_src\" ></a>";
	}
	

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('gid',$this->gid);
		$criteria->compare('bookimg',$this->bookimg,true);
		$criteria->compare('productname',$this->productname,true);
		$criteria->compare('createdate',$this->createdate,true);
		$criteria->compare('state',$this->state,true);
		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
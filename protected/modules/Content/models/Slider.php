<?php

/**
 * This is the model class for table "{{slider}}".
 *
 * The followings are the available columns in table '{{slider}}':
 * @property string $ID
 * @property integer $cate
 * @property string $title
 * @property string $img
 * @property string $state
 * @property string $create_time
 */
class Slider extends CActiveRecord {
	/**
	 * Returns the static model of the specified AR class.
	 *
	 * @param string $className
	 *        	active record class name.
	 * @return Slider the static model class
	 */
	public static function model($className = __CLASS__) {
		return parent::model ( $className );
	}
	
	/**
	 *
	 * @return string the associated database table name
	 */
	public function tableName() {
		return '{{slider}}';
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
						'cate',
						'numerical',
						'integerOnly' => true 
				),
				array (
						'title',
						'length',
						'max' => 128 
				),
				array (
						'img',
						'file',
						'types' => array (
								'jpg',
								'gif',
								'jpeg',
								'png' 
						) 
				),
				array (
						'state',
						'length',
						'max' => 1 
				),
				array (
						'create_time',
						'safe' 
				),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array (
						'ID, cate, title, img, state, create_time',
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
				'cate' => 'Cate',
				'title' => '标题',
				'img' => '图片上传',
				'state' => '状态',
				'create_time' => '创建时间' 
		);
	}
	
	/**
	 * 返回图片的HTML标签
	 *
	 * @return string
	 */
	public function getImgTag() {
		$accessUrl = Yii::app ()->params->imgAccessPath;
		$img = $this->img;
		return CHtml::image ( $accessUrl .'img/'. $img, $this->title,array('class'=>'fix_260_200') );
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
		$criteria->compare ( 'cate', $this->cate );
		$criteria->compare ( 'title', $this->title, true );
		$criteria->compare ( 'img', $this->img, true );
		$criteria->compare ( 'state', $this->state, true );
		$criteria->compare ( 'create_time', $this->create_time, true );
		
		$criteria->order = "create_time desc";
		
		return new CActiveDataProvider ( $this, array (
				'criteria' => $criteria 
		) );
	}
}
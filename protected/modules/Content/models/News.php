<?php

/**
 * This is the model class for table "news".
 *
 * The followings are the available columns in table 'news':
 * @property string $ID
 * @property string $UID
 * @property string $title
 * @property integer $category
 * @property string $text
 * @property string $photo
 * @property string $state
 * @property string $date
 * @property string $create_time
 *
 * The followings are the available model relations:
 * @property NewsAttachment[] $newsAttachments
 */
class News extends CActiveRecord {
	/**
	 * Returns the static model of the specified AR class.
	 *
	 * @param string $className
	 *        	active record class name.
	 * @return News the static model class
	 */
	public $pageSize = 20;
	public static function model($className = __CLASS__) {
		return parent::model ( $className );
	}
	
	/**
	 *
	 * @return string the associated database table name
	 */
	public function tableName() {
		return '{{news}}';
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
						'UID, title, text, state, date, create_time',
						'required' 
				),
				array (
						'category',
						'numerical',
						'integerOnly' => true 
				),
				array (
						'UID',
						'length',
						'max' => 11 
				),
				array (
						'title',
						'length',
						'max' => 250 
				),
				array (
						'photo',
						'length',
						'max' => 60 
				),
				array (
						'state',
						'length',
						'max' => 6 
				),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array (
						'ID, UID, title, category, text, photo, state, date, create_time',
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
				'newsAttachments' => array (
						self::HAS_MANY,
						'NewsAttachment',
						'news_id' 
				),
				'category_data' => array (
						self::HAS_MANY,
						'category_data',
						'sub_id' 
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
				'UID' => '用户名',
				'title' => '标题',
				'category' => '分类',
				'text' => 'Text',
				'photo' => 'Photo',
				'state' => '状态',
				'isRecommend' =>'首页推荐',
				'date' => 'Date',
				'create_time' => '创建时间' 
		);
	}
	public function getUsername() {
		return User::model ()->getNameByID ( $this->UID );
	}
	
	/**
	 *
	 * @return multitype:NULL
	 */
	public function getAllCate() {
		$criteria = new CDbCriteria ();
		$criteria->compare ( 'type', '1' );
		
		$models = Category::model ()->findAll ( $criteria );
		$data = array ();
		
		foreach ( $models as $model ) {
			$data [$model->ID] = $model->title;
		}
		
		return $data;
	}
	/**
	 * 能否被删除
	 *
	 * @return boolean
	 */
	public function canDelete() {
		return true;
	}
	
	/**
	 * 获取所有的分类
	 *
	 * @return multitype:unknown
	 */
	public function getCateText() {
		$category_model = $this->category_data;
		// var_dump($this -> attributes);
		$titles = array ();
		foreach ( $category_model as $key => $val ) {
			$titles [$val->cate_id] = $val->cate->title;
		}
		return empty ( $titles ) ? '其他' : implode ( ' ', $titles );
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
		$criteria->compare ( 'UID', $this->UID, true );
		$criteria->compare ( 'title', $this->title, true );
		$criteria->compare ( 'category', $this->category );
		$criteria->compare ( 'text', $this->text, true );
		$criteria->compare ( 'photo', $this->photo, true );
		$criteria->compare ( 'state', $this->state, true );
		$criteria->compare ( 'date', $this->date, true );
		$criteria->compare ( 'create_time', $this->create_time, true );
		$criteria->order = "create_time desc";
		
		$criteria->addCondition ( 'category<>4' );
		
		return new CActiveDataProvider ( $this, array (
				'criteria' => $criteria,
				'pagination' => array (
						'pageSize' => $this->pageSize 
				) 
		) );
	}
	/**
	 * 获取推荐的文章
	 *
	 * @return string
	 */
	public function getRecommendNews() {
		$criteria = new CDbCriteria ();
		$criteria->compare ( 'isRecommend', '1' );
		$criteria->compare ( 'category', $this->category );
		$criteria->compare ( 'state', 'active' );
		$criteria->order = 'create_time desc';
		$criteria->limit = 1;
		return $this->find ( $criteria );
	}
	
	/**
	 * 返回激活屏蔽的文本
	 *
	 * @return Ambigous <string>
	 */
	public function getStateText() {
		$ary_value = array (
				'active' => '活动',
				'hidden' => '隐藏' 
		);
		
		return $ary_value [$this->state];
	}
	
	/**
	 * 获取news对应的路径地址
	 *
	 * @return string
	 */
	public function getUrl() {
		return Yii::app ()->createUrl ( '/news/' . $this->ID );
	}
}
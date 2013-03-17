<?php

/**
 * This is the model class for table "category_data".
 *
 * The followings are the available columns in table 'category_data':
 * @property integer $ID
 * @property integer $cate_id
 * @property integer $sub_id
 *
 * The followings are the available model relations:
 * @property Category $cate
 */
class Category_Data extends CActiveRecord {
	/**
	 * Returns the static model of the specified AR class.
	 * 
	 * @param string $className
	 *        	active record class name.
	 * @return Category_Data the static model class
	 */
	public static function model($className = __CLASS__) {
		return parent::model ( $className );
	}
	
	/**
	 *
	 * @return string the associated database table name
	 */
	public function tableName() {
		return '{{category_data}}';
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
						'cate_id, sub_id',
						'required' 
				),
				array (
						'cate_id, sub_id',
						'numerical',
						'integerOnly' => true 
				),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array (
						'ID, cate_id, sub_id',
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
				'cate' => array (
						self::BELONGS_TO,
						'Category',
						'cate_id' 
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
				'cate_id' => 'Cate',
				'sub_id' => 'Sub' 
		);
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
		$criteria->compare ( 'cate_id', $this->cate_id );
		$criteria->compare ( 'sub_id', $this->sub_id );
		
		return new CActiveDataProvider ( $this, array (
				'criteria' => $criteria 
		) );
	}
}
<?php

/**
 * This is the model class for table "cde_school_list".
 *
 * The followings are the available columns in table 'cde_school_list':
 * @property string $id
 * @property string $item
 * @property string $district
 * @property string $cde
 * @property string $title
 */
class CdeSchoolList extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CdeSchoolList the static model class
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
		return 'cde_school_list';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('item', 'length', 'max'=>10),
			array('district', 'length', 'max'=>255),
			array('cde', 'length', 'max'=>20),
			array('title', 'length', 'max'=>120),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, item, district, cde, title', 'safe', 'on'=>'search'),
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
			'item' => 'Item',
			'district' => 'District',
			'cde' => 'Cde',
			'title' => 'Title',
		);
	}
	
	public function getList(){
		
	}
	
	public function getArea(){
		$criteria = new CDbCriteria();
		$criteria -> select =array('item','district');
		$criteria -> group ='item';
		$data = $this -> findAll($criteria);
		$ary = array();
		foreach($data as $_model){
			$ary [$_model['item']] = $_model -> district;
		}
		return $ary;
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
		$criteria->compare('item',$this->item,true);
		$criteria->compare('district',$this->district,true);
		$criteria->compare('cde',$this->cde,true);
		$criteria->compare('title',$this->title,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
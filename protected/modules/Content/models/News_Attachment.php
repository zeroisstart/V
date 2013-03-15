<?php

/**
 * This is the model class for table "news_attachment".
 *
 * The followings are the available columns in table 'news_attachment':
 * @property string $ID
 * @property string $news_id
 * @property string $name
 * @property string $file_size
 * @property string $file_path
 * @property string $date
 *
 * The followings are the available model relations:
 * @property News $news
 */
class News_Attachment extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return News_Attachment the static model class
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
		return '{{news_attachment}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID, news_id, name, file_size, file_path, date', 'required'),
			array('ID, news_id, file_size', 'length', 'max'=>11),
			array('name', 'length', 'max'=>200),
			array('file_path', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, news_id, name, file_size, file_path, date', 'safe', 'on'=>'search'),
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
			'news' => array(self::BELONGS_TO, 'News', 'news_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'news_id' => 'News',
			'name' => 'Name',
			'file_size' => 'File Size',
			'file_path' => 'File Path',
			'date' => 'Date',
		);
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

		$criteria->compare('ID',$this->ID,true);
		$criteria->compare('news_id',$this->news_id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('file_size',$this->file_size,true);
		$criteria->compare('file_path',$this->file_path,true);
		$criteria->compare('date',$this->date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
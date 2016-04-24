<?php

/**
 * This is the model class for table "sacred_news_img".
 *
 * The followings are the available columns in table 'sacred_news_img':
 * @property integer $img_id
 * @property string $img_name
 * @property integer $img_size
 * @property string $img_ext
 * @property integer $news_id
 * @property string $img_updatedate
 *
 * The followings are the available model relations:
 * @property SacredNews $news
 */
class SacredNewsImg extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sacred_news_img';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('img_name, img_size, img_ext, news_id, img_updatedate', 'required'),
			array('img_size, news_id', 'numerical', 'integerOnly'=>true),
			array('img_name', 'length', 'max'=>255),
			array('img_ext', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('img_id, img_name, img_size, img_ext, news_id, img_updatedate', 'safe', 'on'=>'search'),
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
			'news' => array(self::BELONGS_TO, 'SacredNews', 'news_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'img_id' => 'Img',
			'img_name' => 'Img Name',
			'img_size' => 'Img Size',
			'img_ext' => 'Img Ext',
			'news_id' => 'News',
			'img_updatedate' => 'Img Updatedate',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('img_id',$this->img_id);
		$criteria->compare('img_name',$this->img_name,true);
		$criteria->compare('img_size',$this->img_size);
		$criteria->compare('img_ext',$this->img_ext,true);
		$criteria->compare('news_id',$this->news_id);
		$criteria->compare('img_updatedate',$this->img_updatedate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SacredNewsImg the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

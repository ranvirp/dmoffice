<?php

/**
 * This is the model class for table "census_village".
 *
 * The followings are the available columns in table 'census_village':
 * @property string $code
 * @property string $name_en
 * @property string $name_hi
 * @property string $subsdistrict_code
 * @property string $census2001_code
 * @property string $census2011_code
 */
class CensusVillage extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'census_village';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('code, name_en, subsdistrict_code, census2001_code, census2011_code', 'required'),
			array('code, census2011_code', 'length', 'max'=>7),
			array('name_en, name_hi', 'length', 'max'=>200),
			array('subsdistrict_code', 'length', 'max'=>4),
			array('census2001_code', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('code, name_en, name_hi, subsdistrict_code, census2001_code, census2011_code', 'safe', 'on'=>'search'),
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
			'code' => Yii::t('app','Code'),
			'name_en' => Yii::t('app','Name En'),
			'name_hi' => Yii::t('app','Name Hi'),
			'subsdistrict_code' => Yii::t('app','Subsdistrict Code'),
			'census2001_code' => Yii::t('app','Census2001 Code'),
			'census2011_code' => Yii::t('app','Census2011 Code'),
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

		$criteria->compare('code',$this->code,true);
		$criteria->compare('name_en',$this->name_en,true);
		$criteria->compare('name_hi',$this->name_hi,true);
		$criteria->compare('subsdistrict_code',$this->subsdistrict_code,true);
		$criteria->compare('census2001_code',$this->census2001_code,true);
		$criteria->compare('census2011_code',$this->census2011_code,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CensusVillage the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	/**
	* Returns all models in List of primary key,name format
	*/
	public static function listAll($className=__CLASS__)
	{
	    $lang = Yii::app()->language;
        $models = $className::model()->findAll();
        $pk = $className::model()->tableSchema->primaryKey;
        // format models resulting using listData     
        $list = CHtml::listData($models, $pk, 'name_'.$lang);
        return $list;
	}
        /**
	* Returns all models in List of primary key,name format
	*/
	public static function listAllJson($className=__CLASS__)
	{
	    $lang = Yii::app()->language;
        $models = $className::model()->findAll();
        $pk = $className::model()->tableSchema->primaryKey;
        // format models resulting using listData     
        $list = CHtml::listData($models, $pk, 'name_'.$lang);
        return json_encode($list);
	}
}

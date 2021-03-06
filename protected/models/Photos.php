<?php

/**
 * This is the model class for table "photos".
 *
 * The followings are the available columns in table 'photos':
 * @property integer $id
 * @property string $bwid
 * @property double $gpslat
 * @property double $gpslong
 * @property integer $gpsacc
 * @property string $photourl
 */
class Photos extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'photos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('bwid, gpslat, gpslong, gpsacc, photourl', 'required'),
			array('gpsacc', 'numerical', 'integerOnly'=>true),
			array('gpslat, gpslong', 'numerical'),
			array('bwid', 'length', 'max'=>200),
			array('photourl', 'length', 'max'=>1000),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, bwid, gpslat, gpslong, gpsacc, photourl', 'safe', 'on'=>'search'),
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
			'id' => Yii::t('app','ID'),
			'bwid' => Yii::t('app','Bwid'),
			'gpslat' => Yii::t('app','Gpslat'),
			'gpslong' => Yii::t('app','Gpslong'),
			'gpsacc' => Yii::t('app','Gpsacc'),
			'photourl' => Yii::t('app','Photourl'),
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

		$criteria->compare('id',$this->id);
		$criteria->compare('bwid',$this->bwid,true);
		$criteria->compare('gpslat',$this->gpslat);
		$criteria->compare('gpslong',$this->gpslong);
		$criteria->compare('gpsacc',$this->gpsacc);
		$criteria->compare('photourl',$this->photourl,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Photos the static model class
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
        //$pk = $className::model()->tableSchema->primaryKey;
        // format models resulting using listData     
        //$list = CHtml::listData($models, $pk, 'name_'.$lang);
        $list=array();
        foreach ($models as $model)
        {
            $list[]=$model->attributes;
        }
        return json_encode($list);
	}
        
}

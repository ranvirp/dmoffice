<?php

/**
 * This is the model class for table "instructions".
 *
 * The followings are the available columns in table 'instructions':
 * @property integer $id
 * @property integer $schemeid
 * @property string $sender
 * @property integer $receiver
 * @property string $instruction
 * @property integer $stat
 * @property string $attachments
 * @property integer $parentinst
 */
class Instructions extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'instructions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sender, receiver, instruction', 'required'),
			array('schemeid, receiver, stat, parentinst', 'numerical', 'integerOnly'=>true),
			array('sender', 'length', 'max'=>10),
			array('attachments', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, schemeid, sender, receiver, instruction, stat,  parentinst', 'safe', 'on'=>'search'),
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
                    'scheme'=>array(self::BELONGS_TO,'Schemes','schemeid'),
                    'senderDesignation'=>array(self::BELONGS_TO,'Designation','sender'),
                     'receiverDesignation'=>array(self::BELONGS_TO,'Designation','receiver'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('app','ID'),
			'schemeid' => Yii::t('app','Schemeid'),
			'sender' => Yii::t('app','Sender'),
			'receiver' => Yii::t('app','Receiver'),
			'instruction' => Yii::t('app','Instruction'),
			'stat' => Yii::t('app','Stat'),
			'attachments' => Yii::t('app','Attachments'),
			'parentinst' => Yii::t('app','Parentinst'),
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
		$criteria->compare('schemeid',$this->schemeid);
		$criteria->compare('sender',$this->sender,true);
		$criteria->compare('receiver',$this->receiver);
		$criteria->compare('instruction',$this->instruction,true);
		$criteria->compare('stat',$this->stat);
		$criteria->compare('attachments',$this->attachments,true);
		$criteria->compare('parentinst',$this->parentinst);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Instructions the static model class
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

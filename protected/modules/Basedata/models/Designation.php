<?php

/***
 * This is the model class for table "Designation".
 *
 * The followings are the available columns in table 'Designation':
 * @property integer $id
 * @property integer $designation_type_id
 * @property integer $level_type_id
 * @property varchar $district_code
 *
 * The followings are the available model relations:
 * @property DesignationType $designationType
 * @property DesignationUser[] $designationUsers
 * @property District
 */
class Designation extends CActiveRecord {

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'Designation';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('designation_type_id, level_type_id', 'required'),
			array('designation_type_id', 'numerical', 'integerOnly' => true),
			array('district_code', 'length', 'max' => 5),
                    array('level_type_id', 'length', 'max' => 10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array(' designation_type_id, level_type_id', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'designationType' => array(self::BELONGS_TO, 'DesignationType', 'designation_type_id'),
			'designationUsers' => array(self::HAS_MANY, 'DesignationUser', 'designation_id'),
			'district' => array(self::BELONGS_TO, 'District', 'district_code'),
			         
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'designation_type_id' => Yii::t('app', 'Designation Type'),
			'level_type_id' => Yii::t('app', 'Level Type'),
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
	public function search() {
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('designation_type_id', $this->designation_type_id);
		$criteria->compare('level_type_id', $this->level_type_id);

		return new CActiveDataProvider($this, array(
				'criteria' => $criteria,
			));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Designation the static model class
	 */
	public static function model($className = __CLASS__) {
		return parent::model($className);
	}

	/**
	 * Returns all models in List of primary key,name format
	 */
	public static function listAll($className = __CLASS__) {
		$lang = Yii::app()->language;
		$models = $className::model()->findAll();
		$pk = $className::model()->tableSchema->primaryKey;
		// format models resulting using listData     
		$list = CHtml::listData($models, $pk, 'name_' . $lang);
		return $list;
	}

	/**
	 * Returns all models in List of primary key,name format
	 */
	public static function listAllJson($className = __CLASS__) {
		$lang = Yii::app()->language;
		$models = $className::model()->findAll();
		$pk = $className::model()->tableSchema->primaryKey;
		// format models resulting using listData     
		$list = CHtml::listData($models, $pk, 'name_' . $lang);
		return json_encode($list);
	}

	public static function getByType1($id, $dist) {
		$designations = Designation::model()->with('designationType')->findAllByAttributes(array('designation_type_id' => $id, 'district_code' => $dist));
		$lang = Yii::app()->language;
		$name = "name_" . $lang;
		$x = array();
		foreach ($designations as $designation) {
			$levelmodel = Level::model()->findByPk($designation->designationType->level_id);
			$table = $levelmodel->table_name;

			$x[$designation->id] = $table::model()->findByPk($designation->level_type_id)->$name;
		}
		return $x;
	}
        public static function getByType($id, $dist) {
            /*
		$designations = Designation::model()->with('designationType')->findAllByAttributes(array('designation_type_id' => $id, 'district_code' => $dist));
		$lang = Yii::app()->language;
		$name = "name_" . $lang;
		$x = array();
		foreach ($designations as $designation) {
			$levelmodel = Level::model()->findByPk($designation->designationType->level_id);
			$table = $levelmodel->table_name;

			$x[$designation->id] = $table::model()->findByPk($designation->level_type_id)->$name;
		}
		return $x;
             * *
             */
            return Utility::listAllByAttributes('Designation', array('designation_type_id' => $id, 'district_code' => $dist));
	}

	public static function getLevelsByType($id, $dist) {
		$lang = Yii::app()->language;
		$levelmodel = DesignationType::model()->findBYPk($id)->level->table_name;
		if ($levelmodel === 'district')
			return TbHtml::listData(District::model()->findAllByAttributes(array('code' => $dist)), 'code', 'name_' . $lang);
		//List only those levels which are residing in the district of the current user

		return Utility::listAllByAttributes($levelmodel, array('district_code' => $dist));
	}

	public static function getDesignationByUser($userid) {
		$designationUser = DesignationUser::model()->findByAttributes(array('user_id' => $userid), array('order' => 'create_time DESC'));
		if ($designationUser)
                return $designationUser->designation_id;
                else
                    return 0;
	}

	public static function getDesignationModelByUser($userid) {
		$designationUser = DesignationUser::model()->findByAttributes(array('user_id' => $userid), array('order' => 'create_time DESC'));
		if ($designationUser)
                return Designation::model()->findByPk($designationUser->designation_id);
                else 
                    return null;
	}

	public static function getUserByDesignation($designation_id) {
		$designationUser = DesignationUser::model()->findByAttributes(array('designation_id' => $designation_id), array('order' => 'create_time DESC'));
		if ($designationUser)
                return $designationUser->user_id;
                else 
                    return null;
	}
        

	public static function getLocationByUser() {
		$designation = Designation::model()->findByPk(Designation::getDesignationByUser(Yii::app()->user->id));
                if ($designation)
		return array('locationtype' => Level::model()->findByPk($designation->designationType->level_id)->name_en,
			'location_id' => $designation->level_type_id);
                else
                    return null;
	}
        public static function getUserName($id) {
            $designationUser = DesignationUser::model()->findByAttributes(array('designation_id' => $id), array('order' => 'create_time DESC'));
            $user=User::model()->findByPk($designationUser->user_id);
            
            if ($user)
	    return $user->profile->firstname." ".$user->profile->lastname;
            else 
                return null;
        }
        public static function createDesignations()
        {
            foreach (DesignationType::model()->findAll() as $model)
            {
                $level = $model->level->class_name;
                foreach ($level::model()->findAll() as $level1)
                {
                    $designation=Designation::model()->findByAttributes(array('designation_type_id'=>$model->id,'level_type_id'=>$level1->code));
                    if (!$designation)
                    $designation=new Designation();
                    $designation->designation_type_id=$model->id;
                    $designation->level_type_id=$level1->code;
                    if ($level!='District')
                    $designation->district_code=$level1->district_code;
                    else 
                        $designation->district_code=$level1->code;
                    try
                    {
                        $designation->save();
                        print $designation->id."\n";
                    } catch (Exception $ex) {
                        print "exception \n";

                    }
                }
            }
        }
        protected function beforeSave()
        {
            if ( parent::beforeSave())
            {
			try{
								$designation_name_en=$this->designationType->name_en;
                                $level_name=  $this->designationType->level->class_name;
                                $place_name=$level_name::model()->findByPK($this->level_type_id);
								$place_name=$place_name?$place_name->name_en:"missing";
                                $this->name_en=$designation_name_en.",".$place_name;
                                $designation_name_hi=$this->designationType->name_hi;
                                $level_name=  $this->designationType->level->class_name;
                                $place_name=$level_name::model()->findByPK($this->level_type_id);
								$place_name=$place_name?$place_name->name_hi:"missing";
                                $this->name_hi=$designation_name_hi.",".$place_name;
          return true;
		  } catch(Exception $e)
		  {
		  return false;
		  }
            }
            else return false;
            }

}

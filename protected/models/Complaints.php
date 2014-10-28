<?php

/**
 * This is the model class for table "complaints".
 *
 * The followings are the available columns in table 'complaints':
 * @property integer $id
 * @property string $complainants
 * @property string $oppositions
 * @property string $complainantmobileno
 * @property string $oppositionmobileno
 * @property string $revenuevillage
 * @property integer $policestation
 * @property integer $category
 * @property string $description
 * @property string $nextdateofaction
 * @property string $officerassigned
 * @property integer $status
 * @property integer $created_by
 * @property integer $created_at
 * @property integer $updated_by
 * @property integer $updated_at
 */
class Complaints extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'complaints';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('complainants, oppositions, complainantmobileno, revenuevillage, policestation, category, description, nextdateofaction', 'required'),
			array('policestation, category, status, created_by, created_at, updated_by, updated_at', 'numerical', 'integerOnly'=>true),
			array('complainants, oppositions', 'length', 'max'=>1500),
			array('complainantmobileno, oppositionmobileno', 'length', 'max'=>13),
			array('revenuevillage', 'length', 'max'=>11),
			array('nextdateofaction', 'length', 'max'=>200),
			array('officerassigned', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, complainants, oppositions, complainantmobileno, oppositionmobileno, revenuevillage, policestation, category, description, nextdateofaction, officerassigned, status, created_by, created_at, updated_by, updated_at', 'safe', 'on'=>'search'),
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
                     'categoryName' => array(SELF::BELONGS_TO, 'Complaintcategories', 'category'),
            'revVillage' => array(SELF::BELONGS_TO, 'RevenueVillage', 'revenuevillage'),
            'thana' => array(self::BELONGS_TO, 'Policestation', 'policestation'),
                    'replies'=>array(self::HAS_MANY,'Replies','content_type_id','condition'=>'replies.content_type=\'complaints\'','order'=>'replies.create_time DESC'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('app','ID'),
			'complainants' => Yii::t('app','Complainants'),
			'oppositions' => Yii::t('app','Oppositions'),
			'complainantmobileno' => Yii::t('app','Complainantmobileno'),
			'oppositionmobileno' => Yii::t('app','Oppositionmobileno'),
			'revenuevillage' => Yii::t('app','Revenuevillage'),
			'policestation' => Yii::t('app','Policestation'),
			'category' => Yii::t('app','Category'),
			'description' => Yii::t('app','Description'),
			'nextdateofaction' => Yii::t('app','Nextdateofaction'),
			'officerassigned' => Yii::t('app','Officerassigned'),
			'status' => Yii::t('app','Status'),
			'created_by' => Yii::t('app','Created By'),
			'created_at' => Yii::t('app','Created At'),
			'updated_by' => Yii::t('app','Updated By'),
			'updated_at' => Yii::t('app','Updated At'),
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
		$criteria->compare('complainants',$this->complainants,true);
		$criteria->compare('oppositions',$this->oppositions,true);
		$criteria->compare('complainantmobileno',$this->complainantmobileno,true);
		$criteria->compare('oppositionmobileno',$this->oppositionmobileno,true);
		$criteria->compare('revenuevillage',$this->revenuevillage,true);
		$criteria->compare('policestation',$this->policestation);
		$criteria->compare('category',$this->category);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('nextdateofaction',$this->nextdateofaction,true);
		$criteria->compare('officerassigned',$this->officerassigned,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('created_at',$this->created_at);
		$criteria->compare('updated_by',$this->updated_by);
		$criteria->compare('updated_at',$this->updated_at);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Complaints the static model class
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
          public static function getColumns($buttoncolumns=false,$policestation=true,$revenuevillage=true)
    {
     $category = '"<b>".Complaintcategories::model()->findByPk($data->category)->name_hi."</b><br>"';
     $description='."<br>".$data->description';
     $complainant='$data->complainants."<br/>".$data->complainantmobileno';
      $opposition='$data->oppositions."<br/> ".$data->oppositionmobileno';
      $disposed='"<b>Disposed:</b>".$data->status?Yii::t(\'app\',\'Yes\'):Yii::t(\'app\',\'No\')';
     $nextdate='$data->nextdateofaction';
     $columns= array();
      $columns[]=  array(
          'name'=>'officerassigned',
          'value'=>'Designation::model()->findByPk($data->officerassigned)->name_hi',
      );
       if ($revenuevillage)
         $columns[]=   array(
		'name'=>'revenuevillage',
                'value'=>  'RevenueVillage::model()->findByPk($data->revenuevillage)->name_hi.",".Tehsil::model()->findByPk(RevenueVillage::model()->findByPk($data->revenuevillage)->tehsil_code)->name_hi',
              
                );
            
     
         $columns[]=  array(
         'header'=>'Complaint Details',
         'value'=>$category.$description,
         'type'=>'raw'
     );
      $columns[]=   array('name'=>'complainants','type'=>'raw','value'=>$complainant);
	$columns[]=array('name'=>	'oppositions','type'=>'raw','value'=>$opposition);
       
       
        $columns[]=array('header'=>'Last Action','value'=>
            
            function($data,$row,$column)
        {
           if (Replies::lastReply('Complaints', $data->id))
            return $column->grid->owner->renderPartial("/complaints/_reply",array("reply"=>Replies::lastReply("Complaints",$data->id)));    
    else return "No Action taken so far";
        });
     $columns[]=  array(
         'header'=>'Status',
        // 'value'=>'"Disposed".'.$disposed.'."Pending in court ".'.$courtstatus.'."<br/> Stay Order ".'.$stayorder.'."<br/>Police Required ".'.$policerequired,
         'value'=>function($data)
     {
         $disposed1=$data->status?Yii::t('app','Yes'):Yii::t('app','No');
         $nextdate=$data->nextdateofaction;
         return "<b>Disposed:</b>".$disposed1
                 ."<br/>Next date of Action:<div id='$data->id' class=\"edit\">".$nextdate."</div>";
     },
         'type'=>'raw',
     );
     if ($buttoncolumns)
         $columns[]=array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
                        'buttons'=>array(
                            'reply'=>array(
                                'label'=>'Add Action/Reply',
                                'url'=>'Yii::app()->createUrl("/replies/create/content_type/complaints/content_type_id/".$data->id)'
                            
                        )),
             'template'=>'{view}{update}{reply}',
		);
     return $columns;
    }
        public static function report($type)
    {
        $model=new Complaints;
        
       
        if (strcmp('of',$type)==0)
        {
            $array=
            
            array(
                'attributes'=>array(
                      'officerassigned',
                 ),
                 'defaultOrder' => 'officerassigned',  
            );
                
        }  else  if (strcmp('rv',$type)==0){
           $array=
            
            array(
                'attributes'=>array(
                      'revenuevillage',
                 ),
                 'defaultOrder' => 'revenuevillage',  
            );
               
        }
        return new CActiveDataProvider($model, array(
            
            'sort'=>$array,
            //'criteria' => $criteria,
            'pagination'=>false,
        ));
    }
    public function getSMSDetails() {
        $PhNo = '91' . $this->complainantmobileno;
        if ($this->oppositionmobileno) 
            $PhNo.= ',' . '91' . $this->oppositionmobileno;
        //get Officer Mobile No
        $officerUser = User::model()->findByPk(Designation::getUserByDesignation($this->officerassigned));
        if ($officerUser && $officerUser->profile) {
            $mobileNo = $officerUser->profile->mobile;
            $PhNo.=',91' . $mobileNo;
        }
        $text = "Complaint Id:".$this->id."\n";
        $text.="Village:" . $this->revVillage->name_hi . ',' . $this->revVillage->tehsilCode->name_hi . "\n";
        $text.="Category:" . $this->categoryName->name_hi . "\n";
        $text.="Complainanant:" . $this->complainants . " " . $this->complainantmobileno;
        return array('PhNo' => $PhNo, 'text' => $text);
    }

}

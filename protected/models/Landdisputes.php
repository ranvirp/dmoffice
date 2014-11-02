<?php

/**
 * This is the model class for table "landdisputes".
 *
 * The followings are the available columns in table 'landdisputes':
 * @property integer $id
 * @property string $complainants
 * @property string $oppositions
 * @property string $complainantmobileno
 * @property string $oppositionmobileno
 * @property integer $revenuevillage
 * @property integer $policestation
 * @property string $gatanos
 * @property integer $category
 * @property string $description
 * @property integer $courtcasepending
 * @property string $courtcasedetails
 * @property integer $policerequired
 * @property string $nextdateofaction
 * @property integer $disputependingfor
 * @property integer $casteorcommunal
 * @property integer $prevreferencetype
 * @property string $prevreferenceno
 */
class Landdisputes extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'landdisputes';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('complainants, oppositions, revenuevillage, policestation,complainantmobileno, gatanos, category, description, courtcasepending, policerequired,  disputependingfor, casteorcommunal', 'required'),
            array('revenuevillage, policestation, category, courtcasepending, policerequired,prevreferencetype, disputependingfor, casteorcommunal', 'numerical', 'integerOnly' => true),
            array('complainants, oppositions', 'length', 'max' => 100),
            array('gatanos,courtname,nextdateofaction,prevreferenceno,stayexists', 'length', 'max' => 220),
            array('courtcasedetails', 'length', 'max' => 1000),
            array('nextdateofaction', 'length', 'max' => 200),
            array('complainantmobileno', 'length', 'max' => 13),
            array('oppositionmobileno', 'length', 'max' => 13),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('complainants, oppositions, revenuevillage, policestation, gatanos, category, description, courtcasepending,courtname,stayexists, courtcasedetails, policerequired,officerassigned, nextdateofaction, disputependingfor, casteorcommunal,prevreferencetype,prevreferenceno', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'categoryName' => array(SELF::BELONGS_TO, 'Complaintcategories', 'category'),
            'revVillage' => array(SELF::BELONGS_TO, 'RevenueVillage', 'revenuevillage'),
            'thana' => array(self::BELONGS_TO, 'Policestation', 'policestation'),
            'replies'=>array(self::HAS_MANY,'Replies','content_type_id','condition'=>'replies.content_type=\'landdisputes\'','order'=>'replies.create_time DESC'),
			
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'complainants' => Yii::t('app', 'Complainants'),
            'oppositions' => Yii::t('app', 'Oppositions'),
            'complainantmobileno' => Yii::t('app', 'Complainants Mobile No'),
            'oppositionmobileno' => Yii::t('app', 'Opposition Mobile No'),
            'revenuevillage' => Yii::t('app', 'Revenuevillage'),
            'policestation' => Yii::t('app', 'Policestation'),
            'gatanos' => Yii::t('app', 'Gatanos'),
            'category' => Yii::t('app', 'Category'),
            'description' => Yii::t('app', 'Description'),
            'courtcasepending' => Yii::t('app', 'Is a case pending in court?'),
            'stayexists' => Yii::t('app', 'Is there a stay in court?'),
            'stayorders' => Yii::t('app', 'Stay Orders'),
            'courtname' => Yii::t('app', 'Courtname'),
            'courtcasedetails' => Yii::t('app', 'Details of Court Case'),
            'policerequired' => Yii::t('app', 'Is Police Required?'),
            'nextdateofaction' => Yii::t('app', 'Proposed Date Of Action'),
            'disputependingfor' => Yii::t('app', 'Dispute pending for?'),
            'casteorcommunal' => Yii::t('app', 'Caste Or Communal Angle?'),
             'prevreferenceno' => Yii::t('app', 'Prev. Reference No'),
             'prevreferencetype' => Yii::t('app', 'Prev. Reference Type'),
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
        $criteria->compare('complainants', $this->complainants, true);
        $criteria->compare('oppositions', $this->oppositions, true);
        $criteria->compare('revenuevillage', $this->revenuevillage);
        $criteria->compare('policestation', $this->policestation);
        $criteria->compare('gatanos', $this->gatanos, true);
        $criteria->compare('category', $this->category);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('courtcasepending', $this->courtcasepending);
        $criteria->compare('courtcasedetails', $this->courtcasedetails, true);
        $criteria->compare('policerequired', $this->policerequired);
        $criteria->compare('nextdateofaction', $this->nextdateofaction, true);
         $criteria->compare('officerassigned', $this->officerassigned, true);
        $criteria->compare('disputependingfor', $this->disputependingfor);
        $criteria->compare('casteorcommunal', $this->casteorcommunal);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
    public static function report($type)
    {
        $model=new Landdisputes;
        $criteria = new CDbCriteria;
       
        if (strcmp('thana',$type)==0)
        {
            $array=
            
            array(
                'attributes'=>array(
                      'policestation',
                 ),
                 'defaultOrder' => 'policestation',  
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

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Landdisputes the static model class
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

    public function getSMSDetails() {
        $PhNo = '91' . $this->complainantmobileno . ',' . '91' . $this->oppositionmobileno;
        //get Officer Mobile No
        $officerUser = User::model()->findByPk(Designation::getUserByDesignation($this->officerassigned));
        if ($officerUser && $officerUser->profile) {
            $mobileNo = $officerUser->profile->mobile;
            $PhNo.=',91' . $mobileNo;
        }
        $sho = Designation::model()->findByAttributes(array('designation_type_id' => 9, 'level_type_id' => $this->policestation));
        $shoUser = $sho?User::model()->findByPk(Designation::getUserByDesignation($sho->id)):null;
        ;
        if ($shoUser && $shoUser->profile) {
            $mobileNo = $shoUser->profile->mobile;
            $PhNo.=',91' . $mobileNo;
        }
        //$PhNo.=',919454417521';
        $text = "";
        if (strcmp($this->complainantmobileno[0],'9')==0)
                $x='Nine';
        else 
            $x= $this->complainantmobileno[0];
         $text=Yii::t('app',"From").":".$this->complainants."-$x".substr($this->complainantmobileno,1)."\n";
       
        $text.=Yii::t('app',"Revenuevillage") .':'. $this->revVillage->name_hi . ',' . $this->revVillage->tehsilCode->name_hi . "\n";
        $text.=Yii::t('app',"Policestation").':' . $this->thana->name_hi . "\n";
        $text.=Yii::t('app',"Category").':' . $this->categoryName->name_hi . "\n";
         $text.=$this->description . "\n";
        $text.=Yii::t('app',"Gatanos").':' . $this->gatanos;
       // $text.="Complainanant:" . $this->complainants . " " . $this->complainantmobileno;
        return array('PhNo' => $PhNo, 'text' => $text);
    }
    public static function getColumns($buttoncolumns=false,$policestation=true,$revenuevillage=true)
    {
     $category = '"<b>".Complaintcategories::model()->findByPk($data->category)->name_hi."</b><br>"';
     $description='."<br>".$data->description';
     $complainant='$data->complainants."<br/>".$data->complainantmobileno';
      $opposition='$data->oppositions."<br/> ".$data->oppositionmobileno';
      $courtstatus='$data->courtcasepending?Yii::t(\'app\',\'Yes\'):Yii::t(\'app\',\'No\')';
      $stayorder='$data->stayexists?Yii::t(\'app\',\'Yes\'):Yii::t(\'app\',\'No\')';
      $disposed='"<b>Disposed:</b>".$data->status?Yii::t(\'app\',\'Yes\'):Yii::t(\'app\',\'No\')';
      $policerequired='$data->policerequired?Yii::t(\'app\',\'Yes\'):Yii::t(\'app\',\'No\')';
      $nextdate='$data->nextdateofaction';
     $columns= array();
      if ($policestation)
        $columns[]= array(
		'name'=>'policestation',
                'value'=> 'PoliceStation::model()->findByPk($data->policestation)?PoliceStation::model()->findByPk($data->policestation)->name_hi:"missing"',
                'filter'=>PoliceStation::model()->listAll(),
                );
       if ($revenuevillage)
         $columns[]=   array(
		'name'=>'revenuevillage',
                'value'=>  'RevenueVillage::model()->findByPk($data->revenuevillage)->name_hi.",".Tehsil::model()->findByPk(RevenueVillage::model()->findByPk($data->revenuevillage)->tehsil_code)->name_hi',
              
                );
            
        $columns[]= 'gatanos';   
         $columns[]=  array(
         'header'=>'Dispute Details',
         'value'=>$category.$description,
         'type'=>'raw'
     );
      $columns[]=   array('name'=>'complainants','type'=>'raw','value'=>$complainant);
	$columns[]=array('name'=>	'oppositions','type'=>'raw','value'=>$opposition);
       
       
            
    
     $columns[]=  array(
         'header'=>'Status',
        // 'value'=>'"Disposed".'.$disposed.'."Pending in court ".'.$courtstatus.'."<br/> Stay Order ".'.$stayorder.'."<br/>Police Required ".'.$policerequired,
         'value'=>function($data)
     {
         $disposed1=$data->status?Yii::t('app','Yes'):Yii::t('app','No');
         $courtstatus=$data->courtcasepending?Yii::t('app','Yes'):Yii::t('app','No');
         $stayorder=$data->stayexists?Yii::t('app','Yes'):Yii::t('app','No');
         $policerequired=$data->policerequired?Yii::t('app','Yes'):Yii::t('app','No');
          $nextdate=$data->nextdateofaction;
         return "<b>Disposed:</b>".$disposed1."<br/><b>Pending Court Case:</b>".$courtstatus
                 ."<br/><b>Stay Order:</b>".$stayorder
                 ."<br/><b>Police required:</b>".$policerequired
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
                                'url'=>'Yii::app()->createUrl("/replies/create/content_type/landdisputes/content_type_id/".$data->id)'
                            
                        )),
             'template'=>'{view}{update}{reply}',
		);
     return $columns;
    }
    public function count()
    {
        $designation=Designation::getDesignationByUser(Yii::app()->user->id);
        return Landdisputes::model()->countByAttributes(array('officerassigned'=>$designation,'status'=>0));
    }
}

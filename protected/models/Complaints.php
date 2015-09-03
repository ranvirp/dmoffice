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
			array('complainants, oppositions, complainantmobileno, officerassigned,revenuevillage, policestation, category, description', 'required'),
			array('complainantmobileno,officerassigned,policestation, priority,category, status, created_by, created_at, updated_by, updated_at', 'numerical', 'integerOnly'=>true),
			array('complainants, oppositions', 'length', 'max'=>1500),
			array('oppositionmobileno', 'length', 'max'=>13),
			array('revenuevillage', 'length', 'max'=>11),
			array('nextdateofaction', 'length', 'max'=>200),
			 array('context','length','max'=>20),
			//array('officerassigned', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, complainants, oppositions,priority, complainantmobileno, oppositionmobileno, revenuevillage,priority, category, description, nextdateofaction, officerassigned, status, created_by, created_at, updated_by, updated_at', 'safe', 'on'=>'search'),
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
                    'officer'=>array(self::BELONGS_TO,'Designation','officerassigned'),
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
	public function search($limit=FALSE) {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('t.id', $this->id);
		$criteria->compare('status', $this->status);
        $criteria->compare('complainants', $this->complainants, true);
        $criteria->compare('oppositions', $this->oppositions, true);
        $criteria->compare('revenuevillage', $this->revenuevillage);
       // $criteria->compare('policestation', $this->policestation,true);
       // $criteria->compare('gatanos', $this->gatanos, true);
        $criteria->compare('category', $this->category);
         $criteria->compare('priority', $this->priority);
        $criteria->compare('description', $this->description, true);
       // $criteria->compare('courtcasepending', $this->courtcasepending,true);
       // $criteria->compare('courtname', $this->courtname,true);
       // $criteria->compare('courtcasedetails', $this->courtcasedetails, true);
       // $criteria->compare('policerequired', $this->policerequired,true);
        $criteria->compare('nextdateofaction', $this->nextdateofaction);
         $criteria->compare('officerassigned', $this->officerassigned);
        //$criteria->compare('disputependingfor', $this->disputependingfor,true);
        //$criteria->compare('casteorcommunal', $this->casteorcommunal,true);
 if ($limit!=FALSE)
 {
     $criteria->addCondition(array('limit'=> $limit,'offset'=>0));
 }
 $criteria->order='policestation desc,revenuevillage desc';
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,

'pagination'=>array(
        'pageSize'=>20,
    ),

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
	  public function beforeFind() {
        parent::beforeFind();
        $context=Yii::app()->session['context'];
        $contexts=Context::contexts();
        $dataentry=$contexts[$context]['dataentry'];
        $this->getDbCriteria()->addInCondition('created_by',$dataentry);
       // $defaultConditions = array('create_user' => $dataentry);
        //$queryData['conditions'] = array_merge($queryData['conditions'], $defaultConditions);
        //return $queryData;
    }
      public function beforeCount() {
        parent::beforeCount();
        $context=Yii::app()->session['context'];
        $contexts=Context::contexts();
        $dataentry=$contexts[$context]['dataentry'];
        $this->getDbCriteria()->addInCondition('created_by',$dataentry);
       // $defaultConditions = array('create_user' => $dataentry);
        //$queryData['conditions'] = array_merge($queryData['conditions'], $defaultConditions);
        //return $queryData;
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
      $disposed='$data->status?Yii::t(\'app\',\'Yes\'):Yii::t(\'app\',\'No\')';
     $nextdate='$data->nextdateofaction';
      $attachments='."<br\>".Files::showAttachmentsInline($data, "documents")';
     
     $columns= array();
	 $columns[]=array(
                'header' => 'Row',
                'value' => '$row',
            );
     $columns[]=array('name'=>'id','value'=>function($data,$row,$column)
     {
          $redtag="<span style=\"color:red\" class=\"glyphicon glyphicon-tags\"\>";
         $x=$data->context.'/';
         $x.= $data->id ;
         if ($data->priority==1)
                 $x.=$redtag.'<br/><b>Urgent</b>';
          $x.='<br/>'.CHtml::link('<i class="fa fa-reply"></i>',array("/replies/create/content_type/Complaints/content_type_id/".$data->id));
        
              return TbHtml::link($x,Yii::app()->createUrl('/complaints/'.$data->id));
         
     }
         ,'type'=>'raw');
       $columns[]=array('header'=>'created on','value'=>
            function($data,$row,$column)
        { return date("d/m/Y", $data->created_at);}
        );
		 $columns[]=   array('name'=>'complainants','type'=>'raw','value'=>$complainant);
	$columns[]=array('name'=>	'oppositions','type'=>'raw','value'=>$opposition);
       if ($revenuevillage)
           $columns[]=   array(
		'name'=>'revenuevillage',
                'value'=> function($data,$row,$column)
       {
           $revenue=RevenueVillage::model()->with('tehsilCode')->findByPk($data->revenuevillage);
           $revName=$revenue?$revenue->name_hi:'missing';
           $tehsilName="missing";
           if ($revenue)
           {
               //$tehsil_code=$revenue->tehsil_code;
              // $tehsil=Tehsil::findByPk($tehsil_code);
               $tehsil=$revenue->tehsilCode;
               if ($tehsil) $tehsilName=$tehsil->name_hi;
           }
           return $revName.','.$tehsilName;
           } ,
                   'type'=>'raw'
                );
            
       
         $columns[]=  array(
         'header'=>'Dispute Details',
         'value'=>$category.$description.$attachments,
        'type'=>'raw'
     );
   
        if ($policestation)
        $columns[]= array(
		'name'=>'policestation',
                'value'=> 'PoliceStation::model()->findByPk($data->policestation)?Policestation::model()->findByPk($data->policestation)->name_hi:"missing"',
                'filter'=>Policestation::model()->listAll(),
                );
       
         $columns[]=array('header'=>Yii::t('app','assigned to'),'value'=>'($data->officer)?$data->officer->name_hi:""');
            
    $columns[]=array(
        'header'=>'Disposed?',
        'value'=> function($data,$row,$column){return  Complaints::gridToggleStatusButton($data, $row,$column);},
        'type'=>'raw',
    );
   
      $columns[]=array('header'=>'Last Action','value'=>
            
            function($data,$row,$column)
        {
           if (Replies::lastReply('Complaints', $data->id))
            return $column->grid->owner->renderPartial("/complaints/_reply",array("reply"=>Replies::lastReply("Complaints",$data->id)));    
    else return "No Action taken so far";
        });
      
       
     //   $columns[]='priority';
     if ($buttoncolumns)
         $columns[]=array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
                        'buttons'=>array(
                            'reply'=>array(
                                'label'=>'Add Action/Reply',
                                'url'=>'Yii::app()->createUrl("/replies/create/content_type/Complaints/content_type_id/".$data->id)'
                            
                        ),
                            ),
             'template'=>(Yii::app()->user->id==1)?'{view}{update}{delete}{reply}':'{view}{reply}',
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
        /*
        $officerUser = User::model()->findByPk(Designation::getUserByDesignation($this->officerassigned));
        if ($officerUser && $officerUser->profile) {
            $mobileNo = $officerUser->profile->mobile;
            $PhNo.=',91' . $mobileNo;
        }
         * 
         */
      //  $number=$this->urlencode_all($this->complainantmobileno);
      //  $number=str_split('0'.$this->complainantmobileno);
       // $x=$this->urlencode_all($this->complainantmobileno[0]);
        if ($this->officer)
            $PhNo.=',91'.$this->officer->officer_mobile;
        if (strcmp($this->complainantmobileno[0],'9')==0)
                $x='9';
        else 
            $x= $this->complainantmobileno[0];
        $text=Yii::t('app',"From").":".$this->complainants
                //."-$x".substr($this->complainantmobileno,1)
                ."\n";
        $text .= Yii::t('app',"Complaint Id:").$this->id."\n";
        //$text = Yii::t('app',"Complaint Id:").'765432730'."\n";
        $text.=Yii::t('app',"Revenuevillage").':' . $this->revVillage->name_hi . ',' . $this->revVillage->tehsilCode->name_hi . "\n";
        $text.=Yii::t('app',"Category").':' . $this->categoryName->name_hi ."\n";
        $text.=$this->description."\n";
        $text.="\nयह शिकायत ".$this->officer->name_hi." को भेज दी गयी है";
        $text.="\n";
		$text.="कार्यवाही का विवरण azamgarhdm.com पर उपलब्ध होगा";
                $temp="शि‍कायत संख्‍या - %s
मो0न0 %s
शि‍कायत कर्ता का नाम –%s  
राजस्‍व ग्राम –%s     
थाना –%s    
श्रेणी-%s    
वि‍वरण -%s
Login To – http://azamgarhdm.com";
                $text=sprintf($temp,$this->id,$this->complainantmobileno,$this->complainants,$this->revVillage->name_hi . ',' . $this->revVillage->tehsilCode->name_hi,
                        $this->thana->name_hi,$this->categoryName->name_hi,$this->description);
                
        return array('PhNo' => $PhNo, 'text' => $text);
    }
public function count1($urgent=false,$disposed=false)
    {
	  $condition=array();
        $condition['status']=0;
       // if (Yii::app()->user->id!=1)
      // if (!CWebUser::checkAccess('dataadmin'))
      //if (Designation::getDesignationByUser(Yii::app()->user->id)->designationType->code=='dist-dataOperator'
       if (!Yii::app()->session['viewall']) 
        $condition['officerassigned']=Designation::getDesignationByUser(Yii::app()->user->id);
        if ($urgent)
            $condition['priority']=1;
        if ($disposed)
            $condition['status']=1;
        
            
	 
		  return Complaints::model()->countByAttributes($condition);
    }
    function urlencode_all($string){
    $chars = array();
    for($i = 0; $i < strlen($string); $i++){
        $chars[] = '%'.dechex(ord($string[$i]));
    }
    return implode('', $chars);
}
public static function gridToggleStatusButton($data,$row,$column)
    {
        $disposed1=($data->status==1)?Yii::t('app','Yes'):Yii::t('app','No');
         
        $disposedlinktext=$data->status?'<i class="fa fa-thumbs-o-down"></i>':'<i class="fa fa-thumbs-o-up"></i>';
        $url=$column->grid->owner->createUrl("/complaints/toggleStatus/id/").'/'.$data->id;
        $result = $disposed1;
         $context=Yii::app()->session['context'];
        $contexts=Context::contexts();
        $dataentry=$contexts[$context]['dataentry'];
      	
		if (Yii::app()->user->checkAccess('Complaints.toggleStatus')&& in_array(Yii::app()->user->id,$dataentry))
		$result.= TbHtml::button($disposedlinktext,array('class'=>'hide-print','onclick'=>"js:$.get('".$url."',function(data){\$('#complaints-grid').yiiGridView('update');})")) ; 
        
        return $result;
    }

}

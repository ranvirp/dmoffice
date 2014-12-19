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
            array('complainants, oppositions, revenuevillage, policestation,complainantmobileno, gatanos, category, description, courtcasepending,officerassigned, policerequired,  disputependingfor, casteorcommunal', 'required'),
            array('revenuevillage, policestation, category, courtcasepending, policerequired,prevreferencetype, officerassigned,disputependingfor, casteorcommunal,priority', 'numerical', 'integerOnly' => true),
            array('complainants, oppositions', 'length', 'max' => 100),
            array('gatanos,courtname,nextdateofaction,prevreferenceno,stayexists', 'length', 'max' => 220),
            array('courtcasedetails', 'length', 'max' => 1000),
            array('nextdateofaction', 'length', 'max' => 200),
            array('complainantmobileno', 'length', 'max' => 13),
            array('oppositionmobileno', 'length', 'max' => 13),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id,complainants, oppositions, revenuevillage, status,policestation, gatanos, category, description, courtcasepending,courtname,stayexists, courtcasedetails, policerequired,officerassigned, nextdateofaction, disputependingfor, casteorcommunal,prevreferencetype,prevreferenceno', 'safe', 'on' => 'search'),
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
            'replyCount'=>array(self::STAT, 'Replies','content_type_id','condition'=>'replies.content_type=\'landdisputes\''),
            'officer'=>array(self::BELONGS_TO,'Designation','officerassigned'),
			
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
    public function search($limit=FALSE) {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;
       // $criteria->with=array('replyCount');
      //   $reply_table = Replies::model()->tableName();
    //$reply_count_sql = "(select count(*) from $reply_table pt where pt.content_type ='landdisputes t.id)";
        $criteria->compare('t.id', $this->id);
	$criteria->compare('status', $this->status);
        $criteria->compare('complainants', $this->complainants, true);
        $criteria->compare('oppositions', $this->oppositions, true);
        $criteria->compare('revenuevillage', $this->revenuevillage);
        $criteria->compare('policestation', $this->policestation);
        $criteria->compare('gatanos', $this->gatanos,true);
        $criteria->compare('category', $this->category);
         $criteria->compare('priority', $this->priority);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('courtcasepending', $this->courtcasepending);
        $criteria->compare('courtname', $this->courtname,true);
        $criteria->compare('courtcasedetails', $this->courtcasedetails, true);
        $criteria->compare('policerequired', $this->policerequired);
        $criteria->compare('nextdateofaction', $this->nextdateofaction);
         $criteria->compare('officerassigned', $this->officerassigned);
        $criteria->compare('disputependingfor', $this->disputependingfor);
        $criteria->compare('casteorcommunal', $this->casteorcommunal);
        $criteria->compare('prevreferencetype', $this->prevreferencetype);
        $criteria->compare('prevreferenceno', $this->prevreferenceno);
       // $criteria->compare('replyCount',">0");
 if ($limit!=FALSE)
 {
     $criteria->addCondition(array('limit'=> $limit,'offset'=>0));
 }
 $criteria->order='policestation desc,revenuevillage desc';
 $criteria->with=array('revVillage','thana','officer');
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,

'pagination'=>array(
        'pageSize'=>20,
    ),

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
        $list = CHtml::listData($models, $pk, 'complainants');
        return json_encode($list);
    }

    public function getSMSDetails() {
        $PhNo = '91' . $this->complainantmobileno . ',' . '91' . $this->oppositionmobileno;
        //get Officer Mobile No
        /*
        $officerUser = User::model()->findByPk(Designation::getUserByDesignation($this->officerassigned));
        if ($officerUser && $officerUser->profile) {
            $mobileNo = $officerUser->profile->mobile;
            $PhNo.=',91' . $mobileNo;
        }
         * */
         
        $sho = Designation::model()->findByAttributes(array('designation_type_id' => 9, 'level_type_id' => $this->policestation));
        /*
        $shoUser = $sho?User::model()->findByPk(Designation::getUserByDesignation($sho->id)):null;
        ;
        if ($shoUser && $shoUser->profile) {
            $mobileNo = $shoUser->profile->mobile;
            $PhNo.=',91' . $mobileNo;
        }
         * *
         */
        //$PhNo.=',919454417521';
        if ($sho)
            $PhNo.=',91'.$sho->officer_mobile;
        if ($this->officer)
        {
            $PhNo.=",91".$this->officer->officer_mobile;
        }
        $text = Yii::t('app','Landdisputes').'Id:'.$this->id;
        if (strcmp($this->complainantmobileno[0],'9')==0)
                $x='9';
        else 
            $x= $this->complainantmobileno[0];
         $text.=Yii::t('app',"From").":".$this->complainants
                // ."-$x".substr($this->complainantmobileno,1)
                 ."\n";
       
        $text.=Yii::t('app',"Revenuevillage") .':'. $this->revVillage->name_hi . ',' . $this->revVillage->tehsilCode->name_hi . "\n";
        $text.=Yii::t('app',"Policestation").':' . $this->thana->name_hi . "\n";
        $text.=Yii::t('app',"Category").':' . $this->categoryName->name_hi . "\n";
         $text.=$this->description . "\n";
        $text.=Yii::t('app',"Gatanos").':' . $this->gatanos;
        //$text.="-$x".substr($this->complainantmobileno,1);
		$text.="\nयह शिकायत ".$this->officer->name_hi." को  उचित कार्यवाही हेतु भेज दी गयी है";
		$text.="\n";
		$text.="azamgarhdm.com";
       // $text.="Complainanant:" . $this->complainants . " " . $this->complainantmobileno;
        return array('PhNo' => $PhNo, 'text' => $text);
    }
    public static function getColumns($buttoncolumns=false,$policestation=true,$revenuevillage=true,$rowdisplay=true)
    {
    
     $complainant='$data->complainants."<br/>".$data->complainantmobileno';
      $opposition='$data->oppositions."<br/> ".$data->oppositionmobileno';
      $courtstatus='$data->courtcasepending?Yii::t(\'app\',\'Yes\'):Yii::t(\'app\',\'No\')';
      $stayorder='$data->stayexists?Yii::t(\'app\',\'Yes\'):Yii::t(\'app\',\'No\')';
      $disposed='"<b>Disposed:</b>".$data->status?Yii::t(\'app\',\'Yes\'):Yii::t(\'app\',\'No\')';
      $policerequired='$data->policerequired?Yii::t(\'app\',\'Yes\'):Yii::t(\'app\',\'No\')';
      $nextdate='$data->nextdateofaction';
      
     
     $columns= array();
     if ($rowdisplay)
     {
	$columns[]=array(
                'header' => 'Row',
                'value' => '$row',
            );
    }
	 /*
	 $columns[]=array(
                'header' => 'Row',
                'value' => '$row + ($this->grid->dataProvider->pagination->currentPage
                    * $this->grid->dataProvider->pagination->pageSize)',
            );
		*/	
     $columns[]=array('name'=>'id','value'=>function($data,$row,$column)
     {
          $redtag="<span style=\"color:red\" class=\"glyphicon glyphicon-tags\"\>";
         $x= $data->id ;
         if ($data->priority==1)
                 $x.=$redtag;
         $prevreference=new Prevreference();
         $prevreferencetype='';
         if (isset($prevreference->options[$data->prevreferencetype]))
         $prevreferencetype=$prevreference->options[$data->prevreferencetype].' '.$data->prevreferenceno;
         $x.='<br/>'.'<a href="/replies/create/content_type/Landdisputes/content_type_id/'.$data->id.'"><i class="fa fa-reply"></i></a>';
             return TbHtml::link($x,'/landdisputes/'.$data->id).'<br/>'.'<span style="font-size:8px">'
             .  $prevreferencetype.'</span>';
         
     }
         ,'type'=>'raw');
		 $columns[]=array('name'=>'created_at','header'=>'created on','value'=>
            function($data,$row,$column)
        { return date("d/m/Y", $data->created_at);}
        );
		 $columns[]=   array('name'=>'complainants','type'=>'raw','value'=>
                     function ($data,$row,$column) {
                      $complainant=$data->complainants."<br/>".$data->complainantmobileno;
      $opposition=$data->oppositions."<br/> ".$data->oppositionmobileno;
                     return $complainant.'<br/>Vs<br/>'.$opposition;});
	//$columns[]=array('name'=>	'oppositions','type'=>'raw','value'=>$opposition);
      
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
           }  ,
                   'type'=>'raw',
                );
            
        //$columns[]= 'gatanos';   
         $columns[]=  array(
         'header'=>'Dispute Details',
         'value'=>function($data,$row,$column)
     {
              $category = "<b>".Complaintcategories::model()->findByPk($data->category)->name_hi."</b><br>";
     $description="<br>".$data->description;
     if ($data->gatanos!==0)
     $description.="<br>".Yii::t('app','Gatanos').':'.$data->gatanos;
     $attachments="<br\>".Files::showAttachmentsInline($data, "documents");
         $courtstatus=$data->courtcasepending?'<i class="fa fa-gavel"></i>':'';

         $stayorder=$data->stayexists?'<i class=fa fa-legal></i>':'';
         $policerequired=$data->policerequired?'<i class="fa fa-users"></i>':'';

          $nextdate=$data->nextdateofaction;
         return $courtstatus
                 .$stayorder
                 .$policerequired.$category.$description.$attachments;
                 //."<br/>Next date of Action:<div id='$data->id' class=\"edit\">".$nextdate."</div>";
     },
        'type'=>'raw'
     );
     
       if ($policestation)
        $columns[]= array(
		'name'=>'policestation',
                'value'=> '$data->thana?$data->thana->name_hi:"missing"',
                'filter'=>Policestation::model()->listAll(),
                );
       
            
    $columns[]=array(
        'header'=>'Disposed?',
        'value'=> function($data,$row,$column){return  Landdisputes::gridToggleStatusButton($data, $row,$column);},
        'type'=>'raw',
    );
    
	  $columns[]=array('name'=>'officerassigned','filter'=>Designation::model()->listAll(),'header'=>Yii::t('app','assigned to'),'value'=>'$data->officer?$data->officer->name_hi:"missing"');
        
      $columns[]=array('header'=>'Last Action','value'=>
            
            function($data,$row,$column)
        {
           if (Replies::lastReply('Landdisputes', $data->id))
            return $column->grid->owner->renderPartial("/landdisputes/_reply",array("reply"=>Replies::lastReply("Landdisputes",$data->id)));    
    else return "No Action taken so far";
        });
       
     //   $columns[]='priority';
     if ($buttoncolumns)
         $columns[]=array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
                        'buttons'=>array(
                            'reply'=>array(
                                'label'=>'Add Action/Reply',
                                'url'=>'Yii::app()->createUrl("/replies/create/content_type/Landdisputes/content_type_id/".$data->id)'
                            
                        ),
                            ),
             'template'=>(Yii::app()->user->id==1)?'{view}{update}{reply}{delete}':'{view}{reply}',
		);
     return $columns;
    }
    public function count1($urgent=false,$disposed=false)
    {
        $condition=array();
        $condition['status']=0;
        if (Yii::app()->user->id!=1)
        $condition['officerassigned']=Designation::getDesignationByUser(Yii::app()->user->id);
        if ($urgent)
            $condition['priority']=1;
        if ($disposed)
            $condition['status']=1;
        
            
	 
		  return Landdisputes::model()->countByAttributes($condition);
    }
   public static function gridToggleStatusButton($data,$row,$column)
    {
        $disposed1=($data->status==1)?Yii::t('app','Yes'):Yii::t('app','No');
         
       $disposedlinktext=$data->status?'<i class="fa fa-thumbs-o-down"></i>':'<i class="fa fa-thumbs-o-up"></i>';
        
        //$url=$column->grid->owner->createUrl("/landdisputes/toggleStatus/id/").'/'.$data->id;
       $url=Yii::app()->createUrl("/landdisputes/toggleStatus/id/").'/'.$data->id;
        $result =$disposed1;
		if (Yii::app()->user->checkAccess('Landdisputes.toggleStatus'))
		{
		 $result.=TbHtml::button($disposedlinktext,array('class'=>'hidden-print','onclick'=>"js:$.get('".$url."',function(data){\$('#landdisputes-grid').yiiGridView('update');})")) ; 
            //$result.=TbHtml::button($disposedlinktext,array('onclick'=>"js:$.get('".$url."',function(data){})"));
			//,function(data){$('#landdisputes-grid').yiiGridView('update');})")) ; 
        
		}
		return $result;
    }
	
}

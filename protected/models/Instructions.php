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
			array(' receiver, status, parentinst', 'numerical', 'integerOnly'=>true),
			array('sender', 'length', 'max'=>10),
			array('attachments', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id,  sender, receiver, instruction, status,  parentinst', 'safe', 'on'=>'search'),
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
                   
                    'senderDesignation'=>array(self::BELONGS_TO,'Designation','sender'),
                     'receiverDesignation'=>array(self::BELONGS_TO,'Designation','receiver'),
                     'replies'=>array(self::HAS_MANY,'Replies','content_type_id','condition'=>'replies.content_type=\'instructions\'','order'=>'replies.create_time DESC'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('app','ID'),
			
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
		$criteria->compare('status',$this->status,true);
		$criteria->compare('attachments',$this->attachments,true);
		$criteria->compare('parentinst',$this->parentinst,true);

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
  public static function getColumns($buttoncolumns=false,$policestation=true,$revenuevillage=true)
    {
      $disposed='"<b>Disposed:</b>".$data->status?Yii::t(\'app\',\'Yes\'):Yii::t(\'app\',\'No\')';
      $attachments='."<br\>".Files::showAttachmentsInline($data, "documents")';
     
     $columns= array();
     $columns[]=array('name'=>'id','value'=>function($data,$row,$column)
     {
          $redtag="<span style=\"color:red\" class=\"glyphicon glyphicon-tags\"\>";
         $x= $data->id ;
         if ($data->priority==1)
                 $x.=$redtag;
              return TbHtml::link($x,'/instructions/'.$data->id);
         
     }
         ,'type'=>'raw');
      
      $columns[]='instruction';
       
       
       
            
    $columns[]=array(
        'header'=>'Status',
        'value'=> function($data,$row,$column){return  Instructions::gridToggleStatusButton($data, $row,$column);},
        'type'=>'raw',
    );
   
      $columns[]=array('header'=>'Last Action','value'=>
            
            function($data,$row,$column)
        {
           if (Replies::lastReply('Instructions', $data->id))
            return $column->grid->owner->renderPartial("/instructions/_reply",array("reply"=>Replies::lastReply("Complaints",$data->id)));    
    else return "No Action taken so far";
        });
        $columns[]=array('header'=>Yii::t('app','assigned to'),'value'=>'$data->receiverDesignation->name_hi');
        $columns[]=array('header'=>'created on','value'=>
            function($data,$row,$column)
        { return date("d/m/Y", $data->created_at);}
        );
     //   $columns[]='priority';
     if ($buttoncolumns)
         $columns[]=array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
                        'buttons'=>array(
                            'reply'=>array(
                                'label'=>'Add Action/Reply',
                                'url'=>'Yii::app()->createUrl("/replies/create/content_type/instructions/content_type_id/".$data->id)'
                            
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
        $PhNo='';
        //get Officer Mobile No
        $officerUser = User::model()->findByPk(Designation::getUserByDesignation($this->receiver));
        $sender=User::model()->findByPk(Designation::getUserByDesignation($this->sender));
        if ($officerUser && $officerUser->profile) {
            $mobileNo = $officerUser->profile->mobile;
            $PhNo.=',91' . $mobileNo;
        }
         if ($sender && $sender->profile) {
            $mobileNo = $sender->profile->mobile;
            $PhNo.=',91' . $mobileNo;
        }
     $text='';
       // $text=Yii::t('app',"From").":".$this->complainants."-$x".substr($this->complainantmobileno,1)."\n";
        $text .= Yii::t('app',"Instruction Id:").$this->id."\n";
        //$text = Yii::t('app',"Complaint Id:").'765432730'."\n";
        $text.="From:".$this->senderDesignation->name_hi."\n";
        $text.="To:".$this->receiverDesignation->name_hi."\n";
        $text.=$this->instruction."\n";
      
    
        return array('PhNo' => $PhNo, 'text' => $text);
    }
public function count1()
    {
        $designation=Designation::getDesignationByUser(Yii::app()->user->id);
        return Instructions::model()->countByAttributes(array('officerassigned'=>$designation,'status'=>0));
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
         
        $disposedlinktext=$data->status?Yii::t('app','Mark as Pending'):Yii::t('app','Mark as Disposed');
        $url=$column->grid->owner->createUrl("/instructions/toggleStatus/id/").'/'.$data->id;
        $result ='<b>Disposed:</b>'. $disposed1.'<br/>';
		if (Yii::app()->user->checkAccess('Instructions.toggleStatus'))
		$result.=TbHtml::button($disposedlinktext,array('onclick'=>'js:$.get("'.$url.'")')) .'<br/>'; 
        return $result;
    }
}

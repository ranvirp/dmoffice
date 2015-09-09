<?php

class LanddisputesController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters1() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function filters() {
        return array('rights');
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'printPdf', 'print'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id,$d=0) {
       
        $this->render('view', array(
            'model' => $this->loadModel($id),
            'displayAttach'=>($d==1)?true:false,
        ));
        
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {


        $model = new Landdisputes;
         $context=Yii::app()->session['context'];
        $contexts=Context::contexts();
        $dataentry=$contexts[$context]['dataentry'];
        if (! in_array(Yii::app()->user->id,$dataentry))
           throw new CHttpException(401,'Not Allowed data entry in this context..try changing context');
           $model->context=$context;
        $model->onAfterSave = array(new SendSMSComponent(), 'sendSMS');
        $model->courtcasepending = 1;
        // $complainants=$this->getItemsToUpdate('complainants');
        //$oppositions=$this->getItemsToUpdate('oppositions');
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Landdisputes'])) {
            $model->attributes = $_POST['Landdisputes'];
            if (isset($_POST['Landdisputes']['stayorders']))
                $model->stayorders = implode(",", $_POST['Landdisputes']['stayorders']);
             if (isset($_POST['Landdisputes']['documents']))
                $model->documents = implode(",", $_POST['Landdisputes']['documents']);
             // $sdm = Designation::model()->findByAttributes(array('level_type_id' => $model->revVillage->tehsil_code, 'designation_type_id' => 8));
               // if ($sdm)
                  //  $model->officerassigned = $sdm->id;
				  $model->created_at=time();
				  $model->created_by=Yii::app()->user->id;
            if ($model->save()) {
                //find code of sdm of tehsil
               
               
                //$model->revVillage->tehsil_code;
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('create', array(
            'model' => $model,
                //'complainants'=>$complainants,
                //'oppositions'=>$oppositions,
        ));
    }

    public function getItemsToUpdate($item1 = 'Item') {
        // Create an empty list of records
        $items = array();

        // Iterate over each item from the submitted form
        if (isset($_POST[$item1]) && is_array($_POST[$item1])) {
            foreach ($_POST[$item1] as $item) {
                // If item id is available, read the record from database 
                if (array_key_exists('id', $item)) {
                    $items[] = CitizenRural::model()->findByPk($item['id']);
                }
                // Otherwise create a new record
                else {
                    $items[] = new CitizenRural();
                }
            }
        } else {
            $items[] = new CitizenRural();
        }
        return $items;
    }

    public function actionPrint($view) {

        $model = new Landdisputes('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Landdisputes'])) {
            $model->attributes = $_GET['Landdisputes'];
        }
        $this->layout = "//layouts/print";
        $this->render($view, array(
            'model' => $model,
        ));
    }

    public function actionSearch() {

        $model = new Landdisputes();

        $model->unsetAttributes();  // clear any default values
       // $model->policerequired = 1;
      //  $model->casteorcommunal = 0;
       // $model->courtcasepending = 0;
       // $model->stayexists = 0;
        $limit=false;
        if (isset($_POST['Landdisputes'])) {
            $model->attributes = $_POST['Landdisputes'];
            if (strcmp($model->revenuevillage,'None')==0)
               unset($model->revenuevillage);
        }
else 
{
    $limit=1;
}
$x=$model->search($limit);
$x->pagination=false;
        $this->render('ldwise', array(
            'dp' => $x,
           // 'mergeColumns'=>array('revenuevillage'),
            'model'=>$model,
        ));
    }
     public function actionDateWise() {

        $model = new Landdisputes();

        $model->unsetAttributes();  // clear any default values
       
        $x=null;
        if (isset($_GET['Landdisputes'])) {
            $x = $_GET['Landdisputes']['created_at'];
            $x= str_replace("/", "-", $x );
        }
       
       $timestamp1 = strtotime($x);
//$timestamp1 = mktime(0, 0, 0, $a['tm_mon']+1, $a['tm_mday'], $a['tm_year']+1900);
        $timestamp2=$timestamp1+3600*24;
        $criteria = new CDbCriteria;
        $criteria->addBetweenCondition('created_at', $timestamp1, $timestamp2, 'AND');
        //$criteria->compare('created_at',date())
      
 $ca= new CActiveDataProvider($model, array(
            'criteria' => $criteria,
     'pagination'=>false,
     ));
        
 
        $this->render('datewise', array(
            'dp' => $ca,
           
            'model'=>$model,
        ));
 
    }
 /*
  * Toggle Status
  */
    public function actionToggleStatus($id)
    {
        $ld=  Landdisputes::model()->findByPk($id);
        if ($ld)
        {
           if ( $ld->status==1)
               $ld->status=0 ;
                   else 
                       $ld->status=1;
           $ld->save();
            print $ld->status;
             $reply =Replies::lastReply("Landdisputes",$ld->id);
            $ct=($reply)?$reply->content:'';
            if ($ld->status==1)
            {
                $smsc=new SendSMSComponent();
              $smsc->postSms1('91'.$ld->complainantmobileno, Yii::t('app','Landdisputes')." ".$ld->id." "." निस्तारित"
                        ."\n".Yii::t('app','Landdisputes').":".$ld->description."\n"."निस्तारण:".$ct );
            }
        }
        else 
            print "no";
    }
    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $model->onAfterSave = array(new SendSMSComponent(), 'sendSMS');
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        $context=Yii::app()->session['context'];
        $contexts=Context::contexts();
        $dataentry=$contexts[$context]['dataentry'];
        if (! in_array(Yii::app()->user->id,$dataentry) || ($model->context!=$context))
           throw new CHttpException(401,'Not Allowed update in this context..try changing context');
          
        if (isset($_POST['Landdisputes'])) {
            $model->attributes = $_POST['Landdisputes'];
            if (isset($_POST['Landdisputes']['stayorders']))
                $model->stayorders = implode(",", $_POST['Landdisputes']['stayorders']);
              if (isset($_POST['Landdisputes']['documents']))
                $model->documents = implode(",", $_POST['Landdisputes']['documents']);
            if ($model->save()) {
                //$sdm = Designation::model()->findByAttributes(array('level_type_id' => $model->revVillage->tehsil_code, 'designation_type_id' => 8));
               // if ($sdm)
                   // $model->officerassigned = $sdm->id;
				   $model->updated_at=time();
				   $model->updated_by=Yii::app()->user->id;
                $model->save();

                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax'])) {
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
            }
        } else {
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }
    }
public function actionIndex()
{
    $model=new Landdisputes;
    $model->unsetAttributes();
    $this->render('index',array('model'=>$model,'dataProvider'=>$model->search()));
}
    /**
     * Lists all models in which reports have been received.
     */
    public function actionApprove() {
      $model=new Landdisputes;
       $context=Yii::app()->session['context'];
        $contexts=Context::contexts();
        $dataentry=$contexts[$context]['dataentry'];
        if (in_array(Yii::app()->user->id,$dataentry))
         $ids=join(",",$dataentry);
        else
         $ids=Yii::app()->user->id;
        $sql='select distinct landdisputes.id as id1 from replies left join landdisputes  on replies.content_type=\'landdisputes\' and replies.content_type_id=landdisputes.id where landdisputes.status=0 and landdisputes.created_by in ('.$ids.') and landdisputes.updated_at<replies.create_time';
        $rawData = Yii::app()->db->createCommand($sql); //or use ->queryAll(); in CArrayDataProvider
        $sql1='select count(distinct landdisputes.id) as count1 from replies left join landdisputes  on replies.content_type=\'landdisputes\' and replies.content_type_id=landdisputes.id where landdisputes.status=0 and landdisputes.created_by in ('.$ids.') and landdisputes.updated_at<replies.create_time';
        $count = Yii::app()->db->createCommand($sql1)->queryScalar(); //the count
       // var_dump($count);
       //exit;        
//$count=1;
 
        $dp = new CSqlDataProvider($rawData,array('keyField'=>'id1','totalItemCount'=>$count,'pagination'=>array('pageSize'=>5)));
        $this->render('index',array('dataProvider'=>$dp));
  /*    
 $this->render('ldwise_1', array(
            'model' => $model,
           'dp'=>$dp,
        ));
   * */
   
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Landdisputes('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_POST['Landdisputes'])) {
            $model->attributes = $_POST['Landdisputes'];
        }
         if (strcmp($model->revenuevillage,'None')==0)
               unset($model->revenuevillage);
         //$model->status=0;
  if (Yii::app()->user->id!=1)
  {
      $model->officerassigned=  Designation::getDesignationByUser (Yii::app()->user->id);
	  //$model->status=0;
	  }
        $this->render('admin', array(
            'model' => $model,
        ));
    }
      public function actionPrevRefWise() {
        $model = new Landdisputes('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_POST['Landdisputes'])) {
            $model->attributes = $_POST['Landdisputes'];
        }
       
         //$model->status=0;
  if (Yii::app()->user->id!=1)
  {
      $model->officerassigned=  Designation::getDesignationByUser (Yii::app()->user->id);
	  //$model->status=0;
	  }
        $this->render('admin1', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Landdisputes the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Landdisputes::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

    public function actionUpdateDateOfAction() {
        $id = $_POST['id'];
        $date = $_POST['date'];
        $model = Landdisputes::model()->findByPk($id);
        if ($model != null) {
            $model->nextdateofaction = $date;
            $model->save();
            print $model->nextdateofaction;
        } else
            print "";
        Yii::app()->end();
    }

    /**
     * Performs the AJAX validation.
     * @param Landdisputes $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'landdisputes-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionReport($t) {
        $dp = Landdisputes::report($t);
        if (strcmp("thana", $t) == 0)
            $mergeColumns = array('policestation');
        else if (strcmp("rv", $t) == 0)
            $mergeColumns = array('revenuevillage');
        $dp->pagination=false;
        $this->render('ldwise', array('mergeColumns' => $mergeColumns, 'dp' => $dp));
    }
    public function actionOw()
{
        $dt=0;
    //var_dump($_GET);exit;
    if(isset($_GET['DesignationType']['id']))
        $dt= $_GET['DesignationType']['id'];
    $this->render('officerwise',array('designationtype'=>$dt));
}
    public function actionMy()
    {
        $numbers=array(0,1,2,3,4);
       $model = new Landdisputes('search');
	   $model->unsetAttributes();
	  // if (Yii::app()->user->id!=1)
	  if (!Yii::app()->session['viewall'])
       $model->officerassigned=Designation::getDesignationByUser(Yii::app()->user->id);
            if (isset($_GET['o']))
                {
                    $o=$_GET['o'];
                    if (Designation::model()->findByPk($o)!=null)
                        $model->officerassigned=$o;
                }
           $model->status=0;
          if (isset($_GET['p']))
            $model->priority=$numbers[$_GET['p']];
           if (isset($_GET['s']))
            $model->status=$numbers[$_GET['s']];
       
        if (isset($_GET['Landdisputes'])) {
            $model->attributes = $_GET['Landdisputes'];
        }
         if (strcmp($model->revenuevillage,'None')==0)
               unset($model->revenuevillage);
         //$model->status=0;
  
       $dp=$model->search();
       $dp->pagination=array('pageSize'=>20);
       if (isset($_GET['page']) && is_numeric($_GET['page']))
           
       $dp->pagination=array('pageSize'=>$_GET['page']);

        $this->render('ldwise', array(
            'model' => $model,
           'dp'=>$dp,
        ));
    }
 
    
    public function actioMyPdf1()
    {
       $model = new Landdisputes('search');
	   $model->unsetAttributes();
	 //  if (Yii::app()->user->id!=1)
	 if (!Yii::app()->session['viewall'])
       $model->officerassigned=Designation::getDesignationByUser(Yii::app()->user->id);
            $model->status=0;
          if (isset($_GET['p']))
            $model->priority=$_GET['p'];
           if (isset($_GET['s']))
            $model->status=$_GET['s'];
       $dp=$model->search();
       $dp->pagination=false;
      
       $this->widget('EExcelView', array(
     'dataProvider'=> $dp,
     'title'=>'Title',
     'autoWidth'=>false,
           'grid_mode'=>'export',
     'exportType'=>'PDF',
           'columns'=>  array('id','revenuevillage','policestation'),
     
));
    }
public function actionMyPdf()
{
    if (isset($_GET['o']))
    $o=$_GET['o'];
    else
        $o=1;
    if ($o==12)
        $this->redirect(Yii::app()->createUrl('/landdisputes/ow'));
    if (file_exists(__DIR__.'/../../reports/ld/'.$o.'.pdf')) {
         header("Pragma: no-cache");
         header("Expires: 0");
         header('Content-Description: File Transfer');
         header('Content-Type: ' . CFileHelper::getMimeType(__DIR__.'/../../reports/ld/'.$o.'.pdf'));
         header('Content-Disposition: attachment; filename="Pending Landdisputes on'.date('d/m/Y').' for '.$o.'.pdf"');
         header('Content-Transfer-Encoding: binary');
         header('Expires: 0');
         header('Cache-Control: must-revalidate');
         header('Pragma: public');
         header('Content-Length: ' . filesize(__DIR__.'/../../reports/ld/'.$o.'.pdf'));      
         readfile(__DIR__.'/../../reports/ld/'.$o.'.pdf');           
         Yii::app()->end();
     } else {
         throw new CHttpException(404, 'Not found');
     }
}
    public function actioPrintPdf() {
        # mPDF
        $mPDF1 = Yii::app()->ePdf->mpdf();

        # You can easily override default constructor's params
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A5');
$model=new Landdisputes;
$model->unsetAttributes();
$dp=$model->search();
        # render (full page)
        //$mPDF1->WriteHTML($this->render('admin', array('model'=>$model), true));

        # Load a stylesheet
        //    $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . '/main.css');
        //   $mPDF1->WriteHTML($stylesheet, 1);
        # renderPartial (only 'view' of current controller)
        //$mPDF1->WriteHTML($this->renderPartial('ldwise', array('model'=>$model,'dp'=>$dp), true));

        # Renders image
        //  $mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif' ));
        # Outputs ready PDF
       // $mPDF1->Output();

        ////////////////////////////////////////////////////////////////////////////////////
        # HTML2PDF has very similar syntax
        $html2pdf = Yii::app()->ePdf->HTML2PDF();
        $html2pdf->WriteHTML($this->renderPartial('ldwise', array('model'=>$model,'dp'=>$dp), true));
        $html2pdf->Output();

        ////////////////////////////////////////////////////////////////////////////////////
        /*
          # Example from HTML2PDF wiki: Send PDF by email
          $content_PDF = $html2pdf->Output('', EYiiPdf::OUTPUT_TO_STRING);
          require_once(dirname(__FILE__).'/pjmail/pjmail.class.php');
          $mail = new PJmail();
          $mail->setAllFrom('webmaster@my_site.net', "My personal site");
          $mail->addrecipient('mail_user@my_site.net');
          $mail->addsubject("Example sending PDF");
          $mail->text = "This is an example of sending a PDF file";
          $mail->addbinattachement("my_document.pdf", $content_PDF);
          $res = $mail->sendmail();
         * *
         */
    }
function gridToggleStatusButton($data,$row)
    {
        $disposed1=$data->status?Yii::t('app','Yes'):Yii::t('app','No');
         
        $disposedlinktext=$data->status?Yii::t('app','Mark as Pending'):Yii::t('app','Mark as Disposed');
        $url=$this->createUrl("/landdisputes/toggleStatus",array('id'=>$data->id));
        $result ='<b>Disposed:</b>'. $disposed.'<br/>'.CHtml::link($disposedlinktext,$url) .'<br/>'; 
        return $result;
    }
    public function actionList()
{
    //list pending thanawise
        
        if(isset($_POST['cid']))
        {
            //var_dump($_POST);
            //exit;
           foreach($_POST['cid'] as $i=>$cid)
           {
            $ld= Landdisputes::model()->findByPk($cid);
            $date = DateTime::createFromFormat('m/d/Y', $_POST['doa']);
            $ld->nextdateofaction= $date->format('Y-m-d');
            
            $ld->save();
           }
        }
    $model=new Landdisputes();
    $criteria=new CDbCriteria();
    if(isset($_GET['page']))
        
    $criteria->limit=$_GET['page'];
    else 
        $criteria->limit=15;
    if(isset($_GET['ps']))
        
    $ps=$_GET['ps'];
    else 
        $ps=0;
    $criteria->condition='policestation=:p';
    $criteria->addCondition('status=0');
    $criteria->addCondition('nextdateofaction <=now()');
    $criteria->params=array(':p'=>$ps);
    $criteria->order="priority desc,revenuevillage desc,created_at desc";
    //$lds=Landdisputes::model()->findAll($criteria);
    $dp= new CActiveDataProvider($model,array('criteria'=>$criteria,'pagination'=>false));
    $this->render('/landdisputes/ldwise_2',array('model'=>$model,'dp'=>$dp));
}
public function actionCl()
{
    $model=new Landdisputes();
        $model->unsetAttributes();
        $dp=null;
        $title='';
    if (isset($_POST['doa']))
    {
        
        $date=  DateTime::createFromFormat("m/d/Y", $_POST['doa']);
        $model->nextdateofaction=$date->format("Y-m-d");
        //echo $date->format("m-d-Y");
        //exit;
        $model->policestation=$_POST['policestation'];
        $x=  Policestation::model()->findByPk($_POST['policestation'])->name_en;
        $title='Action list for '.$x.' on '.$date->format('d/m/Y');
        $dp=$model->search();
    }
    $this->render('_psform',array('model'=>$model,'dp'=>$dp,'title'=>$title));
}
}

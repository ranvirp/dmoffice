<?php

class ComplaintsController extends Controller {

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
        return array(
            'rights',
        );
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
                'actions' => array('create', 'update', 'report'),
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
        $model = new Complaints;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        $model->onAfterSave = array(new SendSMSComponent(), 'sendSMS');
        if (isset($_POST['Complaints'])) {
            $model->attributes = $_POST['Complaints'];
            if (isset($_POST['Complaints']['documents']))
                $model->documents = implode(",", $_POST['Complaints']['documents']);
				$model->created_at=time();
				$model->created_by=Yii::app()->user->id;
            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        //$model->onAfterSave = array(new SendSMSComponent(), 'sendSMS');
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Complaints'])) {
            $model->attributes = $_POST['Complaints'];
            if (isset($_POST['Complaints']['documents']))
                $model->documents = implode(",", $_POST['Complaints']['documents']);
				$model->updated_at=time();
				$model->updated_by=Yii::app()->user->id;
            if ($model->save()) {
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

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Complaints');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionMy() {
        $model = new Complaints('search');
		$model->unsetAttributes(); 
        $model->officerassigned = Designation::getDesignationByUser(Yii::app()->user->id);
        $dp = $model->search();
        $dp->pagination = false;
        $mergeColumns = array('revenuevillage');
        $this->render('ldwise', array('mergeColumns' => $mergeColumns,'model'=>$model, 'dp' => $dp));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Complaints('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_POST['Complaints'])) {
            $model->attributes = $_POST['Complaints'];
        }
        if ($model->priority==0)
            $model->priority=">0";
  if (strcmp($model->revenuevillage,'None')==0)
               unset($model->revenuevillage);
  //$model->status=0;
  if (Yii::app()->user->id!=1)
  {
      $model->officerassigned=  Designation::getDesignationByUser (Yii::app()->user->id);
	  
	  }
        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Complaints the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Complaints::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Complaints $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'complaints-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionReport($t) {
        $dp = Complaints::report($t);
        if (strcmp("of", $t) == 0)
            $mergeColumns = array('officerassigned');
        else if (strcmp("rv", $t) == 0)
            $mergeColumns = array('revenuevillage');
        $this->render('ldwise', array('mergeColumns' => $mergeColumns, 'dp' => $dp));
    }

    public function actionSearch() {

        $model = new Complaints();

        $model->unsetAttributes();  // clear any default values
        // $model->policerequired = 1;
        //  $model->casteorcommunal = 0;
        // $model->courtcasepending = 0;
        // $model->stayexists = 0;
        $limit = false;
        //$model->status=0;
        if (isset($_POST['Complaints'])) {
            $model->attributes = $_POST['Complaints'];
            if (strcmp($model->revenuevillage, 'None') == 0)
                unset($model->revenuevillage);
        }
        else {
            $limit = 1;
        }
        $x = $model->search($limit);
        $x->pagination = false;
        $this->render('ldwise', array(
            'dp' => $x,
            // 'mergeColumns'=>array('revenuevillage'),
            'model' => $model,
        ));
    }

    public function actionDateWise() {

        $model = new Complaints();

        $model->unsetAttributes();  // clear any default values
       
        $x=null;
        if (isset($_GET['Complaints'])) {
            $x = $_GET['Complaints']['created_at'];
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

    public function actionToggleStatus($id) {
        $ld = Complaints::model()->findByPk($id);
        if ($ld) {
            ( $ld->status == 1) ? $ld->status = 0 : $ld->status = 1;
            $ld->save();
            print $ld->status;
        } else
            print "no";
    }

}

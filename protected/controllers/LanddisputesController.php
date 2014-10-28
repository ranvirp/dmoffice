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
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {


        $model = new Landdisputes;
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
            if ($model->save()) {
                //find code of sdm of tehsil
                $sdm = Designation::model()->findByAttributes(array('level_type_id' => $model->revVillage->tehsil_code, 'designation_type_id' => 8));
                if ($sdm)
                    $model->officerassigned = $sdm->id;
                $model->save();
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
        $model->policerequired = 1;
        $model->casteorcommunal = 0;
        $model->courtcasepending = 0;
        $model->stayexists = 0;
        if (isset($_GET['Landdisputes'])) {
            $model->attributes = $_GET['Landdisputes'];
        }

        $this->render('Thanawise', array(
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
        $model->onAfterSave = array(new SendSMSComponent(), 'sendSMS');
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Landdisputes'])) {
            $model->attributes = $_POST['Landdisputes'];
            if (isset($_POST['Landdisputes']['stayorders']))
                $model->stayorders = implode(",", $_POST['Landdisputes']['stayorders']);
            if ($model->save()) {
                $sdm = Designation::model()->findByAttributes(array('level_type_id' => $model->revVillage->tehsil_code, 'designation_type_id' => 8));
                if ($sdm)
                    $model->officerassigned = $sdm->id;
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

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Landdisputes');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Landdisputes('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Landdisputes'])) {
            $model->attributes = $_GET['Landdisputes'];
        }

        $this->render('admin', array(
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
        $this->render('ldwise', array('mergeColumns' => $mergeColumns, 'dp' => $dp));
    }

    public function actionPrintPdf() {
        # mPDF
        $mPDF1 = Yii::app()->ePdf->mpdf();

        # You can easily override default constructor's params
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A5');

        # render (full page)
        $mPDF1->WriteHTML($this->render('admin', array(), true));

        # Load a stylesheet
        //    $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . '/main.css');
        //   $mPDF1->WriteHTML($stylesheet, 1);
        # renderPartial (only 'view' of current controller)
        $mPDF1->WriteHTML($this->renderPartial('admin', array(), true));

        # Renders image
        //  $mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif' ));
        # Outputs ready PDF
        $mPDF1->Output();

        ////////////////////////////////////////////////////////////////////////////////////
        # HTML2PDF has very similar syntax
        $html2pdf = Yii::app()->ePdf->HTML2PDF();
        $html2pdf->WriteHTML($this->renderPartial('admin', array(), true));
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

}

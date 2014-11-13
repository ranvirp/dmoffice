<?php

class Landdisputes1Controller extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function filters1() {
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
                'actions' => array('index', 'view','myJson'),
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

    
public function actionMyJson()
{
    $list=array();
    $username='';
    if (isset($_GET['user']))
        $username=$_GET['user'];
   foreach (Landdisputes::model()->findAllByAttributes(array('officerassigned'=>  Designation::getDesignationByUser(User::model()->findByAttribute(array('username'=>$username))->id))) as $model)
   {
       $list[]['id']=$model->id;
       $list[]['value']=$model->id.'-'.$model->revenueVillage->name_hi;
       
       
   }
   print jsone_encode($list);
}
}

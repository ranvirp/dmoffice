<?php

class SiteController extends Controller
{
     public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
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
                'actions' => array('index', 'view','/'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete','usersForm','createuser'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }
/**
	 * Declares class-based actions.
	 */
    
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
            $names=array('Landdisputes','Complaints');
            $text='';
            if (isset($_POST['contenttype']))
            {
                $x=$_POST['contenttype'];
                $y=$_POST['contentid'];
                $xU=$names[$x];
                $model=$xU::model()->findByPk($y);
               
                if ($model)
                    $text= $this->renderPartial('/landdisputes/view',array('model'=>$model),true,false);
                else $text="not Found";
            }
		$this->render('index',array('text'=>$text));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
        public function actionTest4()
        {
            $models=  Landdisputes::model()->findAll();
            $i=1;
            foreach ($models as $model)
            {
                $model->created_at=time()-$i*3600*24;
                $model->save();
                $i++;
            }
            
        }
        public function actionTest3()
        {
            $models = RevenueVillage::model()->findAll();
            $rule = 'Any-Hex';

$myTrans = Transliterator::create($rule); 

            foreach ($models as $model)
            {
                $name_hi = $model->name_hi;
                $name_en=  $myTrans->transliterate($name_hi);
                print $name_hi." ".$name_en."\n";
            }
        }
	/**
	 * Displays the test page
	 */
	public function actionTest1()
	{
		
		$this->render('test1');
	}
	public function actinUpload()
	{
		header( 'Vary: Accept' );
        if( isset( $_SERVER['HTTP_ACCEPT'] ) && (strpos( $_SERVER['HTTP_ACCEPT'], 'application/json' ) !== false) ) {
            header( 'Content-type: application/json' );
        } else {
            header( 'Content-type: text/plain' );
        }
 
        if( isset( $_GET["_method"] ) ) {
            if( $_GET["_method"] == "delete" ) {
                $success = is_file( $_GET["file"] ) && $_GET["file"][0] !== '.' && unlink( $_GET["file"] );
                echo json_encode( $success );
            }
        } else {
            $this->init( );
            $model = new Uploads;//Here we instantiate our model
 
            //We get the uploaded instance
            $model->file = CUploadedFile::getInstanceByName( 'Issues[attachments]' );
            if( $model->file !== null ) {
                $model->mime_type = $model->file->getType( );
                $model->size = $model->file->getSize( );
                $model->name = $model->file->getName( );
                //Initialize the ddditional Fields, note that we retrieve the
                //fields as if they were in a normal $_POST array
                $model->title = Yii::app()->request->getPost('title', '');
                $model->description  = Yii::app()->request->getPost('description', '');
 $model->code='::';
                if( $model->validate( ) ) {
                    $path = Yii::app() -> getBasePath() . "/data/files";
                    $publicPath = Yii::app()->getBaseUrl()."/files/uploads";
                    if( !is_dir( $path ) ) {
                        mkdir( $path, 0777, true );
                        chmod ( $path , 0777 );
                    }
                    $model->file->saveAs( $path.$model->name );
                    chmod( $path.$model->name, 0777 );
 
                    //Now we return our json
                    echo json_encode( array( array(
                            "name" => $model->name,
                            "type" => $model->mime_type,
                            "size" => $model->size,
                            //Add the title 
                            "title" => $model->title,
                            //And the description
                            "description" => $model->description,
                            "url" => $publicPath.$model->name,
                            "thumbnail_url" => $publicPath.$model->name,
                            "delete_url" => $this->createUrl( "upload", array(
                                "_method" => "delete",
                                "file" => $path.$model->name
                            ) ),
                            "delete_type" => "POST"
                        ) ) );
                } else {
                    echo json_encode( array( array( "error" => $model->getErrors( 'file' ), ) ) );
                    Yii::log( "XUploadAction: ".CVarDumper::dumpAsString( $model->getErrors( ) ), CLogger::LEVEL_ERROR, "xupload.actions.XUploadAction" );
                }
            } else {
                throw new CHttpException( 500, "Could not upload file" );
            }
        }
    }
     public function actionActivateuser()
     {
         foreach (User::model()->findAll() as $user)
         {
             if ($user->status==0)
             {
                 $user->activkey=  UserModule::encrypting(microtime());
                 $user->status=1;
                 $user->save();
             }
         }
     }
    public function actionCreateUser()
    {
        foreach (Designation::model()->findAll() as $designation)
        {
           $user;
            
            $levelClass=$designation->designationType->level->class_name;
             $levelmodel=$levelClass::model()->findByPk($designation->level_type_id);
             $place=$levelmodel?$levelmodel->name_en:'';
           // $place=$designation->place->name_en;
            $username=strtolower($designation->designationType->code.'_'.$place);
            $username=  str_replace("-", "_", $username);
            $username=  str_replace(" ", "_", $username);
            if ($user=User::model()->findByAttributes(array('username'=>$username)))
            {
               print "found\n";
            }
            else {$user=new User;$user->username=$username;
            $user->password= UserModule::encrypting($user->username);
            $user->email=$user->username."@gmail.com";
            $user->activkey=  UserModule::encrypting(microtime());
            $user->status=1;
                 
                 
            if (!$user->validate())
                print_r($user->getErrors());
            else 
            {
                 try{
            $user->save();
            $profile=new Profile();
            $profile->firstname="abc";
            $profile->lastname='abc';
            $profile->mobile="0000000000";
            $profile->designation=$designation->id;
            $profile->user_id=$user->id;
            if ($profile->validate())
               
            $profile->save();
                
            else 
                print_r($profile->getErrors());
            }catch(Exception $ex){print $ex->getMessage();}
            }
            
        }
        }
    }
     public function actionUsersForm()
        {
            if (isset($_GET['page']))
            $page=$_GET['page'];
            else 
                $page=1;
            $message='';
            if (isset($_POST['Profile']))
            {
                foreach ($_POST['Profile'] as $i=>$profile)
                {
                   if (!empty($profile))
                   {
                        $username=$profile['username'];
                        $user=User::model()->findByAttributes(array('username'=>$username));
                        $profileModel=$user->profile;
                        if (!$profileModel)
                        {
                            $profileModel=new Profile;
                           
                        }
                        $profileModel->attributes=$profile;
                        $profileModel->designation=$profile['designation'];
                       if (! $profileModel->validate())
                       {
                          
                        $message.=$username.':'.print_r($profileModel->getErrors(),true);
                       // Yii::app()->end();
                        
                       }
                       else 
                       {
                        $profileModel->user_id=$user->id;
                         $profileModel->attachbehavior('SaveUserRole',new SaveUserRole());
                        $profileModel->save();
                        
                        // $user->user_profile_id=$profileModel->id;
                        $user->attachbehavior('SaveUserRole',new SaveUserRole());
                         $user->save();
                       }
                   }
                }
            }
            Yii::app()->user->setFlash('notification',$message);
            $this->render('usersForm',array('page'=>$page));
        }
    public function actioChange()
    {
       $cvs= CensusVillage::model()->findAll();
        foreach($cvs as $cv)
        {
            $roman=array('itrans');
            $input=  strtolower($cv->name_en);
            $cv->name_hi="";
             foreach ($roman as $from)
             {
                         $to='devanagari';
                         
                         $sanscript = new Sanscript();
                         $cv->name_hi=" ".$sanscript->t($input, $from, $to);
                         
             }
$cv->save();
        
    }
    }
 
    public function actioImportCSV()
	{
	   $filename="C:/Users/admin/Downloads/LGD(1).csv";
	   $file = fopen($filename,"r");
	   if ($file) {
	      while( $array = fgetcsv($file))
		  {
                  //print_r($array);
                // print $array[0]." ".is_numeric($array[0])."<br/>";
		     if  (is_numeric($array[0])==TRUE)
                     {
                       //   print $array[0]." ".is_numeric($array[0])."<br/>";
                     //  print_r($array);
                         try{
                         $model = new CensusVillage();
                         $model->code=$array[0];
                         $model->name_en=$array[2];
                         $from='itrans';
                         $to='devanagari';
                         $sanscript = new Sanscript();
                         $model->name_hi=$sanscript->t($array[2], $from, $to);
                         $model->census2001_code=$array[6];
                         $model->census2011_code=$array[9];
                         $model->subsdistrict_code=$array[4];
                         if ($model->validate())
                         $model->save();
                         else print_r($model->getErrors());
                         //print $model->name_hi."\n";
                         }catch (Exception $e) {print $e->getMessage();}
                     }
		  }
		  
		}
	}
	
}
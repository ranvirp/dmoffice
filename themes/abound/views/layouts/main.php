<?php
 ///check if user has been assigned a designation or not?
if (!Yii::app()->user->isGuest)
if (!Designation::getDesignationModelByUser(Yii::app()->user->id))
{
    print "No designation assigned. assign a designation first to this user.Contact site administrator"."<a href='user/logout'>Logout</a>";
    //$this->redirect('designation/userAssign');
    Yii::app()->end();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Land Disputes Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Complaints/Land Disputes Management System">
    <meta name="author" content="Ranvir Prasad">
	<?php
	//<link href='http://fonts.googleapis.com/css?family=Carrois+Gothic' rel='stylesheet' type='text/css'>
?>
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
	<?php
	  $baseUrl = Yii::app()->theme->baseUrl; 
	  $cs = Yii::app()->getClientScript();
           //  $cs->registerScriptFile(Yii::app()->baseUrl.'/js/jquery-1.11.1.min.js');
            
	 Yii::app()->clientScript->registerCoreScript('jquery');
           $cs->registerScriptFile(Yii::app()->baseUrl.'/js/jquery-ui.min.js');
	?>
    <!-- Fav and Touch and touch icons -->
    <link rel="shortcut icon" href="<?php echo $baseUrl;?>/img/icons/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $baseUrl;?>/img/icons/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $baseUrl;?>/img/icons/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?php echo $baseUrl;?>/img/icons/apple-touch-icon-57-precomposed.png">
	<?php  
       
	  $cs->registerCssFile(Yii::app()->baseUrl.'/css/bootstrap.min.css');
           $cs->registerCssFile(Yii::app()->baseUrl.'/css/jquery-ui.min.css');
	  $cs->registerCssFile(Yii::app()->baseUrl.'/css/bootstrap-theme.min.css');
	  //$cs->registerCssFile($baseUrl.'/css/abound.css');
            $cs->registerCssFile($baseUrl.'/css/datepicker3.css');
             $cs->registerCssFile(Yii::app()->baseUrl.'/css/bootstrap-glyphicons.css');
          $cs->registerCssFile(Yii::app()->baseUrl.'/css/custom.css');
         // $cs->registerCssFile(Yii::app()->baseUrl.'/css/chosen.min.css');
           $cs->registerCssFile(Yii::app()->baseUrl.'/css/font-awesome.min.css');
            $cs->registerCssFile(Yii::app()->baseUrl.'/css/sb-admin-2.css');
	  
	  ?>
      <!-- styles for style switcher -->
      	<link rel="stylesheet" type="text/css" href="<?php echo $baseUrl;?>/css/style-blue.css" />
        <link rel="alternate stylesheet" type="text/css" media="screen" title="style2" href="<?php echo $baseUrl;?>/css/style-brown.css" />
        <link rel="alternate stylesheet" type="text/css" media="screen" title="style3" href="<?php echo $baseUrl;?>/css/style-green.css" />
        <link rel="alternate stylesheet" type="text/css" media="screen" title="style4" href="<?php echo $baseUrl;?>/css/style-grey.css" />
        <link rel="alternate stylesheet" type="text/css" media="screen" title="style5" href="<?php echo $baseUrl;?>/css/style-orange.css" />
        <link rel="alternate stylesheet" type="text/css" media="screen" title="style6" href="<?php echo $baseUrl;?>/css/style-purple.css" />
        <link rel="alternate stylesheet" type="text/css" media="screen" title="style7" href="<?php echo $baseUrl;?>/css/style-red.css" />
        <script>
            var google_control;
            </script>
            <?php
          
	  $cs->registerScriptFile(Yii::app()->baseUrl.'/js/bootstrap.min.js');
        //  $cs->registerScriptFile($baseUrl.'/js/chosen.jquery.min.js');
	  //$cs->registerScriptFile($baseUrl.'/js/plugins/jquery.sparkline.js');
	//  $cs->registerScriptFile($baseUrl.'/js/plugins/jquery.flot.min.js');
	 // $cs->registerScriptFile($baseUrl.'/js/plugins/jquery.flot.pie.min.js');
	 // $cs->registerScriptFile($baseUrl.'/js/charts.js');
	//  $cs->registerScriptFile($baseUrl.'/js/plugins/jquery.knob.js');
	 // $cs->registerScriptFile($baseUrl.'/js/plugins/jquery.masonry.min.js');
	  $cs->registerScriptFile($baseUrl.'/js/styleswitcher.js');
           $cs->registerScriptFile($baseUrl.'/js/bootstrap-datepicker.js');
          $cs->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.jeditable.mini.js');
Yii::app()->ClientScript->registerCssFile(Yii::app()->baseUrl.'/css/bootstrap-select.min.css');
Yii::app()->ClientScript->registerScriptFile(Yii::app()->baseUrl.'/js/bootstrap-select.min.js');

	?>
            <script src="http://code.jquery.com/jquery-migrate-1.2.1.js"></script>
		    <script type="text/javascript" src="https://www.google.com/jsapi" ></script>
        <script src='<?php echo Yii::app()->baseUrl.'/js/googleTransliteration.js'; ?>' type='text/javascript' ></script>
 <script src='<?php echo Yii::app()->baseUrl.'/js/common.js'; ?>' type='text/javascript' ></script>
 
  </head>

<body>
    
   
<!-- Require the navigation -->
<?php require_once('tpl_navigation_1.php')?>

    
<section id="main-body">
    <div class="container-fluid">
        <?php
    foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="flash-' . $key . '">' . print_r($message,true) . "</div>\n";
    }
?>
            <!-- Include content pages -->
            <?php echo $content; ?>
    </div>
   
</section>
<!-- Require the footer -->
<?php 
//require_once('tpl_footer.php')
?>

  </body>
</html>
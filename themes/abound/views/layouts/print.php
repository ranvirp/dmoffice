
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Land Disputes Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Learning Level Management System">
    <meta name="author" content="Ranvir Prasad">
	
	<?php
	  $baseUrl = Yii::app()->theme->baseUrl; 
	  $cs = Yii::app()->getClientScript();
	  Yii::app()->clientScript->registerCoreScript('jquery');
	?>
    <!-- Fav and Touch and touch icons -->
    <link rel="shortcut icon" href="<?php echo $baseUrl;?>/img/icons/favicon.ico">
   <?php  
	  $cs->registerCssFile($baseUrl.'/css/bootstrap.min.css');
	  $cs->registerCssFile($baseUrl.'/css/bootstrap-theme.min.css');
	  $cs->registerCssFile($baseUrl.'/css/abound.css');
            $cs->registerCssFile($baseUrl.'/css/datepicker3.css');
             $cs->registerCssFile(Yii::app()->baseUrl.'/css/bootstrap-glyphicons.css');
          $cs->registerCssFile(Yii::app()->baseUrl.'/css/custom.css');
           $cs->registerCssFile(Yii::app()->baseUrl.'/css/font-awesome.min.css');
	  //$cs->registerCssFile($baseUrl.'/css/style-blue.css');
	  
	  $cs->registerScriptFile($baseUrl.'/js/bootstrap.min.js');
	  //$cs->registerScriptFile($baseUrl.'/js/plugins/jquery.sparkline.js');
	  $cs->registerScriptFile($baseUrl.'/js/plugins/jquery.flot.min.js');
	  $cs->registerScriptFile($baseUrl.'/js/plugins/jquery.flot.pie.min.js');
	 // $cs->registerScriptFile($baseUrl.'/js/charts.js');
	  $cs->registerScriptFile($baseUrl.'/js/plugins/jquery.knob.js');
	  $cs->registerScriptFile($baseUrl.'/js/plugins/jquery.masonry.min.js');
	  $cs->registerScriptFile($baseUrl.'/js/styleswitcher.js');
           $cs->registerScriptFile($baseUrl.'/js/bootstrap-datepicker.js');
          $cs->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.jeditable.mini.js');

	?>
 <script src='<?php echo Yii::app()->baseUrl.'/js/common.js'; ?>' type='text/javascript' ></script>
 
  </head>

<body>


    

    <div class="container">
            <!-- Include content pages -->
            <?php echo $content; ?>
    </div>


<!-- Require the footer -->
<?php 
//require_once('tpl_footer.php')
?>

  </body>
</html>
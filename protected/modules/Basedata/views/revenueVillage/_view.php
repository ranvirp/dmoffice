<?php
/* @var $this RevenueVillageController */
/* @var $data RevenueVillage */
?>

<div class="view">

    	<b><?php echo CHtml::encode($data->getAttributeLabel('code')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->code),array('view','id'=>$data->code)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tehsil_code')); ?>:</b>
	<?php echo CHtml::encode($data->tehsil_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name_en')); ?>:</b>
	<?php 
        /*
        $input=$data->name_hi;
      //  $roman=array('itrans','hk1','iast','itrans_dravidian','kolkata','slp1','velthuis','wx');
        $roman=array('itrans');
        $from='devanagari';
        $sanscript = new Sanscript();
        //$to='itrans';
        foreach ($roman as $to){
        
  $models = RevenueVillage::model()->findAll();
  foreach ($models as $model){
      $input=$model->name_hi;
$output = $sanscript->t($input, $from, $to);
if (strcmp(substr($input,-1),'ा')!=0)
{
 if (substr($output,-1)=='a')
         $output=substr($output,0,-1);
}

$output=ucfirst(strtolower($output));
$model->name_en=$output;
$model->save();
  }
  exit;
        }
        */
        echo CHtml::encode($data->name_en)."&nbsp;";
        
        ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name_hi')); ?>:</b>
	<?php echo CHtml::encode($data->name_hi); ?>
	<br />

	


</div>
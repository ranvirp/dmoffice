<?php
/* @var $this LanddisputesController */
/* @var $data Landdisputes */
?>

<div class="view">

    	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('complainants')); ?>:</b>
	<?php echo CHtml::encode($data->complainants); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('oppositions')); ?>:</b>
	<?php echo CHtml::encode($data->oppositions); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('revenuevillage')); ?>:</b>
	<?php echo CHtml::encode($data->revenuevillage); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('policestation')); ?>:</b>
	<?php echo CHtml::encode($data->policestation); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('category')); ?>:</b>
	<?php echo CHtml::encode($data->category); ?>
	<br />

	
	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	
	<b><?php echo CHtml::encode($data->getAttributeLabel('nextdateofaction')); ?>:</b>
	<?php echo CHtml::encode($data->nextdateofaction); ?>
	<br />

	
	

</div>
<?php
/* @var $this InstructionsController */
/* @var $data Instructions */
?>

<div class="view">

    	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('schemeid')); ?>:</b>
	<?php echo CHtml::encode($data->schemeid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sender')); ?>:</b>
	<?php echo CHtml::encode($data->sender); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('receiver')); ?>:</b>
	<?php echo CHtml::encode($data->receiver); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('instruction')); ?>:</b>
	<?php echo CHtml::encode($data->instruction); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('attachments')); ?>:</b>
	<?php echo CHtml::encode($data->attachments); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('parentinst')); ?>:</b>
	<?php echo CHtml::encode($data->parentinst); ?>
	<br />

	*/ ?>

</div>
<?php
/* @var $this InstructionsController */
/* @var $model Instructions */
/* @var $form TbActiveForm */
?>

<div class="form col-md-10">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'instructions-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
        //'layout'=>  TbHtml::FORM_LAYOUT_HORIZONTAL,
)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>
   
    <div class="row">
    
    	 <?php echo $form->dropDownListControlGroup($model,'schemeid',  Utility::listAll('Schemes'),array('empty'=>'None','span'=>5,'maxlength'=>11)); ?>
    </div>
    <div class="row">
    
    	 <?php echo $form->hiddenField($model,'sender', array('type'=>'hidden','value'=> Designation::getDesignationByUser(Yii::app()->user->id))); ?>
    </div>
    <div class="row">
    
    	 <?php  $this->widget('OfficerWidget',array('model'=>$model,'attribute'=>'receiver')) ?>

    </div>
    <div class="row">
    	 <?php echo $form->textAreaControlGroup($model,'instruction',array('class'=>'hindiinput','span'=>5)); ?>

    </div>
    <div class="row">
    	
    
    	 <?php  $this->widget('ext.basicJqueryUpload.basicJqueryFileUploadWidget',array('model'=>$model,'attribute'=>'attachments')); ?>

    </div>
    	

    <div class="form-actions">
        <?php echo TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array(
		    'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
		    'size'=>TbHtml::BUTTON_SIZE_LARGE,
		)); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
  
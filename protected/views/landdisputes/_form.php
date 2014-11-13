<?php
/* @var $this LanddisputesController */
/* @var $model Landdisputes */
/* @var $form TbActiveForm */
?>
<?php Yii::import('Basedata.components.*');?>
<div class="form">

    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'landdisputes-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
            //'layout'=>  TbHtml::FORM_LAYOUT_HORIZONTAL,
    ));
    ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>
        <?php $lang = Yii::app()->language; ?>
        <?php echo $form->errorSummary($model); ?>
    <div class="row">
        <div class='col-md-2'>
<?php echo $form->dropDownlistControlGroup($model,'prevreferencetype',Prevreference::listAll()); ?>    
    </div>
         <div class='col-md-2'>
<?php echo $form->textFieldControlGroup($model,'prevreferenceno'); ?>    
    </div>
      
        <div class='col-md-4'>
<?php $this->widget('RevenueVillageWidget', array('model' => $model, 'attribute' => 'revenuevillage')); ?>    
    </div>
        <div class='col-md-4'>
           
    <?php echo $form->dropDownListControlGroup($model, 'policestation', Utility::listAllByAttributes('Policestation',array('district_code'=>Utility::getDistrict(Yii::app()->user->id))),array('span' => 5, 'maxlength' => 11)); ?>
   
        </div>
    </div>  
   
 <button type="button" class="btn btn-danger" data-toggle="collapse" data-target="#complainant">
  Complainant
</button>
<button type="button" class="btn btn-danger" data-toggle="collapse" data-target="#opposition">
  Opposition
</button>
<div class="row">
<div id="complainant" class='col-md-4 collapse in'>
    
    <fieldset>
        <legend><?php echo Yii::t('app','Complainant');?></legend>
       
          <?php echo  $form->textFieldControlGroup($model, 'complainants',array('class'=>'hindiinput'));?> 
         <?php echo  $form->textFieldControlGroup($model, 'complainantmobileno',array('size'=>13));?>     
    </fieldset>
    </div>
    
    <div id="opposition" class='col-md-4 collapse in'>
 <fieldset>
        <legend><?php echo Yii::t('app','Opposition');?></legend>
        
     <?php echo  $form->textFieldControlGroup($model, 'oppositions',array('class'=>'hindiinput'));?> 
         <?php echo  $form->textFieldControlGroup($model, 'oppositionmobileno',array('size'=>13));?>         
    </fieldset>
    </div>
</div>
    <div class='row'>
         <div class='col-md-6'>
    <?php echo $form->dropDownListControlGroup($model, 'category',  Utility::listAllByAttributes('Complaintcategories', array('department_code'=>'8')), array('span' => 5, 'maxlength' => 11)); ?>
    </div>
	
<div class='col-md-2'>
<?php echo $form->textFieldControlGroup($model, 'gatanos', array('span' => 5, 'maxlength' =>20)); ?>
</div>
        <div class='col-md-2'>
    <?php echo $form->textFieldControlGroup($model, 'disputependingfor', array('span' => 5, 'maxlength' => 6)); ?>
</div>
        </div>
		<div class='row'>
        <?php $this->widget('OfficerWidget',array('model'=>$model,'attribute'=>'officerassigned'));?>
    </div>
    <div class="row">
        <div class="col-md-10">
    <?php echo $form->textAreaControlGroup($model, 'description', array('span' => 5, 'maxlength' => 200,'class'=>'hindiinput')); ?>
        </div>
        </div>
    <div class="row">
        <div class='col-md-2'>
        <?php echo $form->checkBoxControlGroup($model, 'policerequired'); ?>

</div>

   <div class='col-md-2'>
    <?php echo $form->checkBoxControlGroup($model, 'casteorcommunal', array('span' => 5, 'maxlength' => 11)); ?>
</div>
        <div class='col-md-2'>
<?php 
$priority=array('None','Urgent','Immediate','Normal');
echo $form->dropDownListControlGroup($model, 'priority',$priority);?>
</div>
 
    </div>

   <div class="row">

    <div class='col-md-2'>
<?php echo $form->inlineRadioButtonListControlGroup($model, 'courtcasepending',array('1'=>'Yes','0'=>'No'), array('span' => 5, 'maxlength' => 4,'data-toggle'=>"collapse", 'data-target'=>"#courtcasedetails")); ?>
    </div>
 <?php if ($model->courtcasepending==1):?>
<div class="col-md-7 collapse in" id="courtcasedetails">
    <?php else:?>
   <div class="col-md-7 collapse " id="courtcasedetails"> 
       <?php endif;?>
      <div class="row"> 
    <?php echo $form->textFieldControlGroup($model, 'courtname', array('span' => 5, 'maxlength' => 1000)); ?>

<?php echo $form->textAreaControlGroup($model, 'courtcasedetails', array('span' => 5, 'maxlength' => 1000)); ?>
   </div>
       <div class="row">
       <div class='col-md-2'>
<?php echo $form->inlineRadioButtonListControlGroup($model, 'stayexists',array('1'=>'Yes','0'=>'No'), array('span' => 5, 'maxlength' => 4,'data-toggle'=>"collapse", 'data-target'=>"#stayorders")); ?>
    </div>
      <div class='col-md-9' id="stayorders">
         
    
       
       <?php $this->widget('application.extensions.basicJqueryUpload.basicJqueryFileUploadWidget',array('model'=>$model,'attribute'=>'stayorders'));?>
      </div>
       </div>
   </div>
   

   </div>
       <div class='row'>
           <div class='panel panel-success'>
               <div class='panel-heading'>Documents </div>
               <div class='panel-body'>
             <?php $this->widget('application.extensions.basicJqueryUpload.basicJqueryFileUploadWidget',array('model'=>$model,'attribute'=>'documents'));?>
               </div>
               </div>
       </div>
<div class="form-actions">
<?php
echo TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array(
    'color' => TbHtml::BUTTON_COLOR_PRIMARY,
    'size' => TbHtml::BUTTON_SIZE_LARGE,
));
?>
</div>

<?php $this->endWidget(); ?>

</div>
<script>
    $(document).ready(function(){$('.datepicker').datepicker()});
    </script>
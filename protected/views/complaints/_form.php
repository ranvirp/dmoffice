<?php
/* @var $this LanddisputesController */
/* @var $model Landdisputes */
/* @var $form TbActiveForm */
?>
<?php Yii::import('Basedata.components.*');?>
<div class="form">

    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'complaints-form',
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
        <div class='col-md-6'>
<?php $this->widget('RevenueVillageWidget', array('model' => $model, 'attribute' => 'revenuevillage')); ?>    
    </div>
        <div class='col-md-4'>
            <fieldset>
                <legend><?php echo Yii::t('app','PoliceStation');?></legend>
    <?php echo $form->dropDownListControlGroup($model, 'policestation', Utility::listAllByAttributes('Policestation',array('district_code'=>Utility::getDistrict(Yii::app()->user->id))),array('span' => 5, 'maxlength' => 11)); ?>
   </fieldset>
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
        <?php $this->widget('OfficerWidget',array('model'=>$model,'attribute'=>'officerassigned'));?>
    </div>
    <div class='row'>
         <div class='col-md-6'>
    <?php echo $form->dropDownListControlGroup($model, 'category', array() , array('span' => 5, 'maxlength' => 11,)); ?>
             <p class='help-block'><a  onclick="populateDropdown('<?php echo Yii::app()->createUrl('/Complaintcategories/getCategories/dept/');?>'+'/'+$('#Complaints_officerassigned_deptDropDown').val(),$('#Complaints_category').attr('id'))">Click</a> to populate categories </p>
    </div>

       
    <div class="row">
        <div class="col-md-10">
    <?php echo $form->textAreaControlGroup($model, 'description', array('span' => 5, 'maxlength' => 200,'class'=>'hindiinput')); ?>
        </div>
        </div>
    <div class="row">
        

   
 <div class='col-md-2'>
<?php echo $form->textFieldControlGroup($model, 'nextdateofaction',array('class'=>'datepicker','data-date-format'=>"dd/mm/yyyy",'span'=>2,'maxlength'=>10));?>
</div>
    </div>

   <div class="row">

    
      <div class='col-md-9' id="documents">
         
    
       
       <?php $this->widget('application.extensions.basicJqueryUpload.basicJqueryFileUploadWidget',array('model'=>$model,'attribute'=>'documents'));?>
      </div>
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
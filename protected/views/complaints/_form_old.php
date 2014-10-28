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

<div id="complainant" class='row collapse in'>
    
    <fieldset>
        <legend><?php echo Yii::t('app','Complainant');?></legend>
       
   <?php $this->widget('citizenRuralWidget',array('form'=>$form,'models'=>$complainants));?>
       
    </fieldset>
    </div>
    
    <div id="opposition" class='row collapse in'>
 <fieldset>
        <legend><?php echo Yii::t('app','Opposition');?></legend>
        
   <?php $this->widget('citizenRuralWidget',array('form'=>$form,'models'=>$oppositions));?>
       
    </fieldset>
    </div>
 
    <div class='row'>
<div class='col-md-2'>
<?php echo $form->textFieldControlGroup($model, 'gatanos', array('span' => 5, 'maxlength' =>20)); ?>
</div>
    <div class='col-md-6'>
    <?php echo $form->dropDownListControlGroup($model, 'category',  Utility::listAllByAttributes('Complaintcategories', array('department_code'=>'8')), array('span' => 5, 'maxlength' => 11)); ?>
    </div>
</div>
    <?php echo $form->textAreaControlGroup($model, 'description', array('span' => 5, 'maxlength' => 200)); ?>
<div class='col-md-2'>
        <?php echo $form->checkBoxControlGroup($model, 'policerequired'); ?>

</div>

   
<div class='col-md-2'>


    <?php echo $form->textFieldControlGroup($model, 'disputependingfor', array('span' => 5, 'maxlength' => 6)); ?>
</div>
    <div class='col-md-2'>
<?php echo $form->inlineRadioButtonListControlGroup($model, 'courtcasepending',array('1'=>'Yes','0'=>'No'), array('span' => 5, 'maxlength' => 4)); ?>
    </div>

<?php echo $form->textAreaControlGroup($model, 'courtcasedetails', array('span' => 5, 'maxlength' => 1000)); ?>
<div class='col-md-2'>
<?php echo $form->textFieldControlGroup($model, 'nextdateofaction',array('class'=>'datepicker','data-date-format'=>"mm/dd/yyyy",'span'=>2,'maxlength'=>10));?>
</div>

<div class='col-md-2'>
    <?php echo $form->checkBoxControlGroup($model, 'casteorcommunal', array('span' => 5, 'maxlength' => 11)); ?>
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
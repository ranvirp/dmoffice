<?php
/* @var $this LanddisputesController */
/* @var $model Landdisputes */
/* @var $form CActiveForm */
?>
<style>
   div.showgrid > div
    {
        border:1px solid gold;
    }
    .form-control-inline {
    min-width: 0;
    width: auto;
    display: inline;
}
</style>
<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
    <div class="row showgrid">
       
        <div class="col-md-5">
       <?php $this->widget('RevenueVillageWidget', array('model' => $model, 'attribute' => 'revenuevillage')); ?>   
        </div>
        
   
        
        <div class="col-md-3">
     
    <?php echo $form->dropDownListControlGroup($model, 'policestation', Utility::listAllByAttributes('Policestation',array('district_code'=>Utility::getDistrict(Yii::app()->user->id))),array('empty'=>'None','class'=>'form-control-inline','span' => 5, 'maxlength' => 11)); ?>

        </div>
   
         <div class="col-md-4">
         <?php echo $form->dropDownListControlGroup($model, 'category',  Utility::listAllByAttributes('Complaintcategories', array('department_code'=>'8')), array('empty'=>'None','span' => 5, 'maxlength' => 11)); ?>
</div> 
        <div class='col-md-2'>
<?php 
$priority=array('None','Urgent','Immediate','Normal');
echo $form->dropDownListControlGroup($model, 'priority',$priority);?>
</div>
    </div>
    <div class="row"></div> 
     <div class="row">
    <div class="col-md-2">
      <?php echo $form->checkBoxControlGroup($model, 'policerequired'); ?>
    </div>
    <div class='col-md-2'>
<?php echo $form->inlineRadioButtonListControlGroup($model, 'courtcasepending',array('1'=>'Yes','0'=>'No'), array('span' => 5, 'maxlength' => 4,'data-toggle'=>"collapse", 'data-target'=>"#courtcasedetails")); ?>
    </div>
               
  <div class='col-md-2'>
<?php echo $form->inlineRadioButtonListControlGroup($model, 'stayexists',array('1'=>'Yes','0'=>'No'), array('span' => 5, 'maxlength' => 4,'data-toggle'=>"collapse", 'data-target'=>"#stayorders")); ?>
    </div>

                    
      <div class='col-md-2'>
    <?php echo $form->checkBoxControlGroup($model, 'casteorcommunal', array('span' => 5, 'maxlength' => 11)); ?>
</div>
          <div class='col-md-2'>
    <?php echo $form->checkBoxControlGroup($model, 'status', array('span' => 5, 'maxlength' => 11)); ?>
</div>
</div>
        <div class="row form-actions">
        <?php echo TbHtml::submitButton('Search',  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->
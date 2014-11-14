<?php
/* @var $this LanddisputesController */
/* @var $model Landdisputes */
/* @var $form CActiveForm */
?>

<div class="form form-inline">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
        //'layout'=>  TbHtml::FORM_LAYOUT_HORIZONTAL,
	'method'=>'get',
)); ?>
    <div class="row showgrid">
        <div class='col-md-2'>
<?php echo $form->textFieldControlGroup($model, 'created_at',array('class'=>'datepicker','data-date-format'=>"dd/mm/yyyy",'span'=>2,'maxlength'=>10));?>

   
   
        
        <?php echo TbHtml::submitButton('Filter',  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
            </div>
   
 </div>
    <?php $this->endWidget(); ?>

</div><!-- search-form -->
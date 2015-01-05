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
	'method'=>'post',
)); ?>
    <div class="row">
       
        
    <div class="row">
         <div class='col-md-2'>
            <?php echo $form->dropDownlistControlGroup($model, 'prevreferencetype', Prevreference::obj()->options); ?>    
        </div>
        <div class='col-md-2'>
            <?php echo $form->textFieldControlGroup($model, 'prevreferenceno'); ?>    
        </div>
    </div> 
    
          <div class='col-md-2'>
    
	<?php 
$status=array('Pending','Disposed');
echo $form->dropDownListControlGroup($model, 'status',$status);?>

	
</div>
</div>
        <div class="row form-actions">
        <?php echo TbHtml::submitButton('Search',  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->
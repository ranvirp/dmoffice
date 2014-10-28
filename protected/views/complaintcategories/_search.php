<?php
/* @var $this ComplaintcategoriesController */
/* @var $model Complaintcategories */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

                    <?php echo $form->textFieldControlGroup($model,'id',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'name_hi',array('span'=>5,'maxlength'=>2000)); ?>

                    <?php echo $form->textFieldControlGroup($model,'name_en',array('span'=>5,'maxlength'=>2000)); ?>

                    <?php echo $form->textFieldControlGroup($model,'department_code',array('span'=>5,'maxlength'=>10)); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton('Search',  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->
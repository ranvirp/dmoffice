<?php
/* @var $this LanddisputesController */
/* @var $model Landdisputes */
/* @var $form TbActiveForm */
?>
<?php Yii::import('Basedata.components.*');?>
<div class="form">

    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'landdisputes-update-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
        'action'=>'/landdisputes/update/id/'.$model->id
            //'layout'=>  TbHtml::FORM_LAYOUT_HORIZONTAL,
    ));
    ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>
        <?php $lang = Yii::app()->language; ?>
        <?php echo $form->errorSummary($model); ?>
    
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
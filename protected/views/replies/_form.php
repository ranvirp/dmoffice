<style>
    .scrollable
    {
        overflow-y: auto;
        height:120px;
    }
</style>
<h1>Add action taken or reply</h1>
<div class="row scrollable">
    <?php echo $parentcontent;?>
</div> 
<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'replies-form',
	'enableAjaxValidation'=>true,
	'clientOptions'=>array('validateOnChange'=>false,'validateOnSubmit'=>TRUE),
	'action'=>Yii::app()->createUrl('replies/create/content_type/'.$content_type.'/content_type_id/'.$content_type_id),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->textAreaControlGroup($model,'content',array('class'=>'hindiinput'));?>
	</div>

	<div class="row">
			<?php echo $form->hiddenField($model,'content_type');?>
</div>


	<div class="row">
			<?php echo $form->hiddenField($model,'content_type_id');?>
</div>

 <?php $this->widget('application.extensions.basicJqueryUpload.basicJqueryFileUploadWidget',array('model'=>$model,'attribute'=>'attachments'));?>
      
	<div class="row buttons">
		<?php echo CHtml::ajaxSubmitButton("Save","",
		array('dataType'=>'json',
		'success'=>"function(data)
                {
				if (!data.redirect){
                    // Update the status
                    $('.form').html(data.html);
					}
				else {
				//alert(data.redirect);
				   window.location.replace(data.redirect);
				   }
                    
 
                } "),array("id"=>"st1"));
 ?>
	</div>

<?php $this->endWidget(); ?>

<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('id'=>'st2')); ?>
	</div>





</div><!-- form -->
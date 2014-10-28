
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'replies-form',
	'enableAjaxValidation'=>false,
	'action'=>Yii::app()->createUrl('replies/create'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	
	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'content'); ?>
	</div>
	<div class="row">
			<?php echo $form->hiddenField($model,'content_type');?>
</div>


	<div class="row">
			<?php echo $form->hiddenField($model,'content_type_id');?>
</div>

	<div class="row">
	<?php echo $form->hiddenField($model,'attachments',array('value'=>""));?>
		</div>

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
				alert(data.redirect);
				   window.location.replace(data.redirect);
				   }
                    
 
                } "),array("style"=>"visibility:hidden","id"=>"st1"));
 ?>
 </div>
         <?php $this->widget('application.extensions.basicJqueryUpload.basicJqueryFileUploadWidget',array('model'=>$model,'attribute'=>'attachments'));?>
      

<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>
<?php $this->endWidget(); ?>






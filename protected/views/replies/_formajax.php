
<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'ajax-replies-form',
	'enableAjaxValidation'=>false,
	//'clientOptions'=>array('validateOnChange'=>false,'validateOnSubmit'=>TRUE),
	'action'=>'#',
	//'action'=>Yii::app()->createUrl('replies/create/content_type/'.$content_type.'/content_type_id/'.$content_type_id),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->textAreaControlGroup($model,'content',array('class'=>'hindiinput','onclick'=>'js:google_control.makeTransliteratable($(this));'));?>
	</div>

	<div class="row">
			<?php echo $form->hiddenField($model,'content_type');?>
</div>


	<div class="row">
			<?php echo $form->hiddenField($model,'content_type_id');?>
</div>

 <?php $this->widget('application.extensions.basicJqueryUpload.basicJqueryFileUploadWidget',array('model'=>$model,'attribute'=>'attachments'));?>
      
	<div class="row buttons form-actions">
		<?php 
                
        echo CHtml::ajaxSubmitButton("Save",
               Yii::app()->createUrl('replies/create/content_type/'.$content_type.'/content_type_id/'.$content_type_id),
		array(
		//'dataType'=>'json',
                    'type'=>'post',
		'success'=>"function(data)
                {
                window.location.replace('".Yii::app()->createUrl('/'.$content_type.'/'.$content_type_id)."')
               //alert(data);
               // console.log(data);
                //if (typeof data != 'object')
                  // data=$.parseJSON(data);
                   //alert(data);
			  if (! data.redirect){
                    // Update the status
                    $('.form').html(data.html);
					}
				else {
				alert(data.redirect);
				   window.location.replace(data.redirect);
                                  // window.location.reload();
				   }
                    
 
                } "),array("id"=>"st1",'class'=>'btn btn-info'));
                 
 ?>
	</div>
<div class="row buttons">
		<?php 
		//echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save');
		?>
	</div>
<?php $this->endWidget(); ?>

        <script>
             var options = {
          sourceLanguage:
              google.elements.transliteration.LanguageCode.ENGLISH,
          destinationLanguage:
              [google.elements.transliteration.LanguageCode.HINDI],
          shortcutKey: 'ctrl+g',
          transliterationEnabled: true
      };
            google_control =
          new google.elements.transliteration.TransliterationControl(options);
        google_control.makeTransliteratable($('.hindiinput'));
        </script>




</div><!-- form -->
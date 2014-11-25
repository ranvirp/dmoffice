<?php
/* @var $this InstructionsController */
/* @var $model Instructions */
?>

<?php
$this->breadcrumbs=array(
	'Instructions'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Instructions', 'url'=>array('index')),
	array('label'=>'Create Instructions', 'url'=>array('create')),
	array('label'=>'Update Instructions', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Instructions', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Instructions', 'url'=>array('admin')),
);
?>

<h1>View Instructions #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'id',
		
		array('name'=>'sender','value'=>$model->senderDesignation->name_hi),
		array('name'=>'receiver','value'=>$model->receiverDesignation->name_hi),
		'instruction',
		array('name'=>'stat','value'=>$model->status?'Disposed':'Pending'),
		array('name'=>'attachments','value'=>Files::showAttachmentsInline($model, 'attachments'),'type'=>'raw'),
		
	),
)); ?>
<?php

if ($displayAttach==true)
{
   // echo $this->widget('application.extensions.basicJqueryUpload.basicJqueryFileUploadWidget',array('model'=>$model,'attribute'=>'documents'),true);

    echo $this->renderPartial('_form_1',array('model'=>$model),true);
}
else 
{
    echo TbHtml::btn(TbHtml::BUTTON_TYPE_LINK,'Attach (More) files',array('onClick'=>'window.location.replace("/instructions/view/id/"+"'.$model->id.'"+"/d/1")'));

}
echo CHtml::ajaxButton('उत्तर दर्ज करें',Ccontroller::createUrl('/replies/create',array('content_type'=>'Instructions','content_type_id'=>$model->id)),array('dataType'=>'json',
  'type'=>'post',	
    'success'=>"function(data){
	$('#commentdiv').html(data.html);
	}"));

echo '<div id="commentdiv"></div>';
echo $this->renderPartial('/instructions/_replies',array(
			'replies'=>$model->replies,
		),true); 
/*
echo CHtml::ajaxButton('Attach files', Yii::app()->createUrl('/Basedata/files/attach',array('m'=>get_class($model),'idd'=>$model->id,'attr'=>'documents')),array('dataType'=>'json',
    'type'=>'get',
    'success'=>"function(data){
	$('#documents1').html(data.html);}"));

	*/
?>

<div id="documents1"></div>
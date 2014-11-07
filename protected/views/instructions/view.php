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
		array('name'=>'schemeid','value'=>$model->scheme->name_hi),
		array('name'=>'sender','value'=>$model->senderDesignation->name_hi),
		array('name'=>'receiver','value'=>$model->receiverDesignation->name_hi),
		'instruction',
		array('name'=>'stat','value'=>$model->stat?'Disposed':'Pending'),
		array('name'=>'attachments','value'=>Files::showAttachmentsInline($model, 'attachments'),'type'=>'raw'),
		
	),
)); ?>
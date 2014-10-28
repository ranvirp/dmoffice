<?php
/* @var $this AgencyController */
/* @var $model Agency */
?>

<?php
$this->breadcrumbs=array(
	'Agencies'=>array('index'),
	$model->code,
);

$this->menu=array(
	array('label'=>'List Agency', 'url'=>array('index')),
	array('label'=>'Create Agency', 'url'=>array('create')),
	array('label'=>'Update Agency', 'url'=>array('update', 'id'=>$model->code)),
	array('label'=>'Delete Agency', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->code),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Agency', 'url'=>array('admin')),
);
?>

<h1>View Agency #<?php echo $model->code; ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'code',
		'dept_code',
		'name_en',
		'name_hi',
		'district_code',
	),
)); ?>
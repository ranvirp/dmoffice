<?php
/* @var $this PolicestationController */
/* @var $model Policestation */
?>

<?php
$this->breadcrumbs=array(
	'Policestations'=>array('index'),
	$model->code,
);

$this->menu=array(
	array('label'=>'List Policestation', 'url'=>array('index')),
	array('label'=>'Create Policestation', 'url'=>array('create')),
	array('label'=>'Update Policestation', 'url'=>array('update', 'code'=>$model->code)),
	array('label'=>'Delete Policestation', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','code'=>$model->code),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Policestation', 'url'=>array('admin')),
);
?>

<h1>View Policestation #<?php echo $model->code; ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'code',
		'district_code',
		'name_hi',
		'name_en',
		'circle',
	),
)); ?>
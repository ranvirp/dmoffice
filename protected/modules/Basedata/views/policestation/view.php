<?php
/* @var $this PolicestationController */
/* @var $model Policestation */
?>

<?php
$this->breadcrumbs=array(
	'Policestations'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Policestation', 'url'=>array('index')),
	array('label'=>'Create Policestation', 'url'=>array('create')),
	array('label'=>'Update Policestation', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Policestation', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Policestation', 'url'=>array('admin')),
);
?>

<h1>View Policestation #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'id',
		'district_code',
		'name_hi',
		'name_en',
		'circle',
	),
)); ?>
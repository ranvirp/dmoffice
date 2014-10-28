<?php
/* @var $this ComplaintcategoriesController */
/* @var $model Complaintcategories */
?>

<?php
$this->breadcrumbs=array(
	'Complaintcategories'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Complaintcategories', 'url'=>array('index')),
	array('label'=>'Create Complaintcategories', 'url'=>array('create')),
	array('label'=>'Update Complaintcategories', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Complaintcategories', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Complaintcategories', 'url'=>array('admin')),
);
?>

<h1>View Complaintcategories #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'id',
		'name_hi',
		'name_en',
		'department_code',
	),
)); ?>
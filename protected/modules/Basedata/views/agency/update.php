<?php
/* @var $this AgencyController */
/* @var $model Agency */
?>

<?php
$this->breadcrumbs=array(
	'Agencies'=>array('index'),
	$model->code=>array('view','id'=>$model->code),
	'Update',
);

$this->menu=array(
	array('label'=>'List Agency', 'url'=>array('index')),
	array('label'=>'Create Agency', 'url'=>array('create')),
	array('label'=>'View Agency', 'url'=>array('view', 'id'=>$model->code)),
	array('label'=>'Manage Agency', 'url'=>array('admin')),
);
?>

    <h1>Update Agency <?php echo $model->code; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
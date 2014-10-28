<?php
/* @var $this PolicestationController */
/* @var $model Policestation */
?>

<?php
$this->breadcrumbs=array(
	'Policestations'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Policestation', 'url'=>array('index')),
	array('label'=>'Create Policestation', 'url'=>array('create')),
	array('label'=>'View Policestation', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Policestation', 'url'=>array('admin')),
);
?>

    <h1>Update Policestation <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
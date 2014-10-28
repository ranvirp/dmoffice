<?php
/* @var $this ComplaintcategoriesController */
/* @var $model Complaintcategories */
?>

<?php
$this->breadcrumbs=array(
	'Complaintcategories'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Complaintcategories', 'url'=>array('index')),
	array('label'=>'Create Complaintcategories', 'url'=>array('create')),
	array('label'=>'View Complaintcategories', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Complaintcategories', 'url'=>array('admin')),
);
?>

    <h1>Update Complaintcategories <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
/* @var $this ComplaintcategoriesController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Complaintcategories',
);

$this->menu=array(
	array('label'=>'Create Complaintcategories','url'=>array('create')),
	array('label'=>'Manage Complaintcategories','url'=>array('admin')),
);
?>

<h1>Complaintcategories</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
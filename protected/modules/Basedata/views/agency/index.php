<?php
/* @var $this AgencyController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Agencies',
);

$this->menu=array(
	array('label'=>'Create Agency','url'=>array('create')),
	array('label'=>'Manage Agency','url'=>array('admin')),
);
?>

<h1>Agencies</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
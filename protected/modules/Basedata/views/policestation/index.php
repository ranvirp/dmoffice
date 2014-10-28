<?php
/* @var $this PolicestationController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Policestations',
);

$this->menu=array(
	array('label'=>'Create Policestation','url'=>array('create')),
	array('label'=>'Manage Policestation','url'=>array('admin')),
);
?>

<h1>Policestations</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
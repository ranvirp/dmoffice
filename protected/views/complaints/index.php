<?php
/* @var $this LanddisputesController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Complaints',
);

$this->menu=array(
	array('label'=>Yii::t('app','Create Complaints'),'url'=>array('create')),
	array('label'=>Yii::t('app','Manage Complaints'),'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app','Complaints');?></h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_item1',
)); ?>
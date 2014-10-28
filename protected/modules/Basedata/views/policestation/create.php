<?php
/* @var $this PolicestationController */
/* @var $model Policestation */
?>

<?php
$this->breadcrumbs=array(
	'Policestations'=>array('index'),
	'Create',
);?>
  <?php $box = $this->beginWidget('yiiwheels.widgets.box.WhBox', array(
'title' => 'Policestations Form',
'headerIcon' => 'icon-th-list',
// when displaying a table, if we include bootstra-widget-table class
// the table will be 0-padding to the box
'htmlOptions' => array('class'=>'bootstrap-widget-table')
));?>


<?php $this->renderPartial('_form', array('model'=>$model)); ?> <?php $this->endWidget();?><?php
$this->menu=array(
	array('label'=>'List  Policestation', 'url'=>array('index')),
	array('label'=>'Manage  Policestation', 'url'=>array('admin')),
);
?>   
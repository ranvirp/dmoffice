<?php
/* @var $this DesignationController */
/* @var $model Designation */


$this->breadcrumbs=array(
	'Designations'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Designation', 'url'=>array('index')),
	array('label'=>'Create Designation', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#designation-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>


<?php $lang=Yii::app()->language;?>
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'designation-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		
		array(
			'name'=>'designation_type_id',
			'value'=>'$data->designationType?$data->designationType->name_'.$lang.':""',
			),
		
		array(
		'name'=>'district_code',
			'value'=>'$data->district->name_'.$lang,
			),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
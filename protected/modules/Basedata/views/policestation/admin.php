<?php
/* @var $this PolicestationController */
/* @var $model Policestation */


$this->breadcrumbs=array(
	'Policestations'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Policestation', 'url'=>array('index')),
	array('label'=>'Create Policestation', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#policestation-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Policestations</h1>

<p>
    You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>
        &lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'policestation-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
		'name'=>'district_code',
                 'value'=>'$data->district->name_hi',
                    'filter'=>District::listAll(),
                    ),
		'name_hi',
		'name_en',
		'circle',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
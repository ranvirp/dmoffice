<?php
/* @var $this DesignationUserController */
/* @var $model DesignationUser */


$this->breadcrumbs=array(
	'Designation Users'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List DesignationUser', 'url'=>array('index')),
	array('label'=>'Create DesignationUser', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#designation-user-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Designation Users</h1>

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
	'id'=>'designation-user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		
		array(
                    'name'=>'designation_id',
                    'value'=>'$data->designation->name_en',
                    ),
		array(
                    'name'=>'user_id',
                    'value'=>'$data->user->username.":".$data->user->profile->firstname." ".$data->user->profile->lastname'
                    ),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
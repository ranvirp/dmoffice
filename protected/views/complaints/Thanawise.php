<?php
/* @var $this LanddisputesController */
/* @var $model Landdisputes */


$this->breadcrumbs=array(
	'Landdisputes'=>array('index'),
	'Thanawise',
);

$this->menu=array(
	array('label'=>'List Landdisputes', 'url'=>array('index')),
	array('label'=>'Create Landdisputes', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#landdisputes-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="search-form well" >
<?php $this->renderPartial('_search1',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<div class="row">
    <button onclick="window.location='<?php echo Yii::app()->createUrl('/landdisputes/print/view/admin'); ?>';">Print</button>
</div>
<?php $name='name_'.Yii::app()->language; ?>
<?php
     $this->widget('ext.mPrint.mPrint', array(
          'title' => 'title',          //the title of the document. Defaults to the HTML title
          'tooltip' => 'Print',        //tooltip message of the print icon. Defaults to 'print'
          'text' => 'Print Results',   //text which will appear beside the print icon. Defaults to NULL
          'element' => '#landdisputes-grid',        //the element to be printed.
          'exceptions' => array(       //the element/s which will be ignored
              '.summary',
              '.search-form'
          ),
          'publishCss' => true,       //publish the CSS for the whole page?
         // 'visible' => Yii::app()->user->checkAccess('print'),  //should this be visible to the current user?
          'alt' => 'print',       //text which will appear if image can't be loaded
          'debug' => true,            //enable the debugger to see what you will get
          'id' => 'print-div'         //id of the print link
      ));
?>
<?php 
$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'landdisputes-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
   'type' => TbHtml::GRID_TYPE_BORDERED,
    
	'columns'=>array(
		
		'complainants',
		'oppositions',
            array(
		'name'=>'revenuevillage',
                'value'=>  'RevenueVillage::model()->findByPk($data->revenuevillage)->name_hi',
                ),
            array(
		'name'=>'policestation',
                'value'=> 'PoliceStation::model()->findByPk($data->policestation)->name_hi',
                ),
		'gatanos',
            'courtcasepending',
            'casteorcommunal',
            'policerequired',
            'category',
		/*
		
		'description',
		'courtcasepending',
		'courtcasedetails',
		'policerequired',
		'nextdateofaction',
		'disputependingfor',
		'casteorcommunal',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
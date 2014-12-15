<?php
/* @var $this LanddisputesController */
/* @var $model Landdisputes */


$this->breadcrumbs=array(
	'Landdisputes'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Landdisputes', 'url'=>array('index')),
	array('label'=>'Create Landdisputes', 'url'=>array('create')),
);

?>
<style>
    td {
        font-family:ind_ml_1_001;
    }
</style>
<?php $name='name_'.Yii::app()->language; ?>
<?php Yii::app()->ClientScript->registerCssFile(Yii::app()->baseUrl.'/css/bootstrap.min.css'); ?>
<?php
     $this->widget('ext.mPrint.mPrint', array(
          'title' => 'title',          //the title of the document. Defaults to the HTML title
          'tooltip' => 'Print',        //tooltip message of the print icon. Defaults to 'print'
          'text' => 'Print Results',   //text which will appear beside the print icon. Defaults to NULL
          'element' => '#landdisputes-grid',        //the element to be printed.
          'exceptions' => array(       //the element/s which will be ignored
              '.summary',
              '.search-form',
              '.button-column',
              '.filters',
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
//$this->widget('zii.widgets.grid.CGridView',array(
	'id'=>'landdisputes-grid',
	'dataProvider'=>$model->search(),
        //'filterPosition'=>'header',
	//'filter'=>$model,
    'enablePagination'=>false,
    'ajaxType'=>'POST',
   'type' => TbHtml::GRID_TYPE_BORDERED,
      //'template'=>'{pager}{items}{summary}{pager}',
    
	'columns'=>  Landdisputes::getColumns(false),
    
   
     
	
)); ?>
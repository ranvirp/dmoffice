<?php
/* @var $this LanddisputesController */
/* @var $model Landdisputes */


?>
<form>Page Size:<input name="page"/></form>
<?php $name='name_'.Yii::app()->language; ?>
<?php
     $this->widget('ext.mPrint.mPrint', array(
          'title' => 'Report for Land Disputes',          //the title of the document. Defaults to the HTML title
          'tooltip' => 'Print',        //tooltip message of the print icon. Defaults to 'print'
          'text' => 'Print Results',   //text which will appear beside the print icon. Defaults to NULL
          'element' => '#complaints-grid',        //the element to be printed.
          'exceptions' => array(       //the element/s which will be ignored
              '.summary',
              '.search-form',
			  'hide-print',
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
	'id'=>'complaints-grid',
	'dataProvider'=>$dp,
	'filter'=>$model,
   'type' => TbHtml::GRID_TYPE_BORDERED,
   // 'mergeColumns' => $mergeColumns,  
	'columns'=>  Complaints::getColumns(false),
)); ?>
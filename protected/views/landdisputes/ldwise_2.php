<?php
/* @var $this LanddisputesController */
/* @var $model Landdisputes */


?>



<form><div class="row"><div class="col-md-2"> Number:<input name="page"/></div> 
    
    <?php echo TbHtml::dropDownListControlGroup('ps','', Utility::listAllByAttributes('Policestation',array('district_code'=>Utility::getDistrict(Yii::app()->user->id))),array('empty'=>'None','label'=>'Police Station','class'=>'form-control-inline col-md-2','span' => 5, 'maxlength' => 11)); 
?>
    <div class="col-md-2"><?php echo TbHtml::submitButton('Load');?></div></div></form>
<?php $name='name_'.Yii::app()->language; ?>
<?php
     $this->widget('ext.mPrint.mPrint', array(
          'title' => 'Report for Land Disputes',          //the title of the document. Defaults to the HTML title
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
<form method="POST">
<?php
echo '<div class="row">';
echo '<div class="col-md-3">'; 

echo TbHtml::textFieldControlGroup('doa', '', array('class'=>'datepicker','label'=>'Date of Action:'));
echo '</div>';
echo '<div class="col-md-2"><label></label><div>';
 echo TbHtml::submitButton('Assign');
 echo '</div></div>';
 echo '</div>';
$col[]=array('header'=>'Choose','value'=>'CHtml::checkBox("cid[]",null,array("value"=>$data->id,"id"=>"cid_".$data->id))','type'=>'raw');
$col[]='nextdateofaction';
$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'landdisputes-grid',
	'dataProvider'=>$dp,
	'filter'=>$model,
   'type' => TbHtml::GRID_TYPE_BORDERED,
   // 'mergeColumns' => $mergeColumns,  
	'columns'=>  array_merge($col,Landdisputes::getColumns(false)),
)); ?>
</form>
<script>
        $(document).ready(function () {
            $('.datepicker').datepicker({ appendText: "(dd-mm-yyyy)",beforeShowDayType:$.datepicker.noWeekends})
        });
    </script>
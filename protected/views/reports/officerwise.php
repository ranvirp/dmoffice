<?php



?>
<?php
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


<form>Page Size:<input name="page"/></form>
<?php $name='name_'.Yii::app()->language; ?>
<?php
     $this->widget('ext.mPrint.mPrint', array(
          'title' => 'Report for Land Disputes Officer Wise',          //the title of the document. Defaults to the HTML title
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
//$model=new Designation;
//$sql ="select officerassigned,count(id) as count1 from landdisputes inner join designation group by officerassigned order by designation_type_id";
//$dp = new CSqlDataProvider($sql);
//$dp=$model->search();

?>
<h2>Officer wise Pending Status</h2>
<?php 
$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'landdisputes-grid',
	'dataProvider'=>$dp,
	//'filter'=>$model,
   'type' => TbHtml::GRID_TYPE_BORDERED,
    'columns'=>array(
      array('header'=>'Officer','value'=>function($data,$row,$column){
    $designation= Designation::model()->findByPk($data['offr']);
    if ($designation) 
        return $designation->name_hi;
    else 
        return "";
    
      }),
       array('header'=>'Land Disputes','value'=>'$data["ld"]'),  
       array('header'=>'Complaints','value'=>'$data["c"]'),
              array('header'=>'Urgent Land Disputes','value'=>'$data["ldu"]'),  
       array('header'=>'Urgent Complaints','value'=>'$data["cu"]'),
    ),
   // 'mergeColumns' => $mergeColumns,  
    /*
	'columns'=>  array(
    'name_hi',
    array('header'=>'Complaints','value'=>  function ($data,$row,$column)
        { return Complaints::model()->countByAttributes(array("officerassigned"=>$data->id,'status'=>0));},),
    array('header'=>'Urgent Complaints','value'=>  function ($data,$row,$column)
        { return Complaints::model()->countByAttributes(array("officerassigned"=>$data->id,'status'=>0,'priority'=>1));},),
    array('header'=>'Land Disputes','value'=>  function ($data,$row,$column)
        { return Landdisputes::model()->countByAttributes(array("officerassigned"=>$data->id,'status'=>0));},),
                 array('header'=>'Urgent Land disputes','value'=>  function ($data,$row,$column)
        { return Landdisputes::model()->countByAttributes(array("officerassigned"=>$data->id,'status'=>0,'priority'=>1));},),
                
    ),
     * */
     
)); ?>
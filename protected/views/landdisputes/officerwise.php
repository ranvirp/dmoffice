<?php



?>
<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#complaints-grid').yiiGridView('update', {
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
          'element' => '#landdisputes-main',        //the element to be printed.
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
if ($designationtype>0)
    $sql ="select officerassigned as offr,count(distinct (landdisputes.id)) as count1,sum(case when landdisputes.priority = 1 then 1 else 0 end) ldu from  landdisputes inner join designation on designation.id=officerassigned where landdisputes.status=0 and designation.designation_type_id=$designationtype group by officerassigned having count1>0 order by count1 desc";
else 
$sql ="select officerassigned as offr,count(distinct (landdisputes.id)) as count1,sum(case when landdisputes.priority = 1 then 1 else 0 end) ldu from  landdisputes inner join designation on designation.id=officerassigned where landdisputes.status=0 group by officerassigned having count1>0 order by count1 desc";

//$sql ="select officerassigned as offr,count(distinct (landdisputes.id)) as count1,sum(case when landdisputes.priority = 1 then 1 else 0 end) ldu from  landdisputes inner join designation on designation.id=officerassigned where landdisputes.status=0 group by officerassigned having count1>0 order by designation_type_id";
$count=Yii::app()->db->createCommand('SELECT count(distinct(officerassigned)) FROM landdisputes')->queryScalar();
$dp = new CSqlDataProvider($sql,array('keyField'=>'offr','totalItemCount'=>$count));
$dp->pagination=false;
//$dp=$model->search();

?>
<div id='landdisputes-main'>
<h1>Officer wise Pending Status of Landdisputes on <?php echo date('d/m/Y');?></h1>
<?php 
$model=new DesignationType;
$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'landdisputes-grid',
	'dataProvider'=>$dp,
	'filter'=>$model,
   'type' => TbHtml::GRID_TYPE_BORDERED,
    //'filter'=>$model,
    'columns'=>array(
      array('name'=>'id','header'=>'Officer','value'=>function($data,$row,$column){
    $designation= Designation::model()->findByPk($data['offr']);
    if ($designation) 
        return $designation->name_hi;
    else 
        return "";
    
      },'filter'=>  DesignationType::model()->listAll()),
       
       array('header'=>Yii::t('app','Landdisputes'),'value'=>
           function($data,$row,$column){
          return '<a href="'.Yii::app()->createUrl('/landdisputes/my?o=').$data["offr"].'">'.$data["count1"]."</a>"
                ."&nbsp;&nbsp;&nbsp;<a href='".Yii::app()->createUrl('/landdisputes/myPdf?o=').$data["offr"]."'><i class=\"fa fa-file-pdf-o\"></i></a>";},
                  'type'=>'raw',
        ),     
       array('header'=>'Urgent '. Yii::t('app','Landdisputes'),'value'=>function($data,$row,$column){
          return '<a href="'.Yii::app()->createUrl('/landdisputes/my?p=1&o=').$data["offr"].'">'.$data["ldu"]."</a>";},
                  'type'=>'raw',),
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
</div>
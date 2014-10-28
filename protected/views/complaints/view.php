<?php
/* @var $this ComplaintsController */
/* @var $model Complaints */
?>

<?php
$this->breadcrumbs=array(
	'Complaints'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Complaints', 'url'=>array('index')),
	array('label'=>'Create Complaints', 'url'=>array('create')),
	array('label'=>'Update Complaints', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Complaints', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Complaints', 'url'=>array('admin')),
);
?>
<?php $name='name_'.Yii::app()->language;?>
<h1>View <?php echo Yii::t('app','Complaints');?> #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		
		'complainants',
		'oppositions',
        array(
		'name'=>'revenuevillage',
                'value'=>  RevenueVillage::model()->findByPk($model->revenuevillage)->$name.','.Tehsil::model()->findByPk(RevenueVillage::model()->findByPk($model->revenuevillage)->tehsil_code)->$name,
            ),
		 array(
		'name'=>'policestation',
                'value'=> Policestation::model()->findByPk($model->policestation)->$name,
            ),
		'gatanos',
        array(
		'name'=>'category',
                'value'=>Complaintcategories::model()->findByPk($model->category)->name_hi,
            ),
		'description',
        
         
		
       
       
		'nextdateofaction',
		
	),
)); ?>
<?php
echo $this->renderPartial('/Complaints/_replies',array(
			'replies'=>$model->replies,
		),true); 
	 
echo CHtml::ajaxButton('उत्तर दर्ज करें',Ccontroller::createUrl('/replies/create',array('content_type'=>'Complaints','content_type_id'=>$model->id)),array('dataType'=>'json',
	'success'=>"function(data){
          
	$('#commentdiv').html(data.html);
          
	}"));
echo CHtml::ajaxButton('Attach files', Yii::app()->createUrl('/Basedata/files/attach',array('modelName'=>get_class($model),'modelId'=>$model->id)),array('dataType'=>'json','success'=>"function(data){
	$('#".get_class($model)."_attachments').html(data.html);}"));

	
?>
<div id="commentdiv"></div>
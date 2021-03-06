<?php
/* @var $this LanddisputesController */
/* @var $model Landdisputes */
?>

<?php
$this->breadcrumbs=array(
	'Landdisputes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Landdisputes', 'url'=>array('index')),
	array('label'=>'Create Landdisputes', 'url'=>array('create')),
	array('label'=>'Update Landdisputes', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Landdisputes', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Landdisputes', 'url'=>array('admin')),
);
?>
<?php $name='name_'.Yii::app()->language;?>
<h1>View <?php echo Yii::t('app','Landdisputes');?> #<?php echo $model->id; ?></h1>
<?php $redtag="<span style=\"color:red\" class=\"glyphicon glyphicon-tags\"\>";?>
<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		array('name'=>'id','value'=>(($model->priority==1)?$redtag:'').$model->context.'/'.$model->id,'type'=>'raw'),
        
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
         array(
		'name'=>'courtcasepending',
             'value'=>$model->courtcasepending?Yii::t('app','Yes'):Yii::t('app','No'),
             ),
         
		array (
                   'name'=> 'courtname',
                    'value'=>$model->courtcasepending?$model->courtname:'NA',
                    ),
        array(
        'name'=>
		'courtcasedetails',
            'value'=>$model->courtcasepending?$model->courtcasedetails:'NA',
        ),
        array(
          'name'=>'stayorders',
          'value'=>Files::showAttachments($model,'stayorders'),
            'type'=>'raw',
        ),
        array(
		'name'=>'policerequired',
                'value'=>$model->policerequired?Yii::t('app','Yes'):Yii::t('app','No'),
            ),
		
		'disputependingfor',
        array(
		'name'=>'casteorcommunal',
                'value'=>$model->casteorcommunal?Yii::t('app','Yes'):Yii::t('app','No'),
            ),
        array('name'=>'status','value'=>$model->status?Yii::t('app','Disposed'):Yii::t('app','Pending')),
         array(
          'name'=>'documents',
          'value'=>Files::showAttachments($model,'documents'),
            'type'=>'raw',
        ),
        array('name'=>'officerassigned','value'=>$model->officerassigned.($model->officer?$model->officer->name_hi:'missing')),
	),
)); ?>
<?php 
 //echo Files::showAttachments($model,'documents');
?>
<?php
if (!Yii::app()->user->isGuest)
{
if ($displayAttach==true)
{
   // echo $this->widget('application.extensions.basicJqueryUpload.basicJqueryFileUploadWidget',array('model'=>$model,'attribute'=>'documents'),true);

    echo $this->renderPartial('_form_1',array('model'=>$model),true);
}
else 
{
    echo TbHtml::btn(TbHtml::BUTTON_TYPE_LINK,'Attach (More) files',array('onClick'=>'window.location.replace("'.Yii::app()->createUrl("/landdisputes/view/id").'"+"/'.$model->id.'"+"/d/1")'));

}
echo CHtml::ajaxButton('उत्तर दर्ज करें',Ccontroller::createUrl('/replies/create',array('content_type'=>'Landdisputes','content_type_id'=>$model->id)),array(
//'dataType'=>'json',
  'type'=>'post',	
    'success'=>"function(data){
	$('#commentdiv').html(data);
	}"));

echo '<div id="commentdiv"></div>';

}
echo $this->renderPartial('/landdisputes/_replies',array(
			'replies'=>$model->replies,
		),true); 
/*
echo CHtml::ajaxButton('Attach files', Yii::app()->createUrl('/Basedata/files/attach',array('m'=>get_class($model),'idd'=>$model->id,'attr'=>'documents')),array('dataType'=>'json',
    'type'=>'get',
    'success'=>"function(data){
	$('#documents1').html(data.html);}"));

	*/
?>

<div id="documents1"></div>
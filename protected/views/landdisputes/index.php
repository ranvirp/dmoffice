<?php
/* @var $this LanddisputesController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Landdisputes',
);

$this->menu=array(
	array('label'=>Yii::t('app','Create Landdisputes'),'url'=>array('create')),
	array('label'=>Yii::t('app','Manage Landdisputes'),'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app','Land disputes');?></h1>
<?php
echo $this->widget('bootstrap.widgets.TbListView', array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'_item1',   // refers to the partial view named '_post'
  //  'enablePagination'=>true,
    
),true);
        ?>
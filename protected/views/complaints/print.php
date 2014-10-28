
<h1 style="align:center">List of Pending Complaints</h1>



<?php $name='name_'.Yii::app()->language; ?>
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'landdisputes-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
   'type' => TbHtml::GRID_TYPE_BORDERED,
   'template'=>"{items}",
	'columns'=>array(
		array( 'header' => 'Row',
'value' => '$row+1'),
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
		array(
		'name'=>'category',
                 'value'=>'Complaintcategories::model()->findByPk($data->category)->name_hi',
                    
                    ),
		'description',
            /*
		'courtcasepending',
		'courtcasedetails',
		'policerequired',
		'nextdateofaction',
		'disputependingfor',
		'casteorcommunal',
		*/
		
	),
)); ?>
<?php
/* @var $this LanddisputesController */
/* @var $model Landdisputes */
?>


<?php $name='name_'.Yii::app()->language;?>


<?php $this->widget('bootstrap.widgets.TbDetailView',array(
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
		
        array(
		'name'=>'category',
                'value'=>Complaintcategories::model()->findByPk($model->category)->name_hi,
            ),
		'description',
        
         
		
      
     
		'nextdateofaction',
		
	),
)); ?>

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GridWidget
 *
 * @author admin
 */
class GridWidget extends CWidget{
    //put your code here
    public $dataProvider;
    public $columns;
    public function run()
    {
        $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'landdisputes-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'complainants',
		'oppositions',
		'revenuevillage',
		'policestation',
		'gatanos',
		/*
		'category',
		'description',
		'courtcasepending',
		'courtcasedetails',
		'policerequired',
		'nextdateofaction',
		'disputependingfor',
		'casteorcommunal',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); 
    }
}

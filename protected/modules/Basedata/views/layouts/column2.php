<?php /* @var $this Controller */ ?>
<?php
$menu1=array(
    array('label'=>'User'.'<span class="caret"></span>','url'=>'#', 'itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"), 
                            'items'=>array(
array('label'=>'Add User','url'=>array('/user')),
array('label'=>'User Management Shortcut','url'=>array('/site/usersform')),
array('label'=>'Create Users For All Designations','url'=>array('/site/createuser')),
),),
    array('label'=>'Master Data'.'<span class="caret"></span>','url'=>'#', 'itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"), 
                            'items'=>array(
array('label'=>'Districts','url'=>array('/Basedata/district/create')),
array('label'=>'Tehsils','url'=>array('/Basedata/tehsil/create')),
array('label'=>'Blocks','url'=>array('/Basedata/block/create')),
array('label'=>'Revenue Village','url'=>array('/Basedata/revenueVillage/create')),  
array('label'=>'Police Station','url'=>array('/Basedata/policestation/create')), 
                                ),),
array('label'=>'Department','url'=>array('/Basedata/department/create')),
        array('label'=>'Designation'.'<span class="caret"></span>','url'=>'#', 'itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"), 
                            'items'=>array(
array('label'=>'Add Designation Type','url'=>array('/Basedata/designationType/create')),
array('label'=>'Add Designation','url'=>array('/Basedata/designation/create')),
array('label'=>'Assign User to a Designation','url'=>array('/Basedata/designation/userAssign')),
                                ),),
    array('label'=>'Add Complaint Categories','url'=>array('/complaintcategories/create')),



);
?>
<?php $this->beginContent(); ?>
<div class="navbar-collapse collapse">
    <?php $this->widget('application.components.YiiSmartMenu',
           array( 'htmlOptions'=>array('class'=>'pull-left nav navbar-nav'),
                    'submenuHtmlOptions'=>array('class'=>'dropdown-menu'),
					'itemCssClass'=>'item-test',
                    'encodeLabel'=>false,
                    'items'=>$menu1));
    ?>
</div>
  <div class="row">
	<div class="col-md-3">
		<div class="sidebar-nav">
        
		  <?php $this->widget('zii.widgets.CMenu', array(
			/*'type'=>'list',*/
			'encodeLabel'=>false,
			'items'=>array(
				
				// Include the operations menu
				array('label'=>'OPERATIONS','items'=>$this->menu),
			),
			));?>
		</div>
        
		
    </div><!--/span-->
    <div class="col-md-9">
    
    <?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
            'links'=>$this->breadcrumbs,
			'homeLink'=>CHtml::link('Dashboard'),
			'htmlOptions'=>array('class'=>'breadcrumb')
        )); ?><!-- breadcrumbs -->
    <?php endif?>
    
    <!-- Include content pages -->
    <?php echo $content; ?>

	</div><!--/span-->
  </div><!--/row-->


<?php $this->endContent(); ?>
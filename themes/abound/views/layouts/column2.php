<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>

  <div class="row">
	<div class="col-md-2">
            <?php if (!empty($this->menu)) :?>
		<div class="sidebar-nav">
        
		  <?php $this->widget('YiiSmartMenu', array(
			/*'type'=>'list',*/
			'encodeLabel'=>false,
			'items'=>array(
				// Include the operations menu
				array('label'=>$this->menu?'OPERATIONS':'','url'=>'#','items'=>$this->menu),
			),
			));?>
		</div>
            <?php endif;?>
            <?php if (!Yii::app()->user->isGuest):?>
            <section class="panel">
                <div class="panel-body">
                    <ul class="nav nav-pills nav-stacked">
                   
                        <li class="active"><a href="#"><span class="badge pull-right"><?php echo Landdisputes::model()->count1()+Complaints::model()->count1();?></span> Inbox </a></li>
                        <li><a href="/landdisputes/my?p=1">Urgent Land Disputes <span class="label label-danger pull-right"><?php echo Landdisputes::model()->count1(true);?></span></a></li>
                         <li> <a href="/landdisputes/my">Land Disputes <span class="badge pull-right"><?php echo Landdisputes::model()->count1();?></span></a></li>
                            <li><a href="/complaints/my?p=1">Urgent Complaints <span class="label label-danger pull-right"><?php echo Complaints::model()->count1(true);?></span></a></li>
                     
                         <li><a href="/complaints/my"><span class="badge pull-right"><?php echo Complaints::model()->count1();?></span>Complaints</a></li>
                          
                    </ul>
                </div>
            </section>
<?php endif;?>
		
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
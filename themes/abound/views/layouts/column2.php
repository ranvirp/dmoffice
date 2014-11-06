<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>

  <div class="row">
	<div class="col-md-3">
		<div class="sidebar-nav">
        
		  <?php $this->widget('YiiSmartMenu', array(
			/*'type'=>'list',*/
			'encodeLabel'=>false,
			'items'=>array(
				// Include the operations menu
				array('label'=>'OPERATIONS','url'=>'#','items'=>$this->menu),
			),
			));?>
		</div>
            <?php if (!Yii::app()->user->isGuest):?>
            <section class="panel">
                <div class="panel-body">
                    <ul class="nav nav-pills nav-stacked">
                         <li class="active"><a href="#"><span class="badge pull-right"><?php echo Landdisputes::model()->count1()+Complaints::model()->count1();?></span> Inbox </a>
                        <li><a href="/landdisputes/my"><span class="badge pull-right"><?php echo Landdisputes::model()->count1();?></span>Land Disputes</a></li>
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
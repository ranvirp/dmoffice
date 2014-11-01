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
            <section class="panel">
                <div class="panel-body">
                    <ul class="nav nav-pills nav-stacked">
                         <li class="active"><a href="#"><span class="badge pull-right">32</span> Inbox </a>
                        <li><a href="/landdisputes/my">Land Disputes</a></li>
                         <li><a href="/complaints/my">Complaints</a></li>
                        
                    </ul>
                </div>
            </section>

		
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
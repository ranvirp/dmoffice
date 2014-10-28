<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
     <?php $this->widget('bootstrap.widgets.TbNavbar', array(
    'brandLabel' => 'Operations',
    'display' => null, // default is static to top
    'items' => array(
    array(
    'class' => 'bootstrap.widgets.TbNav',
        'type' => TbHtml::NAV_TYPE_PILLS,
    'items' => $this->menu,
    ),
    ),
    )); ?>
<div id="content">
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
            'links'=>$this->breadcrumbs,
			'homeLink'=>CHtml::link('Dashboard'),
			'htmlOptions'=>array('class'=>'breadcrumb')
        )); ?><!-- breadcrumbs -->
    <?php endif?>
    
	<?php echo $content; ?>
</div><!-- content -->
<?php $this->endContent(); ?>
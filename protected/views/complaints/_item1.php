
<?php if (is_array($data)) {$data = Complaints::model()->with('replies')->findByPk($data['id1']);}?>
<div class="panel panel-default post" id="post-<?php echo $data->id; ?>">
    <div class="panel-heading">
        <div  class="col-md-2 pull-left">#<?php echo $data->id;?></div>
        <div class="col-md-4"><?php echo Yii::t('app','Category').':'.$data->categoryName->name_hi;?></div>
        <span><?php echo $data->officer?$data->officer->name_hi:'missing';?></span>
        <span class="pull-right"><?php echo date('d/m/Y',$data->created_at);?></span>
    </div>
<div class="panel-body">
    <p><?php print '<b>'.'शिकायतकर्ता:'.'</b>'.$data->complainants.''.$data->complainantmobileno;?></p>
    <p><?php print $data->description; ?></p>
    <?php print Files::showAttachmentsInline($data, 'documents');?>
    <?php if (Yii::app()->user->checkAccess('Landdisputes.toggleStatus')): ?>
   <p><?php
     echo TbHtml::button("Mark disposed",array('class'=>'disposeBt','href'=>Yii::app()->createUrl("/complaints/toggleStatus/id/".$data->id)));
    ?></p>
   <?php  echo $this->renderPartial('/complaints/_replies',array(
			'replies'=>$data->replies,
		),true); 
?>
   <?php endif; ?>
</div>
    <div class="panel-footer">

<?php print Yii::t('app','Revenuevillage').':'.$data->revVillage->name_hi; ?>
        <?php print Yii::t('app','Tehsil').':'.$data->revVillage->tehsilCode->name_hi; ?>
        <?php print Yii::t('app','Policestation').':'.$data->thana->name_hi; ?>

</div>
</div>



<?php if (is_array($data)) {$data = Landdisputes::model()->findByPk($data['id1']);}?>
<div class="panel panel-success post" id="post-<?php echo $data->id; ?>">
    <div class="panel-heading">
        <div class="row">
        <div  class="pull-left col-md-2">#<?php echo $data->id;?></div>
        <div class="col-md-3"><?php echo "  ".$data->categoryName->name_hi;?></div>
        <div class="col-md-3"><?php echo $data->officer?$data->officer->name_hi:'missing';?></div>
       
        <div class="pull-right"><?php echo date('d/m/Y',$data->created_at);?></div>
         </div>
    </div>
<div class="panel-body">
    <p><?php print $data->complainants.''.$data->complainantmobileno;?></p>
    <p><?php print $data->description; ?></p>
    <?php print Files::showAttachmentsInline($data, 'documents');?>
    <?php if (Yii::app()->user->checkAccess('Landdisputes.toggleStatus')): ?>
  <p><?php
     echo TbHtml::button("Mark disposed",array('class'=>'disposeBt','href'=>Yii::app()->createUrl("/landdisputes/toggleStatus/id/".$data->id)));
    ?></p>
   <?php  echo $this->renderPartial('/landdisputes/_replies',array(
			'replies'=>$data->replies,
		),true); 
?>
   <?php endif; ?>
</div>
    <div class="panel-footer">
        <div class="row">
            <div class="col-md-2">
<?php print Yii::t('app','Revenuevillage').':'.$data->revVillage->name_hi; ?>
            </div>
            <div class="col-md-3">
        <?php print Yii::t('app','Tehsil').':'.$data->revVillage->tehsilCode->name_hi; ?>
                </div><div class="col-md-2">
        <?php print Yii::t('app','Policestation').':'.$data->thana->name_hi; ?>
                </div>
</div>
</div>
</div>


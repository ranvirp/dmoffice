<?php if (is_array($data)) {$data = Landdisputes::model()->findByPk($data['id1']);}?>
<div class="panel panel-default post" id="post-<?php echo $data->id; ?>">
    <div class="panel-heading">
        <span class="pull-left">#<?php echo $data->id;?></span>
        <span><?php echo "  ".$data->categoryName->name_hi;?></span>
        <span><?php echo $data->officer->name_hi;?></span>
        <span class="pull-right"><?php echo date('d/m/Y',$data->created_at);?></span>
    </div>
<div class="panel-body">
    <p><?php print $data->complainants.''.$data->complainantmobileno;?></p>
    <p><?php print $data->description; ?></p>
    <?php print Files::showAttachmentsInline($data, 'documents');?>
    <?php if (Yii::app()->user->checkAccess('Landdisputes.toggleStatus')): ?>
   <p><?php echo CHtml::ajaxButton("Mark disposed",array("/landdisputes/toggleStatus","id"=>$data->id),array(

     "beforeSend" => 'js:function(){if(confirm("Are you sure you want to mark as disposed?"))return true;}',
     "success"=>'js:function(data){$.fn.yiiListView.update("yw0",{});}',
     "type"=>"post",

          ),array("id"=>$data->id)); ?></p>
   <?php  echo $this->renderPartial('/landdisputes/_replies',array(
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


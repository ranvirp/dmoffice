<?php
$x=array();
$i=1;
foreach ($replies as $reply) {
    $title = "<span> By ".($reply->author != null)? $reply->author->username:''.'</span>';
    $title .= "<div class='pull-right'>".date("d-m-Y H-i-s", $reply->update_time)."</div>";
$x['Reply #'.$i.' '.$title]=$this->renderPartial('/complaints/_reply',array('reply'=>$reply),true);
$i++;
}
$this->widget('zii.widgets.jui.CJuiAccordion', array(
    'panels'=>$x,
    // additional javascript options for the accordion plugin
    'options'=>array(
        'animated'=>'bounceslide',
    ),
));
?>
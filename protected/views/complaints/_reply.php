
<div class="comment" id="c<?php echo $reply->id; ?>">

	
	<div class="author">
		<?php 
		if ($reply->author!=null)
		echo $reply->author->username; 
		?> says:
	</div>

	<div class="time">
		<?php
 echo date("d-m-Y H-i-s", $reply->update_time);
 ?>
	</div>

	<div class="content">
		<?php echo nl2br(CHtml::encode($reply->content)); ?>
		<?php echo Files::showAttachments($reply,'attachments');?>
	</div>

</div><!-- comment -->

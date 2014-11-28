<?php 
  $model=  Landdisputes::model()->findByPk($data['id1']);
  unset($data);
  $data=$model;
  
  ?>
<div class='row well'>
    <div class='col-md-9'>
<p><?php echo $data->description;?></p>

    
            
<?php 
     $documents=explode(",",$data->documents);$items=array();
     foreach ($documents as $document)
     {
         $file =Files::model()->findByPk($document);
         if ($file ){
          $items[]=array('src'=>'/Basedata/files/file1/id/'.$file->id,'url'=>'/Basedata/files/file1/id/'.$file->id,
              'options'=>array('title'=>$file->title));
           
         }
     }

      $this->widget('yiiwheels.widgets.gallery.WhGallery', array('items' => $items));            

      ?>
    </div>
    <div class='col-md-3'>
        <?php 
       
        echo $this->renderPartial('/landdisputes/_replies',array(
			'replies'=>$data->replies,
		),true); ?>
    </div>
           
</div>






<?php $lang=Yii::app()->language;?>
 <div class="form-inline">

<?php foreach ($complainants as $i => $complainant): ?>

               <?php echo $form->textFieldControlGroup($complainant, '[$i]name_' . $lang); ?>
                <?php echo $form->textFieldControlGroup($complainant, '[$i]father_name_' . $lang); ?>
   <?php 
   //echo $form->textFieldControlGroup($complainant, '[$i]spouse_name_' . $lang);
   ?>
              <?php echo $form->textAreaControlGroup($complainant, '[$i]address'); ?>
               <?php echo $form->textFieldControlGroup($complainant, '[$i]mobile1'); ?>
               
                <?php echo $form->textFieldControlGroup($complainant, '[$i]mobile2'); ?>
   <?php endforeach; ?>
</div>

<h1> Action list Thanawise Datewise </h1>

 <?php
 //$model= new Landdisputes;
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'ps-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
            //'layout'=>  TbHtml::FORM_LAYOUT_HORIZONTAL,
    ));
      echo '<div class="row">';
      echo '<div class="col-md-3">'; 

   echo TbHtml::dropDownListControlGroup( 'policestation','', Utility::listAllByAttributes('Policestation',array('district_code'=>Utility::getDistrict(Yii::app()->user->id))),array('empty'=>'None','label'=>'Police Station','class'=>'form-control-inline','span' => 5, 'maxlength' => 11)); 
 echo '</div>';
echo '<div class="col-md-3">'; 

echo TbHtml::textFieldControlGroup('doa', '', array('class'=>'datepicker','label'=>'Date of Action:'));
echo '</div>';
echo '<div class="col-md-2"><label></label><div>';
 echo TbHtml::submitButton('Submit');
 echo '</div></div>';
 echo '</div>';
 $this->endWidget();
  ?>
<?php 
if ($dp) {
 
    echo $this->renderPartial('ldwise_3',array('model'=>$model,'dp'=>$dp,'title'=>$title));
}?>
<script>
        $(document).ready(function () {
            $('.datepicker').datepicker({ appendText: "(dd-mm-yyyy)",beforeShowDayType:$.datepicker.noWeekends})
        });
    </script>

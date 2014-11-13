

<style>
    .well1
    {
        background-color: #fff;
        border-color: #ddd;
        border-radius: 4px 4px 0 0;
        border-width: 1px;
        box-shadow: none;
        margin-left: 0;
        margin-right: 0;
        padding: 2px;
        border-style:solid;
    }
</style>
<?php


?>
<?php 
$district_code=null;
$tehsil_code=null;
 if ($model!=null)
 {
     $revvillage=  RevenueVillage::model()->findByPk($model->$attribute);
    
     if ($revvillage!=null)
     {
         $district_code=$revvillage->district_code;
         $tehsil_code=$revvillage->tehsil_code;
     }
 }
 //print '<div class="label">'. $tehsil_code." ".$district_code.'</div>';
?>



    
        <?php
       

            echo TbHtml::dropDownList(get_class($model) . '_' . $attribute . '_dist_code', $district_code, Utility::listAllByAttributes('District',array('district_code'=>Utility::getDistrict(Yii::app()->user->id))),array('class'=>'hide'));
       
        ?>
   

   <div class='form form-inline row'> 
    
      <?php   $url="'".Yii::app()->createUrl("/Basedata/RevenueVillage/getRevenueVillagesByTehsil/t/")."'";?>
            
    <div class="col-md-4">  
        <?php echo TbHtml::dropDownListControlGroup(get_class($model) . '_' . $attribute . '_' . 'tehsilDropDown', $tehsil_code, Utility::listAllByAttributes('Tehsil',array('district_code'=>Utility::getDistrict(Yii::app()->user->id))), array('label'=>'Tehsil:','empty' => 'None', 'onChange' => 'js:' .'populateDropdown('.$url.'+'."'/'+"."$(this).val(),"."'".get_class($model) . '_' . $attribute."')")); ?>
   
    </div>
    <div class="col-md-7">
  <?php if ($tehsil_code ==null){
   
         echo TbHtml::activeDropDownListControlGroup($model,$attribute, array(),array('empty'=>'None','label'=>Yii::t('app','Revenue Village:'))); 
  }
  else 
        echo TbHtml::activeDropDownListControlGroup($model, $attribute, Utility::listAllByAttributes('Revenuevillage', array('tehsil_code'=>$tehsil_code)),array('class'=>'selectpicker')); 
         ?>
    </div>
</div> 

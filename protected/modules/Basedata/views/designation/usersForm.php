<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php
if (!isset($page))
{$page=1;$size=$page*10;};
$users =User::model()->findAll(array('condition'=>'id>:size','params'=>array('size'=>$page*10)),new CDbCriteria(array('order'=>'id asc','limit'=>10)));$i=-1;?>
 <div class='row well'>
        <div class='col-md-1'>
        <?php echo "Sl. No.";?>
        </div>
     <div class='col-md-1'>
        <?php echo "User Name";?>
        </div>
        <div class='col-md-2'>
        <?php echo "First Name";?>
        </div>
        <div class='col-md-2'>
        <?php echo "Last Name";?>
        </div>
        <div class='col-md-2'>
         <?php echo "Mobile";?>
        </div> 

        <div class='col-md-3'>
        <?php echo "Designation"?>
        </div> 
            </div>
<?php foreach ($users as $user):?>
<?php $i++;?>

   

<div class='row'>
<div class="form" class='form-inline'>
    <form role="form" action='/Basedata/designation/profile/update'>
        <div class='row'>
            <div class='col-md-1'><?php echo $i;?></div>
            <div class='col-md-1'><?php echo $user->username;?></div>
        <div class='col-md-2'>
        <?php echo TbHtml::activeTextField($user->profile?$user->profile:new Profile, "[$i]firstname",array('class'=>'hindiinput'));?>
        </div>
        <div class='col-md-2'>
        <?php echo TbHtml::activeTextField($user->profile?$user->profile:new Profile, "[$i]lastname",array('class'=>'hindiinput'));?>
        </div>
        <div class='col-md-2'>
         <?php echo TbHtml::activeTextField($user->profile?$user->profile:new Profile, "[$i]mobile");?>
        </div> 

        <div class='col-md-3'>
        <?php echo TbHtml::activeDropDownList($user->profile?$user->profile:new Profile, "[$i]designation", Utility::listAllByAttributes("Designation", array('district_code'=>  Utility::getDistrict(Yii::app()->user->id))),array('empty'=>'None'));?>
        </div> 
            </div>
    </form>
</div>
</div>
 <?php   
endforeach;
/*
 $users = new CActiveDataProvider('User');
 
 $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'designation-grid',
	'dataProvider'=>$users,
	//'filter'=>$model,
	'columns'=>array(
            array(
                'header'=>'First Name',
                'value'=>'TbHtml::activeTextFieldControlGroup($data->profile,"lastname")',
            )
            ),
     ));
 * */
 ?>
<?php
$x="";
for ($j=$page+1;$j<=$page+10;$j++)
{
    $x.= "<a href='/Basedata/designation/usersForm?page=$j'>$j</a>"."    ";
}
echo "<div class='row'>".$x."</div>";
?>
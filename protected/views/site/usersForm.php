<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php
if (!isset($page))
{$page=1;}
$size=$page*9;
$userid=null;
if ($username)
{
 $userid=User::model()->findByAttributes(array('username'=>$username))->id;
}
$criteria=new CDbCriteria(array('order'=>'id asc','limit'=>10));
if ($userid)
$criteria->addCondition("id =".$userid);
else {

$criteria->addCondition("id > :size");
$criteria->params=array(':size'=>$size,);
}
$users =User::model()->findAll($criteria);$i=-1;
?>
<div class="form" class='form-inline'>
    <form role="form" method="POST">
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
            <div class='col-md-1'><?php echo $i;?></div>
            <div class='col-md-2'><?php echo $user->username;?></div>
       
            <?php echo CHtml::hiddenField("Profile[$i][username]",$user->username);?>
       
            <div class="col-md-2">
        <?php echo TbHtml::activeTextField($user->profile?$user->profile:new Profile, "[$i]firstname",array('class'=>'hindiinput'));?>
        </div>
        <div class='col-md-2'>
        <?php echo TbHtml::activeTextField($user->profile?$user->profile:new Profile, "[$i]lastname",array('class'=>'hindiinput'));?>
        </div>
        <div class='col-md-2'>
         <?php echo TbHtml::activeTextField($user->profile?$user->profile:new Profile, "[$i]mobile");?>
        </div> 

        <div class='col-md-2'>
        <?php echo TbHtml::activeDropDownList($user->profile?$user->profile:new Profile, "[$i]designation", Utility::listAllByAttributes("Designation", array('district_code'=>  Utility::getDistrict(Yii::app()->user->id))),array('empty'=>'None'));?>
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
  <div class="row">
     <?php       echo TbHtml::submitButton('Save', array(
    'color' => TbHtml::BUTTON_COLOR_PRIMARY,
    'size' => TbHtml::BUTTON_SIZE_LARGE,
));?>
        </div>
    </form>
</div>
<?php
$x="";
for ($j=1;$j<=$page+10;$j++)
{
    $x.= "<a href='/site/usersForm?page=$j'>$j</a>"."    ";
}
echo "<div class='row'>".$x."</div>";
?>
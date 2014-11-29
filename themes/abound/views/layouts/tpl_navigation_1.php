<section id="main-navigation">
<div class="navbar navbar-inverse navbar-static-top" role="navigation">
    <div class="navbar-inner">
        <div class="container">
           <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

            <!-- Be sure to leave the brand out there if you want it shown -->
            <?php $name='name_'.Yii::app()->language;?>
           
            <div class=" collapse navbar-collapse" id='navigation-bar'>

 <?php if (!Yii::app()->user->isGuest):?>
            <a class="navbar-brand" href="/"><?php echo Yii::t('app','District Magistrate Office').','.District::model()->findByPk(Utility::getDistrict(Yii::app()->user->id))->$name;?></a>
            <?php else:?>
             <a class="navbar-brand" href="/"><?php echo Yii::t('app','District Magistrate Office').','.Yii::t('app','Azamgarh')?></a>
           <?php endif;?>
            
<?php
$user_name="";
if (!Yii::app()->user->isGuest)
{
//$user_name=(User::model()->findByPk(Yii::app()->user->id)->profile)?User::model()->findByPk(Yii::app()->user->id)->profile->firstname.' '.User::model()->findByPk(Yii::app()->user->id)->profile->lastname:'';
$designation=Designation::getDesignationModelByUser(Yii::app()->user->id);
        $user_name=$designation?$designation->officer_name:'';
}
    ?>
                <?php
                $this->widget('YiiSmartMenu', array(
                  //  'partItemSeparator' => '.',
                   // 'upperCaseFirstLetter' => true,
                    'htmlOptions' => array('class' => 'pull-right nav navbar-nav',),
                    'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
                    'itemCssClass' => 'item-test',
                    'encodeLabel' => false,
                    'items' => array(
                         array('label' => 'Backup', 'url' => array('/backup')),
                        array('label' => 'Basedata', 'url' => array('/Basedata')),
                         array('label' => Yii::t('app','Land disputes').'<span class="caret"></span>', 'url'=>'#',
                             'itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"), 
                             'items'=>array(
                                 array('label'=>'Create','url' => array('/landdisputes/create')),
                                 array('label'=>'Manage','url' => array('/landdisputes/admin')),
				 array('label'=>'Search','url' => array('/landdisputes/search')),
				 array('label'=>'Datewise','url' => array('/landdisputes/datewise')),
                                  array('label'=>'Approve','url' => array('/landdisputes/approve')),
                                 
                                 )),
                         array('label' => Yii::t('app','Complaints').'<span class="caret"></span>', 'url'=>'#',
                             'itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"), 
                             'items'=>array(
                                 array('label'=>'Create','url' => array('/complaints/create')),
                                 array('label'=>'Manage','url' => array('/complaints/admin')),
                                  array('label'=>'Search','url' => array('/complaints/search')),
				 array('label'=>'Datewise','url' => array('/complaints/datewise')),
                                  array('label'=>'Approve','url' => array('/complaints/approve')),
                                 
                                 )),
                        array('label'=>'<span id="clock"></span>','url'=>'#'),
                         array('label' => 'Login', 'url' => array('/user/login'), 'visible' => Yii::app()->user->isGuest),
                        array('label'=>'<span class="glyphicon glyphicon-user" aria-hidden="true"></span> ' . Yii::app()->user->name.' <span class=caret></span>' , 'url'=>'#','visible'=>!Yii::app()->user->isGuest,
                            'itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"),  'items'=>
                        array(    
                              array('url'=>'#','label'=>Yii::app()->user->isGuest?'':Designation::getDesignationModelByUser(Yii::app()->user->id)->$name,'visible'=>!Yii::app()->user->isGuest),
                            array('label'=>'','url'=>'#','itemOptions'=>array('class'=>'divider')),
                        array('label'=>$user_name,'url'=>'#'),
                              array('label'=>'','url'=>'#','itemOptions'=>array('class'=>'divider')),
                        //array('label' => '<span class="glyphicon glyphicon-user" aria-hidden="true"></span> User Profile', 'url' => array('/user/profile'), 'visible' => !Yii::app()->user->isGuest),
                        array('label' => '<span class="glyphicon glyphicon-off" aria-hidden="true"></span> Logout', 'url' => array('/user/logout'), 'visible' => !Yii::app()->user->isGuest),
                            ),
                            ),
                            ),
                ));
                ?>
            </div>

        </div>
    </div>

</div>

</section>
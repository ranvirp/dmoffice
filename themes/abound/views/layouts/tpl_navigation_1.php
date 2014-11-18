<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target="#navigation-bar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <!-- Be sure to leave the brand out there if you want it shown -->
            <?php $name='name_'.Yii::app()->language;?>
            <?php if (!Yii::app()->user->isGuest):?>
            <a class="navbar-brand" href="/"><?php echo Yii::t('app','District Magistrate Office').','.District::model()->findByPk(Utility::getDistrict(Yii::app()->user->id))->$name;?></a>
            <?php else:?>
             <a class="navbar-brand" href="/"><?php echo Yii::t('app','District Magistrate Office').','.Yii::t('app','Azamgarh')?></a>
           <?php endif;?>
            <div class="navbar-collapse collapse">


<?php
$user_name="";
if (!Yii::app()->user->isGuest)
$user_name=(User::model()->findByPk(Yii::app()->user->id)->profile)?User::model()->findByPk(Yii::app()->user->id)->profile->firstname.' '.User::model()->findByPk(Yii::app()->user->id)->profile->lastname:'';
?>
                <?php
                $this->widget('YiiSmartMenu', array(
                  //  'partItemSeparator' => '.',
                   // 'upperCaseFirstLetter' => true,
                    'htmlOptions' => array('class' => 'pull-right nav navbar-nav','id'=>'navigation-bar'),
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
                                 
                                 )),
                         array('label' => Yii::t('app','Complaints').'<span class="caret"></span>', 'url'=>'#',
                             'itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"), 
                             'items'=>array(
                                 array('label'=>'Create','url' => array('/complaints/create')),
                                 array('label'=>'Manage','url' => array('/complaints/admin')),
                                  array('label'=>'Search','url' => array('/complaints/search')),
				 array('label'=>'Datewise','url' => array('/complaints/datewise')),
                                 
                                 )),
                      
                        array('label' => 'Login', 'url' => array('/user/login'), 'visible' => Yii::app()->user->isGuest),
                        array('label' => 'Logout (' . Yii::app()->user->name . ')'.'</br>'. (Yii::app()->user->isGuest?'':Designation::getDesignationModelByUser(Yii::app()->user->id)->$name)."<br/>".$user_name, 'url' => array('/user/logout'), 'visible' => !Yii::app()->user->isGuest),
                    ),
                ));
                ?>
            </div>

        </div>
    </div>
</div>

<div class="subnav navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">

            <div class="style-switcher pull-left">
                <a href="javascript:chooseStyle('none', 60)" checked="checked"><span class="style" style="background-color:#0088CC;"></span></a>
                <a href="javascript:chooseStyle('style2', 60)"><span class="style" style="background-color:#7c5706;"></span></a>
                <a href="javascript:chooseStyle('style3', 60)"><span class="style" style="background-color:#468847;"></span></a>
                <a href="javascript:chooseStyle('style4', 60)"><span class="style" style="background-color:#4e4e4e;"></span></a>
                <a href="javascript:chooseStyle('style5', 60)"><span class="style" style="background-color:#d85515;"></span></a>
                <a href="javascript:chooseStyle('style6', 60)"><span class="style" style="background-color:#a00a69;"></span></a>
                <a href="javascript:chooseStyle('style7', 60)"><span class="style" style="background-color:#a30c22;"></span></a>
            </div>
            <form class="navbar-search pull-right" action="">

                <input type="text" class="search-query span2" placeholder="Search">

            </form>
        </div><!-- container -->
    </div><!-- navbar-inner -->
</div><!-- subnav -->
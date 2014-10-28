<?php
$this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Login");
$this->breadcrumbs=array(
	UserModule::t("Login"),
);
?>
<div class="container">
    <div class="col-md-4 col-md-offset-2 well center">
<h1><?php echo UserModule::t("Login"); ?></h1>

<?php if(Yii::app()->user->hasFlash('loginMessage')): ?>

<div class="success">
	<?php echo Yii::app()->user->getFlash('loginMessage'); ?>
</div>

<?php endif; ?>

<p><?php echo UserModule::t("Please fill out the following form with your login credentials:"); ?></p>

<div class="form">
<?php echo TbHtml::beginForm(); ?>

	<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>
	
	<?php echo TbHtml::errorSummary($model); ?>
	
	<div class="row">
		<?php echo TbHtml::activeLabelEx($model,'username'); ?>
		<?php echo TbHtml::activeTextField($model,'username') ?>
	</div>
	
	<div class="row">
		<?php echo TbHtml::activeLabelEx($model,'password'); ?>
		<?php echo TbHtml::activePasswordField($model,'password') ?>
	</div>
	
	<div class="row">
		<p class="hint">
		<?php echo TbHtml::link(UserModule::t("Register"),Yii::app()->getModule('user')->registrationUrl); ?> | <?php echo TbHtml::link(UserModule::t("Lost Password?"),Yii::app()->getModule('user')->recoveryUrl); ?>
		</p>
	</div>
	
	<div class="row rememberMe">
		<?php echo TbHtml::activeCheckBox($model,'rememberMe'); ?>
		<?php echo TbHtml::activeLabelEx($model,'rememberMe'); ?>
	</div>

	<div class="row submit">
            <div class="col-centered">
		<?php echo TbHtml::submitButton(UserModule::t("Login")); ?>
            </div>
	</div>
	
<?php echo TbHtml::endForm(); ?>
</div><!-- form -->
    </div>
</div>

<?php
$form = new CForm(array(
    'elements'=>array(
        'username'=>array(
            'type'=>'text',
            'maxlength'=>32,
        ),
        'password'=>array(
            'type'=>'password',
            'maxlength'=>32,
        ),
        'rememberMe'=>array(
            'type'=>'checkbox',
        )
    ),

    'buttons'=>array(
        'login'=>array(
            'type'=>'submit',
            'label'=>'Login',
        ),
    ),
), $model);
?>
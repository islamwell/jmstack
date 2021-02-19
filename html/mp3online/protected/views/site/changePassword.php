<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-changePassword-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
    <div class="row">
        <?php echo $form->labelEx($model,'currentPassword'); ?>
        <?php echo $form->passwordField($model,'currentPassword'); ?>
        <?php echo $form->error($model,'currentPassword'); ?>
    </div>
	<div class="row">
		<?php echo $form->labelEx($model,'newPassword'); ?>
		<?php echo $form->passwordField($model,'newPassword'); ?>
		<?php echo $form->error($model,'newPassword'); ?>
	</div>
    <div class="row">
        <?php echo $form->labelEx($model,'newPasswordRepeat'); ?>
        <?php echo $form->passwordField($model,'newPasswordRepeat'); ?>
        <?php echo $form->error($model,'newPasswordRepeat'); ?>
    </div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
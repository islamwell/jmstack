<?php
/* @var $this SettingsController */
/* @var $model Settings */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'settings-form',
	'htmlOptions' => array(
		'enctype' => 'multipart/form-data',
	),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'metaKey'); ?>
		<?php echo $form->textField($model,'metaKey',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'metaKey'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'metaValue'); ?>
		<?php echo $form->textField($model,'metaValue',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'metaValue'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
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
		<?php echo $form->labelEx($model,'api_key'); ?>
		<?php echo $form->textField($model,'api_key',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'api_key'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pem'); ?>
		<?php echo CHtml::activeFileField($model,'pem'); ?>
		<?php echo $form->error($model,'pem'); ?>
	</div>

	<div class="row">
		<?php
			echo 'Old Your Pem is: '.$pemFile;
		?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
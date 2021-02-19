<?php
/* @var $this RadioController */
/* @var $model Radio */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'radio-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'link'); ?>
		<?php echo $form->textField($model,'link',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'link'); ?>
	</div>
	
	<!--<div class="row">
		<?php /*echo $form->labelEx($model,'mixlr'); */?>
		<?php /*echo $form->textField($model,'mixlr',array('size'=>60,'maxlength'=>255)); */?>
		<?php /*echo $form->error($model,'mixlr'); */?>
	</div>

	<div class="row">
		<?php /*echo $form->labelEx($model,'type'); */?>
		<?php /*echo $form->dropDownList($model,'type',array(Constants::RADIO_TYPE_LINK => 'Link', Constants::RADIO_TYPE_MIXLR => 'Mixlr')); */?>
		<?php /*echo $form->error($model,'type'); */?>
	</div>-->

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropDownList($model,'status',array(Constants::STATUS_ACTIVE => 'Active', Constants::STATUS_INACTIVE => 'Inactive')); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
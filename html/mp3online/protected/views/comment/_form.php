<?php
/* @var $this CommentController */
/* @var $model Comment */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'comment-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'Comment'); ?>
		<?php echo $form->textField($model,'cmt',array('size'=>40,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'cmt'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Song ID'); ?>
		<?php echo $form->textField($model,'song_id'); ?>
		<?php echo $form->error($model,'song_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Create Time'); ?>
		<?php echo $form->textField($model,'time'); ?>
		<?php echo $form->error($model,'time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Status'); ?>
        <?php echo $form->dropDownList($model,'status', array(1=>'Yes',0=>'No')); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
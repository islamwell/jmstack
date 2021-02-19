<?php
/* @var $this PlaylistController */
/* @var $model Playlist */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'playlist-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'playlist_name'); ?>
		<?php echo $form->textField($model,'playlist_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'playlist_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'info'); ?>
		<?php echo $form->textField($model,'info',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'info'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'link'); ?>
        <?php echo $form->dropDownList($model,'link', CHtml::listData(category::model()->findAll(),'song_id','song_name'),array('prompt'=>'Select Song')); ?>
<!--		--><?php //echo $form->textArea($model,'link',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'link'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'views'); ?>
		<?php echo $form->textField($model,'views'); ?>
		<?php echo $form->error($model,'views'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'update_date'); ?>
        <?php
        $this->widget('application.extensions.timepicker.EJuiDateTimePicker',array(
            'model'=>$model,
            'attribute'=>'update_date',
            'options'=>array(
                // 'hourGrid' => 4,
                // 'hourMin' => 0,
                // 'hourMax' => 23,
                'dateFormat' => 'yy-mm-dd',
                // 'timeFormat' => 'h:m:s',
                'changeMonth' => true,
                'changeYear' => true,
            ),
        ));
        ?>
		<?php echo $form->error($model,'update_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropDownList($model,'status',array(1=>'Yes',0=>'No')); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
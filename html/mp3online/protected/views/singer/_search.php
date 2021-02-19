<?php
/* @var $this SingerController */
/* @var $model Singer */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'singer_id'); ?>
		<?php echo $form->textField($model,'singer_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'singer_name'); ?>
		<?php echo $form->dropDownList($model,'singer_name',CHtml::listData(Singer::model()->findAll(),'singer_name','singer_name'),array('prompt'=>'---Select---')); ?>
	</div>

	<!--<div class="row">
		<?php /*echo $form->label($model,'singer_img'); */?>
		<?php /*echo $form->textArea($model,'singer_img',array('rows'=>6, 'cols'=>50)); */?>
	</div>-->

	<!--<div class="row">
		<?php /*echo $form->label($model,'profile'); */?>
		<?php /*echo $form->textField($model,'profile',array('size'=>0,'maxlength'=>0)); */?>
	</div>-->
    <div class="row">
		<?php echo $form->label($model,'order_number'); ?>
		<?php echo $form->textField($model,'order_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->dropDownList($model,'status',array(1=>'Active',0=>'Inactive'),array('prompt'=>'---Select---')); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
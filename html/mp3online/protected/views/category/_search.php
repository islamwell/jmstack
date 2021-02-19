<?php
/* @var $this CategoryController */
/* @var $model Category */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'category_id'); ?>
		<?php echo $form->textField($model,'category_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'category_name'); ?>
		<?php echo $form->dropDownList($model,'category_name',CHtml::listData(Category::model()->findAll(),'category_name','category_name'),array('prompt'=>'---Select---')); ?>
	</div>

    <div class="row">
        <?php echo $form->label($model,'order_number'); ?>
        <?php echo $form->textField($model,'order_number'); ?>
    </div>

	<!--<div class="row">
		<?php /*echo $form->label($model,'category_img'); */?>
		<?php /*echo $form->textField($model,'category_img'); */?>
	</div>-->

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->dropDownList($model,'status',array(1=>'Active',0=>'Inactive'),array('prompt'=>'---Select---')); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
<?php
/* @var $this AlbumController */
/* @var $model Album */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'album_id'); ?>
		<?php echo $form->textField($model,'album_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'album_name'); ?>
		<?php echo $form->dropDownList($model,'album_name',CHtml::listData(Album::model()->findAll(),'album_name','album_name'),array('prompt'=>'---Select---')); ?>
	</div>

	<!--<div class="row">
		<?php /*echo $form->label($model,'album_img'); */?>
		<?php /*echo $form->textArea($model,'album_img',array('rows'=>6, 'cols'=>50)); */?>
	</div>-->
    <!--<div class="row">
        <?php /*echo $form->label($model,'parent_cateId'); */?>
        <?php /*echo $form->dropDownList($model,'parent_cateId',CHtml::listData(Category::model()->findAll('parentId = 0'),'category_id','category_name'),array('prompt'=>'---Select---')); */?>
    </div>-->

	<div class="row">
		<?php echo $form->label($model,'category_id'); ?>
        <?php echo $form->dropDownList($model,'category_id',CHtml::listData(Category::model()->findAll('parentId != 0'),'category_id','category_name'),array('prompt'=>'---Select---')); ?>
	</div>

    <div class="row">
        <?php echo $form->label($model,'order_number'); ?>
        <?php echo $form->textField($model,'order_number'); ?>
    </div>

	<div class="row">
		<?php echo $form->label($model,'number_song'); ?>
		<?php echo $form->textField($model,'number_song'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'create_date'); ?>
		<?php echo $form->textField($model,'create_date'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
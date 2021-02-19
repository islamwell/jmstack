<?php
/* @var $this SongController */
/* @var $model Song */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'song_id'); ?>
		<?php echo $form->textField($model,'song_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'song_name'); ?>
		<?php echo $form->dropDownList($model,'song_name',CHtml::listData(Song::model()->findAll(),'song_name','song_name'),array('prompt'=>'---Select---')); ?>
	</div>

	<!--<div class="row">
		<?php /*echo $form->label($model,'lyrics'); */?>
		<?php /*echo $form->textField($model,'lyrics',array('size'=>60,'maxlength'=>255)); */?>
	</div>-->

	<!--<div class="row">
		<?php /*echo $form->label($model,'link'); */?>
		<?php /*echo $form->textArea($model,'link',array('rows'=>6, 'cols'=>50)); */?>
	</div>-->

	<div class="row">
		<?php echo $form->label($model,'singer_id'); ?>
		<?php echo $form->dropDownList($model,'singer_id',CHtml::listData(Singer::model()->findAll(),'singer_id','singer_name'),array('prompt'=>'---Select---')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'listen'); ?>
		<?php echo $form->textField($model,'listen'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'album_id'); ?>
        <?php echo $form->dropDownList($model,'album_id',CHtml::listData(Album::model()->findAll(),'album_id','album_name'),array('prompt'=>'---Select---')); ?>
	</div>

	<!--<div class="row">
		<?php /*echo $form->label($model,'author_id'); */?>
        <?php /*echo $form->dropDownList($model,'author_id',CHtml::listData(Author::model()->findAll(),'author_id','author_name'),array('prompt'=>'---Select---')); */?>
	</div>-->

	<div class="row">
		<?php echo $form->label($model,'category_id'); ?>
        <?php echo $form->dropDownList($model,'category_id',CHtml::listData(Category::model()->findAll(),'category_id','category_name'),array('prompt'=>'---Select---')); ?>
    </div>

	<div class="row">
		<?php echo $form->label($model,'download'); ?>
		<?php echo $form->textField($model,'download'); ?>
	</div>

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
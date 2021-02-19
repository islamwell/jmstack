<?php
/* @var $this SongController */
/* @var $data Song */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('song_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->song_id), array('view', 'id'=>$data->song_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('song_name')); ?>:</b>
	<?php echo CHtml::encode($data->song_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lyrics')); ?>:</b>
	<?php echo CHtml::encode($data->lyrics); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('link')); ?>:</b>
	<?php echo CHtml::encode($data->link); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('singer_id')); ?>:</b>
	<?php echo CHtml::encode($data->singer_id); ?>
	<br />

<!--	<b>--><?php //echo CHtml::encode($data->getAttributeLabel('views')); ?><!--:</b>-->
<!--	--><?php //echo CHtml::encode($data->views); ?>
<!--	<br />-->

	<b><?php echo CHtml::encode($data->getAttributeLabel('album_id')); ?>:</b>
	<?php echo CHtml::encode($data->album_id); ?>
	<br />

	
	<b><?php echo CHtml::encode($data->getAttributeLabel('author_id')); ?>:</b>
	<?php echo CHtml::encode($data->author_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('category_id')); ?>:</b>
	<?php echo CHtml::encode($data->category_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('download')); ?>:</b>
	<?php echo CHtml::encode($data->download); ?>
	<br />

<!--	<b>--><?php //echo CHtml::encode($data->getAttributeLabel('status')); ?><!--:</b>-->
<!--	--><?php //echo CHtml::encode($data->status); ?>
<!--	<br />-->


</div>
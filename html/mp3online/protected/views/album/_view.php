<?php
/* @var $this AlbumController */
/* @var $data Album */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('album_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->album_id), array('view', 'id'=>$data->album_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('album_name')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->album_name), array('view', 'id'=>$data->album_name)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('album_img')); ?>:</b>
	<?php echo CHtml::encode($data->album_img); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('category_id')); ?>:</b>
	<?php echo CHtml::encode($data->category_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('number_song')); ?>:</b>
	<?php echo CHtml::encode($data->number_song); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_date')); ?>:</b>
	<?php echo CHtml::encode($data->create_date); ?>
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />


</div>
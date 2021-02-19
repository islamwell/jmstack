<?php
/* @var $this PlaylistController */
/* @var $data Playlist */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('playlist_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->playlist_id), array('view', 'id'=>$data->playlist_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('playlist_name')); ?>:</b>
	<?php echo CHtml::encode($data->playlist_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('info')); ?>:</b>
	<?php echo CHtml::encode($data->info); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('link')); ?>:</b>
	<?php echo CHtml::encode($data->link); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('views')); ?>:</b>
	<?php echo CHtml::encode($data->views); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('update_date')); ?>:</b>
	<?php echo CHtml::encode($data->update_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />


</div>
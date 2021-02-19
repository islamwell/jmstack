<?php
/* @var $this CommentController */
/* @var $data Comment */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('cmt_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->cmt_id), array('view', 'id'=>$data->cmt_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cmt')); ?>:</b>
	<?php echo CHtml::encode($data->cmt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('song_id')); ?>:</b>
	<?php echo CHtml::encode($data->song_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('time')); ?>:</b>
	<?php echo CHtml::encode($data->time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />


</div>
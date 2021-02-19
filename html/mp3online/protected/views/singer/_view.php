<?php
/* @var $this SingerController */
/* @var $data Singer */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('singer_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->singer_id), array('view', 'id'=>$data->singer_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('singer_name')); ?>:</b>
	<?php echo CHtml::encode($data->singer_name); ?>
	<br />

	<!--<b><?php /*echo CHtml::encode($data->getAttributeLabel('singer_img')); */?>:</b>
	<?php /*echo CHtml::encode($data->singer_img); */?>
	<br />-->

	<b><?php echo CHtml::encode($data->getAttributeLabel('profile')); ?>:</b>
	<?php echo CHtml::encode($data->profile); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />


</div>
<?php
/* @var $this SettingsController */
/* @var $data Settings */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('metaKey')); ?>:</b>
	<?php echo CHtml::encode($data->metaKey); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('metaValue')); ?>:</b>
	<?php echo CHtml::encode($data->metaValue); ?>
	<br />


</div>
<?php
/* @var $this RadioController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Radios',
);

$this->menu=array(
	array('label'=>'Create Radio', 'url'=>array('create')),
	array('label'=>'Manage Radio', 'url'=>array('admin')),
);
?>

<h1>Radios</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

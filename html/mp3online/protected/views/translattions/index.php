<?php
/* @var $this TranslattionsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Translattions',
);

$this->menu=array(
	array('label'=>'Create Translattions', 'url'=>array('create')),
	array('label'=>'Manage Translattions', 'url'=>array('admin')),
);
?>

<h1>Translattions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

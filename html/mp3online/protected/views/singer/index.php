<?php
/* @var $this SingerController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Singers',
);

$this->menu=array(
	array('label'=>'Create Singer', 'url'=>array('create')),
	array('label'=>'Manage Singer', 'url'=>array('admin')),
);
?>

<h1>Singers</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

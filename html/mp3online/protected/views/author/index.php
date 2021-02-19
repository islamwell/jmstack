<?php
/* @var $this AuthorController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Composers',
);

$this->menu=array(
	array('label'=>'Create Composers', 'url'=>array('create')),
	array('label'=>'Manage Composers', 'url'=>array('admin')),
);
?>

<h1>Composers</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

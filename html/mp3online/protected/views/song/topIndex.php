<?php
/* @var $this SongController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Top Songs',
);

$this->menu=array(
	array('label'=>'Create Song', 'url'=>array('create')),
	array('label'=>'Manage Song', 'url'=>array('admin')),
);
?>

<h1>Top Songs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

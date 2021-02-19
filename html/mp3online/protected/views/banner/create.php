<?php
/* @var $this BannerController */
/* @var $model Banner */

$this->breadcrumbs=array(
	'Banners'=>array('admin','type' => $type),
	'Create',
);

$this->menu=array(
	//array('label'=>'List Banner', 'url'=>array('index')),
	array('label'=>'Manage Banner', 'url'=>array('admin','type' => $type)),
);
?>

<h1>Create Banner</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
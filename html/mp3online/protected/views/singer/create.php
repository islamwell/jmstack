<?php
/* @var $this SingerController */
/* @var $model Singer */

$this->breadcrumbs=array(
	'Singers'=>array('admin'),
	'Create',
);

$this->menu=array(
	//array('label'=>'List Singer', 'url'=>array('index')),
	array('label'=>'Manage Singer', 'url'=>array('admin')),
    array('label'=>'Back', 'url'=>'javascript:history.go(-1)'),
);
?>

<h1>Create Singer</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
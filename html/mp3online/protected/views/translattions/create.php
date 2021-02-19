<?php
/* @var $this TranslattionsController */
/* @var $model Translattions */

$this->breadcrumbs=array(
	'Translattions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Translattions', 'url'=>array('index')),
	array('label'=>'Manage Translattions', 'url'=>array('admin')),
);
?>

<h1>Create Translattions</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
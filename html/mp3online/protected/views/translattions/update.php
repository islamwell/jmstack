<?php
/* @var $this TranslattionsController */
/* @var $model Translattions */

$this->breadcrumbs=array(
	'Translattions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Translattions', 'url'=>array('index')),
	array('label'=>'Create Translattions', 'url'=>array('create')),
	array('label'=>'View Translattions', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Translattions', 'url'=>array('admin')),
);
?>

<h1>Update Translattions <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
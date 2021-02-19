<?php
/* @var $this RadioController */
/* @var $model Radio */

$this->breadcrumbs=array(
	'Radios'=>array('admin'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	//array('label'=>'List Radio', 'url'=>array('index')),
	//array('label'=>'Create Radio', 'url'=>array('create')),
	array('label'=>'View Radio', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Radio', 'url'=>array('admin')),
);
?>

<h1>Update Radio: <?php echo $model->name; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
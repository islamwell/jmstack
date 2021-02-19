<?php
/* @var $this SingerController */
/* @var $model Singer */

$this->breadcrumbs=array(
	'Singers'=>array('admin'),
	$model->singer_name=>array('view','id'=>$model->singer_id),
	'Update',
);

$this->menu=array(
	//array('label'=>'List Singer', 'url'=>array('index')),
	array('label'=>'Create Singer', 'url'=>array('create')),
	array('label'=>'View Singer', 'url'=>array('view', 'id'=>$model->singer_id)),
	array('label'=>'Manage Singer', 'url'=>array('admin')),
    array('label'=>'Back', 'url'=>'javascript:history.go(-1)'),
);
?>

<h1>Update Singer: <?php echo $model->singer_name; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
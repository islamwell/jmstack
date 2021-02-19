<?php
/* @var $this AuthorController */
/* @var $model Author */

$this->breadcrumbs=array(
	'Composers'=>array('admin'),
	$model->author_name=>array('view','id'=>$model->author_id),
	'Update',
);

$this->menu=array(
	//array('label'=>'List Composers', 'url'=>array('index')),
	array('label'=>'Create Composers', 'url'=>array('create')),
	array('label'=>'View Composers', 'url'=>array('view', 'id'=>$model->author_id)),
	array('label'=>'Manage Composers', 'url'=>array('admin')),
    array('label'=>'Back', 'url'=>'javascript:history.go(-1)'),
);
?>

<h1>Update Author: <?php echo $model->author_name; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
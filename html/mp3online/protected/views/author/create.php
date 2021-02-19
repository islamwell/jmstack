<?php
/* @var $this AuthorController */
/* @var $model Author */

$this->breadcrumbs=array(
	'Composers'=>array('admin'),
	'Create',
);

$this->menu=array(
	//array('label'=>'List Composers', 'url'=>array('index')),
	array('label'=>'Manage Composers', 'url'=>array('admin')),
    array('label'=>'Back', 'url'=>'javascript:history.go(-1)'),
);
?>

<h1>Create Composers</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
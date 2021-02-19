<?php
/* @var $this SongController */
/* @var $model Song */

$this->breadcrumbs=array(
	'Lectures'=>array('admin'),
	'Create',
);

$this->menu=array(
	//array('label'=>'List Song', 'url'=>array('index')),
	array('label'=>'Manage Lectures', 'url'=>array('admin')),
    array('label'=>'Back', 'url'=>'javascript:history.go(-1)'),
);
?>

<h1>Create Lecture</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
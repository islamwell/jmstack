<?php
/* @var $this AlbumController */
/* @var $model Album */

$this->breadcrumbs=array(
	'Series'=>array('admin'),
	'Create',
);

$this->menu=array(
	//array('label'=>'List Album', 'url'=>array('index')),
	array('label'=>'Manage Series', 'url'=>array('admin')),
    array('label'=>'Back', 'url'=>'javascript:history.go(-1)'),
);
?>

<h1>Create Series</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
/* @var $this SongController */
/* @var $model Song */

$this->breadcrumbs=array(
	'Lectures'=>array('admin'),
	$model->song_name=>array('view','id'=>$model->song_id),
	'Update',
);

$this->menu=array(
	//array('label'=>'List Song', 'url'=>array('index')),
	array('label'=>'Create Lecture', 'url'=>array('create')),
	array('label'=>'View Lecture', 'url'=>array('view', 'id'=>$model->song_id)),
	array('label'=>'Manage Lectures', 'url'=>array('admin')),
    array('label'=>'Back', 'url'=>'javascript:history.go(-1)'),
);
?>

<h1>Update Lecture: <?php echo $model->song_name; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
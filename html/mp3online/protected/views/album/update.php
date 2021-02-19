<?php
/* @var $this AlbumController */
/* @var $model Album */

$this->breadcrumbs=array(
	'Series'=>array('admin'),
	$model->album_name=>array('view','id'=>$model->album_id),
	'Update',
);

$this->menu=array(
	//array('label'=>'List Album', 'url'=>array('index')),
	array('label'=>'Create Series', 'url'=>array('create')),
	array('label'=>'View Series', 'url'=>array('view', 'id'=>$model->album_id)),
	array('label'=>'Manage Series', 'url'=>array('admin')),
    array('label'=>'Back', 'url'=>'javascript:history.go(-1)'),
);
?>

<h1>Update Series: <?php echo $model->album_name; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
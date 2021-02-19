<?php
/* @var $this PlaylistController */
/* @var $model Playlist */

$this->breadcrumbs=array(
	'Playlists'=>array('index'),
	$model->playlist_id=>array('view','id'=>$model->playlist_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Playlist', 'url'=>array('index')),
	array('label'=>'Create Playlist', 'url'=>array('create')),
	array('label'=>'View Playlist', 'url'=>array('view', 'id'=>$model->playlist_id)),
	array('label'=>'Manage Playlist', 'url'=>array('admin')),
);
?>

<h1>Update Playlist <?php echo $model->playlist_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
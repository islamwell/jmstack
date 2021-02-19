<?php
/* @var $this PlaylistController */
/* @var $model Playlist */

$this->breadcrumbs=array(
	'Playlists'=>array('index'),
	$model->playlist_id,
);

$this->menu=array(
	array('label'=>'List Playlist', 'url'=>array('index')),
	array('label'=>'Create Playlist', 'url'=>array('create')),
	array('label'=>'Update Playlist', 'url'=>array('update', 'id'=>$model->playlist_id)),
	array('label'=>'Delete Playlist', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->playlist_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Playlist', 'url'=>array('admin')),
);
?>

<h1>View Playlist #<?php echo $model->playlist_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'playlist_id',
		'playlist_name',
		'info',
		'link',
		'views',
		'update_date',
		'status',
	),
)); ?>

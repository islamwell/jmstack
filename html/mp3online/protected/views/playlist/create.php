<?php
/* @var $this PlaylistController */
/* @var $model Playlist */

$this->breadcrumbs=array(
	'Playlists'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Playlist', 'url'=>array('index')),
	array('label'=>'Manage Playlist', 'url'=>array('admin')),
);
?>

<h1>Create Playlist</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
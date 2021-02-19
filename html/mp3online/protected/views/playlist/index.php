<?php
/* @var $this PlaylistController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Playlists',
);

$this->menu=array(
	array('label'=>'Create Playlist', 'url'=>array('create')),
	array('label'=>'Manage Playlist', 'url'=>array('admin')),
);
?>

<h1>Playlists</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

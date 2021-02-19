<?php
/* @var $this BannerController */
/* @var $model Banner */

$this->breadcrumbs=array(
	'Banners'=>array('admin','type' => $type),
	$model->title=>array('view','id'=>$model->id,'type' => $type),
	'Update',
);

if($type == Constants::TYPE_BANNER_NORMAL) {
	$this->menu = array(
		//array('label'=>'List Banner', 'url'=>array('index')),
		array('label' => 'Create Banner', 'url' => array('create', 'type' => $type)),
		array('label' => 'View Banner', 'url' => array('view', 'id' => $model->id, 'type' => $type)),
		array('label' => 'Manage Banner', 'url' => array('admin', 'type' => $type)),
	);
}
else
{
	$this->menu = array(
		//array('label'=>'List Banner', 'url'=>array('index')),
		//array('label' => 'Create Banner', 'url' => array('create', 'type' => $type)),
		array('label' => 'View Banner', 'url' => array('view', 'id' => $model->id, 'type' => $type)),
		array('label' => 'Manage Banner', 'url' => array('admin', 'type' => $type)),
	);
}

?>

<h1>Update Banner: <?php echo $model->title; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
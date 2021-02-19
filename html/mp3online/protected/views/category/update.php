<?php
/* @var $this CategoryController */
/* @var $model Category */

$this->breadcrumbs=array(
	'Categories'=>array('admin'),
	$model->category_name=>array('view','id'=>$model->category_id),
	'Update',
);

$this->menu=array(
	//array('label'=>'List Category', 'url'=>array('index')),
	array('label'=>'Create Category', 'url'=>array('create',/*'parentId'=>$parentId*/)),
	array('label'=>'View Category', 'url'=>array('view', 'id'=>$model->category_id,/*'parentId'=>$parentId*/)),
	array('label'=>'Manage Category', 'url'=>array('admin',/*'parentId'=>Constants::CATE_PARENT*/)),
    array('label'=>'Back', 'url'=>array('admin',/*'parentId'=>$parentId*/)),
);
?>

<h1>Update Category: <?php echo $model->category_name; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model,/*'parentId'=>$parentId*/)); ?>
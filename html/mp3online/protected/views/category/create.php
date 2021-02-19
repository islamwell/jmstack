<?php
/* @var $this CategoryController */
/* @var $model Category */

$this->breadcrumbs=array(
	'Categories'=>array('admin'),
	'Create',
);

$this->menu=array(
	//array('label'=>'List Category', 'url'=>array('index')),
	array('label'=>'Manage Category', 'url'=>array('admin',/*'parentId'=>Constants::CATE_PARENT*/)),
    array('label'=>'Back', 'url'=>array('admin',/*'parentId'=>$parentId*/)),
);
?>

<h1>Create Category</h1>

<?php $this->renderPartial('_form', array('model'=>$model,/*'parentId'=>$parentId*/)); ?>
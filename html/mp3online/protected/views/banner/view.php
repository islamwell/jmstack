<?php
/* @var $this BannerController */
/* @var $model Banner */

$this->breadcrumbs=array(
	'Banners'=>array('admin','type' => $type),
	$model->title,
);

if($type == Constants::TYPE_BANNER_NORMAL)
{
	$this->menu=array(
		//array('label'=>'List Banner', 'url'=>array('index')),
		array('label'=>'Create Banner', 'url'=> array('create','type' => $type)),
		array('label'=>'Update Banner', 'url'=> array('update', 'id'=>$model->id,'type' => $type)),
		array('label'=>'Delete Banner', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id,'type' => $type),'confirm'=>'Are you sure you want to delete this item?')),
		array('label'=>'Manage Banner', 'url'=>array('admin','type' => $type)),
	);
}
else
{
	$this->menu=array(
		//array('label'=>'List Banner', 'url'=>array('index')),
		//array('label'=>'Create Banner', 'url'=> array('create','type' => $type)),
		array('label'=>'Update Banner', 'url'=> array('update', 'id'=>$model->id,'type' => $type)),
		//array('label'=>'Delete Banner', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id,'type' => $type),'confirm'=>'Are you sure you want to delete this item?')),
		array('label'=>'Manage Banner', 'url'=>array('admin','type' => $type)),
	);
}

?>

<h1>View Banner #<?php echo $model->title; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		//'content:html',
		array(
			'header' => 'Images',
			 'name' => 'image',
			'type' => 'raw',
			'value' => function ($data) {
				if(strlen($data->image)>0){
					return "<img width='50px' src='".Yii::app()->request->baseUrl.'/images/banner/'.$data->image."'>";
				}else
					return 'No image';
			},
			'htmlOptions'=>array('style'=>'width: 60px; text-align: center;'),
		),
		'url',
		array(
			'header'=>'Status',
			'name'=>'status',
			'type'=>'raw',
			'value'=>function($data)
			{
				$id=$data->status;
				if($id == 1)
					return 'Active';
				else
					return 'Inactive';
			},
			//'filter'=>Category::itemAlias('status'),
			//'htmlOptions'=>array('style'=>'text-align: center;'),
		),
	),
)); ?>

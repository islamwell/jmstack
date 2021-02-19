<?php
/* @var $this BannerController */
/* @var $model Banner */

$this->breadcrumbs=array(
	'Banners'=>array('admin','type' => $type),
	'Manage',
);

if($type == 0) // banner normal
{
	$this->menu=array(
		//array('label'=>'List Banner', 'url'=>array('index')),
		array('label'=>'Create Banner', 'url'=>array('create','type' => $type)),
	);
}

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#banner-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Banners</h1>

<!--<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>-->

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'banner-grid',
	'dataProvider'=>$model->search($type),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		array(
			'header' => 'Images',
			// 'name' => 'category_img',
			'type' => 'raw',
			'value' => function ($data) {
				if(strlen($data->image)>0){
					return "<img width='150px' src='".Yii::app()->request->baseUrl.'/images/banner/'.$data->image."'>";
				}else
					return 'No image';
			},
			'htmlOptions'=>array('style'=>'width: 150px; text-align: center;'),
		),
		'title',
		//'content:html',
		//'image',
		'url',
		//'status',
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
			'filter'=>Category::itemAlias('status'),
			'htmlOptions'=>array('style'=>'text-align: center;'),
		),
		array(
			'class'=>'CButtonColumn',
			'template'=> $_REQUEST['type'] == 0 ? '{view}{update}{delete}' : '{view}{update}',
			'buttons'=>array
			(
				'view' => array
				(
					'label'=>'View',
					'imageUrl'=>Yii::app()->request->baseUrl.'/images/www/view.png',
					'url'=>'Yii::app()->createUrl("banner/view", array("id"=>$data->id,"type"=>$data->type))',
				),
				'update' => array
				(
					'label'=>'Update',
					'imageUrl'=>Yii::app()->request->baseUrl.'/images/www/update.png',
					'url'=>'Yii::app()->createUrl("banner/update", array("id"=>$data->id,"type"=>$data->type))',
				),
				'delete' => array
				(
					'label'=>'Delete',
					'imageUrl'=>Yii::app()->request->baseUrl.'/images/www/delete.png',
					'url'=>'Yii::app()->createUrl("banner/delete", array("id"=>$data->id,"type"=>$data->type))',
				),
			),
		),
	),
)); ?>

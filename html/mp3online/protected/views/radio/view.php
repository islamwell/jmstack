<?php
/* @var $this RadioController */
/* @var $model Radio */

$this->breadcrumbs=array(
	'Radios'=>array('admin'),
	$model->name,
);

$this->menu=array(
	//array('label'=>'List Radio', 'url'=>array('index')),
	//array('label'=>'Create Radio', 'url'=>array('create')),
	array('label'=>'Update Radio', 'url'=>array('update', 'id'=>$model->id)),
	//array('label'=>'Delete Radio', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Radio', 'url'=>array('admin')),
);
?>

<h1>View Radio #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'link:url',
		'mixlr:url',
		//'type',
		array(
			'header' => 'Type',
			'name' => 'type',
			'type' => 'raw',
			'value' => function($data)
			{
				if($data->type == Constants::RADIO_TYPE_LINK)
					return 'Link';
				else // type RADIO_TYPE_MIXLR
					return 'Mixlr';
			}
		),
		//'status',
		array(
			'header' => 'Status',
			'name' => 'status',
			'type' => 'raw',
			'value' => function($data)
			{
				if($data->status == Constants::STATUS_ACTIVE)
					return 'Active';
				else // type STATUS_INACTIVE
					return 'Inactive';
			}
		),
	),
)); ?>

<?php
/* @var $this RadioController */
/* @var $model Radio */

$this->breadcrumbs=array(
	'Radios'=>array('admin'),
	'Manage',
);

$this->menu=array(
	//array('label'=>'List Radio', 'url'=>array('index')),
	//array('label'=>'Create Radio', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#radio-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Radios</h1>

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
	'id'=>'radio-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		//'name',
		array(
			'header' => 'Name',
			'name' => 'name',
			'type' => 'raw',
			'value' => function($data)
			{
				return $data->name;
			},
			'htmlOptions'=>array('style'=>'text-align: center;'),
		),
		array(
			'header' => 'Link',
			'name' => 'link',
			'type' => 'url',
			'value' => function($data)
			{
				return $data->link;
			},
			'htmlOptions'=>array('style'=>'text-align: center;'),
		),
		/*array(
			'header' => 'Mixlr',
			'name' => 'mixlr',
			'type' => 'url',
			'value' => function($data)
			{
				return $data->mixlr;
			},
			'htmlOptions'=>array('style'=>'text-align: center;'),
		),
		//'link:url',
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
			},
			'filter' => array(Constants::RADIO_TYPE_LINK => 'Link', Constants::RADIO_TYPE_MIXLR => 'Mixlr'),
			'htmlOptions'=>array('style'=>'text-align: center;'),
		),*/
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
			},
			'filter' => array(Constants::STATUS_ACTIVE => 'Active', Constants::STATUS_INACTIVE => 'Inactive'),
			'htmlOptions'=>array('style'=>'text-align: center;'),
		),
		array(
			'class'=>'CButtonColumn',
			'template' => '{view}{update}'
		),
	),
)); ?>

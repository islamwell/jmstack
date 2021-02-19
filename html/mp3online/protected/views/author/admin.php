<?php
/* @var $this AuthorController */
/* @var $model Author */

$this->breadcrumbs=array(
	'Composers'=>array('admin'),
	'Manage',
);

$this->menu=array(
	//array('label'=>'List Composers', 'url'=>array('index')),
	array('label'=>'Create Composers', 'url'=>array('create')),
    array('label'=>'Back', 'url'=>'javascript:history.go(-1)'),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#author-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Composers</h1>


<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'author-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'author_id',
        array(
            'header' => 'Images',
            //'name' => 'author_img',
            'type' => 'raw',
            'value' => function ($data) {
                    if(strlen($data->author_img)>0){
                        return "<img width='50px' src='".Yii::app()->request->baseUrl.'/images/author/'.$data->author_img."'>";
                    }else
                        return 'No image';
                },
            'htmlOptions'=>array('style'=>' text-align: center;'),
        ),
		//'author_name',
        array(
            // 'header'=>'Status',
            'name'=>'author_name',
            'type'=>'raw',
            'value'=>function($data)
                {
                    return isset($data->author_name) ? $data->author_name : '';
                },
                'htmlOptions'=>array('style'=>' text-align: center;'),
        ),

		//'profile',
        array(
            // 'header'=>'Status',
            'name'=>'profile',
            'type'=>'raw',
            'value'=>function($data)
                {
                    return isset($data->profile) ? $data->profile : '';
                },
            'htmlOptions'=>array('style'=>' text-align: center;'),
        ),
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
            'filter'=>Author::itemAlias('status'),
            'htmlOptions'=>array('style'=>' text-align: center;'),
        ),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

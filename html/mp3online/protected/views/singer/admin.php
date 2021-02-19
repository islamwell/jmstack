<?php
/* @var $this SingerController */
/* @var $model Singer */

$this->breadcrumbs=array(
	'Singers'=>array('admin'),
	'Manage',
);

$this->menu=array(
	//array('label'=>'List Singer', 'url'=>array('index')),
	array('label'=>'Create Singer', 'url'=>array('create')),
    array('label'=>'Back', 'url'=>'javascript:history.go(-1)'),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#singer-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Singers</h1>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'singer-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'singer_id',
		//'singer_name',
        array(
            'header' => 'Images',
            //'name' => 'singer_img',
            'type' => 'raw',
            'value' => function ($data) {
                    if(strlen($data->singer_img)>0){
                        return "<img width='50px' src='".Yii::app()->request->baseUrl.'/images/singer/'.$data->singer_img."'>";
                    }else
                        return 'No image';
                },
            'htmlOptions'=>array('style'=>'width: 60px;  text-align: center;'),
        ),
        array(
            // 'header'=>'Status',
            'name'=>'singer_name',
            'type'=>'raw',
            'value'=>function($data)
                {
					$name=$data->singer_name ? $data->singer_name : '';
                    $id= $data->singer_id;
					
					$link = '<a href="'.Yii::app()->request->baseUrl.'/index.php/singer/update/'.$id.'">'.$name.'</a>';
                    return $link;
                },

            'htmlOptions'=>array('style'=>' text-align: left;'),
        ),

		//'profile',
        /*array(
            // 'header'=>'Status',
            'name'=>'profile',
            'type'=>'raw',
            'value'=>function($data)
                {
                    return isset($data->profile) ? $data->profile : '';
                },

            'htmlOptions'=>array('style'=>' text-align: center;'),
        ),*/
        
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
            'filter'=>Singer::itemAlias('status'),
            'htmlOptions'=>array('style'=>'width: 20px; text-align: center;'),
        ),
		array(
			'class'=>'CButtonColumn',
		),

	),
)); ?>

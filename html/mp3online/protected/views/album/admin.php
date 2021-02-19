<?php
/* @var $this AlbumController */
/* @var $model Album */

$this->breadcrumbs=array(
    'Series'=>array('index'),
    'Manage',
);

$this->menu=array(
    //array('label'=>'List Album', 'url'=>array('index')),
    array('label'=>'Create Series', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#album-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Series</h1>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
    <?php $this->renderPartial('_search',array(
        'model'=>$model,
    )); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'album-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
       // 'album_id',
        array(
            'header' => 'Images',
            'name' => 'album_img',
            'type' => 'raw',
            'value' => function ($data) {
                    if(strlen($data->album_img)>0){
                        return "<img width='50px' src='".Yii::app()->request->baseUrl.'/images/album/'.$data->album_img."'>";
                    }else
                        return "<img width='50px' src='".Yii::app()->request->baseUrl.'/images/www/no_image.jpg'."'>";
                },
            'htmlOptions'=>array('style'=>'width: 60px; text-align: center;'),
        ),
        array(
            'header'=>'Name',
            'name'=>'album_name',
            'type'=>'raw',
            'value'=>function($data)
                {
                    $name_album = $data->album_name;
					if(strlen($name_album)>0)
					{
						$ID_album= $data->album_id;
						$link = '<a href="'.Yii::app()->request->baseUrl.'/index.php/album/update/'.$ID_album.'">'.$name_album.'</a>';
						return $link;
					}
					else
						return '';                   
                },
            'htmlOptions'=>array('style'=>'text-align: center;'),
        ),
        array(
            // 'header'=>'Number Song',
            'name'=>'number_song',
            'type'=>'raw',
            'value'=>function($data)
                {
                    $id = $data->album_id;
                    $song = Song::model()->findAll('album_id ='.$id);
                    return intval(count($song));
                },

            'htmlOptions'=>array('style'=>' text-align: center;'),
        ),
        array(
            // 'header'=>'Number Song',
            'name'=>'order_number',
            'type'=>'raw',
            'value'=>function($data)
                {
                    return $data->order_number;
                },

            'htmlOptions'=>array('style'=>' text-align: center;'),
        ),
        array(
            'header'=>'Status',
            'name'=>'status',
            'type'=>'raw',
            'value'=>function($data)
                {
                    $sta=$data->status;
                    if($sta == 1)
                        return 'Active';
                    else
                        return 'Inactive';
                },
            'filter'=>Album::itemAlias('status'),
            'htmlOptions'=>array('style'=>'text-align: center;'),
        ),
        array(
            'class'=>'CButtonColumn',
        ),
    ),
)); ?>

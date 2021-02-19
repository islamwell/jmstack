<?php
/* @var $this AlbumController */
/* @var $model Album */

$this->breadcrumbs=array(
	'Series'=>array('admin'),
	$model->album_name,
);

$this->menu=array(
//	array('label'=>'List Album', 'url'=>array('index')),
	array('label'=>'Create Series', 'url'=>array('create')),
	array('label'=>'Update Series', 'url'=>array('update', 'id'=>$model->album_id)),
	array('label'=>'Delete Series', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->album_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Series', 'url'=>array('admin')),
    array('label'=>'Back', 'url'=>'javascript:history.go(-1)'),
);
?>

<h1>View Series:<?php echo $model->album_name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'album_id',
		'album_name',
		 array(
            'header' => 'Images',
            'name' => 'album_img',
            'type' => 'raw',
            'value' => function ($data) {
                    if(strlen($data->album_img)>0){
                        return "<img width='auto' src='".Yii::app()->request->baseUrl.'/images/album/'.$data->album_img."'>";
                    }else
                        return 'No image';
                },
        ),
        array(
            // 'header'=>'Number Song',
            'name'=>'number_song',
            'type'=>'raw',
            'value'=>function($data)
                {
                    $id = $data->album_id;
                    $song = Song::model()->findAll('album_id ='.$id);
                    return count($song);
                },

            'htmlOptions'=>array('style'=>' width: 100px; text-align: center;'),
        ),
        array(
            // 'header'=>'Number Song',
            'name'=>'order_number',
            'type'=>'raw',
            'value'=>function($data)
                {
                    return $data->order_number;
                },

            'htmlOptions'=>array('style'=>' width: 100px; text-align: center;'),
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
          //  'filter'=>Album::itemAlias('status'),
           'htmlOptions'=>array('style'=>'width: 100px; text-align: center;'),
        ),
	),
)); ?>

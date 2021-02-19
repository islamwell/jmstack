<?php
/* @var $this SingerController */
/* @var $model Singer */

$this->breadcrumbs=array(
	'Singers'=>array('admin'),
	$model->singer_name,
);

$this->menu=array(
	//array('label'=>'List Singer', 'url'=>array('index')),
	array('label'=>'Create Singer', 'url'=>array('create')),
	array('label'=>'Update Singer', 'url'=>array('update', 'id'=>$model->singer_id)),
	array('label'=>'Delete Singer', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->singer_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Singer', 'url'=>array('admin')),
    array('label'=>'Back', 'url'=>'javascript:history.go(-1)'),
);
?>

<h1>View Singer: <?php echo $model->singer_name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'singer_id',
		'singer_name',
        array(
            //'header' => 'Images',
            'name' => 'singer_img',
            'type' => 'raw',
            'value' => function ($data) {
                    if(strlen($data->singer_img)>0){
                        return "<img width='350px' src='".Yii::app()->request->baseUrl.'/images/singer/'.$data->singer_img."'>";
                    }else
                        return 'No image';
                },
            'htmlOptions'=>array('style'=>' text-align: center;'),
        ),
		'order_number',
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
                }
        ),
	),
)); ?>

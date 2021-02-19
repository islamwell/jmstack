<?php
/* @var $this AuthorController */
/* @var $model Author */

$this->breadcrumbs=array(
	'Composers'=>array('admin'),
	$model->author_name,
);

$this->menu=array(
	//array('label'=>'List Composers', 'url'=>array('index')),
	array('label'=>'Create Composers', 'url'=>array('create')),
	array('label'=>'Update Composers', 'url'=>array('update', 'id'=>$model->author_id)),
	array('label'=>'Delete Composers', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->author_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Composers', 'url'=>array('admin')),
    array('label'=>'Back', 'url'=>'javascript:history.go(-1)'),
);
?>

<h1>View Composers: <?php echo $model->author_name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'author_id',
		'author_name',
        array(
            'header' => 'Images',
            'name' => 'author_img',
            'type' => 'raw',
            'value' => function ($data) {
                    if(strlen($data->author_img)>0){
                        return "<img width='auto' src='".Yii::app()->request->baseUrl.'/images/author/'.$data->author_img."'>";
                    }else
                        return 'No image';
                },
        ),
		'profile',
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
                }
        ),
	),
));

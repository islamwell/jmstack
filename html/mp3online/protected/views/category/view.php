<?php
/* @var $this CategoryController */
/* @var $model Category */

$this->breadcrumbs=array(
	'Categories'=>array('admin'),
	$model->category_name,
);

$this->menu=array(
	//array('label'=>'List Category', 'url'=>array('index')),
	array('label'=>'Create Category', 'url'=>array('create',/*'parentId'=>$model->parentId*/)),
	array('label'=>'Update Category', 'url'=>array('update', 'id'=>$model->category_id,/*'parentId'=>$model->parentId*/)),
	array('label'=>'Delete Category', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->category_id,/*'parentId'=>$model->parentId*/),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Category', 'url'=>array('admin',/*'parentId'=> Constants::CATE_PARENT*/)),
    array('label'=>'Back', 'url'=>array('admin', /*'parentId'=>$model->parentId*/)),
);
?>

<h1>View Category: <?php echo $model->category_name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'category_id',
		'category_name',
        array(
            'header' => 'Images',
            'name' => 'category_img',
            'type' => 'raw',
            'value' => function ($data) {
                    if(strlen($data->category_img)>0){
                        return "<img width='auto' src='".Yii::app()->request->baseUrl.'/images/category/'.$data->category_img."'>";
                    }else
                        return 'No image';
                },
        ),
        array(
            'header'=>'Parent',
            'name'=>'parentId',
            'type'=>'raw',
            'value'=>function($data)
            {
                $id = $data->parentId;
                $name = Category::model()->findByPk($id);
                return isset($name->category_name) ? $name->category_name : '';
            },
        ),
        array(
            //'header'=>'Number Of File',
            'name'=>'number_song',
            'type'=>'raw',
            'value'=>function($data)
                {
                    $id = $data->category_id;
                    $song = Song::model()->findAll('category_id ='.$id);
                    return count($song);
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

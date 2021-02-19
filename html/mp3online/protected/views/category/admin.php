<?php
/* @var $this CategoryController */
/* @var $model Category */

$this->breadcrumbs=array(
	'Category'=>array('admin'),
	'Manage',
);

if(Category::model()->getValueVisible($parentId) + 1 > 5 )
{
    $this->menu=array(
//	array('label'=>'List Category', 'url'=>array('index')),
        //array('label'=>'Create Category', 'url'=>array('create',/*'parentId'=>$parentId*/)),
        array('label'=>'Back', 'url'=>array('admin',/*'parentId'=>Category::model()->getIdParent($parentId)*/)),
    );
}
else
{
    $this->menu=array(
//	array('label'=>'List Category', 'url'=>array('index')),
        array('label'=>'Create Category', 'url'=>array('create',/*'parentId'=>$parentId*/)),
        array('label'=>'Back', 'url'=>array('admin',/*'parentId'=>Category::model()->getIdParent($parentId)*/)),
    );
}

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#category-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");


?>

<h1>Manage Categories</h1>


<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'category-grid',
	'dataProvider'=>$model->search($parentId),
	'filter'=>$model,
	'columns'=>array(
		//'category_id',
        array(
            'header' => 'Images',
            // 'name' => 'category_img',
            'type' => 'raw',
            'value' => function ($data) {
                    if(strlen($data->category_img)>0){
                        return "<img width='50px' src='".Yii::app()->request->baseUrl.'/images/category/'.$data->category_img."'>";
                    }else
                        return 'No image';
                },
            'htmlOptions'=>array('style'=>'width: 60px; text-align: center;'),
        ),
		//'category_name',
        array(
            //'header' => 'Name',
            'name' => 'category_name',
            'type' => 'raw',
            'value' => function ($data) {
					$name=$data->category_name ? $data->category_name : '';
                    $id= $data->category_id;

					$link = '<a href="'.Yii::app()->request->baseUrl.'/index.php/category/update/'.$id.'?parentId='.$data->parentId.'">'.$name.'</a>';
                    return $link;
                },
            'htmlOptions'=>array('style'=>' text-align: center;'),
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
			'filter' => CHtml::listData(Category::model()->findAll(), 'category_id', 'category_name'),
            'htmlOptions'=>array('style'=>'text-align: center;'),
        ),

        array(
            'header'=>'Number Of Files',
            //'name'=>'number_song',
            'type'=>'raw',
            'value'=>function($data)
                {
                    $id = $data->category_id;
                    $song = Song::model()->findAll('category_id ='.$id);
                    return count($song);
                },

            'htmlOptions'=>array('style'=>'text-align: center;'),
        ),

        array(
            'header'=>'Order Number',
             'name'=>'order_number',
            'type'=>'raw',
            'value'=>function($data)
                {
                    return $data->order_number;
                },

            'htmlOptions'=>array('style'=>'text-align: center;'),
        ),
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
            'template' => '{view}{update}{delete}',
            'buttons' => array(
                'view' => array(
                    'label'=>'View',
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/www/view.png',
                    'url'=>'Yii::app()->createUrl("category/view", array("id"=>$data->category_id))',
                ),
                'update' => array(
                    'label'=>'Update',
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/www/update.png',
                    'url'=>'Yii::app()->createUrl("category/update", array("id"=>$data->category_id))',
                ),
                'delete' => array(
                    'label'=>'Delete',
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/www/delete.png',
                    'url'=>'Yii::app()->createUrl("category/delete", array("id"=>$data->category_id))',
                )
            )
        ),
        /*array(
            //'header' => 'Name',
            'name' => 'sub_count',
            'type' => 'raw',
            'value' => function ($data) {
                $countSub = Category::model()->count('parentId ='.$data->category_id);
                $link = '<a href="'.Yii::app()->request->baseUrl.'/index.php/category/admin?parentId='.$data->category_id.'">'.'Sub Category ( '.$countSub.' )'.'</a>';
                return $link;
            },
			'visible' => Category::model()->getValueVisible($parentId) + 1 == 5 ? '0' : '1',
            'htmlOptions'=>array('style'=>' text-align: center;'),
        ),
		array(
			'class'=>'CButtonColumn',
            'template' => '{view}{update}{delete}',
            'buttons' => array(
                'view' => array(
                    'label'=>'View',
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/www/view.png',
                    'url'=>'Yii::app()->createUrl("category/view", array("id"=>$data->category_id,"parentId"=>$data->parentId))',
                ),
                'update' => array(
                    'label'=>'Update',
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/www/update.png',
                    'url'=>'Yii::app()->createUrl("category/update", array("id"=>$data->category_id,"parentId"=>$data->parentId))',
                ),
                'delete' => array(
                    'label'=>'Delete',
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/www/delete.png',
                    'url'=>'Yii::app()->createUrl("category/delete", array("id"=>$data->category_id,"parentId"=>$data->parentId))',
                )
            )
		),*/
	),
)); 
?>


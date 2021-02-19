<?php
/* @var $this SongController */
/* @var $model Song */

$this->breadcrumbs=array(
    'Lectures '=>array('admin'),
    'Manage',
);

$this->menu=array(
   // array('label'=>'List Song', 'url'=>array('index')),
    array('label'=>'Create Lecture', 'url'=>array('create')),
    //array('label'=>'Back', 'url'=>'javascript:history.go(-1)'),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#song-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Lectures</h1>


<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
    <?php $this->renderPartial('_search',array(
        'model'=>$model,
    )); ?>
</div><!-- search-form -->


<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'song-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        //'song_id',
        array(
            'header' => 'Images',
            'name' => 'image',
            'type' => 'raw',
            'value' => function ($data) {
                    if(strlen($data->image)>0){
                        return "<img width='50px' src='".Yii::app()->request->baseUrl.'/images/song/'.$data->image."'>";
                    }else
                        echo CHtml::image(Yii::app()->request->baseUrl.'/images/www/no_image.jpg',"image",array("width"=>50));
                },
            'htmlOptions'=>array('style'=>'width: 60px; text-align: center;'),

        ),
        //'song_name',
        array(
            'name'=>'song_name',
            'type'=>'raw',
            'value'=>function($data)
                {
					$name=$data->song_name ? $data->song_name : '';
                    $id= $data->song_id;
					
					$link = '<a href="'.Yii::app()->request->baseUrl.'/index.php/song/update/'.$id.'">'.$name.'</a>';
                    return $link;					
                    
                },
            'htmlOptions'=>array('style'=>' text-align: center;'),
        ),
        //'lyrics',
        /*array(
            'name'=>'link',
            'type'=>'raw',
            'value'=>function($data)
                {
                    $link= $data->link;
                    $ha= substr_count($data->link,'http');
                    //echo $ha;
                    if($ha  >0 )
                    {
                        //echo 'ha';
                        $url = '<a href="'.$link.'" onclick="listen('.$data->song_id.');" >'.$link.'</a>';
                        return $url;
                    }
                    else
                        // echo 'fail';
                        $url = '<a href="'.Yii::app()->request->baseUrl.'/upload/'.$link.'" onclick="listen('.$data->song_id.');">'.$link.'</a>';
                    return $url;

                },
            'htmlOptions'=>array('style'=>' text-align: center;'),
        ),*/
//		'singer_id',
        /*array(
            'header'=>'Singer',
            'name'=>'singer_id',
            'type'=>'raw',
            'value'=>function($data)
                {
                    if(strlen($data->singer_id)>0)
                    {
                        $id = $data->singer_id;
                        $singer= Singer::model()->findByPk($id);
                        if(count($singer)>0)
                            return $singer->singer_name;
                        else
                            return '';
                    }
                    else
                        return '';
                },
            'filter'=>CHtml::listData(Singer::model()->findAll(), 'singer_id', 'singer_name'),
            'htmlOptions'=>array('style'=>'width: 150px; text-align: center;'),
        ),*/
		array(
            'header'=>'Description',
            'name'=>'description',
            'type'=>'raw',
            'value'=>function($data)
                {
                    if(strlen($data->description)>0)
                    {
                        return implode(' ',array_slice(explode(' ',$data->description),0,10));
                    }
                    else
                        return '';
                },
            'htmlOptions'=>array('style'=>'text-align: center;'),
        ),
//        'album_id',
        array(
            'header'=>'Series',
            'name'=>'album_id',
            'type'=>'raw',
            'value'=>function($data)
                {
                    if(strlen($data->album_id)>0)
                    {
                        $id=$data->album_id;
                        $album= Album::model()->findByPk($id);
                        if(count($album)>0)
                            return $album->album_name;
                        else
                            return '';
                    }
                    else
                        return '';
                },
            'filter'=>CHtml::listData(Album::model()->findAll(), 'album_id', 'album_name'),
            'htmlOptions'=>array('style'=>'text-align: center;'),
        ),

        array(
            'header'=>'Category',
            'name'=>'category_id',
            'type'=>'raw',
            'value'=>function($data)
                {
                    if(strlen($data->category_id)>0)
                    {
                        $id=$data->category_id;
                        $category= Category::model()->findByPk($id);
                        if(count($category)>0)
                        {
                            $name=$category->category_name;
                            return $name;
                        }

                        else
                            return '';
                    }
                    else
                        return '';
                },
            'filter'=>CHtml::listData(Category::model()->findAll(), 'category_id', 'category_name'),
            'htmlOptions'=>array('style'=>'text-align: center;'),
        ),
        array(
            'header'=>'Most Favorties',
            'name'=>'isTopsong',
            'type'=>'raw',
            'value'=>function($data)
                {
                    $id=$data->isTopsong;
                    if($id == 1)
                        return 'Yes';
                    else
                        return 'No';
                },
            'filter'=>Song::isTopSong('isTopsong'),
            'htmlOptions'=>array('style'=>'text-align: center;'),
        ),

		array(
            'header'=>'Listen',
            'name'=>'listen',
            'type'=>'raw',
            'value'=>function($data)
                {
                    return $data->listen;

                },
            'headerHtmlOptions' => array(
                'width' => '5%',
            ),
            'htmlOptions'=>array('style'=>'text-align: center;'),
            //'filter'=>Song::itemAlias('status')
        ),
        array(
            'header'=>'Order Number',
            'name'=>'order_number',
            'type'=>'raw',
            'value'=>function($data)
                {
                    return $data->order_number;

                },
            'headerHtmlOptions' => array(
                'width' => '5%',
            ),
            'htmlOptions'=>array('style'=>'text-align: center;'),
            //'filter'=>Song::itemAlias('status')
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
            'filter'=>Song::itemAlias('status'),
            'htmlOptions'=>array('style'=>'text-align: center;'),
        ),
        /*array(
            'header'=>'Download',
            'name'=>'download',
            'type'=>'raw',
            'value'=>function($data)
                {
                    return $data->download;
                },
            'headerHtmlOptions' => array(
                'width' => '5%',
            ),
            'htmlOptions'=>array('style'=>' text-align: center;'),
            //'filter'=>Song::itemAlias('status')
        ),*/
		/*
        array(
            'value' => function ($data) {
                    echo '<a onclick="check('.$data->song_id.')">
                                <img align="middle" title="Download" src="'.Yii::app()->request->baseUrl.'/images/www/download.jpg">
                                </a>';
                },
            'headerHtmlOptions' => array(
                //'class' => 'span1'
                'width' => '5%',
            ),
            'htmlOptions'=>array('style'=>' text-align: center;'),
        ),*/
        array(
			'class'=>'CButtonColumn',
		),
    ),
)); ?>

<script>
    function listen(id) {
        // alert(id);
        $.ajax({
            url: '<?php echo Yii::app()->createUrl('song/listen')?>',
            type: 'POST',
            data: {id:id},
            success: function (data) {
                // $('#showdata').html(data);
                // alert(data)
            }
        });
    }

    /*function check(id) {
        //alert(id);
        $.ajax({
            url: '<?php echo Yii::app()->createUrl('song/checkLink')?>?id='+id,
            type: 'POST',
            data: { id : id },
            success: function (data) {
                //alert(data);
                if(data == 0 )
                {
                    window.location.replace("<?php echo Yii::app()->createUrl('song/downloadMusic') ?>?id="+ id);
                }
                else{
                    alert('Can not download!');
                    return false;
                }

            }
        });
    }*/

</script>

<?php
/* @var $this SongController */
/* @var $model Song */

$this->breadcrumbs=array(
	'Most Favorites'=>array('topSongs'),
	'Manage',
);

$this->menu=array(
	//array('label'=>'List Top Song', 'url'=>array('topSongsIndex')),
	//array('label'=>'Create Song', 'url'=>array('create')),
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
$dataProvider = $model->topSong();
?>

<h1>Manage Most Favorites</h1>


<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'song-grid',
	'dataProvider'=>$dataProvider,
	'filter'=>$model,
	'columns'=>array(
		//'song_id',
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

                    if(substr_count($data->link,'http') > 0)
                    {
                        //echo 'ha';
                        $url = '<a href="'.$link.'" onclick="listen('.$data->song_id.');" >'.$link.'</a>';
                        return $url;
                    }
                    else
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
                    $id = $data->singer_id;
                    $singer= Singer::model()->findByPk($id);
                    if(count($singer)>0)
                        return $singer->singer_name;
                    else
                        return '';
                },
            'filter'=>CHtml::listData(Singer::model()->findAll(), 'singer_id', 'singer_name'),
            'htmlOptions'=>array('style'=>'width: 150px;text-align: center;'),
        ),*/
//        'album_id',
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
        array(
            'header'=>'Series',
            'name'=>'album_id',
            'type'=>'raw',
            'value'=>function($data)
                {
                    $id=$data->album_id;
                    $album= Album::model()->findByPk($id);
                    if(isset($album))
                        return $album->album_name;
                    else
                        return '';
                },
            'filter'=>CHtml::listData(Album::model()->findAll(), 'album_id', 'album_name'),
            'htmlOptions'=>array('style'=>' text-align: center;'),
        ),

        array(
            'header'=>'Category',
            'name'=>'category_id',
            'type'=>'raw',
            'value'=>function($data)
            {
                if(strlen($data->category_id)>0){
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

            },
            'filter'=>CHtml::listData(Category::model()->findAll(), 'category_id', 'category_name'),
            'htmlOptions'=>array('style'=>' text-align: center;'),
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
                //'width' => '5%',
            ),
            'htmlOptions'=>array('style'=>' text-align: center;'),
            //'filter'=>Song::itemAlias('status')
        ),
		
        array(
            'header'=>'Download',
            'name'=>'download',
            'type'=>'raw',
            'value'=>function($data)
                {
                    return $data->download;
                },
            'headerHtmlOptions' => array(
                //'width' => '5%',
            ),
            'htmlOptions'=>array('style'=>' text-align: center;'),
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
            'htmlOptions'=>array('style'=>' text-align: center;'),
        ),
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
            /*'template'=>'{view}{download}{update}{delete}',
            'headerHtmlOptions' => array(
                'width' => '10%',
            ),
            'buttons'=>array
            (
                'download' => array
                (
                    'label'=>'Download',
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/www/download.jpg',
                    'url'=>'Yii::app()->createUrl("song/DownloadMusic", array("id"=>$data->song_id))',
                ),
            )*/
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

    function check(id) {
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
    }
</script>

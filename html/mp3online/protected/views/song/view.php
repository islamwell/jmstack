<?php
/* @var $this SongController */
/* @var $model Song */

$this->breadcrumbs=array(
	'Lectures'=>array('admin'),
	$model->song_name,
);



$this->menu=array(
	//array('label'=>'List Song', 'url'=>array('index')),
	array('label'=>'Create Lecture', 'url'=>array('create')),
	array('label'=>'Update Lecture', 'url'=>array('update', 'id'=>$model->song_id)),
	array('label'=>'Delete Lecture', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->song_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Lectures', 'url'=>array('admin')),
    array('label'=>'Back', 'url'=>'javascript:history.go(-1)'),
);
?>

<h1>View Lecture: <?php echo $model->song_name; ?></h1>


<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'song_id',
		'song_name',
		'description',
		//'lyrics',
		//'link',
		array(
            'header'=>'Link Song',
            'name'=>'link',
            'type'=>'raw',
            'value'=>function($data)
                {
                    $link=$data->link;
                    if(strlen($link)>0)
                    {
                        if(substr_count($link,'http')>0)
							return '<a href="' . $link . '" >' . $link . '</a>';
						else
							return '<a href="' . Yii::app()->request->baseUrl . '/upload/' . $link . '" >' . $link . '</a>';
                    }
                    else
                        return '';
                }
        ),
        /*[
            'header'=>'Singer Name',
            'name'=>'singer_id',
            'type'=>'raw',
            'value'=>function($data)
                {
                    $id = $data->singer_id;
                    if(strlen($id)>0)
                    {
                        $singer= Singer::model()->findByPk($id);
                        if(count($singer)>0)
                            return $singer->singer_name;
                        else
                            return 'Updating';
                    }
                    else
                        return 'Updating';

                }
        ],*/
//        'album_id',
        array(
            'header'=>'Series',
            'name'=>'album_id',
            'type'=>'raw',
            'value'=>function($data)
                {
                    $id=$data->album_id;
                    if(strlen($id)>0)
                    {
                        $album= Album::model()->findByPk($id);
                        if(count($album)>0)
                            return $album->album_name;
                        else
                            return 'Updating';
                    }
                    else
                        return 'Updating';
                }
        ),
        /*array(
            'header'=>'Author Name',
            'name'=>'author_id',
            'type'=>'raw',
            'value'=>function($data)
                {
                    if(strlen($data->author_id)>0){
                        $id=$data->author_id;
                        if(strlen($id)>0)
                        {
                            $author= Author::model()->findByPk($id);
                            if(count($author)>0)
                            {
                                $name=$author->author_name;
                                return $name;
                            }
                            else
                                return 'Updating';
                        }
                        else
                            return 'Updating';

                    }
                }
        ),*/
        array(
            'header'=>'Category Name',
            'name'=>'category_id',
            'type'=>'raw',
            'value'=>function($data)
                {
                    if(strlen($data->category_id)>0){
                        $id=$data->category_id;
                        if(strlen($id)>0)
                        {
                            $category= Category::model()->findByPk($id);
                            if(count($category)>0)
                            {
                                $name=$category->category_name;
                                return $name;
                            }
                            else
                                return 'Updating';
                        }
                        else
                            return  'Updating';

                    }
                }
        ),
//		'download',
        array(

                'header' => 'Images',
                'name' => 'image',
                'type' => 'raw',
                'value' => function ($data) {
                        if(strlen($data->image)>0){
                            return "<img width='50px' src='".Yii::app()->request->baseUrl.'/images/song/'.$data->image."'>";
                        }else
                            return 'No image';
                    },

        ),
        'link_app',
        array(
            'header'=>'Most Favorites',
            'name'=>'isTopsong',
            'type'=>'raw',
            'value'=>function($data)
                {
                    $id=$data->isTopsong;
                    if($id == 1)
                        return 'True';
                    else
                        return 'False';
                },
            'filter'=>Song::isTopSong('isTopsong')
        ),
        array(

            'header' => 'Status',
            'name' => 'status',
            'type' => 'raw',
            'value' => function ($data) {
                    if($data->status == 1){
                        return 'Active';
                    }else
                        return 'Inactive';
                },

        ),
	),
)); ?>

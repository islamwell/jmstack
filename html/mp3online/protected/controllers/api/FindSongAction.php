<?php

class FindSongAction extends CAction
{
    public function run()
    {
        $categoryId = isset($_REQUEST['categoryId']) ? $_REQUEST['categoryId'] : '';
        $albumId = isset($_REQUEST['albumId']) ? $_REQUEST['albumId'] : '';

        $song = Song::model()->findAll(array(
            'condition'=>'category_id = :categoryId AND album_id = :albumId',
            'params'=>array(':categoryId'=>$categoryId,':albumId'=>$albumId)
        ));
        // var_dump($song);exit;
        $path= Yii::app()->getBaseUrl(true);
        if(count($song)>0)
        {
            foreach($song as $item)
            {

                if(strlen($item->image)>0)
                {
                    $image= $path.'/images/song/'.$item->image;
                }
                else
                {
                    $image=$path.'/images/www/ic_music_node.png';
                }

                if(substr_count($item->link,'http') > 0 )
                {
                    //echo 123;
                    $link= $item->link;
                }
                else
                {
                    //echo 456;exit;
                    $link= $path.'/upload/'.$item->link;
                }

                $tran = Translattions::model()->find(" model_id =".$item->song_id,"and table_name = 'song' and attribute = 'song_name' ");
                //var_dump($tran);exit;
                if(count($tran)>0)
                {
                    $name_vi = $tran->value;
                }
                else
                    $name_vi = '';

                $trans = Translattions::model()->find(" model_id =".$item->song_id,"and table_name = 'song' and attribute = 'lyrics' ");
                //var_dump($trans);exit;
                if(count($trans)>0)
                {
                    $lyrics_vi = $trans->value;
                }
                else
                    $lyrics_vi = '';

                $data[]=array(
                    'id'=>$item->song_id,
                    'number'=>isset($item->stt) ? $item->stt : '',
                    'name'=>$item->song_name,
                    'name_vi'=>$name_vi,
                    'lyric'=>isset($item->lyrics) ? $item->lyrics : '',
                    'lyrics_vi'=>$lyrics_vi,
                    'link'=>$link,
                    'singerId'=>isset($item->singer_id) ? $item->singer_id : '',
                    'listen'=>isset($item->listen) ? $item->listen : '',
                    'albumId'=>isset($item->album_id) ? $item->album_id : '',
                    'authorId'=>isset($item->author_id) ? $item->author_id : '',
                    'categoryId'=>isset($item->category_id) ? $item->category_id : '',
                    'createDate'=>$item->create_date,
                    'download'=>isset($item->download) ? $item->download : '',
                    'hot'=>isset($item->hot) ? $item->hot : '',
                    'new'=>isset($item->new) ? $item->new : '',
                    'status'=>isset($item->status) ? $item->status : '',
                    'link_app'=>isset($item->link_app) ? $item->link_app : '',
                    'image'=>$image,
					'description'=>isset($item->description) ? $item->description : '',
                );
            }
            if(count($data) != 0)
            {
                ApiController::sendResponse(200, CJSON::encode(array(
                    'status' => 'SUCCESS',
                    'data' => $data,
                    'message' => 'OK',)));
            }
            else
            {
                ApiController::sendResponse(200, CJSON::encode(array(
                    'status' => 'SUCCESS',
                    'data' => array(),
                    'message' => 'OK',)));
            }
        }
        else
        {
            ApiController::sendResponse(200, CJSON::encode(array(
                'status' => 'SUCCESS',
                'data' => array(),
                'message' => 'OK',)));
        }
    }
}
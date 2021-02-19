<?php

class SearchSongAction extends CAction
{
    public function run()
    {
        $singerId = isset($_REQUEST['singerId']) ? $_REQUEST['singerId'] : '';
        $albumId = isset($_REQUEST['albumId']) ? $_REQUEST['albumId'] : '';
        $authorId = isset($_REQUEST['authorId']) ? $_REQUEST['authorId'] : '';

        $song = Yii::app()->db->createCommand()
            ->select('*')
            ->from('song')
           // ->join('tbl_profile p', 'u.id=p.user_id')
            ->where('singer_id= :singerId AND album_id= :albumId', array(':singerId'=>$singerId,':albumId'=>$albumId))
            ->queryRow();
        //$song = Song::model()->findAll('singer_id ='.$singerId AND 'album_id ='.$albumId);
//        var_dump($song);exit;
        if(count($song)>0)
        {
            foreach($song as $item)
            {


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
                    'lyrics_vi'=> $lyrics_vi,
                    'link'=>isset($item->link) ? $item->link : '',
                    'singerId'=>isset($item->singer_id) ? $item->singer_id : '',
                    'listen'=>$item->listen,
                    'albumId'=>isset($item->album_id) ? $item->album_id : '',
                    'authorId'=>isset($item->author_id) ? $item->author_id : '',
                    'categoryId'=>isset($item->category_id) ? $item->category_id : '',
                    'createDate'=>$item->create_date,
                    'download'=>$item->download,
                    'hot'=>isset($item->hot) ? $item->hot : '',
                    'new'=>isset($item->new) ? $item->new : '',
                    'status'=>isset($item->status) ? $item->status : '',
					'description'=>isset($item->description) ? $item->description : '',
                );
            }
        }
        else
        {
            ApiController::sendResponse(200, CJSON::encode(array(
                'status' => 'SUCCESS',
                    //'allpage'=> 0,
                    'data' => array(),
                    'message' => 'OK',)));
        }




        ApiController::sendResponse(200, CJSON::encode(array(
            'status' => 'SUCCESS',
            'data' => $data,
            'message' => 'OK',)));
    }
}
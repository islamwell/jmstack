<?php

class TopSongAction extends CAction
{
    public function run()
    {

        $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : '1';

        $data= array();
        $rows_per_page = Constants::ITEM_PER_PAGE;
        $start_index= ($page-1)*$rows_per_page;
        $songs= Song::model()->findAll('isTopsong =1 and status = 1');
        $numsong= count($songs);
        //var_dump($numsong);exit;
        $allpage=ceil($numsong/$rows_per_page);


        $criteria = new CDbCriteria();
        $criteria->order= 'listen DESC';
        $criteria->condition = "isTopsong = 1";
        $criteria->compare('status',1);
        $criteria->limit= $rows_per_page;
        $criteria->offset= $start_index;
        $song= Song::model()->findAll($criteria);
        if(count($song)>0)
        {
            foreach($song as $item)
            {
                $path= Yii::app()->getBaseUrl(true);
                if(strlen($item->link)>0)
                {
                    if(substr_count($item->link,'http') >0 )
                    {
                        //echo 123;
                        $url_music= $item->link;
                    }
                    else
                    {
                        //echo 456;exit;
                        $url_music= $path.'/upload/'.$item->link;
                    }
                }
                else
                {
                    $url_music = '';
                }

                if(strlen($item->image)>0)
                {
                    $image= $path.'/images/song/'.$item->image;
                }
                else
                {
                    $image=$path.'/images/www/ic_music_node.png';
                }


                if(strlen($item->song_name)>0)
                    $songname =$item->song_name ;
                else
                    $songname = '';
                if(strlen($item->lyrics)>0)
                    $lyrics =$item->lyrics ;
                else
                    $lyrics = '';
                if(strlen($item->album_id)>0)
                    $album =$item->album_id ;
                else
                    $album = '';
                if(strlen($item->author_id)>0)
                    $author =$item->author_id ;
                else
                    $author = '';
                if(strlen($item->category_id)>0)
                    $cate =$item->category_id ;
                else
                    $cate = '';
                if(strlen($item->link_app)>0)
                    $linkapp =$item->link_app ;
                else
                    $linkapp = '';


                $sing= Singer::model()->findByPk($item->singer_id);
                if(count($sing)>0)
                    $name=$sing->singer_name;
                else
                    $name = "";

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
                    'name'=>$songname,
                    'name_vi'=>$name_vi,
                    'lyrics'=>$lyrics,
                    'lyrics_vi'=>$lyrics_vi,
                    'link'=>$url_music,
                    'singerName'=>$name,
                    'listen'=>$item->listen,
                    'download'=>$item->download,
                    'album_id'=>$album,
                    'author_id'=>$author,
                    'category_id'=>$cate,
                    'link_app'=>$linkapp,
                    'isTopSong'=>$item->isTopsong,
                    'image'=>$image,
					'description'=>isset($item->description) ? $item->description : '',
                );
            }

            ApiController::sendResponse(200, CJSON::encode(array(
                'status' => 'SUCCESS',
                'allpage'=>$allpage,
                'data' => $data,
                'message' => 'OK',)));

        }
        else
            ApiController::sendResponse(200, CJSON::encode(array(
                'status' => 'SUCCESS',
                'allpage'=> 0,
                'data' => array(),
                'message' => 'OK',)));


    }
}
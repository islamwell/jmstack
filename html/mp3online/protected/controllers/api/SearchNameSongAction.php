<?php

class SearchNameSongAction extends CAction
{
    public function run()
    {
        $song = isset($_REQUEST['song']) ? $_REQUEST['song'] : '';
        $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : '';

        $criteria = new CDbCriteria();
        $criteria->condition = "song_name LIKE '%$song%'";
        $criteria->compare('status',1);
        $allsong= Song::model()->findAll($criteria);
        $rows_per_page = Constants::ITEM_PER_PAGE;
        $numsong= count($allsong);
        $allpage=ceil($numsong/$rows_per_page);
        $start_index= ($page-1)*$rows_per_page;

        $ha = new CDbCriteria();
        $ha->condition="song_name LIKE '%$song%'";
        $ha->order= 'order_number ASC,song_id DESC';
        $ha->compare('status',1);
        $ha->limit= $rows_per_page;
        $ha->offset= $start_index;

        $data= array();
        $songs= Song::model()->findAll($ha);
        //var_dump($song);exit;
        if(count($songs)>0)
        {
            foreach($songs as $item)
            {
                $path= Yii::app()->getBaseUrl(true);
                if(strlen($item->link)>0)
                {
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
                }
                else
                {
                    $link = '';
                }

                if(strlen($item->image)>0)
                {
                    $image= $path.'/images/song/'.$item->image;
                }
                else
                {
                    $image=$path.'/images/www/ic_music_node.png';
                }
               // $cat= Category::model()->findByPk($categoryId);
               // $name=$cat->category_name;
                $sing= Singer::model()->findByPk($item->singer_id);
                if(count($sing)>0)
                    $name1=$sing->singer_name;
                else
                    $name1= '';

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
                    'name'=>isset($item->song_name) ? $item->song_name : '',
                    'name_vi'=>$name_vi,
                    'lyric'=>isset($item->lyrics) ? $item->lyrics : '',
                    'lyrics_vi'=>$lyrics_vi,
                    'link'=>$link,
                    'singerName'=>$name1,
                    'view'=>isset($item->views) ? $item->views : '0',
                    'album_id'=>isset($item->album_id) ? $item->album_id : '',
                    'author_id'=>isset($item->author_id) ? $item->author_id : '',
                    'category_id'=>isset($item->category_id) ? $item->category_id : '',
                    'createDate'=>$item->create_date,
                    'download'=>$item->download,
					'listen'=>$item->listen,
                    'hot'=>isset($item->hot) ? $item->hot : '',
                    'new'=>isset($item->new) ? $item->new : '',
                    'status'=>isset($item->status) ? $item->status : '',
                    'link_app'=>isset($item->link_app) ? $item->link_app : '',
                    'order_number'=>isset($item->order_number) ? $item->order_number : '',
                    'image'=>$image,
					'description'=>isset($item->description) ? $item->description : '',
                );
            }
            if(count($data) != 0)
            {
                ApiController::sendResponse(200, CJSON::encode(array(
                    'status' => 'SUCCESS',
                    'allpage'=>$allpage,
                    'data' => $data,
                    'message' => 'OK',)));
            }
            else
            {
                ApiController::sendResponse(200, CJSON::encode(array(
                'status' => 'SUCCESS',
                    'allpage'=> $allpage,
                    'data' => array(),
                    'message' => 'OK',)));
            }
        }
        else
        {
            ApiController::sendResponse(200, CJSON::encode(array(
                'status' => 'SUCCESS',
                    'allpage'=> 0,
                    'data' => array(),
                    'message' => 'OK',)));
        }
    }
}
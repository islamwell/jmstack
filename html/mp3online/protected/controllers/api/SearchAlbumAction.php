<?php

class SearchAlbumAction extends CAction
{
    public function run()
    {
        $categoryId = isset($_REQUEST['categoryId']) ? $_REQUEST['categoryId'] : '';

        $data = array();
        $album = Album::model()->findAll('category_id ='.$categoryId.' and status = 1');
        if(count($album)>0)
        {
            foreach($album as $item)
            {
                $path= Yii::app()->getBaseUrl(true);
                if(strlen($item->album_img)>0)
                {
                    $img= $path.'/images/album/'.$item->album_img;
                }
                else
                {
                    $img=$path.'/images/www/no_image.jpg';
                }

                $tran = Translattions::model()->find(" model_id =".$item->album_id,"and table_name = 'album' and attribute = 'album_name' ");
                //var_dump($tran);exit;
                if(count($tran)>0)
                {
                    $name_vi = $tran->value;
                }
                else
                    $name_vi = '';



                $data[]=array(
                    'id'=>$item->album_id,
                    'name'=>isset($item->album_name) ? $item->album_name : '',
                    'name_vi'=>$name_vi,
                    'image'=>$img,
                    'categoryId'=>isset($item->category_id) ?  $item->category_id : 'Updating',
                    'numberSong'=>isset($item->number_song) ? $item->number_song : '',
                    'createDate'=>$item->create_date,
                    'status'=>isset($item->status) ? $item->status : ''
                );
            }

            ApiController::sendResponse(200, CJSON::encode(array(
                'status' => 'SUCCESS',
                'data' => $data,
                'message' => 'OK',)));
        }
        else
        {
            ApiController::sendResponse(200, CJSON::encode(array(
                'status' => 'SUCCESS',
                    //'allpage'=> 0,
                    'data' => array(),
                    'message' => 'OK',)));
        }


    }
}
<?php
/**
 * Created by PhpStorm.
 * User: Yoona
 * Date: 25/10/2014
 * Time: 09:47
 */
class ShowAlbumAction extends CAction
{
    public function run()
    {
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
        $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : '';

        $rows_per_page = Constants::ITEM_PER_PAGE;
        if($id == 0 || $id == NULL)
        {
            $albums = Album::model()->findAll('status = 1');
            $allpage = ceil(count($albums)/$rows_per_page);

            $start_index= ($page-1)*$rows_per_page;
            $criteria = new CDbCriteria();
            $criteria->order = "order_number ASC,album_id DESC";
            $criteria->compare('status',1);
            $criteria->limit = $rows_per_page;
            $criteria->offset = $start_index;
            $album = Album::model()->findAll($criteria);
			
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
                        $name_telugu = $tran->value;
                    }
                    else
                        $name_telugu = '';

                    $data[]=array(
                        'id'=>$item->album_id,
                        'name'=>isset($item->album_name) ? $item->album_name : '',
                        'name_vi'=> $name_telugu,
                        'image'=>$img,
                        'categoryId'=>isset($item->category_id) ? $item->category_id : 'Updating',
                        'numberSong'=>isset($item->number_song) ? $item->number_song :'',
                        'order_number'=> isset($item->order_number) ? $item->order_number : '',
                        'createDate'=>$item->create_date,
                        'status'=>isset($item->status) ? $item->status : ''
                    );
                }
                ApiController::sendResponse(200, CJSON::encode(array(
                    'status' => 'SUCCESS',
                    'numpage'=>$allpage,
                    'data' => $data,
                    'message' => 'OK',)));
            }
            else
                ApiController::sendResponse(200, CJSON::encode(array(
                    'status' => 'SUCCESS',
                    'numpage'=>$allpage,
                    'data' => array(),
                    'message' => 'OK',)));
        }
        else
        {
            $album = Album::model()->findByPk($id);
            if(count($album)>0)
            {
                $path= Yii::app()->getBaseUrl(true);
                if(strlen($album->album_img)>0)
                {
                    $img= $path.'/images/album/'.$album->album_img;
                }
                else
                {
                    $img=$path.'/images/www/no_image.jpg';
                }

                $tran = Translattions::model()->find(" model_id =".$album->album_id,"and table_name = 'album' and attribute = 'album_name' ");
                //var_dump($tran);exit;
                if(count($tran)>0)
                {
                    $name_telugu = $tran->value;
                }
                else
                    $name_telugu = '';

                $data[]=array(
                    'id'=>$album->album_id,
                    'name'=>isset($album->album_name) ? $album->album_name : '',
                    'name_telugu'=> $name_telugu,
                    'image'=>$img,
                    'categoryId'=>isset($album->category_id) ? $album->category_id : 'Updating',
                    'numberSong'=>isset($album->number_song) ? $album->number_song :'',
                    'order_number'=> isset($album->order_number) ? $album->order_number : '',
                    'createDate'=>$album->create_date,
                    'status'=>isset($album->status) ? $album->status : ''
                );

                ApiController::sendResponse(200, CJSON::encode(array(
                    'status' => 'SUCCESS',
                    'data' => $data,
                    'message' => 'OK',)));
            }
            else
                ApiController::sendResponse(200, CJSON::encode(array(
                'status' => 'SUCCESS',
                    //'allpage'=> 0,
                    'data' => array(),
                    'message' => 'OK',)));

        }

    }
}
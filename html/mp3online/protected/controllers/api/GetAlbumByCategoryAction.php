<?php

class GetAlbumByCategoryAction extends CAction
{
    public function run()
    {
        $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : '1';
        $categoryId = isset($_REQUEST['categoryId']) ? $_REQUEST['categoryId'] : '';

        $album = Album::model()->findAll(array(
            'condition'=>'category_id = :categoryId and status =1',
            'params'=>array(':categoryId'=>$categoryId,)
        ));
        //var_dump($album);exit;
        $rows_per_page = 10;
        $numsong= count($album);
        $allpage=ceil($numsong/$rows_per_page);
        $start_index= ($page-1)*$rows_per_page;
        $criteria = new CDbCriteria();
        $criteria->condition='category_id ='.$categoryId;
        $criteria->order= 'order_number DESC, album_id DESC';
        $criteria->compare('status',1);
        $criteria->limit= $rows_per_page;
        $criteria->offset= $start_index;
        $data= array();
        $albums= Album::model()->findAll($criteria);
        // var_dump($song);exit;
        if(count($albums)>0)
        {
            foreach($albums as $item)
            {
                $path= Yii::app()->getBaseUrl(true);

                if(strlen($item->album_img)>0)
                {
                    $image= $path.'/images/album/'.$item->album_img;
                }
                else
                {
                    $image=$path.'/images/www/no_image.jpg';
                }

                $id = $item->album_id;
                $tran = Translattions::model()->find(" model_id =".$id,"and table_name = 'album' and attribute = 'album_name' ");
                //var_dump($tran);exit;
                if(count($tran)>0)
                {
                    $name_vi = $tran->value;
                }
                else
                    $name_vi = '';

                $data[]=array(
                    'id'=>$item->album_id,
                    'name'=>isset($item->album_name) ? ($item->album_name) : '',
                    'name_telugu'=>$name_vi,
                    'categoryId'=>isset($item->category_id) ? ($item->category_id) : 'Updating',
                    'numberSong'=>isset($item->number_song) ? ($item->number_song) : '',
                    'createDate'=>isset($item->create_date) ? ($item->create_date) : '',
                    'order_number'=> isset($item->order_number) ? ($item->order_number) : '',
                    'status'=>isset($item->status) ? ($item->status) : '',
                    'image'=>$image,
                );
            }

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
                'allpage'=>0,
                'data' => array(),
                'message' => 'OK',)));
        }
    }
}
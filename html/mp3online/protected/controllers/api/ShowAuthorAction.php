<?php
/**
 * Created by PhpStorm.
 * User: Yoona
 * Date: 25/10/2014
 * Time: 10:00
 */
class ShowAuthorAction extends CAction
{
    public function run()
    {
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';

        $data = array();
        if($id == 0 || $id == NULL)
        {
            $author= Author::model()->findAll('status = 1');
        }
        else
        {
            $author = Author::model()->findAll('author_id ='.$id.'and status = 1');
        }
        if(count($author)>0)
        {
            foreach($author as $item)
            {
                $path= Yii::app()->getBaseUrl(true);
                if(strlen($item->author_img)>0)
                {
                    $img= $path.'/images/author/'.$item->author_img;
                }
                else
                {
                    $img=$path.'/images/www/no_image.jpg';
                }

                $tran = Translattions::model()->find(" model_id =".$item->author_id,"and table_name = 'author' and attribute = 'author_name' ");
                //var_dump($tran);exit;
                if(count($tran)>0)
                {
                    $name_vi = $tran->value;
                }
                else
                    $name_vi = '';

                $trans = Translattions::model()->find(" model_id =".$item->author_id,"and table_name = 'author' and attribute = 'profile' ");
                //var_dump($tran);exit;
                if(count($trans)>0)
                {
                    $profile_vi = $trans->value;
                }
                else
                    $profile_vi = '';

                $data[]=array(
                    'id'=>$item->author_id,
                    'name'=>isset($item->author_name) ? $item->author_name : '',
                    'name_vi'=> $name_vi,
                    'image'=>$img,
                    'profile'=>isset($item->profile) ? $item->profile : '',
                    'profile_telugu'=>$profile_vi,
                    'status'=>$item->status
                );
            }
            ApiController::sendResponse(200, CJSON::encode(array(
                'status' => 'SUCCESS',
                'data' => $data,
                'message' => 'OK',)));
        }
        else
            ApiController::sendResponse(200, CJSON::encode(array(
                'status' => 'SUCCESS',
                'data' => array(),
                'message' => 'OK',)));

    }
}
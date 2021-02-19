<?php

class ShowSingerAction extends CAction
{
    public function run()
    {
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';

        if($id == 0 && $id == NULL)
        {
            $criteria = new CDbCriteria();
            $criteria->compare('status',1);
            $criteria->order = "order_number DESC, singer_id DESC";
            $singer= Singer::model()->findAll($criteria);
        }
        else
        {
            $criteria = new CDbCriteria();
            $criteria->compare('status',1);
            $criteria->compare('singer_id',$id);
            $criteria->order = "order_number ASC, singer_id DESC";
            $singer = Singer::model()->findAll($criteria);
        }
        if(count($singer)>0)
        {
            foreach($singer as $item)
            {
                $path= Yii::app()->getBaseUrl(true);
                if(strlen($item->singer_img)>0)
                {
                    $img= $path.'/images/singer/'.$item->singer_img;
                }
                else
                {
                    $img=$path.'/images/www/no_image.jpg';
                }

                $tran = Translattions::model()->find(" model_id =".$item->singer_id,"and table_name = 'singer' and attribute = 'singer_name' ");
                //var_dump($tran);exit;
                if(count($tran)>0)
                {
                    $name_vi = $tran->value;
                }
                else
                    $name_vi = '';

                $trans = Translattions::model()->find(" model_id =".$item->singer_id,"and table_name = 'singer' and attribute = 'profile' ");
                //var_dump($trans);exit;
                if(count($trans)>0)
                {
                    $profile_vi = $trans->value;
                }
                else
                    $profile_vi = '';

                $data[]=array(
                    'id'=>$item->singer_id,
                    'name'=>isset($item->singer_name) ? $item->singer_name : '',
                    'name_vi'=>$name_vi,
                    'image'=>$img,
                    'profile'=>isset($item->profile) ?  $item->profile : '',
                    'profile_vi'=>$profile_vi,
                    'order_number'=> isset($item->order_number) ? $item->order_number : '',
                    'status'=>isset($item->status) ? $item->status : ''
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
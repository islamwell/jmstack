<?php

class GetSubsAction extends CAction
{
    public function run()
    {
        $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : '1';
        $categoryId = isset($_REQUEST['categoryId']) ? $_REQUEST['categoryId'] : '';

        $data = array();
        $items_per_page = Constants::ITEM_PER_PAGE;
        $start_index = ( $page - 1 ) * $items_per_page;

        if(strlen($categoryId) == 0 || $categoryId == 0)
        {
            ApiController::sendResponse(200, CJSON::encode(array(
                'status' => Constants::ERROR,
                'message' => 'Please check param again: categoryId',)));
        }

        $criteria = new CDbCriteria();
        $criteria->compare('status',Constants::STATUS_ACTIVE);
        $criteria->compare('parentId',$categoryId);

        $category = Category::model()->findAll($criteria);
        $allPage = ceil(count($category)/$items_per_page);

        $criteria->order = "order_number ASC,category_id DESC";
        $criteria->limit = $items_per_page;
        $criteria->offset = $start_index;
        $cate = Category::model()->findAll($criteria);

        /*if(count($cate)>0)
        {*/
            foreach($cate as $item)
            {
                $path = Yii::app()->getbaseUrl(true);
                if(strlen($item->category_img)>0)
                {
                    $image= $path.'/images/category/'.$item->category_img;
                }
                else
                {
                    $image=$path.'/images/www/no_image.jpg';
                }

                $id = $item->category_id;
                $tran = Translattions::model()->find(" model_id =".$id,"and table_name = 'category' and attribute = 'category_name' ");
                if(count($tran)>0)
                {
                    $name_vi1= $tran->value;
                }
                else
                    $name_vi1 = '';

                $countSub =  Category::model()->count('parentId ='.$item->category_id);

                $data[] = array(
                    'id'=> $item->category_id,
                    'name'=> isset($item->category_name) ? ($item->category_name) : '',
                    'name_telugu'=>$name_vi1,
                    'image'=> $image,
                    'status'=>isset($item->status) ? ($item->status) : '',
                    'parentId'=>isset($item->parentId) ? ($item->parentId) : '',
                    'level' => $item->level.'',
                    'countSub' => $countSub
                );
            }

            ApiController::sendResponse(200, CJSON::encode(array(
                'status' => Constants::SUCCESS,
                'allpage' => $allPage,
                'data' =>$data,
                'message' => 'OK',)));

        /*}
        else
        {
            ApiController::sendResponse(200, CJSON::encode(array(
                'status' => Constants::SUCCESS,
                'data' =>array(),
                'message' => 'OK',)));
        }*/
    }
}
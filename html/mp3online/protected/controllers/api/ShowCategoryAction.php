<?php

class ShowCategoryAction extends CAction
{
    public function run()
    {
        $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : '1';

        $rows_per_page = Constants::ITEM_PER_PAGE;
        $start_index = ( $page - 1 )*$rows_per_page;
		$data = array();

        $criteria = new CDbCriteria();
        $criteria->compare('status',Constants::STATUS_ACTIVE);
		$criteria->compare('parentId',Constants::CATE_PARENT);
		$categories = Category::model()->findAll($criteria);
        $allpage = ceil(count($categories)/$rows_per_page);

		$criteria->order = "order_number ASC,category_id DESC";
        $criteria->limit = $rows_per_page;
        $criteria->offset = $start_index;
        $category = Category::model()->findAll($criteria);
		//var_dump($category);exit;
		if(count($category)>0)
		{
			foreach($category as $item)
			{
				$path= Yii::app()->getBaseUrl(true);
				if(strlen($item->category_img)>0)
				{
					$img= $path.'/images/category/'.$item->category_img;
				}
				else
				{
					$img=$path.'/images/www/no_image.jpg';
				}

				$tran = Translattions::model()->find(" model_id =".$item->category_id,"and table_name = 'category' and attribute = 'category_name' ");
				//var_dump($tran);exit;
				if(count($tran)>0)
				{
					$name_telugu = $tran->value;
				}
				else
					$name_telugu = '';

				$countSub =  Category::model()->count('parentId ='.$item->category_id);

				$data[]=array(
					'id'=>$item->category_id,
					'name'=>isset($item->category_name) ? $item->category_name : '',
					'name_telugu'=>$name_telugu,
					'image'=>$img,
					'status'=>isset($item->status) ? $item->status : '',
					'parentId'=>isset($item->parentId) ? $item->parentId : 0,
					'level'=>isset($item->level) ? $item->level : '',
					'countSub' => $countSub

				);
			}

			ApiController::sendResponse(200, CJSON::encode(array(
				'status' => Constants::SUCCESS,
                'allpage'=> $allpage,
				'data' => $data,
				'message' => 'OK',)));
		}
		else
			ApiController::sendResponse(200, CJSON::encode(array(
			'status' => Constants::SUCCESS,
				'allpage'=> $allpage,
				'data' => array(),
				'message' => 'OK',)));

    }
}
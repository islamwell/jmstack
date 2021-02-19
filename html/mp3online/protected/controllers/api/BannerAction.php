<?php

class BannerAction extends CAction
{
    public function run()
    {
		$type = isset($_REQUEST['type']) ? $_REQUEST['type'] : '';
		
		$data = array();
		
        $criteria = new CDbCriteria();
        $criteria->compare('status',Constants::STATUS_ACTIVE);
		$criteria->compare('type', $type);
		$banners = Banner::model()->findAll($criteria);
		//var_dump($banners);exit;
		if(count($banners)>0)
		{
			/*$banner = array_rand($banners,1);*/
			foreach($banners as $banner)
			{
				$path= Yii::app()->getBaseUrl(true);
				if(strlen($banner->image)>0)
				{
					$img= $path.'/images/banner/'.$banner->image;
				}
				else
				{
					$img=$path.'/images/www/no_image.jpg';
				}

				$data[] = array(
					'id'=>$banner->id,
					'title'=>$banner->title.'',
					'url' => $banner->url,
					'content' => $banner->content,
					'image'=>$img,
					'status'=>isset($banner->status) ? $banner->status : '',
					'type' => $banner->type
				);
			}
			

			ApiController::sendResponse(200, CJSON::encode(array(
				'status' => Constants::SUCCESS,
				'data' => $data,
				'message' => 'OK',)));
		}
		else
			ApiController::sendResponse(200, CJSON::encode(array(
			'status' => Constants::SUCCESS,
				'data' => array(),
				'message' => 'OK',)));

    }
}
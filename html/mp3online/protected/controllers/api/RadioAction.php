<?php

class RadioAction extends CAction
{
    public function run()
    {
		$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : '1';

		$rows_per_page = Constants::ITEM_PER_PAGE;
		$start_index = ($page - 1) * $rows_per_page;
		
		$data = array();

        $criteria = new CDbCriteria();
        $criteria->compare('status',Constants::STATUS_ACTIVE);
		$radio = Radio::model()->find($criteria);
		//var_dump($banners);exit;		
		if(isset($radio))
		{
			/** @var Radio $radio */
			//foreach($radios as $radio)
			//{
				$data = array(
					'id' =>$radio->id,
					'name' =>$radio->name.'',
					'link' => $radio->link.'',
					//'mixlr' => $radio->mixlr.'',
					//'type' => $radio->type,
					'status' => $radio->status.'',
				);
			//}

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
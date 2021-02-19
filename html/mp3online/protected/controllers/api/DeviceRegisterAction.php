<?php
class DeviceRegisterAction extends CAction
{
    public function run()
    {
        $gcm = isset($_REQUEST['gcm_id']) ? $_REQUEST['gcm_id'] : '';
        $ime = isset($_REQUEST['ime']) ? $_REQUEST['ime'] : ''; //token : IOS
        $type = isset($_REQUEST['type']) ? $_REQUEST['type'] : ''; //1: Android  2:IOS
        $status = isset($_REQUEST['status']) ? $_REQUEST['status'] : '';
        //$userId = isset($_REQUEST['userId']) ? $_REQUEST['userId'] : '';

        if (strlen($gcm) == 0 || strlen($ime) == 0) {
            ApiController::sendResponse(200, CJSON::encode(array(
                'status' => 'ERROR',
                'data' => '',
                'message' => 'GCM fields or IME field are missing',
            )));
            exit;
        }

        $old_device = Device::model()->find(' ime = "'.$ime.'" ');
        if (count($old_device) > 0) {
            $old_device->gcm_id = $gcm;
            $old_device->type = $type;
            $old_device->status = $status;
            //$old_device->user_id= isset($userId) ? $userId : 0;
            $old_device->save();
            ApiController::sendResponse(200, CJSON::encode(array(
                'status' => Constants::SUCCESS,
                'message' => 'OK',
            )));
        } else {
            $device = new Device();
            $device->gcm_id = $gcm;
            $device->ime = $ime;
            $device->type = $type;
            $device->status = $status;
            $device->dateCreated = date('Y-m-d H:i:s',time());
            //$device->user_id = isset($userId) ? $userId : '';

            if ($device->save()) {
                ApiController::sendResponse(200, CJSON::encode(array(
                    'status' => Constants::SUCCESS,
                    'message' => 'OK',
                )));
            } else {
                ApiController::sendResponse(200, CJSON::encode(array(
                    'status' => Constants::ERROR,
                    'data' => '',
                    'message' => 'Can not save data',
                )));
            }
        }

    }
}
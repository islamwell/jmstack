<?php

class PushNotificationAction extends CAction
{

    public function run()
    {
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
        Constants::pushNotification($id);
    }

}
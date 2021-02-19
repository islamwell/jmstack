<?php
/**
 * Created by PhpStorm.
 * User: NguyenVan
 * Date: 26/04/2016
 * Time: 9:10 SA
 */
class Constants{
    const
        LAYOUT_MAIN = "//layouts/main",
        LAYOUT_LOGIN = "//layouts/login",
        LAYOUT_ERROR = "//layouts/error",

        SUCCESS = 'SUCCESS',
        ERROR = 'ERROR';
    const
        TYPE_IMAGE = 'images',
        TYPE_ALBUM = 'album',
        TYPE_ = 'news',
        TYPE_ARTICLE = 'article',
        TYPE_LANGUAGE = 'language',
        TYPE_MENU = 'menu',
        //TYPE_PROMOTION = 'menu',
        TYPE_MEDIA = 'media',
        TYPE_PROMOTION = 'promotion',

        TYPE_ANDROID = 1,
        TYPE_IOS = 2,

        SONG_LIKE = 'like',
        SONG_DISLIKE = 'dislike',

        STATUS_ACTIVE = 1,
        STATUS_INACTIVE = 0,

        FAVORITE_AUDIO = 1,
        FAVORITE = 2,

        STATUS_CREATED = 0,
        STATUS_REJECT = 1,
        STATUS_IN_PROCESS = 2,
        STATUS_READY = 3,
        STATUS_PENDING = 6,
        STATUS_DELIVERED = 4,
        STATUS_FAIL = 5,

        CATE_PARENT = 0,
        LEVEL_PARENT = 1,
        LEVEL_CHILD_1 = 2,
        LEVEL_CHILD_2 = 3,
        LEVEL_CHILD_3 = 4,
		
		RADIO_TYPE_LINK = 1,
        RADIO_TYPE_MIXLR = 2,

        ITEM_PER_PAGE = 10,

        PAGE_DEFAULT = 20,
		
		PUSH_NEW_SONG = 1,
        PUSH_NOTIFICATION = 2,

        ROLE_ADMIN = 1,
        ROLE_CUSTOMER = 0,
		
		TYPE_BANNER_NORMAL = 0,
        TYPE_BANNER_RADIO = 1,

        NO_IMAGE = 'noImage.jpg';

    const
        SETTING_MAIL = 'SETTING_MAIL',
        SETTING_ADMIN_MAIL = 'SETTING_ADMIN_MAIL',
        SETTING_BANK_INFO = 'SETTING_BANK_INFO',
        SETTING_GENERAL = 'SETTING_GENERAL',
		GOOGLE_API_KEY = 'GOOGLE_API_KEY',
        PEM_FILE = 'PEM_FILE';    

    const USER_STATUS_ACTIVE = 1;

    public static $imageExtension = array('jpg', 'png', 'gif');

    public static function pushAndroid($registrationIDs,$msg)
    {
        $apiKey = Settings::model()->find(' metaKey = "'.Constants::GOOGLE_API_KEY.'" ')->metaValue;
        //echo $apiKey;exit;
        //$apiKey='AIzaSyCXb-7uIMI32EMW5YR9rCHSwHj7RUDkz28';
        $url = 'https://android.googleapis.com/gcm/send';

        $loop = ceil (count($registrationIDs)/1000);
        $msg = array
        (
            'message'=>$msg
        );

        for ($i = 1; $i<=$loop; $i++)
        {
            if (0 <count($registrationIDs) && count($registrationIDs) <1000)
                $registrationID = $registrationIDs;
            else
            {
                $registrationID = array_slice($registrationIDs,0,1000);
                $registrationIDs = array_slice($registrationIDs,1000,count($registrationIDs));
            }

            $fields = array
            (
                'registration_ids' => $registrationID,
                'data' => $msg
            );

            $headers = array(
                'Authorization: key=' . $apiKey,
                'Content-Type: application/json'
            );
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
            curl_exec($ch);
            curl_close($ch);
        }
    }

    public static function pushIos($idevices,$message)
    {
        $badge = 1;
        $sound = 'default';
        $development = true;//make it false if it is not in development mode
        $passphrase='';//your passphrase

        $payload = array();
        $payload['aps'] = array('alert' => $message, 'badge' => intval($badge), 'sound' => $sound);
        $payload = json_encode($payload);

        $apns_url = NULL;
        $apns_cert = NULL;
        $apns_port = 2195;
	
	    $pemFile = Settings::model()->find(' metaKey = "'.Constants::PEM_FILE.'" ')->metaValue;
       //echo dirname(Yii::app()->request->scriptFile).'/protected/controllers/api/pem/'.$pemFile;exit;
        if($development)
        {
            $apns_url = 'gateway.sandbox.push.apple.com';
            $apns_cert = dirname(Yii::app()->request->scriptFile).'/protected/controllers/api/pem/'.$pemFile;
        }
        else
        {
            $apns_url = 'gateway.push.apple.com';
            $apns_cert = dirname(Yii::app()->request->scriptFile).'/protected/controllers/api/pem/'.$pemFile;
        }

        foreach($idevices as $idevice)
        {
            $stream_context = stream_context_create();
            stream_context_set_option($stream_context, 'ssl', 'local_cert', $apns_cert);
            stream_context_set_option($stream_context, 'ssl', 'passphrase', $passphrase);

            $apns = stream_socket_client('ssl://' . $apns_url . ':' . $apns_port, $error, $error_string, 60000, STREAM_CLIENT_CONNECT, $stream_context);
            if (!$apns)
                exit("Failed to connect: $error $error_string" . PHP_EOL);
            echo 'Connected to APNS' . PHP_EOL;

            $token = $idevice;
            $device_tokens=  str_replace("<","",$token);
            $device_tokens1=  str_replace(">","",$device_tokens);
            $device_tokens2= str_replace(' ', '', $device_tokens1);

            $apns_message = chr(0) . chr(0) . chr(32) . pack('H*', $device_tokens2) . chr(0) . chr(strlen($payload)) . $payload;

            fwrite($apns, $apns_message);
            @socket_close($apns);
            @fclose($apns);
        }
    }

    public static function pushNotification($id)
    {
        ini_set("max_execution_time", 300);
        $path= Yii::app()->request->getBaseUrl(true);
        //echo $path;exit;

        $song = Song::model()->findByPk($id);

        if(strlen($song->image)>0)
        {
            $image = $path.'/'.IMAGES_DIR.'/'.SONG_DIR.'/'.$song->image;
        }
        else
        {
            $image = '';
        }

        if(strlen($song->link)>0)
        {
            if(substr_count($song->link,'http') >0)
            {
                $link = $song->link;
            }
            else
            {
                $link = $path.'/'.UPLOADS_DIR.'/'.$song->link;
            }
        }
        else
        {
            $link = '';
        }

        $messageAndroid = array(
            'id' => $id,
            'name' => $song->song_name,
            'link' => $link,
            'image' => $image,
            'description' => isset($song->description) ? $song->description : '',
            'content' => $song->song_name.' created by Admin!',
            'type' => Constants::PUSH_NEW_SONG
        );

        $messageIos = array(
            'id' => $id,
            'name' => $song->song_name,
            'link' => $link,
            'image' => $image,
            'description' => isset($song->description) ? $song->description : '',
            'body' => $song->song_name.' created by Admin!',
            'type' => Constants::PUSH_NEW_SONG
        );

        $aGcm = array();
        $iGcm = array();


        $device = Device::model()->findAll('status ='.Constants::STATUS_ACTIVE); // allow push

        if(count($device)>0)
        {
            foreach( $device as $item)
            {
                if($item->type == Constants::TYPE_ANDROID)
                {
                    $aGcm[] = $item->gcm_id;
                }
                elseif($item->type == Constants::TYPE_IOS)
                {
                    $iGcm[] = $item->gcm_id;
                }
            }
        }
        else
        {
            $aGcm = array();
            $iGcm = array();
        }
		
		//var_dump($aGcm);exit;

        if(count($aGcm)>0)
        {
            try
            {
                Constants::pushAndroid($aGcm,$messageAndroid);
            }catch(Exception $e)
            {
                return false;
            }
        }

        /*if(count($iGcm)>0)
        {
            try
            {
                Constants::pushIos($iGcm,$messageIos);
            }catch(Exception $e)
            {
                return false;
            }
        }*/
    }
	
	public static function adminNotification($message)
    {
        ini_set("max_execution_time", 300);

        $messageAndroid = array(
            'content' => $message,
            'type' => Constants::PUSH_NOTIFICATION
        );

        $messageIos = array(
            'body' => $message,
            'type' => Constants::PUSH_NOTIFICATION
        );

        $aGcm = array();
        $iGcm = array();

        $device = Device::model()->findAll('status =' . Constants::STATUS_ACTIVE); // allow push

        if (count($device) > 0) {
            foreach ($device as $item) {
                if ($item->type == Constants::TYPE_ANDROID) {
                    $aGcm[] = $item->gcm_id;
                } elseif ($item->type == Constants::TYPE_IOS) {
                    $iGcm[] = $item->gcm_id;
                }
            }
        } else {
            $aGcm = array();
            $iGcm = array();
        }

        //var_dump($aGcm);exit;

        if (count($aGcm) > 0) {
            try {
                Constants::pushAndroid($aGcm, $messageAndroid);
            } catch (Exception $e) {
                //return false;
            }
        }

        if (count($iGcm) > 0) {
            try {
                Constants::pushIos($iGcm, $messageIos);
            } catch (Exception $e) {
                //return false;
            }
        }
    }
}
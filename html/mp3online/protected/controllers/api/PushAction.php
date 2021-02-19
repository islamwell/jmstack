<?php
/**
 * Created by JetBrains PhpStorm.
 * User: HUY
 * Date: 3/7/14
 * Time: 4:19 PM
 * To change this template use File | Settings | File Templates.
 */

class PushAction extends CAction
{

    public function run()
    {
        // Push Ios

        /*$message = " Test Push!!!";
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

        if($development)
        {
            $apns_url = 'gateway.sandbox.push.apple.com';
            $apns_cert = dirname(Yii::app()->request->scriptFile).'/protected/controllers/api/pem/ck.pem';
        }
        else
        {
            $apns_url = 'gateway.push.apple.com';
            $apns_cert = dirname(Yii::app()->request->scriptFile).'/protected/controllers/api/pem/ck.pem';
        }
        $stream_context = stream_context_create();
        stream_context_set_option($stream_context, 'ssl', 'local_cert', $apns_cert);
        stream_context_set_option($stream_context, 'ssl', 'passphrase', $passphrase);

        $apns = stream_socket_client('ssl://' . $apns_url . ':' . $apns_port, $error, $error_string, 2, STREAM_CLIENT_CONNECT, $stream_context);
        $idevices = Device::model()->findAll('type = 2');
        foreach($idevices as $idevice)
        {
            $token = $idevice->gcm_id;
            //$token = '913355c65649d1eec48ce3bd595947115219de6ad566d03b40fb308fe1f5c593';
            $device_tokens=  str_replace("<","",$token);
            $device_tokens1=  str_replace(">","",$device_tokens);
            $device_tokens2= str_replace(' ', '', $device_tokens1);
            $apns_message = chr(0) . chr(0) . chr(32) . pack('H*', $device_tokens2) . chr(0) . chr(strlen($payload)) . $payload;
            $msgapns = fwrite($apns, $apns_message);
            //echo $msgapns;
            if (!isset($msgapns)) {
                echo 'Message not delivered:' . $error . '; error string:' . $error_string . PHP_EOL;
            } else {
                echo 'Message successfully delivered' . PHP_EOL;
            }
            //fwrite($apns, $apns_message);
        }
        @socket_close($apns);
        @fclose($apns);*/

        //Push Android

        //$apiKey = json_decode(Settings::model()->findByPk(4)->setting_value)->google_api_key;
        $apiKey='AIzaSyCXb-7uIMI32EMW5YR9rCHSwHj7RUDkz28';
        $url = 'https://android.googleapis.com/gcm/send';

        $msg = array
        (
            'message'=> 'Push Test',
            //'id' => 1
        );

        //$registrationID = array('APA91bGoMqAgsqJ987EwQFKr4pEG8wT-T6G9SoheaMNLVfoIlrS4-SZQ2_oIL1Ht7Bqx7XoQOCFG2LGnq10oksKcQFq4TuB1Fu7ZvEQPFV_sZ7Xi-9tBx7sU5E24u7NagnWJWY2KCBLo','APA91bEwGILBV2857aJA38HUv61Z7G34r9s608UKYRGNBOpUzB-mV2DAbHjyFtmCl-yi22JBcnvKwHnJnq5baD7DCWQNV8F1aAYUGNfNwme9D41ZlbuJdTVOKtqJ3hddvdd4TvcJCpOT') ;
        $registrationID = array();
		$device = Device::model()->findAll('type = 1');
		foreach($device as $item)
		{
			$registrationID[] = $item->gcm_id;
		}
		//var_dump($registrationID);exit;
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
        $ha= curl_exec($ch);
        curl_close($ch);
        echo $ha;
        //Constants::pushNotification(1);
    }

}
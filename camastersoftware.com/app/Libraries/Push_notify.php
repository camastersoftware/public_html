<?php namespace App\Libraries;
use \App\Models\Mfcm;
use \App\Models\Mtoken;
use \App\Models\Mnotifications;

class Push_notify
{
    public function __construct()
    {
        $this->Mfcm = new Mfcm();
        $this->Mtoken = new Mtoken();
        $this->Mnotifications = new Mnotifications();
    }
    
	public function notification($notifyArr)
	{
		$output = FALSE;
		$error_msg = "";
        $ntfyUserId=$notifyArr['userId'];
        $ntfyTitle=$notifyArr['title'];
        $ntfyBody=$notifyArr['body'];
        $ntfyPushType=$notifyArr['pushType'];

		$mfcData=$this->Mfcm->where('status', 1)
                    ->findAll();
		
		$fcm_server_key_data=$mfcData;
		
		if(!empty($fcm_server_key_data))
        {
    		$fcm_server_key=$fcm_server_key_data[0]['server_key'];
    		
    		$fcm_server_key = str_replace(PHP_EOL, '', $fcm_server_key);
    
    		if(!defined('API_ACCESS_KEY'))
    			define( 'API_ACCESS_KEY', $fcm_server_key);
    
    // 		$query=$this->Mfcm->get_fms_token($ntfyUserId);
    		$userTokenData=$this->Mtoken->where('fkUserId', $ntfyUserId)
    		            ->where('status', 1)
                        ->findAll();
    		
    		$fetch_user_token=$userTokenData;
    
    		if(!empty($fetch_user_token))
    		{
    		    $token=$fetch_user_token[0]['token'];
    		    
        		$notification=[
        		    'title'	=> $ntfyTitle,
        			'body' 	=> $ntfyBody,
        			'android_channel_id' => "channel_id_2",
        			'click_action' => "FCM_PLUGIN_ACTIVITY",
        			'icon' => "fcm_push_icon"
        		];    
        		
        		$data=[
        		    'title'	=> $ntfyTitle,
        			'body' 	=> $ntfyBody
        		];   
        		
        		$fcmNotification = [
        			'to' => $token,
        			'priority' => 'high',
        			'notification' => $notification,
        			'data' => $data
        		];
        		
        		$dataString=json_encode($fcmNotification);
        
        		$headers = [
        			'Authorization: key=' . API_ACCESS_KEY,
        			'Content-Type: application/json',
        			'Content-Length:'.strlen($dataString)
        		];
        		
        		#Send Response To FireBase Server	
        		$curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
                    CURLOPT_POST => true,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => $dataString,
                    CURLOPT_HTTPHEADER => $headers,
                ));
                
                $response = curl_exec($curl);
                $err = curl_error($curl);
                
                if(curl_error($curl))
                {
                    $output=FALSE;
                }
                else
                {
                    $output=TRUE;
                    
                    $notifyInsertArray = [
                        'section' => $ntfyPushType,
                        'message' => $ntfyTitle,
                        'fkUserId' => $ntfyUserId,
                        'status' => 1,
                        'createdDatetime' => $this->currTimeStamp
                    ];
                    
                    $this->Mnotifications->save($notifyInsertArray);
                }
                
                curl_close($curl);
    		}
        }
        
        return $output;
	}
}


?>
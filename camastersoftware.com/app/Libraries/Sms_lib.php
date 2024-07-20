<?php namespace App\Libraries;
use \App\Models\Msms;

class Sms_lib
{
    public function __construct()
    {
        $this->Msms = new Msms();
    }

	public function send($smsDataArr)
	{
        $to=$smsDataArr['to'];
        $msg=$smsDataArr['message'];
        
        $smsConfigArr=$this->Msms->where('status', 1)->first();
		
		$response['status']=FALSE;
        $response['message']="SMS Configuration not found...";
        
        if(!empty($smsConfigArr))
        {
            $smsUrl=$smsConfigArr['url'];
            $senderId=$smsConfigArr['senderId'];
            $apiKey=urlencode($smsConfigArr['apiKey']);
            
        	// Message details
			$numbers = "91".$to;
			$sender = urlencode($senderId);
			$message = $msg;
		
			// Prepare data for POST request
			$dataArr = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);

			// /*
			$crl = curl_init($smsUrl);
			curl_setopt($crl, CURLOPT_POST, true);
			curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($crl, CURLOPT_POSTFIELDS, $dataArr);
			
			$res = curl_exec($crl);
		
			if(!$res) 
			{
				$response_err="";
				$response_err.="Message could not be sent.";
				$response_err.='Error: "' . curl_error($crl) . '" - Code: ' . curl_errno($crl);
		
				$response['status']=FALSE;
				$response['message']=$response_err;
			}
			else
			{
				$response['status']=TRUE;
				$response['message']="OTP Sent";
			}
		
			curl_close($crl);
			// */
        }

		// $response['status']=TRUE;
		// $response['message']=$msg;

		return $response;
	}
    
	public function sendOld($smsDataArr)
	{
        $to=$smsDataArr['to'];
        $msg=$smsDataArr['message'];
        
        // $condtnArr['sms_config.status']=1;

// 		$query=$this->CI->Mcommon->getRecords($tableName='sms_config', $colNames="sms_config.url, sms_config.username, sms_config.password, sms_config.senderId", $condtnArr, $likeCondtnArr=array(), $joinArr=array(), $singleRow=TRUE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $backTicks=FALSE, $customOrWhereArray=array(), $orNotLikeArray=array(), $limit="", $inObjectFormat=TRUE);
        
        $smsData=$this->Msms->where('status', 1)
                    ->findAll();
        
// 		$smsConfigArr=$query['userdata'];

		$smsConfigArr=$smsData;
		
		$response['status']=FALSE;
        $response['message']="SMS Configuration not found...";
        
        if(!empty($smsConfigArr))
        {
            $smsUrl=$smsConfigArr[0]['url'];
            $senderId=$smsConfigArr[0]['senderId'];
            $authKey=$smsConfigArr[0]['authKey'];
            
        	// Message details
        	$numbers = "91".$to;
        	$sender = urlencode($senderId);
        	$message = rawurlencode($msg);
        
        	$numbers = implode(',', $numbers);
        
        	// Prepare data for POST request
        	$dataArr = array('flow_id' => '', 'sender' => $senderId, "mobiles" => $numbers, 'VAR1' => '');
        	
        	$enJSONData=json_encode($dataArr);
        	
        	$headerArr=array(
        	    "authkey: ".$authKey."",
                "content-type: application/JSON"
            );
        
        // 	$urlParams="";
        
        // 	foreach($dataArr AS $k=>$v)
        // 	{
        // 	    if($k=='user')
        // 	        $urlParams.=$k."=".$v;
        // 	    else
        // 	        $urlParams.="&".$k."=".$v;
        // 	}
        
        // 	$url = $smsUrl.'?'.$urlParams;
        	$crl = curl_init();
        
        	curl_setopt($crl, CURLOPT_URL, $smsUrl);
        	curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
        	curl_setopt($crl, CURLOPT_ENCODING, "");
        	curl_setopt($crl, CURLOPT_MAXREDIRS, 10);
        	curl_setopt($crl, CURLOPT_TIMEOUT, 30);
        	curl_setopt($crl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        	curl_setopt($crl, CURLOPT_CUSTOMREQUEST, "POST");
        	curl_setopt($crl, CURLOPT_POSTFIELDS, $enJSONData);
        	curl_setopt($crl, CURLOPT_HTTPHEADER, $headerArr);
        	
        	$res = curl_exec($crl);
        
        	if(!$res) 
        	{
        	    $response_err="";
        	    $response_err.="Message could not be sent.";
        	    $response_err.='Error: "' . curl_error($crl) . '" - Code: ' . curl_errno($crl);
        
        		$response['status']=FALSE;
        		$response['message']=$response_err;
        	}
        	else
        	{
        		$response['status']=TRUE;
        		$response['message']="";
        	}
        
        	curl_close($crl);
        }

		return $response;
	}
}


?>
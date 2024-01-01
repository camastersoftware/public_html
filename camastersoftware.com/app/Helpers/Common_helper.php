<?php
if(!function_exists('add_leading_zero')) {
    function add_leading_zero($num){
        $num_padded = sprintf("%02d", $num);
        return $num_padded;
    }
}

if(!function_exists('display_client_name')) {
    function display_client_name($orgType, $clientName, $orgName){
        
        $orgNm = (!empty($orgName)) ? " (".$orgName.")" : "";
        
        if($orgType==8)
        {
            $cliNameVar = $clientName.$orgNm;
        }
        elseif($orgType==9 || $orgType==22 || $orgType==23)
        {
            $cliNameVar = $clientName;
        }
        else
        {
            $cliNameVar = $orgName; 
        }
        
        $cliNameLength = strlen($cliNameVar);
        
        $fullLength=30;
        $partLength=15;
        
        if($cliNameLength>$fullLength)
        {
            if($orgType==8)
            {
                $cliNameLgth = strlen($clientName);
                $orgNameLgth = strlen($orgNm);
                
                if($cliNameLgth>$partLength)
                    $cliNameVal=substr($clientName, 0, $partLength)."...";
                else
                    $cliNameVal=$clientName;
                
                if($orgNameLgth>$partLength)
                    $orgNameVal=substr($orgNm, 0, $partLength)."...";
                else
                    $orgNameVal=$orgNm;
                    
                $displayName = $cliNameVal." ".$orgNameVal;
            }
            else
            {
                $displayName = substr($cliNameVar, 0, $fullLength)."...";
            }
        }
        else
        {
            $displayName = $cliNameVar; 
        }
        
        $returnData='<span data-toggle="tooltip" data-original-title="'.$cliNameVar.'" style="cursor:pointer;">'.$displayName.'</span>';
        
        return $returnData;
    }
}

if(!function_exists('getRandomUpperCaseAlpha')) {
    function getRandomUpperCaseAlpha($length){
        $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $alphabet[rand(0, strlen($alphabet) - 1)];
        }
        
        return $randomString;
    }
}

if(!function_exists('getUserAgentData')) {
    function getUserAgentData($request){
        $agent = $request->getUserAgent();

        if ($agent->isBrowser()) {
            $currentAgent = $agent->getBrowser() . ' ' . $agent->getVersion();
        } elseif ($agent->isRobot()) {
            $currentAgent = $agent->getRobot();
        } elseif ($agent->isMobile()) {
            $currentAgent = $agent->getMobile();
        } else {
            $currentAgent = 'Unidentified User Agent';
        }
        
        $responseArr['currentAgent']=$currentAgent;
        $responseArr['currentPlatform']=$agent->getPlatform(); // Platform info (Windows, Linux, Mac, etc.)
        
        return $responseArr;
    }
}

if(!function_exists('checkData')) {
    function checkData($data){
        $returnData = (!empty($data)) ? $data : "N/A";
        return $returnData;
    }
}

?>

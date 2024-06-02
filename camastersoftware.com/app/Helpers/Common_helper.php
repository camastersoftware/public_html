<?php
if (!function_exists('add_leading_zero')) {
    function add_leading_zero($num)
    {
        $num_padded = sprintf("%02d", $num);
        return $num_padded;
    }
}

if (!function_exists('display_client_name')) {
    function display_client_name($orgType, $clientName, $orgName)
    {

        $orgNm = (!empty($orgName)) ? " (" . $orgName . ")" : "";

        if ($orgType == 8) {
            $cliNameVar = $clientName . $orgNm;
        } elseif ($orgType == 9 || $orgType == 22 || $orgType == 23) {
            $cliNameVar = $clientName;
        } else {
            $cliNameVar = $orgName;
        }

        $cliNameLength = strlen($cliNameVar);

        $fullLength = 30;
        $partLength = 15;

        if ($cliNameLength > $fullLength) {
            if ($orgType == 8) {
                $cliNameLgth = strlen($clientName);
                $orgNameLgth = strlen($orgNm);

                if ($cliNameLgth > $partLength)
                    $cliNameVal = substr($clientName, 0, $partLength) . "...";
                else
                    $cliNameVal = $clientName;

                if ($orgNameLgth > $partLength)
                    $orgNameVal = substr($orgNm, 0, $partLength) . "...";
                else
                    $orgNameVal = $orgNm;

                $displayName = $cliNameVal . " " . $orgNameVal;
            } else {
                $displayName = substr($cliNameVar, 0, $fullLength) . "...";
            }
        } else {
            $displayName = $cliNameVar;
        }

        $returnData = '<span data-toggle="tooltip" data-original-title="' . $cliNameVar . '" style="cursor:pointer;">' . $displayName . '</span>';

        return $returnData;
    }
}

if (!function_exists('getRandomUpperCaseAlpha')) {
    function getRandomUpperCaseAlpha($length)
    {
        $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $alphabet[rand(0, strlen($alphabet) - 1)];
        }

        return $randomString;
    }
}

if (!function_exists('getUserAgentData')) {
    function getUserAgentData($request)
    {
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

        $responseArr['currentAgent'] = $currentAgent;
        $responseArr['currentPlatform'] = $agent->getPlatform(); // Platform info (Windows, Linux, Mac, etc.)

        return $responseArr;
    }
}

if (!function_exists('checkData')) {
    function checkData($data)
    {
        $returnData = (!empty($data)) ? $data : "N/A";
        return $returnData;
    }
}

if (!function_exists('getTotMSGCount')) {
    function getTotMSGCount($sessUserId)
    {   
        $totalMsgCount = 0;
        if(!empty($sessUserId))
        {
            $MUserMessage = new \App\Models\MUserMessage();
            $userUnreadMsgArr = $MUserMessage->select('COUNT(user_message_tbl.fromUserId) as msgCount')
                ->where("user_message_tbl.status", '1')
                ->where("user_message_tbl.toUserId", $sessUserId)
                ->where("user_message_tbl.isRead",  '0')
                ->groupBy("user_message_tbl.fromUserId")
                ->findAll();

            if(!empty($userUnreadMsgArr))
            {
                foreach ($userUnreadMsgArr as $ct_row) {
                    $totalMsgCount += $ct_row['msgCount'];
                }
            }
        }
        return $totalMsgCount;
    }
}

if (!function_exists('getTodaysReminders')) {
    function getTodaysReminders($sessUserId)
    {   
        $isReminderPresent = false;
        if(!empty($sessUserId))
        {
            $todaysDate = date("Y-m-d");
            $Mreminder = new \App\Models\Mreminder();
            $userReminders = $Mreminder->where("reminderDate", $todaysDate)
                ->where("status", '1')
                ->findAll();

            if(!empty($userReminders))
            {
                $isReminderPresent = true;
            }
        }
        return $isReminderPresent;
    }
}
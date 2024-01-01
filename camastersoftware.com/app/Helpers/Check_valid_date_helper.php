<?php
if(!function_exists('check_valid_date')) {
   function check_valid_date($date){
       $isValidDate=false;
       if(!empty($date) && $date!="0000-00-00" && $date!="1970-01-01"){
           $isValidDate=true;
       }
       return $isValidDate;
   }
}

if(!function_exists('get_dates_btwn_two')) {
   function get_dates_btwn_two($date1, $date2, $format = 'Y-m-d' ) {
        $dates = array();
        $current = strtotime($date1);
        $date2 = strtotime($date2);
        $stepVal = '+1 day';
        while( $current <= $date2 ) {
            $dates[] = date($format, $current);
            $current = strtotime($stepVal, $current);
        }
        return $dates;
    }
}

?>

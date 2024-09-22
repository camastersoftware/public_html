<?php
/*
if(!function_exists('amount_format')) {
   function amount_format($amt){
       if(is_numeric($amt)){
           
            // $amount=amount_format(abs((float)$amt));
            $amount=number_format(abs((float)$amt), 2);
            $amountFormat = substr($amount, 0, strpos($amount, "."));
           
            if($amt>0)
                $finalFormat=$amountFormat;
            else
                $finalFormat="(".$amountFormat.")";
                
            return $finalFormat;
                
       }else{
            return 0.00;
       }
   }
}
*/

if (!function_exists('amount_format')) {
    function amount_format($amt) {
        if (is_numeric($amt)) {
            // Round the amount to the nearest integer
            $amt = round((float)$amt);
            
            // Create a NumberFormatter instance for the Indian locale
            $locale = 'en_IN'; // Locale for India
            $fmt = new \NumberFormatter($locale, \NumberFormatter::DECIMAL);
            
            // Set the minimum and maximum fraction digits for the rounded amount
            $fmt->setAttribute(\NumberFormatter::MIN_FRACTION_DIGITS, 0);
            $fmt->setAttribute(\NumberFormatter::MAX_FRACTION_DIGITS, 0);
            
            // Format the rounded amount
            $formattedAmount = $fmt->format($amt);
            
            // Handle negative amounts by adding parentheses
            if ($amt < 0) {
                $formattedAmount = '(' . $formattedAmount . ')';
            }
            
            return $formattedAmount;
        } else {
            return '0'; // Return '0' if the input is not numeric
        }
    }
}




if(!function_exists('moneyInWords')) {
   function moneyInWordsOld($number){
        $number=(float)$number;
        $no = floor($number);
        $point = round($number - $no, 2) * 100;
        $hundred = null;
        $digits_1 = strlen($no);
        $i = 0;
        $str = array();
        $words = array('0' => '', '1' => 'one', '2' => 'two',
            '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
            '7' => 'seven', '8' => 'eight', '9' => 'nine',
            '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
            '13' => 'thirteen', '14' => 'fourteen',
            '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
            '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
            '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
            '60' => 'sixty', '70' => 'seventy',
            '80' => 'eighty', '90' => 'ninety');
        $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
        while ($i < $digits_1) {
         $divider = ($i == 2) ? 10 : 100;
         $number = floor($no % $divider);
         $no = floor($no / $divider);
         $i += ($divider == 10) ? 1 : 2;
         if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str [] = ($number < 21) ? $words[$number] .
                " " . $digits[$counter] . $plural . " " . $hundred
                :
                $words[floor($number / 10) * 10]
                . " " . $words[$number % 10] . " "
                . $digits[$counter] . $plural . " " . $hundred;
         } else $str[] = null;
        }
        $str = array_reverse($str);
        $result = implode('', $str);
        $points = ($point) ?
        "." . $words[$point / 10] . " " . 
              $words[$point = $point % 10] : '';
              
        if(!empty($points))
        $return_data=$result . "Rupees  " . $points . " Paise";
        else
        $return_data=$result . "Rupees  ";
        
        return $return_data." Only";
   }
   
   
   function moneyInWords($num) {
        $ones = ['', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine'];
        $teens = ['', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen'];
        $tens = ['', 'Ten', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'];
        $thousands = ['', 'Thousand', 'Lakh', 'Crore'];
    
        function convert_number_to_words($n, $ones, $teens, $tens) {
            if ($n < 10) {
                return $ones[$n];
            } elseif ($n < 20) {
                return $teens[$n - 10];
            } elseif ($n < 100) {
                return $tens[intval($n / 10)] . ' ' . $ones[$n % 10];
            } else {
                return $ones[intval($n / 100)] . ' Hundred ' . convert_number_to_words($n % 100, $ones, $teens, $tens);
            }
        }
    
        $rupees = intval($num);
        $paise = round(($num - $rupees) * 100);
    
        if ($rupees == 0) {
            return 'Zero Rupees';
        }
    
        $words = '';
    
        // Convert Rupees part
        $part = 0;
        while ($rupees > 0) {
            $current_part = $rupees % 1000;
            if ($current_part > 0) {
                $words = convert_number_to_words($current_part, $ones, $teens, $tens) . ' ' . $thousands[$part] . ' ' . $words;
            }
            $rupees = intval($rupees / 1000);
            $part++;
        }
    
        // Add "Rupees" to the end of the amount if it has a non-zero integer part
        if ($words !== '') {
            $words .= 'Rupees';
        }
    
        // Convert Paise part
        if ($paise > 0) {
            $words .= ' And ' . convert_number_to_words($paise, $ones, $teens, $tens) . ' Paise';
        }
        
        $return_data = $words." Only";
    
        return $return_data;
    }
}

?>

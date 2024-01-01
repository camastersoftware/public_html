<?php namespace App\Controllers\Remote;
use \App\Controllers\BaseController;

class Utility extends BaseController
{
    public function __construct()
    {
        $this->Mcommon = new \App\Models\Mcommon();
    }

    public function changeTheme()
    {
        $lndryThemeCookie=get_cookie("templateThemeLndry");
        
        $expirationTime=(int)(time()+60*60*24*100);
        
        if($lndryThemeCookie=="enabled")
            set_cookie("templateThemeLndry", "", $expirationTime);
        else
            set_cookie("templateThemeLndry", "enabled", $expirationTime);
            
        echo json_encode(true);
    }
}

?>

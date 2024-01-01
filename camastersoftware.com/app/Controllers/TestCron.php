<?php
namespace App\Controllers;

class TestCron extends BaseController
{
    public function __construct()
    {
        die('debug');
        $this->MTestCron = new \App\Models\MTestCron();
    }

	public function index()
	{
        $testCronInsertArr=array(
            'testDesc' => "Cron run successfully at - ".$this->currTimeStamp
        );
        
        $this->MTestCron->save($testCronInsertArr);
	}
}
?>


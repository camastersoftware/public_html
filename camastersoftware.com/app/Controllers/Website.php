<?php
namespace App\Controllers;

class Website extends BaseController
{
    public function __construct()
    {
        $this->data['layoutPath']="template/layouts/site_layout";
        
        $this->Mfirm = new \App\Models\Mfirm();
        $this->MprofessionTypes = new \App\Models\MprofessionTypes();
        $this->MpaymentOption = new \App\Models\MpaymentOption();
        $this->Mstate = new \App\Models\Mstate();
        $this->Mcity = new \App\Models\Mcity();
        $this->Maccount = new \App\Models\Maccount();
        $this->Mvisitor = new \App\Models\Mvisitor();
        
        $this->updateVisit();
    }
    
    public function updateVisit()
    {
        helper('Common_helper');
        
        $caMasterAccData = $this->Maccount->where('status', 1)->first();
        
        $wbCount=0;
        
        if(!empty($caMasterAccData))
        {
            if(!empty($caMasterAccData['websiteCount']))
                $wbCount = $caMasterAccData['websiteCount'];
        }
        
        $this->data['wbCount']=$wbCount;
        
        $request = service('request');
        $currIP = $request->getIPAddress();
        
        $isCurrIPExists = $this->Mvisitor->where('visitorIP', $currIP)->first();
        
        if(empty($isCurrIPExists))
        {
            $userAgentData = getUserAgentData($request);
            
            $currentAgent=$userAgentData['currentAgent'];
            $currentPlatform=$userAgentData['currentPlatform'];
            
            $visitorInsertArr=[
                'visitorIP'         =>  $currIP,
                'visitorUserAgent'  =>  $currentAgent,
                'visitorPlatform'   =>  $currentPlatform,
                'createdDatetime'   =>  date('Y-m-d H:i:s')
            ];
            
            $this->Mvisitor->save($visitorInsertArr);
            
            $this->Maccount->set('websiteCount', $wbCount+1)
                                ->where('status', '1')
                                ->update();
        }
    }

	public function index()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        return view('website/home', $this->data);
	}

    public function software()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        return view('website/software', $this->data);
	}

    public function tax_calendar()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        return view('website/tax_calendar', $this->data);
	}

    public function faq()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        return view('website/faq', $this->data);
	}

    public function pricing()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        return view('website/pricing', $this->data);
	}

    public function contact()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        return view('website/contact', $this->data);
	}

    public function register()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);
        
        $professionsArr = $this->MprofessionTypes->where('status', 1)
                    ->orderBy('profession_type_id', 'ASC')
                    ->findAll();

        $this->data['professionsArr']=$professionsArr;
        
        
        $paymentOptionsArr = $this->MpaymentOption->where('status', 1)
                                ->orderBy('payment_option_id', 'ASC')
                                ->findAll();

        $this->data['paymentOptionsArr']=$paymentOptionsArr;
        

        $statesArr = $this->Mstate->where('status', 1)
                    ->orderBy('stateId', 'ASC')
                    ->findAll();

        $this->data['statesArr']=$statesArr;


        $citiesArr = $this->Mcity->where('status', 1)
                        ->orderBy('cityId', 'ASC')
                        ->findAll();
        
        $this->data['citiesArr']=$citiesArr;

        return view('website/register', $this->data);
	}
}
?>
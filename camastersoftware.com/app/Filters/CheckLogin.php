<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class CheckLogin implements FilterInterface
{
    /**
     * Check loggedIn to redirect page
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $this->session = \Config\Services::session();
        // if (session('username')) {
        //     return redirect()->to('/dashboard');
        // }
        
        $uri = service('uri');

        $totalSegments=$uri->getTotalSegments();
        
        $uri1="";
        $uri2="";
        
        if(!empty($totalSegments))
        {
            $uri1=$uri->getSegment(1);

            if($totalSegments>=2)
                $uri2=$uri->getSegment(2);
        }
        
        $this->adminId=$this->session->get('adminId');
        $this->adminUserName=$this->session->get('userName');
        $this->adminStatus=$this->session->get('status');
        
        if($uri1!="tax_calendar_view" && $uri1!="software" && $uri1!="tax-calendar" && $uri1!="faq" && $uri1!="pricing" && $uri1!="contact" && $uri1!="register-firm" && $uri2!="getCities")
        {
            // if($uri1!="landing" && $uri1!="register" && $uri1!="" && $uri1!="ShiftDueDateNextYearCron" && $uri1!="ShiftDueDatePreviousYearCron" && $uri1!="add_request" && $uri1!="register_firm")
            if($uri1!="assets" && $uri1!="landing" && $uri1!="register" && $uri1!="" && $uri1!="TestCron" && $uri1!="ShiftDueDateNextYearCron" && $uri1!="ShiftDueDatePreviousYearCron" && $uri1!="add_request" && $uri1!="register_firm" && $uri1!="getOptions")
            {
                /*
                if(($this->adminId=="" || $this->adminUserName=="") && ($uri1!="admin"))
                {
                    if($uri1!="login" && $uri1!="admin")
                        return redirect()->route('login');
                }
                elseif($uri1=="admin")
                {
                    $this->userId=$this->session->get('userId');
                    $this->userLoginName=$this->session->get('userLoginName');
        
                    if(($this->userId=="" || $this->userLoginName=="") && ($uri2!="login"))
                        return redirect()->route('admin/login');
                }
                */

                if(($this->adminId=="" || $this->adminUserName=="") && ($uri1=="superadmin"))
                {
                    if($uri2!="login" && $uri1=="superadmin")
                        return redirect()->route('superadmin/login');
                }
                elseif($uri1!="superadmin")
                {
                    $this->userId=$this->session->get('userId');
                    $this->userLoginName=$this->session->get('userLoginName');

                    // print_r($request->getPost());

                    // print_r(' uri1 : '.$uri1);
                    // echo "<br><br>";
                    // print_r(' userId : '.$this->userId);
                    // echo "<br><br>";
                    // print_r(' userLoginName : '.$this->userLoginName);
                    // echo "<br><br>";
                    

                    // if(($this->userId=="" || $this->userLoginName=="") && ($uri1!="login"))
                    // {
                    //     die(' pass ');
                    // }

                    // die('not');
        
                    if(($this->userId=="" || $this->userLoginName=="") && ($uri1!="login"))
                        return redirect()->route('login');
                }
            }
        }
            
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
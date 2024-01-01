<?php
namespace App\Controllers;

class OfficeAdministration extends BaseController
{
    public function __construct()
    {
        $this->data['cssPath']="template/includes/css";
        $this->data['navPath']="template/includes/nav";
        $this->data['sidebarPath']="template/includes/sidebar";
        $this->data['footerPath']="template/includes/footer";
        $this->data['scriptPath']="template/includes/scripts";
        $this->data['layoutPath']="template/layouts/main_layout";
        
        $this->Mcommon = new \App\Models\Mcommon();
        $this->MLetterReference = new \App\Models\MLetterReference();
        $this->MCertificateReference  = new \App\Models\MCertificateReference();
        $this->Mmembership  = new \App\Models\Mmembership();
        $this->MmembershipSubscription  = new \App\Models\MmembershipSubscription();
        $this->MgeneralPassword  = new \App\Models\MgeneralPassword();
        $this->TableLib = new \App\Libraries\TableLib();

        $tableArr=$this->TableLib->get_tables();
        
        $this->client_tbl=$tableArr['client_tbl'];
        
        $this->section="Office Administration";
    }
    
    public function index()
	{
	    $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Office Management";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']="Home";

        $this->data['navArr']=$navArr;

        return view('firm_panel/office_administration/home', $this->data);
	}
	
	public function letter_reference_list()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Letter Reference";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $fin_year_arr=explode("-", $this->sessDueDateYear);
        
        $fisrtYr=$fin_year_arr[0];
        $secondYr="20".$fin_year_arr[1];

        $fromDate=date("Y-m-d", strtotime($fisrtYr."-04-01"));
        $toDate=date("Y-m-d", strtotime($secondYr."-03-31"));
        
        $this->data['fromDate']=$fromDate;
        $this->data['toDate']=$toDate;
        
        $letterReferenceList = $this->MLetterReference->where('status', 1)
                                    ->where('letter_reference_fin_year', $this->sessDueDateYear)
                                    ->orderBy('letter_reference_date', 'desc')
                                    ->orderBy('letter_reference_id', 'desc')
                                    ->findAll();

        $this->data['letterReferenceList']=$letterReferenceList;

        return view('firm_panel/office_administration/letter_reference', $this->data);
	}
	
	public function add_letter_reference()
	{
	    $letter_reference_no=$this->request->getPost('letter_reference_no');
	    $letter_reference_date=$this->request->getPost('letter_reference_date');
	    $letter_reference_client=$this->request->getPost('letter_reference_client');
	    $letter_reference_address=$this->request->getPost('letter_reference_address');
	    $letter_reference_subject=$this->request->getPost('letter_reference_subject');
	    
	    $fin_year_arr=explode("-", $this->sessDueDateYear);

        $fisrtYr=$fin_year_arr[0];
        $secondYr="20".$fin_year_arr[1];
        
        $letter_reference_date_val=strtotime($letter_reference_date);
        $fromDate=strtotime($fisrtYr."-04-01");
        $toDate=strtotime($secondYr."-03-31");
        
        if($letter_reference_date_val>=$fromDate && $letter_reference_date_val<=$toDate)
        {
    	    $insertArr=[
                'letter_reference_no' => $letter_reference_no,
                'letter_reference_date' => $letter_reference_date,
                'letter_reference_client' => $letter_reference_client,
                'letter_reference_address' => $letter_reference_address,
                'letter_reference_subject' => $letter_reference_subject,
                'letter_reference_fin_year' => $this->sessDueDateYear,
                'status' => 1,
                'createdBy' => $this->adminId,
                'createdDatetime' => $this->currTimeStamp
            ];
    	    
    	    if($this->MLetterReference->save($insertArr))
    	    {
    	        $insertLogArr['section']=$this->section;
                $insertLogArr['message']=$this->section." Added";
                $insertLogArr['ip']=$this->IPAddress;
                // $insertLogArr['macAddr']=$this->macAddress;
                $insertLogArr['createdBy']=$this->adminId;
                $insertLogArr['createdDatetime']=$this->currTimeStamp;
    
                $this->Mcommon->insertLog($insertLogArr);
                
    	        $this->session->setFlashdata('successMsg', "Letter Reference has been added successfully :)");
    	    }
    	    else
    	    {
    	        $this->session->setFlashdata('errorMsg', "Letter Reference has not added :(");
    	    }
        }
	    else
	    {
	        $this->session->setFlashdata('errorMsg', "Please select valid date.");
	    }
	    
	    return redirect()->route('letter-reference-list');
	}
	
	public function edit_letter_reference()
	{
	    $letter_reference_id=$this->request->getPost('letter_reference_id');
	    $letter_reference_no=$this->request->getPost('letter_reference_no');
	    $letter_reference_date=$this->request->getPost('letter_reference_date');
	    $letter_reference_client=$this->request->getPost('letter_reference_client');
	    $letter_reference_address=$this->request->getPost('letter_reference_address');
	    $letter_reference_subject=$this->request->getPost('letter_reference_subject');
	    
	    $fin_year_arr=explode("-", $this->sessDueDateYear);

        $fisrtYr=$fin_year_arr[0];
        $secondYr="20".$fin_year_arr[1];
        
        $letter_reference_date_val=strtotime($letter_reference_date);
        $fromDate=strtotime($fisrtYr."-04-01");
        $toDate=strtotime($secondYr."-03-31");
        
        if($letter_reference_date_val>=$fromDate && $letter_reference_date_val<=$toDate)
        {
    	    $updateArr=[
                'letter_reference_id' => $letter_reference_id,
                'letter_reference_no' => $letter_reference_no,
                'letter_reference_date' => $letter_reference_date,
                'letter_reference_client' => $letter_reference_client,
                'letter_reference_address' => $letter_reference_address,
                'letter_reference_subject' => $letter_reference_subject,
                'updatedBy' => $this->adminId,
                'updatedDatetime' => $this->currTimeStamp
            ];
    	    
    	    if($this->MLetterReference->save($updateArr))
    	    {
    	        $insertLogArr['section']=$this->section;
                $insertLogArr['message']=$this->section." Updated";
                $insertLogArr['ip']=$this->IPAddress;
                // $insertLogArr['macAddr']=$this->macAddress;
                $insertLogArr['createdBy']=$this->adminId;
                $insertLogArr['createdDatetime']=$this->currTimeStamp;
    
                $this->Mcommon->insertLog($insertLogArr);
                
    	        $this->session->setFlashdata('successMsg', "Letter Reference has been updated successfully :)");
    	    }
    	    else
    	    {
    	        $this->session->setFlashdata('errorMsg', "Letter Reference has not updated :(");
    	    }
        }
	    else
	    {
	        $this->session->setFlashdata('errorMsg', "Please select valid date.");
	    }
    	    
	    return redirect()->route('letter-reference-list');
	}
	
	public function delete_letter_reference()
	{
	    $letter_reference_id=$this->request->getPost('letter_reference_id');
	    
	    $updateArr=[
            'letter_reference_id' => $letter_reference_id,
            'status' => 2,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
	    if($this->MLetterReference->save($updateArr))
	    {
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Deleted";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "Letter Reference has been deleted successfully :)");
	    }
	    else
	    {
	        $this->session->setFlashdata('errorMsg', "Letter Reference has not deleted :(");
	    }
	}
	
	public function certificate_reference_list()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Certificate Reference";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $fin_year_arr=explode("-", $this->sessDueDateYear);
        
        $fisrtYr=$fin_year_arr[0];
        $secondYr="20".$fin_year_arr[1];

        $fromDate=date("Y-m-d", strtotime($fisrtYr."-04-01"));
        $toDate=date("Y-m-d", strtotime($secondYr."-03-31"));
        
        $this->data['fromDate']=$fromDate;
        $this->data['toDate']=$toDate;
        
        $certificateReferenceList = $this->MCertificateReference->where('status', 1)
                                    ->where('certificate_reference_fin_year', $this->sessDueDateYear)
                                    ->orderBy('certificate_reference_date', 'desc')
                                    ->orderBy('certificate_reference_id', 'desc')
                                    ->findAll();

        $this->data['certificateReferenceList']=$certificateReferenceList;

        return view('firm_panel/office_administration/certificate_reference', $this->data);
	}
	
	public function add_certificate_reference()
	{
	    $certificate_reference_no=$this->request->getPost('certificate_reference_no');
	    $certificate_reference_date=$this->request->getPost('certificate_reference_date');
	    $certificate_reference_client=$this->request->getPost('certificate_reference_client');
	    $certificate_reference_subject=$this->request->getPost('certificate_reference_subject');
	    
	    $fin_year_arr=explode("-", $this->sessDueDateYear);

        $fisrtYr=$fin_year_arr[0];
        $secondYr="20".$fin_year_arr[1];
        
        $certificate_reference_date_val=strtotime($certificate_reference_date);
        $fromDate=strtotime($fisrtYr."-04-01");
        $toDate=strtotime($secondYr."-03-31");
        
        if($certificate_reference_date_val>=$fromDate && $certificate_reference_date_val<=$toDate)
        {
    	    $insertArr=[
                'certificate_reference_no' => $certificate_reference_no,
                'certificate_reference_date' => $certificate_reference_date,
                'certificate_reference_client' => $certificate_reference_client,
                'certificate_reference_subject' => $certificate_reference_subject,
                'certificate_reference_fin_year' => $this->sessDueDateYear,
                'status' => 1,
                'createdBy' => $this->adminId,
                'createdDatetime' => $this->currTimeStamp
            ];
    	    
    	    if($this->MCertificateReference->save($insertArr))
    	    {
    	        $insertLogArr['section']=$this->section;
                $insertLogArr['message']=$this->section." Added";
                $insertLogArr['ip']=$this->IPAddress;
                // $insertLogArr['macAddr']=$this->macAddress;
                $insertLogArr['createdBy']=$this->adminId;
                $insertLogArr['createdDatetime']=$this->currTimeStamp;
    
                $this->Mcommon->insertLog($insertLogArr);
                
    	        $this->session->setFlashdata('successMsg', "Certificate Reference has been added successfully :)");
    	    }
    	    else
    	    {
    	        $this->session->setFlashdata('errorMsg', "Certificate Reference has not added :(");
    	    }
        }
	    else
	    {
	        $this->session->setFlashdata('errorMsg', "Please select valid date.");
	    }
	    
	    return redirect()->route('certificate-reference-list');
	}
	
	public function edit_certificate_reference()
	{
	    $certificate_reference_id=$this->request->getPost('certificate_reference_id');
	    $certificate_reference_no=$this->request->getPost('certificate_reference_no');
	    $certificate_reference_date=$this->request->getPost('certificate_reference_date');
	    $certificate_reference_client=$this->request->getPost('certificate_reference_client');
	    $certificate_reference_subject=$this->request->getPost('certificate_reference_subject');
	    
	    $fin_year_arr=explode("-", $this->sessDueDateYear);

        $fisrtYr=$fin_year_arr[0];
        $secondYr="20".$fin_year_arr[1];
        
        $certificate_reference_date_val=strtotime($certificate_reference_date);
        $fromDate=strtotime($fisrtYr."-04-01");
        $toDate=strtotime($secondYr."-03-31");
        
        if($certificate_reference_date_val>=$fromDate && $certificate_reference_date_val<=$toDate)
        {
    	    $updateArr=[
                'certificate_reference_id' => $certificate_reference_id,
                'certificate_reference_no' => $certificate_reference_no,
                'certificate_reference_date' => $certificate_reference_date,
                'certificate_reference_client' => $certificate_reference_client,
                'certificate_reference_subject' => $certificate_reference_subject,
                'updatedBy' => $this->adminId,
                'updatedDatetime' => $this->currTimeStamp
            ];
    	    
    	    if($this->MCertificateReference->save($updateArr))
    	    {
    	        $insertLogArr['section']=$this->section;
                $insertLogArr['message']=$this->section." Updated";
                $insertLogArr['ip']=$this->IPAddress;
                // $insertLogArr['macAddr']=$this->macAddress;
                $insertLogArr['createdBy']=$this->adminId;
                $insertLogArr['createdDatetime']=$this->currTimeStamp;
    
                $this->Mcommon->insertLog($insertLogArr);
                
    	        $this->session->setFlashdata('successMsg', "Certificate Reference has been updated successfully :)");
    	    }
    	    else
    	    {
    	        $this->session->setFlashdata('errorMsg', "Certificate Reference has not updated :(");
    	    }
        }
	    else
	    {
	        $this->session->setFlashdata('errorMsg', "Please select valid date.");
	    }
    	    
	    return redirect()->route('certificate-reference-list');
	}
	
	public function delete_certificate_reference()
	{
	    $certificate_reference_id=$this->request->getPost('certificate_reference_id');
	    
	    $updateArr=[
            'certificate_reference_id' => $certificate_reference_id,
            'status' => 2,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
	    if($this->MCertificateReference->save($updateArr))
	    {
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Deleted";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "Certificate Reference has been deleted successfully :)");
	    }
	    else
	    {
	        $this->session->setFlashdata('errorMsg', "Certificate Reference has not deleted :(");
	    }
	}
	
	public function membership_list()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Membership & Subscriptions";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $membershipList = $this->Mmembership->where('status', 1)->findAll();

        $this->data['membershipList']=$membershipList;

        return view('firm_panel/office_administration/membership_list', $this->data);
	}
	
	public function add_membership()
	{
	    $category=1;
	    $partyName=$this->request->getPost('partyName');
	    $membershipNo=$this->request->getPost('membershipNo');
	    $nameOf=$this->request->getPost('nameOf');
	    
	    $insertArr=[
            'partyName' => $partyName,
            'membershipNo' => $membershipNo,
            'nameOf' => $nameOf,
            'category' => $category,
            'status' => 1,
            'createdBy' => $this->adminId,
            'createdDatetime' => $this->currTimeStamp
        ];
	    
	    if($this->Mmembership->save($insertArr))
	    {
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Added";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "Membership has been added successfully :)");
	    }
	    else
	    {
	        $this->session->setFlashdata('errorMsg', "Membership has not added :(");
	    }
	    
	    return redirect()->route('membership-sub-list');
	}
	
	public function edit_membership()
	{
	    $membershipId=$this->request->getPost('membershipId');
	    $partyName=$this->request->getPost('partyName');
	    $membershipNo=$this->request->getPost('membershipNo');
	    $nameOf=$this->request->getPost('nameOf');
	    
	    $updateArr=[
            'membershipId' => $membershipId,
            'partyName' => $partyName,
            'membershipNo' => $membershipNo,
            'nameOf' => $nameOf,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
	    if($this->Mmembership->save($updateArr))
	    {
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Updated";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "Membership has been updated successfully :)");
	    }
	    else
	    {
	        $this->session->setFlashdata('errorMsg', "Membership has not updated :(");
	    }
    	    
	    return redirect()->route('membership-sub-list');
	}
	
	public function delete_membership()
	{
	    $membershipId=$this->request->getPost('membershipId');
	    
	    $updateArr=[
            'membershipId' => $membershipId,
            'status' => 2,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
	    if($this->Mmembership->save($updateArr))
	    {
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Deleted";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "Membership has been deleted successfully :)");
	    }
	    else
	    {
	        $this->session->setFlashdata('errorMsg', "Membership has not deleted :(");
	    }
	}
	
	public function general_password_list()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="General Passwords";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $generalPasswordList = $this->MgeneralPassword->where('status', 1)->findAll();

        $this->data['generalPasswordList']=$generalPasswordList;

        return view('firm_panel/office_administration/general_password', $this->data);
	}
	
	public function add_general_password()
	{
	    $gen_pass_related_to=$this->request->getPost('gen_pass_related_to');
	    $gen_pass_pertaining_to=$this->request->getPost('gen_pass_pertaining_to');
	    $gen_pass_login=$this->request->getPost('gen_pass_login');
	    $gen_pass_password=$this->request->getPost('gen_pass_password');
	    $gen_pass_remark=$this->request->getPost('gen_pass_remark');
	    
	    $insertArr=[
            'gen_pass_related_to' => $gen_pass_related_to,
            'gen_pass_pertaining_to' => $gen_pass_pertaining_to,
            'gen_pass_login' => $gen_pass_login,
            'gen_pass_password' => $gen_pass_password,
            'gen_pass_remark' => $gen_pass_remark,
            'status' => 1,
            'createdBy' => $this->adminId,
            'createdDatetime' => $this->currTimeStamp
        ];
	    
	    if($this->MgeneralPassword->save($insertArr))
	    {
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Added";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "General Password has been added successfully :)");
	    }
	    else
	    {
	        $this->session->setFlashdata('errorMsg', "General Password has not added :(");
	    }
	    
	    return redirect()->route('general-password-list');
	}
	
	public function edit_general_password()
	{
	    $gen_pass_id=$this->request->getPost('gen_pass_id');
	    $gen_pass_related_to=$this->request->getPost('gen_pass_related_to');
	    $gen_pass_pertaining_to=$this->request->getPost('gen_pass_pertaining_to');
	    $gen_pass_login=$this->request->getPost('gen_pass_login');
	    $gen_pass_password=$this->request->getPost('gen_pass_password');
	    $gen_pass_remark=$this->request->getPost('gen_pass_remark');
	    
	    $updateArr=[
            'gen_pass_id' => $gen_pass_id,
            'gen_pass_related_to' => $gen_pass_related_to,
            'gen_pass_pertaining_to' => $gen_pass_pertaining_to,
            'gen_pass_login' => $gen_pass_login,
            'gen_pass_password' => $gen_pass_password,
            'gen_pass_remark' => $gen_pass_remark,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
	    if($this->MgeneralPassword->save($updateArr))
	    {
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Updated";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "General Password has been updated successfully :)");
	    }
	    else
	    {
	        $this->session->setFlashdata('errorMsg', "General Password has not updated :(");
	    }
    	    
	    return redirect()->route('general-password-list');
	}
	
	public function delete_general_password()
	{
	    $gen_pass_id=$this->request->getPost('gen_pass_id');
	    
	    $updateArr=[
            'gen_pass_id' => $gen_pass_id,
            'status' => 2,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
	    if($this->MgeneralPassword->save($updateArr))
	    {
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Deleted";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "General Password has been deleted successfully :)");
	    }
	    else
	    {
	        $this->session->setFlashdata('errorMsg', "General Password has not deleted :(");
	    }
	}
}
?>
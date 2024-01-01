<?php
namespace App\Controllers;

class Contact extends BaseController
{
    public function __construct()
    {
        $this->data['cssPath']="template/includes/css";
        $this->data['navPath']="template/includes/nav";
        $this->data['footerPath']="template/includes/footer";
        $this->data['scriptPath']="template/includes/scripts";
        $this->data['layoutPath']="template/layouts/main_layout";
        $this->section="Contact";
        
        $this->Mcommon = new \App\Models\Mcommon();
        $this->Mquery = new \App\Models\Mquery();
        $this->Mcashbook = new \App\Models\Mcashbook();
        $this->Mcontgroup = new \App\Models\Mcontgroup();
        $this->Mcontsubgroup = new \App\Models\Mcontsubgroup();
        $this->Mcontact = new \App\Models\Mcontact();
        $this->TableLib = new \App\Libraries\TableLib();
        $this->session = \Config\Services::session();

        $tableArr=$this->TableLib->get_tables();

        $this->cashbook_tbl=$tableArr['cashbook_tbl'];

        $this->sessCaFirmId=$this->session->get('caFirmId');

        $documentsPath=base_url('uploads/ca_firm_'.$this->sessCaFirmId.'/documents');

        $this->data['documentsPath']=$documentsPath;
        
        $currYear=date('Y');
        
        $this->dueYear=$currYear."-".(substr($currYear+1, 2));
        
        $this->data['dueYear']=$this->dueYear;
        
        $currMth=date('n');
        
        $this->data['currMth']=$currMth;
        
        $this->section="Contact";
    }

	public function index()
	{
	    ini_set('memory_limit', '-1');
	    
	    $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Contacts";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $contGrpArr = $this->Mcontgroup->where('status', 1)
                    ->orderBy('cont_group_name', "ASC")
                    ->findAll();
                    
        $this->data['contGrpArr']=$contGrpArr;
        
        $contSubGrpArr = $this->Mcontsubgroup->where('status', 1)
                    ->orderBy('cont_sub_group_name', "ASC")
                    ->findAll();

        $this->data['contSubGrpArr']=$contSubGrpArr;
        
        $queryGroup=$this->request->getGet('group');
        $querySubGroup=$this->request->getGet('sub_group');
        
        $this->data['queryGroup']=$queryGroup;
        $this->data['querySubGroup']=$querySubGroup;
        
        $this->Mcontact->where('status', 1);
        $this->Mcontact->orderBy('contFullName', "ASC");
        
        if(!empty($queryGroup))
            $this->Mcontact->where('contGroupId', $queryGroup);
            
        if(!empty($querySubGroup))
            $this->Mcontact->where('contSubGroupId', $querySubGroup);
            
        $contactArr = $this->Mcontact->findAll();

        $this->data['contactArr']=$contactArr;

        return view('firm_panel/contact/list', $this->data);
	}
	
	public function add()
	{
	    $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Add Contact";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $contGrpArr = $this->Mcontgroup->where('status', 1)
                    ->orderBy('cont_group_name', "ASC")
                    ->findAll();
                    
        $this->data['contGrpArr']=$contGrpArr;
        
        $contSubGrpArr = $this->Mcontsubgroup->where('status', 1)
                    ->orderBy('cont_sub_group_name', "ASC")
                    ->findAll();

        $this->data['contSubGrpArr']=$contSubGrpArr;
        
        $validationRulesArr['contFullName']=['label' => 'Full Name', 'rules' => 'required|trim'];
        
        $contFullNameErr="";
        
        if($this->request->getMethod()=='post')
        {
            if(!$this->validate($validationRulesArr))
            {
                $contFullNameErr=$this->validation->getError('contFullName');
            }
            else
            {
                $contGroupId=$this->request->getPost('contGroupId');
                $contSubGroupId=$this->request->getPost('contSubGroupId');
                $contFullName=$this->request->getPost('contFullName');
                $contOrgName=$this->request->getPost('contOrgName');
                $contMob1=$this->request->getPost('contMob1');
                $contMob2=$this->request->getPost('contMob2');
                $contEmail=$this->request->getPost('contEmail');
                $contResiAddress=$this->request->getPost('contResiAddress');
                $contResiNum=$this->request->getPost('contResiNum');
                $contOfficeAddress=$this->request->getPost('contOfficeAddress');
                $contOfficeNum=$this->request->getPost('contOfficeNum');
                $contRegOffice=$this->request->getPost('contRegOffice');
                $contRegOfficeNum=$this->request->getPost('contRegOfficeNum');
                $contFactOffice=$this->request->getPost('contFactOffice');
                $contFactNum=$this->request->getPost('contFactNum');
                
                $insertArr=[
                    'contGroupId'=>$contGroupId,
                    'contSubGroupId'=>$contSubGroupId,
                    'contFullName'=>$contFullName,
                    'contOrgName'=>$contOrgName,
                    'contMob1'=>$contMob1,
                    'contMob2'=>$contMob2,
                    'contEmail'=>$contEmail,
                    'contResiAddress'=>$contResiAddress,
                    'contResiNum'=>$contResiNum,
                    'contOfficeAddress'=>$contOfficeAddress,
                    'contOfficeNum'=>$contOfficeNum,
                    'contRegOffice'=>$contRegOffice,
                    'contRegOfficeNum'=>$contRegOfficeNum,
                    'contFactOffice'=>$contFactOffice,
                    'contFactNum'=>$contFactNum,
                    'status' => 1,
                    'createdBy' => $this->adminId,
                    'createdDatetime' => $this->currTimeStamp
                ];
        	    
        	    if($this->Mcontact->save($insertArr))
        	    {
        	        $insertLogArr['section']=$this->section;
                    $insertLogArr['message']=$this->section." Added";
                    $insertLogArr['ip']=$this->IPAddress;
                    // $insertLogArr['macAddr']=$this->macAddress;
                    $insertLogArr['createdBy']=$this->adminId;
                    $insertLogArr['createdDatetime']=$this->currTimeStamp;
        
                    $this->Mcommon->insertLog($insertLogArr);
                    
        	        $this->session->setFlashdata('successMsg', $this->section." has been added successfully :)");
        	    }
        	    else
        	    {
        	        $this->session->setFlashdata('errorMsg', $this->section." has not added :(");
        	    }
        	    
        	    return redirect()->route('contactList');
            }
        }
        
        $this->data['contFullNameErr']=$contFullNameErr;

        return view('firm_panel/contact/add', $this->data);
	}
	
	public function edit()
	{
	    $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Edit Contact";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $contGrpArr = $this->Mcontgroup->where('status', 1)
                    ->orderBy('cont_group_name', "ASC")
                    ->findAll();
                    
        $this->data['contGrpArr']=$contGrpArr;
        
        $contSubGrpArr = $this->Mcontsubgroup->where('status', 1)
                    ->orderBy('cont_sub_group_name', "ASC")
                    ->findAll();

        $this->data['contSubGrpArr']=$contSubGrpArr;
        
        $contactId=$this->request->getGet('contactId');
        
        $contactDataArr = $this->Mcontact->where('status', 1)
                    ->where('contactId', $contactId)
                    ->get()
                    ->getRowArray();

        $this->data['contactDataArr']=$contactDataArr;
        
        $validationRulesArr['contFullName']=['label' => 'Full Name', 'rules' => 'required|trim'];
        
        $contFullNameErr="";
        
        if($this->request->getMethod()=='post')
        {
            if(!$this->validate($validationRulesArr))
            {
                $contFullNameErr=$this->validation->getError('contFullName');
            }
            else
            {
                $contactId=$this->request->getPost('contactId');
                $contGroupId=$this->request->getPost('contGroupId');
                $contSubGroupId=$this->request->getPost('contSubGroupId');
                $contFullName=$this->request->getPost('contFullName');
                $contOrgName=$this->request->getPost('contOrgName');
                $contMob1=$this->request->getPost('contMob1');
                $contMob2=$this->request->getPost('contMob2');
                $contEmail=$this->request->getPost('contEmail');
                $contResiAddress=$this->request->getPost('contResiAddress');
                $contResiNum=$this->request->getPost('contResiNum');
                $contOfficeAddress=$this->request->getPost('contOfficeAddress');
                $contOfficeNum=$this->request->getPost('contOfficeNum');
                $contRegOffice=$this->request->getPost('contRegOffice');
                $contRegOfficeNum=$this->request->getPost('contRegOfficeNum');
                $contFactOffice=$this->request->getPost('contFactOffice');
                $contFactNum=$this->request->getPost('contFactNum');
                
                $insertArr=[
                    'contactId'=>$contactId,
                    'contGroupId'=>$contGroupId,
                    'contSubGroupId'=>$contSubGroupId,
                    'contFullName'=>$contFullName,
                    'contOrgName'=>$contOrgName,
                    'contMob1'=>$contMob1,
                    'contMob2'=>$contMob2,
                    'contEmail'=>$contEmail,
                    'contResiAddress'=>$contResiAddress,
                    'contResiNum'=>$contResiNum,
                    'contOfficeAddress'=>$contOfficeAddress,
                    'contOfficeNum'=>$contOfficeNum,
                    'contRegOffice'=>$contRegOffice,
                    'contRegOfficeNum'=>$contRegOfficeNum,
                    'contFactOffice'=>$contFactOffice,
                    'contFactNum'=>$contFactNum,
                    'status' => 1,
                    'createdBy' => $this->adminId,
                    'createdDatetime' => $this->currTimeStamp
                ];
        	    
        	    if($this->Mcontact->save($insertArr))
        	    {
        	        $insertLogArr['section']=$this->section;
                    $insertLogArr['message']=$this->section." Updated";
                    $insertLogArr['ip']=$this->IPAddress;
                    // $insertLogArr['macAddr']=$this->macAddress;
                    $insertLogArr['createdBy']=$this->adminId;
                    $insertLogArr['createdDatetime']=$this->currTimeStamp;
        
                    $this->Mcommon->insertLog($insertLogArr);
                    
        	        $this->session->setFlashdata('successMsg', $this->section." has been updated successfully :)");
        	    }
        	    else
        	    {
        	        $this->session->setFlashdata('errorMsg', $this->section." has not updated :(");
        	    }
        	    
        	    return redirect()->route('contactList');
            }
        }
        
        $this->data['contFullNameErr']=$contFullNameErr;

        return view('firm_panel/contact/edit', $this->data);
	}
	
	public function deleteData()
	{
	    $contactId=$this->request->getPost('contactId');
	    
	    $insertArr=[
            'contactId'=>$contactId,
            'status'=>2,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
	    if($this->Mcontact->save($insertArr))
	    {
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Deleted";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', $this->section." has been deleted successfully :)");
	    }
	    else
	    {
	        $this->session->setFlashdata('errorMsg', $this->section." has not deleted :(");
	    }
	}
}
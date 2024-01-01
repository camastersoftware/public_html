<?php namespace App\Controllers\SuperAdmin;
use \App\Controllers\BaseController;

class Component extends BaseController
{
    public function __construct()
    {
        $this->data['cssPath']="template/includes/css";
        $this->data['navPath']="template/includes/nav";
        $this->data['sidebarPath']="template/includes/sidebar";
        $this->data['footerPath']="template/includes/footer";
        $this->data['scriptPath']="template/includes/scripts";
        $this->data['layoutPath']="template/layouts/main_layout";
        $this->section="Component";
        
        // $this->Mcity = new \App\Models\Mcity();
        // $this->Mstate = new \App\Models\Mstate();
        
        $this->Mdemo = new \App\Models\Mdemo();
        $this->Mfirm = new \App\Models\Mfirm();
        $this->Mfeedback = new \App\Models\Mfeedback();
        $this->TableLib = new \App\Libraries\TableLib();

        $tableArr=$this->TableLib->get_tables();

        $this->feedback_tbl=$tableArr['feedback_tbl'];
    }

	public function dataBank()
	{
	    $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Data Bank";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        return view('super_admin/other/dataBank', $this->data);
	}

	public function subscribers()
	{
	    $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Subscribers";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $firmList=$this->Mfirm->select('ca_firm_tbl.*, states.stateName AS caFirmState, profession_type_tbl.profession_type_name')
            ->join('states', 'states.stateId=ca_firm_tbl.caFirmStateId AND states.status=1', 'left')
            ->join('profession_type_tbl', 'profession_type_tbl.profession_type_id=ca_firm_tbl.caFirmProfession AND profession_type_tbl.status=1', 'left')
            ->where('ca_firm_tbl.status', 1)
            ->where('ca_firm_tbl.caFirmStatus', 1)
            ->where('ca_firm_tbl.isVerified', 1)
            ->where('ca_firm_tbl.isTermsAgree', 1)
            ->where('ca_firm_tbl.caFirmCompanyKey !=', "")
            ->findAll();

        $this->data['firmList']=$firmList;

        return view('super_admin/other/subscribers', $this->data);
	}

	public function feedbackReport()
	{
	    $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Feedback Report";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $feedbackList=$this->Mfeedback->select('feedback_tbl.*, ca_firm_tbl.caFirmName, ca_firm_tbl.caFirmCompanyKey')
            ->join('ca_firm_tbl', 'feedback_tbl.fkFirmId=ca_firm_tbl.caFirmId', 'left')
            ->where('feedback_tbl.status', 1)
            ->orderBy('feedback_tbl.createdDatetime', "DESC")
            ->findAll();

        $this->data['feedbackList']=$feedbackList;

        return view('super_admin/other/feedbackReport', $this->data);
	}

	public function feedbackView($feedbackId)
	{
	    $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Feedback Report View";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $feedbackData=$this->Mfeedback->select('feedback_tbl.*, ca_firm_tbl.caFirmName, ca_firm_tbl.caFirmCompanyKey')
            ->join('ca_firm_tbl', 'feedback_tbl.fkFirmId=ca_firm_tbl.caFirmId', 'left')
            ->where('feedback_tbl.feedbackId', $feedbackId)
            ->where('feedback_tbl.status', 1)
            ->get()
            ->getRowArray();

        $this->data['feedbackData']=$feedbackData;

        return view('super_admin/other/feedbackView', $this->data);
	}

	public function referncer()
	{
	    $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Referncer";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        return view('super_admin/other/referncer', $this->data);
	}
	
	public function demo_requests()
	{
	    $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Demo Requests";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        $demoReqList = $this->Mdemo->where('status', 1)
                    ->orderBy('demoReqDateTime', 'DESC')
                    ->findAll();

        $this->data['demoReqList']=$demoReqList;

        return view('super_admin/other/demo_requests', $this->data);
	}
	
	public function replyDemo()
	{
	    $this->db->transBegin();
	    
	    $this->section="Demo Requests";
	    
	    $demoReqId=$this->request->getPost('demoReqId');
	    
	     $insertArr=[
            'demoReqId'=>$demoReqId,
            'isReplied' => 1,
            'replyDateTime'=>date('Y-m-d H:i:s'),
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
        
        $this->Mdemo->save($insertArr);
	    
	    if($this->db->transStatus() === FALSE){
            
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong, Please try again.");

        }else{

            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Replied";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Replied Successfully :)");
        }
	}
	
	public function deleteDemo()
	{
	    $this->db->transBegin();
	    
	    $this->section="Demo Requests";
	    
	    $demoReqId=$this->request->getPost('demoReqId');
	    
	     $insertArr=[
	        'demoReqId'=>$demoReqId,
            'status' => 2,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
        
        $this->Mdemo->save($insertArr);
	    
	    if($this->db->transStatus() === FALSE){
            
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong, Please try again.");

        }else{

            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Replied";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Demo Request has been deleted successfully :)");
        }
	}
	
	public function deleteFeedback()
	{
	    $this->db->transBegin();
	    
	    $this->section="Feedback";
	    
	    $feedbackId=$this->request->getPost('feedbackId');
	    
	     $insertArr=[
	        'feedbackId'=>$feedbackId,
            'status' => 2,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
        
        $this->Mfeedback->save($insertArr);
	    
	    if($this->db->transStatus() === FALSE){
            
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Something went wrong, Please try again.");

        }else{

            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." deleted";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Feedback has been deleted successfully :)");
        }
	}
}

?>
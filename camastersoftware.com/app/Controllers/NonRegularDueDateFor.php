<?php
namespace App\Controllers;

class NonRegularDueDateFor extends BaseController
{
    public function __construct()
    {
        $this->data['cssPath']="template/includes/css";
        $this->data['navPath']="template/includes/nav";
        $this->data['footerPath']="template/includes/footer";
        $this->data['scriptPath']="template/includes/scripts";
        $this->data['layoutPath']="template/layouts/main_layout";
        $this->section="Non-Regular Due Date For";
        
        $this->Mcommon = new \App\Models\Mcommon();
        $this->Mquery = new \App\Models\Mquery();
        $this->Mact = new \App\Models\Mact();
        $this->MNonRegularDueDateFor = new \App\Models\MNonRegularDueDateFor();
        $this->TableLib = new \App\Libraries\TableLib();
        $this->session = \Config\Services::session();

        $tableArr=$this->TableLib->get_tables();

        $this->act_tbl=$tableArr['act_tbl'];
        $this->non_regular_due_date_for_tbl=$tableArr['non_regular_due_date_for_tbl'];

        $this->sessCaFirmId=$this->session->get('caFirmId');

        $documentsPath=base_url('uploads/ca_firm_'.$this->sessCaFirmId.'/documents');

        $this->data['documentsPath']=$documentsPath;
    }
	
	public function index()
    {
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Non-Regular Due Date For List";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        $actArr = $this->Mact->where('status', 1)
                    ->findAll();

        $this->data['actArr']=$actArr;


        $nonRegDDFCondtnArr['non_regular_due_date_for_tbl.status']=1;

        $nonRegDDFJoinArr[]=array("tbl"=>$this->act_tbl, "condtn"=>"act_tbl.act_id=non_regular_due_date_for_tbl.fkActId AND act_tbl.status=1", "type"=>"left");

        $queryColNames = "
            non_regular_due_date_for_tbl.non_regular_due_date_for_id,
            non_regular_due_date_for_tbl.non_regular_due_date_for_name,
            non_regular_due_date_for_tbl.fkActId,
            act_tbl.act_name
        ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->non_regular_due_date_for_tbl, $colNames=$queryColNames, $nonRegDDFCondtnArr, $likeCondtnArr=array(), $nonRegDDFJoinArr, $singleRow=FALSE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $nonRegDDFArr=$query['userData'];

        $this->data['nonRegDDFArr']=$nonRegDDFArr;

        return view('firm_panel/non_regular_due_date_for/list', $this->data);
    }

	public function add()
	{
	    $non_regular_due_date_for_name=$this->request->getPost('non_regular_due_date_for_name');
	    $fkActId=$this->request->getPost('fkActId');
	    
	    $insertArr=[
            'non_regular_due_date_for_name'=>$non_regular_due_date_for_name,
            'fkActId'=>$fkActId,
            'status' => 1,
            'createdBy' => $this->adminId,
            'createdDatetime' => $this->currTimeStamp
        ];
	    
	    if($this->MNonRegularDueDateFor->save($insertArr))
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
	    
	    return redirect()->route('non-regular-due-date-for-list');
	}
	
	public function updateData()
	{
	    $this->db->transBegin();
	    
	    $non_regular_due_date_for_id=$this->request->getPost('non_regular_due_date_for_id');
        $non_regular_due_date_for_name=$this->request->getPost('non_regular_due_date_for_name');
	    $fkActId=$this->request->getPost('fkActId');
	    
	    $insertArr=[
            'non_regular_due_date_for_id'=>$non_regular_due_date_for_id,
            'non_regular_due_date_for_name'=>$non_regular_due_date_for_name,
            'fkActId'=>$fkActId,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
	    $this->MNonRegularDueDateFor->save($insertArr);
	    
	    if($this->db->transStatus() === FALSE)
	    {
	        $this->db->transRollback();
	        
	        $this->session->setFlashdata('errorMsg', $this->section." has not updated :(");
	    }
	    else
	    {
	        $this->db->transCommit();
	        
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Updated";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', $this->section." has been updated successfully :)");
	    }
	    
	    return redirect()->route('non-regular-due-date-for-list');
	}
	
	public function deleteData()
	{
	    $non_regular_due_date_for_id=$this->request->getPost('non_regular_due_date_for_id');
	    
	    $insertArr=[
            'non_regular_due_date_for_id'=>$non_regular_due_date_for_id,
            'status'=>2,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
	    if($this->MNonRegularDueDateFor->save($insertArr))
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

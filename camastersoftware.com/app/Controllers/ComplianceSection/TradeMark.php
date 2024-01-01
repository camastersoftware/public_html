<?php namespace App\Controllers\ComplianceSection;
use \App\Controllers\BaseController;

class TradeMark extends BaseController
{
    public function __construct()
    {
        $this->data['cssPath']="template/includes/css";
        $this->data['navPath']="template/includes/nav";
        $this->data['footerPath']="template/includes/footer";
        $this->data['scriptPath']="template/includes/scripts";
        $this->data['layoutPath']="template/layouts/main_layout";
        $this->section="Trade Mark";
        
        $this->Mquery = new \App\Models\Mquery();
        $this->Mgroup = new \App\Models\Mgroup();
        $this->Mtrademark = new \App\Models\Mtrademark();
        $this->TableLib = new \App\Libraries\TableLib();

        $tableArr=$this->TableLib->get_tables();

        $this->client_tbl=$tableArr['client_tbl'];
        $this->client_group_tbl=$tableArr['client_group_tbl'];
        $this->organisation_type_tbl=$tableArr['organisation_type_tbl'];
        $this->trade_mark_tbl=$tableArr['trade_mark_tbl'];
        
        $currMth=date('n');
        
        $this->data['currMth']=$currMth;
    }

	public function index()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'select2.full');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Trade Mark";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $getClientList=array();
        
        $clientCondtnArr['client_tbl.status']=1;
        $clientCondtnArr['client_tbl.isOldClient']=2;
        
        // $clientWhereInArray['client_tbl.clientBussOrganisationType']=INDIVIDUAL_ARRAY;
        
        $clientOrderByArr['client_group_tbl.client_group_number']="ASC";
        $clientOrderByArr['organisation_type_tbl.sortingBy']="ASC";
        
        $clientJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $clientJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->client_tbl, $colNames="client_tbl.clientId, client_tbl.clientBussOrganisation, client_tbl.clientName, client_tbl.clientBussOrganisationType AS orgType", $clientCondtnArr, $likeCondtnArr=array(), $clientJoinArr, $singleRow=FALSE, $clientOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $clientList=$query['userData'];
        
        $this->data['clientList']=$clientList;
        
        $tmCondtnArr['client_tbl.status']=1;
        $tmCondtnArr['client_tbl.isOldClient']=2;
        $tmOrderByArr['client_group_tbl.client_group_number']="ASC";
        $tmOrderByArr['organisation_type_tbl.sortingBy']="ASC";
        
        $tmJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>"trade_mark_tbl.fkClientId=client_tbl.clientId AND trade_mark_tbl.status=1", "type"=>"left");
        $tmJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $tmJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        
        $columnNames = "
            client_tbl.clientId,
            client_tbl.clientBussOrganisation,
            client_tbl.clientTitle,
            client_tbl.clientName,
            client_tbl.clientGroup,
            client_tbl.clientBussOrganisationType AS orgType,
            client_group_tbl.client_group,
            client_group_tbl.client_group_number,
            organisation_type_tbl.organisation_type_name,
            organisation_type_tbl.shortName,
            trade_mark_tbl.tmId,
            trade_mark_tbl.fkClientId,
            trade_mark_tbl.tradeMark,
            trade_mark_tbl.tmClass,
            trade_mark_tbl.tmNo,
            trade_mark_tbl.tmDate,
            trade_mark_tbl.tmApprovedOn,
            trade_mark_tbl.tmAdvertisedOn,
            trade_mark_tbl.tmRegisteredOn,
            trade_mark_tbl.tmValidUpto,
            trade_mark_tbl.tmRemarks,
            trade_mark_tbl.isDiscontinued,
            trade_mark_tbl.isReject
        ";
        
        $query=$this->Mcommon->getRecords($tableName=$this->trade_mark_tbl, $colNames=$columnNames, $tmCondtnArr, $likeCondtnArr=array(), $tmJoinArr, $singleRow=FALSE, $tmOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getClientList=$query['userData'];
        
        $this->data['getClientList']=$getClientList;
        
        $currentDate = date('Y-m-d');
        
        $this->data['currentDate']=$currentDate;

        return view('firm_panel/compliance/trade_mark/list', $this->data);
    }
	
	public function add_trade_mark()
	{
	    $fkClientId=$this->request->getPost('fkClientId');
	    $tradeMark=$this->request->getPost('tradeMark');
	    $tmClass=$this->request->getPost('tmClass');
	    $tmNo = $this->request->getPost('tmNo');
	    $tmDate = $this->request->getPost('tmDate');
	    $tmApprovedOn = $this->request->getPost('tmApprovedOn');
	    $tmAdvertisedOn = $this->request->getPost('tmAdvertisedOn');
	    $tmRegisteredOn = $this->request->getPost('tmRegisteredOn');
	    $tmValidUpto = $this->request->getPost('tmValidUpto');
	    $tmRemarks = $this->request->getPost('tmRemarks');
	    
	    $insertArr=[
            'fkClientId'        =>  $fkClientId,
            'tradeMark'         =>  $tradeMark,
            'tmClass'           =>  $tmClass,
            'tmNo'              =>  $tmNo,
            'tmDate'            =>  $tmDate,
            'tmApprovedOn'      =>  $tmApprovedOn,
            'tmAdvertisedOn'    =>  $tmAdvertisedOn,
            'tmRegisteredOn'    =>  $tmRegisteredOn,
            'tmValidUpto'       =>  $tmValidUpto,
            'tmRemarks'         =>  $tmRemarks,
            'isDiscontinued'    =>  2,
            'status'            =>  1,
            'createdBy'         =>  $this->adminId,
            'createdDatetime'   =>  $this->currTimeStamp
        ];
	    
	    if($this->Mtrademark->save($insertArr))
	    {
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Added";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "Trade Mark of Client has been added successfully :)");
	    }
	    else
	    {
	        $this->session->setFlashdata('errorMsg', "Trade Mark of Client has not added :(");
	    }
	    
	    return redirect()->route('trade-mark');
	}
	
	public function edit_trade_mark()
	{
	    $tmId=$this->request->getPost('tmId');
	    $fkClientId=$this->request->getPost('fkClientId');
	    $tradeMark=$this->request->getPost('tradeMark');
	    $tmClass=$this->request->getPost('tmClass');
	    $tmNo = $this->request->getPost('tmNo');
	    $tmDate = $this->request->getPost('tmDate');
	    $tmApprovedOn = $this->request->getPost('tmApprovedOn');
	    $tmAdvertisedOn = $this->request->getPost('tmAdvertisedOn');
	    $tmRegisteredOn = $this->request->getPost('tmRegisteredOn');
	    $tmValidUpto = $this->request->getPost('tmValidUpto');
	    $tmRemarks = $this->request->getPost('tmRemarks');
	    
	    $insertArr=[
            'tmId'              =>  $tmId,
            'fkClientId'        =>  $fkClientId,
            'tradeMark'         =>  $tradeMark,
            'tmClass'           =>  $tmClass,
            'tmNo'              =>  $tmNo,
            'tmDate'            =>  $tmDate,
            'tmApprovedOn'      =>  $tmApprovedOn,
            'tmAdvertisedOn'    =>  $tmAdvertisedOn,
            'tmRegisteredOn'    =>  $tmRegisteredOn,
            'tmValidUpto'       =>  $tmValidUpto,
            'tmRemarks'         =>  $tmRemarks,
            'isDiscontinued'    =>  2,
            'isReject'          =>  2,
            'status'            =>  1,
            'createdBy'         =>  $this->adminId,
            'createdDatetime'   =>  $this->currTimeStamp
        ];
	    
	    if($this->Mtrademark->save($insertArr))
	    {
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Updated";
            $insertLogArr['ip']=$this->IPAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "Trade Mark of Client has been updated successfully :)");
	    }
	    else
	    {
	        $this->session->setFlashdata('errorMsg', "Trade Mark of Client has not updated :(");
	    }
    	    
	    return redirect()->route('trade-mark');
	}
	
	public function discontinue_trade_mark()
	{
	    $tmId=$this->request->getPost('tmId');
	    
	    $insertArr=[
            'tmId'              => $tmId,
            'isDiscontinued'    => 1,
            'updatedBy'         => $this->adminId,
            'updatedDatetime'   => $this->currTimeStamp
        ];
	    
	    if($this->Mtrademark->save($insertArr))
	    {
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Discontinued";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "Trade Mark of Client has been discontinued successfully :)");
	    }
	    else
	    {
	        $this->session->setFlashdata('errorMsg', "Trade Mark of Client has not discontinue :(");
	    }
	}
	
	public function continue_trade_mark()
	{
	    $tmId=$this->request->getPost('tmId');
	    
	    $insertArr=[
            'tmId'              => $tmId,
            'isDiscontinued'    => 2,
            'isReject'          => 2,
            'updatedBy'         => $this->adminId,
            'updatedDatetime'   => $this->currTimeStamp
        ];
	    
	    if($this->Mtrademark->save($insertArr))
	    {
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Continued";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "Trade Mark of Client has been continued successfully :)");
	    }
	    else
	    {
	        $this->session->setFlashdata('errorMsg', "Trade Mark of Client has not continue :(");
	    }
	}
	
	public function reject_trade_mark()
	{
	    $tmId=$this->request->getPost('tmId');
	    
	    $insertArr=[
            'tmId'              => $tmId,
            'isReject'          => 1,
            'updatedBy'         => $this->adminId,
            'updatedDatetime'   => $this->currTimeStamp
        ];
	    
	    if($this->Mtrademark->save($insertArr))
	    {
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Rejected";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "Trade Mark of Client has been Rejected :)");
	    }
	    else
	    {
	        $this->session->setFlashdata('errorMsg', "Trade Mark of Client has not Rejected :(");
	    }
	}
	
	public function delete_trade_mark()
	{
	    $tmId=$this->request->getPost('tmId');
	    
	    $insertArr=[
            'tmId'              => $tmId,
            'status'            => 2,
            'updatedBy'         => $this->adminId,
            'updatedDatetime'   => $this->currTimeStamp
        ];
	    
	    if($this->Mtrademark->save($insertArr))
	    {
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Deleted";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "Trade Mark of Client has been deleted successfully :)");
	    }
	    else
	    {
	        $this->session->setFlashdata('errorMsg', "Trade Mark of Client has not deleted :(");
	    }
	}
}
?>
<?php

namespace App\Controllers;

class Utility extends BaseController
{
    public function __construct()
    {   
        $this->MstaffTypes = new \App\Models\MstaffTypes();
        $this->Mgroup = new \App\Models\Mgroup();
        $this->Mcontsubgroup = new \App\Models\Mcontsubgroup();
        $this->Mclient = new \App\Models\Mclient();
        $this->Muser = new \App\Models\Muser();
        $this->Mcontact = new \App\Models\Mcontact();
        $this->Mcommon = new \App\Models\Mcommon();
        $this->TableLib = new \App\Libraries\TableLib();

        $tableArr=$this->TableLib->get_tables();

        $this->ext_due_date_master_tbl=$tableArr['ext_due_date_master_tbl'];
        $this->work_tbl=$tableArr['work_tbl'];
        $this->work_junior_map_tbl=$tableArr['work_junior_map_tbl'];
        $this->user_tbl=$tableArr['user_tbl'];
        $this->client_tbl=$tableArr['client_tbl'];
        $this->client_document_map_tbl=$tableArr['client_document_map_tbl'];
    }
    
    public function insertGrp()
	{
	    die('Access Denied....');
	    $clientArr=$this->Mgroup->where('status', 1)->findAll();
	    $staffArr=$this->MstaffTypes->where('status', 1)->findAll();
	    
	    print_r('Transferring Subgroup....');
	    
	    if(!empty($clientArr))
	    {
	        foreach($clientArr AS $e_row)
	        {
	            $insertArr=[
                    'cont_sub_group_name'=>$e_row['client_group'],
                    'fk_cont_group_id'=>1,
                    'refId'=>$e_row['client_group_id'],
                    'status' => 1,
                    'createdBy' => $this->adminId,
                    'createdDatetime' => $this->currTimeStamp
                ];
        	    
        	    $this->Mcontsubgroup->save($insertArr);
	        }
	    }
	    
	    if(!empty($staffArr))
	    {
	        foreach($staffArr AS $e_row)
	        {
	            $insertArr=[
                    'cont_sub_group_name'=>$e_row['staff_type_name'],
                    'fk_cont_group_id'=>2,
                    'refId'=>$e_row['staff_type_id'],
                    'status' => 1,
                    'createdBy' => $this->adminId,
                    'createdDatetime' => $this->currTimeStamp
                ];
        	    
        	    $this->Mcontsubgroup->save($insertArr);
	        }
	    }
	    echo "<br>";
	    echo "<br>";
	    print_r('End');
	    
	}
	
	public function insertClients()
	{
	    die('Access Denied....');
	    $this->db->transBegin();
	    
	    print_r('Transferring Clients Data to Contacts....');
	    
	    $sbGrpArr=$this->Mcontsubgroup->where('fk_cont_group_id', 1)->findAll();
	    
	    $sbGrpArray=array();
	    
	    if(!empty($sbGrpArr))
	    {
	        foreach($sbGrpArr AS $e_row)
	        {
	            $sbGrpArray[$e_row['refId']]=$e_row['cont_sub_group_id'];
	        }
	    }
	    
	    $clientArr=$this->Mclient->where('status', 1)->findAll();
	    
	   // print_r($clientArr);
	   // die();
	    
	    if(!empty($clientArr))
	    {
	        foreach($clientArr AS $e_row)
	        {
	            $contGroupId=1;
	            
	            if(!empty($sbGrpArray[$e_row['clientGroup']]))
                    $contSubGroupId=$sbGrpArray[$e_row['clientGroup']];
                else
                    $contSubGroupId="";
                
                if($e_row['clientBussOrganisationType']==9) //Individual
                {
                    $contFullName=$e_row['clientName'];
                    $contOrgName="";
                    $contMob1=$e_row['clientMobile1'];
                    $contMob2=$e_row['clientMobile2'];
                    $contEmail=$e_row['clientEmail1'];
                    $contResiAddress=$e_row['clientResidentialAddress'];
                    $contResiNum=$e_row['clientResidencePhone'];
                    $contOfficeAddress="";
                    $contOfficeNum=$e_row['clientOfficePhone1'];
                    $contRegOffice="";
                    $contRegOfficeNum=$e_row['clientResidencePhone'];
                    $contFactOffice="";
                    $contFactNum=$e_row['clientFactoryPhone'];
                    $contRefId=$e_row['clientId'];
                }
                else // Company
                {
                    $contFullName=$e_row['clientContactPerson'];
                    $contOrgName=$e_row['clientBussOrganisation'];
                    $contMob1=$e_row['clientBussMobile1'];
                    $contMob2=$e_row['clientBussMobile2'];
                    $contEmail=$e_row['clientBussEmail1'];
                    $contResiAddress="";
                    $contResiNum=$e_row['clientBussResidencePhone'];
                    $contOfficeAddress=$e_row['clientBussOfficeAddress'];
                    $contOfficeNum=$e_row['clientBussOfficePhone1'];
                    $contRegOffice=$e_row['clientBussRegisteredAddress'];
                    $contRegOfficeNum=$e_row['clientResidencePhone'];
                    $contFactOffice=$e_row['clientBussFactoryAddress'];
                    $contFactNum=$e_row['clientBussFactoryPhone'];
                    $contRefId=$e_row['clientId'];
                }
                
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
                    'contRefId'=>$contRefId,
                    'status' => 1,
                    'createdBy' => $this->adminId,
                    'createdDatetime' => $this->currTimeStamp
                ];
        	    
        	    $this->Mcontact->save($insertArr);
	        }
	    }
	    
	    echo "<br>";
	    
	    if($this->db->transStatus() === FALSE){
            $this->db->transRollback();
            echo "Something went wrong!!";
        }else{
            $this->db->transCommit();
	        echo "End";
        }
	}
	
	public function insertStaff()
	{
	    die('Access Denied....');
	    $this->db->transBegin();
	    
	    print_r('Transferring Staff Data to Contacts....');
	    
	    $sbGrpArr=$this->Mcontsubgroup->where('fk_cont_group_id', 2)->findAll();
	    
	    $sbGrpArray=array();
	    
	    if(!empty($sbGrpArr))
	    {
	        foreach($sbGrpArr AS $e_row)
	        {
	            $sbGrpArray[$e_row['refId']]=$e_row['cont_sub_group_id'];
	        }
	    }
	    
	    $staffDataArr=$this->Muser->where('status', 1)->findAll();
	    
	    if(!empty($staffDataArr))
	    {
	        foreach($staffDataArr AS $e_row)
	        {
	            $contGroupId=2;
	            
	            if(!empty($sbGrpArray[$e_row['userStaffType']]))
                    $contSubGroupId=$sbGrpArray[$e_row['userStaffType']];
                else
                    $contSubGroupId="";
                
                $contFullName=$e_row['userFullName'];
                $contOrgName=$this->sessCaFirmName;
                $contMob1=$e_row['userMobile1'];
                $contMob2=$e_row['userMobileWhatsApp'];
                $contEmail=$e_row['userEmail1'];
                $contResiAddress=$e_row['userResidenceAddress'];
                $contResiNum=$e_row['userResidencePhone'];
                $contOfficeAddress="";
                $contOfficeNum=$e_row['userOfficePhone'];
                $contRegOffice="";
                $contRegOfficeNum="";
                $contFactOffice="";
                $contFactNum="";
                $contRefId=$e_row['userId'];
                
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
                    'contRefId'=>$contRefId,
                    'status' => 1,
                    'createdBy' => $this->adminId,
                    'createdDatetime' => $this->currTimeStamp
                ];
        	    
        	    $this->Mcontact->save($insertArr);
	        }
	    }
	    
	    echo "<br>";
	    
	    if($this->db->transStatus() === FALSE){
            $this->db->transRollback();
            echo "Something went wrong!!";
        }else{
            $this->db->transCommit();
	        echo "End";
        }
	}

	public function patch_due_dates()
	{
        die('Access Denied....');
        $this->db->transBegin();

        $taxCondtnArr['due_date_master_tbl.status']=1;
        $taxOrderByArr['due_date_master_tbl.due_date']="ASC";
        
        $query=$this->Mcommon->getRecords($tableName="due_date_master_tbl", $colNames="due_date_master_tbl.*", $taxCondtnArr, $likeCondtnArr=array(), $taxJoinArr=array(), $singleRow=FALSE, $taxOrderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $dueDatesArr=$query['userData'];

        if(!empty($dueDatesArr))
        {
            foreach($dueDatesArr AS $e_data)
            {
                if($e_data['ext_due_date']=="" || $e_data['ext_due_date']=="1970-01-01")
                {
                    $extDueDateInsertArr[] = [
                        'fk_due_date_master_id'=>$e_data['due_date_id'],
                        'extended_date'=>$e_data['due_date'],
                        'is_extended'=>2,
                        'status' => 1,
                        'createdBy' => $this->adminId,
                        'createdDatetime' => $this->currTimeStamp
                    ];
                }
                else
                {
                    $extDueDateInsertArr[] = [
                        'fk_due_date_master_id'=>$e_data['due_date_id'],
                        'extended_date'=>$e_data['ext_due_date'],
                        'is_extended'=>1,
                        'status' => 1,
                        'createdBy' => $this->adminId,
                        'createdDatetime' => $this->currTimeStamp
                    ];
                }
            }
        }
        
        // print_r($extDueDateInsertArr);
        // die();

        $resQuery="";

        if(!empty($extDueDateInsertArr))
        {
            $query=$this->Mcommon->insert($tableName=$this->ext_due_date_master_tbl, $extDueDateInsertArr, $returnType="");

            $resQuery=$query['status'];
        }
        

        if($resQuery=="")
        {
            echo "No data found";
            die();
        }
        if($this->db->transStatus() === FALSE){
            $this->db->transRollback();
            echo "Something went wrong!!";
        }else{
            $this->db->transCommit();
            echo "Due Date has been added successfully :)";
        }
        die();
    }

	public function patch_work_form()
	{
        die('Access Denied....');
        $this->db->transBegin();

        $wkCondtnArr['work_tbl.status']=1;
        
        $query=$this->Mcommon->getRecords($tableName=$this->work_tbl, $colNames="work_tbl.*", $wkCondtnArr, $likeCondtnArr=array(), $taxJoinArr=array(), $singleRow=FALSE, $taxOrderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $workArr=$query['userData'];

        if(!empty($workArr))
        {
            foreach($workArr AS $e_data)
            {
                if(!empty($e_data['juniors']))
                {
                    $wkMpCondtnArr=array();
                    $userCondtnArr=array();
                    $userWhereInArray=array();
                    $workCondtnArr=array();

                    $wkMpCondtnArr['work_junior_map_tbl.fkWorkId']=$e_data['workId'];
                    $wkMpCondtnArr['work_junior_map_tbl.status']=1;
        
                    $query=$this->Mcommon->getRecords($tableName=$this->work_junior_map_tbl, $colNames="work_junior_map_tbl.fkUserId", $wkMpCondtnArr, $likeCondtnArr=array(), $taxJoinArr=array(), $singleRow=FALSE, $taxOrderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());

                    $workMapArr=$query['userData'];

                    if(!empty($workMapArr))
                    {
                        $wkJnrArr=array_column($workMapArr, 'fkUserId');

                        $userCondtnArr['user_tbl.status']=1;
                        $userWhereInArray['user_tbl.userId']=$wkJnrArr;
        
                        $query=$this->Mcommon->getRecords($tableName=$this->user_tbl, $colNames="user_tbl.userShortName", $userCondtnArr, $likeCondtnArr=array(), $taxJoinArr=array(), $singleRow=FALSE, $taxOrderByArr=array(), $groupByArr=array(), $userWhereInArray, $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
                        
                        $userArr=$query['userData'];

                        if(!empty($userArr))
                        {
                            $userNameArr=array_column($userArr, 'userShortName');

                            $userNameStr=implode(", ", $userNameArr);

                            $workUpdateArr = [
                                'juniors'=>$userNameStr,
                                'updatedBy' => $this->adminId,
                                'updatedDatetime' => $this->currTimeStamp
                            ];
                
                            $workCondtnArr['work_tbl.workId']=$e_data['workId'];
                
                            $query=$this->Mcommon->updateData($tableName=$this->work_tbl, $workUpdateArr, $workCondtnArr, $likeCondtnArr=array(), $whereInArray=array());

                            $wkMpCondtnArr=array();
                            $userCondtnArr=array();
                            $userWhereInArray=array();
                            $workCondtnArr=array();
                        }
                    }
                }
            }
        }

        if($this->db->transStatus() === FALSE){
            $this->db->transRollback();
            echo "Something went wrong!!";
        }else{
            $this->db->transCommit();
            echo "Work Juniors Names has been added successfully :)";
        }
        die();
    }

	public function patch_client_pan()
	{
        die('Access Denied....');
        $this->db->transBegin();

        $docCondtnArr['client_document_map_tbl.status']=1;
        $docCondtnArr['client_document_map_tbl.fk_client_document_id']=1;
        
        $query=$this->Mcommon->getRecords($tableName=$this->client_document_map_tbl, $colNames="client_document_map_tbl.*", $docCondtnArr, $likeCondtnArr=array(), $taxJoinArr=array(), $singleRow=FALSE, $taxOrderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $docArr=$query['userData'];

        if(!empty($docArr))
        {
            foreach($docArr AS $e_data)
            {
                if(!empty($e_data['client_document_number']))
                {
                    $cliUpdateArr = [
                        'clientPanNumber'=>$e_data['client_document_number'],
                        'updatedBy' => $this->adminId,
                        'updatedDatetime' => $this->currTimeStamp
                    ];
        
                    $cliCondtnArr['client_tbl.clientId']=$e_data['fk_client_id'];

                    $query=$this->Mcommon->updateData($tableName=$this->client_tbl, $cliUpdateArr, $cliCondtnArr, $likeCondtnArr=array(), $whereInArray=array());
                }
            }
        }

        if($this->db->transStatus() === FALSE){
            $this->db->transRollback();
            echo "Something went wrong!!";
        }else{
            $this->db->transCommit();
            echo "Client Pan has been added successfully :)";
        }
        die();
    }

    public function patch_ext_due_dates()
	{
        // die('Access Denied....');
        $this->db->transBegin();

        $taxCondtnArr['ext_due_date_master_tbl.status']=1;
        $taxOrderByArr['ext_due_date_master_tbl.fk_due_date_master_id']="ASC";
        $taxOrderByArr['ext_due_date_master_tbl.ext_due_date_master_id']="ASC";
        // $taxOrderByArr['ext_due_date_master_tbl.extended_date']="ASC";
        
        $query=$this->Mcommon->getRecords($tableName=$this->ext_due_date_master_tbl, $colNames="ext_due_date_master_tbl.*", $taxCondtnArr, $likeCondtnArr=array(), $taxJoinArr=array(), $singleRow=FALSE, $taxOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $dueDatesArr=$query['userData'];
        
        print_r($dueDatesArr);
        die();

        if(!empty($dueDatesArr))
        {
            foreach($dueDatesArr AS $k_data=>$e_data)
            {
                $extDateUpdateArr=array();
                $extDateCondtnArr=array();

                if($e_data['is_extended']==1)
                {
                    $k_data_val=$k_data+1;
                    if(isset($dueDatesArr[$k_data_val]))
                    {
                        $nextDueDateArr=$dueDatesArr[$k_data_val];

                        if($e_data['fk_due_date_master_id']==$nextDueDateArr['fk_due_date_master_id'])
                        {
                            $nextDueDate=$nextDueDateArr['extended_date'];
                            if($nextDueDate!="" && $nextDueDate!="1970-01-01"  && $nextDueDate!="0000-00-00")
                            {
                                $extDateUpdateArr = [
                                    'next_extended_date'=>$nextDueDate,
                                    'updatedBy' => $this->adminId,
                                    'updatedDatetime' => $this->currTimeStamp
                                ];
                    
                                $extDateCondtnArr['ext_due_date_master_tbl.ext_due_date_master_id']=$e_data['ext_due_date_master_id'];
                                $extDateCondtnArr['ext_due_date_master_tbl.fk_due_date_master_id']=$e_data['fk_due_date_master_id'];
        
                                $query=$this->Mcommon->updateData($tableName=$this->ext_due_date_master_tbl, $extDateUpdateArr, $extDateCondtnArr, $likeCondtnArr=array(), $whereInArray=array());
                            }
                        }
                    }
                }
            }
        }
        
        if($this->db->transStatus() === FALSE){
            $this->db->transRollback();
            echo "Something went wrong!!";
        }else{
            $this->db->transCommit();
            echo "Extended Due Date has been updated successfully :)";
        }
        die();
        

    }
    
    public function patch_due_date_new()
	{
        // die('Access Denied....');
        $this->db->transBegin();

        $taxCondtnArr['due_date_master_tbl.status']=1;
        $taxCondtnArr['due_date_master_tbl.isExt']=1;
        $taxOrderByArr['due_date_master_tbl.due_date_id']="ASC";
        // $taxOrderByArr['due_date_master_tbl.due_date']="ASC";
        
        $taxJoinArr[]=array("tbl"=>"due_date_master_tbl", "condtn"=>"ext_due_date_master_tbl.fk_due_date_master_id=due_date_master_tbl.due_date_id AND ext_due_date_master_tbl.status=1", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->ext_due_date_master_tbl, $colNames="due_date_master_tbl.*, ext_due_date_master_id, fk_due_date_master_id, ext_due_date_master_tbl.extended_date, ext_due_date_master_tbl.is_extended, ext_due_date_master_tbl.isFirst, ext_due_date_master_tbl.next_extended_date", $taxCondtnArr, $likeCondtnArr=array(), $taxJoinArr, $singleRow=FALSE, $taxOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $dueDatesArr=$query['userData'];
        
        // print_r($dueDatesArr);
        // die();
        
        $extDueDateInsertArr1=array();

        if(!empty($dueDatesArr))
        {
            foreach($dueDatesArr AS $e_data)
            {
                if($e_data['due_date']!="" && $e_data['due_date']!="1970-01-01" && $e_data['due_date']!="0000-00-00")
                {
                    // $extDueDateInsertArr[] = [
                    //     'fk_due_date_master_id'=>$e_data['due_date_id'],
                    //     'extended_date'=>$e_data['due_date'],
                    //     'extended_date_notes'=>$e_data['due_notes'],
                    //     'is_extended'=>1,
                    //     'isFirst'=>1,
                    //     'status' => 1,
                    //     'createdBy' => $this->adminId,
                    //     'createdDatetime' => $this->currTimeStamp
                    // ];
                    
                    if($e_data['extended_date']!=$e_data['due_date'])
                    {
                        // $extDateCondtnArr=array();
                        // $extDateUpdateArr=array();
                        
                        $extDueDateInsertArr1[]=array(
                            'ext_due_date_master_id'=>$e_data['ext_due_date_master_id'],
                            'due_date_id'=>$e_data['due_date_id'],
                            'is_extended'=>$e_data['is_extended'],
                            'isFirst'=>$e_data['isFirst'],
                            'due_date'=>$e_data['due_date'],
                            'extended_date'=>$e_data['extended_date']
                        );
                        
                        // 'next_extended_date'=>$e_data['ext_due_date'],
                        
                        // $extDateUpdateArr = [
                        //     'is_extended'=>2,
                        //     'next_extended_date'=>'',
                        //     'updatedBy' => $this->adminId,
                        //     'updatedDatetime' => $this->currTimeStamp
                        // ];
            
                        // $extDateCondtnArr['ext_due_date_master_tbl.ext_due_date_master_id']=$e_data['ext_due_date_master_id'];
                        // $extDateCondtnArr['ext_due_date_master_tbl.fk_due_date_master_id']=$e_data['fk_due_date_master_id'];

                        // $query=$this->Mcommon->updateData($tableName=$this->ext_due_date_master_tbl, $extDateUpdateArr, $extDateCondtnArr, $likeCondtnArr=array(), $whereInArray=array());
                    }
                }
            }
        }
        
        // print_r($extDueDateInsertArr);
        print_r($extDueDateInsertArr1);
        die();

        // $resQuery="";

        // if(!empty($extDueDateInsertArr))
        // {
        //     // $query=$this->Mcommon->insert($tableName=$this->ext_due_date_master_tbl, $extDueDateInsertArr, $returnType="");

        //     $resQuery=$query['status'];
        // }
        

        // if($resQuery=="")
        // {
        //     echo "No data found";
        //     die();
        // }
        if($this->db->transStatus() === FALSE){
            $this->db->transRollback();
            echo "Something went wrong!!";
        }else{
            $this->db->transCommit();
            echo "Due Date has been added successfully :)";
        }
        die();
    }
    
    public function updateWorkDateCol()
    {
        // die('access denied');
	    $this->db->transBegin();
	    
	    $wkUpdateArr = [
            'receiptDate' => null
        ];

        $wkCondtnArr['work_tbl.receiptDate']="0000-00-00";

        $query=$this->Mcommon->updateData($tableName=$this->work_tbl, $wkUpdateArr, $wkCondtnArr, $likeCondtnArr=array(), $whereInArray=array());
        
        if($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();
            
            die('failed');
        }
        else
        {
            $this->db->transCommit();
            
            die('success');
        }
    }
}

?>
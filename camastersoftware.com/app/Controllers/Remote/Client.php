<?php namespace App\Controllers\Remote;
use \App\Controllers\BaseController;

class Client extends BaseController
{
    public function __construct()
    {
        $this->Mquery = new \App\Models\Mquery();
        $this->TableLib = new \App\Libraries\TableLib();

        $tableArr=$this->TableLib->get_tables();

        $this->client_partner_tbl=$tableArr['client_partner_tbl'];
    }

    public function add_partner()
    {
        $this->db->transBegin();

        $client_partner_name=$this->request->getPost('client_partner_name');
        $client_partner_text=$this->request->getPost('client_partner_text');
        $client_partner_date=$this->request->getPost('client_partner_date');
        $client_partner_appt_date=$this->request->getPost('client_partner_appt_date');
        $clientId=$this->request->getPost('clientId');

        $cliPartInsertArr[] = [
            'client_partner_name'=>$client_partner_name,
            'client_partner_text'=>$client_partner_text,
            'client_partner_date'=>$client_partner_date,
            'client_partner_appt_date'=>$client_partner_appt_date,
            'fkClientId'=>$clientId,
            'status' => 1,
            'createdBy' => $this->adminId,
            'createdDatetime' => $this->currTimeStamp
        ];

        $this->Mquery->insert($tableName=$this->client_partner_tbl, $cliPartInsertArr, $returnType="");

        if($this->db->transStatus() === FALSE){
            
            $this->db->transRollback();

            $responseArr['status']=FALSE;
            $responseArr['message']="Client Partner has not added :(";
            $responseArr['userdata']=$errorArr;

        }else{

            $this->db->transCommit();

            $insertLogArr['section']="Client";
            $insertLogArr['message']="Client Partner added";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=strtok(exec('getmac'), ' ');
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $responseArr['status']=TRUE;
            $responseArr['message']="Client Partner has been added successfully :)";
            $responseArr['userdata']=$errorArr;

            $this->session->setFlashdata('successMsg', "Client Partner has been added successfully :)");
        }

        echo json_encode($responseArr);
    }

    public function edit_partner()
    {
        $this->db->transBegin();

        $client_partner_id=$this->request->getPost('client_partner_id');
        $client_partner_name=$this->request->getPost('client_partner_name');
        $client_partner_text=$this->request->getPost('client_partner_text');
        $client_partner_date=$this->request->getPost('client_partner_date');
        $client_partner_appt_date=$this->request->getPost('client_partner_appt_date');
        $clientId=$this->request->getPost('clientId');

        $cliPartUpdateArr = [
            'client_partner_name'=>$client_partner_name,
            'client_partner_text'=>$client_partner_text,
            'client_partner_date'=>$client_partner_date,
            'client_partner_appt_date'=>$client_partner_appt_date,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];

        $cliPartCondtnArr['client_partner_tbl.client_partner_id']=$client_partner_id;
        $cliPartCondtnArr['client_partner_tbl.fkClientId']=$clientId;

        $query=$this->Mquery->updateData($tableName=$this->client_partner_tbl, $cliPartUpdateArr, $cliPartCondtnArr, $likeCondtnArr=array(), $whereInArray=array());

        if($this->db->transStatus() === FALSE){
            
            $this->db->transRollback();

            $responseArr['status']=FALSE;
            $responseArr['message']="Client Partner has not updated :(";
            $responseArr['userdata']=$errorArr;

        }else{

            $this->db->transCommit();

            $insertLogArr['section']="Client";
            $insertLogArr['message']="Client Partner updated";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=strtok(exec('getmac'), ' ');
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $responseArr['status']=TRUE;
            $responseArr['message']="Client Partner has been updated successfully :)";
            $responseArr['userdata']=$errorArr;

            $this->session->setFlashdata('successMsg', "Client Partner has been updated successfully :)");
        }

        echo json_encode($responseArr);
    }

    public function delete_partner()
    {
        $this->db->transBegin();

        $client_partner_id=$this->request->getPost('client_partner_id');
        $clientId=$this->request->getPost('clientId');

        $cliPartUpdateArr = [
            'status'=>2,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];

        $cliPartCondtnArr['client_partner_tbl.client_partner_id']=$client_partner_id;
        $cliPartCondtnArr['client_partner_tbl.fkClientId']=$clientId;

        $query=$this->Mquery->updateData($tableName=$this->client_partner_tbl, $cliPartUpdateArr, $cliPartCondtnArr, $likeCondtnArr=array(), $whereInArray=array());

        if($this->db->transStatus() === FALSE){
            
            $this->db->transRollback();

            $responseArr['status']=FALSE;
            $responseArr['message']="Client Partner has not deleted :(";
            $responseArr['userdata']=array();

        }else{

            $this->db->transCommit();

            $insertLogArr['section']="Client";
            $insertLogArr['message']="Client Partner deleted";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=strtok(exec('getmac'), ' ');
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $responseArr['status']=TRUE;
            $responseArr['message']="Client Partner has been deleted successfully :)";
            $responseArr['userdata']=array();

            // $this->session->setFlashdata('successMsg', "Client Partner has been deleted successfully :)");
        }

        echo json_encode($responseArr);
    }

}

?>
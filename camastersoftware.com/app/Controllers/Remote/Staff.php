<?php

namespace App\Controllers\Remote;

use \App\Controllers\BaseController;

class Staff extends BaseController
{
    public function __construct()
    {
        $this->Mquery = new \App\Models\Mquery();
        $this->Muser = new \App\Models\Muser();
        $this->TableLib = new \App\Libraries\TableLib();
        $this->MCharterAccountant = new \App\Models\MCharterAccountant();
        $this->MArticleshipStaff = new \App\Models\MArticleshipStaff();

        $tableArr = $this->TableLib->get_tables();

        $this->user_tbl = $tableArr['user_tbl'];
        $this->articleship_staff_tbl = $tableArr['articleship_staff_tbl'];
        $this->chartered_accuntant_tbl = $tableArr['chartered_accuntant_tbl'];
        $this->expense_voucher_tbl = $tableArr['expense_voucher_tbl'];
    }

    public function mark_old_user()
    {
        $userId = $this->request->getPost('userId');
        $userLeftReason = $this->request->getPost('userLeftReason');

        $dataArray = [
            'userId' => $userId,
            'userLeftReason' => $userLeftReason,
            'isOldUser' => 1,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];

        if ($this->Muser->save($dataArray)) {

            $insertLogArr['section'] = "User";
            $insertLogArr['message'] = "User Mark Old";
            $insertLogArr['ip'] = $this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy'] = $this->adminId;
            $insertLogArr['createdDatetime'] = $this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $responseArr['status'] = TRUE;
            $responseArr['message'] = "User has been mark as left successfully :)";
            $responseArr['userdata'] = array();
        } else {
            $responseArr['status'] = FALSE;
            $responseArr['message'] = "User has not mark left :(";
            $responseArr['userdata'] = array();
        }

        echo json_encode($responseArr);
    }

    public function restore_user()
    {
        $userId = $this->request->getPost('userId');

        $dataArray = [
            'userId' => $userId,
            'userLeftReason' => "",
            'isOldUser' => 2,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];

        if ($this->Muser->save($dataArray)) {

            $insertLogArr['section'] = "User";
            $insertLogArr['message'] = "User Restored";
            $insertLogArr['ip'] = $this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy'] = $this->adminId;
            $insertLogArr['createdDatetime'] = $this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $responseArr['status'] = TRUE;
            $responseArr['message'] = "User has been restore successfully :)";
            $responseArr['userdata'] = array();
        } else {
            $responseArr['status'] = FALSE;
            $responseArr['message'] = "User has not restored :(";
            $responseArr['userdata'] = array();
        }

        echo json_encode($responseArr);
    }


    public function save_ca()
    {
        $this->db->transBegin();

        $isExceedLimit = false;

        $validationRulesArr['ca_name'] = ['label' => 'Name Of Paid Assistant', 'rules' => 'required|trim'];

        if (isset($_FILES['ca_img']['name']) && !empty($_FILES['ca_img']['name']))
            $validationRulesArr['ca_img'] = ['label' => 'CA Profile', 'rules' => 'uploaded[ca_img]|max_size[ca_img,10000]|ext_in[ca_img,png,jpg,jpeg]'];

        $validationRulesArr['ca_membership_no'] = ['label' => 'Membership Number', 'rules' => 'required|trim'];
        $validationRulesArr['ca_date_commencement'] = ['label' => 'Date Of Commenecement Of Employment', 'rules' => 'required|trim'];
        $validationRulesArr['ca_date_intimation_icai'] = ['label' => 'Date Of Intimation to ICAI', 'rules' => 'required|trim'];
        $validationRulesArr['ca_date_termination'] = ['label' => 'Date Of Termination Of Employment', 'rules' => 'required|trim'];
        $validationRulesArr['ca_date_intimation_icai_termination'] = ['label' => 'Date Of Intimation to ICAI Termination', 'rules' => 'required|trim'];
        $validationRulesArr['ca_remark'] = ['label' => 'Remark', 'rules' => 'trim'];

        $errorArr = array();

        if (!$this->validate($validationRulesArr)) {
            $errorArr = $this->validation->getErrors();
        } else {

            $ca_name = $this->request->getPost('ca_name');
            $ca_membership_no = $this->request->getPost('ca_membership_no');
            $ca_date_commencement = $this->request->getPost('ca_date_commencement');
            $ca_date_intimation_icai = $this->request->getPost('ca_date_intimation_icai');
            $ca_date_termination = $this->request->getPost('ca_date_termination');
            $ca_date_intimation_icai_termination = $this->request->getPost('ca_date_intimation_icai_termination');
            $ca_remark = $this->request->getPost('ca_remark');
            $ca_img = $this->request->getFile('ca_img');
            $ca_imgPath = "";
            if ($ca_img !== null && !empty($ca_img->getTempName())) {
                if ($ca_img->isValid() && !$ca_img->hasMoved()) {
                    $ext = $ca_img->guessExtension();
                    $uploadPath = FCPATH . 'uploads/ca_firm_' . $this->sessCaFirmId;

                    if (!is_dir($uploadPath))
                        mkdir($uploadPath, 0777, TRUE);

                    $uploadPath1 = $uploadPath . '/documents';

                    if (!is_dir($uploadPath1))
                        mkdir($uploadPath1, 0777, TRUE);

                    $newName = $ca_img->getRandomName();
                    $ca_img->move($uploadPath1, $newName);

                    $ca_imgPath = $newName;
                }
            }

            $caInsertArr[] = [
                'ca_name' => $ca_name,
                'ca_img' => $ca_imgPath,
                'ca_membership_no' => $ca_membership_no,
                'ca_date_commencement' => $ca_date_commencement,
                'ca_date_intimation_icai' => $ca_date_intimation_icai,
                'ca_date_intimation_icai_termination' => $ca_date_intimation_icai_termination,
                'ca_date_termination' => $ca_date_termination,
                'ca_remark' => $ca_remark,
                'status' => 1,
                'createdBy' => $this->adminId,
                'createdDatetime' => $this->currTimeStamp
            ];

            $query = $this->Mquery->insert($tableName = $this->chartered_accuntant_tbl, $caInsertArr, $returnType = "");

            $ca_id = $query['lastID'];
        }

        if ($this->db->transStatus() === FALSE || !empty($errorArr)) {

            $this->db->transRollback();

            $responseArr['status'] = FALSE;
            $responseArr['message'] = "CA has not added :(";
            $responseArr['userdata'] = $errorArr;
        } else {

            $this->db->transCommit();

            $insertLogArr['section'] = "CA";
            $insertLogArr['message'] = "CA added";
            $insertLogArr['ip'] = $this->IPAddress;
            // $insertLogArr['macAddr']=strtok(exec('getmac'), ' ');
            $insertLogArr['createdBy'] = $this->adminId;
            $insertLogArr['createdDatetime'] = $this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $responseArr['status'] = TRUE;
            $responseArr['message'] = "CA has been added successfully :)";
            $responseArr['userdata'] = $errorArr;

            $this->session->setFlashdata('successMsg', "CA has been added successfully :)");
        }

        echo json_encode($responseArr);
    }

    public function save_articleship()
    {
        $this->db->transBegin();

        $isExceedLimit = false;

        $validationRulesArr['art_staff_name'] = ['label' => 'Name Of Articlied Assistant', 'rules' => 'required|trim'];
        $validationRulesArr['art_staff_name_of_principle'] = ['label' => 'Name Of the Principl', 'rules' => 'required|trim'];

        if (isset($_FILES['art_staff_img']['name']) && !empty($_FILES['art_staff_img']['name']))
            $validationRulesArr['art_staff_img'] = ['label' => 'Articlied Assistant Profile', 'rules' => 'uploaded[art_staff_img]|max_size[art_staff_img,10000]|ext_in[art_staff_img,png,jpg,jpeg]'];

        $validationRulesArr['art_staff_reg_no'] = ['label' => 'Registration Number', 'rules' => 'required|trim'];
        $validationRulesArr['art_staff_membership_no'] = ['label' => 'Membership Number', 'rules' => 'required|trim'];
        $validationRulesArr['art_staff_date_commencement'] = ['label' => 'Date Of Commenecement Of Articleship', 'rules' => 'required|trim'];
        $validationRulesArr['art_staff_date_intimation_icai'] = ['label' => 'Date Of Intimation to ICAI', 'rules' => 'required|trim'];
        $validationRulesArr['art_staff_date_suppl_art_icai'] = ['label' => 'Date Of Intimation to ICAI', 'rules' => 'required|trim'];
        $validationRulesArr['art_staff_date_completion_art_icai'] = ['label' => 'Date Of Intimation to ICAI', 'rules' => 'required|trim'];
        $validationRulesArr['art_staff_date_suppl_art'] = ['label' => 'Date Of Supplementary Of Articleship', 'rules' => 'required|trim'];
        $validationRulesArr['art_staff_date_completion_art'] = ['label' => 'Date Of Completion  of Articleship', 'rules' => 'required|trim'];
        $validationRulesArr['art_staff_year_completion_inter_ca'] = ['label' => 'Year Of Completion Of Inter CA', 'rules' => 'required|trim'];
        $validationRulesArr['art_staff_year_completion_final_ca'] = ['label' => 'Year Of Completion Of Final CA', 'rules' => 'required|trim'];
        $validationRulesArr['art_staff_job_status'] = ['label' => 'Job Status After Leaving', 'rules' => 'required|trim'];
        $validationRulesArr['art_staff_remark'] = ['label' => 'Remark', 'rules' => 'trim'];

        $errorArr = array();

        if (!$this->validate($validationRulesArr)) {
            $errorArr = $this->validation->getErrors();
        } else {

            $art_staff_name = $this->request->getPost('art_staff_name');
            $art_staff_name_of_principle = $this->request->getPost('art_staff_name_of_principle');
            $art_staff_reg_no = $this->request->getPost('art_staff_reg_no');
            $art_staff_membership_no = $this->request->getPost('art_staff_membership_no');
            $art_staff_date_commencement = $this->request->getPost('art_staff_date_commencement');
            $art_staff_date_intimation_icai = $this->request->getPost('art_staff_date_intimation_icai');
            $art_staff_date_suppl_art_icai = $this->request->getPost('art_staff_date_suppl_art_icai');
            $art_staff_date_completion_art_icai = $this->request->getPost('art_staff_date_completion_art_icai');
            $art_staff_date_suppl_art = $this->request->getPost('art_staff_date_suppl_art');
            $art_staff_date_completion_art = $this->request->getPost('art_staff_date_completion_art');
            $art_staff_year_completion_inter_ca = $this->request->getPost('art_staff_year_completion_inter_ca');
            $art_staff_year_completion_final_ca = $this->request->getPost('art_staff_year_completion_final_ca');
            $art_staff_job_status = $this->request->getPost('art_staff_job_status');
            $art_staff_remark = $this->request->getPost('art_staff_remark');

            $art_staff_img = $this->request->getFile('art_staff_img');
            $art_staff_imgPath = "";
            if ($art_staff_img !== null && !empty($art_staff_img->getTempName())) {
                if ($art_staff_img->isValid() && !$art_staff_img->hasMoved()) {
                    $ext = $art_staff_img->guessExtension();
                    $uploadPath = FCPATH . 'uploads/ca_firm_' . $this->sessCaFirmId;

                    if (!is_dir($uploadPath))
                        mkdir($uploadPath, 0777, TRUE);

                    $uploadPath1 = $uploadPath . '/documents';

                    if (!is_dir($uploadPath1))
                        mkdir($uploadPath1, 0777, TRUE);

                    $newName = $art_staff_img->getRandomName();
                    $art_staff_img->move($uploadPath1, $newName);

                    $art_staff_imgPath = $newName;
                }
            }

            $articleshipInsertArr[] = [
                'art_staff_name' => $art_staff_name,
                'art_staff_img' => $art_staff_imgPath,
                'art_staff_name_of_principle' => $art_staff_name_of_principle,
                'art_staff_reg_no' => $art_staff_reg_no,
                'art_staff_membership_no' => $art_staff_membership_no,
                'art_staff_date_commencement' => $art_staff_date_commencement,
                'art_staff_date_intimation_icai' => $art_staff_date_intimation_icai,
                'art_staff_date_suppl_art_icai' => $art_staff_date_suppl_art_icai,
                'art_staff_date_completion_art_icai' => $art_staff_date_completion_art_icai,
                'art_staff_date_suppl_art' => $art_staff_date_suppl_art,
                'art_staff_date_completion_art' => $art_staff_date_completion_art,
                'art_staff_year_completion_inter_ca' => $art_staff_year_completion_inter_ca,
                'art_staff_year_completion_final_ca' => $art_staff_year_completion_final_ca,
                'art_staff_job_status' => $art_staff_job_status,
                'art_staff_remark' => $art_staff_remark,
                'status' => 1,
                'createdBy' => $this->adminId,
                'createdDatetime' => $this->currTimeStamp
            ];

            $query = $this->Mquery->insert($tableName = $this->articleship_staff_tbl, $articleshipInsertArr, $returnType = "");

            $art_staff_id = $query['lastID'];
        }

        if ($this->db->transStatus() === FALSE || !empty($errorArr)) {

            $this->db->transRollback();

            $responseArr['status'] = FALSE;
            $responseArr['message'] = "Articleship Staff has not added :(";
            $responseArr['userdata'] = $errorArr;
        } else {

            $this->db->transCommit();

            $insertLogArr['section'] = "Articleship Staff";
            $insertLogArr['message'] = "Articleship Staff added";
            $insertLogArr['ip'] = $this->IPAddress;
            // $insertLogArr['macAddr']=strtok(exec('getmac'), ' ');
            $insertLogArr['createdBy'] = $this->adminId;
            $insertLogArr['createdDatetime'] = $this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $responseArr['status'] = TRUE;
            $responseArr['message'] = "Articleship Staff has been added successfully :)";
            $responseArr['userdata'] = $errorArr;

            $this->session->setFlashdata('successMsg', "Articleship Staff has been added successfully :)");
        }

        echo json_encode($responseArr);
    }

    public function save_expense()
    {
        $this->db->transBegin();

        $validationRulesArr['exp_head'] = ['label' => 'Expense Head', 'rules' => 'required|trim'];

        // if (isset($_FILES['exp_doc']['name']) && !empty($_FILES['exp_doc']['name']))
        //     $validationRulesArr['exp_doc'] = ['label' => 'Expense Doc', 'rules' => 'uploaded[exp_doc]|max_size[exp_doc,10000]|ext_in[exp_doc,png,jpg,jpeg]'];

        $validationRulesArr['exp_date'] = ['label' => 'Expense Date', 'rules' => 'required|trim'];
        $validationRulesArr['exp_bill_no'] = ['label' => 'Expense Bill No', 'rules' => 'required|trim'];
        $validationRulesArr['exp_details'] = ['label' => 'Expense Details', 'rules' => 'trim'];
        $validationRulesArr['exp_amt'] = ['label' => 'Expense Amount', 'rules' => 'required|trim'];
        $validationRulesArr['fk_user_id'] = ['label' => 'Staff Name', 'rules' => 'required|trim'];

        $errorArr = array();

        if (!$this->validate($validationRulesArr)) {
            $errorArr = $this->validation->getErrors();
        } else {

            $exp_idData = $this->request->getPost('exp_id');
            $exp_bill_no = $this->request->getPost('exp_bill_no');
            $exp_head = $this->request->getPost('exp_head');
            $exp_date = $this->request->getPost('exp_date');
            $exp_details = $this->request->getPost('exp_details');
            $exp_amt = $this->request->getPost('exp_amt');
            $fk_user_id = $this->request->getPost('fk_user_id');
            $exp_doc = $this->request->getFile('exp_doc');
            // $exp_docPath = "";
            // if ($exp_doc !== null && !empty($exp_doc->getTempName())) {
            //     if ($exp_doc->isValid() && !$exp_doc->hasMoved()) {
            //         $ext = $exp_doc->guessExtension();
            //         $uploadPath = FCPATH . 'uploads/ca_firm_' . $this->sessCaFirmId;

            //         if (!is_dir($uploadPath))
            //             mkdir($uploadPath, 0777, TRUE);

            //         $uploadPath1 = $uploadPath . '/documents';

            //         if (!is_dir($uploadPath1))
            //             mkdir($uploadPath1, 0777, TRUE);

            //         $newName = $exp_doc->getRandomName();
            //         $exp_doc->move($uploadPath1, $newName);

            //         $exp_docPath = $newName;
            //     }
            // }


            $expUpsertArr[] = [
                'exp_head' => $exp_head,
                // 'exp_doc' => $exp_docPath,
                'exp_bill_no' => $exp_bill_no,
                'exp_date' => $exp_date,
                'exp_details' => $exp_details,
                'exp_amt' => $exp_amt,
                'fk_user_id' => $fk_user_id,
                'status' => 1
            ];
            $titleMSG= "";
            if ($exp_idData > 0) {
                $expCondtnArr['expense_voucher_tbl.exp_id']=$exp_idData;
                $expUpsertArr[0]['updatedBy']=$this->adminId;
                $expUpsertArr[0]['updatedDatetime']=$this->currTimeStamp;
                $query = $this->Mquery->updateData($tableName=$this->expense_voucher_tbl, $updateArr=$expUpsertArr[0],  $condtnArr =$expCondtnArr, $likeCondtnArr=array(), $whereInArray=array());
                $exp_id =$exp_idData;
                $titleMSG= "Updated";
            } else {
                $expUpsertArr[0]['createdBy']=$this->adminId;
                $expUpsertArr[0]['createdDatetime']=$this->currTimeStamp;
                $query = $this->Mquery->insert($tableName = $this->expense_voucher_tbl, $expUpsertArr, $returnType = "");

                $exp_id = $query['lastID'];
                $titleMSG= "Added";
            }
        }

        if ($this->db->transStatus() === FALSE || !empty($errorArr)) {

            $this->db->transRollback();

            $responseArr['status'] = FALSE;
            $responseArr['message'] = "Expense has not ".$titleMSG." :(";
            $responseArr['userdata'] = $errorArr;
        } else {

            $this->db->transCommit();

            $insertLogArr['section'] = "Expense";
            $insertLogArr['message'] = "Expense added";
            $insertLogArr['ip'] = $this->IPAddress;
            // $insertLogArr['macAddr']=strtok(exec('getmac'), ' ');
            $insertLogArr['createdBy'] = $this->adminId;
            $insertLogArr['createdDatetime'] = $this->currTimeStamp;

            $this->Mquery->insertLog($insertLogArr);

            $responseArr['status'] = TRUE;
            $responseArr['message'] = "Expense has been ".$titleMSG." successfully :)";
            $responseArr['userdata'] = $errorArr;

            $this->session->setFlashdata('successMsg', "Expense has been ".$titleMSG." successfully :)");
        }

        echo json_encode($responseArr);
    }
}

<?php
namespace App\Controllers;

class NonRegularDueDates extends BaseController
{
    public function __construct()
    {
        $this->data['cssPath']="template/includes/css";
        $this->data['navPath']="template/includes/nav";
        $this->data['footerPath']="template/includes/footer";
        $this->data['scriptPath']="template/includes/scripts";
        $this->data['layoutPath']="template/layouts/main_layout";
        $this->section="Non-Regular Due Dates";
        
        $this->Mcommon = new \App\Models\Mcommon();
        $this->Mquery = new \App\Models\Mquery();
        $this->Mstate = new \App\Models\Mstate();
        $this->Mgroup = new \App\Models\Mgroup();
        $this->Mgroup_cat = new \App\Models\Mgroup_cat();
        $this->Muser = new \App\Models\Muser();
        $this->Msalutation = new \App\Models\Msalutation();
        $this->MorganisationType = new \App\Models\MorganisationType();
        $this->Mdocument = new \App\Models\Mdocument();
        $this->Mact = new \App\Models\Mact();
        $this->Mact_option = new \App\Models\Mact_option();
        $this->Mperiodicity = new \App\Models\Mperiodicity();
        $this->TableLib = new \App\Libraries\TableLib();
        $this->session = \Config\Services::session();

        $tableArr=$this->TableLib->get_tables();

        $this->act_tbl=$tableArr['act_tbl'];
        $this->due_date_master_tbl=$tableArr['due_date_master_tbl'];
        $this->act_option_map_tbl=$tableArr['act_option_map_tbl'];
        $this->client_tbl=$tableArr['client_tbl'];
        $this->client_group_tbl=$tableArr['client_group_tbl'];
        $this->user_tbl=$tableArr['user_tbl'];
        $this->client_document_tbl=$tableArr['client_document_tbl'];
        $this->group_category_tbl=$tableArr['group_category_tbl'];
        $this->salutation_tbl=$tableArr['salutation_tbl'];
        $this->organisation_type_tbl=$tableArr['organisation_type_tbl'];
        $this->client_document_map_tbl=$tableArr['client_document_map_tbl'];
        $this->client_act_map_tbl=$tableArr['client_act_map_tbl'];
        $this->work_tbl=$tableArr['work_tbl'];
        $this->client_partner_tbl=$tableArr['client_partner_tbl'];
        $this->ext_due_date_master_tbl=$tableArr['ext_due_date_master_tbl'];
        $this->tax_payer_due_date_map_tbl=$tableArr['tax_payer_due_date_map_tbl'];
        $this->non_regular_due_date_for_tbl=$tableArr['non_regular_due_date_for_tbl'];
        $this->non_regular_due_date_tbl=$tableArr['non_regular_due_date_tbl'];

        $this->sessCaFirmId=$this->session->get('caFirmId');

        $documentsPath=base_url('uploads/ca_firm_'.$this->sessCaFirmId.'/documents');

        $this->data['documentsPath']=$documentsPath;

        $this->sessDueDateYear=$this->session->get('dueDateYear');

        $this->dueYear=$this->sessDueDateYear;
        
        $this->data['dueYear']=$this->dueYear;
    }
	
	public function index()
    {
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'ckeditor');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Non-Regular Due Dates";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        $taxYearArr=explode('-', $this->sessDueDateYear);
        
        $taxFromYear=date('Y-m-d', strtotime("01-04-".$taxYearArr[0]));
        $taxToYear=date('Y-m-d', strtotime("31-03-20".$taxYearArr[1]));
        
        $taxCondtnArr['non_regular_due_date_tbl.non_rglr_due_date >=']=$taxFromYear;
        $taxCondtnArr['non_regular_due_date_tbl.non_rglr_due_date <=']=$taxToYear;

        $taxCondtnArr['non_regular_due_date_tbl.status']=1;
            
        $taxOrderByArr['non_regular_due_date_tbl.non_rglr_due_date']="ASC";
        $taxOrderByArr['non_regular_due_date_tbl.non_rglr_due_date_id']="ASC";

        $taxJoinArr[]=array("tbl"=>'act_option_map_tbl AS due_date_for_tbl', "condtn"=>"due_date_for_tbl.act_option_map_id=non_regular_due_date_tbl.non_rglr_due_date_for", "type"=>"left");
        $taxJoinArr[]=array("tbl"=>'act_tbl', "condtn"=>"act_tbl.act_id=non_regular_due_date_tbl.non_rglr_due_act", "type"=>"left");
 
        $taxColNames="
            non_regular_due_date_tbl.non_rglr_due_date_id,
            non_regular_due_date_tbl.non_rglr_due_act,
            non_regular_due_date_tbl.non_rglr_due_date_for,
            non_regular_due_date_tbl.non_rglr_periodicity,
            non_regular_due_date_tbl.non_rglr_daily_date,
            non_regular_due_date_tbl.non_rglr_period_month,
            non_regular_due_date_tbl.non_rglr_period_year,
            non_regular_due_date_tbl.non_rglr_f_period_month,
            non_regular_due_date_tbl.non_rglr_f_period_year,
            non_regular_due_date_tbl.non_rglr_t_period_month,
            non_regular_due_date_tbl.non_rglr_t_period_year,
            non_regular_due_date_tbl.non_rglr_finYear,
            non_regular_due_date_tbl.non_rglr_due_date,
            non_regular_due_date_tbl.non_rglr_due_notes,
            non_regular_due_date_tbl.non_rglr_doc_file,
            DATE_FORMAT(non_regular_due_date_tbl.non_rglr_due_date, '%c') AS act_due_month,
            act_tbl.act_name,
            act_tbl.act_short_name,
            due_date_for_tbl.act_option_name AS act_option_name1
        ";

        $query=$this->Mcommon->getRecords($tableName=$this->non_regular_due_date_tbl, $colNames=$taxColNames, $taxCondtnArr, $likeCondtnArr=array(), $taxJoinArr, $singleRow=FALSE, $taxOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $dueDatesArr=$query['userData'];

        $this->data['dueDatesArr']=$dueDatesArr;

        return view('firm_panel/non_regular_due_dates/list', $this->data);
    }

	public function add()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('sweetalert.min', 'ckeditor');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Add Non-Regular Due Date";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

	    $actArr = $this->Mact->where('status', 1)
                    ->findAll();

        $this->data['actArr']=$actArr;

        $periodArr = $this->Mperiodicity->where('status', 1)
                    ->findAll();

        $this->data['periodArr']=$periodArr;
        
        $stateList = $this->Mstate->where('status', 1)
                    ->findAll();

        $this->data['stateList']=$stateList;

        return view('firm_panel/non_regular_due_dates/add', $this->data);
	}

	public function insertData()
	{
	    $this->db->transBegin();

        $due_state=$this->request->getPost('due_state');
        $due_act=$this->request->getPost('due_act');
        $due_date_for=$this->request->getPost('due_date_for');
        $periodicity=$this->request->getPost('periodicity');
        $daily_date=date('Y-m-d', strtotime($this->request->getPost('daily_date')));
        $period_month=$this->request->getPost('period_month');
        $period_year=$this->request->getPost('period_year');
        $f_period_month=$this->request->getPost('f_period_month');
        $f_period_year=$this->request->getPost('f_period_year');
        $t_period_month=$this->request->getPost('t_period_month');
        $t_period_year=$this->request->getPost('t_period_year');
        $finYear=$this->request->getPost('finYear');
        $due_date=date('Y-m-d', strtotime($this->request->getPost('due_date')));
        $due_notes=htmlentities(htmlspecialchars($this->request->getPost('due_notes')));
        $file=$this->request->getFile('doc_file');
        
        $doc_file="";
        if(!empty($file->getTempName()))
        {
            if($file->isValid() && ! $file->hasMoved())
            {
                $ext=$file->guessExtension();
                
                if($ext=="pdf")
                {
                    $uploadPath=FCPATH.'uploads/ca_firm_'.$this->sessCaFirmId;

                    if(!is_dir($uploadPath))
                        mkdir($uploadPath, 0777, TRUE);

                    $uploadPath1=$uploadPath.'/non_regular_due_dates';

                    if(!is_dir($uploadPath1))
                        mkdir($uploadPath1, 0777, TRUE);
    
                    $doc_file = $file->getRandomName();
                    $file->move($uploadPath1, $doc_file);
                }
                else
                {
                    $this->session->setFlashdata('errorMsg', "Only pdf document is accepted");
                    return redirect()->back();
                }
            }
            else
            {
                $this->session->setFlashdata('errorMsg', "Invalid file uploaded");
                return redirect()->back();
            }
        }

        $insertArr[]=[
            'non_rglr_due_act'=>$due_act,
            'non_rglr_due_date_for'=>$due_date_for,
            'non_rglr_periodicity'=>$periodicity,
            'non_rglr_daily_date'=>$daily_date,
            'non_rglr_period_month'=>$period_month,
            'non_rglr_period_year'=>$period_year,
            'non_rglr_f_period_month'=>$f_period_month,
            'non_rglr_f_period_year'=>$f_period_year,
            'non_rglr_t_period_month'=>$t_period_month,
            'non_rglr_t_period_year'=>$t_period_year,
            'non_rglr_finYear'=>$finYear,
            'non_rglr_due_date'=>$due_date,
            'non_rglr_doc_file'=>$doc_file,
            'non_rglr_due_notes'=>$due_notes,
            'status' => 1,
            'createdBy' => $this->adminId,
            'createdDatetime' => $this->currTimeStamp
        ];

        $query=$this->Mcommon->insert($tableName=$this->non_regular_due_date_tbl, $insertArr, $returnType="");

        $due_date_id=$query['lastID'];

        if($this->db->transStatus() === FALSE){
            
            $this->db->transRollback();

            $this->session->setFlashdata('errorMsg', "Non-Regular Due Date has not added :(");

        }else{

            $this->db->transCommit();

            $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Added";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Non-Regular Due Date has been added successfully :)");
        }

        return redirect()->route('non-regular-due-dates');
	}
	
	public function updateData()
	{
	    $this->db->transBegin();
	    
	    $holidayId=$this->request->getPost('holidayId');
	    $holidayName=$this->request->getPost('holidayName');
	    $holidayDate=$this->request->getPost('holidayDate');
	    $holidayRemark=$this->request->getPost('holidayRemark');
	    
	    $holidayYear=date('Y', strtotime($holidayDate));
	    
	    $insertArr=[
            'holidayId'=>$holidayId,
            'holidayName'=>$holidayName,
            'holidayDate'=>$holidayDate,
            'holidayRemark'=>$holidayRemark,
            'holidayYear'=>$holidayYear,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
	    $this->Mholiday->save($insertArr);
	    
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
	    
	    return redirect()->route('holidays');
	}
	
	public function deleteData()
	{
	    $holidayId=$this->request->getPost('holidayId');
	    
	    $insertArr=[
            'holidayId'=>$holidayId,
            'status'=>2,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
	    if($this->Mholiday->save($insertArr))
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
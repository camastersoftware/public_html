<?php namespace App\Controllers\SuperAdmin;
use \App\Controllers\BaseController;

class Error_report extends BaseController
{
    public function __construct()
    {
        $this->data['cssPath']="template/includes/css";
        $this->data['navPath']="template/includes/nav";
        $this->data['footerPath']="template/includes/footer";
        $this->data['scriptPath']="template/includes/scripts";
        $this->data['layoutPath']="template/layouts/main_layout";

        $this->Mdue_date = new \App\Models\Mdue_date();
        $this->Mcommon = new \App\Models\Mcommon();
        $this->TableLib = new \App\Libraries\TableLib();

        $tableArr=$this->TableLib->get_tables();

        $this->error_reports_tbl=$tableArr['error_reports_tbl'];
        $this->ca_firm_tbl=$tableArr['ca_firm_tbl'];
        $this->menu_tbl=$tableArr['menu_tbl'];
        $this->sub_menu_tbl=$tableArr['sub_menu_tbl'];
    }

	public function index()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Query Manager";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;
        
        $errType=$this->request->getGet('errType');
        
        if(empty($errType))
            $errType=1;
        
        $this->data['errType']=$errType;

        // $errRpCondtnArr['error_reports_tbl.errFrom']="2";
        $errRpCondtnArr['error_reports_tbl.status']="1";
        
        $errRpOrderByArr['error_reports_tbl.errPriority']="DESC";
        $errRpOrderByArr['error_reports_tbl.createdDatetime']="DESC";
        
        $errRptJoinArr[]=array("tbl"=>$this->menu_tbl, "condtn"=>"menu_tbl.menuId=error_reports_tbl.fkMenuId AND menu_tbl.status=1", "type"=>"left");
        $errRptJoinArr[]=array("tbl"=>$this->sub_menu_tbl, "condtn"=>"sub_menu_tbl.subMenuId=error_reports_tbl.fkSubMenuId AND sub_menu_tbl.status=1", "type"=>"left");
        $errRptJoinArr[]=array("tbl"=>$this->ca_firm_tbl, "condtn"=>"ca_firm_tbl.caFirmId=error_reports_tbl.fkFirmId AND ca_firm_tbl.status=1", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->error_reports_tbl, $colNames="error_reports_tbl.*, menu_tbl.menuName, sub_menu_tbl.subMenuName, ca_firm_tbl.caFirmId, ca_firm_tbl.caFirmName, ca_firm_tbl.caFirmCompanyKey", $errRpCondtnArr, $likeCondtnArr=array(), $errRptJoinArr, $singleRow=FALSE, $errRpOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $errRepData=$query['userData'];

        $this->data['errRepData']=$errRepData;

        return view('super_admin/error_report/list', $this->data);
	}

	public function add_error_report()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Add Query";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $uniqueId=strtoupper(substr(str_shuffle(uniqid()), 0, 4));
                
        // $errCode='ID_'.$uniqueId;
        $errCode=$uniqueId;

        $this->data['errCode']=$errCode;

        if(isset($_POST['submit']))
        {
            $errCode=$this->request->getPost('errCode');
            $errDate=$this->request->getPost('errDate');
            $errReport=$this->request->getPost('errReport');
            $errUserComment=$this->request->getPost('errUserComment');
            $errPriority=$this->request->getPost('errPriority');
            $errPriorityColor=$this->request->getPost('errPriorityColor');
            $file=$this->request->getFile('file');
            
            $img_file="";
            if(!empty($file->getTempName()))
            {
                if($file->isValid() && ! $file->hasMoved())
                {
                    $ext=$file->guessExtension();
                    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
                    
                    if (in_array($ext, $allowed_extensions))
                    {
                        $uploadPath=FCPATH.'uploads/admin/query_files';
        
                        $img_file = $file->getRandomName();
                        $file->move($uploadPath, $img_file);
                    }
                    else
                    {
                        $this->session->setFlashdata('errorMsg', "Only image files (jpg, jpeg, png, gif) are accepted");
                        return redirect()->back();
                    }
                }
                else
                {
                    $this->session->setFlashdata('errorMsg', "Invalid file uploaded");
                    return redirect()->back();
                }
            }

            $errRpInsertArr[] = [
                'errCode'=>$errCode,
                'errDate'=>$errDate,
                'errReport'=>$errReport,
                'errUserComment'=>$errUserComment,
                'errByUser'=>$this->adminUserName,
                'errPriority'=>$errPriority,
                'errPriorityColor'=>$errPriorityColor,
                'errUploadedImage'=>$img_file,
                'errFrom'=>"2",
                'status' => 1,
                'createdBy' => $this->adminId,
                'createdDatetime' => $this->currTimeStamp
            ];
    
            $query=$this->Mcommon->insert($tableName=$this->error_reports_tbl, $errRpInsertArr, $returnType="");

            if($query['status']==FALSE)
            {
                $this->session->setFlashdata('flashErrorMsg', "Query has not added :(");

                return redirect()->route('superadmin/add_error_report');
            }
            else
            {
                $insertLogArr['section']="Error Report";
                $insertLogArr['message']="Error Report added";
                $insertLogArr['ip']=$this->IPAddress;
                // $insertLogArr['macAddr']=strtok(exec('getmac'), ' ');
                $insertLogArr['createdBy']=$this->adminId;
                $insertLogArr['createdDatetime']=$this->currTimeStamp;

                $this->Mcommon->insertLog($insertLogArr);

                $this->session->setFlashdata('successMsg', "Query has been added successfully :)");

                return redirect()->to(base_url('superadmin/error_reports?errType=2'));
            }
        }

        return view('super_admin/error_report/add', $this->data);
	}

    public function edit_error_report()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);
        $this->data['errId']=$errId=$uri->getSegment(4);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Edit Query";
        $this->data['pageTitle']=$pageTitle;
        
        $errType=$this->request->getGet('errType');
        
        $this->data['errType']=$errType;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $errRpCondtnArr['error_reports_tbl.errId']=$errId;
        $errRpCondtnArr['error_reports_tbl.errFrom']="2";
        $errRpCondtnArr['error_reports_tbl.status']="1";
        
        $query=$this->Mcommon->getRecords($tableName=$this->error_reports_tbl, $colNames="error_reports_tbl.*", $errRpCondtnArr, $likeCondtnArr=array(), $joinArr=array(), $singleRow=TRUE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $errRepData=$query['userData'];

        $this->data['errRepData']=$errRepData;

        if(isset($_POST['submit']))
        {
            $errType=$this->request->getPost('errType');
            $errId=$this->request->getPost('errId');
            $errDate=$this->request->getPost('errDate');
            $errReport=$this->request->getPost('errReport');
            $errUserComment=$this->request->getPost('errUserComment');
            $errPriority=$this->request->getPost('errPriority');
            $errPriorityColor=$this->request->getPost('errPriorityColor');
            $file=$this->request->getFile('file');
            $old_file=$this->request->getPost('old_file');
            
            $img_file="";
            if(!empty($file->getTempName()))
            {
                if($file->isValid() && ! $file->hasMoved())
                {
                    $ext=$file->guessExtension();
                    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
                    
                    if (in_array($ext, $allowed_extensions))
                    {
                        $uploadPath=FCPATH.'uploads/admin/query_files';
        
                        $img_file = $file->getRandomName();
                        $file->move($uploadPath, $img_file);
                        
                        if(!empty($old_file))
                        {
                            $delUploadFilePath=$uploadPath."/".$old_file;
                            unlink($delUploadFilePath);
                        }
                    }
                    else
                    {
                        $this->session->setFlashdata('errorMsg', "Only image files (jpg, jpeg, png, gif) are accepted");
                        return redirect()->back();
                    }
                }
                else
                {
                    $this->session->setFlashdata('errorMsg', "Invalid file uploaded");
                    return redirect()->back();
                }
            }
            else
            {
                $img_file = $old_file;
            }

            $errRpUpdateArr = [
                'errDate'=>$errDate,
                'errReport'=>$errReport,
                'errUserComment'=>$errUserComment,
                'errPriority'=>$errPriority,
                'errPriorityColor'=>$errPriorityColor,
                'errUploadedImage'=>$img_file,
                'updatedBy' => $this->adminId,
                'updatedDatetime' => $this->currTimeStamp
            ];

            $errRpUpdCondtnArr['error_reports_tbl.errId']=$errId;
            // $errRpUpdCondtnArr['error_reports_tbl.errFrom']="1";
    
            $query=$this->Mcommon->updateData($tableName=$this->error_reports_tbl, $errRpUpdateArr, $errRpUpdCondtnArr, $likeCondtnArr=array(), $whereInArray=array());

            if($query['status']==FALSE)
            {
                $this->session->setFlashdata('flashErrorMsg', "Query has not updated :(");

                return redirect()->to(base_url('superadmin/error_report/edit_error_report/'.$errId.'?errType='.$errType));
            }
            else
            {
                $insertLogArr['section']="Error Report";
                $insertLogArr['message']="Error Report updated";
                $insertLogArr['ip']=$this->IPAddress;
                // $insertLogArr['macAddr']=strtok(exec('getmac'), ' ');
                $insertLogArr['createdBy']=$this->adminId;
                $insertLogArr['createdDatetime']=$this->currTimeStamp;

                $this->Mcommon->insertLog($insertLogArr);

                $this->session->setFlashdata('successMsg', "Query has been updated successfully :)");

                // return redirect()->route('error_reports?errType='.$errType);
                return redirect()->to(base_url('superadmin/error_reports?errType='.$errType));
            }
        }

        return view('super_admin/error_report/edit', $this->data);
	}

    public function reply_error_report()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);
        $this->data['errId']=$errId=$uri->getSegment(4);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Reply To Query";
        $this->data['pageTitle']=$pageTitle;
        
        $errType=$this->request->getGet('errType');
        
        $this->data['errType']=$errType;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $errRpCondtnArr['error_reports_tbl.errId']=$errId;
        // $errRpCondtnArr['error_reports_tbl.errFrom']="2";
        $errRpCondtnArr['error_reports_tbl.status']="1";
        
        $errRptJoinArr[]=array("tbl"=>$this->ca_firm_tbl, "condtn"=>"ca_firm_tbl.caFirmId=error_reports_tbl.fkFirmId AND ca_firm_tbl.status=1", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->error_reports_tbl, $colNames="error_reports_tbl.*, ca_firm_tbl.caFirmId, ca_firm_tbl.caFirmName, ca_firm_tbl.caFirmCompanyKey", $errRpCondtnArr, $likeCondtnArr=array(), $errRptJoinArr, $singleRow=TRUE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $errRepData=$query['userData'];

        $this->data['errRepData']=$errRepData;

        if(isset($_POST['submit']))
        {
            $errId=$this->request->getPost('errId');
            $errType=$this->request->getPost('errType');
            $errDeveloperComment=$this->request->getPost('errDeveloperComment');

            $errRpUpdateArr = [
                'errDeveloperComment'=>$errDeveloperComment,
                'errStatus'=>1,
                'updatedBy' => $this->adminId,
                'updatedDatetime' => $this->currTimeStamp
            ];

            $errRpUpdCondtnArr['error_reports_tbl.errId']=$errId;
            // $errRpUpdCondtnArr['error_reports_tbl.errFrom']="1";
            
            $query=$this->Mcommon->updateData($tableName=$this->error_reports_tbl, $errRpUpdateArr, $errRpUpdCondtnArr, $likeCondtnArr=array(), $whereInArray=array());

            if($query['status']==FALSE)
            {
                $this->session->setFlashdata('flashErrorMsg', "Query has not replied :(");

                return redirect()->to(base_url('superadmin/error_report/reply_error_report/'.$errId.'?errType='.$errType));
            }
            else
            {
                $insertLogArr['section']="Error Report";
                $insertLogArr['message']="Error Report Replied";
                $insertLogArr['ip']=$this->IPAddress;
                // $insertLogArr['macAddr']=strtok(exec('getmac'), ' ');
                $insertLogArr['createdBy']=$this->adminId;
                $insertLogArr['createdDatetime']=$this->currTimeStamp;

                $this->Mcommon->insertLog($insertLogArr);

                $this->session->setFlashdata('successMsg', "Replied to query successfully :)");

                // return redirect()->route('error_reports?errType='.$errType);
                return redirect()->to(base_url('superadmin/error_reports?errType='.$errType));
            }
        }

        return view('super_admin/error_report/reply', $this->data);
	}

    public function view_error_report()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);
        $this->data['errId']=$errId=$uri->getSegment(4);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="View Query";
        $this->data['pageTitle']=$pageTitle;
        
        $errType=$this->request->getGet('errType');
        
        $this->data['errType']=$errType;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $errRpCondtnArr['error_reports_tbl.errId']=$errId;
        // $errRpCondtnArr['error_reports_tbl.errFrom']="2";
        $errRpCondtnArr['error_reports_tbl.status']="1";
        
        $errRptJoinArr[]=array("tbl"=>$this->ca_firm_tbl, "condtn"=>"ca_firm_tbl.caFirmId=error_reports_tbl.fkFirmId AND ca_firm_tbl.status=1", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->error_reports_tbl, $colNames="error_reports_tbl.*, ca_firm_tbl.caFirmId, ca_firm_tbl.caFirmName, ca_firm_tbl.caFirmCompanyKey", $errRpCondtnArr, $likeCondtnArr=array(), $errRptJoinArr, $singleRow=TRUE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $errRepData=$query['userData'];

        $this->data['errRepData']=$errRepData;

        return view('super_admin/error_report/view', $this->data);
	}

    public function delete_error_report()
	{
        $errId=$this->request->getPost('errId');

        $errRpUpdateArr = [
            'status'=>2,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];

        $errRpUpdCondtnArr['error_reports_tbl.errId']=$errId;
        // $errRpUpdCondtnArr['error_reports_tbl.errFrom']="1";

        $query=$this->Mcommon->updateData($tableName=$this->error_reports_tbl, $errRpUpdateArr, $errRpUpdCondtnArr, $likeCondtnArr=array(), $whereInArray=array());

        if($query['status']==FALSE)
        {
            $this->session->setFlashdata('flashErrorMsg', "Query has not deleted :(");
        }
        else
        {
            $insertLogArr['section']="Error Report";
            $insertLogArr['message']="Error Report deleted";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=strtok(exec('getmac'), ' ');
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Query has been deleted successfully :)");
        }
	}
	
	public function not_satisfy()
	{
        $errId=$this->request->getPost('errId');

        $errRpUpdateArr = [
            'errStatus'=>2,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];

        $errRpUpdCondtnArr['error_reports_tbl.errId']=$errId;
        // $errRpUpdCondtnArr['error_reports_tbl.errFrom']="1";

        $query=$this->Mcommon->updateData($tableName=$this->error_reports_tbl, $errRpUpdateArr, $errRpUpdCondtnArr, $likeCondtnArr=array(), $whereInArray=array());

        if($query['status']==FALSE)
        {
            $this->session->setFlashdata('flashErrorMsg', "Query not has been marked as satisfy :(");
        }
        else
        {
            $insertLogArr['section']="Error Report";
            $insertLogArr['message']="Error Report Query not has been marked as satisfy";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=strtok(exec('getmac'), ' ');
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Query has been marked as satisfied :)");
        }
	}
	
	public function delete_error_report_img_file()
	{
	    $this->db->transBegin();
	    
        $errId=$this->request->getPost('errId');
        
        $errRpCondtnArr['error_reports_tbl.errId']=$errId;
        $errRpCondtnArr['error_reports_tbl.errFrom']="2";
        $errRpCondtnArr['error_reports_tbl.status']="1";
        
        $query=$this->Mcommon->getRecords($tableName=$this->error_reports_tbl, $colNames="error_reports_tbl.*", $errRpCondtnArr, $likeCondtnArr=array(), $joinArr=array(), $singleRow=TRUE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $errRepData=$query['userData'];
        
        if(!empty($errRepData))
        {
            $img_file=$errRepData['errUploadedImage'];
            
            if(!empty($img_file))
            {
                $uploadPath=FCPATH.'uploads/admin/query_files';
                $delUploadFilePath=$uploadPath."/".$img_file;
                
                if(unlink($delUploadFilePath))
                {
                    $errRpUpdateArr = [
                        'errUploadedImage'=>"",
                        'updatedBy' => $this->adminId,
                        'updatedDatetime' => $this->currTimeStamp
                    ];
            
                    $errRpUpdCondtnArr['error_reports_tbl.errId']=$errId;
                    // $errRpUpdCondtnArr['error_reports_tbl.errFrom']="1";
            
                    $query=$this->Mcommon->updateData($tableName=$this->error_reports_tbl, $errRpUpdateArr, $errRpUpdCondtnArr, $likeCondtnArr=array(), $whereInArray=array());
                }
                else
                {
                    $this->session->setFlashdata('errorMsg', "Something went wrong!!, Errror while deleting Image :(");
                }
            }
        }
        else
        {
            $this->session->setFlashdata('errorMsg', "Something went wrong!!, Image not deleted :(");
        }

        if($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();
            
            $this->session->setFlashdata('flashErrorMsg', "Image has not deleted :(");
            
            return false;
        }
        else
        {
            $this->db->transCommit();
            
            $insertLogArr['section']="Error Report";
            $insertLogArr['message']="Error Report Image deleted";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=strtok(exec('getmac'), ' ');
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "Image has been deleted successfully :)");
            
            return true;
        }
	}
}

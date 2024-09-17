<?php
namespace App\Controllers;

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
        $this->Mmenu = new \App\Models\Mmenu();
        $this->Msubmenu = new \App\Models\Msubmenu();
        $this->TableLib = new \App\Libraries\TableLib();

        $tableArr=$this->TableLib->get_tables();

        $this->error_reports_tbl=$tableArr['error_reports_tbl'];
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

        $errRpCondtnArr['error_reports_tbl.fkFirmId']=$this->sessCaFirmId;
        $errRpCondtnArr['error_reports_tbl.errFrom']="1";
        $errRpCondtnArr['error_reports_tbl.status']="1";
        
        $errRpOrderByArr['error_reports_tbl.errPriority']="DESC";
        $errRpOrderByArr['error_reports_tbl.createdDatetime']="DESC";
        
        $errRpJoinArr[]=array("tbl"=>$this->menu_tbl, "condtn"=>"menu_tbl.menuId=error_reports_tbl.fkMenuId AND menu_tbl.status=1", "type"=>"left");
        $errRpJoinArr[]=array("tbl"=>$this->sub_menu_tbl, "condtn"=>"sub_menu_tbl.subMenuId=error_reports_tbl.fkSubMenuId AND sub_menu_tbl.status=1", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->error_reports_tbl, $colNames="error_reports_tbl.*, menu_tbl.menuName, sub_menu_tbl.subMenuName", $errRpCondtnArr, $likeCondtnArr=array(), $errRpJoinArr, $singleRow=FALSE, $errRpOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $errRepData=$query['userData'];

        $this->data['errRepData']=$errRepData;

        return view('firm_panel/error_report/list', $this->data);
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
        
        $menuArr = $this->Mmenu->where('status', 1)->findAll();
        $subMenuArr = $this->Msubmenu->where('status', 1)->findAll();
                        
        $this->data['menuArr']=$menuArr;
        $this->data['subMenuArr']=$subMenuArr;

        if(isset($_POST['submit']))
        {
            $errCode=$this->request->getPost('errCode');
            $errDate=$this->request->getPost('errDate');
            $errReport=$this->request->getPost('errReport');
            $errUserComment=$this->request->getPost('errUserComment');
            $errPriority=$this->request->getPost('errPriority');
            $errPriorityColor=$this->request->getPost('errPriorityColor');
            $fkMenuId=$this->request->getPost('fkMenuId');
            $fkSubMenuId=$this->request->getPost('fkSubMenuId');
            $file=$this->request->getFile('file');
            $errByUser=$this->sessCaFirmName;
            
            $img_file="";
            if(!empty($file->getTempName()))
            {
                if($file->isValid() && ! $file->hasMoved())
                {
                    $ext=$file->guessExtension();
                    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
                    
                    if (in_array($ext, $allowed_extensions))
                    {
                        $uploadPath=FCPATH.'uploads/ca_firm_'.$this->sessCaFirmId;

                        if(!is_dir($uploadPath))
                            mkdir($uploadPath, 0777, TRUE);

                        $uploadPath1=$uploadPath.'/query_files';

                        if(!is_dir($uploadPath1))
                            mkdir($uploadPath1, 0777, TRUE);
        
                        $img_file = $file->getRandomName();
                        $file->move($uploadPath1, $img_file);
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
                'errByUser'=>$errByUser,
                'errPriority'=>$errPriority,
                'errPriorityColor'=>$errPriorityColor,
                'fkMenuId'=>$fkMenuId,
                'fkSubMenuId'=>$fkSubMenuId,
                'errByPerson'=>$this->sessUserFullName,
                'fkFirmId'=>$this->sessCaFirmId,
                'errUploadedImage'=>$img_file,
                'errFrom'=>"1",
                'status' => 1,
                'createdBy' => $this->adminId,
                'createdDatetime' => $this->currTimeStamp
            ];
    
            $query=$this->Mcommon->insert($tableName=$this->error_reports_tbl, $errRpInsertArr, $returnType="");

            if($query['status']==FALSE)
            {
                $this->session->setFlashdata('errorMsg', "Query has not added :(");

                return redirect()->route('add_error_report');
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

                return redirect()->route('error_reports');
            }
        }

        return view('firm_panel/error_report/add', $this->data);
	}

    public function edit_error_report()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);
        $this->data['errId']=$errId=$uri->getSegment(3);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Edit Query";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $errRpCondtnArr['error_reports_tbl.errId']=$errId;
        $errRpCondtnArr['error_reports_tbl.errFrom']="1";
        $errRpCondtnArr['error_reports_tbl.status']="1";
        
        $query=$this->Mcommon->getRecords($tableName=$this->error_reports_tbl, $colNames="error_reports_tbl.*", $errRpCondtnArr, $likeCondtnArr=array(), $joinArr=array(), $singleRow=TRUE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $errRepData=$query['userData'];

        $this->data['errRepData']=$errRepData;
        
        $menuArr = $this->Mmenu->where('status', 1)->findAll();
        $subMenuArr = $this->Msubmenu->where('status', 1)->findAll();
                        
        $this->data['menuArr']=$menuArr;
        $this->data['subMenuArr']=$subMenuArr;

        if(isset($_POST['submit']))
        {
            $errId=$this->request->getPost('errId');
            $errDate=$this->request->getPost('errDate');
            $errReport=$this->request->getPost('errReport');
            $errUserComment=$this->request->getPost('errUserComment');
            $errPriority=$this->request->getPost('errPriority');
            $errPriorityColor=$this->request->getPost('errPriorityColor');
            $fkMenuId=$this->request->getPost('fkMenuId');
            $fkSubMenuId=$this->request->getPost('fkSubMenuId');
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
                        $uploadPath=FCPATH.'uploads/ca_firm_'.$this->sessCaFirmId;

                        if(!is_dir($uploadPath))
                            mkdir($uploadPath, 0777, TRUE);

                        $uploadPath1=$uploadPath.'/query_files';

                        if(!is_dir($uploadPath1))
                            mkdir($uploadPath1, 0777, TRUE);
        
                        $img_file = $file->getRandomName();
                        $file->move($uploadPath1, $img_file);
                        
                        if(!empty($old_file))
                        {
                            $delUploadFilePath=$uploadPath1."/".$old_file;
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
                'fkMenuId'=>$fkMenuId,
                'fkSubMenuId'=>$fkSubMenuId,
                'errUploadedImage'=>$img_file,
                'updatedBy' => $this->adminId,
                'updatedDatetime' => $this->currTimeStamp
            ];

            $errRpUpdCondtnArr['error_reports_tbl.errId']=$errId;
            $errRpUpdCondtnArr['error_reports_tbl.errFrom']="1";
    
            $query=$this->Mcommon->updateData($tableName=$this->error_reports_tbl, $errRpUpdateArr, $errRpUpdCondtnArr, $likeCondtnArr=array(), $whereInArray=array());

            if($query['status']==FALSE)
            {
                $this->session->setFlashdata('errorMsg', "Query has not updated :(");

                return redirect()->route('error_report/edit_error_report/'.$errId);
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

                return redirect()->route('error_reports');
            }
        }

        return view('firm_panel/error_report/edit', $this->data);
	}

    public function view_error_report()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);
        $this->data['errId']=$errId=$uri->getSegment(3);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="View Query";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $errRpCondtnArr['error_reports_tbl.errId']=$errId;
        $errRpCondtnArr['error_reports_tbl.errFrom']="1";
        $errRpCondtnArr['error_reports_tbl.status']="1";
        
        $query=$this->Mcommon->getRecords($tableName=$this->error_reports_tbl, $colNames="error_reports_tbl.*", $errRpCondtnArr, $likeCondtnArr=array(), $joinArr=array(), $singleRow=TRUE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $errRepData=$query['userData'];

        $this->data['errRepData']=$errRepData;
        
        $menuArr = $this->Mmenu->where('status', 1)->findAll();
        $subMenuArr = $this->Msubmenu->where('status', 1)->findAll();
                        
        $this->data['menuArr']=$menuArr;
        $this->data['subMenuArr']=$subMenuArr;

        return view('firm_panel/error_report/view', $this->data);
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
        $errRpUpdCondtnArr['error_reports_tbl.errFrom']="1";

        $query=$this->Mcommon->updateData($tableName=$this->error_reports_tbl, $errRpUpdateArr, $errRpUpdCondtnArr, $likeCondtnArr=array(), $whereInArray=array());

        if($query['status']==FALSE)
        {
            $this->session->setFlashdata('errorMsg', "Query has not deleted :(");
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
        $errRpUpdCondtnArr['error_reports_tbl.errFrom']="1";

        $query=$this->Mcommon->updateData($tableName=$this->error_reports_tbl, $errRpUpdateArr, $errRpUpdCondtnArr, $likeCondtnArr=array(), $whereInArray=array());

        if($query['status']==FALSE)
        {
            $this->session->setFlashdata('errorMsg', "Query not has been marked as satisfy :(");
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
        $errRpCondtnArr['error_reports_tbl.errFrom']="1";
        $errRpCondtnArr['error_reports_tbl.status']="1";
        
        $query=$this->Mcommon->getRecords($tableName=$this->error_reports_tbl, $colNames="error_reports_tbl.*", $errRpCondtnArr, $likeCondtnArr=array(), $joinArr=array(), $singleRow=TRUE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $errRepData=$query['userData'];
        
        if(!empty($errRepData))
        {
            $img_file=$errRepData['errUploadedImage'];
            
            if(!empty($img_file))
            {
                $uploadPath=FCPATH.'uploads/ca_firm_'.$this->sessCaFirmId;

                if(!is_dir($uploadPath))
                    mkdir($uploadPath, 0777, TRUE);

                $uploadPath1=$uploadPath.'/query_files';

                if(!is_dir($uploadPath1))
                    mkdir($uploadPath1, 0777, TRUE);

                $delUploadFilePath=$uploadPath1."/".$img_file;
                
                if(unlink($delUploadFilePath))
                {
                    $errRpUpdateArr = [
                        'errUploadedImage'=>"",
                        'updatedBy' => $this->adminId,
                        'updatedDatetime' => $this->currTimeStamp
                    ];
            
                    $errRpUpdCondtnArr['error_reports_tbl.errId']=$errId;
            
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
            
            $this->session->setFlashdata('errorMsg', "Image has not deleted :(");
            
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

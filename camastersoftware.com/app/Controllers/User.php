<?php
namespace App\Controllers;

class User extends BaseController
{
    public function __construct()
    {
        $this->data['cssPath']="template/includes/css";
        $this->data['navPath']="template/includes/nav";
        $this->data['footerPath']="template/includes/footer";
        $this->data['scriptPath']="template/includes/scripts";
        $this->data['layoutPath']="template/layouts/main_layout";
        $this->section="User/Staff";
        
        $this->Mquery = new \App\Models\Mquery();
        $this->Mgroup = new \App\Models\Mgroup();
        $this->Mgroup_cat = new \App\Models\Mgroup_cat();
        $this->Muser = new \App\Models\Muser();
        $this->Msalutation = new \App\Models\Msalutation();
        $this->MorganisationType = new \App\Models\MorganisationType();
        $this->Mdocument = new \App\Models\Mdocument();
        $this->Mact = new \App\Models\Mact();
        $this->MstaffTypes = new \App\Models\MstaffTypes();
        $this->MuserCategoryType = new \App\Models\MuserCategoryType();
        $this->TableLib = new \App\Libraries\TableLib();
        $this->session = \Config\Services::session();

        $tableArr=$this->TableLib->get_tables();

        $this->client_tbl=$tableArr['client_tbl'];
        $this->client_group_tbl=$tableArr['client_group_tbl'];
        $this->user_tbl=$tableArr['user_tbl'];
        $this->client_document_tbl=$tableArr['client_document_tbl'];
        $this->group_category_tbl=$tableArr['group_category_tbl'];
        $this->salutation_tbl=$tableArr['salutation_tbl'];
        $this->organisation_type_tbl=$tableArr['organisation_type_tbl'];

        $this->sessCaFirmId=$this->session->get('caFirmId');

        $documentsPath=base_url('uploads/ca_firm_'.$this->sessCaFirmId.'/documents');

        $this->data['documentsPath']=$documentsPath;
    }

	public function index()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="User (Employee) List";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        $userCondtnArr['user_tbl.status']="1";
        $userCondtnArr['user_tbl.isOldUser']=2;
        $userOrderByArr['user_tbl.userStaffType']="ASC";
        $userOrderByArr['user_tbl.userDesgn']="ASC";
        
        $query=$this->Mquery->getRecords($tableName=$this->user_tbl, $colNames="user_tbl.userId, user_tbl.userTitle, user_tbl.userFullName, user_tbl.userStaffType, user_tbl.userDesgn, user_tbl.userMobile1, user_tbl.userEmail1, user_tbl.userDob, user_tbl.userDOJ, user_tbl.userPan", $userCondtnArr, $likeCondtnArr=array(), $userJoinArr=array(), $singleRow=FALSE, $userOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getUserList=$query['userData'];

        $this->data['getUserList']=$getUserList;

        $salutationList=$this->Msalutation->where('salutation_tbl.status', 1)
                        ->findAll();

        $this->data['salutationList']=$salutationList;

        $staffTypeList=$this->MstaffTypes->where('staff_types.status', 1)
                        ->findAll();

        $this->data['staffTypeList']=$staffTypeList;

        return view('firm_panel/user/users', $this->data);
	}
	
	public function create_user()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Create User (Employee)";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        $userCondtnArr['user_tbl.status']="1";
        $userCondtnArr['user_tbl.isOldUser']=2;
        $userOrderByArr['user_tbl.userStaffType']="ASC";
        $userOrderByArr['user_tbl.userDesgn']="ASC";
        
        $query=$this->Mquery->getRecords($tableName=$this->user_tbl, $colNames="user_tbl.userId, user_tbl.userTitle, user_tbl.userFullName, user_tbl.userStaffType, user_tbl.userDesgn, user_tbl.userMobile1, user_tbl.userEmail1, user_tbl.userDob, user_tbl.userDOJ, user_tbl.userPan", $userCondtnArr, $likeCondtnArr=array(), $userJoinArr=array(), $singleRow=FALSE, $userOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getUserList=$query['userData'];

        $this->data['getUserList']=$getUserList;

        $salutationList=$this->Msalutation->where('salutation_tbl.status', 1)
                        ->findAll();

        $this->data['salutationList']=$salutationList;

        $staffTypeList=$this->MstaffTypes->where('staff_types.status', 1)
                        ->findAll();

        $this->data['staffTypeList']=$staffTypeList;

        $userCategoryList=$this->MuserCategoryType->where('user_category_tbl.status', 1)
        ->orderBy('user_category_tbl.seqNo',"ASC")
        ->findAll();

        $this->data['userCategoryList']=$userCategoryList;

        return view('firm_panel/user/create_user', $this->data);
	}

    public function edit_user($userId)
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $this->data['userId']=$userId;

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Edit User (Employee)";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $masterParam=$this->request->getGet('master');
        
        $this->data['masterParam']=$masterParam;

        $userCondtnArr['user_tbl.userId']=$userId;
        $userCondtnArr['user_tbl.status']="1";
        
        $query=$this->Mquery->getRecords($tableName=$this->user_tbl, $colNames="user_tbl.*", $userCondtnArr, $likeCondtnArr=array(), $userJoinArr=array(), $singleRow=TRUE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $userDataArr=$query['userData'];

        $this->data['userDataArr']=$userDataArr;

        $salutationList=$this->Msalutation->where('salutation_tbl.status', 1)
                        ->findAll();

        $this->data['salutationList']=$salutationList;

        $staffTypeList=$this->MstaffTypes->where('staff_types.status', 1)
                        ->findAll();

        $this->data['staffTypeList']=$staffTypeList;

        $userCategoryList=$this->MuserCategoryType->where('user_category_tbl.status', 1)
        ->orderBy('user_category_tbl.seqNo',"ASC")
        ->findAll();

        $this->data['userCategoryList']=$userCategoryList;

        return view('firm_panel/user/edit_user', $this->data);
	}

    public function view_user($userId)
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $this->data['userId']=$userId;

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min', 'jquery.steps', 'steps');
        $this->data['jsArr']=$jsArr;

        $pageTitle="View User/Staff Documents";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        $userCondtnArr['user_tbl.userId']=$userId;
        $userCondtnArr['user_tbl.status']="1";
        
        $query=$this->Mquery->getRecords($tableName=$this->user_tbl, $colNames="user_tbl.*", $userCondtnArr, $likeCondtnArr=array(), $userJoinArr=array(), $singleRow=TRUE, $orderByArr=array(), $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $userDataArr=$query['userData'];

        $this->data['userDataArr']=$userDataArr;

        return view('firm_panel/user/view_user', $this->data);
	}
}

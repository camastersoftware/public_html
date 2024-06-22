<?php
namespace App\Controllers;

class Group extends BaseController
{
    public function __construct()
    {
        $this->data['cssPath']="template/includes/css";
        $this->data['navPath']="template/includes/nav";
        $this->data['footerPath']="template/includes/footer";
        $this->data['scriptPath']="template/includes/scripts";
        $this->data['layoutPath']="template/layouts/main_layout";
        $this->section="Firm";
        
        $this->Mquery = new \App\Models\Mquery();
        $this->Mgroup = new \App\Models\Mgroup();
        $this->Mgroup_cat = new \App\Models\Mgroup_cat();
        $this->Muser = new \App\Models\Muser();
        $this->TableLib = new \App\Libraries\TableLib();

        $tableArr=$this->TableLib->get_tables();

        $this->group_category_tbl=$tableArr['group_category_tbl'];
        $this->client_group_tbl=$tableArr['client_group_tbl'];
        $this->client_tbl=$tableArr['client_tbl'];
        $this->user_tbl=$tableArr['user_tbl'];
        $this->organisation_type_tbl=$tableArr['organisation_type_tbl'];
    }

	public function index()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Group List";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        // $groupList=$this->Mgroup->select('client_group_tbl.*, user_tbl.userFullName, group_category_tbl.group_category_name')
        //                 ->join($this->user_tbl, 'user_tbl.userId=client_group_tbl.client_group_cost', 'left')
        //                 ->join($this->group_category_tbl, 'group_category_tbl.group_category_id=client_group_tbl.client_group_category', 'left')
        //                 ->where('client_group_tbl.status', 1)
        //                 ->findAll();
        
        // $this->data['groupList']=$groupList;

        $taxCondtnArr['client_group_tbl.status']=1;
        $taxOrderByArr['client_group_tbl.client_group_number']="ASC";
        $taxGroupByArr=array('client_group_tbl.client_group_id');

        $taxJoinArr[]=array("tbl"=>$this->user_tbl , "condtn"=>'user_tbl.userId=client_group_tbl.client_group_cost', "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->group_category_tbl, "condtn"=>'group_category_tbl.group_category_id=client_group_tbl.client_group_category', "type"=>"left");
        $taxJoinArr[]=array("tbl"=>$this->client_tbl, "condtn"=>'client_tbl.clientGroup=client_group_tbl.client_group_id AND client_tbl.status=1', "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->client_group_tbl, $colNames='client_group_tbl.*, user_tbl.userFullName, user_tbl.userShortName, group_category_tbl.group_category_name, COUNT(client_tbl.clientId) AS clientCount, SUM(CASE WHEN client_tbl.isOldClient = 1 THEN 1 ELSE 0 END) AS oldClientCount, SUM(CASE WHEN client_tbl.isOldClient != 1 THEN 1 ELSE 0 END) AS presentClientCount', $taxCondtnArr, $likeCondtnArr=array(), $taxJoinArr, $singleRow=FALSE, $taxOrderByArr, $taxGroupByArr, $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $groupList=$query['userData'];
        
        $this->data['groupList']=$groupList;
        
        $clientOrderByArr=array();
        
        $clientCondtnArr['client_tbl.status']=1;
        $clientOrderByArr['client_tbl.clientBussOrganisationType']="ASC";

        $clientJoinArr[]=array("tbl"=>$this->client_group_tbl, "condtn"=>"client_group_tbl.client_group_id=client_tbl.clientGroup", "type"=>"left");
        $clientJoinArr[]=array("tbl"=>$this->organisation_type_tbl, "condtn"=>"organisation_type_tbl.organisation_type_id=client_tbl.clientBussOrganisationType", "type"=>"left");
        
        $query=$this->Mcommon->getRecords($tableName=$this->client_tbl, $colNames="client_tbl.clientId, client_tbl.clientBussOrganisation, client_tbl.clientTitle, client_tbl.clientName, client_tbl.clientGroup, client_tbl.clientCostCenter, client_tbl.clientPanNumber, client_tbl.clientBussOrganisationType AS orgType, client_tbl.clientDob, client_tbl.isOldClient, client_group_tbl.client_group, client_group_tbl.client_group_number, organisation_type_tbl.organisation_type_name", $clientCondtnArr, $likeCondtnArr=array(), $clientJoinArr, $singleRow=FALSE, $clientOrderByArr, $groupByArr=array(), $whereInArray=array(), $customWhereArray=array(), $orWhereArray=array(), $orWhereDataArr=array());
        
        $getClientList=$query['userData'];
        
        $clientListArr=array();
        $oldClientListArr=array();

        if(!empty($getClientList))
        {
            foreach($getClientList AS $e_cl)
            {
                if($e_cl["isOldClient"]==1)
                    $oldClientListArr[$e_cl['clientGroup']][]=$e_cl;
                else
                    $clientListArr[$e_cl['clientGroup']][]=$e_cl;
            }
        }
        
        $this->data['clientListArr']=$clientListArr;
        $this->data['oldClientListArr']=$oldClientListArr;

        $groupCatList=$this->Mgroup_cat->where('group_category_tbl.status', 1)
            ->findAll();

        $this->data['groupCatList']=$groupCatList;

        $userList=$this->Muser->where('user_tbl.isCostCenter', 1)
            ->where('user_tbl.status', 1)
            ->findAll();

        $this->data['userList']=$userList;

        return view('firm_panel/group/groups', $this->data);
	}
}

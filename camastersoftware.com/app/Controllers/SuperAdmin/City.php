<?php namespace App\Controllers\SuperAdmin;
use \App\Controllers\BaseController;

class City extends BaseController
{
    public function __construct()
    {
        $this->data['cssPath']="template/includes/css";
        $this->data['navPath']="template/includes/nav";
        $this->data['sidebarPath']="template/includes/sidebar";
        $this->data['footerPath']="template/includes/footer";
        $this->data['scriptPath']="template/includes/scripts";
        $this->data['layoutPath']="template/layouts/main_layout";
        $this->section="City";
        
        $this->Mcity = new \App\Models\Mcity();
        $this->Mstate = new \App\Models\Mstate();
    }

	public function index()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="City List";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']="City List";

        $this->data['navArr']=$navArr;

        $cityList = $this->Mcity->select('cities.cityId AS id, cities.cityName AS name, cities.fk_state_id AS state_id, states.stateId, states.stateName')
                    ->where('cities.status', 1)
                    ->where('states.status', 1)
                    ->join('states', 'states.stateId = cities.fk_state_id')
                    ->findAll();

        $this->data['cityList']=$cityList;
        
        $stateArr = $this->Mstate->where('status', 1)
                    ->findAll();
                    
        $this->data['stateArr']=$stateArr;

        return view('super_admin/cityList', $this->data);
	}
	
	public function add()
	{
	    $cityName=$this->request->getPost('cityName');
	    $stateId=$this->request->getPost('stateId');
	    
	    $dataArray = [
            'cityName' => $cityName,
            'fk_state_id' => $stateId,
            'status' => 1,
            'createdBy' => $this->adminId,
            'createdDatetime' => $this->currTimeStamp
        ];
	    
        if($this->Mcity->save($dataArray)){
            
            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="City Added";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "City has been added successfully :)");
        }else{
            $this->session->setFlashdata('errorMsg', "City has not added :(");
        }
        
        return redirect()->route('superadmin/cities');
	}
	
	public function edit()
	{
	    $cityId=$this->request->getPost('cityId');
	    $cityName=$this->request->getPost('cityName');
	    $stateId=$this->request->getPost('stateId');
	    
	    $dataArray = [
            'cityId' => $cityId,
            'cityName' => $cityName,
            'fk_state_id' => $stateId,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
        if($this->Mcity->save($dataArray)){
            
            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="City Updated";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "City has been updated successfully :)");
        }else{
            $this->session->setFlashdata('errorMsg', "City has not updated :(");
        }
        
        return redirect()->route('superadmin/cities');
	}
	
	public function delete()
	{
	    $cityId=$this->request->getPost('cityId');
	    
	    $dataArray = [
            'cityId' => $cityId,
            'status' => 2,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
        if($this->Mcity->save($dataArray)){
            
            $insertLogArr['section']=$this->section;
            $insertLogArr['message']="City Deleted";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', "City has been deleted successfully :)");
        }else{
            $this->session->setFlashdata('errorMsg', "City has not deleted :(");
        }
        
        // return redirect()->route('cities');
	}
}

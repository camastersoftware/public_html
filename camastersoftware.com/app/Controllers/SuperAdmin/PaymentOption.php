<?php namespace App\Controllers\SuperAdmin;
use \App\Controllers\BaseController;

class PaymentOption extends BaseController
{
    public function __construct()
    {
        $this->data['cssPath']="template/includes/css";
        $this->data['navPath']="template/includes/nav";
        $this->data['footerPath']="template/includes/footer";
        $this->data['scriptPath']="template/includes/scripts";
        $this->data['layoutPath']="template/layouts/main_layout";
        $this->section="Payment Option";
        
        $this->MpaymentOption = new \App\Models\MpaymentOption();
    }

	public function index()
	{
        $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;

        $pageTitle="Payment Options";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;

        $resultArr = $this->MpaymentOption->where('status', 1)
                    ->findAll();

        $this->data['resultArr']=$resultArr;

        return view('super_admin/payment_options', $this->data);
	}
	
	public function add_payment_option()
	{
	    $payment_option_name=$this->request->getPost('payment_option_name');
	    
	    $dataArray = [
            'payment_option_name' => $payment_option_name,
            'status' => 1,
            'createdBy' => $this->adminId,
            'createdDatetime' => $this->currTimeStamp
        ];
	    
        if($this->MpaymentOption->save($dataArray)){
            
            $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Added";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', $this->section." has been added successfully :)");
        }else{
            $this->session->setFlashdata('errorMsg', $this->section." has not added :(");
        }
        
        return redirect()->route('superadmin/payment_options');
	}
	
	public function edit_payment_option()
	{
	    $payment_option_id=$this->request->getPost('payment_option_id');
	    $payment_option_name=$this->request->getPost('payment_option_name');
	    
	    $dataArray = [
            'payment_option_id' => $payment_option_id,
            'payment_option_name' => $payment_option_name,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
        if($this->MpaymentOption->save($dataArray)){
            
            $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Updated";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', $this->section." has been updated successfully :)");
        }else{
            $this->session->setFlashdata('errorMsg', $this->section." has not updated :(");
        }
        
        return redirect()->route('superadmin/payment_options');
	}
	
	public function delete_payment_option()
	{
        $payment_option_id=$this->request->getPost('payment_option_id');

	    $dataArray = [
            'payment_option_id' => $payment_option_id,
            'status' => 2,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
        if($this->MpaymentOption->save($dataArray)){
            
            $insertLogArr['section']=$this->section;
            $insertLogArr['message']=$this->section." Deleted";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);

            $this->session->setFlashdata('successMsg', $this->section." has been deleted successfully :)");
        }else{
            $this->session->setFlashdata('errorMsg', $this->section." has not deleted :(");
        }
        
        return redirect()->route('superadmin/payment_options');
	}
}

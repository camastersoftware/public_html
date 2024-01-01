<?php
namespace App\Controllers;

class Cashbook extends BaseController
{
    public function __construct()
    {
        $this->data['cssPath']="template/includes/css";
        $this->data['navPath']="template/includes/nav";
        $this->data['footerPath']="template/includes/footer";
        $this->data['scriptPath']="template/includes/scripts";
        $this->data['layoutPath']="template/layouts/main_layout";
        $this->section="Cash Book";
        
        $this->Mcommon = new \App\Models\Mcommon();
        $this->Mquery = new \App\Models\Mquery();
        $this->Mcashbook = new \App\Models\Mcashbook();
        $this->TableLib = new \App\Libraries\TableLib();
        $this->session = \Config\Services::session();

        $tableArr=$this->TableLib->get_tables();

        $this->cashbook_tbl=$tableArr['cashbook_tbl'];

        $this->sessCaFirmId=$this->session->get('caFirmId');

        $documentsPath=base_url('uploads/ca_firm_'.$this->sessCaFirmId.'/documents');

        $this->data['documentsPath']=$documentsPath;
        
        $currYear=date('Y');
        
        $this->dueYear=$currYear."-".(substr($currYear+1, 2));
        
        $this->data['dueYear']=$this->dueYear;
        
        $currMth=date('n');
        
        $this->data['currMth']=$currMth;
    }

	public function index()
	{
	    setlocale(LC_MONETARY, 'en_IN');
	    
	    $uri = service('uri');
        $this->data['uri1']=$uri1=$uri->getSegment(1);

        $jsArr=array('data-table', 'datatables.min', 'sweetalert.min');
        $this->data['jsArr']=$jsArr;
        
        $pageTitle="Cash Book";
        $this->data['pageTitle']=$pageTitle;

        $navArr=array();

        $navArr[0]['active']=true;
        $navArr[0]['title']=$pageTitle;

        $this->data['navArr']=$navArr;
        
        $fin_year_arr=explode("-", $this->sessDueDateYear);
        
        $fisrtYr=$fin_year_arr[0];
        $secondYr="20".$fin_year_arr[1];

        $fromDate=date("Y-m-d", strtotime($fisrtYr."-04-01"));
        $toDate=date("Y-m-d", strtotime($secondYr."-03-31"));
        
        $this->data['fisrtYr']=$fisrtYr;
        $this->data['secondYr']=$secondYr;
        $this->data['fromDate']=$fromDate;
        $this->data['toDate']=$toDate;
        
        $prevCashbookArr = $this->Mcashbook->select('cbType, SUM(cbAmt) AS totalAmt')
                    ->where('status', 1)
                    ->where('cbDate <', $fromDate)
                    ->groupBy('cbType')
                    ->findAll();
        
        $prevCBArr=array();
        
        if(!empty($prevCashbookArr))
        {
            foreach($prevCashbookArr AS $e_prev)
            {
                $prevCBArr[$e_prev['cbType']]=$e_prev['totalAmt'];
            }
        }
        
        $totalRecevied=0;
        $totalPaid=0;
        
        if(isset($prevCBArr[1]))
            $totalRecevied=$prevCBArr[1];
            
        if(isset($prevCBArr[2]))
            $totalPaid=$prevCBArr[2];
            
        $totalBalance=$totalRecevied-$totalPaid;
        
        $cbMonthArr = $this->Mcashbook->select('*, MONTH(cbDate) AS cbMonth, cbType, SUM(cbAmt) AS totalAmt')
                    ->where('status', 1)
                    ->where('cbDate >=', $fromDate)
                    ->where('cbDate <=', $toDate)
                    ->groupBy('MONTH(cbDate), cbType')
                    ->findAll();
                    
        // echo $this->db->getLastQuery();
        
                    
        $cbMthArr=array();
        if(!empty($cbMonthArr))
        {
            foreach($cbMonthArr AS $k_cbm=>$e_cbm)
            {
                $cbMthArr[$e_cbm['cbMonth']][$e_cbm['cbType']]=$e_cbm['totalAmt'];
            }
        }
        
        // print_r($cbMonthArr);
        
        $cbMthAmt=array();
        
        for($mt=1;$mt<=12;$mt++)
        {
            if($mt<=9)
                $mnt=$mt+3;
            else
                $mnt=$mt-9;
            
            $prevMthBal=0;
            $cbCurrMthRecvd=0;
            $cbMthRecvd=0;
            $cbMthPaid=0;
            
            if($mnt==4)
            {
                $prevMthBal=$totalBalance;
            }
            else
            {
                if(isset($cbMthAmt[$mnt-1]))
                    $prevMthBal=$cbMthAmt[$mnt-1];
            }
            
            if(isset($cbMthArr[$mnt-1][1]))
                $cbCurrMthRecvd=$cbMthArr[$mnt-1][1];
                
            $cbMthRecvd=$prevMthBal+$cbCurrMthRecvd;
            // $cbMthRecvd=$prevMthBal;
            
            if(isset($cbMthArr[$mnt-1][2]))
                $cbMthPaid=$cbMthArr[$mnt-1][2];
            
            $cbMthAmt[$mnt]=$cbMthRecvd-$cbMthPaid;
            
            // $cbMthAmt1[$mnt]['op']=$prevMthBal;
            // $cbMthAmt1[$mnt][1]=$cbMthRecvd;
            // $cbMthAmt1[$mnt][2]=$cbMthPaid;
            // $cbMthAmt1[$mnt]['bal']=$cbMthRecvd-$cbMthPaid;
        }

        // print_r($cbMthArr);
        // print_r($cbMthAmt);
        // print_r($cbMthAmt1);
        // die();
        
        $cashbookArr = $this->Mcashbook->select('*, DAY(cbDate) AS cbDay, MONTH(cbDate) AS cbMonth')
                    ->where('status', 1)
                    ->where('cbDate >=', $fromDate)
                    ->where('cbDate <=', $toDate)
                    ->orderBy('cbDate', "ASC")
                    ->orderBy('cbFromTo', "ASC")
                    ->findAll();
        
        $cbTypeArr=array();
        $cbArr=array();
        
        if(!empty($cashbookArr))
        {
            foreach($cashbookArr AS $k_cb=>$e_cb)
            {
                $cbTypeArr[$e_cb['cbMonth']][]=$e_cb['cbType'];
                $cbArr[$e_cb['cbMonth']][$e_cb['cbType']][$k_cb]=$e_cb;
            }
        }
        
        $mthMaxVal=array();
        
        if(!empty($cbTypeArr))
        {
            foreach($cbTypeArr AS $k_cbt=>$e_cbt)
            {
                $mthRd=0;
                $mthPd=0;
                
                $mthRdPd=array_count_values($e_cbt);
                
                if(isset($mthRdPd[1]))
                    $mthRd=$mthRdPd[1];
                    
                if(isset($mthRdPd[2]))
                    $mthPd=$mthRdPd[2];
                    
                $mthMaxVal[$k_cbt]=max($mthRdPd);
            }
        }
        
        $this->data['totalBalance']=$totalBalance;
        $this->data['cbMthAmt']=$cbMthAmt;
        $this->data['cbArr']=$cbArr;
        $this->data['mthMaxVal']=$mthMaxVal;
        $this->data['cashbookArr']=$cashbookArr;

        return view('firm_panel/cashbook/list', $this->data);
	}

	public function add()
	{
	    $cbDate=$this->request->getPost('cbDate');
	    $cbType=$this->request->getPost('cbType');
	    $cbFromTo=$this->request->getPost('cbFromTo');
	    $cbFor = $this->request->getPost('cbFor');
	    $cbAmt = $this->request->getPost('cbAmt');
	    $cbRemark = $this->request->getPost('cbRemark');
	    
	    $fin_year_arr=explode("-", $this->sessDueDateYear);

        $fisrtYr=$fin_year_arr[0];
        $secondYr="20".$fin_year_arr[1];
        
        $cbDateStr=strtotime($cbDate);
        $fromDate=strtotime($fisrtYr."-04-01");
        $toDate=strtotime($secondYr."-03-31");
        
        if($cbDateStr>=$fromDate && $cbDateStr<=$toDate)
        {
    	    $this->db->transBegin();
    	    
    	    $insertArr=[
                'cbDate'=>$cbDate,
                'cbType'=>$cbType,
                'cbFromTo'=>$cbFromTo,
                'cbFor'=>$cbFor,
                'cbAmt'=>$cbAmt,
                'cbRemark'=>$cbRemark,
                'status' => 1,
                'createdBy' => $this->adminId,
                'createdDatetime' => $this->currTimeStamp
            ];
            
            $this->Mcashbook->save($insertArr);
    	    
    	    if($this->db->transStatus() === FALSE)
    	    {
    	        $this->db->transRollback();
    	        
    	        $this->session->setFlashdata('errorMsg', "Transaction has not added :(");
    	    }
    	    else
    	    {
    	        $this->db->transCommit();
    	        
    	        $insertLogArr['section']=$this->section;
                $insertLogArr['message']=$this->section." Added";
                $insertLogArr['ip']=$this->IPAddress;
                // $insertLogArr['macAddr']=$this->macAddress;
                $insertLogArr['createdBy']=$this->adminId;
                $insertLogArr['createdDatetime']=$this->currTimeStamp;
    
                $this->Mcommon->insertLog($insertLogArr);
                
    	        $this->session->setFlashdata('successMsg', "New Transaction has been added successfully :)");
    	    }
        }
        else
        {
            $this->session->setFlashdata('errorMsg', "Please select valid date.");
        }
	    
	    return redirect()->route('cashbook');
	}
	
	public function updateData()
	{
	    $cbId=$this->request->getPost('cbId');
	    $cbDate=$this->request->getPost('cbDate');
	    $cbType=$this->request->getPost('cbType');
	    $cbFromTo=$this->request->getPost('cbFromTo');
	    $cbFor = $this->request->getPost('cbFor');
	    $cbAmt = $this->request->getPost('cbAmt');
	    $cbRemark = $this->request->getPost('cbRemark');
	    
	    $fin_year_arr=explode("-", $this->sessDueDateYear);

        $fisrtYr=$fin_year_arr[0];
        $secondYr="20".$fin_year_arr[1];
        
        $cbDateStr=strtotime($cbDate);
        $fromDate=strtotime($fisrtYr."-04-01");
        $toDate=strtotime($secondYr."-03-31");
        
        if($cbDateStr>=$fromDate && $cbDateStr<=$toDate)
        {
    	    $this->db->transBegin();
    	    
    	    $insertArr=[
                'cbId'=>$cbId,
                'cbDate'=>$cbDate,
                'cbType'=>$cbType,
                'cbFromTo'=>$cbFromTo,
                'cbFor'=>$cbFor,
                'cbAmt'=>$cbAmt,
                'cbRemark'=>$cbRemark,
                'updatedBy' => $this->adminId,
                'updatedDatetime' => $this->currTimeStamp
            ];
    	    
    	    $this->Mcashbook->save($insertArr);
    	    
    	    if($this->db->transStatus() === FALSE)
    	    {
    	        $this->db->transRollback();
    	        
    	        $this->session->setFlashdata('errorMsg', "Transaction has not updated :(");
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
                
    	        $this->session->setFlashdata('successMsg', "Transaction has been updated successfully :)");
    	    }
        }
        else
        {
            $this->session->setFlashdata('errorMsg', "Please select valid date.");
        }
	    
	    return redirect()->route('cashbook');
	}
	
	public function deleteData()
	{
	    $cbId=$this->request->getPost('cbId');
	    
	    $insertArr=[
            'cbId'=>$cbId,
            'status'=>2,
            'updatedBy' => $this->adminId,
            'updatedDatetime' => $this->currTimeStamp
        ];
	    
	    if($this->Mcashbook->save($insertArr))
	    {
	        $insertLogArr['section']=$this->section;
            $insertLogArr['message']="Transaction Deleted";
            $insertLogArr['ip']=$this->IPAddress;
            // $insertLogArr['macAddr']=$this->macAddress;
            $insertLogArr['createdBy']=$this->adminId;
            $insertLogArr['createdDatetime']=$this->currTimeStamp;

            $this->Mcommon->insertLog($insertLogArr);
            
	        $this->session->setFlashdata('successMsg', "Transaction has been deleted successfully :)");
	    }
	    else
	    {
	        $this->session->setFlashdata('errorMsg', "Transaction has not deleted :(");
	    }
	}
}